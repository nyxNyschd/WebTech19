<!DOCTYPE html>
<html>
  <head>
      <link href="../../Aufgaben/styles/styles5.css" rel="stylesheet">
    <?php

    function abschneiden($zahl, $stellen)
    {
       for ($i=1; $i<=$stellen;$i++)
        {
            $base = pow(10,$i);
            $result= $zahl-($zahl % $base);
           // echo "<td>$result</td> </br>";
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
    ?>

  </head>
  <body>
    <div>
      <h1>Zufallszahlen</h1>

          <table>

              <?php function zufzahl($max, $anzahl, $stellen)
              {  echo"<tr>";                                   //das ist die erste Zeile
                     echo"<th scope='col'>Zufallszahl</th>";  //der erste Eintrag ist immer gleich
                     for ($i=1; $i<=$stellen; $i++)
                     {
                         echo "<th scope ='col'>gerundet $i</th> ";
                     }
                 echo "</tr>";

                  for ($j=1; $j<=$anzahl;$j++) //hierbei geht´s um die rows ($anzahl gibt an, wieviel zeilen)
                  {
                      echo "<tr>";
                      $zzahl = rand(1,$max);

                      //jetzt kommen die cols
                      if ($zzahl<100)
                      {
                          echo "<td id='tens'>$zzahl</td> </br>";
                      }
                      elseif ($zzahl >100 && $zzahl <1000)
                      {
                          echo "<td id='hun'>$zzahl</td> </br>";
                      }
                      elseif ($zzahl >1000 && $zzahl <10000)
                      {
                          echo "<td id='tau'>$zzahl</td> </br>";
                      }
                      else
                      {
                          echo "<td id='huge'>$zzahl</td> </br>";
                      }
                     // echo "<td> $zzahl</td>"; //1. Spalte: gibt zu anfang der Zeile die ungerundete Zufallszahl aus

                      $data= abschneiden($zzahl,$stellen); //erzeugung der gerundeten Spalten
                      for ($k=1; $k<=$stellen; $k++)
                      {
                          echo $data;  //hier muss ich nicht angeben, dass es sich um <td> handelt, weil das schon in
                                      //der Funktion abschneiden passiert. wären sonst doppelte Anzahl Spalten
                      }
                      echo "</tr><br/>";

                  }

              } ?>
                  <tr>
                      <?php zufzahl(20000, 15, 3);   ?>
                <!-- und hier kommt dann der Aufruf der Methode -->
                  </tr>
          </table>
      </div>

  </body>
</html>