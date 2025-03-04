<?php require_once 'config/dbConnection.php';
require_once 'config/dbConfig.php';
admin();
if (!isAdmin()) {
    redirectTo('index.php');
}
?>

<?php require_once 'inc/header-1.php'; ?>
<?php error($errors);
success($message); ?>
<section>
    <header class="major">
        <h2><?php echo $user->getName($_SESSION['us3rid']); ?> GUEST DASHBOARD</h2>
    </header>
    <div class="card-body">
        <div class="row text-white">
            <!-- <div class="col-sm-3 col-lg-3 col-xl-3">
                <div class="card bg-primary">
                    <div class="card-body  mb-0">
                        <small class="social-title">Total Registered Guests</small>
                        <h3 class="text-xl text-white  mb-0"></h3>
                    </div>
                </div>
            </div> -->
            <div class="col-sm-3 col-lg-3 col-xl-3">
                <div class="card bg-success">
                    <div class="card-body  mb-0">
                        <small class="social-title">Approved Guests</small>
                        <h3 class="text-xl text-white  mb-0"><?php echo $entry->countApprovedByHost($_SESSION['hostid']); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-lg-3 col-xl-3">
                <div class="card bg-primary">
                    <div class="card-body  mb-0">
                        <small class="social-title">Pending Guests</small>
                        <h3 class="text-xl text-white  mb-0"><?php echo $entry->countPendingByHost($_SESSION['hostid']); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-lg-3 col-xl-3">
                <div class="card bg-dark">
                    <div class="card-body  mb-0">
                        <small class="social-title">Refused Guests</small>
                        <h3 class="text-xl text-white  mb-0"><?php echo $entry->countRefusedByHost($_SESSION['hostid']); ?></h3>
                    </div>
                </div>
            </div>
            <!-- show refer button if hostid = CGIS -->
            <?php if ($_SESSION['hostid'] == 'CGIS') {
                echo "<div class=\"col-sm-3 col-lg-3 col-xl-3\">
                <div class=\"card bg-danger\">
                    <div class=\"card-body  mb-0\">
                        <small class=\"social-title\">Referred Guests</small>
                        <h3 class=\"text-xl text-white  mb-0\">" . $entry->countReferByHost($_SESSION['hostid']) . "</h3>
                    </div>
                </div>  
            </div>";
            } else {
                echo "<div class=\"col-sm-3 col-lg-3 col-xl-3\">
                <div class=\"card bg-danger\">
                    <div class=\"card-body  mb-0\">
                        <small class=\"social-title\">Guests Referred</small>
                        <h3 class=\"text-xl text-white  mb-0\">" . $entry->countReferTo($_SESSION['hostid']) . "</h3>
                    </div>
                </div>
            </div>";
            } ?>


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
                    <button class="button medium" onClick="window.location.reload();">Waiting Guests</button>
                </div>
                <div class="list-wrapper py-3">
                    <table id="example1" class="table table-striped w-100 text-nowrap">
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
                                        <td><?php echo $guest['title'] . ". " . $guest['full_name']; ?></td>
                                        <td><?php echo "<a class=\"btn-sm btn-success\" title=\"approve " . htmlspecialchars_decode($guest['full_name'], ENT_QUOTES) . "\"href=\"dash.php?approve=" . htmlspecialchars_decode($guest['full_name'], ENT_QUOTES) . "\">APPROVE</a>"; ?>
                                            &nbsp;
                                            <!-- show refer button if hostid = CGIS -->
                                            <?php if ($_SESSION['hostid'] == 'CGIS') {
                                                echo "<a class=\"btn-sm btn-danger\" title=\"refer " . htmlspecialchars_decode($guest['full_name'], ENT_QUOTES) . "\"href=\"dash.php?view=" . htmlspecialchars_decode($guest['full_name'], ENT_QUOTES) . "\">REFER</a>";
                                            } ?>
                                        </td>
                                    </tr>
                            <?php $count++;
                                endforeach;
                            } else {
                                echo "<tr><td colspan='3'>No Guests available yet</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_REQUEST['view']) && $_SESSION['hostid'] == 'CGIS') {
        $guest = mysqli_query($con, "SELECT * FROM tb_appt WHERE full_name = '" . $_REQUEST['view'] . "'");
        $row = mysqli_fetch_array($guest);
        if ($row['status_id'] == 1) {
    ?>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 align-center mb-1">
                            <button class="btn btn-outline-danger text-dark">REFER GUEST</button>
                        </div>
                        <form action="approve.php?refer=<?= $row['id']; ?>" method="post">
                            <div class="row g-3 mb-1">
                                <div class="col-sm-12 form-floating mb-1">
                                    <input disabled class="form-control" name="full_name" value="<?php echo $row['title'] . ". " . $row['full_name']; ?>" />
                                    <label for="full_name">Guest Full Name</label>
                                </div>
                                <div class="col-sm-12 form-floating mb-1">
                                    <input disabled class="form-control" name="purpose" value="<?php echo $row['purpose']; ?>" />
                                    <label for="purpose">Purpose of Visit</label>
                                </div>
                                <!-- <div class="col-sm-12 form-floating mb-1">
                                <input disabled class="form-control" name="mobileno" value="" />
                                <label for="mobileno">Phone</label>
                            </div> -->
                                <div class="col-md-12 mb-1">
                                    <label for="refer">Refer To</label>
                                    <select class="form-control" name="referto" required>
                                        <option value disabled selected>-- Select --</option>
                                        <option value="PSO">PSO</option>
                                        <option value="PA-ADMIN">PA-ADMIN</option>
                                        <option value="SPECIAL">PA-SPECIAL DUTIES</option>
                                        <option value="GENERAL">PA-GENERAL DUTIES</option>
                                        <option value="PA-ICT">PA-ICT</option>
                                        <option value="PROTOCOL">SA-PROTOCOL</option>
                                        <option value="SECURITY">SA-SECURITY</option>
                                        <option value="CSO">CSO</option>
                                        <option value="DCG-FA">DCG-F/A</option>
                                        <option value="DCG-VISA">DCG-V/R</option>
                                        <option value="ACI-ICT">ACI-ICT</option>
                                        <option value="PRO">SA-PRO (ANNEX)</option>
                                        <option value="FACILITY">FACILITY MANAGER</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 form-floating mb-1">
                                    <textarea class="form-control" name="remarks" rows="5" cols="5" required></textarea>
                                    <label for="address">CGIS Message</label>
                                </div>
                            </div>
                            <div class="col-md-12 align-center">
                                <button type="submit" class="btn-sm btn-danger text-white" name="refer">
                                    Refer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    <?php } else {
            echo "You are not permitted to refer this guest";
        }
    } ?>

    <?php if (isset($_REQUEST['approve'])) {
        $guest = mysqli_query($con, "SELECT * FROM tb_appt WHERE full_name = '" . $_REQUEST['approve'] . "'");
        $row = mysqli_fetch_array($guest);
        if ($row) {
    ?>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 align-center py-2">
                            <button class="btn btn-outline-success text-dark">GUEST DETAILS</button>
                        </div>
                        <div class="row g-3 mb-0">
                            <form action="approve.php?approve=<?= $row['id']; ?>" method="post">
                                <div class="col-sm-12 form-floating mb-3">
                                    <input disabled class="form-control" name="tagid" value="<?php echo $row['tagid']; ?>" />
                                    <label for="tagid">Tag ID</label>
                                </div>
                                <div class="col-sm-12 form-floating mb-3">
                                    <input disabled class="form-control" name="full_name" value="<?php echo $row['title'] . ". " . $row['full_name']; ?>" />
                                    <label for="full_name">Full Name</label>
                                </div>
                                <div class="col-sm-12 form-floating mb-3">
                                    <input disabled class="form-control" name="purpose" value="<?php echo $row['purpose']; ?>" />
                                    <label for="purpose">Purpose</label>
                                </div>
                                <div class="col-sm-12 form-floating mb-3">
                                    <input disabled class="form-control" name="mobileno" value="<?php echo $row['mobileno']; ?>" />
                                    <label for="mobileno">Phone</label>
                                </div>
                                <div class="col-sm-12 form-floating mb-3">
                                    <input disabled class="form-control" name="address" value="<?php echo $row['addresse']; ?>" />
                                    <label for="address">Address</label>
                                </div>
                                <div class="col-sm-12 form-floating mb-3">
                                    <input disabled class="form-control" name="remark" value="<?php echo $row['remark']; ?>" />
                                    <label for="address">Visitor's Message</label>
                                </div>
                                <div class="col-sm-12 form-floating mb-3">
                                    <input disabled class="form-control" name="vcomment" value="<?php echo $row['vcomment']; ?>" />
                                    <label for="address">Remark</label>
                                </div>
                                <input type="hidden" name="approvedby" value="<?php echo $_SESSION['hostid']; ?>">
                                <div class="col-md-12 align-center">
                                    <button type="submit" class="btn-sm btn-success text-white" name="submit">
                                        Approve
                                    </button>
                                    <button type="submit" class="btn-sm btn-dark text-white" name="clear">
                                        Clear
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        } else {
            echo "No record found";
        }
    } ?>
</div>
</div>
</div>

<?php include_once 'inc/sidebar-1.php';
require_once 'inc/footer.php'; ?>