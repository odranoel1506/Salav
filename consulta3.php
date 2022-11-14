<?php
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


$conn = mysqli_connect($hostname, $username, $password, $db);

if (!$conn) {
    echo "Failed to establish connection \n";
} else {
    echo "conexion exitosa \n";
}
$consultasiexisteinterfil = "SELECT DISTINCT sucursal_id FROM `inventario`";


$rowfuloexi = null;
$filas=array();
$ia=0;
$consultasiexisteinterfil = mysqli_query($conn, $consultasiexisteinterfil);
while ($fila = mysqli_fetch_assoc($consultasiexisteinterfil)) {
    $filas[$ia] = $fila["sucursal_id"];
    $filainve=$fila["sucursal_id"];
    $sqlml = "DROP TABLE IF EXISTS `inventarioos$filainve`";
    if ($conn->query($sqlml) === TRUE) {
        echo "ya existe la tabla inventarioo$filainve \n";
    } else {
        echo "no existe la tabla \n" . $conn->error;
    }
  
// sql Crea la tabla usando Lenguaje PHP
$sql = "CREATE TABLE inventarioos$filainve (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY) 
SELECT ProductosSalav.Marca,
 ProductosSalav.Modelo,
 ProductosSalav.Anio_inicio,
 ProductosSalav.Anio_fin,
 ProductosSalav.motor,
 proveedor.nombre, 
 catalogo_producto.descripcion,
 catalogo_producto.Precio,
 inventario.cantidad,
 catalogo_producto.url_ficha,
 catalogo_producto.imagen,
 catalogo_producto.pdf,
 catalogo_producto.clasificacionabc,
 catalogo_producto.part_number,
 inventario.sucursal_id,
 catalogo_producto.tipo
  FROM `ProductosSalav` INNER JOIN catalogo_producto on catalogo_producto.id= ProductosSalav.Id_catprod left join proveedor on proveedor.id= catalogo_producto.proveedor_id left join inventario on inventario.producto_id= catalogo_producto.id left join sucursal on sucursal.id= inventario.sucursal_id where`sucursal_id`='$filainve' ";


// Se verifica si la tabla ha sido creado
if ($conn->query($sql) === TRUE) {
    
    echo "la tabla inventarioos $filainve ha sido creado \n";
} else {
    echo "Hubo un error al crear la tabla inventarioos $filainve: " . $conn->error."\n";
}

}









// Cerramos la conexión
$conn->close();
