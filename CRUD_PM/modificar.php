<?php
require '../Config/conexion.php';
	
	$id = $_GET['id'];
	
	$sql = "SELECT * FROM catalogo_producto WHERE id = '$id'";
	$resultado = $mysqli->query($sql);
	$row = $resultado->fetch_array(MYSQLI_ASSOC);


	
	
?>
<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
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
				<h3 style="text-align:center">MODIFICAR REGISTRO</h3>
			</div>
			
			<form class="form-horizontal" method="POST" action="update.php"  enctype="multipart/form-data" autocomplete="off">
				
				
				<input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>" />
				<input type="hidden" id="part_number" name="part_number" value="<?php echo $row['part_number']; ?>" />
				
				
			

				<div class="form-group">
					<label for="url_ficha" class="col-sm-2 control-label">Url Ficha</label>
					<div class="col-sm-10">
						<input type="url" class="form-control" id="url_ficha" name="url_ficha" placeholder="url_ficha" value="<?php echo $row['url_ficha']; ?>"  require>
					</div>
				</div>

				<div class="form-group">
					<label for="imagen" class="col-sm-2 control-label">Imagen</label>
					<div class="col-sm-10">
						
						<input   accept="image/png, image/jpeg" type="file" class="form-control" id="imagen" name="imagen" placeholder="imagen" value=""  require>
					</div>
				</div>

				<div class="form-group">
					<label for="pdf" class="col-sm-2 control-label">Pdf</label>
					<div class="col-sm-10">
						<input accept="application/pdf" type="file" class="form-control" id="pdf" name="pdf" placeholder="pdf" value=""  require>
					</div>
				</div>
				
				
				
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="buscador.php" class="btn btn-default">Regresar</a>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>