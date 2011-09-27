<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @file-name: footer.php
 * @file-description: Header template
 * @author: Juan Pablo Buritica - <hello@juanpabloburitica.com>
 * CodeIgniter Skeleton - <http://github.com/Buritica/CI-skeleton>
 * @includes: HTML5 Boilerplate by Paul Irish - <http://html5boilerplate.com> 
 */
?>
	<footer>
		<div class="wrapper">
			<p>
				bogotaconf es un evento SIN ANIMO DE LUCRO
			</p>
		</div>
	</footer>
</div>
<a href="<?php echo base_url(); ?>" id="base-url" class="hidden"></a>
<div id="lightbox">
	<div id="content">
		<h2>Compra de Entradas Offline</h2>
		<hr />
		<p>Lléna el siguiente formulario y sígue las instrucciones que te enviamos por mail.</p>
		<form action="registro_preventa" method="post" accept-charset="utf-8">
			


		</form>
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo base_url(); ?>js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>

<!-- scripts concatenated and minified via ant build script-->
<script src="<?php echo base_url() ?>js/plugins.js"></script>
<script src="<?php echo base_url() ?>js/script.js"></script>
<!-- end scripts-->

<!-- Analytics -->
<script type="text/javascript">
var clicky_site_id = 66410187;
(function() {
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = '//static.getclicky.com/js';
  ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
})();
</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/66410187ns.gif" /></p></noscript>
<!-- Social -->
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


</body>
</html>
<?php  
/* End of file footer.php */
/* Location: ./system/application/views/template/footer.php */
?>