<?php
	session_start();
	require("head.php");
	require("config.php");
	require("librerias/basedatos.php");

	function formulario_lista($bd)
	{
		$sql="SELECT id_hipodromo, nombre FROM hipodromo;";
		$result=pg_query($bd->link,$sql);
		unset($sql);
		if($result)
		{
			$n=pg_num_rows($result);
			if(!empty($n))
			{
				?>
				<div class="w3-container">
				<table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
				<thead>
				<tr class="w3-blue">
				<th width="10px"></th>
				<th>Nombre</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$i=0;
				while($row=pg_fetch_array($result))
				{
					$i++;
					$id_hipodromo=$row["id_hipodromo"];
					$nombre=$row["nombre"];
					echo"<tr>";
					echo"<td>";
					echo"<i class='icon-cross2 icon_table' id='eliminar_<?php echo $i; ?>' name='eliminar_<?php echo $i; ?>' alt='Eliminar' title='Eliminar' onclick='";
					?>
					eliminar_hipodromo("<?php echo $id_hipodromo; ?>","<?php echo $nombre; ?>");
					<?php
					echo"'></i>";
					unset($id_hipodromo,$nombre);
					echo"</td>";
					echo"<td>".$row["nombre"]."</td>";
					echo"</tr>";
				}
				?>
				</tbody>
				</table>
				</div>
				<?php
			}
			else
			{
				?>
				<div class="w3-container w3-blue">
				  <h3>Informaci&oacute;n</h3>
				  <p>No hay hip&oacute;dromos agregados</p>
				</div> 
				<?php
			}
			unset($n);
			pg_free_result($result);
		}
		else
			unset($result);
	}

	global $servidor, $puerto, $usuario, $pass, $basedatos;
	$bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
	if($bd->conectado)
	{
		if(isset($_POST["id_hipodromo_eliminar"]) and !empty($_POST["id_hipodromo_eliminar"]))
		{
			if($bd->eliminar_datos(1,$basedatos,"hipodromo","id_hipodromo",$_POST["id_hipodromo_eliminar"]))
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","HIP\u00D3DROMO ELIMINADO SATISFACTORIAMENTE").set('label', 'Aceptar');
				</script>
				<?php
			}
			else
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","NO SE PUDO ELIMINAR EL HIP\u00D3DROMO").set('label', 'Aceptar');
				</script>
				<?php
			}
		}
		formulario_lista($bd);
	}
?>