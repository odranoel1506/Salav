    <?php

    /*

    inicia una conexion a base de datos, se obtiene el token y se consulta el inventario, usuarios, catalogo de productos
    se organiza la informacion y se sube a base de datos, se verifica a base de datos si ya existe y si existe no se sube al menos que 
    sea de inventario, solo se actualiza la cantidad y el precio
    */
    set_time_limit(999999999);
        ini_set('memory_limit', '9999999999999G');
        

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
    require_once "usuariosweb.php";
    require_once "Sucursalesweb.php";
    require_once "productosweb.php";
    require_once "inventarioweb.php";



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


    $location="http://148.245.79.117:8088/Consultas/aConsultas.aspx?wsdl";

   
    $sucursalf=0;
    $productosf=0;
    $usariosf=0;
    $inventariof=0;

    
    
    
    $request="   
    <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:wsc=\"WSConsultas\">
    <soapenv:Header/>
    <soapenv:Body>
    <wsc:Consultas.OBTENERTOKEN>
    <wsc:Username>Enteratek</wsc:Username>
    <wsc:Password>C0nsult15</wsc:Password>
    </wsc:Consultas.OBTENERTOKEN>
    </soapenv:Body>
    </soapenv:Envelope>
    
    ";
    
    $action="Consultas.OBTENERTOKEN";
    
    $header=[
        'Method: POST',
        'Connection: Keep-Alive',
        'User-Agent: PHP-SOAP-CURL',
        'Content-Type: text/xml; charset=utf-8',
        'SOAPAction: Consultas.OBTENERTOKEN',
    ];
    
    
    

    $objsucu = new Sucursalesweb();
    $objsucu->SucuWeb($location,$request,$header,$action);

    if ($objsucu = "termina") 
    {

        $sucursalf=1;
    }
    
    $objusu = new usuariosweb();
    $objusu->UsuariosWeb($location,$request,$header,$action);

    if ($objusu = "termina") 
    {
        $usariosf=1;
    }
    

    $objprod = new productosweb();
    $objprod->prodWeb($location,$request,$header,$action);

    if ($objprod = "termina") 
    {

        $productosf=1;
    }
    

    
    $objinv = new inventarioweb();
    $objinv->invWeb($location,$request,$header,$action);

    if ($objinv = "termina") 
    {

        $inventariof=1;
    }
    
    
    echo json_encode(true);
    
    

    
   
    
    
        
         
        
    
    
    
    
    
    
    
  