<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->css(array('allCssFiles'));
		echo $this->Html->script('allJsFiles', array('defer' => true));
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->element('upper_bar_element'); ?>
			<?php echo $this->Session->flash(); ?>
		</div>
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">

		</div>
	</div>
</body>
</html>
