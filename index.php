<?php require_once 'config/init.php';


    if (count($_POST)>0){

	// Process form request
  if (isset($_POST['login'])) {
      $user->username = trim($_POST['username']);
      $user->password = trim($_POST['password']);

    // Ensure no field is empty
    if (!empty($user->username) && !empty($user->password)) {
      // Hash password
      $user->password = md5($user->password);
      if ($user->login($user->username, $user->password)) {
		  $_SESSION['loggedin_time'] = time();
        ($_SESSION['us3rgr0up'] == 118) ? redirectTo('welcome.php') : redirectTo('dashboard.php');
      }
      else {
        $errors[] = "Authentication failed. Wrong credentials";
		  header ("Location:$ref?q=Wrong Username or Password.");
      }
    }
    else {
      $errors[] = "All fields are required.";
    }
  }
}
?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="UTF-8">
    <title>Welcome | NIS Appointment Scheduler</title>
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

    <link rel="stylesheet" href="assets/css/core.min.css">
    <link rel="stylesheet" href="assets/css/vendor_bundle.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap">
    <?php if(@$_GET['q']) {
    echo'<script>alert("'.@$_GET['q'].'");</script>';
}
?>
  </head>
    <body class="header-sticky">

		<div id="wrapper">

			<div class="row g-0 bg-white min-vh-100 align-items-center">
      <div class="col-lg-6 text-center text-lg-start overflow-hidden z-index-2">
        <div class="px-3 py-6">
          <?php error($errors);
              success($message); ?>
          <div class="row">
            <div class="col-sm-8 col-md-6 col-lg-9 col-xl-12 mx-auto max-w-450">
			<img src="assets/images/logo/nis_Images/nis_ImgID1.png" width="110" height="38" />
              <h1 class="fw-bold mb-5">Secured Access</h1>
			  
              <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="username" required />
                  <label for="username">User ID</label>
                </div>
                <div class="form-floating mb-3">
                  <input required type="password" class="form-control" name="password" required />
                  <label for="password">Passcode</label>
                </div>
                <div class="d-grid mb-3">
                  <button type="submit" class="btn btn-danger">
                    <span>Login</span>
                    <svg class="rtl-flip" width="18px" height="18px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                      <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                    </svg>
                    <input name="login" type="hidden" value="login">
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="d-none d-lg-block min-vh-100 col-lg-6 bg-cover py-8 overlay-dark overlay-opacity-75" style="background-image:url(assets/images/appointment-system-login.jpg)">
        <svg class="d-none d-lg-block position-absolute h-100 top-0 text-white ms-n5" style="width:6rem" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
          <polygon points="50,0 100,0 50,100 0,100"></polygon>
        </svg>
      </div>
    </div>

            <!-- Footer -->
			<footer id="footer" class="footer-dark">
			
					<div class="container clearfix fw-light text-center-xs">

						<div class="fs-6 py-2 float-start float-none-xs m-0-xs">
							© 2024 | NIGERIA IMMIGRATION SERVICE
						</div>
                </div>

			</footer>
            </div>
			<!-- /Footer -->

    <!-- Core javascripts -->
    <script src="assets/js/core.min.js"></script>
    <script src="assets/js/vendor_bundle.min.js"></script>
    <script src="assets/js/theme.docs.js"></script>

  </body>
</html> 