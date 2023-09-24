<?php require('../includes/application_top.php'); ?>

<script language="JavaScript">
    <!--

    var locations = new Array (
        "5%0", "Pakistan",
        "0%3", "London",
        "1%3", "Berlin",
        "-5%2", "New York",
        "-8%2", "Los Angeles",
        "9%0", "Tokyo",
        "-5%2", "Toronto"
    );

    var TableTimes = new Array();

    var visitorPlace;

    // Day light saving table
    var dstZones = new Array ();

    var uNow = new Date();
    var uMonth = uNow.getMonth();
    var uDate = uNow.getDate();
    var uDay = uNow.getDay();


    var GMToffset = uNow.getTimezoneOffset();
    if (GMToffset < 0) {
        GMToffset = Math.abs(GMToffset);
    } else {
        GMToffset = GMToffset - (Math.abs(GMToffset) *2);
    }

    var FirstSun8Feb = ( (uMonth == 1 && uDate > 14) || uMonth > 1 ) ? true : false;
    if ((uMonth == 1)&&(uDate >= 8)) {
        var DaysLeft = 14  - uDate;
        FirstSun8Feb = (uDay + DaysLeft <= 6) ? true : false;
    };

    var FirstSun15Mar = ( (uMonth == 2 && uDate > 21) || uMonth > 2 ) ? true : false;
    if ((uMonth == 2)&&(uDate >= 15)) {
        DaysLeft = 21  - uDate;
        FirstSun15Mar = (uDay + DaysLeft <= 6) ? true : false;
    };

    var LastSunMar = (uMonth > 2) ? true : false;
    if ((uMonth == 2)&&(uDate >= 25)) {
        DaysLeft = 31  - uDate;
        LastSunMar = (uDay + DaysLeft <= 6) ? true : false;
    };

    var FirstSunApr = ( (uMonth == 3 && uDate > 7) || uMonth > 3 ) ? true : false;
    if ((uMonth == 3)&&(uDate <= 7)) {
        var DaysGone = 7  - uDate;
        FirstSunApr = (uDay - DaysGone >0) ? true : false;
    };

    var LastSunSep = (uMonth > 8) ? true : false;
    if ((uMonth == 8)&&(uDate >= 24)) {
        DaysLeft = 30  - uDate;
        LastSunSep = (Day + DaysLeft <= 6) ? true : false;
    };

    var FirstSunOct = ( (uMonth == 9 && uDate > 7) || uMonth > 9  ) ? true : false;
    if (uMonth == 9 && uDate <= 7) {
        DaysGone = 7  - uDate;
        FirstSunOct = (uDay - DaysGone >0) ? true : false;
    };

    var FirstSun15Oct = ( (uMonth == 9)&&(uDate > 21) || (uMonth > 9) ) ? true : false;
    if ( uMonth == 9 && (uDate >= 15 || uDate <= 21) ) {
        DaysLeft = 21  - uDate;
        FirstSun15Oct = (uDay + DaysLeft <= 6) ? true : false;
    };

    var LastSunOct = (uMonth > 9) ? true : false;
    if ((uMonth == 9)&&(uDate >= 25)) {
        DaysLeft = 31  - uDate;
        LastSunOct = (uDay + DaysLeft <= 6) ? true : false;
    };

    dstZones[0] = "X";
    dstZones[1] = "?";
    dstZones[2] =  (FirstSunApr && !LastSunOct) ? "Y" : "N";//usa/canada
    dstZones[3] =  (LastSunMar && !LastSunOct) ? "Y" : "N";//uk/europe
    dstZones[4] =  (LastSunOct || !LastSunMar) ? "Y" : "N";//aus
    dstZones[5] =  (FirstSunOct || !LastSunMar) ? "Y" : "N";//aus-tasmania
    dstZones[6] =  (FirstSunOct || !FirstSun15Mar) ? "Y" : "N";//nz
    dstZones[7] =  (LastSunMar && !LastSunSep) ? "Y" : "N";//russia

    var FirstSun8Feb = ( (uMonth == 1 && uDate > 14) || uMonth > 1 ) ? true : false;
    if ((uMonth == 1)&&(uDate >= 8)) {
        var DaysLeft = 14  - uDate;
        FirstSun8Feb = (uDay + DaysLeft <= 6) ? true : false;
    };

    var FirstSun15Mar = ( (uMonth == 2 && uDate > 21) || uMonth > 2 ) ? true : false;
    if ((uMonth == 2)&&(uDate >= 15)) {
        DaysLeft = 21  - uDate;
        FirstSun15Mar = (uDay + DaysLeft <= 6) ? true : false;
    };

    var LastSunMar = (uMonth > 2) ? true : false;
    if ((uMonth == 2)&&(uDate >= 25)) {
        DaysLeft = 31  - uDate;
        LastSunMar = (uDay + DaysLeft <= 6) ? true : false;
    };

    var FirstSunApr = ( (uMonth == 3 && uDate > 7) || uMonth > 3 ) ? true : false;
    if ((uMonth == 3)&&(uDate <= 7)) {
        var DaysGone = 7  - uDate;
        FirstSunApr = (uDay - DaysGone >0) ? true : false;
    };

    var LastSunSep = (uMonth > 8) ? true : false;
    if ((uMonth == 8)&&(uDate >= 24)) {
        DaysLeft = 30  - uDate;
        LastSunSep = (Day + DaysLeft <= 6) ? true : false;
    };

    var FirstSunOct = ( (uMonth == 9 && uDate > 7) || uMonth > 9  ) ? true : false;
    if (uMonth == 9 && uDate <= 7) {
        DaysGone = 7  - uDate;
        FirstSunOct = (uDay - DaysGone >0) ? true : false;
    };

    var FirstSun15Oct = ( (uMonth == 9)&&(uDate > 21) || (uMonth > 9) ) ? true : false;
    if ( uMonth == 9 && (uDate >= 15 || uDate <= 21) ) {
        DaysLeft = 21  - uDate;
        FirstSun15Oct = (uDay + DaysLeft <= 6) ? true : false;
    };

    var LastSunOct = (uMonth > 9) ? true : false;
    if ((uMonth == 9)&&(uDate >= 25)) {
        DaysLeft = 31  - uDate;
        LastSunOct = (uDay + DaysLeft <= 6) ? true : false;
    };

    dstZones[0] = "X";
    dstZones[1] = "?";
    dstZones[2] =  (FirstSunApr && !LastSunOct) ? "Y" : "N";//usa/canada
    dstZones[3] =  (LastSunMar && !LastSunOct) ? "Y" : "N";//uk/europe
    dstZones[4] =  (LastSunOct || !LastSunMar) ? "Y" : "N";//aus
    dstZones[5] =  (FirstSunOct || !LastSunMar) ? "Y" : "N";//aus-tasmania
    dstZones[6] =  (FirstSunOct || !FirstSun15Mar) ? "Y" : "N";//nz
    dstZones[7] =  (LastSunMar && !LastSunSep) ? "Y" : "N";//russia

    function Into24hrs (time) {
        if ( time >= 1440) {
            time -= 1440;
        }

        if ( time < 0) {
            time = 1440 + time
        }

        return time;
    }

    function formatTime (time) {
        var fHours = Math.floor (time/60) ;
        if (fHours <= 9) {
            fHours = "0" + fHours;
        }

        var fMins = time - (fHours * 60);
        if (fMins <= 9) {
            fMins = "0" + fMins;
        }

        return fHours + ":" + fMins;
    }

    function formatRelative (time) {
        var Report = null;
        var Direction  = (time > 0) ? " Ahead" : " Behind";
        time = Math.abs (time);
        var Hours = Math.floor (time/60);
        var Mins = (time - Hours * 60);
        Report = Hours + "h ";

        if (Mins != 0) {
            Report=Report+Mins + "m ";
        }

        Report = Report + Direction;

        if (time== 0) {
            Report="Same Time";
        }

        return Report;
    }

    function GMTnow () {
        var time = new Date();
        hrs = time.getHours();
        mins = time.getMinutes();

        var GMT = (hrs*60 + mins) - GMToffset;
        GMT = Into24hrs(GMT);
        return GMT;
    }

    function getTimeByLocation(ZoneData) {
        var qReport = new Array();
        qReport[0] = "";
        qReport[1] = "";
        qReport[2] = "";
        qReport[3] = "";
        qReport[4] = "";

        var qGMTparse = parseFloat(ZoneData);
        var qGMToffset_hrs = parseInt(qGMTparse, 10) ;
        var qGMToffset_min= parseInt ( Math.round((qGMTparse - qGMToffset_hrs) * 100), 10);
        var qDSTperiod = ZoneData.split("%").pop();

        if ( (qGMToffset_hrs > 12) || (qGMToffset_hrs <-11) ) {
            qReport[0] = "BAD DATA";
            return;
        }

        if (qDSTperiod > dstZones.length) {
            qReport[3] = "BAD DATA";
        }

        var relativeGMT = (qGMToffset_hrs * 60) + qGMToffset_min;

        if (dstZones [qDSTperiod] == "Y") {
            relativeGMT += 60;
            qReport[3] = "Yes (+1 hour)";
        }

        if (dstZones [qDSTperiod] == "N") {
            qReport[3] = "No";
        }

        if (dstZones [qDSTperiod] == "X") {
            qReport[3] = "N/A";
        }

        if (dstZones [qDSTperiod] == "?") {
            qReport[3] = "Uncertain";
        }

        var qPlaceTotMins = GMTnow();
        qPlaceTotMins += relativeGMT;
        qReport[0] = Into24hrs (qPlaceTotMins);

        var relativeLocation = relativeGMT - GMToffset;
        qReport[1] = formatRelative (relativeLocation);

        qReport[2] = formatRelative (relativeGMT);

        qReport[4] = relativeGMT;

        return qReport;
    }

    function writeTable () {
        for (var i = 0; i < locations.length; i = i + 2) {
            var qReport = getTimeByLocation(locations[i]);
            var id = "location_" + i;

            TableTimes.push(new Array(
                id,
                qReport[4]
            ));

            document.write (
                "<tr>"
                + "<td>" + locations[i+1] + "</B></td>"
                + "<td><input type=text size=10 id=" + id + " name=" + id + "></td>"
                + "<td>" + qReport[1] + "</td>"
                + "<td>" + qReport[2] + "</td>"
                + "<td>" + qReport[3] + "</td>"
                + "</tr>");
        }
    }

    function onPlaceSelection() {
        if (document.Table.PlaceSelector.value) {
            visitorPlace = getTimeByLocation(document.Table.PlaceSelector.value);
        } else {
            visitorPlace = "";
        }
    }

    function showclocks () {
        var GMT = GMTnow();
        document.Table.LocalTime.value = formatTime ( Into24hrs (GMT + GMToffset)) ;

        for (var i = 0; i < TableTimes.length; i++) {
            var item = TableTimes[i];
            document.Table[item[0]].value = formatTime ( Into24hrs (GMT+ item[1]))
        }

        if (visitorPlace) {
            document.getElementById("VisitorPlaceTime").value = formatTime ( Into24hrs (GMT+ visitorPlace[4]));
            document.getElementById("VisitorPlaceLocal").innerHTML = visitorPlace[1];
            document.getElementById("VisitorPlaceRelativeGmt").innerHTML = visitorPlace[2];
            document.getElementById("VisitorDst").innerHTML = visitorPlace[3];
        } else {
            document.getElementById("VisitorPlaceTime").value = "";
            document.getElementById("VisitorPlaceLocal").innerHTML = "";
            document.getElementById("VisitorPlaceRelativeGmt").innerHTML = "";
            document.getElementById("VisitorDst").innerHTML = "";
        }

        setTimeout("showclocks()", 1000);
    }
    //-->
</script>

<br>
<br>

<div class="text">
    <b><font color="#000000" face="Arial Black" size="5">TIME DIFFERENCE CALCULATOR</font></b>
    <br>
    <br>

    <form name="Table">
        <table border="0" cellpadding="10" cellspacing="2" width="100%" class="timediff">
        <thead>
            <tr>
                <td width="20%" bgcolor="#003366"><b><font color="#FFFFFF" face="Arial" size="2">Location</font></b></td>
                <td width="20%" bgcolor="#003366"><b><font color="#FFFFFF" face="Arial" size="2">Current Time</font></b></td>
                <td width="20%" bgcolor="#003366"><b><font color="#FFFFFF" face="Arial" size="2">Relative to Local</font></b></td>
                <td width="20%" bgcolor="#003366"><b><font color="#FFFFFF" face="Arial" size="2">Relative to GMT</font></b></td>
                <td width="20%" bgcolor="#003366"><b><font color="#FFFFFF" face="Arial" size="2">Daylight Savings?</font></b></td>
            </tr>
        </thead>
        <tbody>
            <tr class="timelocal">
                <td>Your Local Time:</td>
                <td><input type=text size=10 id=LocalTime name=LocalTime></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr valign="center">
                <td colspan="5" background="/img/dot_line.gif" height="8"><img src="/img/dot_line.gif" height="8"></td>
            </tr>
            <script>
                <!--
                writeTable();
                //-->
            </script>
            <tr valign="center">
                <td colspan="5" background="/img/dot_line.gif" height="8"><img src="/img/dot_line.gif" height="8"></td>
            </tr>
            <tr>
                <td>
                    <select name="PlaceSelector" onchange="onPlaceSelection()">
                        <option value="" selected>Select your location</option>
                        <option value="4.30%0">Afghanistan</option>
                        <option value="-3%0">Argentina</option>
                        <option value="9.30%4">Australia - Adelaide</option>
                        <option value="10%0">Australia - Brisbane</option>
                        <option value="9.30%0">Australia - Darwin</option>
                        <option value="10%4">Australia - Melbourne</option>
                        <option value="8%0">Australia - Perth</option>
                        <option value="10%5">Australia - Tasmania</option>
                        <option value="-4%0">Bolivia</option>
                        <option value="-5%1">Brazil - Andes</option>
                        <option value="-3%1">Brazil - East</option>
                        <option value="-4%1">Brazil - West</option>
                        <option value="6.30%0">Burma (Myanmar)</option>
                        <option value="-7%2">Canada - Calgary</option>
                        <option value="-3.30%2">Canada - Newfoundland</option>
                        <option value="-4%2">Canada - Nova Scotia</option>
                        <option value="-5%2">Canada - Quebec</option>
                        <option value="-5%2">Canada - Toronto</option>
                        <option value="-8%2">Canada - Vancouver</option>
                        <option value="-6%2">Canada - Winnipeg</option>
                        <option value="8%1">China - Mainland</option>
                        <option value="8%0">China - Taiwan</option>
                        <option value="-5%0">Colombia</option>
                        <option value="-5%1">Cuba</option>
                        <option value="2%1">Egypt</option>
                        <option value="2%3">Finland</option>
                        <option value="1%3">France</option>
                        <option value="1%3">Germany</option>
                        <option value="0%0">Ghana</option>
                        <option value="2%3">Greece</option>
                        <option value="5.30%0">India</option>
                        <option value="8%0">Indonesia - Bali, Borneo</option>
                        <option value="9%0">Indonesia - Irian Jaya</option>
                        <option value="7%0">Indonesia - Sumatra, Java</option>
                        <option value="3.30%1">Iran</option>
                        <option value="3%0">Iraq</option>
                        <option value="2%1">Israel</option>
                        <option value="-5%1">Jamaica</option>
                        <option value="3%0">Kenya</option>
                        <option value="9%0">Korea (North &amp; South)</option>
                        <option value="8%0">Malaysia</option>
                        <option value="-6%1">Mexico City</option>
                        <option value="0%0">Morocco</option>
                        <option value="5.45%0">Nepal</option>
                        <option value="12%6">New Zealand</option>
                        <option value="5%0">Pakistan</option>
                        <option value="-5%0">Peru</option>
                        <option value="8%0">Philippines</option>
                        <option value="1%3">Poland</option>
                        <option value="11%7">Russia - Kamchatka</option>
                        <option value="3%7">Russia - Moscow</option>
                        <option value="9%7">Russia - Vladivostok</option>
                        <option value="8%0">Singapore</option>
                        <option value="2%0">South Africa</option>
                        <option value="1%3">Spain</option>
                        <option value="1%3">Sweden</option>
                        <option value="7%0">Thailand</option>
                        <option value="12%0">Tonga</option>
                        <option value="2%3">Turkey</option>
                        <option value="3%1">Ukraine</option>
                        <option value="5%0">Uzbekistan</option>
                        <option value="7%0">Vietnam</option>
                        <option value="-9%2">USA - Alaska</option>
                        <option value="-5%2">USA - Atlanta</option>
                        <option value="-7%2">USA - Boulder</option>
                        <option value="-6%2">USA - Chicago</option>
                        <option value="-5%0">USA - East Indiana</option>
                        <option value="-10%0">USA - Hawaii</option>
                        <option value="-8%2">USA - Seattle</option>
                    </select>
                </td>
                <td><input type=text size=10 id=VisitorPlaceTime name=VisitorPlaceTime></td>
                <td><div id="VisitorPlaceLocal">&nbsp;</div></td>
                <td><div id="VisitorPlaceRelativeGmt">&nbsp;</div></td>
                <td><div id="VisitorDst">&nbsp;</div></td>
            </tr>
        </tbody>
    </table>
    </form>

</div>
<br>

<script language="JavaScript">
    <!--
    showclocks();
    -->
</script>

<?php require('./links.php'); ?>

<?php require('../includes/application_bottom.php'); ?>
