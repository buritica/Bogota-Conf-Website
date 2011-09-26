<nav class="main-nav">
	<div class="wrapper">
		<?php 
			$links = array(
				'Conferencistas' => 'load-left',
				'Panelistas' => 'load-left', 
				// 'Entradas' => 'load-left'
			);
			
			render_links($links);
		?>
			<a href="http://blog.bogotaconf.co">Blog</a>
	</div>
</nav>