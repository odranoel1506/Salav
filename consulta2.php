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


$conn = mysqli_connect($hostname,$username,$password,$db);

if (!$conn)
{
echo "Failed to establish connection \n";
}
else{
echo "conexion exitosa \n";
}

$sqlml = 'DROP TABLE IF EXISTS `lubricante`';
if ($conn->query($sqlml) === TRUE) {
    echo "ya existe la tabla lubricante\n";
} else {
    echo "no existe la tabla \n" . $conn->error;
}




// sql Crea la tabla usando Lenguaje PHP
$sql = "CREATE TABLE lubricante (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY) 
SELECT catalogo_lubricantes.marca,catalogo_lubricantes.modelo,catalogo_lubricantes.anio_inicio,catalogo_lubricantes.anio_fin,catalogo_lubricantes.motor,lubricante_roshfrans.Tipo_lubricante,'' as nombre,'0 a 60,000 kl' as km,opcion_0_60.opcion_1,
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
        LEFT JOIN grasa_chasi on master_lubricantes.id_grasa_chasis= grasa_chasi.id";



// Se verifica si la tabla ha sido creado
if ($conn->query($sql) === TRUE) {
    echo "la tabla lubricante ha sido creado \n";
} else {
    echo "Hubo un error al crear la tabla lubricante: " . $conn->error."\n";
}





$sqldrop = 'DROP TABLE IF EXISTS `quimicos`';
if ($conn->query($sqldrop) === TRUE) {
    echo "ya existe la tabla quimicos \n";
} else {
    echo "no existe la tabla " . $conn->error."\n";
}




// sql Crea la tabla usando Lenguaje PHP
$sqlinve = "CREATE TABLE quimicos (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY) 
SELECT catalogo_producto.part_number,catalogo_quimicos.marca,catalogo_quimicos.aplicacion,catalogo_producto.Precio,catalogo_producto.url_ficha, catalogo_producto.imagen,catalogo_producto.pdf,catalogo_producto.clasificacionabc
      FROM `catalogo_quimicos`
      LEFT JOIN catalogo_producto on catalogo_producto.id=catalogo_quimicos.catalogoprod_id ";



// Se verifica si la tabla ha sido creado
if ($conn->query($sqlinve) === TRUE) {
    echo "la tabla quimicos ha sido creado \n";
} else {
    echo "Hubo un error al crear la tabla quimicos: " . $conn->error."\n";
}







// Cerramos la conexión
$conn->close();