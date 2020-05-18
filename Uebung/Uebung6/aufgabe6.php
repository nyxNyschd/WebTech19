<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <title>Aufgabe 6</title>
    <?php
    require_once "./mockdataarray.php";
    ?>
</head>
<body>

<div class="container">
    <h1>Teilnehmerinnen</h1>
    <?php

    /*

        in diesem php-Tag könnten Sie stattdessen prüfen, ob das $_GET-Array
        oder das $_POST-Array befüllt ist
        falls $_GET-Array, dann Formular mit den passenden Werten
     echo $_GET['id']; /*get-array auslesen und in die variable id speichern*/

    if (isset($_GET['id'])) :
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        echo "
        <form action = './aufgabe6.php' method='post'>
        
        <div class='form-group row'>
            <label for='vorname' class='col-2'>Vorname</label>
            <div class='col-18'>
                <input type='text' class='form-control' name='vorname' value='".$members[$id][0]."'/>
            </div>
        </div>
        
        <div class='form-group row'>
             <label for='name' class='col-2'>Name</label>
             <div class='col-18'>
                 <input type='text' class='form-control' name='name'  value='".$members[$id][1]."'/>
             </div>      
        </div>
        
        <div class='form-group row'>
            <label for='email' class='col-2'>Email</label>
            <div class='col-18'>
                <input type='text' class='form-control' name='email' value='".$members[$id][2]."'/>
            </div>
                
        </div>
        <input type='hidden' name='id' value='\" . $id . \"'>
        
        <button type='submit'>Save changes</button>
        </form>
        ";
    else:
    if(isset($_POST['id'])):  /*falls $_POST-Array, dann das Array ändern und in die Datei schreiben*/
    $id = $_POST['id'];
    $vorname= filter_var($_POST['vorname'],FILTER_SANITIZE_STRING);
    $nachname= filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email= filter_var($_POST['email'],FILTER_SANITIZE_STRING);

    //dann dem $members-array hinzufügen:
    $members[$id][0]= $vorname;
    $members[$id][1]= $nachname;
    $members[$id][2]= $email;

    //und jetzt in die datei "mockdataarray.php" schreiben
    $datei=fopen("./mockdataarray.php","r+"); //datei öffnen mit lese- PLUS schreibrechten
    $output='<?php $members='.var_export($members,true).'; ?>';
    fwrite($datei, $output);
    fclose($datei);

    endif;
    ?>

    <table class="table table-striped table-responsive">
        <thead>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>E-Mail</th>
        <th>Edit</th>
        </thead>
        <tbody>
        <!-- hier die einzelnen Zeilen einfügen
             jede Zeile ist ein Array aus dem 2-dimensionalen
             $members-Array
             -->
        <?php
        /* meine Lösung mit for-SChleife:
        for ($id = 0; $id < count($members); $id++) {
            echo "<tr>";

            for ($col = 0; $col < count($members[$id]); $col++) {
                echo '<td>' . $members[$id][$col] . '</td>';
                echo "<td> <a href='./aufgabe6.php?id=" . $id . "'>edit<a/></td>";

            echo "</tr>";
        }

            } */

        foreach ($members as $id=> $member)
        {
            echo "<tr>";
            echo "<td>".$member[0]."</td>";
            echo "<td>".$member[1]."</td>";
            echo "<td>".$member[2]."</td>";
            echo "<td> <a href='./aufgabe6.php?id=".$id."'>Edit</a> </td>";
            echo "<tr>";
        }

        ?>
        </tbody>
    </table>
    <?php
    endif;
    ?>
</div>
</body>
</html>
