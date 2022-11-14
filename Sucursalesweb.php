<?php

class Sucursalesweb
{
    public function SucuWeb($location,$request,$header,$action)
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
      //inicia obtencion de token para sucursales
    
        
        
    
      $ch3 = curl_init($location);
      curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch3, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch3, CURLOPT_POST, true);
      curl_setopt($ch3, CURLOPT_POSTFIELDS, $request);
      curl_setopt($ch3, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    
      $response3 = curl_exec($ch3);
      $err_status3 = curl_errno($ch3);
    
     
      
      $tokenob3= $response3;
    
      echo "El token obtenido para sucursal es: ".$tokenob3."<br><br>";
      $texto12 = $tokenob3;
      $string112 = explode ( ' ', $texto12 );
    
      
      $ii2=0;
      $palabra112="";
      foreach ( $string112 as $palabra ) {
          $ii2++;
          
          if($ii2==13){
              $palabra112= $palabra;
          }
         
      }
     
    
    
    $texto222 = $palabra112;
    $string222 = explode ( '>', $texto222 );
    
    $tokenfin12="";
    $ia12=0;
    foreach ( $string222 as $palabra2 ) {
      $ia12++;
      
      if($ia12==2){
          $tokenfin12= $palabra2;
          
      }
          
      
         
    }
    
    $texto332 = $tokenfin12;
    $string332 = explode ( '<', $texto332 );
    $tokenfinfin22="";
    $iad32=0;
    foreach ( $string332 as $palabra3 ) {
      $iad32++;
      
      if($iad32==1){
          $tokenfinfin22= $palabra3;
          
      }       
      
         
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    //............................................................................................................
        //inicia obtencion de sucursales
    
    
        $requestsucursales="   
        <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:wsc=\"WSConsultas\">
       <soapenv:Header/>
       <soapenv:Body>
          <wsc:Consultas.SUCURSALES>
             <wsc:Token>$tokenfinfin22</wsc:Token>
             <wsc:Sucursalid>C0nsult15</wsc:Sucursalid>
          </wsc:Consultas.SUCURSALES>
       </soapenv:Body>
    </soapenv:Envelope>
        ";
    
    
        $headersucursales=[
            'Method: POST',
            'Connection: Keep-Alive',
            'User-Agent: PHP-SOAP-CURL',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: Consultas.SUCURSALES',
        ];
    
        $chsucursales = curl_init($location);
        curl_setopt($chsucursales, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chsucursales, CURLOPT_HTTPHEADER, $headersucursales);
        curl_setopt($chsucursales, CURLOPT_POST, true);
        curl_setopt($chsucursales, CURLOPT_POSTFIELDS, $requestsucursales);
        curl_setopt($chsucursales, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    
        $responsesucursales = curl_exec($chsucursales);
        $err_statussucursales = curl_errno($chsucursales);
    
        $sucursales= $responsesucursales;
    
        //echo "El resultado de sucursales es: ".$sucursales."<br><br>";
    
    
    
        $sucursalestext = $sucursales;
    
        $datosacambiarsucursales=$sucursalestext;
        $sucursalesbien = str_replace("<", "|", $datosacambiarsucursales);
    
        $datosacambiardossucur=$sucursalesbien;
        $sucursalesbienfin = str_replace(">", "|", $datosacambiardossucur);
    
    
        $separadorsucur = "|";
        $separadasucursales = explode($separadorsucur, $sucursalesbienfin);
    
        
        //var_dump($separadasucursales);
    
        $SucursalId=0; 
        $SucursalDireccion=0;
        $SucursalDesc=0; 
        $SucursalSuc=0; 
        $SucursalUbicacion=0;


        
        $recolecciondatossucursal="";
        foreach ($separadasucursales as $palabra5){
    
            //inica SucursalId-------------------------------------------------
            if($palabra5=="SucursalId"){
                $SucursalId=1;
                     
                      
               }
               else if($SucursalId==1)
               {
                   $SucursalId=2;
                   
                    
                   $recolecciondatossucursal=$recolecciondatossucursal.$palabra5."|";
               }
               else if($SucursalId==2)
               {
                   $SucursalId=0;               
                       
               }
               elseif($palabra5=="SucursalId /")
               {
                   $SucursalId=0; 
                   $recolecciondatossucursal=$recolecciondatossucursal."|";
               }
    
            //inica SucursalDesc-------------------------------------------------
            if($palabra5=="SucursalDesc"){
                $SucursalDesc=1;
                     
                      
               }
               else if($SucursalDesc==1)
               {
                   $SucursalDesc=2;
                   
                    
                   $recolecciondatossucursal=$recolecciondatossucursal.$palabra5."|";
               }
               else if($SucursalDesc==2)
               {
                   $SucursalDesc=0;               
                       
               }
               elseif($palabra5=="SucursalDesc /")
               {
                   $SucursalDesc=0; 
                   $recolecciondatossucursal=$recolecciondatossucursal."|";
               }
    
            //inica SucursalDireccion-------------------------------------------------
            if($palabra5=="SucursalDireccion"){
                $SucursalDireccion=1;
                     
                      
               }
               else if($SucursalDireccion==1)
               {
                   $SucursalDireccion=2;
                   
                    
                   $recolecciondatossucursal=$recolecciondatossucursal.$palabra5."|";
               }
               else if($SucursalDireccion==2)
               {
                   $SucursalDireccion=0;               
                       
               }
               elseif($palabra5=="SucursalDireccion /")
               {
                   $SucursalDireccion=0; 
                   $recolecciondatossucursal=$recolecciondatossucursal."|";
               } 
               
               
            //inica SucursalSuc-------------------------------------------------
            if($palabra5=="SucursalSuc"){
                $SucursalSuc=1;
                     
                      
               }
               else if($SucursalSuc==1)
               {
                   $SucursalSuc=2;
                   
                    
                   $recolecciondatossucursal=$recolecciondatossucursal.$palabra5."|";
               }
               else if($SucursalSuc==2)
               {
                   $SucursalSuc=0;               
                       
               }
               elseif($palabra5=="SucursalSuc /")
               {
                   $SucursalSuc=0; 
                   $recolecciondatossucursal=$recolecciondatossucursal."|";
               } 
    
    
            //inica SucursalUbicacion-------------------------------------------------
            if($palabra5=="SucursalUbicacion"){
                $SucursalUbicacion=1;
                     
                      
               }
               else if($SucursalUbicacion==1)
               {
                   $SucursalUbicacion=2;
                   
                    
                   $recolecciondatossucursal=$recolecciondatossucursal.$palabra5."]";
               }
               else if($SucursalUbicacion==2)
               {
                   $SucursalUbicacion=0;               
                       
               }
               elseif($palabra5=="SucursalUbicacion /")
               {
                   $SucursalUbicacion=0; 
                   $recolecciondatossucursal=$recolecciondatossucursal."]";
               }   
    
        }
    
    
    
    
    
    
        //echo $recolecciondatossucursal;
    
    
        $separadorparasucursal = "]";
        $separadasucursal = explode($separadorparasucursal, $recolecciondatossucursal);
     
     
     
        foreach ( $separadasucursal as $palabraextrsuc ){
     
         $aexttraersuc= $palabraextrsuc;
         if($aexttraersuc!=""){
             $separadorparasucursa = "|";
             $separadasucursalhj = explode($separadorparasucursa, $aexttraersuc);
     
             $idsucursal=$separadasucursalhj[0];
             $sucursaldes=$separadasucursalhj[1];
             $sucursaldireciones=$separadasucursalhj[2];
             $sucursalc=$separadasucursalhj[3];
             $sucursalubicacion=$separadasucursalhj[4];
             
             
     
             /*
             echo "El id sucursal es: ".$separadasucursalhj[0]."<br>";
             echo "La sucursal Des es: ".$separadasucursalhj[1]."<br>";
             echo "La sucursal direccion es: ".$separadasucursalhj[2]."<br>";
             echo "La sucursal suc es: ".$separadasucursalhj[3]."<br>";
             echo "La sucursal ubicacion es: ".$separadasucursalhj[4]."<br><br>";*/

             $sucursaldireciones=utf8_decode($sucursaldireciones);
             $sucursaldes=utf8_decode($sucursaldes); 
             $sucursalc=utf8_decode($sucursalc); 
             $sucursalubicacion=utf8_decode($sucursalubicacion);
             
             
            //consulta a la base de datos para existencia de dato en auto
            $consultasiexistsucursal = "SELECT `id_web` FROM `sucursal` WHERE `id_web`='$idsucursal'";
         
            $consultasiexistsucursal = mysqli_query($con, $consultasiexistsucursal); 
                       
            $rowasucursal = $consultasiexistsucursal->fetch_array(MYSQLI_NUM);
    
            $idsucursala="";
            if($rowasucursal!=NULL){
                $autocantidad=count($rowasucursal);
                if($autocantidad>0)
                {
                 
                  $idsucursala=$rowasucursal[0];
                  //echo "si tiene datos $idsucursala". "<br><br>";
                  
                }
              }
    
              $existe="";
    
              if($idsucursala!=$idsucursal){
                $existe="no";

                
              }
              else{
                $existe="si";
                
              }
    
    
              if($existe=="no" || $existe==""){
                $sql = "INSERT INTO `sucursal`(`id`, `id_web`, `descripcion`, `direccion`, `sucursal`, `ubicacion`) VALUES (NULL,'$idsucursal','$sucursaldes','$sucursaldireciones','$sucursalc','$sucursalubicacion')";
                if ($con->query($sql) === TRUE) {
                        
                } else {
                  echo "Error: " . $sql . "<br>" . $con->error;
                }
              }
             
             
         }
       
         
         
         }
    







    
       
       
    
        
       $hola="termina";
       return $hola;
    

    }

}
