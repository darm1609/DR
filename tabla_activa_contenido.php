<style type="text/css">
	.padre 
	{
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.hijo
	{
		width: 65%;
	}

	@media all and (max-width: 934px), only screen and (-webkit-min-device-pixel-ratio: 2) and (max-width: 934px), only screen and (min--moz-device-pixel-ratio: 2) and (max-width: 934px), only screen and (-o-min-device-pixel-ratio: 2/1) and (max-width: 934px), only screen and (min-device-pixel-ratio: 2) and (max-width: 934px), only screen and (min-resolution: 192dpi) and (max-width: 934px), only screen and (min-resolution: 2dppx) and (max-width: 934px) {

		.hijo
		{
			width: 65%;
		}
	}

	@media all and (max-width: 855px), only screen and (-webkit-min-device-pixel-ratio: 2) and (max-width: 855px), only screen and (min--moz-device-pixel-ratio: 2) and (max-width: 855px), only screen and (-o-min-device-pixel-ratio: 2/1) and (max-width: 855px), only screen and (min-device-pixel-ratio: 2) and (max-width: 855px), only screen and (min-resolution: 192dpi) and (max-width: 855px), only screen and (min-resolution: 2dppx) and (max-width: 855px) {

		.hijo
		{
			width: 75%;
		}
	}

	@media all and (max-width: 720px), only screen and (-webkit-min-device-pixel-ratio: 2) and (max-width: 720px), only screen and (min--moz-device-pixel-ratio: 2) and (max-width: 720px), only screen and (-o-min-device-pixel-ratio: 2/1) and (max-width: 720px), only screen and (min-device-pixel-ratio: 2) and (max-width: 720px), only screen and (min-resolution: 192dpi) and (max-width: 720px), only screen and (min-resolution: 2dppx) and (max-width: 720px) {

		.hijo
		{
			width: 85%;
		}
	}

	@media all and (max-width: 630px), only screen and (-webkit-min-device-pixel-ratio: 2) and (max-width: 630px), only screen and (min--moz-device-pixel-ratio: 2) and (max-width: 630px), only screen and (-o-min-device-pixel-ratio: 2/1) and (max-width: 630px), only screen and (min-device-pixel-ratio: 2) and (max-width: 630px), only screen and (min-resolution: 192dpi) and (max-width: 630px), only screen and (min-resolution: 2dppx) and (max-width: 630px) {

		.hijo
		{
			width: 100%;
		}
	}
	
</style>
<script type="text/javascript">

	function enviardatos()
	{
		ajax=objetoAjax();
		$("#loader").show();
		$('#loader').html('<div style="display:block;width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
		ajax.open("POST","tabla_activa_contenido_lista.php",true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState == 1)
			{
				$('#loader').html('<div style="position:absolute;width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			}
			if (ajax.readyState == 4)
			{
				$.post("tabla_activa_contenido_lista.php",$("#form").serialize(),function(data)
				{
					$("#divrefrescar").show();
					$("#divrefrescar").html(data);
					$("#loader").hide();
				});
			}
		} 
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		ajax.send();
	}

	setInterval('enviardatos()',1000);
	
</script>
<?php
	
	

	global $servidor, $puerto, $usuario, $pass, $basedatos;
	$bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
	if($bd->conectado)
	{
		echo "<form id='form' name='form' method='post'></form>";
		echo "<div id='loader1' style='position:absolute;width:100%;'></div>";
		echo "<div id='divrefrescar'></div>";
	}
?>