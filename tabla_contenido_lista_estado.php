<?php
	session_start();
	require("head.php");
	require("config.php");
	require("librerias/basedatos.php");
	require("funciones_generales.php");

	function desactivar_resto_tablas($bd)
	{
		$sql="UPDATE tabla SET activa='f';";
		$result=pg_query($bd->link,$sql);
		unset($sql);
		pg_free_result($result);
	}

	function cerrar_resto_tablas($bd)
	{
		$sql="UPDATE tabla SET cerrada='f';";
		$result=pg_query($bd->link,$sql);
		unset($sql);
		pg_free_result($result);
	}

	function guardar_noactiva($bd)
	{
		global $basedatos;
		if($bd->actualizar_datos(1,1,$basedatos,"tabla","id_tabla",$_POST["noactiva_act"],"activa","x","f"))
			return true;
		else
			return false;
	}

	function guardar_activa($bd)
	{
		global $basedatos;
		desactivar_resto_tablas($bd);
		if($bd->actualizar_datos(1,1,$basedatos,"tabla","id_tabla",$_POST["activa_act"],"activa","x","t"))
			return true;
		else
			return false;
	}

	function guardar_abierta($bd)
	{
		global $basedatos;
		cerrar_resto_tablas($bd);
		if($bd->actualizar_datos(1,1,$basedatos,"tabla","id_tabla",$_POST["abierta_act"],"cerrada","x","f"))
			return true;
		else
			return false;
	}

	function guardar_cerrada($bd)
	{
		global $basedatos;
		if($bd->actualizar_datos(1,1,$basedatos,"tabla","id_tabla",$_POST["cerrada_act"],"cerrada","x","t"))
			return true;
		else
			return false;
	}

	global $servidor, $puerto, $usuario, $pass, $basedatos;
	$bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
	if($bd->conectado)
	{
		if(isset($_POST["noactiva_act"]) and !empty($_POST["noactiva_act"]))
		{
			if(guardar_noactiva($bd))
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","TABLA DESACTIVADA").set('label', 'Aceptar');
				</script>
				<?php
			}
			else
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","ERROR AL DESACTIVAR LA TABLA").set('label', 'Aceptar');
				</script>
				<?php
			}
		}
		if(isset($_POST["activa_act"]) and !empty($_POST["activa_act"]))
		{
			if(guardar_activa($bd))
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","TABLA ACTIVADA").set('label', 'Aceptar');
				</script>
				<?php
			}
			else
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","ERROR AL ACTIVAR LA TABLA").set('label', 'Aceptar');
				</script>
				<?php
			}
		}
		if(isset($_POST["abierta_act"]) and !empty($_POST["abierta_act"]))
		{
			if(guardar_abierta($bd))
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","ABIERTAS LAS APUESTAS").set('label', 'Aceptar');
				</script>
				<?php
			}
			else
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","ERROR AL ABRIR LAS APUESTAS").set('label', 'Aceptar');
				</script>
				<?php
			}
		}
		if(isset($_POST["cerrada_act"]) and !empty($_POST["cerrada_act"]))
		{
			if(guardar_cerrada($bd))
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","CERRADAS LAS APUESTAS").set('label', 'Aceptar');
				</script>
				<?php
			}
			else
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","ERROR AL CERRAR LAS APUESTAS").set('label', 'Aceptar');
				</script>
				<?php
			}
		}
	}
?>