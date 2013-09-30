<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo css_url('medias/style'); ?>">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,700italic,500italic,500,400italic,300,300italic' rel='stylesheet' type='text/css'>
    </head>
    <body>

	    <?php echo $content; ?>


        <script src="<?php echo js_url('medias/jquery'); ?>"></script>
        <script src="<?php echo js_url('medias/main'); ?>"></script>
        <?php foreach($js as $url): ?>
		        <script type="text/javascript" src="<?php echo $url; ?>"></script> 
		<?php endforeach; ?>
        <?php echo $this->script->scriptforlayout(); ?>
    </body>
</html>
