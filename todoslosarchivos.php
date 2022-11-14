<?php
///vars config
set_time_limit(3600);
ini_set('memory_limit', '9999999999999G');
ini_set('max_execution_time', 3600);
ini_set('max_input_time', 3600);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$arrayDbConf['host'] = 'localhost';
$arrayDbConf['user'] = 'yespoint_Ef';
$arrayDbConf['pass'] = 'contraseña2001';
$arrayDbConf['name'] = 'yespoint_salav';
$arrayDbConf['table'] = 'inventarioo';

//$ofset=$_GET['of'];
$ofset = 0;


class MySqlBackupLite
{

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
    private $cantij = 0;
    public $table = "";







    public function __construct()
    {

        $arrayConnConfig['host'] = 'localhost';
        $arrayConnConfig['user'] = 'yespoint_Ef';
        $arrayConnConfig['pass'] = 'contraseña2001';
        $arrayConnConfig['name'] = 'yespoint_salav';
        $arrayConnConfig['table'] = 'inventarioo';

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

    public function zipcreation($usuario, $sucursal)
    {


        $arrayDbConf['host'] = 'localhost';
        $arrayDbConf['user'] = 'yespoint_Ef';
        $arrayDbConf['pass'] = 'contraseña2001';
        $arrayDbConf['name'] = 'yespoint_salav';
        $arrayDbConf['table'] = 'inventarioo';
        /////fin de la clase
        try {

            $suc = $sucursal; 
            $nombrearchivo = $usuario."_".$suc;
           
            $mySqli = new mysqli('localhost', 'yespoint_Ef', 'contraseña2001', 'yespoint_salav');
            $mySqli->select_db('yespoint_salav');
            $mySqli->query("SET NAMES 'utf8'");
            $tabla="SELECT count(id) FROM `inventarioos$suc` where sucursal_id=$suc";
            $cantij  = $mySqli->query("SELECT count(id) FROM `inventarioos$suc` where sucursal_id=$suc");

            $cantidadhcj = $cantij->fetch_row();
            $cantidad = $cantidadhcj[0];
            $cantidaddiv = ceil($cantidad) / 100000;


            $canidaincrementable = 0;
            $nombresdescript = array();
            $contadordenombres = 0;
            $iuni = 0;
            for ($i = 0; $i < $cantidaddiv; $i++) {
                $inventarioll = "inventario";
                $bck = new MySqlBackupLite($arrayDbConf);
                $bck->backUp($canidaincrementable, $suc, $inventarioll);
                $bck->setFileDir('');
                $canidaincrementable = $canidaincrementable + 100000;
                $bck->setFileName('backupFileinventario' . $i + 1 . '.txt');
                $nombresdescript[$iuni] = 'backupFileinventario' . $i + 1 . '.txt';
                $bck->saveToFile();
                $contadordenombres++;
                $iuni++;
            }
            $cantijprod  = $mySqli->query('SELECT count(*) FROM `consulta`');
            $cantidadhcjprod = $cantijprod->fetch_row();
            $cantidadpdr = $cantidadhcjprod[0];
            $cantidaddivprods = ceil($cantidadpdr / 100000);
            $canidaincrementableprdo = 0;

            for ($i = 0; $i < $cantidaddivprods; $i++) {
                $inventarioll = "consulta";
                $bck = new MySqlBackupLite($arrayDbConf);
                $bck->backUp($canidaincrementableprdo, $suc, $inventarioll);
                $bck->setFileDir('');
                $canidaincrementableprdo = $canidaincrementableprdo + 100000;
                $bck->setFileName('backupFile' . $i + 1 . '.txt');

                $nombresdescript[$iuni] = 'backupFile' . $i + 1 . '.txt';
                $bck->saveToFile();
                $iuni++;
            }

            $cantijquimicos  = $mySqli->query('SELECT count(*) FROM `quimicos`');
            $cantidadhcjquimi = $cantijquimicos->fetch_row();
            $cantidadpquimi = $cantidadhcjquimi[0];
            $cantidaddivquimic = ceil($cantidadpquimi / 100000);
            $canidaincrementablequimicos = 0;

            for ($i = 0; $i < $cantidaddivquimic; $i++) {
                $inventarioll = "quimicos";
                $bck = new MySqlBackupLite($arrayDbConf);
                $bck->backUp($canidaincrementablequimicos, $suc, $inventarioll);
                $bck->setFileDir('');
                $canidaincrementablequimicos = $canidaincrementablequimicos + 100000;
                $bck->setFileName('backupquimicos' . $i + 1 . '.txt');

                $nombresdescript[$iuni] = 'backupquimicos' . $i + 1 . '.txt';
                $bck->saveToFile();
                $iuni++;
            }

            $cantijlubricantes  = $mySqli->query('SELECT count(*) FROM `lubricante`');
            $cantidadhcjlubricantes = $cantijlubricantes->fetch_row();
            $cantidadplubri = $cantidadhcjlubricantes[0];
            $cantidaddivlubri = ceil($cantidadplubri / 100000);
            $canidaincrementablelubri = 0;

            for ($i = 0; $i < $cantidaddivlubri; $i++) {
                $inventarioll = "lubricante";
                $bck = new MySqlBackupLite($arrayDbConf);
                $bck->backUp($canidaincrementablelubri, $suc, $inventarioll);
                $bck->setFileDir('');
                $canidaincrementablelubri = $canidaincrementablelubri + 100000;
                $bck->setFileName('backuplubricantes' . $i + 1 . '.txt');

                $nombresdescript[$iuni] = 'backuplubricantes' . $i + 1 . '.txt';
                $bck->saveToFile();
                $iuni++;
            }

            $zip = new ZipArchive;
            $tmp_file = $nombrearchivo . '.zip';

            $files = glob($tmp_file); //obtenemos todos los nombres de los ficheros
            foreach ($files as $file) {
                if (is_file($file))
                    unlink($file); //elimino el fichero
            }


            if ($zip->open($tmp_file,  ZipArchive::CREATE)) {

                for ($i = 0; $i < $iuni; $i++) {
                    $zip->addFile($nombresdescript[$i]);
                }



                $zip->close();
                /*
                ob_get_clean();
                header('Content-disposition: attachment; filename=' . $tmp_file);
                header('Content-type: application/zip');
                readfile($tmp_file);*/
            } else {
                echo 'Failed!';
            }
        } catch (Exception $e) {

            echo $e;
        }
    }


    public function backUp($numjk, $suc, $inventarioll)
    {

        $this->connectMySql();
        $this->getTables();
        //  $this->generateSqlHeader();
        //$this->createTableStaments();
        $this->insertStaments($numjk, $suc, $inventarioll);
        // $this->generateSqlFooter();

    }


    private function setTable($table)
    {
        $this->table = $table;
    }
    private function setHost($host)
    {
        $this->host = $host;
    }



    private function setUser($user)
    {
        $this->user = $user;
    }



    private function setPass($password)
    {
        $this->pass = $password;
    }



    private function setName($name)
    {
        $this->name = $name;
    }



    public function setFileName($name)
    {
        $this->fileName = $name;
    }



    public function setFileDir($dir)
    {
        $this->fileDir = $dir;
    }



    public function setFileCompression($compression)
    {
        $this->fileCompression = $compression;
    }



    private function connectMySql()
    {

        $this->mySqli = new mysqli($this->host, $this->user, $this->pass, $this->name);
        $this->mySqli->select_db($this->name);
        $this->mySqli->query("SET NAMES 'utf8'");
    }



    private function getTables()
    {


        $this->arrayTables[] =  $this->table;
    }



    private function generateSqlHeader()
    {

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



    private function createTableStaments()
    {

        foreach ($this->arrayTables as $table) {
            $this->sqlCreateTableStament($table);
        }
    }



    private function sqlCreateTableStament($table)
    {

        $res = $this->mySqli->query('SHOW CREATE TABLE ' . $table);
        $temp = $res->fetch_row();
        $this->sqlString .= "\n\n" . str_ireplace('CREATE TABLE `', 'CREATE TABLE IF NOT EXISTS `', $temp[1]) . ";\n\n";
    }



    private function insertStaments($numjk, $suc, $inventarioll)
    {

        foreach ($this->arrayTables as $table) {
            $this->sqlInsertStaments($table, $numjk, $suc, $inventarioll);
        }
    }



    private function sqlInsertStaments($table, $numjk, $suc, $inventarioll)
    {

        $this->getTableData($table, $numjk, $suc, $inventarioll);

        if ($this->tableFieldCount == 0) {
            return;
        }


        $i = 0;
        while ($row = $this->queryResult->fetch_row()) {

            $this->insertResultHeader($table, $i, $inventarioll, $suc);
            $this->insertSingleResult($row);

            $i++;
            $this->sqlString .= (($i != 0) && ($i % 10000 == 0) || ($i == $this->tableNumberOfRows)) ? ";" : ",";
        }

        $this->sqlString .= "";
    }



    private function getTableData($table, $numjk, $suc, $inventarioll)
    {
        $ofset = $numjk;

        if ($inventarioll == "inventario") {

            $this->queryResult    = $this->mySqli->query("SELECT * FROM inventarioos$suc  limit  $ofset,100000");
            $this->tableFieldCount = $this->queryResult->field_count;
            $this->tableNumberOfRows = $this->mySqli->affected_rows;
        }
        if ($inventarioll == "consulta") {

            $this->queryResult    = $this->mySqli->query("SELECT * FROM consulta  limit  $ofset,100000");
            $this->tableFieldCount = $this->queryResult->field_count;
            $this->tableNumberOfRows = $this->mySqli->affected_rows;
        }
        if ($inventarioll == "quimicos") {

            $this->queryResult    = $this->mySqli->query("SELECT * FROM quimicos  limit  $ofset,100000");
            $this->tableFieldCount = $this->queryResult->field_count;
            $this->tableNumberOfRows = $this->mySqli->affected_rows;
        }
        if ($inventarioll == "lubricante") {

            $this->queryResult    = $this->mySqli->query("SELECT * FROM lubricante  limit  $ofset,100000");
            $this->tableFieldCount = $this->queryResult->field_count;
            $this->tableNumberOfRows = $this->mySqli->affected_rows;
        }
    }





    private function insertResultHeader($table, $currentRowNumber, $inventarioll, $suc)
    {

        if ($inventarioll == "inventario") {

            if ($currentRowNumber % 10000 == 0 || $currentRowNumber == 0) {
                $this->sqlString .= "INSERT INTO inventarioo VALUES";
            }
        }
        if ($inventarioll == "consulta") {
            if ($currentRowNumber % 10000 == 0 || $currentRowNumber == 0) {
                $this->sqlString .= "INSERT INTO consulta VALUES";
            }
        }
        if ($inventarioll == "quimicos") {
            if ($currentRowNumber % 10000 == 0 || $currentRowNumber == 0) {
                $this->sqlString .= "INSERT INTO quimicos VALUES";
            }
        }
        if ($inventarioll == "lubricante") {
            if ($currentRowNumber % 10000 == 0 || $currentRowNumber == 0) {
                $this->sqlString .= "INSERT INTO lubricante VALUES";
            }
        }
    }



    private function insertSingleResult($row)
    {

        $this->sqlString .= "(";

        for ($i = 0; $i < $this->tableFieldCount; $i++) {

            $row[$i] = str_replace("", "", addslashes($row[$i]));

            $this->sqlString .= (isset($row[$i])) ? '"' . $row[$i] . '"' : '""';
            if ($i < ($this->tableFieldCount - 1)) {
                $this->sqlString .= ',';
            }
        }

        $this->sqlString .= ")";
    }



    private function generateSqlFooter()
    {

        $this->sqlString .=  "\r\n\r\n";
        $this->sqlString .=  '/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;';
        $this->sqlString .=  "\r\n";
        $this->sqlString .=  '/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;';
        $this->sqlString .=  "\r\n";
        $this->sqlString .=  '/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;';
    }



    public function downloadFile()
    {

        ob_get_clean();
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header('Content-Length: ' . (function_exists('mb_strlen') ? mb_strlen($this->sqlString, '8bit') : strlen($this->sqlString)));
        header("Content-disposition: attachment; filename=\"" . $this->fileName . "\"");
        echo $this->sqlString;
        exit;
    }



    public function saveToFile()
    {

        if (!$backupFile = fopen($this->fileDir . $this->fileName, "w+")) {
            throw new Exception('Imposible to create file.');
        }
        fwrite($backupFile, $this->sqlString);
        fclose($backupFile);
    }
}
