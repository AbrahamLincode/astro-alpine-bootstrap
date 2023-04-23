<?php

class DBConnect
{
    private $db = null;

    public function __construct()
    {
        $this->openDatabaseConnection();
    }
	
    private function openDatabaseConnection()
    {
        /* Aşağıdaki bağlantı şeklinde veriler Object olarak geri getirilir. $result->user_name gibi!..
         Veri çekme işleminde FETCH_ASSOC kullanılırsa veriler şu şekilde alınır: $result["user_name] !
		*/

        $options = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

        // PDO bağlayıcı ile veritabanı bağlantısının gerçekleştirilmesi
		try{
			$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
		}
		catch (PDOException $e){
			echo 'Failure: ' . $e->getMessage();
		}
    }
//
	protected function sql_exec ( $bindings, $sql=null ){
		// Argument shifting
		if ( $sql === null ) {
			$sql = $bindings;
		}

		$stmt = $this->db->prepare( $sql );
		//echo $sql;

		// Bind parameters
		if ( is_array( $bindings ) ) {
			for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) {
				$binding = $bindings[$i];
				$stmt->bindValue( $binding['key'], $binding['val'], $binding['type'] );
			}
		}

		// Execute
		try {
			$stmt->execute();
		}
		catch (PDOException $e) {
			$this->fatal( $e->getMessage() );
		}


		// Return all
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}	
 //------------------------------ Kullanılacak Fonksiyonlar ------------------
	// Insert,Delete,Update işlemlerinde
	public function sqlExec ($sql)
	{
		$stmt = $this->db->prepare( $sql );
		// Execute
		try {
			$stmt->execute();
			$stmt->closeCursor();
			return true;// işlem gerçekleştiyse
		}
		catch (PDOException $e) {
			//$this->fatal( $e->getMessage() );
			return false;
		}
	}		
	
	// SELECT Sql e bağlo olarak tablodaki bütün verileri getirmek
	public function fetchAllData($sql){
    $result = $this->conn->query($sql);
    if ($result === FALSE) {
        echo "Error: " . $sql . "<br>" . $this->conn->error;
        return [];
    }
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data;
}

		
	// SELECT Bir satır veri getirmek için
	public  function fetchData($sql){
		
		try{
			$dbSelect =  $this->db->prepare($sql);	
			$dbSelect->execute();
			$data=$dbSelect->fetch(PDO::FETCH_ASSOC);

			if($dbSelect->rowCount() <= 0){
				return false;
			}
			
			return $data;
			
		}catch(PDOException $e){
			return null;
		}				
	}

}