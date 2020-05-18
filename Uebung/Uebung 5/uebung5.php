<!DOCTYPE html>
<html lang="de">
<head>
    <title> Grundger&uuml;st </title>
    <meta charset=utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <?php
    // hier können Sie Funktionen definieren
    function abschneiden($zahl, $stellen=2)
    {
        $base = pow(10,$stellen);
        return $zahl-($zahl % $base);
    }
    // pow ( number $base , number $exp ) : number
    //Berechnet die Potenz von exp zur Basis base. Also base=10, exp= 2: resultat = 10*10=100
    //die Funktion abschneiden rundet die Stellen VON RECHTS: also 19234 wären 0 Stellen, 19200 2 und 19000 3 Stellen

    function zufzahl($max, $anzahl)
    {
        echo '<table class= "table table-hover table-responsive"> <thead> <tr>';
               for($i=1; $i<=$anzahl; $i++)
        {
            echo'<tr>';
            $zzahl = rand(1,$max);
            $gerundet2 = abschneiden($zzahl, 2);
            $gerundet3 = abschneiden($zzahl, 3);

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
        <?php zufzahl(20000, 20); ?>
    </div>



</body>
</html>

