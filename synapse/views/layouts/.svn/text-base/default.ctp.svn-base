<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel='StyleSheet' type="text/css" href='<?php echo $this->base ?>/css/ext-all.css'/> 
	<link rel="stylesheet" type="text/css" href='<?php echo $this->base ?>/css/appcss.css'/>

	<title>
		<?php __('Synapse:'); ?>
		<?php echo $title_for_layout;?>
	</title>

	<script type="text/javascript">
		var host = "<?php echo $_SERVER['HTTP_HOST']; ?>";
		var wwwroot = '<?php echo $this->webroot; ?>';
		var url = "<?php echo trim($this->params['url']['url'], '/'); ?>";
	</script>

	<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/js/com.iskitz.ajile.js?mvcoff,mvcshareoff"></script>

	<?php
		echo $javascript->link('ext-2.2/adapter/prototype/prototype');
		echo $javascript->link('ext-2.2/adapter/prototype/ext-prototype-adapter');
		echo $javascript->link('ext-2.2/adapter/ext/ext-base');
		echo $javascript->link('ext-2.2/ext-all-debug');
		echo $javascript->link('Synapse.layout.Base.js');
		echo $scripts_for_layout;
	?>
	
</head>
<body>
	<?php echo $content_for_layout;?>
</body>
</html>