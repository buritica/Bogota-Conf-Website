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
		<?php $this->load->view('nav_main'); ?>
		<div id="dark-green">
			<div class="wrapper">
				<div id="left-content">
					<div class="load">
						<?php $this->load->view($left_content) ?>						
					</div>
				</div>
				<div id="sidebar">
					<div class="load">
						<?php $this->load->view($sidebar) ?>						
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('template/footer'); ?>
	
<?php  
/* End of file main.php */
/* Location: ./system/application/views/template/main.php */
?>