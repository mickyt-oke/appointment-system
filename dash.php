<?php require_once 'config/dbConnection.php'; 
			admin(); 
        if (!isAdmin()){
        redirectTo ('index.php');
        }
?>

<?php require_once 'inc/header-1.php'; ?>
                                <section>
								<header class="major">
										<h2><?php echo $user->getName($_SESSION['us3rid']); ?> GUEST DASHBOARD</h2>
								</header>
								<div class="card-body">
											<div class="row text-white">
												<div class="col-sm-4 col-lg-4 col-xl-4">
													<div class="card bg-primary">
														<div class="card-body  mb-0">
															<small class="social-title">Registered Guests</small>
															<h3 class="text-xl text-white  mb-0"><?php echo $entry->countAllByHost($_SESSION['hostid']); ?></h3>
														</div>
													</div>
												</div>
                                                <div class="col-sm-4 col-lg-4 col-xl-4">
                                                    <div class="card bg-success">
                                                        <div class="card-body  mb-0">
                                                            <small class="social-title">Approved Guests</small>
															<h3 class="text-xl text-white  mb-0"><?php echo $entry->countApprovedByHost($_SESSION['hostid']); ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
												<div class="col-sm-4 col-lg-4 col-xl-4">
                                                    <div class="card bg-warning">
                                                        <div class="card-body  mb-0">
                                                            <small class="social-title">Pending Guests</small>
															<h3 class="text-xl text-white  mb-0"><?php echo $entry->countPendingByHost($_SESSION['hostid']); ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
												
												
										</div>
									</div>
							</section>

									<header class="major">
										<h2>APPROVAL POOL</h2>
									</header>
								<div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
							<div class="col-md-12 align-center">
                             <button class="button primary medium">Waiting Guests</button> 	
                            </div>
                            <div class="list-wrapper py-3">
                               <table id="example" class="table table-striped w-100 text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Guest Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $guests = $entry->getAllGuestsByHost($_SESSION['hostid']);
                                        if ($guests) {
                                            $count = 1;
                                            foreach ($guests as $guest): ?>
                                            <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $guest['title'].". " .$guest['full_name']; ?></td>
                                                <td><a href="approve.php?approve=" class="btn-sm btn-success">Approve</a> <a href="approve.php?refer=" class="btn-sm btn-danger">Refer</a></td>
                                            </tr>
                                            <?php $count++;
                                            endforeach;
                                        } else {
                                            echo "<tr><td colspan='3'>No record found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            
                            
                            
                            
                            
                            <!-- <div class="list d-flex align-items-center border-bottom py-3">
                                    <div class="wrapper w-100 ml-3">
                                        <p class="mb-0"><b>Adewale Adebisi</b>
                                    </div>
                                    <a href="#" class="align-right btn-sm btn-success" >Approve</a>
                                    <a href="#" class="align-right btn-sm btn-danger" >Refer</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
                    <div class="col-md-12 align-center">
                             <button class="button success">Approved Guests</button> 	
                            </div>
					<div class="list d-flex align-items-center border-bottom py-3">
                                
                                <div class="wrapper w-100 ml-3">
									<p class="mb-0"><b>Akande Adebisi </b>
                                    
                                </div>
                            </div>
						</div>
                </div>
            </div>
									</div>
						</div>
					</div>

				<?php include_once 'inc/sidebar-1.php';
					require_once 'inc/footer.php'; ?>