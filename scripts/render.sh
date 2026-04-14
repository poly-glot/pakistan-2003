#!/usr/bin/env bash
# Pre-render all PHP pages into static HTML in ./dist
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
SRC="$ROOT/webapp"
OUT="$ROOT/dist"

rm -rf "$OUT"
mkdir -p "$OUT"

# Copy static assets verbatim
cp -R "$SRC/img" "$OUT/img"
cp "$SRC/stylesheet.css" "$OUT/stylesheet.css"

# Render every PHP page to HTML, excluding partials:
#   - anything under includes/
#   - links.php (per-directory sub-nav partial)
#   - reservation_button.php (shared button partial)
while IFS= read -r -d '' php_file; do
  rel="${php_file#$SRC/}"
  out_file="$OUT/${rel%.php}.html"
  mkdir -p "$(dirname "$out_file")"
  (cd "$(dirname "$php_file")" && php -d error_reporting=0 "$(basename "$php_file")") > "$out_file"
  echo "rendered ${rel%.php}.html"
done < <(
  find "$SRC" -type f -name '*.php' \
    -not -path "$SRC/includes/*" \
    -not -name 'links.php' \
    -not -name 'reservation_button.php' \
    -print0
)

# Strip .php from internal hrefs so cleanUrls can serve the static .html files.
# Runs against rendered HTML only; leaves PHP source untouched.
find "$OUT" -type f -name '*.html' -print0 | xargs -0 perl -i -pe 's/(href="[^"]*)\.php"/$1"/g'

echo "Done. Output: $OUT"
