<?php 
$pagename = "Slips";
include ('head.php');
include ('db.php');
if (isset($_SESSION['loggedIn'])) {
  if ($_SESSION['loggedIn'] === 'FALSE' || empty($_SESSION['loggedIn'])) {
    echo "<script type='text/javascript'>alert('Login required.'); window.location.href='index.php';</script>";
        //echo print_r($_SESSION['loggedIn']);
        //header("location: index.php");
  }
} else {
  echo "<script type='text/javascript'>alert('Login required.'); window.location.href='index.php';</script>";
}
?>

<style type="text/css"> 
tr > td > input[type="text"], input[type="date"] {
  border: none;
  padding: .3em;
  background-color: #f5f5f5;
  border-radius: 30px;
}
textarea {
  border: none;
  padding: .3em;
  background-color: #f5f5f5;
  border-radius: 30px;
  resize: vertical;
  min-height: 40px;
}
</style>

<body class="animsition">
  <?php include ('navbar.php'); ?>  

  <!-- PAGE CONTAINER-->
  <div class="page-container">

    <?php include ('header.php'); ?>
    <!-- MAIN CONTENT-->
    <?php 
    $ol_userID = $_SESSION['userID'];
    //$ol_officeID = $_SESSION['officeID'];
    //$querySlip = "SELECT * FROM slip LEFT JOIN office ON slip.officeID = office.officeID LEFT JOIN user ON office.officeID = user.officeID LEFT JOIN type ON slip.typeID = type.typeID WHERE userID = '{$ol_userID}' ORDER BY date DESC;";
    $querySlip = "SELECT * FROM slip LEFT JOIN office ON slip.officeID = office.officeID LEFT JOIN type ON slip.typeID = type.typeID WHERE userID = '{$ol_userID}' ORDER BY dateCreated DESC;";
    $getSlip = mysqli_query($con, $querySlip);
    ?>
    <div class="main-content">
      <div class="section__content section__content--p30">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="overview-wrap">
                <h2 class="title-1">Slips</h2>
                <a href="addSlip.php"><button class="au-btn au-btn-icon au-btn--blue">
                  <i class="zmdi zmdi-plus"></i>Add slip</button></a>
                </div>
              </div>
            </div>
            <div class="row m-t-25">
              <div class="col-sm-12 col-lg">
                <div class="row">
                  <div class="table table-data2">
                    <table class="table table-bordered table-condensed text-center" id="slip">
                      <thead>
                        <th>Date</th>
                        <!--<th>Receiving Office/s</th>-->
                        <th>Document Number</th>
                        <th>Subject</th>
                        <th>Details</th>
                        <th>Doctype</th>
                        <th>Priority</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                        if(mysqli_num_rows($getSlip) > 0){
                          while ($s = mysqli_fetch_assoc($getSlip)) {
                            ?>
                            <tr>
                              <td>
                                <!--<input type="date" name="editSlp_date" value="<?php //echo $s['date']; ?>" placeholder="<?php //echo $s['date']; ?>">-->
                                <?php echo $s['dateCreated']; ?>
                              </td>
                              <!--<td>
                                <input type="text" name="editSlp_offcname" value="<?php //echo $s['officeName']; ?>" placeholder="<?php //echo $s['officeName']; ?>">
                                <?php //echo $s['officeName']; ?>
                              </td>-->
                              <td>
                                <!--<input type="text" name="editSlp_docNum" value="<?php //echo $s['documentNum']; ?>" placeholder="<?php //echo $s['documentNum']; ?>">-->
                                <?php echo $s['documentNum']; ?>
                              </td>
                              <td>
                                <!--<textarea name="editSlp_subj"><?php //echo $s['subject']; ?></textarea>-->
                                <?php echo $s['subject']; ?>
                              </td>
                              <td>
                                <!--<textarea name="editSlp_details"><?php //echo $s['details']; ?></textarea>-->
                                <?php echo $s['details']; ?>
                              </td>
                              <td>
                                <!--<input type="text" name="editSlp_docType" value="<?php //echo $s['docType']; ?>" placeholder="<?php //echo $s['docType']; ?>">-->
                                <?php echo $s['docType']; ?>
                              </td>
                              <td>
                                <!--<input type="text" name="editSlp_priLvl" value="<?php //echo $s['prioritylvl']; ?>" placeholder="<?php //echo $s['prioritylvl']; ?>">-->
                                <?php echo $s['prioritylvl']; ?>
                              </td>
                              <td>
                                <div class="table-data-feature">
                                  <form action="editSlip.php" method="post">
                                    <!--<input type="text" name="editSlp_slipID" value="<?php //echo $s['slipID']; ?>" hidden>-->
                                    <button class="item" type="submit" data-toggle="tooltip" title="Edit Slip" name="editSlp_slipID" value="<?php echo $s['slipID']; ?>"><i class="zmdi zmdi-edit"></i></button>
                                    <!--<button class="item" data-toggle="modal" data-target="#editDet">
                                      <i class="zmdi zmdi-edit"></i>
                                    </button>-->
                                  </form>
                                  <form action="user-queries.php" method="post">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete Slip" name="slip_cancelSlp" value="<?php echo $s['slipID']; ?>"><i class="zmdi zmdi-delete"></i></button>
                                  </form>
                                  <!--<button class="item" data-toggle="modal" data-target="#moreDet">
                                    <i class="zmdi zmdi-more"></i>
                                  </button>-->
                                </div>
                              </td> 
                            </tr>
                          <?php }
                        } else {
                          echo mysqli_error($con);
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END MAIN CONTENT-->

      <!--MODAL SLIP
      <div id="addSlip" class="modal fade" role="dialog">
        <?php //include('addslipModal.php'); ?>
      </div>
      END OF MODAL-->

      <!--MODAL moreDet 
      <div id="moreDet" class="modal fade" role="dialog">
        <?php //include('moredetails.php'); ?>
      </div>-->
      <!-- END OF MODAL -->

      <!-- MODAL editDet 
      <div id="editDet" class="modal fade" role="dialog">
        <?php //include('editDetails.php'); ?>                
      </div>-->

      <?php include ('footer.php'); ?>

      <!-- END PAGE CONTAINER-->
    </div>
  </div>
</div>
<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js">
</script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="js/main.js"></script>

<!-- DATA TABLE -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#slip').DataTable( {
      "pagingType": "full_numbers"
    } );
  } );
</script>


</body>

</html>
<!-- end document-->
