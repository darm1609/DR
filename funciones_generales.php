<?php
	function usuario_admin($login)
	{
		// global $servidor, $puerto, $usuario, $pass, $basedatos;
		// $bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
		// if($bd->conectado)
		// {
		// 	$sql="SELECT admin FROM usuario WHERE login_correo='".$login."';";
		// 	$result=pg_query($bd->link,$sql);
		// 	unset($sql);
		// 	if($result)
		// 	{
		// 		$admin=pg_fetch_result($result,0,"admin");
		// 		pg_free_result($result);
		// 		if($admin=="t")
		// 			return true;
		// 		else
		// 			return false;
		// 	}
		// 	else
		// 		unset($result);
		// }
		return true;
	}

	function fecha_dd_mm_yy($cad,$bd=false)
	{
		return $cad[8].$cad[9]."-".$cad[5].$cad[6]."-".$cad[0].$cad[1].$cad[2].$cad[3];
	}

	function boleano($cad)
	{
		if($cad=="t")
			return "S&iacute;";
		else
			return "No";
	}

	function calcular_precio($n,$nombre_input)
	{
		$suma=0;
		for($i=1;$i<=$n;$i++)
		{
			if(isset($_POST[$nombre_input.$i]))
				$suma+=$_POST[$nombre_input.$i];
			else
				$suma+=0;
		}
		$porcentaje65=65*$suma/100;
		$porcentaje65=round($porcentaje65);
		$milesresto=$porcentaje65%1000;
		$centenasresto=$milesresto%100;
		if($centenasresto>=50)
		{
			$para100=100-$centenasresto;
			$porcentaje65+=$para100;
		}
		else
		{
			$porcentaje65-=$centenasresto;
		}
		unset($n,$suma,$milesresto,$centenasresto);
		return $porcentaje65;
	}

	function calcular_precio_act($n,$nombre_input_anterior,$nombre_input_nuevo,$nombre_input_estado_anterior,$nombre_input_estado_nuevo)
	{
		$suma=0;
		for($i=1;$i<=$n;$i++)
		{
			if(isset($_POST[$nombre_input_nuevo.$i]))
			{
				$suma+=$_POST[$nombre_input_nuevo.$i];
			}
			elseif(isset($_POST[$nombre_input_anterior.$i]))
			{
				$suma+=$_POST[$nombre_input_anterior.$i];
			}
			else
				$suma+=0;
		}
		$porcentaje65=65*$suma/100;
		$porcentaje65=round($porcentaje65);
		$milesresto=$porcentaje65%1000;
		$centenasresto=$milesresto%100;
		if($centenasresto>=50)
		{
			$para100=100-$centenasresto;
			$porcentaje65+=$para100;
		}
		else
		{
			$porcentaje65-=$centenasresto;
		}
		for($i=1;$i<=$n;$i++)
		{
			if(isset($_POST[$nombre_input_estado_anterior.$i]) and isset($_POST[$nombre_input_estado_nuevo.$i]) and $_POST[$nombre_input_estado_anterior.$i]=="v" and $_POST[$nombre_input_estado_nuevo.$i]=="r")
			{
				//$porcentaje70=$_POST[$nombre_input_anterior.$i]*0.7;
				$porcentaje70=$_POST[$nombre_input_nuevo.$i]*0.7;
				$porcentaje65-=$porcentaje70;
				unset($porcentaje70);
			}
			elseif($_POST[$nombre_input_estado_nuevo.$i]=="r")
			{
				$porcentaje70=$_POST[$nombre_input_nuevo.$i]*0.7;
				$porcentaje65-=$porcentaje70;
				unset($porcentaje70);
			}
		}
		$porcentaje65=round($porcentaje65);
		$milesresto=$porcentaje65%1000;
		$centenasresto=$milesresto%100;
		if($centenasresto>=50)
		{
			$para100=100-$centenasresto;
			$porcentaje65+=$para100;
		}
		else
		{
			$porcentaje65-=$centenasresto;
		}
		unset($n,$suma,$milesresto,$centenasresto);
		return $porcentaje65;
	}
?>