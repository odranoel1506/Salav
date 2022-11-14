<?php

class productosweb
{
    public function prodWeb($location,$request,$header,$action)
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
      //inicia obtencion de token para productos
    
        
        
    
      $ch2 = curl_init($location);
      curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch2, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch2, CURLOPT_POST, true);
      curl_setopt($ch2, CURLOPT_POSTFIELDS, $request);
      curl_setopt($ch2, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    
      $response2 = curl_exec($ch2);
      $err_status2 = curl_errno($ch2);
    
     
      
      $tokenob2= $response2;
    
      echo "El token obtenido para productos es: ".$tokenob2."<br><br>";
      $texto1 = $tokenob2;
      $string11 = explode ( ' ', $texto1 );
    
      
      $ii=0;
      $palabra11="";
      foreach ( $string11 as $palabra ) {
          $ii++;
          
          if($ii==13){
              $palabra11= $palabra;
          }
         
      }
     
    
    
    $texto22 = $palabra11;
    $string22 = explode ( '>', $texto22 );
    
    $tokenfin1="";
    $ia1=0;
    foreach ( $string22 as $palabra2 ) {
      $ia1++;
      
      if($ia1==2){
          $tokenfin1= $palabra2;
          
      }
          
      
         
    }
    
    $texto33 = $tokenfin1;
    $string33 = explode ( '<', $texto33 );
    $tokenfinfin2="";
    $iad3=0;
    foreach ( $string33 as $palabra3 ) {
      $iad3++;
      
      if($iad3==1){
          $tokenfinfin2= $palabra3;
          
      }       
      
         
    }
    
    
    
    
    
    
    
      //............................................................................................................
      //inicia obtencion de productos
    
    
      $requestproductos="  
      
      <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:wsc=\"WSConsultas\">
   <soapenv:Header/>
   <soapenv:Body>
      <wsc:Consultas.PRODUCTOS>
         <wsc:Token>$tokenfinfin2</wsc:Token>
         <wsc:Productoid>?</wsc:Productoid>
      </wsc:Consultas.PRODUCTOS>
   </soapenv:Body>
    </soapenv:Envelope>
      ";
    
    
      $headerproductos=[
          'Method: POST',
          'Connection: Keep-Alive',
          'User-Agent: PHP-SOAP-CURL',
          'Content-Type: text/xml; charset=utf-8',
          'SOAPAction: Consultas.PRODUCTOS',
      ];
    
      $chproductos = curl_init($location);
      curl_setopt($chproductos, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($chproductos, CURLOPT_HTTPHEADER, $headerproductos);
      curl_setopt($chproductos, CURLOPT_POST, true);
      curl_setopt($chproductos, CURLOPT_POSTFIELDS, $requestproductos);
      curl_setopt($chproductos, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    
      $responseproductos = curl_exec($chproductos);
      $err_statusproductos = curl_errno($chproductos);
    
      $productos= $responseproductos;
    
      
    

    
     
      $productostext = $productos;
    
      $datosacambiarprod=$productostext;
      $productosbien = str_replace("<", "|", $datosacambiarprod);
    
      $datosacambiardospro=$productosbien;
      $prodbienfin = str_replace(">", "|", $datosacambiardospro);
    
    
      $separadorpro = "|";
      $separadapro = explode($separadorpro, $prodbienfin);
    
    
    
      
      
    
    
      $ProductoIdsalto=0;
      $Producto_part_number=0;
      $Producto_descripcion=0;
      $Producto_Url_Ficha=0;
      $Producto_Imagen=0;
      $Producto_PDF=0;
      $creaciondetxttpro="";
      $ProductoProveedor=0; 
      $ProductoPrecioCTE=0;  
      $ProductoPrecioLista=0;
      $Producto_LstPrec=0; 
      $ProductoClasificacion=0;
      $ProductoCodigoBusqueda=0;

      
      foreach ($separadapro as $palabra4)
      {
          
        
        
          //inica inventario id-------------------------------------------------
          if($palabra4=="ProductoId"){
           $ProductoIdsalto=1;
                
                 
          }
          else if($ProductoIdsalto==1)
          {
              $ProductoIdsalto=2;
              
               
              $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
          }
          else if($ProductoIdsalto==2)
          {
              $ProductoIdsalto=0;               
                  
          }
          elseif($palabra4=="ProductoId /")
          {
              $ProductoIdsalto=0; 
              $creaciondetxttpro=$creaciondetxttpro."|";
          }
    
          //inica inventario id-------------------------------------------------
          if($palabra4=="Producto_LstPrec"){
           $Producto_LstPrec=1;
                
                 
          }
          else if($Producto_LstPrec==1)
          {
              $Producto_LstPrec=2;
              
               
              $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
          }
          else if($Producto_LstPrec==2)
          {
              $Producto_LstPrec=0;               
                  
          }
          elseif($palabra4=="Producto_LstPrec /")
          {
              $Producto_LstPrec=0; 
              $creaciondetxttpro=$creaciondetxttpro."|";
          }
          //inica Producto_part_number------------------------------------------------
          if($palabra4=="Producto_part_number"){
             $Producto_part_number=1;
                 
                 
          }
          else if($Producto_part_number==1)
          {
              $Producto_part_number=2;
             
                
              $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
                 
                
          }
          else if($Producto_part_number==2)
          {
              $Producto_part_number=0;               
                  
          }
          elseif($palabra4=="Producto_part_number /")
          {
              $Producto_part_number=0; 
              $creaciondetxttpro=$creaciondetxttpro."|";
          }
          
    
          //inica Producto_descripcion------------------------------------------------
          if($palabra4=="Producto_descripcion")
          {
              $Producto_descripcion=1;
                 
                 
          }
          else if($Producto_descripcion==1)
          {
              $Producto_descripcion=2;
              
                
              $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
                
                
          }
          else if($Producto_descripcion==2)
          {
              $Producto_descripcion=0;               
                 
          }
          elseif($palabra4=="Producto_descripcion /")
          {
              $Producto_descripcion=0; 
              $creaciondetxttpro=$creaciondetxttpro."|";
          }
    
          //inica Producto_Url_Ficha------------------------------------------------
          
          if($palabra4=="Producto_Url_Ficha")
          {
              $Producto_Url_Ficha=1;
                 
                 
          }
          else if($Producto_Url_Ficha==1)
          {
              $Producto_Url_Ficha=2;
                 
                
              $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
                 
                
          }
          else if($Producto_Url_Ficha==2)
          {
              $Producto_Url_Ficha=0;               
                 
          }
          elseif($palabra4=="Producto_Url_Ficha /")
          {
              $Producto_Url_Ficha=0; 
              $creaciondetxttpro=$creaciondetxttpro."|";
          }
    
          //inica Producto_Imagen------------------------------------------------
    
          if($palabra4=="Producto_Imagen")
          {
              $Producto_Imagen=1;
                 
                 
          }
          else if($Producto_Imagen==1)
          {
              $Producto_Imagen=2;
                 
                
              $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
                 
                
          }
          else if($Producto_Imagen==2)
          {
              $Producto_Imagen=0;               
                 
          }
          elseif($palabra4=="Producto_Imagen /")
          {
              $Producto_Imagen=0; 
              $creaciondetxttpro=$creaciondetxttpro."|";
          }
    
          //inica Producto_PDF------------------------------------------------
    
          if($palabra4=="Producto_PDF")
          {
              $Producto_PDF=1;
                 
                 
          }
          else if($Producto_PDF==1)
          {
              $Producto_PDF=2;
                 
                
              $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
                 
                
          }
          else if($Producto_PDF==2)
          {
              $Producto_PDF=0;               
                 
          }
          elseif($palabra4=="Producto_PDF /")
          {
              $Producto_PDF=0; 
              $creaciondetxttpro=$creaciondetxttpro."|";
          }
          //inica ProductoProveedor------------------------------------------------
    
          
          if($palabra4=="ProductoProveedor")
          {
              $ProductoProveedor=1;
                 
                 
          }
          else if($ProductoProveedor==1)
          {
              $ProductoProveedor=2;
                 
                
              $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
                 
                
          }
          else if($ProductoProveedor==2)
          {
              $ProductoProveedor=0;               
                 
          }
          elseif($palabra4=="ProductoProveedor /")
          {
              $ProductoProveedor=0; 
              $creaciondetxttpro=$creaciondetxttpro."|";
          }
    
    
          //inica ProductoPrecioLista------------------------------------------------
    
          
              if($palabra4=="ProductoPrecioLista")
              {
                  $ProductoPrecioLista=1;
                     
                     
              }
              else if($ProductoPrecioLista==1)
              {
                  $ProductoPrecioLista=2;
                     
                    
                  $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
                     
                    
              }
              else if($ProductoPrecioLista==2)
              {
                  $ProductoPrecioLista=0;               
                     
              }
              elseif($palabra4=="ProductoPrecioLista /")
              {
                  $ProductoPrecioLista=0; 
                  $creaciondetxttpro=$creaciondetxttpro."|";
              }
              //inica ProductoPrecioCTE------------------------------------------------
    
          
               if($palabra4=="ProductoPrecioCTE")
               {
                   $ProductoPrecioCTE=1;
                      
                      
               }
               else if($ProductoPrecioCTE==1)
               {
                   $ProductoPrecioCTE=2;
                      
                     
                   $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
                      
                     
               }
               else if($ProductoPrecioCTE==2)
               {
                   $ProductoPrecioCTE=0;               
                      
               }
               elseif($palabra4=="ProductoPrecioCTE /")
               {
                   $ProductoPrecioCTE=0; 
                   $creaciondetxttpro=$creaciondetxttpro."|";
               }
    
               //inica ProductoClasificacion------------------------------------------------
    
          
               if($palabra4=="ProductoClasificacion")
               {
                   $ProductoClasificacion=1;
                      
                      
               }
               else if($ProductoClasificacion==1)
               {
                   $ProductoClasificacion=2;
                      
                     
                   $creaciondetxttpro=$creaciondetxttpro.$palabra4."|";
                      
                     
               }
               else if($ProductoClasificacion==2)
               {
                   $ProductoClasificacion=0;               
                      
               }
               elseif($palabra4=="ProductoClasificacion /")
               {
                   $ProductoClasificacion=0; 
                   $creaciondetxttpro=$creaciondetxttpro."|";
               }












                //inica ProductoCodigoBusqueda-------------------------------------------------
          if($palabra4=="ProductoCodigoBusqueda"){
            $ProductoCodigoBusqueda=1;
                 
                  
           }
           else if($ProductoCodigoBusqueda==1)
           {
               $ProductoCodigoBusqueda=2;
               
                
               $creaciondetxttpro=$creaciondetxttpro.$palabra4."]";
           }
           else if($ProductoCodigoBusqueda==2)
           {
               $ProductoCodigoBusqueda=0;               
                   
           }
           elseif($palabra4=="ProductoCodigoBusqueda /")
           {
               $ProductoCodigoBusqueda=0; 
               $creaciondetxttpro=$creaciondetxttpro."]";
           }

      
      }
     
     
    
     
    
     $separadorparaproducto = "]";
     $separadaproducto = explode($separadorparaproducto, $creaciondetxttpro);
    
    
    
        foreach ( $separadaproducto as $palabraextrpro )
        {
    
          $aexttraerpro= $palabraextrpro;
          if($aexttraerpro!="")
          {
           $separadorparaprodcs = "|";
           $separadaproductom = explode($separadorparaprodcs, $aexttraerpro);
    
           $idproducto=$separadaproductom[0];
           $Producto_LstPrecld=$separadaproductom[1];
           $productopartnumber=$separadaproductom[2];
           $productidescripcion=$separadaproductom[3];
           $productourlficha=$separadaproductom[4];
           $productoimagen=$separadaproductom[5];
           $productopdf=$separadaproductom[6];
           $ProductoProveedor=$separadaproductom[7];
           $ProductoPrecioLista=$separadaproductom[8];
           $ProductoPrecioCTE=$separadaproductom[9];
           $ProductoClasificacion=$separadaproductom[10];
           $ProductoCodigoBusquedal=$separadaproductom[11];
          
           $ProductoProveedor = str_replace('Ä', "A", $ProductoProveedor);
           $productourlficha=utf8_decode($productourlficha);
           $productopartnumber=utf8_decode($productopartnumber);
           $productidescripcion=utf8_decode($productidescripcion);
           $ProductoProveedor=utf8_decode($ProductoProveedor);
           $ProductoCodigoBusquedal=utf8_decode($ProductoCodigoBusquedal);
           //echo $ProductoProveedor."<br>";

          
          //echo "El id producto es: ".$separadaproductom[0]."<br>";
          //echo "El Producto LstPrec es: ".$separadaproductom[0]."<br>";
          //echo "El producto part number es: ".$separadaproductom[1]."<br>";
          //echo "El producto descripcion es: ".$separadaproductom[2]."<br>";
          //echo "El producto url ficha es: ".$separadaproductom[3]."<br>";
          //echo "El producto imagen es: ".$separadaproductom[4]."<br>";
          //echo "El producto pdf es: ".$separadaproductom[5]."<br>";
          //echo "El producto proveedor es: ".$separadaproductom[6]."<br>";
          //echo "El Producto PrecioLista es: ".$separadaproductom[7]."<br>";
          //echo "El Producto Precio CTE es: ".$separadaproductom[8]."<br><br>";
          
    
           $idprovedorautilizar="";
           $cadena =str_replace(' ', '|', $ProductoProveedor);
    
           
           $productidescripcion =str_replace('\'', '', $productidescripcion);
          // echo $cadena."<br><br>";
           if($cadena!="|"||$cadena!="|")
           {
    
           $consultasproveedortabal = "SELECT `id`, `nombre` FROM `proveedor` WHERE `nombre`='$ProductoProveedor'";
    
           $consultasproveedortabal = mysqli_query($con, $consultasproveedortabal); 
                      
           $rowproveedor= $consultasproveedortabal->fetch_array(MYSQLI_NUM);
    
    
            $idproveddro="";
            $nombreprovedor="";
            if($rowproveedor!=NULL){
                $contaodrproveedor=count($rowproveedor);
                if($contaodrproveedor>0)
                {
                 
                  $idproveddro=$rowproveedor[0];
                  $nombreprovedor=$rowproveedor[1];
                  
                  
                }
            }
    
            $idprovedorautilizar=$idproveddro;
            $existeproveddor="";
            if($nombreprovedor!=$ProductoProveedor){
                $existeproveddor="noexiste";
            }
            if($existeproveddor=="noexiste"){
                $ProductoProveedor=utf8_encode(utf8_decode($ProductoProveedor));
                $sqlproveedoor = "INSERT INTO `proveedor`(`id`, `nombre`, `tipo`) VALUES (NULL,'".utf8_encode(utf8_decode($ProductoProveedor))."','')";
                if ($con->query($sqlproveedoor) === TRUE) {
                        
                } else {
                  echo "Error: " . $sqlproveedoor . "<br>" . $con->error;
                }
            }
           }
           
    
    
          
    
          
          if($idprovedorautilizar!=""){
            if($ProductoCodigoBusquedal==""){
                $ProductoCodigoBusquedal="Sin Tipo";
            }
            $consultasproducto = "SELECT `id`, `id_web`,`tipo` FROM `catalogo_producto` WHERE `id_web`='$idproducto'";
    
          $consultasproducto = mysqli_query($con, $consultasproducto); 
                     
          $rowproductos= $consultasproducto->fetch_array(MYSQLI_NUM);
    
    
           $idproductoka="";
           $id_web="";
           $tipo="";
           if($rowproductos!=NULL){
               $contaodrproveedor=count($rowproductos);
               if($contaodrproveedor>0)
               {
                
                 $idproductoka=$rowproductos[0];
                 $id_web=$rowproductos[1];
                 $tipo=$rowproductos[2];
                 
                 
               }
           }
           $existeproducto="";
           if($idproducto!=$id_web){
               $existeproducto="noexiste";
           }
           if($existeproducto=="noexiste"){
    
          
               $sqlproductosnuevov = "INSERT INTO `catalogo_producto`(`id`, `id_web`, `Producto_LstPrec`, `part_number`, `descripcion`,`tipo`, `url_ficha`, `imagen`, `pdf`, `clasificacionabc`,`proveedor_id`,`Precio`, `imglo`) VALUES (NULL,'$idproducto','$Producto_LstPrecld','$productopartnumber','$productidescripcion','$ProductoCodigoBusquedal','$productourlficha','$productoimagen','$productopdf','$ProductoClasificacion','$idprovedorautilizar','$ProductoPrecioLista', '')";
               if ($con->query($sqlproductosnuevov) === TRUE) {
                        
            } else {
              echo "Error: " . $sqlproductosnuevov . "<br>" . $con->error;
            }
           }
           /*
           elseif($tipo==""){

            $sqlproductosactu = "UPDATE `catalogo_producto` SET `tipo`='$ProductoCodigoBusquedal' WHERE id_web='$id_web'";
            echo "$sqlproductosactu";
            if ($con->query($sqlproductosactu) === TRUE) {
                     
         } else {
           echo "Error: " . $sqlproductosactu . "<br>" . $con->error;
         }
           }
           */
           
    
          }
    
          
        }
    
        
        
      }
      
    
        
       $hola="termina";
       return $hola;
    

    }

}
