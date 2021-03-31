<script type="text/javascript">
	
	$(document).ready(function(){
		$("#agregar_tabla").click(function(){
			if($("#divfagregar").is(':visible'))
				$("#divfagregar").hide("linear");
			else
				$("#divfagregar").show("swing");
		});

		$("#especificar").click(function(){
			$("#div_busqueda_especifica").show("swing");
		});

		$("#listar").click(function(){
			$("#div_busqueda_especifica").hide("linear");
		});

		$("#fecha_publicacion").datepicker({
			dateFormat:"dd-mm-yy",
			dayNamesMin:[ "Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ],
			monthNames:[ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
		});
	});

	function deshabilitar_costo(id,n)
	{
		if(id.checked)
		{
			document.getElementById('costo_ejemplar_'+n).value='';
			document.getElementById('costo_ejemplar_'+n).disabled=true;
		}
	}

	function habilitar_costo(id,n)
	{
		if(id.checked)
		{
			document.getElementById('costo_ejemplar_'+n).disabled=false;
		}
	}

	function deshabilitar_costo_act(id,n)
	{
		if(id.checked)
		{
			//document.getElementById('mcosto_ejemplar_'+n).disabled=true;
		}
	}

	function habilitar_costo_act(id,n)
	{
		if(id.checked)
		{
			//document.getElementById('mcosto_ejemplar_'+n).disabled=false;
		}
	}

	function habilitar_especificar()
	{
		document.getElementById('chbid_hipodromo').disabled=false;
		if(document.getElementById('chbid_hipodromo').checked)
			document.getElementById('bid_hipodromo').disabled=false;
		else
			document.getElementById('bid_hipodromo').disabled=true;
		document.getElementById('chbnumero_carrera').disabled=false;
		if(document.getElementById('chbnumero_carrera').checked)
			document.getElementById('bnumero_carrera').disabled=false;
		else
			document.getElementById('bnumero_carrera').disabled=true;
		document.getElementById('chbfecha_publicacion').disabled=false;
		if(document.getElementById('chbfecha_publicacion').checked)
			document.getElementById('bfecha_publicacion').disabled=false;
		else
			document.getElementById('bfecha_publicacion').disabled=true;
		document.getElementById('chbestatus').disabled=false;
		if(document.getElementById('chbestatus').checked)
		{
			document.getElementById('bactiva').disabled=false;
			document.getElementById('bcerrada').disabled=false;
		}
		else
		{
			document.getElementById('bactiva').disabled=true;
			document.getElementById('bcerrada').disabled=true;
		}
		
	}

	function deshabilitar_especificar()
	{
		document.getElementById('chbid_hipodromo').disabled=true;
		document.getElementById('bid_hipodromo').disabled=true;
		document.getElementById('chbnumero_carrera').disabled=true;
		document.getElementById('bnumero_carrera').disabled=true;
		document.getElementById('chbfecha_publicacion').disabled=true;
		document.getElementById('chbestatus').disabled=true;
		document.getElementById('bactiva').disabled=true;
		document.getElementById('bcerrada').disabled=true;
	}

	function submit_tabla_atras()
	{
		document.getElementById("atras").value="atras";
		document.getElementById("fagregartabla2").submit();
	}

	<?php
		if(isset($_POST["n"]))
			echo "var nextinput=".$_POST["n"].";";
		else
			echo "var nextinput=1;";
	?>

	function agregar_campos()
	{
		nextinput++;
		campo="<table border='0' id='tabla_"+nextinput+"' name='tabla_"+nextinput+"'><tr><td>"+nextinput+".</td><td><input class='w3-input w3-border' id='ejemplar_"+nextinput+"' name='ejemplar_"+nextinput+"' type='text' placeholder='Nombre del Ejemplar'></td>";
		campo+="<td>";
		campo+="<input class='w3-input w3-border' id='costo_ejemplar_"+nextinput+"' name='costo_ejemplar_"+nextinput+"' type='text' placeholder='Costo' size='10' onkeypress='return NumCheck(event, this);'>";
		campo+="</td>";
		campo+="<td>";
		campo+="<label><input class='w3-check' type='radio' id='e_ejemplar_"+nextinput+"' name='e_ejemplar_"+nextinput+"' value='v' onclick='habilitar_costo(this,"+nextinput+")' checked>Va</label>";
		campo+="<label><input class='w3-check' type='radio' id='e_ejemplar_"+nextinput+"' name='e_ejemplar_"+nextinput+"' value='r' onclick='deshabilitar_costo(this,"+nextinput+")'>Retirado</label>";
		campo+="<label><input class='w3-check' type='radio' id='e_ejemplar_"+nextinput+"' name='e_ejemplar_"+nextinput+"' value='n' onclick='deshabilitar_costo(this,"+nextinput+")'>No Va</label>";
		campo+="</td>";
		$("#campos_ejemplares").append(campo);
	}

	function eliminar_campos()
	{
		if(nextinput>=2)
		{
			$("#tabla_"+nextinput).remove();
			nextinput--;
			tabindex--;
		}
	}

	var nextinput_act;
	var nextinput_act_estatic;

	function asignar_nextinput_act(n)
	{
		nextinput_act=n;
		nextinput_act_estatic=n;
	}

	function agregar_campos_act()
	{
		nextinput_act++;
		campo="<table border='0' id='tabla_"+nextinput_act+"' name='tabla_"+nextinput_act+"'>";
		campo+="<tr>";
		campo+="<td>"+nextinput_act+"</td>";
		campo+="<td><input class='w3-input w3-border' id='mejemplar_"+nextinput_act+"' name='mejemplar_"+nextinput_act+"' type='text' placeholder='Nombre del Ejemplar'></td>";
		campo+="<td><input class='w3-input w3-border' id='mcosto_ejemplar_"+nextinput_act+"' name='mcosto_ejemplar_"+nextinput_act+"' type='text' placeholder='Costo' size='10' onkeypress='return NumCheck(event, this);'></td>";
		campo+="<td>";
		campo+="<label><input class='w3-check' type='radio' id='me_ejemplar_"+nextinput_act+"' name='me_ejemplar_"+nextinput_act+"' value='v' onclick='habilitar_costo_act(this,"+nextinput_act+")' checked>Va</label>";
		campo+="<label><input class='w3-check' type='radio' id='me_ejemplar_"+nextinput_act+"' name='me_ejemplar_"+nextinput_act+"' value='r' onclick='deshabilitar_costo_act(this,"+nextinput_act+")'>Retirado</label>";
		campo+="</td>";
		campo+="</tr>";
		campo+="</table>";
		$("#campos_ejemplares_act").append(campo);
	}

	function eliminar_campos_act()
	{
		if(nextinput_act>nextinput_act_estatic)
		{
			$("#tabla_"+nextinput_act).remove();
			nextinput_act--;
		}
	}

	function submit_tabla()
	{
		var valido=new Boolean(true);
		if(document.getElementById("id_hipodromo").value=="")
		{
			valido=false;
			alertify.alert("","DEBE SELECCIONAR UN HIPÓDROMO").set('label', 'Aceptar');
		}
		if(valido)
		{
			if(document.getElementById("numero_carrera").value=="")
			{
				valido=false;
				alertify.alert("","EL NÚMERO DE LA CARRERA NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
			}
			else
			{
				if(!/^([0-9])*$/.test(document.getElementById("numero_carrera").value))
				{
					valido=false;
					alertify.alert("","EL NÚMERO DE LA CARRERA NO ES VALIDO").set('label', 'Aceptar');
				}
			}
		}
		if(valido)
		{
			if(document.getElementById("fecha_publicacion").value=="")
			{
				valido=false;
				alertify.alert("","LA FECHA NO PUEDE ESTAR VACIA").set('label', 'Aceptar');
			}
			else
			{
				if(!existeFecha(document.getElementById("fecha_publicacion").value))
				{
					valido=false;
					alertify.alert("","LA FECHA NO ES VALIDA").set('label', 'Aceptar');
				}
			}
		}
		if(valido)
		{
			var i;
			for(i=1;i<=nextinput;i++)
			{
				if(document.getElementById("ejemplar_"+i).value=="")
				{
					valido=false;
					alertify.alert("","EL NOMBRE DEL EJEMPLAR "+i+" NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
					break;
				}
				if(valido)
				{
					if(!document.getElementById("costo_ejemplar_"+i).disabled)
					{
						if(document.getElementById("costo_ejemplar_"+i).value=="")
						{
							valido=false;
							alertify.alert("","EL COSTO DEL EJEMPLAR "+i+" NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
							break;
						}
						else
						{
							if(!/^([0-9])*$/.test(document.getElementById("costo_ejemplar_"+i).value))
							{
								valido=false;
								alertify.alert("","EL COSTO DEL EJEMPLAR "+i+" NO ES VALIDO").set('label', 'Aceptar');
								break;
							}
						}
					}
				}
			}
		}
		if(valido)
		{
			document.getElementById("siguiente").value=nextinput;
			document.getElementById("fagregartabla").submit();
		}
	}

	function submit_tabla_guardar()
	{
		document.getElementById("fagregartabla2").submit();
	}

	function enviardatos_busqueda()
	{
		var valido;
		valido=true;
		if(document.getElementById('especificar').checked)
		{
			if(!document.getElementById('chbid_hipodromo').checked && !document.getElementById('chbnumero_carrera').checked && !document.getElementById('chbfecha_publicacion').checked && !document.getElementById('chbestatus').checked)
			{
				valido=false;
				alertify.alert("","DEBE ESPECIFICAR UNA OPCIÓN DE BUSQUEDA").set('label', 'Aceptar');
			}
			if(document.getElementById('chbid_hipodromo').checked)
			{
				if(document.getElementById('bid_hipodromo').value=="")
				{
					valido=false;
					alertify.alert("","DEBE SELECCIONAR UN HIPÓDROMO").set('label', 'Aceptar');
				}
			}
			if(document.getElementById('chbnumero_carrera').checked)
			{
				if(document.getElementById('bnumero_carrera').value=="")
				{
					valido=false;
					alertify.alert("","DEBE SELECCIONAR UN NÚMERO DE CARRERA").set('label', 'Aceptar');
				}
			}
			if(document.getElementById('chbfecha_publicacion').checked)
			{
				if(document.getElementById('bfecha_publicacion').value=="")
				{
					valido=false;
					alertify.alert("","DEBE SELECCIONAR UNA FECHA DE PUBLICACIÓN").set('label', 'Aceptar');
				}
			}
		}
		if(valido)
		{
			ajax=objetoAjax();
			$("#loader").show();
			$('#loader').html('<div style="display:block;width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			ajax.open("POST","tabla_contenido_lista.php",true);
			ajax.onreadystatechange = function() 
			{
				if (ajax.readyState == 1)
				{
					$('#loader').html('<div style="position:absolute;width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
				}
				if (ajax.readyState == 4)
				{
					$.post("tabla_contenido_lista.php",$("#fbusqueda").serialize(),function(data)
				    {
				    	$("#divformulariolista").show();
						$("#divformulariolista").html(data);
				    	$("#loader").hide();
				    });
				}
			} 
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
			ajax.send();
		}
		else
		{
			$("#divformulariolista").hide();
		}
	}

	function enviardatos_lista()
	{
		ajax=objetoAjax();
		$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
		ajax.open("POST","tabla_contenido_lista.php",true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState == 1)
			{
				$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			}
			if (ajax.readyState == 4)
			{
				$.post("tabla_contenido_lista.php",$("#form_tabla").serialize(),function(data)
				{
					$("#divformulariolista").show();
					$("#divformulariolista").html(data);
					$("#loader").hide();
				});
			}
		} 
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		ajax.send();
	}

	function confirmar_eliminar(id)
	{
		alertify.confirm('','Eliminar la tabla', function(){ alertify.success('Sí');enviardatos_lista(); }, function(){ alertify.error('No')}).set('labels', {ok:'Sí', cancel:'No'});
	}

	function enviardatos_lista_act()
	{
		ajax=objetoAjax();
		$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
		ajax.open("POST","tabla_contenido_lista.php",true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState == 1)
			{
				$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			}
			if (ajax.readyState == 4)
			{
				$.post("tabla_contenido_lista.php",$("#fmodificartabla").serialize(),function(data)
				{
					$("#divformulariolista").show();
					$("#divformulariolista").html(data);
					$("#loader").hide();
				});
			}
		} 
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		ajax.send();
	}

	function enviardatos_lista_act_atras()
	{
		ajax=objetoAjax();
		$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
		ajax.open("POST","tabla_contenido_lista.php",true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState == 1)
			{
				$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			}
			if (ajax.readyState == 4)
			{
				$.post("tabla_contenido_lista.php",$("#fmodificartabla").serialize(),function(data)
				{
					$("#divformulariolista").show();
					$("#divformulariolista").html(data);
					$("#loader").hide();
				});
			}
		} 
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		ajax.send();
	}

	function submit_tabla_act_atras()
	{
		enviardatos_lista_act_atras();
	}

	function submit_tabla_act(id_tabla)
	{
		var valido=new Boolean(true);
		var cambio=new Boolean(false);
		valido=true;
		cambio=false;
		if(document.getElementById("id_hipodromo").value!=document.getElementById("mid_hipodromo").value)
		{
			cambio=true;
			if(document.getElementById("mid_hipodromo").value=="")
			{
				valido=false;
				alertify.alert("","DEBE SELECCIONAR UN HIPÓDROMO").set('label', 'Aceptar');
			}
		}
		if(valido)
		{
			if(document.getElementById("numero_carrera").value!=document.getElementById("mnumero_carrera").value)
			{
				cambio=true;
				if(document.getElementById("mnumero_carrera").value=="")
				{
					valido=false;
					alertify.alert("","EL NÚMERO DE LA CARRERA NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
				}
				else
				{
					if(!/^([0-9])*$/.test(document.getElementById("mnumero_carrera").value))
					{
						valido=false;
						alertify.alert("","EL NÚMERO DE LA CARRERA NO ES VALIDO").set('label', 'Aceptar');
					}
				}
			}
		}
		if(valido)
		{
			if(document.getElementById("fecha_publicacion").value!=document.getElementById("mfecha_publicacion").value)
			{
				cambio=true;
				if(document.getElementById("mfecha_publicacion").value=="")
				{
					valido=false;
					alertify.alert("","LA FECHA NO PUEDE ESTAR VACIA").set('label', 'Aceptar');
				}
				else
				{
					if(!existeFecha(document.getElementById("mfecha_publicacion").value))
					{
						valido=false;
						alertify.alert("","LA FECHA NO ES VALIDA").set('label', 'Aceptar');
					}
				}
			}
		}
		if(valido)
		{
			var i;
			for(i=1;i<=nextinput_act_estatic;i++)
			{
				if(document.getElementById("ejemplar_"+i)!=null && document.getElementById("mejemplar_"+i)!=null)
				{
					if(document.getElementById("ejemplar_"+i).value!=document.getElementById("mejemplar_"+i).value)
					{
						cambio=true;
						if(document.getElementById("mejemplar_"+i).value=="")
						{
							valido=false;
							alertify.alert("","EL NOMBRE DEL EJEMPLAR "+i+" NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
							break;
						}
					}
				}
				if(valido)
				{
					if(document.getElementById("ejemplar_"+i)==null && document.getElementById("mejemplar_"+i)!=null)
					{
						cambio=true;
						if(document.getElementById("mejemplar_"+i).value=="")
						{
							valido=false;
							alertify.alert("","EL NOMBRE DEL EJEMPLAR "+i+" NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
							break;
						}
					}
				}
				if(valido)
				{
					if(document.getElementById("costo_ejemplar_"+i)==null && document.getElementById("mcosto_ejemplar_"+i)!=null)
					{
						cambio=true;
						if(document.getElementById("mcosto_ejemplar_"+i).value=="")
						{
							valido=false;
							alertify.alert("","EL COSTO DEL EJEMPLAR "+i+" NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
							break;
						}
						else
						{
							if(!/^([0-9])*$/.test(document.getElementById("mcosto_ejemplar_"+i).value))
							{
								valido=false;
								alertify.alert("","EL COSTO DEL EJEMPLAR "+i+" NO ES VALIDO").set('label', 'Aceptar');
								break;
							}
						}
					}
				}
				if(valido)
				{
					if(document.getElementById("e_ejemplar_"+i)!=null && document.getElementById("vme_ejemplar_"+i)!=null && document.getElementById("costo_ejemplar_"+i)!=null && document.getElementById("mcosto_ejemplar_"+i)!=null)
					{
						if((document.getElementById("e_ejemplar_"+i).value=="v" && !document.getElementById("vme_ejemplar_"+i).checked) || (document.getElementById("e_ejemplar_"+i).value=="r" && !document.getElementById("rme_ejemplar_"+i).checked))
						{
							cambio=true;
						}
						if((document.getElementById("costo_ejemplar_"+i).value!="" && document.getElementById("mcosto_ejemplar_"+i).disabled) && (document.getElementById("costo_ejemplar_"+i).value=="" && !document.getElementById("mcosto_ejemplar_"+i).disabled))
						{
							cambio=true;
						}
						if(document.getElementById("costo_ejemplar_"+i).value!=document.getElementById("mcosto_ejemplar_"+i).value)
						{
							cambio=true;
						}
						if(document.getElementById("vme_ejemplar_"+i).checked)
						{
							if(document.getElementById("mcosto_ejemplar_"+i).value=="")
							{
								valido=false;
								alertify.alert("","EL COSTO DEL EJEMPLAR "+i+" NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
								break;
							}
							else
							{
								if(!/^([0-9])*$/.test(document.getElementById("mcosto_ejemplar_"+i).value))
								{
									valido=false;
									alertify.alert("","EL COSTO DEL EJEMPLAR "+i+" NO ES VALIDO").set('label', 'Aceptar');
									break;
								}
							}
						}
					}
				}
			}
			for(i=nextinput_act_estatic+1;i<=nextinput_act;i++)
			{
				cambio=true;alert(10);
				if(document.getElementById("mejemplar_"+i).value=="")
				{
					valido=false;
					alertify.alert("","EL NOMBRE DEL EJEMPLAR "+i+" NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
					break;
				}
				if(valido)
				{
					if(!document.getElementById("mcosto_ejemplar_"+i).disabled)
					{
						if(document.getElementById("mcosto_ejemplar_"+i).value=="")
						{
							valido=false;
							alertify.alert("","EL COSTO DEL EJEMPLAR "+i+" NO PUEDE ESTAR VACIO").set('label', 'Aceptar');
							break;
						}
						else
						{
							if(!/^([0-9])*$/.test(document.getElementById("mcosto_ejemplar_"+i).value))
							{
								valido=false;
								alertify.alert("","EL COSTO DEL EJEMPLAR "+i+" NO ES VALIDO").set('label', 'Aceptar');
								break;
							}
						}
					}
				}
			}
		}
		if(!cambio)
			alertify.alert("","NO HAY CAMBIOS").set('label', 'Aceptar');
		else
		{
			if(valido)
			{
				document.getElementById("siguiente_act").value=nextinput_act;
				document.getElementById("id_tabla").value=id_tabla;
				enviardatos_lista_act();
			}
		}
	}

	function submit_abierta_cerrada(id_tabla)
	{
		if(!document.getElementById("mcerrada").checked)
		{
			document.getElementById("cerrada_act").value="";
			document.getElementById("abierta_act").value=id_tabla;
			document.getElementById("activa_act").value="";
			document.getElementById("noactiva_act").value="";
		}
		else
		{
			document.getElementById("abierta_act").value="";
			document.getElementById("cerrada_act").value=id_tabla;
			document.getElementById("activa_act").value="";
			document.getElementById("noactiva_act").value="";
		}
		ajax=objetoAjax();
		$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
		ajax.open("POST","tabla_contenido_lista_estado.php",true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState == 1)
			{
				$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			}
			if (ajax.readyState == 4)
			{
				$.post("tabla_contenido_lista_estado.php",$("#fmodificartabla").serialize(),function(data)
				{
					$("#divactivacerrada").show();
					$("#divactivacerrada").html(data);
					$("#loader").hide();
				});
			}
		} 
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		ajax.send();
	}

	function submit_activa_noactiva(id_tabla)
	{
		if(!document.getElementById("mactiva").checked)
		{
			document.getElementById("activa_act").value="";
			document.getElementById("noactiva_act").value=id_tabla;
			document.getElementById("cerrada_act").value="";
			document.getElementById("abierta_act").value="";
		}
		else
		{
			document.getElementById("noactiva_act").value="";
			document.getElementById("activa_act").value=id_tabla;
			document.getElementById("cerrada_act").value="";
			document.getElementById("abierta_act").value="";
		}
		ajax=objetoAjax();
		$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
		ajax.open("POST","tabla_contenido_lista_estado.php",true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState == 1)
			{
				$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			}
			if (ajax.readyState == 4)
			{
				$.post("tabla_contenido_lista_estado.php",$("#fmodificartabla").serialize(),function(data)
				{
					$("#divactivacerrada").show();
					$("#divactivacerrada").html(data);
					$("#loader").hide();
				});
			}
		} 
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		ajax.send();
	}

	function submit_tabla_atras_act(id_tabla)
	{
		document.getElementById("accion_modificar_atras").value=id_tabla;
		ajax=objetoAjax();
		$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
		ajax.open("POST","tabla_contenido_lista.php",true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState == 1)
			{
				$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			}
			if (ajax.readyState == 4)
			{
				$.post("tabla_contenido_lista.php",$("#fmodificartabla2").serialize(),function(data)
				{
					$("#divformulariolista").show();
					$("#divformulariolista").html(data);
					$("#loader").hide();
				});
			}
		} 
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		ajax.send();
	}

	function submit_tabla_guardar_act(id_tabla)
	{
		document.getElementById("accion_modificar_guardar").value=id_tabla;
		ajax=objetoAjax();
		$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
		ajax.open("POST","tabla_contenido_lista.php",true);
		ajax.onreadystatechange = function() 
		{
			if (ajax.readyState == 1)
			{
				$('#loader').html('<div style="width:100%;text-align:center;"><img src="imagenes/loader.gif"/></div>');
			}
			if (ajax.readyState == 4)
			{
				$.post("tabla_contenido_lista.php",$("#fmodificartabla2").serialize(),function(data)
				{
					$("#divformulariolista").show();
					$("#divformulariolista").html(data);
					$("#loader").hide();
				});
			}
		} 
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		ajax.send();
	}

</script>
<header class="w3-container" style="padding-top:22px">
	<h5><b>Tablas Fijas</b></h5>
</header>
<form id="flistat" name="flistat" method="post">
	<input type="hidden" id="id_tabla_eliminar" name="id_tabla_eliminar">
	<input type="hidden" id="id_tabla_editar" name="id_tabla_editar">
</form>
<?php

	//print_r($_POST);

	function desactivar_resto_tablas($bd)
	{
		$sql="UPDATE tabla SET activa='f';";
		$result=pg_query($bd->link,$sql);
		unset($sql);
		pg_free_result($result);
	}

	function guardar_tabla($bd)
	{
		global $basedatos;
		if(isset($_POST["activa"]))
		{
			$activa="t";
			desactivar_resto_tablas($bd);
		}
		else
			$activa="f";
		if(isset($_POST["cerrada"]))
			$cerrada="t";
		else
			$cerrada="f";
		$fecha_publicacion=$_POST["fecha_publicacion"][6].$_POST["fecha_publicacion"][7].$_POST["fecha_publicacion"][8].$_POST["fecha_publicacion"][9]."-".$_POST["fecha_publicacion"][3].$_POST["fecha_publicacion"][4]."-".$_POST["fecha_publicacion"][0].$_POST["fecha_publicacion"][1];
		$fecha_publicacion_num=strtotime($_POST["fecha_publicacion"][0].$_POST["fecha_publicacion"][1]."-".$_POST["fecha_publicacion"][3].$_POST["fecha_publicacion"][4]."-".$_POST["fecha_publicacion"][6].$_POST["fecha_publicacion"][7].$_POST["fecha_publicacion"][8].$_POST["fecha_publicacion"][9]);
		if($bd->insertar_datos(10,$basedatos,"tabla","id_hipodromo","login_correo","numero_carrera","fecha","fecha_num","precio","activa","cerrada","fecha_publicacion","fecha_publicacion_num",$_POST["id_hipodromo"],$_SESSION["login"],$_POST["numero_carrera"],date("Y-m-d",time()),time(),$_POST["precio"],$activa,$cerrada,$fecha_publicacion,$fecha_publicacion_num,"id_tabla"))
		{
			$id_tabla=pg_fetch_result($bd->ultimo_result,0,"id_tabla");
			for($i=1;$i<=$_POST["n"];$i++)
			{
				if($_POST["e_ejemplar_".$i]=="r")
					$retirado="t";
				else
					$retirado="f";
				if($_POST["e_ejemplar_".$i]=="n")
					$nova="t";
				else
					$nova="f";
				if(isset($_POST["costo_ejemplar_".$i]))
					$costo=$_POST["costo_ejemplar_".$i];
				else
					$costo=NULL;
				if(!$bd->insertar_datos(6,$basedatos,"tabla_ejemplar","id_tabla","ejemplar_nombre","num_ejemplar","costo","retirado","nova",$id_tabla,$_POST["ejemplar_".$i],$i,$costo,$retirado,$nova))
				{
					$bd->eliminar_datos(1,$basedatos,"tabla","id_tabla",$id_tabla);
					return false;
				}
				unset($retirado,$nova,$costo);
			}
			unset($id_tabla);
			return true;
		}
		else
			return false;
	}

	function formulario_agregar_tabla_2($bd)
	{
		?>
		<form class="w3-container w3-card-4 w3-light-grey w3-margin" id="fagregartabla2" name="fagregartabla2" method="post">
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
							echo $_POST["fecha_publicacion"];
						?>
					</h4>
				</div>
				<div class="w3-rest" style="text-align:right;">
					<p>
						<?php 
							if(isset($_POST["activa"]))
								echo"<span class='w3-tag w3-green'>Activa</span>";
							else
								echo"<span class='w3-tag'>No Activa</span>";
						?>
						<?php 
							if(isset($_POST["cerrada"]))
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
						<?php echo $_POST["numero_carrera"]; ?>
						</h4>
					</p>
				</div>
				<div class="w3-container w3-cell w3-half" style="border:1px solid #cccccc;">
					<p>
						<h4>
						<?php
							$sql="SELECT nombre FROM hipodromo WHERE id_hipodromo='".$_POST["id_hipodromo"]."';";
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
								$n=$_POST["siguiente"];
								$porcentaje65=calcular_precio($n,"costo_ejemplar_");
								echo number_format($porcentaje65,2,",",".")."&nbsp;BsF<br>";
								echo"<input type='hidden' id='precio' name='precio' value='".$porcentaje65."'>";
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
						<th width="10px" nowrap>No&nbsp;Va</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$n=$_POST["siguiente"];
						for($i=1;$i<=$n;$i++)
						{
							echo"<tr>";
							echo"<td><b>".$i."</b></td>";
							echo"<td>".$_POST["ejemplar_".$i]."</td>";
							echo"<td>";
								if(isset($_POST["costo_ejemplar_".$i]))
									echo number_format($_POST["costo_ejemplar_".$i],2,",",".");
								else
									echo"&nbsp;";
							echo"</td>";
							echo"<td align='center'>";
								echo"<center>";
								if(isset($_POST["e_ejemplar_".$i]) and $_POST["e_ejemplar_".$i]=="r")
									echo"<i class='icon-dot-circle-o'></i>";
								else
									echo"<i class='icon-circle-o'></i>";
								echo"</center>";
							echo"</td>";
							echo"<td align='center'>";
								echo"<center>";
								if(isset($_POST["e_ejemplar_".$i]) and $_POST["e_ejemplar_".$i]=="n")
									echo"<i class='icon-dot-circle-o'></i>";
								else
									echo"<i class='icon-circle-o'></i>";
								echo"</center>";
							echo"</td>";
							echo"</tr>";
							echo"<input type='hidden' id='ejemplar_".$i."' name='ejemplar_".$i."' value='".$_POST["ejemplar_".$i]."'>";
							if(isset($_POST["costo_ejemplar_".$i])) echo"<input type='hidden' id='costo_ejemplar_".$i."' name='costo_ejemplar_".$i."' value='".$_POST["costo_ejemplar_".$i]."'>";
							echo"<input type='hidden' id='e_ejemplar_".$i."' name='e_ejemplar_".$i."' value='".$_POST["e_ejemplar_".$i]."'>";
						}
						unset($n);
					?>
				</tbody>
			</table>
			</p>
			<p>
			<div class="w3-row-padding">
				<div class="w3-half">
					<input type="button" class="w3-button w3-block w3-red" onclick="submit_tabla_atras();" value="< Atras">
				</div>
				<div class="w3-half">
					<input type="button" class="w3-button w3-block w3-green" onclick="submit_tabla_guardar();" value="Guardar">
				</div>
			</div>
			</p>
			<?php
				echo"<input type='hidden' id='atras' name='atras'>";
				if(isset($_POST["id_hipodromo"])) echo"<input type='hidden' id='id_hipodromo' name='id_hipodromo' value='".$_POST["id_hipodromo"]."'>";
				if(isset($_POST["numero_carrera"])) echo"<input type='hidden' id='numero_carrera' name='numero_carrera' value='".$_POST["numero_carrera"]."'>";
				if(isset($_POST["fecha_publicacion"])) echo"<input type='hidden' id='fecha_publicacion' name='fecha_publicacion' value='".$_POST["fecha_publicacion"]."'>";
				if(isset($_POST["activa"])) echo"<input type='hidden' id='activa' name='activa' value='".$_POST["activa"]."'>";
				if(isset($_POST["cerrada"])) echo"<input type='hidden' id='cerrada' name='cerrada' value='".$_POST["cerrada"]."'>";
				if(isset($_POST["siguiente"])) echo"<input type='hidden' id='n' name='n' value='".$_POST["siguiente"]."'>";
			?>
		</form>
		<?php
	}

	function formulario_agregar_tabla($bd)
	{
		?>
		<form class="w3-container w3-card-4 w3-light-grey w3-margin" id="fagregartabla" name="fagregartabla" method="post">
			<input type="hidden" id="siguiente" name="siguiente" value="siguiente">
			<h3 class="w3-text-blue">Tabla Fija</h3>
			<div class="w3-row w3-section">
				<div class="w3-col" style="width:50px"><label for="id_hipodromo" class="w3-text-blue"><i class="icon-menu" style="font-size:37px;"></i></label></div>
				<div class="w3-rest">
				<?php
					$sql="SELECT id_hipodromo, nombre FROM hipodromo;";
					$result=pg_query($bd->link,$sql);
					unset($sql);
					if($result)
					{
						?>						
						<select class="w3-select w3-border" id="id_hipodromo" name="id_hipodromo" tabindex="1">
						<option value=''>Hip&oacute;dromo</option>
						<?php
						while($row=pg_fetch_array($result))
						{
							if(isset($_POST["id_hipodromo"]) and $_POST["id_hipodromo"]==$row["id_hipodromo"])
								echo"<option value='".$row["id_hipodromo"]."' selected>".$row["nombre"]."</option>";
							else
								echo"<option value='".$row["id_hipodromo"]."'>".$row["nombre"]."</option>";
						}
						?>
						</select>
						<?php
						unset($row);
						pg_free_result($result);
					}
					else
						unset($result);
				?>
				</div>
			</div>
			<div class="w3-row w3-section">
				<div class="w3-col" style="width:50px"><label for="numero_carrera" class="w3-text-blue"><i class="icon-sort-numerically-outline" style="font-size:37px;"></i></label></div>
				<div class="w3-rest">
					<input class="w3-input w3-border" id="numero_carrera" name="numero_carrera" type="text" placeholder="# Carrera" onkeypress="return NumCheck2(event, this)" tabindex="2" value="<?php if(isset($_POST['numero_carrera'])) echo $_POST['numero_carrera']; ?>">
				</div>
			</div>
			<div class="w3-row w3-section">
				<div class="w3-col" style="width:50px"><label for="fecha_publicacion" class="w3-text-blue"><i class="icon-calendar" style="font-size:37px;"></i></label></div>
				<div class="w3-rest">
					<input class="w3-input w3-border" id="fecha_publicacion" name="fecha_publicacion" type="text" placeholder="DD-MM-AAAA" maxlength="10" value="<?php if(isset($_POST['fecha_publicacion'])) echo $_POST['fecha_publicacion']; ?>">
				</div>
			</div>
			<div class="w3-row w3-section">
				<table border="0">
					<tr>
						<td valign="middle">
							No Activa
						</td>
						<td>
							<label class="switch">
								<input type="checkbox" id="activa" name="activa" value="t" onclick="" 
								<?php
									if(isset($_POST["activa"]) and $_POST["activa"]=="t")
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
				<table border="0">
					<tr>
						<td valign="middle">
							Abierta
						</td>
						<td>
							<label class="switch">
								<input type="checkbox" id="cerrada" name="cerrada" value="t" onclick=""
								<?php
									if(isset($_POST["cerrada"]) and $_POST["cerrada"]=="t")
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
			<div class="w3-row w3-section">
				<div class="w3-rest">
					<i class="icon-plus4 icon_mas" onclick="agregar_campos();"></i>
					&nbsp;
					<i class="icon-minus3 icon_menos" onclick="eliminar_campos();"></i>
				</div>
			</div>
			<p>
			<table border="0" id="tabla_1" name="tabla_1">
				<?php
					if(isset($_POST["n"]))
						$n=$_POST["n"];
					else
						$n=1;
					for($i=1;$i<=$n;$i++)
					{
						echo"<table border='0' id='tabla_".$i."' name='tabla_".$i."'>";
						echo"<tr>";
						echo"<td>".$i.".</td>";
						echo"<td><input class='w3-input w3-border' id='ejemplar_".$i."' name='ejemplar_".$i."' type='text' placeholder='Nombre del Ejemplar' value='";
						if(isset($_POST["ejemplar_".$i]))
							echo $_POST["ejemplar_".$i];
						echo"'></td>";
						echo"<td><input class='w3-input w3-border' id='costo_ejemplar_".$i."' name='costo_ejemplar_".$i."' type='text' placeholder='Costo' size='10' onkeypress='return NumCheck(event, this);' value='";
						if(isset($_POST["costo_ejemplar_".$i]))
							echo $_POST["costo_ejemplar_".$i];
						echo"' ";
						if(isset($_POST["e_ejemplar_".$i]) and ($_POST["e_ejemplar_".$i]=="r" or $_POST["e_ejemplar_".$i]=="n"))
							echo"disabled";
						echo"></td>";
						echo"<td>";
						echo"<label><input class='w3-check' type='radio' id='e_ejemplar_".$i."' name='e_ejemplar_".$i."' value='v' onclick='habilitar_costo(this,".$i.");' ";
						if(isset($_POST["e_ejemplar_".$i]) and $_POST["e_ejemplar_".$i]=="v")
							echo"checked";
						elseif(!isset($_POST["e_ejemplar_".$i]))
							echo"checked";
						echo">Va</label>";
						echo"<label><input class='w3-check' type='radio' id='e_ejemplar_".$i."' name='e_ejemplar_".$i."' value='r' onclick='deshabilitar_costo(this,".$i.");' ";
						if(isset($_POST["e_ejemplar_".$i]) and $_POST["e_ejemplar_".$i]=="r")
							echo"checked";
						echo">Retirado</label>";
						echo"<label><input class='w3-check' type='radio' id='e_ejemplar_".$i."' name='e_ejemplar_".$i."' value='n' onclick='deshabilitar_costo(this,".$i.");' ";
						if(isset($_POST["e_ejemplar_".$i]) and $_POST["e_ejemplar_".$i]=="n")
							echo"checked";
						echo">No Va</label>";
						echo"</td>";
						echo"</tr>";
						echo"</table>";
					}
					unset($n);
				?>
			</table>
			<div id="campos_ejemplares"></div>
			</p>
			<div class="w3-row w3-section">
				<input type="button" class="w3-button w3-block w3-green" onclick="submit_tabla();" value="Siguiente >">
			</div>
		</form>
		<?php
	}

	function formulario_busqueda($bd)
	{
		?>
		<form class="w3-container w3-card-4 w3-light-grey w3-margin" id="fbusqueda" name="fbusqueda" method="post">
			<h2 class="w3-text-blue"><i class="icon-search3"></i>&nbsp;Busqueda</h2>
			<p>
				<label>
				<input class="w3-radio" type="radio" id="especificar" name="sel_opcion" value="especificar" onclick="habilitar_especificar();">
				Avanzada
				</label>
			</p>
			<div class="w3-row w3-section" id="div_busqueda_especifica" style="display:none;">
				<table border="0" style="width: 100%;">
					<tr>
						<td align="right" valign="middle" width="50px">
							<input class="w3-check" type="checkbox" id="chbid_hipodromo" name="chbid_hipodromo" disabled onclick="if(document.getElementById('chbid_hipodromo').checked){document.getElementById('bid_hipodromo').disabled=false;}else{document.getElementById('bid_hipodromo').disabled=true;}">
						</td>
						<td>
							<label>
								Hip&oacute;dromo
								<?php
									$sql="SELECT hipodromo.id_hipodromo, hipodromo.nombre FROM hipodromo, tabla WHERE hipodromo.id_hipodromo=tabla.id_hipodromo GROUP BY hipodromo.id_hipodromo;";
									$result=pg_query($bd->link,$sql);
									unset($sql);
									echo"<select class='w3-select w3-border' id='bid_hipodromo' name='bid_hipodromo' disabled>";
									echo"<option value=''></option>";
									if($result)
									{
										while($row=pg_fetch_array($result))
										{
											echo"<option value='".$row["id_hipodromo"]."'>".$row["nombre"]."</option>";
										}
										unset($row);
									}
									else
										unset($result);
									echo"</select>";
								?>
							</label>
						</td>
					</tr>
					<tr>
						<td align="right" valign="middle" width="50px">
							<input class="w3-check" type="checkbox" id="chbnumero_carrera" name="chbnumero_carrera" disabled onclick="if(document.getElementById('chbnumero_carrera').checked){document.getElementById('bnumero_carrera').disabled=false;}else{document.getElementById('bnumero_carrera').disabled=true;}">
						</td>
						<td>
							<label>
								# Carrera:
								<?php
									$sql="SELECT numero_carrera FROM tabla GROUP BY numero_carrera;";
									$result=pg_query($bd->link,$sql);
									unset($sql);
									echo"<select class='w3-select w3-border' id='bnumero_carrera' name='bnumero_carrera' disabled>";
									echo"<option value=''></option>";
									if($result)
									{
										while($row=pg_fetch_array($result))
										{
											echo"<option value='".$row["numero_carrera"]."'>".$row["numero_carrera"]."</option>";
										}
										unset($row);
									}
									else
										unset($result);
									echo"</select>";
								?>
							</label>
						</td>
					</tr>
					<tr>
						<td align="right" valign="middle" width="50px">
							<input class="w3-check" type="checkbox" id="chbfecha_publicacion" name="chbfecha_publicacion" disabled onclick="if(document.getElementById('chbfecha_publicacion').checked){document.getElementById('bfecha_publicacion').disabled=false;}else{document.getElementById('bfecha_publicacion').disabled=true;}">
						</td>
						<td>
							<label>
								Fecha:
								<?php
									$sql="SELECT fecha_publicacion_num FROM tabla GROUP BY fecha_publicacion_num ORDER BY fecha_publicacion_num DESC;";
									$result=pg_query($bd->link,$sql);
									unset($sql);
									echo"<select class='w3-select w3-border' id='bfecha_publicacion' name='bfecha_publicacion' disabled>";
									echo"<option value=''>DD-MM-AAAA</option>";
									if($result)
									{
										while($row=pg_fetch_array($result))
										{
											echo"<option value='".$row["fecha_publicacion_num"]."'>";
											echo date("d-m-Y",$row["fecha_publicacion_num"]);
											echo"</option>";
										}
										unset($row);
									}
									else
										unset($result);
									echo"</select>";
								?>
							</label>
						</td>
					</tr>
					<tr>
						<td align="right" valign="middle" width="50px">
							<input class="w3-check" type="checkbox" id="chbestatus" name="chbestatus" disabled onclick="if(document.getElementById('chbestatus').checked){document.getElementById('bactiva').disabled=false;document.getElementById('bcerrada').disabled=false;}else{document.getElementById('bactiva').disabled=true;document.getElementById('bcerrada').disabled=true;}">
						</td>
						<td>
							Estatus:<br>
							<label class="switch">
								<table border="0">
									<tr>
										<td>
											<input type="checkbox" id="bactiva" name="bactiva" value="t">
											<span class="slider round"></span>
										</td>
										<td valign="middle">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Activa
										</td>
									</tr>
								</table>
							</label>
							<br>
							<label class="switch">
								<table border="0">
									<tr>
										<td>
											<input type="checkbox" id="bcerrada" name="bcerrada" value="t">
											<span class="slider round"></span>
										</td>
										<td valign="middle">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cerrada
										</td>
									</tr>
								</table>
							</label>
						</td>
					</tr>
				</table>
			</div>
			<p>
				<label>
				<input class="w3-radio" type="radio" id="listar" name="sel_opcion" value="listar" onclick="deshabilitar_especificar();" checked>
				Listar
				</label>
			</p>
			<div class="w3-row w3-section">
				<input class="w3-button w3-block w3-blue" type="button" id="enviar" name="enviar" value="Buscar" onclick="return enviardatos_busqueda();">
			</div>
		</form>
		<?php
	}

	global $servidor, $puerto, $usuario, $pass, $basedatos;
	$bd=new BaseDatos($servidor,$puerto,$usuario,$pass,$basedatos);
	if($bd->conectado)
	{
		if(usuario_admin($_SESSION["login"]))
		{
			echo"<div id='loader'></div>";
			?>
			<div class="w3-container">
				<button id='agregar_tabla' class="w3-button w3-blue"><i class='icon-plus4'>&nbsp;</i>Agregar Tabla</button>
			</div>
			<?php
			if(isset($_POST["n"]) and !empty($_POST["n"]) and isset($_POST["atras"]) and empty($_POST["atras"]))
			{
				if(guardar_tabla($bd))
				{
					?>
					<script language='JavaScript' type='text/JavaScript'>
						nextinput=1;
						alertify.alert("","GUARDADO SATISFACTORIAMENTE").set('label', 'Aceptar');
					</script>
					<?php
					unset($_POST["id_hipodromo"],$_POST["numero_carrera"],$_POST["fecha_publicacion"],$_POST["activa"],$_POST["cerrada"]);
					for($i=1;$i<=$_POST["n"];$i++)
						unset($_POST["ejemplar_".$i],$_POST["costo_ejemplar_".$i],$_POST["e_ejemplar_".$i]);
					unset($_POST["n"]);
				}
				else
				{
					?>
					<script language='JavaScript' type='text/JavaScript'>
						alertify.alert("","ERROR AL GUARDAR LA TABLA").set('label', 'Aceptar');
					</script>
					<?php
				}
			}
			echo"<div id='divfagregar' class='w3-container' style='display:none;'>";
				formulario_agregar_tabla($bd);
			echo"</div>";
			if(isset($_POST["atras"]) and $_POST["atras"]=="atras")
			{
				?>
				<script language='JavaScript' type='text/JavaScript'>
					$("#divfagregar").show();
				</script>
				<?php
			}
			if(isset($_POST["siguiente"]) and !empty($_POST["siguiente"]))
			{
				formulario_agregar_tabla_2($bd);
			}
			formulario_busqueda($bd);
			echo"<div id='divformulariolista'></div>";
		}
		else
		{
			?>
			<div class="w3-panel w3-yellow">
				<h3>Advertencia</h3>
				<p>Acceso Restringido</p>
			</div> 
			<?php
		}
	}
?>