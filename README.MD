# pakistan-2003

Archival preservation of an early-2000s Pakistan tourism website. Original PHP
source is kept intact; the site is pre-rendered to static HTML and served from
Firebase Hosting.

## About the site

A tourism portal (circa 2002–2003, hence the repo name) promoting travel in
Pakistan tours, treks, jeep safaris, and hotel reservations. Content covers
top destinations, archaeological sites, an adventure club, a tourist center
with practical travel info, and packaged itineraries spanning adventure,
cultural, heritage, city, special, sports, safari, and weekend tours.

## Architecture

- PHP templates in `webapp/` — untouched — are pre-rendered to HTML via `scripts/render.sh` → `dist/`
- `firebase deploy` publishes `dist/` to Firebase Hosting (CDN, 365-day cache)
- No server-side PHP runs in production

## Local development

Open the repo in VS Code → **Reopen in Container** (requires Docker Desktop).

The devcontainer boots a PHP 8.3 environment and serves `webapp/` at http://localhost:5000.

To preview the pre-rendered static output (what Firebase Hosting will serve):

```bash
./scripts/render.sh
firebase emulators:start --only hosting
```

## Deployment

Push to `main` — GitHub Actions renders the site and deploys to Firebase Hosting.

### Required GitHub secrets

| Secret         | Source                                                                            |
|----------------|-----------------------------------------------------------------------------------|
| `WIF_PROVIDER` | `terraform -chdir=firebase-cloud/terraform output -raw pakistan_2003_wif_provider` |
| `GCP_SA_EMAIL` | `terraform -chdir=firebase-cloud/terraform output -raw pakistan_2003_gcp_sa_email` |