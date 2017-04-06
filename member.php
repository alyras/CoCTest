<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="scripts/jquery-1.3.2.debug.js" type="text/javascript"></script>
        <script src="json.htmTable.js" type="text/javascript"></script>
        <script src="scripts/json.debug.js" type="text/javascript"></script>
        <link href="styles/default.css" rel="stylesheet" type="text/css" />



    </head>
    <body>
        <?php
        $tag = $_GET['tag'];
        echo $tag;

        //$tag = substr_replace($tag, "#", 0, 0);
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjUwZDY3ZjQ2LThlMTktNDBhYy1hZTk5LTFjYTg3ZTcxNGQwNiIsImlhdCI6MTQ5MTQxMTg3Miwic3ViIjoiZGV2ZWxvcGVyL2U0NDgzNDg0LWIzNjctODU3NS0wNjI2LTVhMTE0MzJkYWFkMSIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjc4Ljg3Ljc4LjEyIl0sInR5cGUiOiJjbGllbnQifV19.CnuPamqbmX5ibSbGRG9EonfP4W_O78a9Ko29CF9rA84AhKRrz6IT0soYpjq8HSaNT-G4xQZu31b2Nd62oPRLoQ";

        $url = "https://api.clashofclans.com/v1/players/" . urlencode($tag);

        $ch = curl_init($url);
        $headr = array();
        $headr[] = "Accept: application/json";
        $headr[] = "Authorization: Bearer " . $token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        // echo $res;
        $data = json_decode($res, true);
        curl_close($ch);
//        echo "<pre>";
//        var_dump($data);
//        echo "</pre>";
//        
        ?>
        <form id="form1" >
            <div id="DynamicGrid" >
                <h3>    
                    <?php echo $data['name']; ?>
                    (    
                    <?php echo $data['tag']; ?>
                    )
                </h3>

            </div>
        </form>

        <script type="text/javascript">
            $(document).ready(function () {

                var json1 = <?php echo $res; ?>;
                $('#DynamicGrid').append(CreateTableView(json1.league, "lightPro", true)).fadeIn();
                $('#DynamicGrid').append(CreateTableView(json1.achievements, "lightPro", true)).fadeIn();
                $('#DynamicGrid').append(CreateTableView(json1.troops, "lightPro", true)).fadeIn();
                $('#DynamicGrid').append(CreateTableView(json1.heroes, "lightPro", true)).fadeIn();
                $('#DynamicGrid').append(CreateTableView(json1.spells, "lightPro", true)).fadeIn();


            });
        </script>
    </body>

</html>
