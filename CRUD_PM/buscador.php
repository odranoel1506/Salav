<?php

	require '../Config/conexion.php';
	
	$where = "WHERE part_number='Null'";
	
	if(!empty($_POST))
	{
		$valor = $_POST['campo'];
		if(!empty($valor)){
			$where = "WHERE part_number LIKE '%$valor'";
		}
	}
	$sqlpart = "SELECT * FROM catalogo_producto $where ";
	$resultadospart = $mysqli->query($sqlpart);




	$sql = "SELECT * FROM catalogo_producto";
    $resultado = $mysqli->query($sql);
	$array = array();

	if($resultado){
		while ($row = mysqli_fetch_array($resultado)) {
			$equipo = utf8_encode($row['part_number']);
			array_push($array, $equipo); // equipos
		}
	}
	
?>



<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="jquery-1.12.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery-ui.css">
	<script type="text/javascript" src="jquery-ui.js"></script>	

	<link rel="stylesheet" href="../estilos/header.css">
	<link href="css/style.css" rel="stylesheet">
</head>
	<header>
<!-- aquí comienza nuestro menu -->
	<div class="ancho">
		<div class="logo">
			<a href="../index.php"><img src="../estilos/imagenes/logo.png" class="imaa"></a>
		</div>
	</div>
</header>	
	<body>
		
		<div class="container">
			<div class="row">
				<h2 style="text-align:center">Modificacion Por Numero de Parte</h2>
			</div>
			
			<div class="row">
			
			
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					<b>Nombre: </b><input type="text" id="campo" name="campo" />
					<input type="submit" id="enviar" name="enviar" value="Buscar" class="" />
				</form>
			</div>
			
			<br>
			
			<div class="row table-responsive">
			<div id="tabble">	<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Producto</th>
							<th>Part Number</th>
							<th>Descripcion</th>
							<th>Url Ficha</th>
							<th>Imagen</th>
							<th>PDF</th>
							<th></th>
							
						</tr>
					</thead>
					
					<tbody>
						<?php while($row = $resultadospart->fetch_array(MYSQLI_ASSOC)) { ?>
							<tr>
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['Producto_LstPrec']; ?></td>
								<td><?php echo $row['part_number']; ?></td>
								<td><?php echo $row['descripcion']; ?></td>
								<td id="hf"><?php echo $row['url_ficha']; ?></td>
								<td id="hi"><img  width="70px" height="80px" src='<?php $imagea=$row['imglo'];echo $imagea ?>'></td>								
								<td id="hp"><?php 
								if($row['pdf']!=null || $row['pdf']!=""){

									echo "PDF cargado";
								}
								else{
									echo "";
								}
								
								 ?></td>
								<td><a href="modificar.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
								
							</tr>
						<?php } ?>
					</tbody>
				</table></div>
			</div>
		</div>
		
		
		<script type="text/javascript">
		$(document).ready(function () {
			var items = <?= json_encode($array) ?>

			$("#campo").autocomplete({
				source: items,
				select: function (event, item) {
					var params = {
						equipo: item.item.value
					};
				
				}
			});
		});
	</script>

	</body>
</html>	