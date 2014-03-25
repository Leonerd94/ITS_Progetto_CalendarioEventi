<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <?
            require("ref.html");
        ?>
        <title>Festbook</title>

        <script lang="javascript">
            function asincronous() {

                prov = document.getElementById("txt_prov").value;
                com = document.getElementById("txt_com").value;
                date_begin = document.getElementById("date_from").value;
                date_end = document.getElementById("date_until").value;

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("center").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "query.php?prov="+prov+"&com="+com+"&date_begin="+date_begin+"&date_end="+date_end,true);
                xmlhttp.send();
            }
        </script>

    </head>
    <body>
        <div class="header sfum_ban">
            <div class="fleft" style="width: 18%;">
                <a href="index.php"><img src="img/banner.gif" alt="Home Festbook" height="40px"/></a>
            </div>
            
            <div class="fleft" style="width: 80%;">
                <div style="padding: 10px;">
                    <div class="label">
                        <input type="text" class="box" alt="Provincia" id="txt_prov" onchange="javascript:asincronous()" placeholder="Provincia"/>
                    </div>
                    <div class="label">
                        <input type="text" class="box" alt="Comune" id="txt_com" onchange="javascript:asincronous()" placeholder="Comune"/>
                    </div>
                    <div class="label">
                        <label for="date_from">Giorno inizio:</label>
                        <input type="date" class="box_date" alt="Giorno inizio" id="date_from" onchange="javascript:asincronous()"/>
                    </div>
                    <div class="label">
                        <label for="email">Giorno fine:</label>
                        <input type="date" class="box_date" alt="Giorno fine" id="date_until" onchange="javascript:asincronous()"/>
                    </div>
                </div>
            </div>
            <br style="clear: both;" />            
            <br style="clear: both;" />
        </div>
       
        <div class="sfum">
            <div id="centercolumn">
                <div id="center"  class="rounded bg_light">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.</p>
                </div>
            </div>

            <div id="rightcolumn">
                <div id="menu_dx" class="rounded bg_light">
                    <form action="user.php" method="get">
                        <fieldset class="rounded">
                            <legend>Entra e inserisci un evento!</legend>
                            <div class="fleft" style="width: 35%;">
                                <label for="email">Email</label>
                            </div>
                            <div class="fleft" style="width: 65%;">
                                <input id="email" type="email" placeholder="Email">
                            </div>
                            <div class="fleft" style="width: 35%;">
                                <label for="password">Password</label>
                            </div>
                            <div class="fleft" style="width: 65%;">
                                <input id="password" type="password" placeholder="Password">
                            </div>
                            <div class="fleft" style="width: 40%">
                                <button type="submit" class="button">Log in</button>
                            </div>
                            <div class="fleft"  style="width: 60%">
                                <button type="submit" class="button">Register me!</button>
                            </div>
                        </fieldset>
                    </form>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.</p>
                </div>
            </div>
        </div>
    </body>
</html>
