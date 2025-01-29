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
<?php error($errors);
success($message); ?>
<!-- CHECKED IN GUEST SECTION -->
<div class="row">
	<div class="col-md-12">
		<div class="card shadow">
			<div class="card-header">
				<h4 class="mb-0 align-center text-danger">CHECKED IN GUESTS</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<!-- table to display checked in guests and checkout button -->
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
							if (isset($_SESSION['us3rid'])): 
								 $x = 1;
								foreach ($users as $user): ?>

									<tr>
										<td><?php echo $x; ?></td>
										<td><?php echo $user['title'] . ". " . $user['full_name']; ?></td>
										<td><?php echo $user['purpose']; ?></td>
										<td><?php echo $user['tagid']; ?></td>
										<td><?php echo $user['checkin']; ?></td>
										<td><?php echo $user['hostid']; ?></td>
										<!-- --display status of guest with button with color labels PENDING: btn-primary , APPROVED: btn-success, REFERED: btn-danger, CHECKEDOUT: btn-danger  -->
										<td>
										<?php $status = $entry->getStatusById($user['status_id']);
											if ($status) {
												 ?>
											<?php if ($status['status'] == 'PENDING'): ?>
												<button class="btn btn-primary btn-sm text-white">PENDING</button>
											<?php elseif ($status['status'] == 'APPROVED'): ?>
												<button class="btn btn-success btn-sm text-white">APPROVED</button>
											<?php elseif ($status['status'] == 'REFERED'): ?>
												<button class="btn btn-danger btn-sm text-white">REFERED</button>
											<?php elseif ($status['status'] == 'CHECKEDOUT'): ?>
												<button class="btn btn-danger btn-sm text-white">CHECKEDOUT</button>
											<?php endif; 
											}
											?>
										</td>
										<!-- checkout button to checkout guest with ajax confirmation -->
										<td>
											<a href="#"
												data-href="checkout.php?checkout=<?= $user['id']; ?>"
												class="js-ajax-confirm button small"
												data-ajax-confirm-mode="regular"
												data-ajax-confirm-size="modal-md"
												data-ajax-confirm-centered="false"
												data-ajax- confirm-title="Confirm Guest Checkout"
												data-ajax-confirm-body="Are you sure the guest is ready to leave?"
												data-ajax-confirm-btn-yes-class="btn-sm btn-danger"
												data-ajax-confirm-btn-yes-text="Confirm"
												data-ajax-confirm-btn-yes-icon="fi fi-check"
												data-ajax-confirm-btn-no-class="btn-sm btn-light"
												data-ajax-confirm-btn-no-text="Cancel"
												data-ajax-confirm-btn-no-icon="fi fi-close">
												Checkout
											</a>
										</td>
									</tr>
								<?php $x++;
								endforeach; ?>
						</tbody>
					<?php endif; ?>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<?php include_once 'inc/sidebar.php';
require_once 'inc/footer.php'; ?>