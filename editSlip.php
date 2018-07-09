<?php 
$pagename = "Edit Slip";
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
input[type=text], input[type=date] {
	border: none;
	width: 70%;
	background-color: white;
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
	min-height: 150px;
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
					<form action="user-queries.php" method="post">
						<div class="row">
							<div class="col-md-12">
								<div class="overview-wrap">
									<h2 class="title-1">Slip</h2>
								</div>
							</div>
						</div>
						<?php
						$ol_userID = $_SESSION['userID'];
						if (isset($_POST['editSlp_slipID'])) {
							$editSlp_slipID = $_POST['editSlp_slipID'];
							$queryinfo = "SELECT * FROM slip LEFT JOIN office ON slip.officeID = office.officeID LEFT JOIN type ON slip.typeID = type.typeID WHERE slipID = '{$editSlp_slipID}' AND userID = '{$ol_userID}';";
							$getinfo = mysqli_query($con, $queryinfo);
							if (mysqli_num_rows($getinfo) > 0) {
								while ($s = mysqli_fetch_assoc($getinfo)) { ?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Document Number</label>
												<input type="text" name="editSlp_docNum" value="<?php echo $s['documentNum']; ?>" placeholder="<?php echo $s['documentNum']; ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Date Slip Submitted</label>
												<input type="date" name="editSlp_date" value="<?php echo $s['date']; ?>" placeholder="<?php echo $s['date']; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Document Type</label>
												<!--<input type="text" value="<?php echo $info['docType']; ?>">-->
												<select name="editSlp_docType" class="form-control">
													<option value="<?php echo $s['typeID']; ?>" disabled="disabled" selected><?php echo $s['docType']; ?></option>
													<?php
													$queryDocTypes = "SELECT * FROM type";
													$getDocTypes = mysqli_query($con, $queryDocTypes);
													if (mysqli_num_rows($getDocTypes) > 0) {
														while ($dt = mysqli_fetch_assoc($getDocTypes)) { ?>
															<option value="<?php echo $dt['typeID']; ?>"><?php echo $dt['docType']; ?></option>
														<?php		}
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Priority Level</label>
												<select name="editSlp_priLvl" class="form-control">
													<option value="" disabled="disabled" selected>Select</option>
													<option value="Regular">Regular</option>
													<option value="Rush">Rush</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Subject</label>
												<textarea name="editSlp_subj"><?php echo $s['subject']; ?></textarea>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Details</label>
												<textarea name="editSlp_details"><?php echo $s['details']; ?></textarea>
											</div>
										</div>
									</div>
								<?php	}
							}
						} else {
							echo mysqli_error($con);
						} ?>
						<div class="row">
							<div class="offset-md-9 col-md-3">
								<button class="btn btn-md btn-success" value="<?php echo $s['slipID']; ?>" name="editSlp"> Submit </button>
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