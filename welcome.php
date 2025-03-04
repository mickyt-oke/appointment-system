<?php require_once 'config/dbConnection.php';
require_once 'config/dbConfig.php';

superAdmin();
if (!isAdm1n()) {
	redirectTo('index.php');
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Approval Desk | NIS Appointment Scheduler</title>
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
	<?php if(@$_GET['q']) {
    echo'<script>alert("'.@$_GET['q'].'");</script>';
}
?>
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
						<li>Current Login: <?php $timestamp = time();
											echo (date("D F j, Y  g:i a", $timestamp)) ?></li>
							<a href="logout.php" class="button secondary small" type="submit"><i class="fas fa-user"></i>Logout </a>
					</ul>
				</header>
				<div class="container-fluid pt-5">
					<div class="mt-0 shadow p-3 mb-5 bg-white rounded">
						<h2 class="text-center">SUPER ADMIN DASHBOARD</h2>
					</div>
					<div class=" row">
						<div class="col-md-12">
							<div class="card-profile overflow-hidden">
								<div class="row justify-content-center">
									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-warning"></i>
												<h4 class="mt-3">CGIS Office</h4>
												<!-- <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form"> Enter</button> -->
												<a href="#"
													data-href="_ajax/auth_page.html"
													data-ajax-modal-size="modal-md"
													data-ajax-modal-centered="true"
													data-ajax-modal-callback-function=""
													class="js-ajax-modal btn btn-dark text-white">
													Enter
												</a>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-primary"></i>
												<h4 class="mt-3 ">PSO Office</h4>
												<!-- <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form2"> Enter</button> -->
												<a href="#"
													data-href="_ajax/auth_page.html"
													data-ajax-modal-size="modal-md"
													data-ajax-modal-centered="true"
													data-ajax-modal-callback-function=""
													class="js-ajax-modal btn btn-dark text-white">
													Enter
												</a>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-success"></i>
												<h4 class="mt-3">CSO</h4>
												<!-- <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form3"> Enter</button> -->
												<a href="#"
													data-href="_ajax/auth_page.html"
													data-ajax-modal-size="modal-md"
													data-ajax-modal-centered="true"
													data-ajax-modal-callback-function=""
													class="js-ajax-modal btn btn-dark text-white">
													Enter
												</a>
											</div>
										</div>
									</div>
									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-danger"></i>
												<h4 class="mt-3">PAs</h4>
												<button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form4">Enter</button>
											</div>
										</div>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-warning"></i>
												<h4 class="mt-3">DCG VISA</h4>
												<button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form"> Enter</button>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-primary"></i>
												<h4 class="mt-3">DCG F/A</h4>
												<button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form2"> Enter</button>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-success"></i>
												<h4 class="mt-3">ACG ICT</h4>
												<button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form3"> Enter</button>
											</div>
										</div>
									</div>
									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-danger"></i>
												<h4 class="mt-3">CIS ICT</h4>
												<button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form4">Enter</button>
											</div>
										</div>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-warning"></i>
												<h5 class="mt-3">ACI RADIO &amp; Comm</h5>
												<button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form"> Enter</button>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-primary"></i>
												<h4 class="mt-3">SA-PROTOCOL</h4>
												<button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form2"> Enter</button>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-success"></i>
												<h4 class="mt-3">SA-SECURITY</h4>
												<button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form3"> Enter</button>
											</div>
										</div>
									</div>
									<div class="col-md-3 col-lg-3 col-xl-3">
										<div class="card shadow">
											<div class="card-body text-center">
												<i class="fas fa-box-open fa-3x text-danger"></i>
												<h4 class="mt-3">FACILITY</h4>
												<button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#form4">Enter</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">CGIS Office</h5>
								<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body
						</div>
                     </div></div></div>

<!-- modal form -->
	<div class=" modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="form" aria-hidden="true">
								<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
									<div class="modal-content">
										<div class="modal-body p-0">
											<div class="card bg-default shadow border-0 mb-0">
												<div class="card-body px-lg-5 py-lg-5">
													<div class="text-center text-white mb-4 h2">User Token </div>
													<form role="form" action="token.php?q=welcome.php" method="post">
														<div class="form-group">
															<div class="input-group input-group-alternative">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
																</div>
																<input class="form-control" name="pass" placeholder="passcode" type="password">
															</div>
														</div>
														<div class="text-center"><input type="submit" class="btn btn-white my-4" name="login" value="Login" /></div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- form2 -->
							<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="form2" aria-hidden="true">
								<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
									<div class="modal-content">
										<div class="modal-body p-0">
											<div class="card bg-warning shadow border-0 mb-0">
												<div class="card-body px-lg-5 py-lg-5">
													<div class="text-center text-white mb-4 h2">User Token </div>
													<form role="form" action="token.php?q=welcome.php" method="post">
														<div class="form-group">
															<div class="input-group input-group-alternative">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
																</div>
																<input class="form-control" name="pwd" placeholder="passcode" type="password">
															</div>
														</div>
														<div class="text-center"><input type="submit" class="btn btn-white my-4" name="log-in" value="Login" /></div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- form3 -->
							<div class="modal fade" id="form3" tabindex="-1" role="dialog" aria-labelledby="form3" aria-hidden="true">
								<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
									<div class="modal-content">
										<div class="modal-body p-0">
											<div class="card bg-success shadow border-0 mb-0">
												<div class="card-body px-lg-5 py-lg-5">
													<div class="text-center text-white mb-4 h2">User Token </div>
													<form role="form" action="token.php?q=welcome.php" method="post">
														<div class="form-group">
															<div class="input-group input-group-alternative">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
																</div>
																<input class="form-control" name="pasw" placeholder="passcode" type="password">
															</div>
														</div>
														<div class="text-center"><input type="submit" class="btn btn-white my-4" name="log-in" value="Login" /></div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- form4 -->
							<div class="modal fade" id="form4" tabindex="-1" role="dialog" aria-labelledby="form4" aria-hidden="true">
								<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
									<div class="modal-content">
										<div class="modal-body p-0">
											<div class="card bg-warning shadow border-0 mb-0">
												<div class="card-body px-lg-5 py-lg-5">
													<div class="text-center text-white mb-4 h2">User Token </div>
													<form role="form" action="token.php?q=welcome.php" method="post">
														<div class="form-group">
															<div class="input-group input-group-alternative">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
																</div>
																<input class="form-control" name="pswd" placeholder="passcode" type="password">
															</div>
														</div>
														<div class="text-center"><input type="submit" class="btn btn-white my-4" name="log-in" value="Login" /></div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Scripts -->
								<!-- <script src="assets/js/jquery.min.js"></script>
								<script src="assets/js/browser.min.js"></script>
								<script src="assets/js/breakpoints.min.js"></script>
								<script src="assets/js/util.js"></script> 
								<script src="assets/js/main.js"></script>
								<script src="assets/js/main-2.js"></script> -->
								<script src="assets/js/core.min.js"></script>
								<script src="assets/js/vendor_bundle.min.js"></script>
								<script src="assets/js/theme.docs.js"></script>

								<div id="page_js_files">
									<script>
										/* assets/js/theme.docs.js */
										docAnchor();
										docNavSelected();
									</script>

								</div>

</body>

</html>