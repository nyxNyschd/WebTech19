<!doctype html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Formular</title>
   <link rel="stylesheet" href="bootstrap.min.css">
   <link rel="stylesheet" href="styles.css">
   <?php

   /* in der folgenden Datei steht mein Passwort für den MySQl-Server
    *  $passwd = 'meinPasswort';
    *
    */
   	require_once '../../nichtinzip/passwd.inc.php';
   	require_once('DB.php');

   	/* hier wird ein neues Objekt von DB erzeugt
   	 * erster Parameter ist der Name Ihrer Datenbank (auf dem Studi-Server _IhreMatrNr__mockupdatadb
   	 * , lokal wahrscheinlich nur mockupdatadb
   	 * zweiter Parameter ist der MySql-Server (Studi-Server db.f4.htw-berlin.de:3306
   	 * , lokal wahrscheinlich localhost
   	 * dritter Parameter ist Ihr Nutzername (vom MySQL-Server) (Studi-Server Ihr FB4-Account
   	 * , lokal wahrscheinlich root
   	 * vierter Parameter ist Ihr Passwort (ich habe mein Passwort als Wert der Variablen $password
   	 * in der Datei passwd.inc.pwd abgelegt (siehe oben)
   	 */
   	$dbh = new DB('_s0569853__mockupdatadb', 'db.f4.htw-berlin.de:3306', 's0569853', $passwd);

   	/* die folgende Funktion ist nur eine Hilfsfunktion zum Debuggen
   	 * auf der Konsole in den Entwicklertools Ihres Browsers erscheint
   	 * der als String übergebene Text
   	 * die Funktion kann auch gelöscht werden
   	 */
   function debug_to_console( $data ) {

       if ( is_array( $data ) )
           $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
       else
           $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

       echo $output;
   }
   ?>
</head>
<body>
	<?php
	   $form_header = 'Teilnehmerin hinzufügen';
	
	   if ($_GET) {
           $command=$_GET['command'];
           $id=$_GET['id'];
	      if ($command=='delete')
          {
              $dbh->delete($id);
          }

	      if($command=='edit')
          {
              $teilnehmerin = $dbh->get($id);


              /*print_r($teilnehmerin);  /*nur um zu gucken, obs funktioniert. "Ist jetzt hässlich", das wird dann ganz unstylisch
  da oben angezeigt, also der inhalt des arrays an dieser stelle, wo ich klicke. iiiigitt*/
          }


	         /*
             * es empfiehlt sich, an Ihre URL bei Absenden des Formulars ein "command" als Schlüssel anzuhängen,
             * welcher die Werte "edit" oder "delete" annehmen kann, je nachdem, ob Sie einen Datensatz
             * ändern oder löschen möchten
             * An den einzelnen "Karteikarten" erscheinen edit- und delete-"Buttons" - s.u.
             */
	   }
	
	   elseif ($_POST) {

	       $vorname = filter_var($_POST['vorname'], FILTER_SANITIZE_STRING);
	       $nachname= filter_var($_POST['nachname'], FILTER_SANITIZE_STRING);
           $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
           $ipnr = filter_var($_POST['ipnr'], FILTER_SANITIZE_STRING);


           /*iese Datensätze sind dazu da, um Datenzu ändern, über die Id kann ich dann die edit-funktion aufrufen */

	       if (isset($_POST['id']))
           {
               $id= filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

               $dbh->edit(array($vorname, $nachname, $email, $ipnr, $id));



           }
	       else
           {   $dbh->add(array($vorname, $nachname, $email, $ipnr));
     /*       $teilnehmerin = "INSERT INTO teilnehmerinnen(vorname, nachname, email, ipnr)" . "VALUES('vorname', 'nachname',
               'email','ipnr')";
               mysqli_query($dbh, $teilnehmerin); //das ist zur Übermittlung der Daten
     das steht auch alles in DB.php
     */



	       /*
             * hier werden die über das Formular gesendeten Daten ausgewertet
             * 2 Fälle: wird die id mitgesendet, dienen die übersendeten Daten der Änderung des
             * entsprechenden Datensatzes
             * wird die id nicht mitgeliefert, dienen die Daten dem Einfügen eines neuen Datensatzes
             * in die Datenbank
             */
	   }}
       // die folgenden drei Zeilen sind zum Testen --> können Sie jeweils auskommentieren, um zu testen
	   // $dbh->edit(array("Jan", "Justermann", "jan@justermann", "6789", 51));
	   // $dbh->add(array("Max", "Mustermann", "max@mustermann.de", "1234"));
       // $dbh->delete(51);
	   $teilnehmerinnen = $dbh->all();
	?>
   <div class="container">
      <div class="panel panel-default">

         <div class="panel-heading">
            <h3 class="panel-title"><?= $form_header ?></h3>
         </div>

         <div class="panel-body">

            <?php if (isset($message)) : ?>
               <div class="alert alert-success">
                  <?= $message ?>
               </div>
            <?php endif; ?>

            <?php if (isset($command) && $command == 'edit') : ?>

            <form role="form" action="aufgabe7.php" method="POST">
             <!--    method="POST" liest die folgenden 5 Werte (inkl. hidden id) ins Post-Array ein und schickt sie ab
             durch das abschicken (button type="submit") des Formulars ist dann das POST-array befüllt>

                  dies ist das Formular für die Änderung eines Datensatzes
                  es beinhaltet 4 einzeilige Textfelder: für Vornmae, Name, E-Mail-Adresse und IP-Nummer
                  beachten Sie: das Formular soll auch die id weitergeben (hidden-Textfeld)
                  beachten Sie: die Textfelder sind mit dem Datensatz, der editiert werden soll, vorausgefüllt
                  -> deshalb echo, was in $teilnehmerin[] gespeichert ist
             -->
                <input type="text" class="form-control" name="vorname" value="<?php echo $teilnehmerin['vorname']; ?>"/>
                       <!-- form-control ist eine bootstrap-klasse    $teilnehmerin hatten wir bei edit gespeichert-->
                <input type="text" class="form-control" name="nachname" value="<?php echo $teilnehmerin['nachname']; ?>"/>
                       <!-- attribut name ist wichtig für $_POST-Array. sind die schlüssel,
                       um im POST_Array auf den jeweiligen wert zuzugreifen -->
                <input type="text" class="form-control" name="email" value="<?php echo $teilnehmerin['email']; ?>"/>
                <input type="text" class="form-control" name="ipnr" value="<?php echo $teilnehmerin['ipnr']; ?>"/>
                  <!-- der witz beim editieren: wir kennen die id. die soll versteckt mitgeschickt werden   -->
                <input type="hidden" class="form-control" name="id" value=" <?php echo $teilnehmerin['id']; ?>"/>
                <button type="submit" class="btn btn-block btn-primary">Aktualisieren</button>
                <!-- die btn- Klasse ist auch bootstrap -->

            </form>

            <?php else : ?>
           	<div class="row">
           		<div class="col-xs-12">
            		<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <!--
                             dies ist das Formular für das Anlegen eines neuen Datensatzes
                             es beinhaltet 4 einzeilige Textfelder: für Vornmae, Name, E-Mail-Adresse und IP-Nummer
                             keine id - diese wird von der Datenbank selbständig erzeugt (auto inkrement)
                        -->

            		</form>
               	 </div>
             </div>
         <?php endif; ?>

         </div> <!-- / .panel-body -->
      </div> <!-- / .panel -->

      <div class="row">

         <?php
            if (!sizeof($teilnehmerinnen)) {
               echo '<div class="alert alert-info">Es sind keine Studentinnen angemeldet!</div>';
            }
            else {
               foreach ($teilnehmerinnen as $teilnehmerin)
               /*$teilnehmerin = $dbh->get(6);*/
               {
                  echo
                  '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                     <div class="thumbnail">
                        <p> '.$teilnehmerin["vorname"].' </p>
      					<h4> '.$teilnehmerin["nachname"].' </h4>
      		 			<p> '.$teilnehmerin["email"].' </p>
      					<p> '.$teilnehmerin["ipnr"].' </p>
                       
                        <div class="buttons-edit"> 
                       <!--  /* das sind die Mouseover-buttons, die sind im CSS in der Klasse .buttons-edit definiert,-->
                       <!-- *da ist visibility: hidden, aber generell ist diese Klasse-->
                       <!-- *wiederum teil der Klasse thumbnail, wo das hovern festgelegt ist*/-->
                        
                           <a class="btn btn-default btn-sm" href="./aufgabe7.php?command=edit&id='.$teilnehmerin["id"].'">Edit</a>
                         <!-- /* $teilnehmerin ist die Tabelle, die URL wird um das Schlüssel-Werte-paar erweitert, dadurch wird hier auch das $GET-array befüllt-->
                        <!-- *das mit der URL passiert auch, wenn wir das in das $GET-array schreiben, hier machen wirs direkt-->
                        <!-- *Schlüssel1: Command, Wert1: Edit , Schlüssel2:id, Wert='.$teilnehmerin["id"].'*/-->
                         
                           <a class="btn btn-default btn-sm" href="./aufgabe7.php?command=delete&id='.$teilnehmerin["id"].'">Delete</a>
                          <!-- /*funktioniert wie bei edit*/-->
                        </div>
                     </div>
                  </div>';
               }
            }
         ?>

      </div> <!-- / list-group -->
   </div> <!-- / .container -->
</body>
</html>