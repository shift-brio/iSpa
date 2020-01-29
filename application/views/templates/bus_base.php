<?php 
	$time = "";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<base href="<?php echo base_url(); ?>" />	
	<meta name="theme-color" content="#4506ff">
	<meta name="description" content="iSpa">
	<meta name="keywords" content="iSpa">	
	<meta name="bus" value="<?php echo isset($_SESSION["business"]) ? $_SESSION["business"] : "iSpa - Business portal"; ?>">
	<meta name="application-name" content="iSpa">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="manifest" href="<?php echo base_url("manifest.json"); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="icon" type="image/gif" href="<?php echo base_url('uploads/logo/ispa.jpg'); ?>">
	<title><?php echo isset($data->title) ? $data->title:"Welcome to iSpa";  ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/materialize/css/materialize.css')."?".time(); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/main.css')."?".time(); ?>">
	<script type="text/javascript" src="<?php echo base_url('bootstrap/js/jquery.min.js'); ?>"></script> 
	<script type="text/javascript" src="<?php echo base_url('bootstrap/materialize/js/materialize.js'); ?>"></script>
	  <script type="text/javascript" src="<?php echo base_url('bootstrap/js/lazyload.js'); ?>"></script> 
	 <script type="text/javascript" src="<?php echo base_url('bootstrap/js/commons.js')."?".time(); ?>"></script>	 
	 <script type="text/javascript" src="<?php echo base_url('bootstrap/js/bus_ui.js')."?".time(); ?>"></script>	
	 <script type="text/javascript" src="<?php echo base_url('bootstrap/js/slider.js')."?".time(); ?>"></script>		
</head>
<body class="talk-body">