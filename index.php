<?php
require_once 'config/init.php';

if (isset($_POST['login'])) {
    // Sanitize and validate input
    $user->username = trim($_POST['username']);
    $user->password = trim($_POST['password']);

  // Ensure no field is empty
  if (!empty($user->username) && !empty($user->password)) {
      $user->password = md5($user->password);
    if ($user->login($user->username, $user->password)) {
            $_SESSION['loggedin_time'] = time();

            // Redirect based on user group
            if ($_SESSION['us3rgr0up'] == 118) {
                redirectTo('welcome.php');
            } elseif ($_SESSION['us3rgr0up'] == 119) {
                    redirectTo('dash.php');
                } elseif ($_SESSION['us3rgr0up'] == 120) {
                  redirectTo('dash2.php');
                } elseif ($_SESSION['us3rgr0up'] == 121) {
                  redirectTo('dash3.php');
                }
                elseif ($_SESSION['us3rgr0up'] == 329) {
                  redirectTo('dashboard.php');
        } else {
            $errors[] = "User not found";
            header("Location: $ref?q=NO Usergroup Found");
        }
    } else {
        $errors[] = "Authentication failed. Wrong credentials.";
        header("Location: $ref?q=Wrong Username or Password");
    }
  }
}
?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="UTF-8">
    <title>Welcome | NIS Visitors Appointment Scheduler</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="viewport" content="width=device-width, maximum-scale=5, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- generate optimization meta tags for seo -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="GreatMinds Technologies">
    <meta name="publisher" content="GreatMinds Technologies">
    <meta name="copyright" content="GreatMinds Technologies">
    <meta name="description" content="NIS Comptroller-General Office Meeting Appointment Scheduling System">
    <meta name="keywords" content="CGI Reservation system, Apppointment booking, Comptroller General Detail System">
    <meta name="language" content="English">
    <meta name="designer" content="GreatMinds Technologies">
    <meta name="reply-to" content="greatmindsxclusive@gmail.com">
    <meta name="owner" content="GreatMinds Technologies">
    <meta name="url" content="https://greatminds.com.ng">
    <meta name="identifier-URL" content="https://greatminds.com.ng">
    <meta name="directory" content="submission">
    <meta name="category" content="CGI Reservation system, Apppointment booking, Comptroller General Detail System">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta name="revisit-after" content="7 days">
    <meta name="subtitle" content="NIS Visitors Appointment Scheduler">
    <meta name="target" content="all">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="theme-color" content="#000000">
    <meta name="msapplication-navbutton-color" content="#000000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="NIS Visitors Appointment Scheduler">
    <meta name="application-name" content="NIS Visitors Appointment Scheduler">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-TileImage" content="assets/images/logo/favicon.ico">
    <meta name="msapplication-config" content="assets/images/logo/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@greatminds">
    <meta name="twitter:creator" content="@greatminds">
    <meta name="twitter:title" content="NIS Visitors Appointment Scheduler">
    <meta name="twitter:description" content="NIS Comptroller-General Office Meeting Appointment Scheduling System">
    <meta name="twitter:image" content="assets/images/logo/apple_icon.png">
    <meta property="og:title" content="NIS Visitors Appointment Scheduler">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://greatminds.com.ng">
    <meta property="og:image" content="assets/images/logo/apple_icon.png">
    <meta property="og:description" content="NIS Comptroller-General Office Meeting Appointment Scheduling System">
    <meta property="og:site_name" content="GreatMinds Technologies">
    <meta property="og:locale" content="en_US">
    <meta property="og:locale:alternate" content="en_GB">
    <meta property="og:locale:alternate" content="es_ES">
    <meta property="og:locale:alternate" content="fr_FR">
    <meta property="og:locale:alternate" content="de_DE">
    <meta property="og:locale:alternate" content="pt_PT">
    <meta property="og:locale:alternate" content="ar_AR">
    <meta property="og:locale:alternate" content="zh_CN">
    <meta property="og:locale:alternate" content="ja_JP">
    <meta property="og:locale:alternate" content="ru_RU">
    <meta property="og:locale:alternate" content="ko_KR">
    <meta property="og:locale:alternate" content="it_IT">
    <meta property="og:locale:alternate" content="nl_NL">
    <meta property="og:locale:alternate" content="id_ID">
    <meta property="og:locale:alternate" content="th_TH">
    <meta property="og:locale:alternate" content="tr_TR">
    <meta property="og:locale:alternate" content="vi_VN">
    <meta property="og:locale:alternate" content="fa_IR">

    <!-- Favicon -->
     <link rel="icon" type="image/png" href="assets/images/logo/favicon.png">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="assets/images/logo/apple_icon.png">
    <!-- Preconnect and Prefetch -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://www.google-analytics.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://www.google.com">
    
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
    <!-- create a floating top navigation bar with modal button style float right for learn more and privacy policy -->
     <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top py-3">
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="assets/images/logo/nis_Images/nis_ImgID1.png" width="110" height="38" />
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#privacyPolicy">Privacy Policy</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#learnMoreModal">Learn More</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
     <!-- create a privacy policy modal page -->
     <div class="modal fade" id="privacyPolicy" tabindex="-1" aria-labelledby="privacyPolicyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="privacyPolicyLabel">Privacy Policy</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Our Privacy Policy is coming soon...</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- end of privacy policy modal -->
       <!-- create a modal for learn more -->
     <div class="modal fade" id="learnMoreModal" tabindex="-1" aria-labelledby="learnMoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="learnMoreModalLabel">Learn More</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Our Learn More is coming soon...</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <!-- end of learn more -->

    <!-- create a hero section with a background image 
    <section class="hero bg-cover bg-center overlay overlay-dark overlay-60" style="background-image:url(assets/images/cover/nis-cover-1.jpg)">
      <div class="container">
        <div class="row align-items-center min-vh-75">
          <div class="col-lg-6 text-center text-lg-start">
            <h1 class="display-4 fw-bold text-white mb-3">NIS-VAS<br>Secured Access</h1>
            <p class="lead text-white mb-4">Welcome to the Nigeria 
              Information Security VAS (NIS-VAS) portal</p>
            <a href="#" class="btn btn-danger">Learn More</a>
          </div>
        </div>
      </div>
    </section>
    end of hero section -->

			<div class="row g-0 bg-white min-vh-100 align-items-center">
      <div class="col-lg-6 text-center text-lg-start overflow-hidden z-index-2">
        <div class="px-3 py-6">
          <?php error($errors);
              success($message); ?>
          <div class="row">
            <div class="col-sm-8 col-md-6 col-lg-9 col-xl-12 mx-auto max-w-450">
			<!-- <img src="assets/images/logo/nis_Images/nis_ImgID1.png" width="110" height="38" /> -->
              <h1 class="fw-bold mb-5">NIS-VAS<br>Secured Access</h1>
			  
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
      <!-- create a slide jarallax background image -->
      <div class="d-none d-lg-block min-vh-100 col-lg-6 bg-cover py-8 overlay-dark overlay-opacity-75" style="background-image:url(assets/images/cover/nis-cover-2.jpg)">
        <svg class="d-none d-lg-block position-absolute h-100 top-0 text-white ms-n5" style="width:6rem" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
          <polygon points="50,0 100,0 50,100 0,100"></polygon>
        </svg>
      </div>
    </div>

            <!-- Footer -->
			<footer id="footer" class="footer-dark">
			
					<div class="container clearfix fw-light text-center-xs">

						<div class="fs-6 py-2 float-start float-none-xs m-0-xs">
							© 2024 | NIGERIA IMMIGRATION SERVICE | All rights reserved | Powered by NIS
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