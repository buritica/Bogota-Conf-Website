<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @file-name: main.php
 * @file-description: Header template
 * @author: Juan Pablo Buritica - <hello@juanpabloburitica.com>
 * CodeIgniter Skeleton - <http://github.com/Buritica/CI-skeleton>
 * @includes: HTML5 Boilerplate by Paul Irish - <http://html5boilerplate.com> 
 */
?>
	
	<?php $this->load->view('template/header'); ?>
	<div id="transmi-outer">
		<div id="transmi-inner"></div>
	</div>
	<header id="weather" <?php if(isset($time_class)) : echo 'class="'.$time_class.'"'; endif; ?>>
		<div id="clouds">
			<div class="inner"></div>
			<div class="double"></div>
		</div>
		<div class="wrapper">
			<div id="city"></div>					
		</div>
	</header>
	<div id="main" role="main">
		<div class="wrapper">
			<div class="tagline">
				<h1 class="ir bogconf">Bogot&aacute;conf 2011</h1>
				<p>La primera conferencia de Desarrollo Web y M&oacute;vil en Bogot&aacute;.</p>
				<p class="desc">Lunes, 31 de Octubre. Bogot&aacute;, Colombia.</p>
			</div>

		</div>
		<?php $this->load->view('nav_main'); ?>
		<div id="dark-green">
			<div class="wrapper">
				<?php $this->load->view($basic_content); ?>
			</div>
		</div>
	</div>
	<?php $this->load->view('template/footer'); ?>
	
<?php  
/* End of file main.php */
/* Location: ./system/application/views/template/main.php */
?>