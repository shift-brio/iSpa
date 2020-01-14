<?php 
	$time = "";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="page" content="<?php echo isset($data->page) ? $data->page : "home"; ?>">
	<meta name="active-item" content="false">
	<meta name="user-page" content="<?php echo isset($data->user_page) ? $data->user_page : ""; ?>">
	<base href="<?php echo base_url(); ?>" />
	<meta name="user" content="<?php echo isset($data->username) ? $data->username : ""; ?>">
	<meta name="theme-color" content="#4506ff">
	<meta name="description" content="TalkPoint">
	<meta name="keywords" content="TalkPoint|Talk|talkpoint.online">	
	<meta name="application-name" content="TalkPoint">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="icon" type="image/gif" href="<?php echo base_url('uploads/logo/ispa.jpg'); ?>">
	<title><?php echo isset($data->title) ? $data->title:"";  ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/materialize/css/materialize.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/main.css')."?".time(); ?>">
	<script type="text/javascript" src="<?php echo base_url('bootstrap/js/jquery.min.js'); ?>"></script> 
	<script type="text/javascript" src="<?php echo base_url('bootstrap/materialize/js/materialize.js'); ?>"></script>
	  <script type="text/javascript" src="<?php echo base_url('bootstrap/js/lazyload.js'); ?>"></script> 
	 <script type="text/javascript" src="<?php echo base_url('bootstrap/js/ispa_loader.js')."?".time(); ?>"></script> 
	 <script type="text/javascript" src="<?php echo base_url('bootstrap/js/ispa_ui.js')."?".time(); ?>"></script>	
	 <script type="text/javascript" src="<?php echo base_url('bootstrap/js/slider.js')."?".time(); ?>"></script>	
	 <script data-ref="map-js" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmTgK1EOZSTwsmBNnobBJ9tM4GZowxGm8&libraries=places"></script>
	 <script type="text/javascript" src="<?php echo base_url("bootstrap/js/map_picker.js") ?>"></script> 	   	
</head>
<body class="talk-body">
	<audio src="<?php echo base_url("uploads/system/click.mp3");?>" class="click hidden" id="click"></audio>
	<?php echo isset($echoed) ? $echoed:""; ?>