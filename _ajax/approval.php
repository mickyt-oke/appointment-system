<?php require_once '../config/dbConnection.php';
// Initialize variables
$errors = [];
$message = '';

// Create a database connection
$connection = (new Connection())->connect();
?>
<div class="modal-header border-0 pb-0">
    <h5 class="modal-title m-0">Guest Approval</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body p-0 m-5 m-4-xs">

    <div class="accordion" id="accordionAccount">
      <!-- display guest information -->
    <?php
    $guest = $entry->getGuestById($_GET['guestid']);
    if ($guest) {
    ?>
      <form role="form" action="approve.php?approve=" method="post">
        <div class="form-floating mb-3">
          <input class="form-control" name="tagid" value="<?php echo $guest['tagid']; ?>" />
          <label for="tagid">Tag ID</label>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control" name="full_name" value="<?php echo $guest['full_name']; ?>" />
          <label for="full_name">Full Name</label>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control" name="purpose" value="<?php echo $guest['purpose']; ?>" />
          <label for="purpose">Purpose</label>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control" name="address" value="<?php echo $guest['addresse']; ?>" />
          <label for="address">Address</label>
        </div>
        <button type="submit" class="btn btn-success w-100 text-white" name="approve">
          Approve
        </button>
      </form>
    <?php
    } else {
      echo "No record found";
    }?>
    </div>

  </div>
