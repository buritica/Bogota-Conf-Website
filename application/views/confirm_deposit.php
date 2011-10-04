<div id="confirm-deposit">
	
	<?php if(!$attendee->upload) :?>
		<h3>Hola <?php echo first_name($attendee->name) ?>, confirma tu consignación aqui:</h3>
		<hr />
		<?php if(isset($errors)) : ?>
		<div id="upload-errors">
			<?php echo $errors['error']; fb($errors) ?>
		</div>
		<?php endif; ?>
		<p>Para confirmar tu consignaci&oacute;n necesitas:</p>
		<ul>
			<?php if($attendee->ticket_type == 'pro') : ?>
			<li>Una foto o imágen escaneada de tu consignación</li>
			<?php else : ?>
			<li>Una foto o imágen escaneada de tu consignación y carnet estudiantil VIGENTE</li>
			<li>Tu consignación y tu carnet deben estar en la misma imágen</li>
			<?php endif ?>
			<li>La imágen debe ser legible, de buena calidad y no tener más de 2mb.</li>
			<li>Si tienes problemas, escribenos a hola@bogotaconf.co</li>
			<li>Tu consignación es el recibo de compra, tus boletas dirán $0.00 debido a la forma de pago.</li>


		</ul>
		<?php echo form_open_multipart('subir_consignacion/'.$attendee->email, array('id'=>'upload')) ?>

			<input type="file" name="file" size="20" />	<input type="submit" value="Subir Imagen" class="button"/>
		</form>
	<?php else : ?>
		<h3>Hola <?php echo $name ?>, ya hemos recibido tu consignación:</h3>
		<hr />
		<p>Si tuviste problemas, o piensas que esto es un error, escribenos a hola@bogotaconf.co</p>
	<?php endif; ?>

</div>