<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @file-name: header.php
 * @file-description: Header template
 * @author: Juan Pablo Buritica - <hello@juanpabloburitica.com>
 * CodeIgniter Skeleton - <http://github.com/Buritica/CI-skeleton>
 * @includes: HTML5 Boilerplate by Paul Irish - <http://html5boilerplate.com> 
 */
?>
<!doctype html>
<!--[if lte IE 8 ]> <html lang="en" class="no-js oldie"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Tres d&iacute;as dedicados al desarrollo web y m&oacute;vil. | Bogotaconf 2011</title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	
	<link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo base_url() ?>apple-touch-icon.png">
	<link rel="stylesheet" href="<?php echo base_url() ?>css/style.css?v=2">
	<link rel="stylesheet" media="handheld" href="<?php echo base_url() ?>css/handheld.css?v=2">
	<script src="<?php echo base_url() ?>js/libs/modernizr-1.7.min.js"></script>
</head>
<body <?php if(isset($body_class)) : echo 'class="'.$body_class.'"'; endif; ?>>
	<div id="container">
		<div id="flash">
			<?php if($this->session->flashdata('message')) :?>
			<div class="wrapper show">
				<?php echo $this->session->flashdata('message'); ?>
			</div>
			<?php else : ?>
			<div class="wrapper">
				
			</div>
			<?php endif; ?>
		</div>
<?php  
/* End of file footer.php */
/* Location: ./system/application/views/template/footer.php */
?>