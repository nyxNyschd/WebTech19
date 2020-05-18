<!DOCTYPE html>
<html lang="de">
<head>
    <title> Grundger&uuml;st </title>
    <meta charset=utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <?php
    // hier können Sie Funktionen definieren
    function abschneiden($zahl, $stellen)
    {
       // $tableSpalten = array ("Zufallszahl"=>$zahl);


        for ($i=1; $i<=$stellen;$i++)
        {
            $base = pow(10,$i);
            $result= $zahl-($zahl % $base);
            //array_push($tableSpalten, $result);
            //echo "<th>'gerundet' . $i </th> </br>";

            if ($result<100)
            {
                echo "<td id='tens'>$result</td> </br>";
            }
            elseif ($result >100 && $result <1000)
            {
                echo "<td id='hun'>$result</td> </br>";
            }
            elseif ($result >1000 && $result <10000)
            {
                echo "<td id='tau'>$result</td> </br>";
            }
            else
            {
                echo "<td id='huge'>$result</td> </br>";
            }
        }


    }
    // pow ( number $base , number $exp ) : number
    //Berechnet die Potenz von exp zur Basis base. Also base=10, exp= 2: resultat = 10*10=100
    //die Funktion abschneiden rundet die Stellen VON RECHTS: also 19234 wären 0 Stellen, 19200 2 und 19000 3 Stellen

    function zufzahl($max, $anzahl, $stellen)
    {
        $zzahl = rand(1,$max);
        echo '<table class= "table table-hover table-striped table-responsive"> <thead> <tr>';
               for($i=1; $i<=$anzahl; $i++)
        {
            echo'<tr>';
            abschneiden($zzahl, $stellen);

          //  $gerundet2 = abschneiden($zzahl, 2);
          //  $gerundet3 = abschneiden($zzahl, 3);

            echo '</tr>';

          // $zzahl $gerundet2 $gerundet3 <br/>;
        }
    }
    // oder auch php-Dateien einbinden (mit include oder require)
    ?>
</head>
<body>
    <h1>Zufallszahlen</h1>
    <div>
        <?php zufzahl(20000, 20, 4); ?>
    </div>



</body>
</html>

