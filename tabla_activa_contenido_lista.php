<?php
	require("head.php");
	require("config.php");
	require("librerias/basedatos.php");
	require("funciones_generales.php");

	function hipodromo($id_hipodromo,$bd)
	{
		$sql="SELECT nombre FROM hipodromo WHERE id_hipodromo='".$id_hipodromo."';";
		$result=pg_query($bd->link,$sql);
		unset($sql);
		if($result)
		{
			return pg_fetch_result($result,0,"nombre");
		}
		else
			unset($result);
	}

	function mostrar($bd)
	{
		$sql="SELECT * FROM tabla WHERE activa='t';";
		$result=pg_query($bd->link,$sql);
		unset($sql);
		if($result)
		{
			$n=pg_num_rows($result);
			if(!empty($n))
			{
				?>
				<div class="padre">
				<div class="hijo">
				<form class="w3-container w3-card-4 w3-light-grey w3-margin" id="ftabla" name="ftabla" method="post">
					<p>
					<div class="w3-row" style="border:1px solid #cccccc;">
						<div class="w3-col m1 w3-center" style="font-size:23px;">
							<p><b>
								<?php
									echo pg_fetch_result($result,0,"numero_carrera");
									echo "<br>";
								?>
							</b></p>
						</div>
						<div class="w3-col m6 w3-left" style="font-size:23px;padding-left:10px;background-color:#5ca775;color:#ffffff;">
							<p><b>
								<?php
									echo hipodromo(pg_fetch_result($result,0,"id_hipodromo"),$bd);
								?>
							</b></p>
						</div>
						<div class="w3-col m5 w3-center" style="font-size:23px;background-color:#5ca775;color:#ffffff;">
							<p><b>
								<?php
									echo number_format(pg_fetch_result($result,0,"precio"),2,",",".")."&nbsp;BsF<br>";
								?>
							</b></p>
						</div>
					</div>
					<div class="w3-row">
						<table border="0" style='font-size:22px;border:1px solid #aaaaaa;' width="100%" cellpadding="5" cellspacing="0">
							<tr style="background-color:#97c6a7;">
								<td align="center">
									<b>Nro</b>
								</td>
								<td>
									<b>&nbsp;Nombre del Ejemplar</b>
								</td>
								<td align="center">
									<b>Costo</b>
								</td>
							</tr>
							<?php
								$sql="SELECT * FROM tabla_ejemplar WHERE id_tabla='".pg_fetch_result($result,0,"id_tabla")."' ORDER BY num_ejemplar ASC;";
								$result2=pg_query($bd->link,$sql);
								unset($sql);
								if($result2)
								{
									$i=0;
									while($row=pg_fetch_array($result2))
									{
										$i++;
										echo "<tr>";
										echo "<td align='center' style='background-color:#3f945b;'>".$row["num_ejemplar"]."</td>";
										echo "<td>&nbsp;";
										if($row["retirado"]=="t")
											echo "<font style='color:#ff0000;'>".$row["ejemplar_nombre"]."&nbsp;(Retirado)</font>";
										elseif($row["nova"]=="t")
											echo "<font style='color:#666666;'>".$row["ejemplar_nombre"]."&nbsp;(No va)</font>";
										else
											echo $row["ejemplar_nombre"];
										echo "</td>";
										echo "<td align='right' style='background-color:#3f945b;'>";
										if($row["retirado"]=="t")
											echo "<font style='color:#ff0000;'>".number_format($row["costo"],2,",",".")."</font>";
										elseif($row["nova"]=="t")
											echo "<font style='color:#666666;'>".number_format($row["costo"],2,",",".")."</font>";
										else
											echo number_format($row["costo"],2,",",".");
										echo "</td>";
										echo "</tr>";
									}
									$i++;
									for(;$i<=14;$i++)
									{
										echo "<tr>";
										echo "<td align='center' style='background-color:#3f945b;'>".$i."</td>";
										echo "<td>&nbsp;</td>";
										echo "<td style='background-color:#3f945b;'>&nbsp;</td>";
										echo "</tr>";
									}
									unset($row);
									pg_free_result($result2);
								}
								else
									unset($result2);
							?>
							<tr>
								<td colspan="3" align="center" style="background-color:#5ca775;color:#ffffff;">
									Se paga con el que cruce la meta en ganancia, <b>en caso de retiro</b> de &uacute;ltima hora <b>se resta el valor</b> del ejemplar retirado. <b>En caso de empate se divide el monto de la tabla entre los ejemplares ganadores</b>
								</td>
							</tr>
						</table>
					</div>
					</p>
				</form>
				</div>
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
		mostrar($bd);
	}
?>