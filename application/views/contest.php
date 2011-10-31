<div id="contest">
			<h3>¡Gánate la entrada donada por TorrenegraLabs!</h3>
		<hr />
		<?php if(isset($errors)) : ?>
		<div class="error">
			<?php echo $errors ?>
		</div>
		<?php else : ?>
			<div id="instructions">
				<p>TorrenegraLabs quiere donar una entrada, a un talentoso hacker/dev que no cuente con los fondos para asistir a BogotáConf.</p>
				<hr />
				<p>Dános tu nombre, email y algunos links a tus experimentos y hacks</p>
			</div>
		<?php endif; ?>
		<hr />
		<form action="<?php echo base_url() ?>enter_contest" method="post">
			<fieldset>
				<ul>
					<li><label for="name">Nombre y Apellido</label></li>
					<li class="sub"><input type="text" name="name" id="" tabindex="10" /></li>
					<li><label for="email">Email</label></li>
					<li class="sub"><input type="email" name="email" id="" tabindex="11"/></li>
					<li><label for="link1">Link 1</label></li>
					<li class="sub"><input type="text" name="link1" id="" tabindex="12" /></li>
					<li><label for="link2">Link 2</label></li>
					<li class="sub"><input type="text" name="link2" id="" tabindex="13" /></li>
					<li><label for="link3">Link 3</label></li>
					<li class="sub"><input type="text" name="link3" id="" tabindex="14" /></li>
					<li><label for="github">Usuario de GitHub</label></li>
					<li class="sub"><input type="text" name="github" id="" tabindex="15" /></li>
				</ul>
			</fieldset>
			<hr />
			<p>Los resultados se anunciarán el viernes 28 de Oct, por la tarde. Por email, en twitter y aqui, en http://bogotaconf.co </p>
			<hr />
			<fieldset>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash()?>" /> 
				<input type="submit" value="Enviar"  class="button" tabindex="16"/>
			</fieldset>
		</form>
</div>