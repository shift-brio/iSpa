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
</head>
<body class="talk-body">
	<audio src="<?php echo base_url("uploads/system/click.mp3");?>" class="click hidden" id="click"></audio>
	<?php echo isset($echoed) ? $echoed:""; ?>
	<div class="onboarding">
		<div class="onb-body">
			<div class="onb-controls">
				<button class="onb-control click-btn back">
					<i class="material-icons">keyboard_arrow_left</i>
				</button>
			</div>		
			<div class="onb-switcher">
				<p class="onb-title center app-title">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut.
				</p>
				<img class="onb-img" src="<?php echo base_url("uploads/onboarding/teams.svg"); ?>">
			</div>
			<div class="onb-controls">
				<button class="onb-control click-btn next">
					<i class="material-icons">keyboard_arrow_right</i>
				</button>
			</div>	
		</div>
		<div class="onb-tools">
			<button class="register left click-btn onb-tool">
				Create account
				<i class="material-icons right">person_add</i>
			</button>
			<button class="sign-in right click-btn onb-tool">
				Sign In
				<i class="material-icons right">lock_open</i>
			</button>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url('bootstrap/js/slider.js')."?".time(); ?>">
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			let onboard = new Slider(lst, cfg);
			$(".register").click(() =>{
				location.href = base_url+"sign_up";
			})
			$(".sign-in").click(() =>{
				location.href = base_url;
			})
		})
	</script>	