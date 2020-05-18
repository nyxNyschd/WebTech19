<?php
class DB {
	private $connection;

	/*
	 * der Konstruktor ist fertig
	 */
	public function __construct($name, $host = 'localhost', $user = 'root', $pass='') {
		try {
			$this->connection = new PDO ( "mysql:host=$host;dbname=$name;charset=utf8", $user, $pass );
			$this->connection->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
		} catch ( PDOException $exception ) {
			die ( $exception->getMessage () );
		}
	}

    /*
     * der Destruktor ist fertig
     */
	public function __destruct() {
		$this->connection = null;
	}

    /*
     * die Funktion all ist fertig: Deshalb werden die ganzen kacheln gezeigt
     */
	public function all() {
		$statement = $this->connection->query ( 'SELECT * FROM mockupdatatable ORDER BY nachname ASC' );
		return $statement->fetchAll ();
	}

	/*
	 * hier fehlt die SQL-Anfrage
	 */
	public function get($id) {
		$statement = $this->connection->prepare ( 'SELECT * FROM mockupdatatable WHERE id=:id' );
		                                                                     //id: benannter Parameter, hier muss ich das
                                                          //machen,weil es ein prepared statment ist, ich kann also nicht einfach
        //// einen string übergeben, sondern habe einen platzhalter, der an diese Variable geebunden ist
		$statement->bindParam ( ':id', $id, PDO::PARAM_INT );
		$statement->execute ();
		return $statement->fetch (); //das gibt uns einen eintrag zurück -fetch all: gibt alle aus
	}

	/*
	 * hier fehlt die SQL-Anfrage
	 */
	public function add(array $daten) { //fügt datensatz zur tabelle hinzu
		$statement = $this->connection->prepare (  'INSERT INTO mockupdatatable 
                                                    (vorname, nachname, email, ipnr)
                                                    VALUES (?, ?, ?, ?)' );
        return $statement->execute ( $daten );
	}

    /*
     * hier fehlt die SQL-Anfrage
     */
	public function edit(array $daten) { //Datensatz ändern, mit positionsabhängigem Parameter
	    //für das editieren und hinzufügen von parametern brauchen wir Formulare
	    //print_r($daten);
		$statement = $this->connection->prepare ( 'UPDATE mockupdatatable SET vorname=?, 
                                                            nachname=?, email=?, ipnr=? WHERE id=?' );
		return $statement->execute ( $daten );

        /* das hatte ich mal so überlegt...:
              $dbh= "UPDATE teilnehmerinnen SET vorname= 'vorname', name= 'name', email='email, ipnr='ipnr";
               mysqli_query($dbh, $teilnehmerin); //das ist zur Übermittlung der Daten
               */
	}

	/*
	 * die Funktion delete ist fertig
	 */
	public function delete($id) {
		$statement = $this->connection->prepare ( 'DELETE FROM mockupdatatable WHERE id = :id' );
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		return $statement->execute();
	}
}
?>