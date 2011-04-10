<div class="wrapper">
	<div class="left-info">
		<h1 class="ir bogconf">Bogotaconf 2011</h1>
		<p class="desc">Tres días dedicados al desarrollo web y móvil.</p>
	</div>
	<div class="right-info">
		<p class="desc">Octubre o Noviembre, 2011. Bogotá, Colombia.</p>
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

