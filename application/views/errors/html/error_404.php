<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>404 Page Not Found</title>
	<link rel="icon" type="image/gif" href="../favicon.ico">	 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>	
	<div id="container">
		<?php echo'<code><p style="margin-left:1%;">The page you requested  is not available. Check the url submitted.</p></code>'; ?>		
	</div>
	<style>
		1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #000;
	border: 1px solid #D0D0D0;
	color: #fff;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #fafafa;
	box-shadow: 0 0 8px #D0D0D0;
	margin-top: 80px;
	padding: 10px;
	background: #fff;
}

p {
	margin: 12px 15px 12px 15px;
}
::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }
	</style>
</body>
</html>