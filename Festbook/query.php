<?php
    $query = "select * from feste natural join comuni natural join province";
    

    if($_GET["prov"] != "" || $_GET["com"] != "" || $_GET["date_begin"] != "" || $_GET["date_end"] != "")
    {
        $query = $query." where ";
        // un parametro è settato
        $tmp = FALSE;
        if($_GET["prov"]!="") //aggiungo ricerca per provincia
        {
            $query .= " nomeprovincia = \"".$_GET["prov"]."\"";
            $tmp = TRUE;
        }
        if($_GET["com"]!="")
        {
            if($tmp)
                $query .= " and nomecomune = \"".$_GET["com"]."\"";
            else
                $query .= " nomecomune = \"".$_GET["com"]."\"";
            $tmp=TRUE;
        }
        if($_GET["date_begin"]!="")
        {
            if($tmp)
                $query .= " and da = \"".$_GET["date_begin"]."\"";
            else
                $query .= " da = \"".$_GET["date_begin"]."\"";
            $tmp=TRUE;
        }
        if($_GET["date_end"]!="")
        {
            if($tmp)
                $query .= " and a = \"".$_GET["date_end"]."\"";
            else
                $query .= " a = \"".$_GET["date_end"]."\"";
            $tmp=TRUE;
        }

        //echo $query;

        //collegamento al db
        $connessione = mysql_connect('localhost', 'root', '');

        if($connessione)
        {
            if(mysql_select_db('eventi', $connessione)){

                $res = mysql_query($query, $connessione);
                echo "<table>";
                echo "<thead>";
                echo "<tr>
                        <th>Nome evento</th>
                        <th>Descrizione evento</th>
                        <th>Provincia</th>
                        <th>Comune</th>
                        <th>Indirizzo</th>
                        <th>Data inizio</th>
                        <th>Data fine</th>
                        <th>Mail riferimento</th>
                        <th>Genere</th>
                    </tr>";
                echo "</thead>";
                echo "<tbody>";
                while($riga = mysql_fetch_assoc($res))
                {
                    echo "<tr>
                        <td>".$riga["nome"]."</td>
                        <td>".$riga["descrizione"]."</td>
                        <td>".$riga["nomeprovincia"]."</td>
                        <td>".$riga["nomecomune"]."</td>
                        <td>".$riga["via"]."</td>
                        <td>".date("d-m-Y", strtotime($riga["da"]))."</td>
                        <td>".date("d-m-Y", strtotime($riga["a"]))."</td>
                        <td>".$riga["mail"]."</td>
                        <td>".$riga["genere"]."</td>
                    </tr>";
                }
                echo "</tbody>";
                echo "<tfoot>";
                echo "</tfoot>";
                echo "</table>";

            }else die("Errore selezione del db".mysql_error());
            
        }
        else die("Errore di connessione al db");
        
        mysql_close($connessione);
    }



    
    
?>
