<?php $pagename = "Send" ?>
<?php include ('head.php')?>
<?php include ('db.php')?>
<style type="text/css">
input[type=text] {
  border: none;
  width: 70%;
  background-color: white; /*#f5f5f5*/
  border-radius: 30px;
  padding: .3em;
  clear: both;
}
textarea {
  overflow: auto;
  resize: vertical;
  border: none;
  padding: .3em;
  border-radius: 30px;
  background-color: white;
  width: 100%;
  min-height: 3em;
}                       
</style>

<body class="animsition">
  <?php include ('navbar.php'); ?>  

  <!-- PAGE CONTAINER-->
  <div class="page-container">
    <?php include ('header.php'); ?>
    <div class="main-content">
      <div class="section__content section__content--p30">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="overview-wrap">
                <h2 class="title-1">Document Details</h2>
              </div>
            </div>
          </div>
          <form action="user-queries.php" method="post">
            <?php 
            if (isset($_POST['routingID'])) {
              $routingID = $_POST['routingID'];

              $queryinfo = "SELECT routingID, slip.officeID AS originatingOffice, routing.officeID AS receivingOffice, dateIn, dateOut, status, priorityNum, prioritylvl, documentNum, docType, slip.typeID, subject, details, date AS slipDate, officeName, location FROM routing LEFT JOIN slip ON routing.slipID = slip.slipID JOIN office ON office.officeID = slip.officeID JOIN type ON slip.typeID = type.typeID WHERE routingID = '{$routingID}';";
              $getinfo = mysqli_query($con, $queryinfo);
              if (mysqli_num_rows($getinfo) > 0) {
                while ($info = mysqli_fetch_assoc($getinfo)) { ?>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Document Number</label>
                        <input type="text" value="<?php echo $info['documentNum']; ?>" style="background-color: #f5f5f5;" disabled>
                        <input type="text" name="fwdSlp_docNum" value="<?php echo $info['documentNum']; ?>" hidden>
                      </div>
                      <div class="form-group">
                        <label>Originating Office</label>
                        <input type="text" value="<?php echo $info['officeName']; ?>" style="background-color: #f5f5f5;" disabled>
                      </div>
                      <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="fwdSlp_subj" value="<?php echo $info['subject'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Document Type</label>
                        <select name="fwdSlp_docType" class="form-control">
                          <option selected="selected" value="<?php echo $info['typeID']; ?>" disabled><?php echo $info['docType']; ?></option>
                          <?php
                          $queryDocTypes = "select * from type;";
                          $getDocTypes = mysqli_query($con, $queryDocTypes);
                          if (mysqli_num_rows($getDocTypes) > 0) {
                            while ($dt = mysqli_fetch_assoc($getDocTypes)) { ?>
                              <option value="<?php echo $dt['typeID']; ?>"><?php echo $dt['docType']; ?></option>
                            <?php   }
                          } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Date Slip Submitted</label>
                        <input type="text" value="<?php echo $info['slipDate']; ?>" style="background-color: #f5f5f5;" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Details</label>
                        <textarea name="fwdSlp_det"><?php echo $info['details']; ?></textarea>
                      </div>
                    </div>
                  </div>
                <?php }
              }
            }
            ?>
            <div class="row">
              <div class="col-md-12">
                <div class="overview-wrap">
                  <h2 class="title-1">Forward Document to Another Office</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Priority Level</label>
                  <select name="fwdSlp_priLvl" class="form-control">
                    <option disabled>Select</option>
                    <option selected="selected" value="Regular">Regular</option>
                    <option>Rush</option>
                  </select>
                </div>
                <div class="form-check">
                <label>Select Office/s:</label>
                <?php
                $queryOffices = "select * from office";
                $getOffices = mysqli_query($con, $queryOffices);
                if (mysqli_num_rows($getOffices) > 0) {
                 while ($office = mysqli_fetch_assoc($getOffices)) { ?>
                  <div class="row">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="sendToOffc[]" value="<?php echo $office['officeID']; ?>"><?php echo $office['officeName']; ?>
                    </label>
                  </div>
                <?php   }
              }
              ?>
              <button class="btn btn-outline-success" type="submit" name="forwardToOffc" value="submit">Submit</button>
            </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Priority Num</label>
                  <select class="form-control" name="fwdSlp_priNum">
                    <option value="0" selected="selected" disabled>Select</option>
                    <?php
                      $queryPri = "SHOW COLUMNS FROM routing WHERE Field = 'priorityNum';";
                      $execQuery = mysqli_query($con, $queryPri);
                      $getPri = mysqli_fetch_assoc($execQuery);
                      $enum = $getPri['Type'];
                      preg_match("/^enum\(\'(.*)\'\)$/", $enum, $matches);
                      $vals = explode("','", $matches[1]);
                      foreach ($vals as $v) { ?>
                        <option><?php echo $v; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
          </div>
        </form>
      </div>
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

<!--DATATABLE-->

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</body>
</html>