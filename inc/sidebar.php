					<div id="sidebar">
						<div class="inner">

							<section class="alt">
								<img src="assets/images/logo/nis_Images/nis_ImgID1.png" alt="NIS" width="110" height="38" />
							</section>

							<nav id="menu">
								<header class="major">
									<h5><a class="logo" href="dashboard.php">Dashboard Menu</a></h5>
								</header>
								<ul>
									<li><a href="create-new.php">New Entry</a></li>
									<li><a href="#">Reports</a></li>
									<li><a href="#">Channel</a></li>
								</ul>


								<div class="py-3">
									<header class="major">
										<h5>Active Visitors Tags</h5>
									</header>
									
									<?php
									$activeTag = $entry->getActiveTag();
									if ($activeTag) {
										foreach ($activeTag as $tag) {
											echo '<a href="#" title="Tag_No '.$tag['tagid'].'" class="col-md-6 row mb-1 btn-sm btn-success text-white text-center text-decoration-none">' . $tag['tagid'] . '</a>';
										}
									} else {
										echo '<p>No active tags</p>';
									}
									?>
								</div>

								<div class="col-sm-12 align-center">
									<a href="logout.php" class="button secondary small" type="submit"><i class="fas fa-user"></i>Logout </a>

								</div>
								<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; 2024 | NIS | All rights reserved</p>
								</footer>

						</div>
					</div>

					</div>