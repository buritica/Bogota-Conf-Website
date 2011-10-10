<div class="wrapper">
	<div class="left-info">
		<h1 class="ir bogconf">Bogot&aacute;conf 2011</h1>
		<p class="desc">La primera conferencia de programaci&oacute;n en Bogot&aacute;.</p>
		<p class="subdesc">Bogot&aacute;Conf es un evento dedicado a la programaci&oacuten web y m&oacute;vil</p>
	</div>
	<div class="right-info">
		<p class="desc">1ro de Noviembre, 2011. Bogotá, Colombia.</p>
		<ul class="cost">
			<li>50 Cupos para Estudiantes</li>
			<li>100 Cupos para Profesionales</li>
		</ul>
		<ul class="cost">
			<li>Estudiantes: $90,000</li>
			<li>Profesionales: $150,000</li>
		</ul>
		<p>Entradas profesionales a la venta en <a href="http://bogotaconf.eventbrite.com">Eventbrite</a></p>
	</div>	
</div>
<div id="dark-green">
	<div class="wrapper">
		<div class="left-info">
			<div class="module-icons ir">
				Servidor, Cliente, M&oacute;vil.
			</div>
		</div>
		<div class="right-info">
			<p class="more-info">Muy pronto m&aacute;s informaci&oacute;n y si nos das tu email te avisamos por ah&iacute;. </p>
			<form action="<?php echo base_url() ?>main/store_email" method="post" id="give-email">
				<fieldset>
					<input type="email" name="email" id="email" placeholder="No somos amigos del spam" required/>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash()?>" /> 
					<input type="submit" value="Enviar" />
				</fieldset>
			</form>
			<p class="twitter-info">
				O si quieres, s&iacute;guenos en twitter:
			</p>
			<a href="http://twitter.com/#!/bogotaconf" target="_blank" class="twitter-follow">@bogotaconf</a>
		</div>
	</div>
</div>

