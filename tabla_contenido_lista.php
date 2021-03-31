<script type="text/javascript">
	$(document).ready(function(){
		$(function() {
			$("#mfecha_publicacion").datepicker({
				dateFormat:"dd-mm-yy",
				dayNamesMin:[ "Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ],
				monthNames:[ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
			});
		});
	});
</script>
<?php
	session_start();
	require("head.php");
	require("config.php");
	require("librerias/basedatos.php");
	require("funciones_generales.php");

	//print_r($_POST);

	function guardar_act($bd)
	{
		global $basedatos;
		$fecha_publicacion=$_POST["fecha_publicacion"];
		$fecha_publicacion_num=strtotime($_POST["mfecha_publicacion"][8].$_POST["mfecha_publicacion"][9]."-".$_POST["mfecha_publicacion"][5].$_POST["mfecha_publicacion"][6]."-".$_POST["mfecha_publicacion"][0].$_POST["mfecha_publicacion"][1].$_POST["mfecha_publicacion"][2].$_POST["mfecha_publicacion"][3]);
		$mfecha_publicacion=$_POST["mfecha_publicacion"][6].$_POST["mfecha_publicacion"][7].$_POST["mfecha_publicacion"][8].$_POST["mfecha_publicacion"][9]."-".$_POST["mfecha_publicacion"][3].$_POST["mfecha_publicacion"][4]."-".$_POST["mfecha_publicacion"][0].$_POST["mfecha_publicacion"][1];
		$mfecha_publicacion_num=strtotime($_POST["mfecha_publicacion"][0].$_POST["mfecha_publicacion"][1]."-".$_POST["mfecha_publicacion"][3].$_POST["mfecha_publicacion"][4]."-".$_POST["mfecha_publicacion"][6].$_POST["mfecha_publicacion"][7].$_POST["mfecha_publicacion"][8].$_POST["mfecha_publicacion"][9]);
		if($bd->actualizar_datos(1,5,$basedatos,"tabla","id_tabla",$_POST["id_tabla"],"id_hipodromo",$_POST["id_hipodromo"],$_POST["mid_hipodromo"],"numero_carrera",$_POST["numero_carrera"],$_POST["mnumero_carrera"],"precio",$_POST["precio"],$_POST["mprecio"],"fecha_publicacion",$fecha_publicacion,$mfecha_publicacion,"fecha_publicacion_num",$fecha_publicacion_num,$mfecha_publicacion_num))
		{
			for($i=1;$i<=$_POST["n"];$i++)
			{
				if(isset($_POST["e_ejemplar_".$i]) and $_POST["e_ejemplar_".$i]=="v")
					$retirado="f";
				else
					$retirado="t";
				if(isset($_POST["me_ejemplar_".$i]) and $_POST["me_ejemplar_".$i]=="v")
					$mretirado="f";
				else
					$mretirado="t";
				if($bd->existe(2,"tabla_ejemplar","id_tabla",$_POST["id_tabla"],"num_ejemplar",$i))
				{
					if(!$bd->actualizar_datos(2,3,$basedatos,"tabla_ejemplar","id_tabla",$_POST["id_tabla"],"num_ejemplar",$i,"ejemplar_nombre",$_POST["ejemplar_".$i],$_POST["mejemplar_".$i],"costo",$_POST["costo_ejemplar_".$i],$_POST["mcosto_ejemplar_".$i],"retirado",$retirado,$mretirado))
					{
						return false;
					}
				}
				else//insertar
				{
					if(!$bd->insertar_datos(6,$basedatos,"tabla_ejemplar","id_tabla","ejemplar_nombre","num_ejemplar","costo","retirado","nova",$_POST["id_tabla"],$_POST["mejemplar_".$i],$i,$_POST["mcosto_ejemplar_".$i],$mretirado,"f"))
					{
						return false;
					}
				}
			}
			return true;
		}
		else
			return false;
	}

	function modificar_tabla_2($bd)
	{
		?>
		<form class="w3-container w3-card-4 w3-light-grey w3-margin" id="fmodificartabla2" name="fmodificartabla2" method="post">
			<div class="w3-row">
				<div class="w3-third">
					<h3 class="w3-text-blue">Tabla Fija</h3>
				</div>
				<div class="w3-third">
					<h4 class="w3-text-black">
						Hoy:
						<?php
							echo date("d-m-Y",time());
						?>
					</h4>
					<h4 class="w3-text-black">
						Publicaci&oacute;n:
						<?php
							echo $_POST["mfecha_publicacion"];
						?>
					</h4>
				</div>
				<div class="w3-rest" style="text-align:right;">
					<p>
						<?php 
							if(isset($_POST["mactiva"]))
								echo"<span class='w3-tag w3-green'>Activa</span>";
							else
								echo"<span class='w3-tag'>No Activa</span>";
						?>
						<?php 
							if(isset($_POST["mcerrada"]))
								echo"<span class='w3-tag'>Cerrada</span>";
							else
								echo"<span class='w3-tag w3-green'>Abierta</span>";
						?>
					</p>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-container w3-blue w3-quarter" style="border:1px solid #cccccc;text-align:center;">
					<p>
						<h4>
						<?php echo $_POST["mnumero_carrera"]; ?>
						</h4>
					</p>
				</div>
				<div class="w3-container w3-cell w3-half" style="border:1px solid #cccccc;">
					<p>
						<h4>
						<?php
							$sql="SELECT nombre FROM hipodromo WHERE id_hipodromo='".$_POST["mid_hipodromo"]."';";
							$result=pg_query($bd->link,$sql);
							unset($sql);
							if($result)
							{
								echo pg_fetch_result($result,0,"nombre");
								pg_free_result($result);
							}
							else
								unset($result);
						?>
						</h4>
					</p>
				</div>
				<div class="w3-container w3-quarter" style="border:1px solid #cccccc;text-align:right;">
					<p>
						<h4>
						<?php
							$n=$_POST["siguiente_act"];
							$porcentaje65=calcular_precio_act($n,"costo_ejemplar_","mcosto_ejemplar_","e_ejemplar_","me_ejemplar_");
							echo number_format($porcentaje65,2,",",".")."&nbsp;BsF<br>";
							echo"<input type='hidden' id='mprecio' name='mprecio' value='".$porcentaje65."'>";
							unset($porcentaje65);
						?>
						</h4>
					</p>
				</div>
			</div>
			<p>
			<table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white"> 
				<thead>
					<tr class="w3-blue">
						<th width="10px">#</th>
						<th>Ejemplar</th>
						<th>Costo</th>
						<th width="10px" nowrap>Retirado</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$n=$_POST["siguiente_act"];
						for($i=1;$i<=$n;$i++)
						{
							echo"<tr>";
							echo"<td><b>".$i."</b></td>";
							echo"<td>".$_POST["mejemplar_".$i]."</td>";
							echo"<td>";
								if(isset($_POST["e_ejemplar_".$i]) and isset($_POST["me_ejemplar_".$i]) and $_POST["e_ejemplar_".$i]=="v" and $_POST["me_ejemplar_".$i]=="r")
								{
									if(isset($_POST["costo_ejemplar_".$i]))
										echo "<font style='color:#ff0000;'>".number_format($_POST["costo_ejemplar_".$i],2,",",".")."</font>";
									else
										echo"&nbsp;";
								}
								elseif(isset($_POST["me_ejemplar_".$i]) and $_POST["me_ejemplar_".$i]=="r")
								{
									if(isset($_POST["mcosto_ejemplar_".$i]))
										echo "<font style='color:#ff0000;'>".number_format($_POST["mcosto_ejemplar_".$i],2,",",".")."</font>";
									else
										echo"&nbsp;";
								}
								else
								{
									if(isset($_POST["mcosto_ejemplar_".$i]))
										echo number_format($_POST["mcosto_ejemplar_".$i],2,",",".");
									else
										echo"&nbsp;";
								}
							echo"</td>";
							echo"<td align='center'>";
								echo"<center>";
								if(isset($_POST["me_ejemplar_".$i]) and $_POST["me_ejemplar_".$i]=="r")
									echo"<i class='icon-dot-circle-o'></i>";
								else
									echo"<i class='icon-circle-o'></i>";
								echo"</center>";
							echo"</td>";
							echo"</tr>";
							if(isset($_POST["num_ejemplar_".$i])) echo"<input type='hidden' id='num_ejemplar_".$i."' name='num_ejemplar_".$i."' value='".$_POST["num_ejemplar_".$i]."'>";
							if(isset($_POST["ejemplar_".$i])) echo"<input type='hidden' id='ejemplar_".$i."' name='ejemplar_".$i."' value='".$_POST["ejemplar_".$i]."'>";
							if(isset($_POST["mejemplar_".$i])) echo"<input type='hidden' id='mejemplar_".$i."' name='mejemplar_".$i."' value='".$_POST["mejemplar_".$i]."'>";
							if(isset($_POST["costo_ejemplar_".$i])) echo"<input type='hidden' id='costo_ejemplar_".$i."' name='costo_ejemplar_".$i."' value='".$_POST["costo_ejemplar_".$i]."'>";
							if(isset($_POST["mcosto_ejemplar_".$i])) echo"<input type='hidden' id='mcosto_ejemplar_".$i."' name='mcosto_ejemplar_".$i."' value='".$_POST["mcosto_ejemplar_".$i]."'>";
							if(isset($_POST["e_ejemplar_".$i])) echo"<input type='hidden' id='e_ejemplar_".$i."' name='e_ejemplar_".$i."' value='".$_POST["e_ejemplar_".$i]."'>";
							if(isset($_POST["me_ejemplar_".$i])) echo"<input type='hidden' id='me_ejemplar_".$i."' name='me_ejemplar_".$i."' value='".$_POST["me_ejemplar_".$i]."'>";
						}
						unset($n);
					?>
				</tbody>
			</table>
			</p>
			<input type="hidden" id="accion_modificar_atras" name="accion_modificar_atras">
			<input type="hidden" id="accion_modificar_guardar" name="accion_modificar_guardar">
			<p>
			<div class="w3-row-padding">
				<div class="w3-half">
					<input type="button" class="w3-button w3-block w3-red" onclick="submit_tabla_atras_act(<?php echo $_POST['id_tabla']; ?>);" value="< Atras">
				</div>
				<div class="w3-half">
					<input type="button" class="w3-button w3-block w3-green" onclick="submit_tabla_guardar_act(<?php echo $_POST['id_tabla']; ?>);" value="Guardar">
				</div>
			</div>
			</p>
			<?php
				if(isset($_POST["precio"])) echo"<input type='hidden' id='precio' name='precio' value='".$_POST["precio"]."'>";
				if(isset($_POST["fecha_publicacion"])) echo"<input type='hidden' id='fecha_publicacion' name='fecha_publicacion' value='".$_POST["fecha_publicacion"]."'>";
				if(isset($_POST["mfecha_publicacion"])) echo"<input type='hidden' id='mfecha_publicacion' name='mfecha_publicacion' value='".$_POST["mfecha_publicacion"]."'>";
				if(isset($_POST["activa"])) echo"<input type='hidden' id='activa' name='activa' value='".$_POST["activa"]."'>";
				if(isset($_POST["mactiva"])) echo"<input type='hidden' id='mactiva' name='mactiva' value='".$_POST["mactiva"]."'>";
				if(isset($_POST["cerrada"])) echo"<input type='hidden' id='cerrada' name='cerrada' value='".$_POST["cerrada"]."'>";
				if(isset($_POST["mcerrada"])) echo"<input type='hidden' id='mcerrada' name='mcerrada' value='".$_POST["mcerrada"]."'>";
				if(isset($_POST["numero_carrera"])) echo"<input type='hidden' id='numero_carrera' name='numero_carrera' value='".$_POST["numero_carrera"]."'>";
				if(isset($_POST["mnumero_carrera"])) echo"<input type='hidden' id='mnumero_carrera' name='mnumero_carrera' value='".$_POST["mnumero_carrera"]."'>";
				if(isset($_POST["id_hipodromo"])) echo"<input type='hidden' id='id_hipodromo' name='id_hipodromo' value='".$_POST["id_hipodromo"]."'>";
				if(isset($_POST["mid_hipodromo"])) echo"<input type='hidden' id='mid_hipodromo' name='mid_hipodromo' value='".$_POST["mid_hipodromo"]."'>";
				if(isset($_POST["sel_opcion"])) echo "<input type='hidden' id='sel_opcion' name='sel_opcion' value='".$_POST["sel_opcion"]."'>";
				if(isset($_POST["chbid_hipodromo"])) echo "<input type='hidden' id='chbid_hipodromo' name='chbid_hipodromo' value='".$_POST["chbid_hipodromo"]."'>";
				if(isset($_POST["bid_hipodromo"])) echo "<input type='hidden' id='bid_hipodromo' name='bid_hipodromo' value='".$_POST["bid_hipodromo"]."'>";
				if(isset($_POST["chbnumero_carrera"])) echo "<input type='hidden' id='chbnumero_carrera' name='chbnumero_carrera' value='".$_POST["chbnumero_carrera"]."'>";
				if(isset($_POST["bnumero_carrera"])) echo "<input type='hidden' id='bnumero_carrera' name='bnumero_carrera' value='".$_POST["bnumero_carrera"]."'>";
				if(isset($_POST["chbfecha_publicacion"])) echo "<input type='hidden' id='chbfecha_publicacion' name='chbfecha_publicacion' value='".$_POST["chbfecha_publicacion"]."'>";
				if(isset($_POST["bfecha_publicacion"])) echo "<input type='hidden' id='bfecha_publicacion' name='bfecha_publicacion' value='".$_POST["bfecha_publicacion"]."'>";
				if(isset($_POST["chbestatus"])) echo "<input type='hidden' id='chbestatus' name='chbestatus' value='".$_POST["chbestatus"]."'>";
				if(isset($_POST["bactiva"])) echo "<input type='hidden' id='bactiva' name='bactiva' value='".$_POST["bactiva"]."'>";
				if(isset($_POST["bcerrada"])) echo "<input type='hidden' id='bcerrada' name='bcerrada' value='".$_POST["bcerrada"]."'>";
				if(isset($_POST["pag"])) echo "<input type='hidden' id='pag' name='pag' value='".$_POST["pag"]."'>";
				if(isset($_POST["cantxpag"])) echo "<input type='hidden' id='cantxpag' name='cantxpag' value='".$_POST["cantxpag"]."'>";
				if(isset($_POST["siguiente_act"])) echo "<input type='hidden' id='n' name='n' value='".$_POST["siguiente_act"]."'>";
				if(isset($_POST["id_tabla"])) echo "<input type='hidden' id='id_tabla' name='id_tabla' value='".$_POST["id_tabla"]."'>";
			?>
		</form>
		<?php
	}

	function modificar_tabla($bd)
	{
		if(isset($_POST["accion_modificar"]))
			$id_tabla=$_POST["accion_modificar"];
		elseif(isset($_POST["accion_modificar_atras"]))
			$id_tabla=$_POST["accion_modificar_atras"];
		$sql="SELECT * FROM tabla WHERE id_tabla='".$id_tabla."';";
		$result=pg_query($bd->link,$sql);
		unset($sql);
		if($result)
		{
			?>
			<form class="w3-container w3-card-4 w3-light-grey w3-margin" id="fmodificartabla" name="fmodificartabla" method="post">
				<?php
					if(isset($_POST["mprecio"]))
						$precio=$_POST["mprecio"];
					else
						$precio=pg_fetch_result($result,0,"precio");
				?>
				<input type="hidden" id="precio" name="precio" value="<?php echo pg_fetch_result($result,0,'precio'); ?>">
				<h3 class="w3-text-blue">Tabla Fija - <?php echo number_format($precio,2,",",".")." BsF"; ?></h3>
				<div class="w3-row w3-section">
					<input type="hidden" id="id_hipodromo" name="id_hipodromo" value="<?php echo pg_fetch_result($result,0,'id_hipodromo'); ?>">
					<script type="text/javascript">
						document.getElementById("id_hipodromo").value="<?php echo pg_fetch_result($result,0,'id_hipodromo'); ?>";
					</script>
					<div class="w3-col" style="width:50px"><label for="mid_hipodromo" class="w3-text-blue"><i class="icon-menu" style="font-size:37px;"></i></label></div>
					<div class="w3-rest">
					<?php
						$sql="SELECT id_hipodromo, nombre FROM hipodromo;";
						$result2=pg_query($bd->link,$sql);
						unset($sql);
						if($result2)
						{
							?>
							<select class="w3-select w3-border" id="mid_hipodromo" name="mid_hipodromo" tabindex="1">
							<option value=''>Hip&oacute;dromo</option>
							<?php
							while($row2=pg_fetch_array($result2))
							{
								if((!isset($_POST["mid_hipodromo"]) and pg_fetch_result($result,0,"id_hipodromo")==$row2["id_hipodromo"]) or (isset($_POST["mid_hipodromo"]) and $_POST["mid_hipodromo"]==$row2["id_hipodromo"]))
									echo"<option value='".$row2["id_hipodromo"]."' selected>".$row2["nombre"]."</option>";
								else
									echo"<option value='".$row2["id_hipodromo"]."'>".$row2["nombre"]."</option>";
							}
							?>
							</select>
							<?php
							unset($row2);
							pg_free_result($result2);
						}
						else
							unset($result2);
					?>
					</div>
				</div>
				<div class="w3-row w3-section">
					<input type="hidden" id="numero_carrera" name="numero_carrera" value="<?php echo pg_fetch_result($result,0,'numero_carrera'); ?>">
					<script type="text/javascript">
						document.getElementById("numero_carrera").value="<?php echo pg_fetch_result($result,0,'numero_carrera'); ?>";
					</script>
					<div class="w3-col" style="width:50px"><label for="mnumero_carrera" class="w3-text-blue"><i class="icon-sort-numerically-outline" style="font-size:37px;"></i></label></div>
					<div class="w3-rest">
						<input class="w3-input w3-border" id="mnumero_carrera" name="mnumero_carrera" type="text" placeholder="# Carrera" onkeypress="return NumCheck2(event, this);" tabindex="2" value="<?php if(isset($_POST['mnumero_carrera'])) {echo $_POST['mnumero_carrera'];} else {echo pg_fetch_result($result,0,'numero_carrera');} ?>">
					</div>
				</div>
				<div class="w3-row w3-section">
					<input type="hidden" id="fecha_publicacion" name="fecha_publicacion" value="<?php echo pg_fetch_result($result,0,'fecha_publicacion'); ?>">
					<div class="w3-col" style="width:50px"><label for="mfecha_publicacion" class="w3-text-blue"><i class="icon-calendar" style="font-size:37px;"></i></label></div>
					<div class="w3-rest">
						<?php
							$fecha_publicacion=pg_fetch_result($result,0,'fecha_publicacion');
							$fecha_publicacion=$fecha_publicacion[8].$fecha_publicacion[9]."-".$fecha_publicacion[5].$fecha_publicacion[6]."-".$fecha_publicacion[0].$fecha_publicacion[1].$fecha_publicacion[2].$fecha_publicacion[3];
						?>
						<script type="text/javascript">
							document.getElementById("fecha_publicacion").value="<?php echo $fecha_publicacion; ?>";
						</script>
						<input class="w3-input w3-border" id="mfecha_publicacion" name="mfecha_publicacion" type="text" placeholder="DD-MM-AAAA" maxlength="10" value="<?php if(isset($_POST['mfecha_publicacion'])) {echo $_POST['mfecha_publicacion'];} else {echo $fecha_publicacion;} unset($fecha_publicacion); ?>">
					</div>
				</div>
				<div class="w3-row w3-section">
					<input type="hidden" id="activa" name="activa" value="<?php echo pg_fetch_result($result,0,'activa'); ?>">
					<input type="hidden" id="activa_act" name="activa_act">
					<input type="hidden" id="noactiva_act" name="noactiva_act">
					<table border="0">
						<tr>
							<td valign="middle">
								No Activa
							</td>
							<td>
								<label class="switch">
									<input type="checkbox" id="mactiva" name="mactiva" value="t" onclick="submit_activa_noactiva(<?php echo pg_fetch_result($result,0,'id_tabla'); ?>);"
									<?php
										if((isset($_POST["mactiva"]) and $_POST["mactiva"]=="t") or (pg_fetch_result($result,0,"activa")=="t"))
											echo"checked";
									?>
									>
									<span class="slider round"></span>
								</label>
							</td>
							<td valign="middle">
								Activa
							</td>
						</tr>
					</table>
				</div>
				<div class="w3-row w3-section">
					<input type="hidden" id="cerrada" name="cerrada" value="<?php echo pg_fetch_result($result,0,'cerrada'); ?>">
					<input type="hidden" id="cerrada_act" name="cerrada_act">
					<input type="hidden" id="abierta_act" name="abierta_act">
					<table border="0">
						<tr>
							<td valign="middle">
								Abierta
							</td>
							<td>
								<label class="switch">
									<input type="checkbox" id="mcerrada" name="mcerrada" value="t" onclick="submit_abierta_cerrada(<?php echo pg_fetch_result($result,0,'id_tabla'); ?>);"
									<?php
										if((isset($_POST["mcerrada"]) and $_POST["mcerrada"]=="t") or (pg_fetch_result($result,0,"cerrada")=="t"))
											echo"checked";
									?>
									>
									<span class="slider round"></span>
								</label>
							</td>
							<td valign="middle">
								Cerrada
							</td>
						</tr>
					</table>
				</div>
				<div id="divactivacerrada"></div>
				<div class="w3-row w3-section">
					<div class="w3-rest">
						<i class="icon-plus4 icon_mas" onclick="agregar_campos_act();"></i>
						&nbsp;
						<i class="icon-minus3 icon_menos" onclick="eliminar_campos_act();"></i>
					</div>
				</div>
				<p>
					<table border="0" id="tabla_1" name="tabla_1">
					<?php
						$sql="SELECT * FROM tabla_ejemplar WHERE id_tabla='".$id_tabla."' ORDER BY num_ejemplar;";
						$result2=pg_query($bd->link,$sql);
						unset($sql);
						if($result2)
						{
							$n=pg_num_rows($result2);
							if(!empty($n))
							{
								$i=0;
								while($row=pg_fetch_array($result2))
								{
									$i++;
									echo "<input type='hidden' id='num_ejemplar_".$row["num_ejemplar"]."' name='num_ejemplar_".$row["num_ejemplar"]."' value='".$row["num_ejemplar"]."'>";
									echo "<table border='0' id='tabla_".$row["num_ejemplar"]."' name='tabla_".$row["num_ejemplar"]."'>";
									echo "<tr>";
									echo "<td>".$row["num_ejemplar"]."</td>";
									echo "<td>";
									echo "<input type='hidden' id='ejemplar_".$row["num_ejemplar"]."' name='ejemplar_".$row["num_ejemplar"]."' value='".$row["ejemplar_nombre"]."'>";
									?>
									<script type="text/javascript">
										document.getElementById("ejemplar_"+<?php echo $row["num_ejemplar"]; ?>).value="<?php echo $row['ejemplar_nombre']; ?>";
									</script>
									<?php
									echo "<input class='w3-input w3-border' id='mejemplar_".$row["num_ejemplar"]."' name='mejemplar_".$row["num_ejemplar"]."' type='text' placeholder='Nombre del Ejemplar' value='";
									if(isset($_POST["mejemplar_".$row["num_ejemplar"]]))
										echo $_POST["mejemplar_".$row["num_ejemplar"]];
									else
										echo $row["ejemplar_nombre"];
									echo "'>";
									echo "</td>";
									echo "<td>";
									echo "<input type='hidden' id='costo_ejemplar_".$row["num_ejemplar"]."' name='costo_ejemplar_".$row["num_ejemplar"]."' value='".$row["costo"]."'>";
									?>
									<script type="text/javascript">
										document.getElementById("costo_ejemplar_"+<?php echo $row["num_ejemplar"]; ?>).value="<?php echo $row['costo']; ?>";
									</script>
									<?php
									if((isset($_POST["e_ejemplar_".$row["num_ejemplar"]]) and $_POST["e_ejemplar_".$row["num_ejemplar"]]=="r") or $row["retirado"]=="t")
										$retirado=true;
									else
										$retirado=false;
									if($row["nova"]=="t")
										$nova=true;
									echo "<input class='w3-input w3-border' id='mcosto_ejemplar_".$row["num_ejemplar"]."' name='mcosto_ejemplar_".$row["num_ejemplar"]."' type='text' placeholder='Costo' size='10' onkeypress='return NumCheck(event, this);' value='";
									if(isset($_POST["mcosto_ejemplar_".$row["num_ejemplar"]]))
										echo $_POST["mcosto_ejemplar_".$row["num_ejemplar"]];
									elseif(isset($_POST["e_ejemplar_".$row["num_ejemplar"]]) and isset($_POST["me_ejemplar_".$row["num_ejemplar"]]) and $_POST["e_ejemplar_".$row["num_ejemplar"]]=="v" and $_POST["me_ejemplar_".$row["num_ejemplar"]]=="r")
										echo $_POST["costo_ejemplar_".$row["num_ejemplar"]];
									else
										echo $row["costo"];
									echo "'>";
									echo "</td>";
									echo "<td>";
									echo "<input type='hidden' id='e_ejemplar_".$row["num_ejemplar"]."' name='e_ejemplar_".$row["num_ejemplar"]."' value='";
									if(!$retirado)
										echo "v";
									else
										echo "r";
									echo "'>";
									?>
									<script type="text/javascript">
										<?php
											if(!$retirado)
											{
										?>
											document.getElementById("e_ejemplar_"+<?php echo $row["num_ejemplar"]; ?>).value="v";
										<?php
											}
											else
											{
										?>
											document.getElementById("e_ejemplar_"+<?php echo $row["num_ejemplar"]; ?>).value="r";
										<?php
											}
										?>
									</script>
									<?php
									echo "<label>";
									echo "<input class='w3-check' type='radio' id='vme_ejemplar_".$row["num_ejemplar"]."' name='me_ejemplar_".$row["num_ejemplar"]."' value='v' onclick='habilitar_costo_act(this,".$row["num_ejemplar"].");' ";
									if((isset($_POST["me_ejemplar_".$row["num_ejemplar"]]) and $_POST["me_ejemplar_".$row["num_ejemplar"]]=="v") or (!isset($_POST["me_ejemplar_".$row["num_ejemplar"]]) and !$retirado))
										echo "checked";
									echo ">";
									echo "Va";
									echo "</label>";
									echo "<label>";
									echo "<input class='w3-check' type='radio' id='rme_ejemplar_".$row["num_ejemplar"]."' name='me_ejemplar_".$row["num_ejemplar"]."' value='r' onclick='deshabilitar_costo_act(this,".$row["num_ejemplar"].");' ";
									if((isset($_POST["me_ejemplar_".$row["num_ejemplar"]]) and $_POST["me_ejemplar_".$row["num_ejemplar"]]=="r") or (!isset($_POST["me_ejemplar_".$row["num_ejemplar"]]) and $retirado))
										echo "checked";
									echo ">";
									echo "Retirado";
									echo "</label>";
									echo "</td>";
									unset($retirado);
									echo "</tr>";
									echo "</table>";
								}
								$i++;
								while(isset($_POST["me_ejemplar_".$i]))
								{
									echo "<table border='0' id='tabla_".$i."' name='tabla_".$i."'>";
									echo "<tr>";
									echo "<td>".$i."</td>";
									echo "<td>";
									echo "<input class='w3-input w3-border' id='mejemplar_".$i."' name='mejemplar_".$i."' type='text' placeholder='Nombre del Ejemplar' value='";
									if(isset($_POST["mejemplar_".$i]))
										echo $_POST["mejemplar_".$i];
									echo "'>";
									echo "</td>";
									echo "<td>";
									echo "<input class='w3-input w3-border' id='mcosto_ejemplar_".$i."' name='mcosto_ejemplar_".$i."' type='text' placeholder='Costo' size='10' onkeypress='return NumCheck(event, this);' value='";
									if(isset($_POST["mcosto_ejemplar_".$i]))
										echo $_POST["mcosto_ejemplar_".$i];
									echo "'>";
									echo "</td>";
									echo "<td>";
									echo "<label>";
									echo "<input class='w3-check' type='radio' id='vme_ejemplar_".$i."' name='me_ejemplar_".$i."' value='v' onclick='habilitar_costo_act(this,".$i.");' ";
									if(isset($_POST["me_ejemplar_".$i]) and $_POST["me_ejemplar_".$i]=="v")
										echo "checked";
									echo ">";
									echo "Va";
									echo "</label>";
									echo "<label>";
									echo "<input class='w3-check' type='radio' id='rme_ejemplar_".$i."' name='me_ejemplar_".$i."' value='r' onclick='deshabilitar_costo_act(this,".$i.");' ";
									if(isset($_POST["me_ejemplar_".$i]) and $_POST["me_ejemplar_".$i]=="r")
										echo "checked";
									echo ">";
									echo "Retirado";
									echo "</label>";
									echo "</td>";
									echo "</tr>";
									echo "</table>";
									$i++;
								}
								$i--;
								if($n>$i)
									$x=$n-$i;
								else
									$x=$i-$n;
								?>
								<script type="text/javascript">
									asignar_nextinput_act(<?php echo $n+$x; ?>);
								</script>
								<?php
								unset($row);
							}
							unset($n);
							pg_free_result($result2);
						}
						else
							unset($result2);
					?>
					</table>
					<div id="campos_ejemplares_act"></div>
				</p>
				<input type="hidden" id="siguiente_act" name="siguiente_act">
				<input type="hidden" id="id_tabla" name="id_tabla">
				<p>
				<div class="w3-row-padding">
					<div class="w3-half">
						<input type="button" class="w3-button w3-block w3-red" onclick="submit_tabla_act_atras();" value="< Atras">
					</div>
					<div class="w3-half">
						<input type="button" class="w3-button w3-block w3-green" onclick="submit_tabla_act(<?php echo $id_tabla; ?>);" value="Siguiente >">
					</div>
				</div>
				</p>
				<?php
					if(isset($_POST["sel_opcion"])) echo "<input type='hidden' id='sel_opcion' name='sel_opcion' value='".$_POST["sel_opcion"]."'>";
					if(isset($_POST["chbid_hipodromo"])) echo "<input type='hidden' id='chbid_hipodromo' name='chbid_hipodromo' value='".$_POST["chbid_hipodromo"]."'>";
					if(isset($_POST["bid_hipodromo"])) echo "<input type='hidden' id='bid_hipodromo' name='bid_hipodromo' value='".$_POST["bid_hipodromo"]."'>";
					if(isset($_POST["chbnumero_carrera"])) echo "<input type='hidden' id='chbnumero_carrera' name='chbnumero_carrera' value='".$_POST["chbnumero_carrera"]."'>";
					if(isset($_POST["bnumero_carrera"])) echo "<input type='hidden' id='bnumero_carrera' name='bnumero_carrera' value='".$_POST["bnumero_carrera"]."'>";
					if(isset($_POST["chbfecha_publicacion"])) echo "<input type='hidden' id='chbfecha_publicacion' name='chbfecha_publicacion' value='".$_POST["chbfecha_publicacion"]."'>";
					if(isset($_POST["bfecha_publicacion"])) echo "<input type='hidden' id='bfecha_publicacion' name='bfecha_publicacion' value='".$_POST["bfecha_publicacion"]."'>";
					if(isset($_POST["chbestatus"])) echo "<input type='hidden' id='chbestatus' name='chbestatus' value='".$_POST["chbestatus"]."'>";
					if(isset($_POST["bactiva"])) echo "<input type='hidden' id='bactiva' name='bactiva' value='".$_POST["bactiva"]."'>";
					if(isset($_POST["bcerrada"])) echo "<input type='hidden' id='bcerrada' name='bcerrada' value='".$_POST["bcerrada"]."'>";
					if(isset($_POST["pag"])) echo "<input type='hidden' id='pag' name='pag' value='".$_POST["pag"]."'>";
					if(isset($_POST["cantxpag"])) echo "<input type='hidden' id='cantxpag' name='cantxpag' value='".$_POST["cantxpag"]."'>";
				?>
			</form>
			<?php
		}
		else
			unset($result);
	}

	function eliminar_tabla($bd)
	{
		global $basedatos;
		if($bd->eliminar_datos(1,$basedatos,"tabla_ejemplar","id_tabla",$_POST["accion_eliminar"]))
		{
			if($bd->eliminar_datos(1,$basedatos,"tabla","id_tabla",$_POST["accion_eliminar"]))
				return true;
			else
				return false;
		}
		else
			return false;
	}

	function mostrar_busqueda($result,$colespeciales,$bd,$pag=1,$cantxpag=20)
	{
		$fil=pg_num_rows($result);
		$cantpag=$fil/$cantxpag;
		$cantpag=ceil($cantpag);
		if($pag>$cantpag)
			$pag=$cantpag;
		for($i=1,$ini=0,$fin=$cantxpag-1;$i<$pag;$i++,$ini+=$cantxpag,$fin+=$cantxpag);
		?>
		<div class="w3-container">
			<p>
			<form id='form_tabla' name='form_tabla' method='post'>
				<div class="w3-row-padding">
					<div class="w3-third">
						<label for="pag">P&aacute;gina:</label>
						<select class="w3-select w3-border" id="pag" name="pag" onchange="document.getElementById('accion_modificar').value='';document.getElementById('accion_eliminar').value='';return enviardatos_lista();">
						<?php
							for($i=1;$i<=$cantpag;$i++)
							{
								if($i==$pag)
									echo"<option value='$i' selected>$i</option>";
								else
									echo"<option value='$i'>$i</option>";
							}
						?>
						</select>
					</div>
					<div class="w3-third">
						<label for="cantxpag">Cantidad de Registros por P&aacute;gina:</label>
						<input type="text" class="w3-input w3-border" id="cantxpag" name="cantxpag" onKeyPress="return NumCheck2(event, this)" value="<?php echo $cantxpag;?>">
					</div>
					<div class="w3-third">
						<br>
						<input type="button" class="w3-button w3-block w3-blue" id="mostrarxpag" name="mostrarxpag" value="Mostrar" onclick="document.getElementById('accion_modificar').value='';document.getElementById('accion_eliminar').value='';return enviardatos_lista();">
					</div>
				</div>
				<table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
					<thead>
						<tr class="w3-blue">
							<th class='tableheadresul' align='center'>&nbsp;</th>
							<?php
								$col=pg_num_fields($result);
								for($i=1;$i<$col;$i++)
								{
									?>
									<th class='tableheadresul' align='center' nowarp>
										<?php
											echo ucwords(pg_field_name($result,$i));
										?>
									</th>
									<?php
								}
								unset($i,$col);
							?>
						</tr>
					</thead>
					<tbody>
						<?php
							if($pag>1) for($i=0;$i<$pag-1;$i++) for($j=0;$j<$cantxpag;$j++) $row=pg_fetch_array($result);
							echo"<input type='hidden' id='accion_eliminar' name='accion_eliminar'>";
							echo"<input type='hidden' id='accion_modificar' name='accion_modificar'>";
							for($i=$ini;$i<=$fin and $i<$fil;$i++)
							{
								echo"<tr>";
								$row=pg_fetch_array($result);
								$num_col=count($row)/2;
								echo"<td align='center' nowrap>";
									echo"<i class='icon-cross2 icon_table' id='eliminar_<?php echo $i; ?>' name='eliminar_<?php echo $i; ?>' alt='Eliminar' title='Eliminar' ";
									?>
									onclick="document.getElementById('accion_modificar').value='';document.getElementById('accion_eliminar').value='<?php echo $row[0]; ?>';return confirmar_eliminar('<?php echo $row[0]; ?>');"
									<?php
									echo"'></i>";
									echo"&nbsp;&nbsp;";
									echo"<i class='icon-pencil icon_table' id='editar_<?php echo $i; ?>' name='editar_<?php echo $i; ?>' alt='Modificar' title='Modificar' ";
									?>
									onclick="document.getElementById('accion_eliminar').value='';document.getElementById('accion_modificar').value='<?php echo $row[0]; ?>';return enviardatos_lista();"
									<?php
									echo"'></i>";
								echo"</td>";
								for($j=1;$j<$num_col;$j++)
								{
									echo"<td align='center'>";
									if(!empty($row[$j]))
									{
										$especial=false;
										foreach($colespeciales as $indice=>$valor) 
										{
											if($indice==$j)
											{
												$especial=true;
												if(is_callable($valor))
													echo $valor($row[$j],$bd);
												else
													echo $row[$j];
											}
										}
										if(!$especial)
											echo $row[$j];
									}
									else
										echo"&nbsp;";
									echo"</td>";
								}
								echo"</tr>";
							}
						?>
					</tbody>
				</table>
				<?php
					if(isset($_POST["sel_opcion"])) echo"<input type='hidden' id='sel_opcion' name='sel_opcion' value='".$_POST["sel_opcion"]."'>";
					if(isset($_POST["chbid_hipodromo"])) echo"<input type='hidden' id='chbid_hipodromo' name='chbid_hipodromo' value='".$_POST["chbid_hipodromo"]."'>";
					if(isset($_POST["bid_hipodromo"])) echo"<input type='hidden' id='bid_hipodromo' name='bid_hipodromo' value='".$_POST["bid_hipodromo"]."'>";
					if(isset($_POST["chbnumero_carrera"])) echo"<input type='hidden' id='chbnumero_carrera' name='chbnumero_carrera' value='".$_POST["chbnumero_carrera"]."'>";
					if(isset($_POST["bnumero_carrera"])) echo"<input type='hidden' id='bnumero_carrera' name='bnumero_carrera' value='".$_POST["bnumero_carrera"]."'>";
					if(isset($_POST["chbfecha_publicacion"])) echo"<input type='hidden' id='chbfecha_publicacion' name='chbfecha_publicacion' value='".$_POST["chbfecha_publicacion"]."'>";
					if(isset($_POST["bfecha_publicacion"])) echo"<input type='hidden' id='bfecha_publicacion' name='bfecha_publicacion' value='".$_POST["bfecha_publicacion"]."'>";
					if(isset($_POST["chbestatus"])) echo"<input type='hidden' id='chbestatus' name='chbestatus' value='".$_POST["chbestatus"]."'>";
					if(isset($_POST["bactiva"])) echo"<input type='hidden' id='bactiva' name='bactiva' value='".$_POST["bactiva"]."'>";
					if(isset($_POST["bcerrada"])) echo"<input type='hidden' id='bcerrada' name='bcerrada' value='".$_POST["bcerrada"]."'>";
				?>
			</form>
			</p>
		</div>
		<?php
	}

	function crear_sql_busqueda($bd)
	{
		if(isset($_POST["sel_opcion"]) and $_POST["sel_opcion"]=="especificar")
		{
			$where=" ";
			if(isset($_POST["chbid_hipodromo"]) and !empty($_POST["bid_hipodromo"]))
				$where.="tabla.id_hipodromo='".$_POST["bid_hipodromo"]."' AND ";
			if(isset($_POST["chbnumero_carrera"]) and !empty($_POST["bnumero_carrera"]))
				$where.="numero_carrera='".$_POST["bnumero_carrera"]."' AND ";
			if(isset($_POST["chbfecha_publicacion"]) and !empty($_POST["bfecha_publicacion"]))
				$where.="fecha_publicacion_num='".$_POST["bfecha_publicacion"]."' AND ";
			if(isset($_POST["chbestatus"]))
			{
				if(isset($_POST["bactiva"]))
					$where.="activa='t' AND ";
				else
					$where.="activa='f' AND ";
				if(isset($_POST["bcerrada"]))
					$where.="cerrada='t' AND ";
				else
					$where.="cerrada='f' AND ";
			}
			$where[strlen($where)-1]=" ";
			$where[strlen($where)-2]=" ";
			$where[strlen($where)-3]=" ";
			$where[strlen($where)-4]=" ";
			$where=trim($where);
			$sql="SELECT tabla.id_tabla, hipodromo.nombre AS hipódromo, tabla.numero_carrera AS carrera, tabla.fecha_publicacion AS fecha, tabla.cerrada, tabla.activa FROM hipodromo, tabla WHERE hipodromo.id_hipodromo=tabla.id_hipodromo AND ".$where." ORDER BY fecha_num DESC;";
		}
		elseif(isset($_POST["sel_opcion"]) and $_POST["sel_opcion"]=="listar")
		{
			$sql="SELECT tabla.id_tabla, hipodromo.nombre AS hipódromo, tabla.numero_carrera AS carrera, tabla.fecha_publicacion AS fecha, tabla.cerrada, tabla.activa FROM hipodromo, tabla WHERE hipodromo.id_hipodromo=tabla.id_hipodromo ORDER BY fecha_num DESC;";
		}
		$result=pg_query($bd->link,$sql);
		unset($sql);
		if($result)
		{
			$n=pg_num_rows($result);
			if(!empty($n))
			{
				unset($n);
				return $result;
			}
			else
			{
				unset($n);
				pg_free_result($result);
				return false;
			}
			pg_free_result($result);
		}
		else
		{
			unset($result);
			return false;
		}
	}

	global $servidor, $puerto, $usuario, $pass, $basedatos;
	$bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
	if($bd->conectado)
	{
		if(isset($_POST["accion_modificar_guardar"]) and !empty($_POST["accion_modificar_guardar"]))
		{
			if(guardar_act($bd))
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","CAMBIOS GUARDADOS SATISFACTORIAMENTE").set('label', 'Aceptar');
				</script>
				<?php
			}
			else
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","ERROR AL INTENTAR GUARDAR CAMBIOS").set('label', 'Aceptar');
				</script>
				<?php
			}
		}
		elseif(isset($_POST["siguiente_act"]) and !empty($_POST["siguiente_act"]))
		{
			modificar_tabla_2($bd);
		}
		elseif(isset($_POST["accion_eliminar"]) and !empty($_POST["accion_eliminar"]))
		{
			if(eliminar_tabla($bd))
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","TABLA ELIMINADA SATISFACTORIAMENTE").set('label', 'Aceptar');
				</script>
				<?php
			}
			else
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					alertify.alert("","NO SE PUDO ELIMINAR LA TABLA").set('label', 'Aceptar');
				</script>
				<?php
			}
		}
		elseif((isset($_POST["accion_modificar"]) and !empty($_POST["accion_modificar"])) or (isset($_POST["accion_modificar_atras"]) and !empty($_POST["accion_modificar_atras"])))
		{
			modificar_tabla($bd);
		}
		elseif($result=crear_sql_busqueda($bd))
		{
			$colespeciales=array(3=>"fecha_dd_mm_yy", 4=>"boleano", 5=>"boleano");
			if(isset($_POST["pag"]) and !empty($_POST["pag"]))
				$pag=$_POST["pag"];
			if(isset($_POST["cantxpag"]) and !empty($_POST["cantxpag"]))
				$cantxpag=$_POST["cantxpag"];
			if(isset($pag) and isset($cantxpag))
				mostrar_busqueda($result,$colespeciales,$bd,$pag,$cantxpag);
			else
				mostrar_busqueda($result,$colespeciales,$bd);
		}
		else
		{
			?>
			<script language='JavaScript' type='text/JavaScript'>
				alertify.alert("","LA CONSULTA NO GENERO RESULTADOS").set('label', 'Aceptar');
			</script>
			<?php
		}
	}
?>