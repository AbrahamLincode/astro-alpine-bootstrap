<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once("config.php");
require_once("dbconnect.php");

class VeriKontrol {
    private $mysqlCon;

    public function __construct(){
        $this->mysqlCon=new DBConnect();
    }
    
    public function filo(){
        $sql="SELECT marka,model,model_yili,kilometre,fiyat FROM filo";
        $data=$this->mysqlCon->fetchAllData($sql);

        echo json_encode($data);
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : null;

$vGetir= new VeriKontrol();

if ($action === 'filo') {
    $vGetir->filo();
}else {
    echo json_encode(['error' => 'Geçersiz action parametresi.']);
}
