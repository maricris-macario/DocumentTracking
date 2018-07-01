<?php $pagename = "Slip Info" ?>
<?php include ('head.php')?>
<?php include ('db.php')?>
<style type="text/css">
	input[type=text] {
		border: none;
		width: 70%;
		background-color: #f5f5f5;
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
	    background-color: #f5f5f5;
	    width: 100%;
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
								<h2 class="title-1">Slip</h2>
							</div>
						</div>
					</div>
					<?php
					if (isset($_POST['routingID'])) {
						$routingID = $_POST['routingID'];
					}
					$queryinfo = "SELECT routingID, slip.officeID AS originatingOffice, routing.officeID AS receivingOffice, dateIn, dateOut, status, priorityNum, prioritylvl, documentNum, docType, subject, details, date AS slipDate, officeName, location FROM routing LEFT JOIN slip ON routing.slipID = slip.slipID JOIN office ON office.officeID = slip.officeID JOIN type ON slip.typeID = type.typeID WHERE routingID = '{$routingID}';";
					$getinfo = mysqli_query($con, $queryinfo);
					if (mysqli_num_rows($getinfo) > 0) {
						while ($info = mysqli_fetch_assoc($getinfo)) { ?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Document Number</label>
										<input type="text" value="<?php echo $info['documentNum']; ?>" disabled>
									</div>
									<div class="form-group">
										<label>Originating Office</label>
										<input type="text" value="<?php echo $info['officeName']; ?>" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Document Type</label>
										<input type="text" value="<?php echo $info['docType']; ?>" disabled>
									</div>
									<div class="form-group">
										<label>Date Slip Submitted</label>
										<input type="text" value="<?php echo $info['slipDate']; ?>" disabled>
									</div>
									<div class="form-group">
										<label>Subject</label>
										<input type="text" value="<?php echo $info['subject']; ?>" disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Details</label>
										<textarea disabled><?php echo $info['details']; ?></textarea>
									</div>
								</div>
							</div>
						<?php	}
					}
					?>
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