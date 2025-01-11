<?php require_once 'config/dbConnection.php'; ?>

<?php 
   if (isset($_POST['register'])) {
	  $required = array('title','fullname', 'mobileno', 'purpose', 'prev_appt', 'host', 'gender', 'address');

	  foreach($_POST as $key=>$value) {
	    if (empty($value) && in_array($key, $required)) {
	      $errors[] = "Fill out all required fields please";
	      break;
	    }
	  }

	  // If no error
	  if (empty($errors)) {
	    // Get form values
	    $entry->purpose = sanitize('purpose');
	    $entry->prev_appt = sanitize('prev_appt');
	    $entry->hostid = sanitize('host');
	    $entry->title = sanitize('title');
	    $entry->full_name = sanitize('full_name');
        $entry->gender = sanitize('gender');
        $entry->mobileno = sanitize('mobileno');
        $entry->email = sanitize('email');
        $entry->stateid = sanitize('stateid');
        $entry->addresse = sanitize('addresse');
        $entry->remark = trim($_POST['vremark']);
        $entry->vcomment = trim($_POST['comment']);
        $entry->status_id = 1;
        $entry->isactive = 1;
        $entry->tagid = sanitize('tagid');
	    // If there are no errors, attempt to create record in database
	    // check database to see if tagid exist return error
if ($entry->tagIdExists($entry->tagid, $db)) {
            $errors[] = "Tag ID already exists. Please choose a different one.";
        } else {
            // Proceed with the insertion
            if ($entry->createEntry()) {
                $session->message("Visitor's Form submitted successfully with ID:" . $entry->tagid);
                header("Location: create-new.php");
                exit();
            } else {
              $errors[] = "Error creating new entry. Please try again.";
            }
        }
	  }
  }
?>

<?php include_once 'inc/header.php'; ?>
							<div class="container py-4">
                              <?php error($errors); success($message); ?>
								<div class="">
								<header class="major">
										<h2>NEW GUEST FORM</h2>
								</header>
									
				<div class="col">
                <div class="row mb-4">
                  <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onclick="return validateForm">
                    <div class="row g-3">
						<div class="col-sm-3">
                        <div class="form-floating">
                          <!--
                          <select class="form-select" name="tagid" id="numbers" required>
            //<?php
            //for ($i = 1; $i <= 100; $i++) {
             //   echo "<option value='$i'>$i</option>";
            //}
            //?>
        </select>
        -->
                          <select class="form-select" name="tagid" id="numbers" required>
            <?php
            // Generate numbers from 1 to 100
            $numbers = range(1, 100);

            // Randomize the order of the numbers
            shuffle($numbers);

            // Loop through the randomized numbers and add leading zeros
            foreach ($numbers as $number) {
                $formattedNumber = str_pad($number, 3, '0', STR_PAD_LEFT); // Add leading zeros
                echo "<option value='$formattedNumber'>$formattedNumber</option>";
            }
            ?>
        </select>
                          <label for="purpose">Tag ID:</label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-floating">
                          <select class="form-select" name="purpose" required>
                            <option value disabled selected>-- Select Purpose --</option>
                            <option value="OFFICIAL">Official</option>
                            <option value="PERSONAL">Personal</option>
                          </select>
                          <label for="purpose">Purpose</label>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-floating">
                          <select class="form-select" name="prev_appt" required>
							  <option value disabled selected>-- Select -- </option>
							  <option value="Yes">Yes</option>
							  <option value="No">No</option>
							</select>
                          <label for="prev_appointment">Booked Apppointment</label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-floating">
                          <select class="form-select" name="host" required>
							  <option value disabled selected>-- Select -- </option>
							  <option value="CGIS">CGIS</option>
							  <option value="PSO">PSO</option>
							  <option value="PA-ADMIN">PA-ADMIN</option>
							  <option value="PA-SPECIAL">PA-SPECIAL DUTIES</option>
							  <option value="PA-GENERAL">PA-GENERAL DUTIES</option>
							  <option value="PA-ICT">PA-ICT</option>
							  <option value="SA-PROTOCOL">SA-PROTOCOL</option>
							  <option value="SA-SECURITY">SA-SECURITY</option>
							  <option value="SA-PSO">SA-PSO</option>
							  <option value="ACG-ICT">ACG-ICT</option>
							  <option value="ACG-FA">DCG-F/A</option>
							  <option value="ACG-VISA">DCG-VISA</option>
                <option value="CIS-ICT">CIS-ICT</option>
                <option value="ACI-ICT">ACI-ICT</option>
                <option value="PRO">SA-PRO (ANNEX)</option>
                <option value="FACILITY">FACILITY MANAGER</option>
							</select>
                          <label for="host">Whom to See</label>
                        </div>
                      </div>
						<hr />
                      <div class="col-sm-4">
                        <div class="form-floating">
                          <select class="form-select" name="title" required>
							 <option disabled selected>-- Select --</option>
                            <option value="Mr">Mr</option>
                            <option value="Ms">Miss</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Dr">Dr</option>
                            <option value="Engr">Engr</option>
                            <option value="Chief">Chief</option>
                            <option value="hrh">HRH</option>
							</select>
							<label for="title">Title</label>
                        </div>
                      </div>
						<div class="col-sm-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="full_name" required>
                          <label for="fullname">Full Name</label>
                        </div>
						</div>
                      <div class="col-sm-4">
                        <div class="form-floating">
                          <select class="form-select" name="gender" required>
                          <option disabled selected>-- Select --</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
						</select>
							<label for="gender">Gender</label>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="mobileno" maxlength="11" minlength="11" required />
                          <label for="mobileno">Phone Number</label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-floating">
                          <input type="email" class="form-control" name="email">
                          <label for="email">E-mail<small class="text-info">(optional)</small></label>
                        </div>
                      </div>
					<div class="col-sm-4">
                        <div class="form-floating">
							<input required type="text" class="form-control input-suggest" name="stateid" 
                    placeholder="State" 
                    data-input-suggest-mode="text" 
                    data-input-suggest-name="state" 
                    data-input-suggest-ajax-url="_ajax/states.json"  
                    data-input-suggest-ajax-method="GET" 
                    data-input-suggest-ajax-action="input_suggest" 
                    data-input-suggest-ajax-limit="100">
                    
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="addresse" required>
                          <label class="w-100 text-truncate" for="address">Office/Residential Address</label>
                        </div>
                      </div>
					<div class="col-sm-6">
                        <div class="form-floating">
							<textarea type="text" class="form-control" name="vremark" placeholder="" rows="10"></textarea>
                          <label class="w-100 text-truncate" for="vremark">Visitor's Notes</label>
                        </div>
                      </div>
					<div class="col-sm-6">
                        <div class="form-floating">
							<textarea type="text" class="form-control" name="comment" placeholder="" rows="10"></textarea>
                          <label class="w-100 text-truncate" for="comment">Officer's Comments</label>
                        </div>
                      </div>

                      <div class="col-sm-12 align-center">
                        <button type="submit" class="button primary medium">
                        	<i class="fas fa-user"></i> Submit
                        </button>
                        <input type="hidden" name="register" value="register" />
                      </div>

                    </div>
                    </form>
                  </div>
                </div>

              </div>
		  </div>
		</div>
		</div>
		</div>
  <?php require_once 'inc/sidebar.php'; 
        require_once 'inc/footer.php';
?>


