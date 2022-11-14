<?php
///vars config
$arrayDbConf['host'] = 'localhost';
$arrayDbConf['user'] = 'yespoint_Ef';
$arrayDbConf['pass'] = 'contraseña2001';
$arrayDbConf['name'] = 'yespoint_salav';
$arrayDbConf['table'] = 'catalogo_lubricantes';

//$ofset=$_GET['of'];
$ofset=0;


class MySqlBackupLite {

  private $host;
  private $user;
  private $pass;
  private $name;

  private $fileName = "mySqlBackup.txt";
  private $fileDir = "./";
  private $fileCompression = false;

  private $timeZone = '+00:00';

  private $mySqli;
  private $sqlString = "";
  private $arrayTables;

  private $tableFieldCount = 0;
  private $tableNumberOfRows = 0;
  private $queryResult;

private $table="";

  public function __construct(array $arrayConnConfig) {

      if (
        (!isset($arrayConnConfig['host'])) ||
        (!isset($arrayConnConfig['user'])) ||
        (!isset($arrayConnConfig['pass'])) ||
        (!isset($arrayConnConfig['name']))
      ) {
          throw new Exception('Missing connection data.');

      }
      $this->setHost($arrayConnConfig['host']);
      $this->setUser($arrayConnConfig['user']);
      $this->setPass($arrayConnConfig['pass']);
      $this->setName($arrayConnConfig['name']);
	  $this->setTable($arrayConnConfig['table']);
	  

  }



  public function backUp() {

    $this->connectMySql();
    $this->getTables();
  //  $this->generateSqlHeader();
    //$this->createTableStaments();
    $this->insertStaments();
   // $this->generateSqlFooter();

  }


 private function setTable($table) {
    $this->table = $table;
  }
  private function setHost($host) {
    $this->host = $host;
  }



  private function setUser($user) {
    $this->user = $user;
  }



  private function setPass($password) {
    $this->pass = $password;
  }



  private function setName($name) {
    $this->name = $name;
  }



  public function setFileName($name) {
    $this->fileName = $name;
  }



  public function setFileDir($dir) {
    $this->fileDir = $dir;
  }



  public function setFileCompression($compression) {
    $this->fileCompression = $compression;
  }



  private function connectMySql() {

    $this->mySqli = new mysqli($this->host, $this->user, $this->pass, $this->name);
    $this->mySqli->select_db($this->name);
    $this->mySqli->query("SET NAMES 'utf8'");

  }



  private function getTables() {

		
      $this->arrayTables[] =  $this->table;
    
    

  }



  private function generateSqlHeader() {

    $this->sqlString  = 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";' . "\r\n";
    $this->sqlString .= 'SET time_zone = "' . $this->timeZone . '";' . "\r\n\r\n\r\n";
    $this->sqlString .= '/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;' . "\r\n";
    $this->sqlString .= '/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;' . "\r\n";
    $this->sqlString .= '/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;' . "\r\n";
    $this->sqlString .= '/*!40101 SET NAMES utf8 */;' . "\r\n";
    $this->sqlString .= '--' . "\r\n";
    $this->sqlString .= '-- Database: `' . $this->name . '`' . "\r\n";
    $this->sqlString .= '--' . "\r\n\r\n\r\n";

    return;

  }



  private function createTableStaments() {

    foreach($this->arrayTables as $table){
      $this->sqlCreateTableStament($table);
    }

  }



  private function sqlCreateTableStament($table) {

    $res = $this->mySqli->query('SHOW CREATE TABLE '.$table);
    $temp = $res->fetch_row();
		$this->sqlString .= "\n\n" . str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `', $temp[1]) . ";\n\n";

  }



  private function insertStaments() {

    foreach($this->arrayTables as $table){
      $this->sqlInsertStaments($table);
    }

  }



  private function sqlInsertStaments($table) {

		$this->getTableData($table);

    if($this->tableFieldCount == 0) {
      return;
    }


    $i = 0;
		while($row = $this->queryResult->fetch_row())	{

      $this->insertResultHeader($table, $i);
      $this->insertSingleResult($row);

      $i++;
      $this->sqlString .= (($i != 0) && ($i % 10000 == 0) || ($i == $this->tableNumberOfRows)) ? ";" : ",";

		}

    $this->sqlString .= "";

  }



  private function getTableData($table) {
$ofset=0;
  	$this->queryResult	= $this->mySqli->query("SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,lubricante_roshfrans.Tipo_lubricante,'' as nombre,'0 a 60,000 kl' as km,opcion_0_60.opcion_1,
      opcion_0_60.opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id
        LEFT OUTER  JOIN (SELECT * FROM opcion)  as opcion_0_60 on opcion_0_60.id=lubricante_roshfrans.0_60k_id
        
        UNION ALL
        
        
        SELECT     catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,
        lubricante_roshfrans.Tipo_lubricante,'' as nombre,'61,000 a 100,000 kl' as km,opcion_61_100.opcion_1,opcion_61_100.opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id  
        LEFT OUTER  JOIN (SELECT * FROM opcion)  as opcion_61_100 on opcion_61_100.id=lubricante_roshfrans.61k_100k_id
        
        UNION ALL
        
        SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,lubricante_roshfrans.Tipo_lubricante,'' as nombre,'101,000 a 150,000 kl' as km,opcion_101_150.opcion_1,
        opcion_101_150.opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id
        LEFT OUTER  JOIN (SELECT * FROM opcion)  as opcion_101_150 on opcion_101_150.id=lubricante_roshfrans.101k_150k_id
        
        UNION ALL
        
        SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,lubricante_roshfrans.Tipo_lubricante,'' as nombre,'151,000 a 200,000 kl' as km,opcion_151_200.opcion_1,
        opcion_151_200.opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id
        LEFT OUTER  JOIN (SELECT * FROM opcion)  as opcion_151_200 on opcion_151_200.id=lubricante_roshfrans.151k_200k_id
        
        UNION ALL
        
        SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,lubricante_roshfrans.Tipo_lubricante,'' as nombre,'200,000 o mas kl' as km,opcion_200_mas.opcion_1,
        opcion_200_mas.opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id
        LEFT OUTER  JOIN (SELECT * FROM opcion)  as opcion_200_mas on opcion_200_mas.id=lubricante_roshfrans.200k_o_mas_id
        
        UNION ALL
        
        
        SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,fluido_de_frenos.Tipo_lubricante,'' as nombre,'' as km,opcion_frenos.opcion_1,opcion_frenos.opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id
        LEFT JOIN fluido_de_frenos on master_lubricantes.id_frenos= fluido_de_frenos.id
        LEFT OUTER  JOIN (SELECT * FROM opcion)  as opcion_frenos on opcion_frenos.id=fluido_de_frenos.opcion_id
        
        UNION ALL
        
        SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,refrigerante.Tipo_lubricante,'' as nombre,'0 a 200,000 kl' as km,opcion_refrijerante0a200.opcion_1,opcion_refrijerante0a200.opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id
        LEFT JOIN refrigerante on master_lubricantes.id_refrigerante= refrigerante.id
        LEFT OUTER  JOIN (SELECT * FROM opcion)  as opcion_refrijerante0a200 on opcion_refrijerante0a200.id=refrigerante.0_200k_id
        
        
        UNION ALL
        
        SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,refrigerante.Tipo_lubricante,'' as nombre,'200,000 0 mas kl' as km,opcion_refrijerante200omas.opcion_1,opcion_refrijerante200omas.opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id
        LEFT JOIN refrigerante on master_lubricantes.id_refrigerante= refrigerante.id
        LEFT OUTER  JOIN (SELECT * FROM opcion)  as opcion_refrijerante200omas on opcion_refrijerante200omas.id=refrigerante.200k_o_mas_id
        
        UNION ALL
        
        SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,aditivo_sistema_inyeccion.Tipo_lubricante,'' as nombre,'' as km,opcion_inyeccion.opcion_1,opcion_inyeccion.opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id
        LEFT JOIN aditivo_sistema_inyeccion on master_lubricantes.id_aditivo_inyeccion= aditivo_sistema_inyeccion.id
        LEFT OUTER  JOIN (SELECT * FROM opcion)  as opcion_inyeccion on opcion_inyeccion.id=aditivo_sistema_inyeccion.opcion_id
        
        UNION ALL
        
        
        SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,grasa_baleros.Tipo_lubricante,grasa_baleros.nombre,'' as km,'' as opcion_1,'' as opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id
        LEFT JOIN grasa_baleros on master_lubricantes.id_grasa_baleros= grasa_baleros.id
        
        
        
        UNION ALL
        
        
        SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,grasa_chasi.Tipo_lubricante,grasa_chasi.nombre,'' as km,'' as opcion_1,'' as opcion_2
        FROM master_lubricantes
        LEFT JOIN catalogo_lubricantes on master_lubricantes.id_cat_lubricantes= catalogo_lubricantes.id
        LEFT JOIN lubricante_roshfrans on master_lubricantes.id_lubricante=lubricante_roshfrans.id
        LEFT JOIN grasa_chasi on master_lubricantes.id_grasa_chasis= grasa_chasi.id");
    $this->tableFieldCount = $this->queryResult->field_count;
    $this->tableNumberOfRows = $this->mySqli->affected_rows;

  }



  private function insertResultHeader($table, $currentRowNumber) {

  	if ($currentRowNumber % 10000 == 0 || $currentRowNumber == 0 )	{
      $this->sqlString .= "INSERT INTO " . $table . " VALUES";
    }

  }



  private function insertSingleResult($row) {

    $this->sqlString .= "(";

    for($i = 0; $i < $this->tableFieldCount; $i++){

      $row[$i] = str_replace("","", addslashes($row[$i]));

      $this->sqlString .= (isset($row[$i])) ? '"'.$row[$i].'"' : '""';
      if($i < ($this->tableFieldCount-1)){
        $this->sqlString.= ',';
      }

    }

    $this->sqlString .=")";

  }



  private function generateSqlFooter() {

    $this->sqlString .=  "\r\n\r\n";
    $this->sqlString .=  '/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;';
    $this->sqlString .=  "\r\n";
    $this->sqlString .=  '/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;';
    $this->sqlString .=  "\r\n";
    $this->sqlString .=  '/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;';

  }



  public function downloadFile() {

      ob_get_clean();
      header('Content-Type: application/octet-stream');
      header("Content-Transfer-Encoding: Binary");
      header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($this->sqlString, '8bit'): strlen($this->sqlString)) );
      header("Content-disposition: attachment; filename=\"".$this->fileName."\"");
    	echo $this->sqlString; exit;

  }



  public function saveToFile() {

    if (!$backupFile = fopen($this->fileDir . $this->fileName, "w+")) {
        throw new Exception('Imposible to create file.');
    }
    fwrite($backupFile, $this->sqlString);
    fclose($backupFile);

  }


}
/////fin de la clase
try {

    
  $nombrearchivo= $_GET['nombre'];

  $bck = new MySqlBackupLite($arrayDbConf);
  $bck->backUp();
  $bck->setFileDir('');
  $bck->setFileName('backuplubricantes.txt');
  $bck->saveToFile();
  
  $zip = new ZipArchive;
  $date=date('D _ F _ Y_h_i_s_A');

  $tmp_file = 'manchaslubricantes_'.$nombrearchivo.'.zip';
  $files = glob('manchaslubricantes_'.$nombrearchivo.'.zip'); //obtenemos todos los nombres de los ficheros

    foreach($files as $file){
        if(is_file($file))
        unlink($file); //elimino el fichero
    }
    if ($zip->open($tmp_file,  ZipArchive::CREATE)) {
        $zip->addFile('backuplubricantes.txt');
       
        $zip->close();
         ob_get_clean();
        header('Content-disposition: attachment; filename='.$tmp_file.'');
        header('Content-type: application/zip');
        readfile($tmp_file);
   } else {
       echo 'Failed!';
   }
  
  

}
catch(Exception $e) {

  echo $e;

}

?>
