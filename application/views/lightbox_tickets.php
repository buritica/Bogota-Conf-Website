<div id="purchase">
		<h3>Compra de Entradas Offline</h3>
	<hr />
	<?php if(isset($errors)) : ?>
	<div class="error">
		<?php echo $errors ?>
	</div>
	<?php else : ?>
		<div id="instructions">
			<p>Llena el formulario y sígue las instrucciones que te enviamos por email.</p>
			<hr />
			<p>Debido a la cantidad limitada de entradas, solo se permite una por email.</p>
		</div>
	<?php endif; ?>
	<hr />
	<form action="<?php echo base_url() ?>purchase_tickets" method="post">
		<fieldset>
						<ul>
							<li><label for="name">Nombre y Apellido</label></li>
							<li class="sub"><input type="text" name="name" id="" tabindex="10" /></li>
							<li><label for="email">Email</label></li>
							<li class="sub"><input type="email" name="email" id="" tabindex="11"/></li>
							<li><label for="ticket_type">Tipo de Entrada</label></li>
							<li class="sub">
								Estudiante<input type="radio" name="ticket_type" id="" value="student"  required="true" <?php echo ($ticket_type == 'student')? 'checked="checked" ': '' ; ?>/>
								Profesional<input type="radio" name="ticket_type" id="" tabindex="13" value="pro" required="true" <?php echo ($ticket_type == 'pro')? 'checked="checked" ': '' ; ?>/>
							</li>
							<li><label for="translation">Necesita Traduci&oacute;n</label></li>
							<li class="sub">
								Si<input type="radio" name="translation" id="" value="1" required="true" />
								No<input type="radio" name="translation" id="" checked="checked" value="0" tabindex="14" required="true" />
							</li>
							<li><label for="tshirt">Camiseta</label></li>
							<li class="sub">
								S<input type="radio" name="tshirt" id="" value="s" required="true"/>
								M<input type="radio" name="tshirt" id="" value="m" checked="checked" tabindex="15"required="true" />
								L<input type="radio" name="tshirt" id="" value="l" required="true" />
								XL<input type="radio" name="tshirt" id="" value="xl" required="true" />
							</li>
						</ul>
		</fieldset>
		<hr />
		<p>Tu cupo será reservado por 48 horas y confirmado cuando completes la transacci&oacute;n, de lo contrario no podremos garantizarlo.</p>
		<hr />
		<fieldset>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash()?>" /> 
			<input type="submit" value="Enviar"  class="button" tabindex="16"/>
		</fieldset>
	</form>
</div>