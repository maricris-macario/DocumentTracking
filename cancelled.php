<?php $pagename = "Cancelled";
include ('head.php');
include ('db.php');
if (isset($_SESSION['loggedIn'])) {
	if ($_SESSION['loggedIn'] === 'FALSE' || empty($_SESSION['loggedIn'])) {
		echo "<script type='text/javascript'>alert('Login required.'); window.location.href='index.php';</script>";
	}	
} else {
	echo "<script type='text/javascript'>alert('Login required.'); window.location.href='index.php';</script>";
}
?>

<body class="animsition">
	<?php include ('navbar.php'); ?>  

	<!-- PAGE CONTAINER-->
	<div class="page-container">

		<?php include ('header.php'); ?>
		<!-- MAIN CONTENT-->
		<?php 
		$ol_userID = $_SESSION['userID'];
		//$queryCanSlip = "SELECT routingID, slip.officeID AS originatingOffice, routing.officeID AS receivingOffice, dateIn, dateOut, status, priorityNum, prioritylvl, documentNum, docType, subject, details, date AS slipDate, officeName, location FROM routing LEFT JOIN slip ON routing.slipID = slip.slipID JOIN office ON office.officeID = slip.officeID JOIN type ON slip.typeID = type.typeID WHERE status='Cancelled' ORDER BY slipDate DESC;";
/////////// CANCELLED SLIPS OR CANCELLED BY RECEIVING OFFICE??? ///////////
		$queryCanSlip = "SELECT routing.slipID, routingID, slip.officeID AS originatingOffice, routing.officeID AS receivingOffice, dateIn, dateOut, routing.status, priorityNum, prioritylvl, documentNum, docType, subject, details, dateCreated, officeName, location, userID FROM routing LEFT JOIN slip ON routing.slipID = slip.slipID JOIN office ON office.officeID = slip.officeID JOIN type ON slip.typeID = type.typeID WHERE routing.status = 'Cancelled' AND userID = '{$ol_userID}' ORDER BY dateCreated DESC;";
		$getCanSlip = mysqli_query($con, $queryCanSlip);

		?>
		<div class="main-content">
			<div class="section__content section__content--p30">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="overview-wrap">
								<h2 class="title-1">Cancelled</h2>
							</div>
						</div>
					</div>
					<div class="row m-t-25">
						<div class="col-sm-12 col-lg">
							<div class="row">
								<div class="table table-responsive table-data2">
									<!--div class="table table-data2 table-responsive"-->
									<table class="table table-bordered table-condensed  text-center" id="canSlip">
										<!--table class="table table-striped table-bordered table-hover" id="slip"-->
										<thead>
											<th>Date</th>
											<th>Originating Office</th>
											<th>Document Number</th>
											<th>Subject</th>
											<th>Doctype</th>
											<th>Priority</th>
											<th>Action</th>
										</thead>
										<tbody>
											<?php 
											if(mysqli_num_rows($getCanSlip) > 0){
												while ($slip = mysqli_fetch_assoc($getCanSlip)) {
													?>
													<tr>
														<td><?php echo $slip['dateCreated']; ?></td>
														<td><?php echo $slip['officeName']; ?></td>
														<td><?php echo $slip['documentNum']; ?></td>
														<td><?php echo $slip['subject']; ?></td>
														<td><?php echo $slip['docType']; ?></td>
														<td><?php echo $slip['prioritylvl']; ?></td>
														<td>
															<div class="table-data-feature">
																	<!--<button class="item" data-toggle="modal" data-target="#editDet"><i class="zmdi zmdi-edit"></i></button>
																		<button class="item" data-toggle="tooltip" title="Delete"><i class="zmdi zmdi-delete"></i></button>-->
																		<form action="routingSlipInf.php" method="post">
																			<input type="text" value="<?php echo $slip['routingID']; ?>" name="routingID" hidden>
																			<button name="routingID" class="item" type="submit" value="<?php echo $slip['routingID']; ?>" data-toggle="tooltip" title="More Info"><i class="zmdi zmdi-more"></i></button>
																		</form>
																		<form action="user-queries.php" method="post">
																			<input type="text" name="resub_canSlip" value="<?php echo $slip['slipID']; ?>" hidden>
																			<input type="text" name="resub_canPriNum" value="<?php echo $slip['priorityNum']; ?>" hidden>
																			<input type="text" name="resub_recvOffc" value="<?php echo $slip['receivingOffice']; ?>" hidden>
																			<button class="item" type="submit" name="reactivate" value="<?php echo $slip['routingID']; ?>" data-toggle="tooltip" title="Resubmit"><i class="zmdi zmdi-badge-check"></i></button>
																		</form>
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

				<!-- MODAL editDet -->
				<div id="editDet" class="modal fade" role="dialog">
					<form>
						<div class="modal-dialog modal-xl">
							<!--MODAL CONTENT-->
							<div class="modal-content">
								<!--HEADER-->
								<div class="modal-header">
									<h4 class="modal-title">Edit Details</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<!--END OF HEADER-->
								<div class="modal-body">
									<div class="form-group">
										<label>Date</label>
										<input type="date" name="date" class="form-control">
									</div>
									<div class="form-group">
										<label>Originating Office</label>
										<input type="text" name="origOffice" class="form-control">
									</div>
									<div class="form-group">
										<label>Document Number</label>
										<input type="text" name="docNum" class="form-control">
									</div>
									<div class="form-group">
										<label>Subject</label>
										<input type="text" name="subject" class="form-control">
									</div>
									<div class="form-group">
										<label>Document Type</label>
										<select name="docType" class="form-control">
											<option value="" selected="selected" disabled>Select</option>
											<?php
											$queryDocTypes = "SELECT * FROM type;";
											$getDocTypes = mysqli_query($con, $queryDocTypes);
											if (mysqli_num_rows($getDocTypes) > 0) {
												while ($dt = mysqli_fetch_assoc($getDocTypes)) { ?>
													<option value="<?php echo $dt['typeID']; ?>"><?php echo $dt['docType']; ?></option>
												<?php   }
											}
											?>
										</select>
									</div>
								</div>
								<div class="modal-footer">

								</div>
							</div>
						</div>                      
					</form>              
				</div>
				<!-- END OF MODAL -->

				<!--<?php //include ('footer.php'); ?>-->

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
			$('#canSlip').DataTable( {
				"pagingType": "full_numbers"
			});
		} );
	</script>

</body>

</html>
<!-- end document-->
