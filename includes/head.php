<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="OceanApps">
	<meta name="author" content="OceanApps">
	<meta name="keywords" content="OceanApps, Oceanerp">

	<link rel="preconnect" href="https://fonts.gstatic.com/">
	<link rel="shortcut icon" href="assets/img/icons/icon-48x48.png" />

	<link rel="canonical" href="index.html" />

	<title>OceanApps- ERP</title>
    <?php
	$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
	$host = $_SERVER['SERVER_NAME'];
	$port = $_SERVER['SERVER_PORT'];
	
	// Exclude standard ports from URL
	if (($protocol === 'http://' && $port != 80) || ($protocol === 'https://' && $port != 443)) {
		$rootUrl = $protocol . $host . ':' . $port;
	} else {
		$rootUrl = $protocol . $host;
	}

	?>
    <link rel="stylesheet" href="<?php echo $rootUrl.'/oceanerp2/assets/css/bootstrap.min.css';?>">
    <!-- Add other CSS links as needed -->
</head>
<body>
