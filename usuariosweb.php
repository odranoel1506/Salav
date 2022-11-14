<?php

class usuariosweb
{
    public function UsuariosWeb($location,$request,$header,$action)
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
        
    
    $ch4 = curl_init($location);
    curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch4, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch4, CURLOPT_POST, true);
    curl_setopt($ch4, CURLOPT_POSTFIELDS, $request);
    curl_setopt($ch4, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    
    $response4 = curl_exec($ch4);
    $err_status4 = curl_errno($ch4);
    
    
    
    $tokenob4= $response4;
    
    echo "El token obtenido para usuarios es: ".$tokenob4."<br><br>";
    $texto12usuario = $tokenob4;
    $string112usuario = explode ( ' ', $texto12usuario );
    
    
    $ii2us=0;
    $palabra112usuario="";
    foreach ( $string112usuario as $palabra ) {
        $ii2us++;
        
        if($ii2us==13){
            $palabra112usuario= $palabra;
        }
       
    }
    
    
    
    $texto222usu = $palabra112usuario;
    $string222usua = explode ( '>', $texto222usu );
    
    $tokenfin12usuar="";
    $ia12usuario=0;
    foreach ( $string222usua as $palabra2 ) 
    {
    $ia12usuario++;
    
    if($ia12usuario==2){
        $tokenfin12usuar= $palabra2;
        
    }
        
    
       
    }
    
    $texto332usuario = $tokenfin12usuar;
    $string332usu = explode ( '<', $texto332usuario );
    $tokenfinfin22usuario="";
    $iad32usuario=0;
    foreach ( $string332usu as $palabra3 ) {
    $iad32usuario++;
    
    if($iad32usuario==1){
        $tokenfinfin22usuario= $palabra3;
        
    }       
    
       
    }
    
    
    
    
    
    
    
    
    
    
    //............................................................................................................
      //inicia obtencion de usuarios
    
    
      $requestusuarios="   
      <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:wsc=\"WSConsultas\">
     <soapenv:Header/>
     <soapenv:Body>
        <wsc:Consultas.USUARIOS>
           <wsc:Token>$tokenfinfin22usuario</wsc:Token>
           <wsc:Usuarioid>Enteratek</wsc:Usuarioid>
        </wsc:Consultas.USUARIOS>
     </soapenv:Body>
    </soapenv:Envelope>
      ";
    
    
      $headerusuarios=[
          'Method: POST',
          'Connection: Keep-Alive',
          'User-Agent: PHP-SOAP-CURL',
          'Content-Type: text/xml; charset=utf-8',
          'SOAPAction: Consultas.USUARIOS',
      ];
    
      $chusuarios = curl_init($location);
      curl_setopt($chusuarios, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($chusuarios, CURLOPT_HTTPHEADER, $headerusuarios);
      curl_setopt($chusuarios, CURLOPT_POST, true);
      curl_setopt($chusuarios, CURLOPT_POSTFIELDS, $requestusuarios);
      curl_setopt($chusuarios, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    
      $responseusuarios = curl_exec($chusuarios);
      $err_statususuarios = curl_errno($chusuarios);
    
      $usuarios= $responseusuarios;
    
      //echo "El resultado de usuarios es: ".$usuarios."<br><br>";
    
      $usuariostext = $usuarios;
    
      $datosacambiarusuarios=$usuariostext;
      $usuariosbien = str_replace("<", "|", $datosacambiarusuarios);
    
      $datosacambiardosusuar=$usuariosbien;
      $usuariosbienfin = str_replace(">", "|", $datosacambiardosusuar);
    
    
      $separadorusuario = "|";
      $separadausuarios = explode($separadorusuario, $usuariosbienfin);
    
    
      //var_dump($separadausuarios);
    
      $recolecciondatosusuarios="";
    
      $UsuId=0; 
      $UsuNombre=0;
      $UsuContra=0;  
      $UsuUsuario=0;
      $SucursalId=0;
      
      foreach ($separadausuarios as $palabra6)
      {
    
          //inica UsuId-------------------------------------------------
          if($palabra6=="UsuId"){
              $UsuId=1;
                   
                    
             }
             else if($UsuId==1)
             {
                 $UsuId=2;
                 
                  
                 $recolecciondatosusuarios=$recolecciondatosusuarios.$palabra6."|";
             }
             else if($UsuId==2)
             {
                 $UsuId=0;               
                     
             }
             elseif($palabra6=="UsuId /")
             {
                 $UsuId=0; 
                 $recolecciondatosusuarios=$recolecciondatosusuarios."|";
             }
    
          //inica UsuNombre-------------------------------------------------
          if($palabra6=="UsuNombre"){
              $UsuNombre=1;
                   
                    
             }
             else if($UsuNombre==1)
             {
                 $UsuNombre=2;
                 
                  
                 $recolecciondatosusuarios=$recolecciondatosusuarios.$palabra6."|";
             }
             else if($UsuNombre==2)
             {
                 $UsuNombre=0;               
                     
             }
             elseif($palabra6=="UsuNombre /")
             {
                 $UsuNombre=0; 
                 $recolecciondatosusuarios=$recolecciondatosusuarios."|";
             }
    
          //inica UsuContra-------------------------------------------------
          if($palabra6=="UsuContra"){
              $UsuContra=1;
                   
                    
             }
             else if($UsuContra==1)
             {
                 $UsuContra=2;
                 
                  
                 $recolecciondatosusuarios=$recolecciondatosusuarios.$palabra6."|";
             }
             else if($UsuContra==2)
             {
                 $UsuContra=0;               
                     
             }
             elseif($palabra6=="UsuContra /")
             {
                 $UsuContra=0; 
                 $recolecciondatosusuarios=$recolecciondatosusuarios."|";
             }
    
          //inica UsuUsuario-------------------------------------------------
          if($palabra6=="UsuUsuario"){
              $UsuUsuario=1;
                   
                    
             }
             else if($UsuUsuario==1)
             {
                 $UsuUsuario=2;
                 
                  
                 $recolecciondatosusuarios=$recolecciondatosusuarios.$palabra6."|";
             }
             else if($UsuUsuario==2)
             {
                 $UsuUsuario=0;               
                     
             }
             elseif($palabra6=="UsuUsuario /")
             {
                 $UsuUsuario=0; 
                 $recolecciondatosusuarios=$recolecciondatosusuarios."|";
             }
    
          //inica SucursalId-------------------------------------------------
          if($palabra6=="SucursalId"){
              $SucursalId=1;
                   
                    
             }
             else if($SucursalId==1)
             {
                 $SucursalId=2;
                 
                  
                 $recolecciondatosusuarios=$recolecciondatosusuarios.$palabra6."]";
             }
             else if($SucursalId==2)
             {
                 $SucursalId=0;               
                     
             }
             elseif($palabra6=="SucursalId /")
             {
                 $SucursalId=0; 
                 $recolecciondatosusuarios=$recolecciondatosusuarios."]";
             }
    
    
      }
    
      //echo $recolecciondatosusuarios;
    
    
      $separadorparausuario = "]";
      $separadasuario = explode($separadorparausuario, $recolecciondatosusuarios);
    
    
    
      foreach ( $separadasuario as $palabraextrusuar ){
    
       $aexttraerusak= $palabraextrusuar;
       if($aexttraerusak!=""){
           $separadorparauad = "|";
           $separadausuariok = explode($separadorparauad, $aexttraerusak);
    
           $UsuId=$separadausuariok[0];
           $UsuNombre=$separadausuariok[1];
           $UsuContra=$separadausuariok[2];
           $UsuUsuario=$separadausuariok[3];
           $SucursalId=$separadausuariok[4];

           $UsuNombre=utf8_decode($UsuNombre);
           $UsuContra=utf8_decode($UsuContra);
           $UsuUsuario=utf8_decode($UsuUsuario);
           
           if($UsuId!="" && $UsuId!="0" && $UsuNombre!="" && $UsuNombre!="0" && $UsuContra!="" && $UsuContra!="0" && $UsuUsuario!="" && $UsuUsuario!="0" &&  $SucursalId!="" && $SucursalId!="0"){
    
            $consultasiexisusuariosentabla = "SELECT `id`, `id_web` FROM `usuario` WHERE `id_web`='$UsuId'";
    
           $consultasiexisusuariosentabla = mysqli_query($con, $consultasiexisusuariosentabla); 
                      
           $rowausuariostabla = $consultasiexisusuariosentabla->fetch_array(MYSQLI_NUM);
    
    
            $idusuariosobtabla="";
            $idsucursalobtenitabla="";
            if($rowausuariostabla!=NULL){
                $autocantidadusuatabla=count($rowausuariostabla);
                if($autocantidadusuatabla>0)
                {
                 
                  $idusuariosobtabla=$rowausuariostabla[0];
                  $idsucursalobtenitabla=$rowausuariostabla[1];
                  
                  
                }
            }
    
            $siexistesuc="";
            if($idsucursalobtenitabla!=$UsuId)
            {
                $siexistesuc="no existe";
            }
    
    
            if($siexistesuc=="no existe")
            {
    
            //consulta a la base de datos para existencia de dato en auto
             $consultasiexisusuarios = "SELECT `id`, `id_web` FROM `sucursal` WHERE `id_web`='$SucursalId'";
         
             $consultasiexisusuarios = mysqli_query($con, $consultasiexisusuarios); 
                      
             $rowausuarios = $consultasiexisusuarios->fetch_array(MYSQLI_NUM);
           
             $idusuariosob="";
             $idsucursalobteni="";
             if($rowausuarios!=NULL)
             {
                $autocantidadusua=count($rowausuarios);
                if($autocantidadusua>0)
                {
                 
                  $idusuariosob=$rowausuarios[0];
                  $idsucursalobteni=$rowausuarios[1];
                  //echo "el id que coincide en sucursal es $idusuariosob y el id que tengo en usuarios es $SucursalId". "<br><br>";
                  
                }
             }
    
                if($idusuariosob!=""){

                    $sqlusua = "INSERT INTO `usuario`(`id`, `id_web`, `nombre`, `contrasenauser`, `usuario`, `sucursal_id`) VALUES (Null,'$UsuId','$UsuNombre','$UsuContra','$UsuUsuario','$idusuariosob')";

                    if ($con->query($sqlusua) === TRUE) {
                        
                      } else {
                        echo "Error: " . $sqlusua . "<br>" . $con->error;
                      }
                   
                }
             
            
    
    
    
    
            }
    
           }
    
           
            
    
          /*
    
           echo "El Usu Id es: ".$separadausuariok[0]."<br>";
           echo "La Usu Nombre es: ".$separadausuariok[1]."<br>";
           echo "La Usu Contra es: ".$separadausuariok[2]."<br>";
           echo "La Usu Usuario es: ".$separadausuariok[3]."<br>";
           echo "La Sucursal Id es: ".$separadausuariok[4]."<br><br>";
           
           */
       }
       
   
       }
    
        
       $hola="termina";
       return $hola;
    

    }

}
