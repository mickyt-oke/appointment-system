<?php require_once 'config/dbConnection.php';
require_once 'config/dbConfig.php';
?>
<?php require_once 'inc/header.php'; ?>
<section>
	<header class="major">
		<h2>DAILY STATS</h2>
	</header>
	<div class="card-body">
		<div class="row text-white">
			<div class="col-sm-3 col-lg-3 col-xl-3">
				<div class="card bg-dark">
					<div class="card-body  mb-0">
						<small class="social-title">Total Registered Guests</small>
						<h3 class="text-white text-xl mb-2"><?php echo $entry->countAll(); ?></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-lg-3 col-xl-3">
				<div class="card bg-success">
					<div class="card-body  mb-0">
						<small class="social-title">Approved Guests</small>
						<h3 class="text-xl text-white  mb-2"><?php echo $entry->countApprovedGuests(); ?></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-lg-3 col-xl-3">
				<div class="card bg-warning">
					<div class="card-body  mb-0">
						<small class="social-title">Pending Appointments</small>
						<h3 class="text-xl text-white  mb-2"><?php echo $entry->countPendingGuests(); ?></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-lg-3 col-xl-3">
				<div class="card bg-danger">
					<div class="card-body  mb-0">
						<small class="social-title">Checked-out Guests</small>
						<h3 class="text-xl text-white  mb-2"><?php echo $entry->countCheckOut(); ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="row">
	<div class="col-md-12">
		<div class="card shadow">
			<div class="card-header">
				<h4 class="mb-0 align-center text-danger">CHECKED IN GUESTS</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<form method="get" action="checkout.php">
					<table id="example" class="table table-striped w-100 text-nowrap">
						<thead>
							<tr>
								<th>S/N</th>
								<th>FULLNAMES</th>
								<th>PURPOSE</th>
								<th>TAG NO.</th>
								<th>CHECK IN</th>
								<th>HOST</th>
								<th>STATUS</th>
								<th>CHECK OUT</th>
							</tr>
						</thead>
						<tbody>
							<?php $users = $entry->getApptForToday();
							if (isset($_SESSION['us3rid'])): ?>
								<?php $x = 1;
								foreach ($users as $user): ?>

									<tr>
										<td><?php echo $x; ?></td>
										<td><?php echo $user['title'] . ". " . $user['full_name']; ?></td>
										<td><?php echo $user['purpose']; ?></td>
										<td><?php echo $user['tagid']; ?></td>
										<td><?php echo $user['checkin']; ?></td>
										<td><?php echo $user['hostid']; ?></td>
										<td><?php echo $user['status_id']; ?></td>
										<td>
											<a href="#"
												data-href="checkout.php"
												class="js-ajax-confirm button small"
												data-ajax-confirm-mode="regular"
												data-ajax-confirm-size="modal-md"
												data-ajax-confirm-centered="false"
												data-ajax-confirm-title="Please Confirm"
												data-ajax-confirm-body="Are you sure Guest is ready to leave?"
												data-ajax-confirm-btn-yes-class="btn-sm btn-danger"
												data-ajax-confirm-btn-yes-text="Confirm"
												data-ajax-confirm-btn-yes-icon="fi fi-check"
												data-ajax-confirm-btn-no-class="btn-sm btn-light"
												data-ajax-confirm-btn-no-text="Cancel"
												data-ajax-confirm-btn-no-icon="fi fi-close">
												CHECKOUT
											</a>
											<input type="hidden" name="checkout" value="checkout" />
										</td>
									</tr>
								<?php $x++;
								endforeach; ?>
						</tbody>
					<?php endif; ?>
					</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<?php include_once 'inc/sidebar.php';
require_once 'inc/footer.php'; ?>