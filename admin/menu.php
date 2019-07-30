<?php
	if(isset($_SESSION["user_id"]) && $_SESSION["user_id"]>0){
		$usr_lvl="Manager";
		if($_SESSION["user_lvl"]=="a") $usr_lvl="Administrador";
	?>
	<!--  Datos del Usuario  -->
	<div style="width: 240px; height: 150px; background-image: url(admin/images/fondos/datos_usuario.jpg);">
		<div id="user_data"><?php echo(html_encode($_SESSION["user_nme"]."<br>".$usr_lvl)); ?></div>
		<img src="admin/images/iconos/sess_blck.png" width="28" height="36" title=" Bloquear la Sesión " style="float: right; margin-right: 4px; margin-top: 02px; clear: both; cursor: pointer;" />
		<img src="admin/images/iconos/sess_exit.png" width="31" height="31" title=" Cerrar la Sesión " style="float: right; margin-right: 4px; margin-top: 04px; clear: both; cursor: pointer;" onClick="clse_usr_ssn();" />
		<img src="admin/images/iconos/pass_chng.png" width="27" height="36" title=" Cambiar su Contraseña " style="float: right; margin-right: 162px; margin-top: 01px; cursor: pointer;" onClick="clse_usr_ssn();" />
	</div>
	<!--  Menú Principal  -->
	<div id="main_menu" style="width: 240px; min-height: 250px; margin-top: 20px;">
		<!-- menues -->
		<table width="240" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="myMenu">
					<table class="rootVoices" cellspacing='0' cellpadding='0' border='0'>
						<tr>
							<td class="rootVoice {menu: 'empty'}" onClick="init_usr_ssn('main');" ><img src="admin/images/mb_icons/home_36.png" width="22" height="22" style="float: left; margin-left: 12px; margin-right: 10px;" /><div style="float: left; margin-top: -4px;">Inicio</div></td></tr>
						<tr>
							<td class="rootVoice {menu: 'sub_menu_mnpg'}" ><img src="admin/images/mb_icons/dashboard_36.png" width="22" height="22" style="float: left; margin-left: 12px; margin-right: 10px;" /><div style="float: left; margin-top: -4px;">Página Principal</div></td></tr>
						<tr>
							<td class="rootVoice {menu: 'sub_menu_nstr'}" ><img src="admin/images/mb_icons/us_36.png" width="22" height="22" style="float: left; margin-left: 12px; margin-right: 10px;" /><div style="float: left; margin-top: -4px;">Nosotros</div></td></tr>
						<tr>
							<td class="rootVoice {menu: 'sub_menu_mrkt'}" ><img src="admin/images/mb_icons/gallery_36.png" width="22" height="22" style="float: left; margin-left: 12px; margin-right: 10px;" /><div style="float: left; margin-top: -4px;">Markets</div></td></tr>
						<tr>
							<td class="rootVoice {menu: 'sub_menu_scrs'}" ><img src="admin/images/mat_icons/store_36.png" width="22" height="22" style="float: left; margin-left: 12px; margin-right: 10px;" /><div style="float: left; margin-top: -4px;">Sucursales</div></td></tr>
						<tr>
							<td class="rootVoice {menu: 'sub_menu_srvc'}" ><img src="admin/images/mat_icons/details_36.png" width="22" height="22" style="float: left; margin-left: 12px; margin-right: 10px;" /><div style="float: left; margin-top: -4px;">Servicios</div></td></tr>
						<tr>
							<td class="rootVoice {menu: 'sub_menu_cont'}" ><img src="admin/images/mb_icons/contact_36.png" width="22" height="22" style="float: left; margin-left: 12px; margin-right: 10px;" /><div style="float: left; margin-top: -4px;">Contacto</div></td></tr>

						<?php if($_SESSION["user_lvl"]=="a"){ ?>
						<tr>
							<td class="rootVoice {menu: 'sub_menu_user'}" ><img src="admin/images/mb_icons/users_36.png" width="22" height="22" style="float: left; margin-left: 12px; margin-right: 10px;" /><div style="float: left; margin-top: -4px;">Usuarios</div></td></tr>
						<?php } ?>
					</table>
				</td></tr>
		</table>
	</div>
	
	<!--  Sub-Menú: Página Principal  -->
	<div id="sub_menu_mnpg" class="mbmenu">
		<a href="#" onClick="main_load(1, 1);" >Slider Superior</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(1, 2);" >Market</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(1, 3);" >Bodegón</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(1, 4);" >Farmacia</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(1, 5);" >Mi Revista</a>
	</div>

	<!--  Sub-Menú: Nosotros  -->
	<div id="sub_menu_nstr" class="mbmenu">
		<a href="#" onClick="main_load(2, 1);" >Slider Superior</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(2, 2);" >Principios Rectores</a>
	</div>

	<!--  Sub-Menú: Markets  -->
	<div id="sub_menu_mrkt" class="mbmenu">
		<a href="#" onClick="main_load(3, 1);" >Slider Superior</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(3, 2);" >Tipos de Markets</a>
	</div>

	<!--  Sub-Menú: Sucursales  -->
	<div id="sub_menu_scrs" class="mbmenu">
		<a href="#" onClick="main_load(4, 1);" >Slider Superior</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(4, 2);" >Ciudades</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(4, 3);" >Sucursales</a>
	</div>

	<!--  Sub-Menú: Servicios  -->
	<div id="sub_menu_srvc" class="mbmenu">
		<a href="#" onClick="main_load(5, 1);" >Cards de Servicios</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(5, 2);" >Contenido Interno Servicio 1</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(5, 3);" >Contenido Interno Servicio 2</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(5, 4);" >Contenido Interno Servicio 3</a>
		<a rel="separator"> </a>
		<a href="#" onClick="main_load(5, 5);" >Contenido Interno Servicio 4</a>
	</div>

	<!--  Sub-Menú: Contacto  -->
	<div id="sub_menu_cont" class="mbmenu">
		<a href="#" onClick="main_load(7, 1);" >Slider Superior</a>
	</div>
	
	<!--  Sub-Menú: Seguridad / Usuarios / Perfiles de Acceso  -->
	<div id="sub_menu_user" class="mbmenu">
		<a href="#" onClick="main_load(8, 1);" >Usuarios / Perfiles de Acceso</a>
	</div>
<?php } ?>
