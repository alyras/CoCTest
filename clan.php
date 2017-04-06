
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        $clantag = "#R2JYV9CY";

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjUwZDY3ZjQ2LThlMTktNDBhYy1hZTk5LTFjYTg3ZTcxNGQwNiIsImlhdCI6MTQ5MTQxMTg3Miwic3ViIjoiZGV2ZWxvcGVyL2U0NDgzNDg0LWIzNjctODU3NS0wNjI2LTVhMTE0MzJkYWFkMSIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjc4Ljg3Ljc4LjEyIl0sInR5cGUiOiJjbGllbnQifV19.CnuPamqbmX5ibSbGRG9EonfP4W_O78a9Ko29CF9rA84AhKRrz6IT0soYpjq8HSaNT-G4xQZu31b2Nd62oPRLoQ";



        $url = "https://api.clashofclans.com/v1/clans/" . urlencode($clantag);

        $ch = curl_init($url);

        $headr = array();
        $headr[] = "Accept: application/json";
        $headr[] = "Authorization: Bearer " . $token;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);
        $data = json_decode($res, true);
        curl_close($ch);

        if (isset($data["reason"])) {
            $errormsg = true;
        }

        $members = $data["memberList"];
        ?>
        <title><?php echo $data["name"]; ?></title>
    </head>
    <body>
        <?php
        if (isset($errormsg)) {
            echo "<p>", "Failed: ", $data["reason"], " : ", isset($data["message"]) ? $data["message"] : "", "</p></body></html>";
            exit;
        }
        ?>
        <table border="1">
            <tr>
                <td rowspan="11">Clan level : <?php echo $data["clanLevel"]; ?><br/><img src="<?php echo $data["badgeUrls"]["medium"]; ?>" alt="<?php echo $data["name"]; ?>"/></td>
                <td><?php echo $data["name"]; ?></td><td><?php echo $data["tag"]; ?></td>
                <td rowspan="11"><?php echo $data["description"]; ?></td>
            </tr>
            <tr>
                <td>Total points</td><td><?php echo $data["clanPoints"]; ?></td>
            </tr>
            <tr>
                <td>Wars won</td><td><?php echo $data["warWins"]; ?></td>
            </tr>
            <tr>
                <td>War win streak</td><td><?php echo $data["warWinStreak"]; ?></td>
            </tr>
            <tr>
                <td>Members</td><td><?php echo $data["members"]; ?>/50</td>
            </tr>
            <tr>
                <td>Type</td><td><?php echo $data["type"]; ?></td>
            </tr>
            <tr>
                <td>Required trophies</td><td><?php echo $data["requiredTrophies"]; ?></td>
            </tr>
            <tr>
                <td>War frequency</td><td><?php echo $data["warFrequency"]; ?></td>
            </tr>
            <tr>
                <td>Clan location</td><td><?php echo $data["location"]["name"]; ?></td>
            </tr>
        </table>
        <table border="1">
            <?php
            foreach ($members as $member) {
                ?>
                <tr>
                    <td><?php echo $member["clanRank"], "(", $member["previousClanRank"], ")"; ?></td>
                    <td><?php echo urlencode($member["tag"]); ?></td>
                    <td><a href="member.php?tag=<?php echo urlencode($member["tag"]); ?>"> <img src="<?php echo $member["league"]["iconUrls"]["tiny"]; ?>" alt="<?php echo $member["league"]["name"]; ?>"/></a></td>
                    <td><?php echo $member["expLevel"]; ?></td>
                    <td><?php echo "<b>", $member["name"], "</b><br/>", $member["role"]; ?></td>
                    <td>Donated:<br/><?php echo $member["donations"]; ?></td>
                    <td>Received:<br/><?php echo $member["donationsReceived"]; ?></td>
                    <td><?php echo $member["trophies"]; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
