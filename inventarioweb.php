<?php

class inventarioweb
{
    public function invWeb($location,$request,$header,$action)
    {


        //inicia obtencion de token para usuarios
    
        set_time_limit(999999999);
        ini_set('memory_limit', '9999999999999G');
        

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
    
    $conf = include('Config/config.php');
    
   $hostname = $conf['hostname'];
    $username = $conf['username'];
    $password = $conf['password'];
    $db = $conf['bd'];
    
    $con = mysqli_connect($hostname, $username, $password,$db);
    
    if (!$con)
    {
      echo "Failed to establish connection";
    }
    else{
        echo "conexion exitosa";
    }
        //............................................................................................................
        //inicia obtencion de token
     
    
        $ch = curl_init($location);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    
        $response = curl_exec($ch);
        $err_status = curl_errno($ch);
    
       
        
        $tokenob= $response;
    
        echo "El token obtenido para inventario es: ".$tokenob."<br>";
        $texto = $tokenob;
        $string1 = explode ( ' ', $texto );
    
        
        $i=0;
        $palabra1="";
        foreach ( $string1 as $palabra ) {
            $i++;
            
            if($i==13){
                $palabra1= $palabra;
            }
           
        }
       
      
    
    $texto2 = $palabra1;
    $string2 = explode ( '>', $texto2 );
    
    $tokenfin="";
    $ia=0;
    foreach ( $string2 as $palabra2 ) {
        $ia++;
        
        if($ia==2){
            $tokenfin= $palabra2;
            
        }
            
        
           
    }
    
    $texto3 = $tokenfin;
    $string3 = explode ( '<', $texto3 );
    $tokenfinfin="";
    $iad=0;
    foreach ( $string3 as $palabra3 ) {
        $iad++;
        
        if($iad==1){
            $tokenfinfin= $palabra3;
            
        }
            
        
           
    }
    
    
        
        //............................................................................................................
        //inicia obtencion de inventario
    
    
       
    
        $requestinventarios="   
        <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:wsc=\"WSConsultas\">
        <soapenv:Header/>
        <soapenv:Body>
        <wsc:Consultas.INVENTARIOS>
        <wsc:Token>$tokenfinfin</wsc:Token>
        </wsc:Consultas.INVENTARIOS>
        </soapenv:Body>
        </soapenv:Envelope>    
        ";
            
     
        
    
    
        $actioninventario="Consultas.INVENTARIOS";
    
        $headerinventario=[
            'Method: POST',
            'Connection: Keep-Alive',
            'User-Agent: PHP-SOAP-CURL',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: Consultas.INVENTARIOS',
        ];
        $chinventario = curl_init($location);
        curl_setopt($chinventario, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chinventario, CURLOPT_HTTPHEADER, $headerinventario);
        curl_setopt($chinventario, CURLOPT_POST, true);
        curl_setopt($chinventario, CURLOPT_POSTFIELDS, $requestinventarios);
        curl_setopt($chinventario, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    
        $responseinventario = curl_exec($chinventario);
        $err_statusinventario = curl_errno($chinventario);
    
        $inventario= $responseinventario;
        
    
        
    
        $inventariotext = $inventario;
        $datosacambiar=$inventariotext;
        $mynewstringbien = str_replace("<", "|", $datosacambiar);
    
        
    
        
        
        $datosacambiardos=$mynewstringbien;
        $mynewstringbienfin = str_replace(">", "|", $datosacambiardos);
    
        
    
    
        $separador = "|";
        $separada = explode($separador, $mynewstringbienfin);
        
        $cantidaddedatos=count($separada);
        
        $listinventario="";
        $inicioinventario="";
        $iinventario=0;
        $fininventario=0;
    
        $contadoridap=0;
        $contadorinventarioprod=0;
        $contaodorInventario_Cantidad=0;
        $contaodorSucursalId=0;
    
        $creaciondetxttinve="";
        
    
        foreach ( $separada as $palabra3 ) {
        
        
        
    
            
            if($palabra3=="/Mensaje"||$palabra3=="OK"||$palabra3=="Mensaje xmlns=\"WSConsultas\""||$palabra3=="Consultas.INVENTARIOSResponse xmlns=\"WSConsultas\""||$palabra3=="SOAP-ENV:Body"||$palabra3=="SOAP-ENV:Envelope xmlns:SOAP-ENV=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:SOAP-ENC=\"http://schemas.xmlsoap.org/soap/encoding/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"" || $palabra3=="?xml version = \"1.0\" encoding = \"utf-8\"?"||$palabra3=="Inventarioslist xmlns=\"WSConsultas\""|| $palabra3=="/Inventarioslist" || $palabra3=="/SOAP-ENV:Body" || $palabra3=="/SOAP-ENV:Envelope" || $palabra3=="/Consultas.INVENTARIOSResponse"){
    
                
            }
            else if($palabra3=="InventariosSDT xmlns=\"WSConsultas\""||$palabra3=="/InventariosSDT")
            {
               
            }
            else{
                $iinventario++;
    
                if($iinventario>8){
                   
                    //inica inventario id
                    if($palabra3=="InventarioId"){
                        $contadoridap=1;
                       
                       
                    }
                    else if($contadoridap==1){
                        $contadoridap=2;
                        
                        $creaciondetxttinve=$creaciondetxttinve.$palabra3."|";
                       
                      
                    }
                    else if($contadoridap==2){
                        $contadoridap=0;
                        
                        
                    }
    
    
    
                    //inica inventario producto id
                    if($palabra3=="Inventario_ProductoId"){
                        $contadorinventarioprod=1;
                        
                       
                    }
                    else if($contadorinventarioprod==1){
                        $contadorinventarioprod=2;
                        
                        $creaciondetxttinve=$creaciondetxttinve.$palabra3."|";
                        
                      
                    }
                    else if($contadorinventarioprod==2){
                        $contadorinventarioprod=0;
                       
                        
                    }
    
    
                    //inica Inventario_Cantidad
    
    
                    if($palabra3=="Inventario_Cantidad"){
                        $contaodorInventario_Cantidad=1;
                        
                       
                    }
                    else if($contaodorInventario_Cantidad==1){
                        $contaodorInventario_Cantidad=2;
                        
                        $creaciondetxttinve=$creaciondetxttinve.$palabra3."|";
                        
                      
                    }
                    else if($contaodorInventario_Cantidad==2){
                        $contaodorInventario_Cantidad=0;
                       
                    }
    
    
    
                    //inica SucursalId
                    if($palabra3=="SucursalId"){
                        $contaodorSucursalId=1;
                       
                       
                    }
                    else if($contaodorSucursalId==1){
                        $contaodorSucursalId=2;
                        
                        $creaciondetxttinve=$creaciondetxttinve.$palabra3."]";
                        
                      
                    }
                    else if($contaodorSucursalId==2){
                        $contaodorSucursalId=0;
                       
                        
                    }
    
                  
                   
                    
                   
                }
                   
                   
                
                
            }
            
            
              
        
           
        }
    
        
    
       
    
        $separadorparainventario = "]";
        $separadainventario = explode($separadorparainventario, $creaciondetxttinve);
            
     
        foreach ( $separadainventario as $palabraextr ){
    
            $aexttraer= $palabraextr;
            if($aexttraer!=""){
                $separadorparainventariocs = "|";
                $separadainventarioms = explode($separadorparainventariocs, $aexttraer);
    
                $idinventario=$separadainventarioms[0];
                $productoinventario=$separadainventarioms[1];
                $cantidadinventario=$separadainventarioms[2];
                $sucursalinventario=$separadainventarioms[3];
            
    
    
    
    
                $consultasinventarios = "SELECT `id`, `id_web` FROM `catalogo_producto` WHERE `id_web`='$productoinventario'";
    
    
                $consultasinventarios = mysqli_query($con, $consultasinventarios); 
                           
                $rowinventariosl= $consultasinventarios->fetch_array(MYSQLI_NUM);
         
         
                 $idcatproductocat="";
                 
                 if($rowinventariosl!=NULL){
                     $contaodrprodkl=count($rowinventariosl);
                     if($contaodrprodkl>0)
                     {
                      
                       $idcatproductocat=$rowinventariosl[0];
                       
                       
                       
                     }
                 }
    
    
                 $consultassiexisteinventari = "SELECT `id`, `id_web`, `cantidad` FROM `inventario` WHERE `id_web`='$idinventario'";
    
                $consultassiexisteinventari = mysqli_query($con, $consultassiexisteinventari); 
                           
                $rowexiinventa= $consultassiexisteinventari->fetch_array(MYSQLI_NUM);
         
                
                 $idsiexisteinve="";
                 $cantinventarioll= "";
                 $idinventaioontw="";
                 
                 if($rowexiinventa!=NULL){
                     $contaodrproveinve=count($rowexiinventa);
                     if($contaodrproveinve>0)
                     {
    
                      $idinventaioontw=$rowexiinventa[0];
                       $idsiexisteinve=$rowexiinventa[1];
                       $cantinventarioll=$rowexiinventa[2];

                       
                       
                       
                       
                     }
                 }
    
    
    
                 $consultassiexistsucurl = "SELECT `id`, `id_web` FROM `sucursal` WHERE `id_web`='$sucursalinventario'";
    
                $consultassiexistsucurl = mysqli_query($con, $consultassiexistsucurl); 
                           
                $rowexisucu= $consultassiexistsucurl->fetch_array(MYSQLI_NUM);
         
         
                 $idsiexistesuc="";
                 
                 if($rowexisucu!=NULL){
                     $contaodrpsuc=count($rowexisucu);
                     if($contaodrpsuc>0)
                     {
                      
                       $idsiexistesuc=$rowexisucu[0];
                       
                       
                       
                     }
                 }
    
    
    
                 if($idsiexisteinve!=$idinventario)
                 {
    
                    if($idcatproductocat!="" &&  $idsiexistesuc!="")
                 {
    
                  //  echo "el id obtenido es $idcatproducto despues de haber traido con el id $productoinventario"."<br><br>";
            
                   $sqlInventario = "INSERT INTO `inventario`(`id`, `id_web`, `producto_id`, `cantidad`, `sucursal_id`) VALUES (NULL,'$idinventario','$idcatproductocat','$cantidadinventario','$idsiexistesuc')";
                   if ($con->query($sqlInventario) === TRUE) {
                        
                } else {
                  echo "Error: " . $sqlInventario . "<br>" . $con->error;
                }
            
                 }
                
                 }
                 else if($cantidadinventario!=$cantinventarioll)
                 {
                    
                    echo "$cantidadinventario  y $cantinventarioll";
                    $sqlupdate="UPDATE `inventario` SET `cantidad`='$cantidadinventario' WHERE `id`='$idinventaioontw'";

                   
                    if ($con->query($sqlupdate) === TRUE) {
                        echo  $sqlupdate;
                    } else {
                      echo "Error: " . $sqlupdate . "<br>" . $con->error;
                    }
                  
                 }
                 
                 
    
               
                
            }
            
            
        
            
        }
        
    
      
        
       $hola="termina";
       return $hola;
    

    }

}
