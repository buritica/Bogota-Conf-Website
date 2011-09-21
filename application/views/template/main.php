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
	<header>
		<div class="wrapper">
			<a href="<?php echo base_url() ?>" id="logo"></a>
		</div>
	</header>
	<div id="main" role="main" <?php if(isset($main_class)) : echo 'class="'.$main_class.'"'; endif; ?>>
		<?php $this->load->view($main_content); ?>
	</div>
	<?php $this->load->view('template/footer'); ?>
	
<?php  
/* End of file main.php */
/* Location: ./system/application/views/template/main.php */
?>