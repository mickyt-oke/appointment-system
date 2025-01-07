<?php require_once 'config/dbConnection.php';
	require_once 'config/dbConfig.php';
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Dashboard | NIS Appointment Scheduler</title>
	<meta name="description" content="NIS Comptroller-General Office Meeting Appointment Scheduling System" />
	<meta name="author" content="MickyT" />
	<meta name="keywords" content="CGI Reservation system, Apppointment booking, Comptroller General Detail System" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, maximum-scale=5, initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="assets/images/logo/favicon.ico" />
    <link rel="apple-touch-icon" href="assets/images/logo/apple_icon.png">
    <!-- up to 10% speed up for external res -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com/">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <!-- preloading icon font is helping to speed up a little bit -->
    <link rel="preload" href="assets/fonts/flaticon/Flaticon.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap">
	<link rel="stylesheet" href="assets/css/main.css" /> 
	<link rel="stylesheet" href="assets/css/dashboard.css" /> 
    <link rel="stylesheet" href="assets/css/core.min.css">
	<link rel="stylesheet" href="assets/style.css" /> 
	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/iconfonts/font-awesome/css/all.min.css">
	<link rel="stylesheet" href="assets/css/core.css">
	<link rel="stylesheet" href="assets/css/vendor_bundle.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.addons.css">
	</head>
	<body class="is-preload">
		
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Welcome, </strong><?php echo $user->getName($_SESSION['us3rid']); ?></a>
									<ul class="icons">
										<li>Current Login: <?php $timestamp = time(); echo(date("D F j, Y  g:i a", $timestamp)) ?></li>
									</ul>
								</header>
		