<?php
	include_once 'conexion.php';
	$sentencia_select=$con->prepare('SELECT *FROM usuarios ORDER BY id DESC');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	if(isset($_POST['boton_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT *FROM usuarios WHERE nombre LIKE :campo OR apellidos LIKE :campo;'
		);
		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));
		$resultado=$select_buscar->fetchAll();
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Quaxar</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="accion">
		<h2>//--MI PRIMER CRUD EN PHP CON MYSQL--\\</h2>
		<div class="buscador">
			<form action="" class="form" method="post">
				<input type="text" name="buscar" placeholder="buscar (nombre, apellido)" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="boton_buscar" value="Buscar">
				<a href="insert.php" class="btn btn__nuevo">Nuevo</a>
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Nombre</td>
				<td>Apellidos</td>
				<td>Teléfono</td>
				<td>Ciudad de origen</td>
				<td>Correo empresarial</td>
				<td colspan="2">Opción:</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['apellidos']; ?></td>
					<td><?php echo $fila['telefono']; ?></td>
					<td><?php echo $fila['ciudad']; ?></td>
					<td><?php echo $fila['correo']; ?></td>
					<td><a href="update.php?id=<?php echo $fila['id']; ?>"  class="btn__update" >Editar  </a></td>
					<td><a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn__delete">  Eliminar</a></td>
				</tr>
			<?php endforeach ?>
		</table>
	</div>
</body>
</html>