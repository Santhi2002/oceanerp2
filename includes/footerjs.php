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
    <script src="<?php echo $rootUrl.'/oceanerp2/assets/js/jquery-ui-1.11.1.js';?>"></script>
	<script src="<?php echo $rootUrl.'/oceanerp2/assets/js/bootstrap.bundle.min.js';?>"></script>   
 
</body>
</html>
