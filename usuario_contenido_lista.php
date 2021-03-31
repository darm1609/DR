<?php
	session_start();
	require("head.php");
	require("config.php");
	require("librerias/basedatos.php");

	function formulario_lista($bd)
	{
		$sql="SELECT login_correo, nombre, apellido, admin FROM usuario;";
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
				<th></th>
				<th>Login</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Administrador</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$i=0;
				while($row=pg_fetch_array($result))
				{
					$i++;
					$login_correo=$row["login_correo"];
					echo"<tr>";
					echo"<td>";
					if($login_correo!="admin")
					{
						echo"<i class='icon-user-times icon_table' id='eliminar_<?php echo $i; ?>' name='eliminar_<?php echo $i; ?>' alt='Eliminar' title='Eliminar' onclick='";
						?>
						eliminar_usuario("<?php echo $login_correo; ?>");
						<?php
						echo"'></i>";
					}
					unset($login_correo);
					echo"</td>";
					echo"<td>".$row["login_correo"]."</td>";
					echo"<td>".$row["nombre"]."</td>";
					echo"<td>".$row["apellido"]."</td>";
					echo"<td>";
					if($row["admin"]=="t")
						echo"Si";
					else
						echo"No";
					echo"</td>";
					echo"</tr>";
				}
				?>
				</tbody>
				</table>
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
		if(isset($_POST["login_correo_eliminar"]) and !empty($_POST["login_correo_eliminar"]))
		{
			if($bd->eliminar_datos(1,$basedatos,"usuario","login_correo",$_POST["login_correo_eliminar"]))
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","USUARIO ELIMINADO SATISFACTORIAMENTE").set('label', 'Aceptar');
				</script>
				<?php
			}
			else
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","NO SE PUDO ELIMINAR EL USUARIO").set('label', 'Aceptar');
				</script>
				<?php
			}
		}
		formulario_lista($bd);
	}
?>