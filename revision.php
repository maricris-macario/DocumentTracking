<?php 
$pagename = "Revision";
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
	<html>
	<style type="text/css">
		textarea {
	    overflow: auto;
	    resize: vertical;
	    border: none;
	    padding: .3em;
	    border-radius: 30px;
	    background-color: white;
	    width: 100%;
	    min-height: 100px;
		}
	</style>
	<script type="text/javascript" src="js/timeDate.js"></script>
	<body class="animsition">
		<?php include ('navbar.php'); ?>  

		<!-- PAGE CONTAINER-->
		<div class="page-container">

			<?php include ('header.php'); ?>
			<!-- MAIN CONTENT-->
			<?php 
			$queryInSlip = "SELECT routing.slipID, routingID, slip.officeID AS originatingOffice, routing.officeID AS receivingOffice, dateIn, dateOut, routing.status, priorityNum, prioritylvl, documentNum, docType, subject, details, dateCreated, officeName, location, user.userID FROM routing LEFT JOIN slip ON routing.slipID = slip.slipID JOIN office ON office.officeID = routing.officeID JOIN type ON slip.typeID = type.typeID LEFT JOIN user ON routing.officeID = user.officeID WHERE routing.status = 'Revision' AND slip.userID = '{$ol_userID}' ORDER BY dateCreated DESC;";
			$getInSlip = mysqli_query($con, $queryInSlip);

			?>
			<div class="main-content">
				<div class="section__content section__content--p30">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="overview-wrap">
									<h2 class="title-1">Revision</h2>
								</div>
							</div>
						</div>
						<div class="row m-t-25">
							<div class="col-sm-12 col-lg">
								<div class="row">
									<div class="table table-responsive table-data2">
										<!--div class="table table-data2 table-responsive"-->
										<!--dito galing yung form-->
										<table class="table table-bordered table-condensed  text-center" id="Inslip">
											<!--table class="table table-striped table-bordered table-hover" id="slip"-->
											<thead>
												<th>Date In</th>
												<th>Last Destination</th>
												<th>Document Number</th>
												<th>Status</th>
												<th>Priority Number</th>
												<th>Originating Office</th>
												<!--<th>Action</th>-->
											</thead>
											<tbody>
												<?php 
												if(mysqli_num_rows($getInSlip) > 0){
													while ($s = mysqli_fetch_assoc($getInSlip)) {
														?>
														<tr>
															<td><?php echo $s['dateIn']; ?></td>
															<td><?php echo $s['officeName']; ?></td>
															<td><?php echo $s['documentNum']; ?></td>
															<td><?php echo $s['status']; ?></td>
															<td><?php echo $s['priorityNum']; ?></td>
															<td><?php echo $s['originatingOffice']; ?></td>

														</tr>
														<?php 
													}
												} else {
													echo mysqli_error($con);
												}
											?>
											</tbody>
										</table><br><br>
										<form action="return.php" method="POST">
											<h4 class="title-2">REMARKS:</h4><br>
											<input type="hidden" name="slipID"> <!--<?php //echo htmlspecialchars($_SESSION['slipID']);?> -->
											<input type="hidden" name="originatingOffice">
											<input type="hidden" name="routingID">
											<textarea rows="8" cols="40" border="2px" name="remarks"></textarea>
											<div><input class="btn btn-info" type="submit" value="RETURN"></div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT-->

			<!--MODAL moreDet -->
			<div id="moreDet" class="modal fade" role="dialog">
				<?php include('moredetails.php'); ?>
			</div>
			<!-- END OF MODAL -->

			<!-- MODAL editDet -->
			<div id="editDet" class="modal fade" role="dialog">
				<?php include('editDetails.php'); ?>                
			</div>

			<!--<?php include ('footer.php'); ?>-->

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

<!--DATATABLE-->

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#Inslip').DataTable( {
			"pagingType": "full_numbers"
		} );
	} );
</script>

</body>

</html>
<!-- end document-->
