<?php 
$pagename = 'Logs'; 
	//echo $_SERVER['DOCUMENT_ROOT']; 
	//include($_SERVER['DOCUMENT_ROOT'] . '/pma_all/head.php'); 
	//include($_SERVER['DOCUMENT_ROOT'] . '/pma_all/admindbconnect.php');
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
.box {
	padding: 1.2em;
	overflow-x: auto;
	overflow-y: auto;
}
html, body {
	width: 100%;
	overflow-x: hidden;
}
</style>
<body>
	<!-- navbar -->
	<?php include 'admin-navbar.php'; ?>
	<div class="container">
		<?php
			$queryLogs = "SELECT routingID, routing.slipID, dateIn, dateOut, slip.officeID AS 'originatingOffice', routing.officeID AS 'receivingOffice', documentNum, subject, priorityNum, status FROM slip LEFT JOIN routing ON slip.slipID = routing.slipID;";
			$getLogs = mysqli_query($con, $queryLogs);
		?>
		<div class="box">
			<div class="box-header">
				<div class="row">
					<div class="col-md-12">
						<h4>Logs</h4>
					</div>
				</div>
			</div>
			<div class="box-body">
				<table id="logstable" class="display compact">
					<thead>
						<tr>
							<th>Date In</th>
							<th>Date Out</th>
							<th>Originating Office</th>
							<th>Receiving Office</th>
							<th>Document Number</th>
							<th>Subject</th>
							<th>Priority</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if (mysqli_num_rows($getLogs) > 0) {
								while ($l = mysqli_fetch_assoc($getLogs)) { ?>
						
						<tr>
							<td><?php echo $l['dateIn']; ?></td>
							<td><?php echo $l['dateOut']; ?></td>
							<td><?php echo $l['originatingOffice']; ?></td>
							<td><?php echo $l['receivingOffice']; ?></td>
							<td><?php echo $l['documentNum']; ?></td>
							<td><?php echo $l['subject']; ?></td>
							<td><?php echo $l['priorityNum']; ?></td>
							<td><?php echo $l['status']; ?></td>
						</tr>
						<?php	}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script>
		$(function () {
			$('#logstable').DataTable({
				dom: 'Bfrtip', 
				buttons: [ 'pdf' ]
			})
		});
	</script>
</body>
	<?php include ('footer.php'); ?>
</html>