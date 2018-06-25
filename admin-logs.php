<!DOCTYPE html>
<html>
<?php 
	$pagename = 'Logs';
	//include($_SERVER['DOCUMENT_ROOT'] . '/pma_all/head.php'); 
    //include($_SERVER['DOCUMENT_ROOT'] . '/pma_all/admindbconnect.php');
    include ('head.php');
    include ('admindbconnect.php');
?>

<style type="text/css">
.box {
	padding: 1.2em;
	overflow-x: auto;
	overflow-y: auto;
}
</style>
<body>
	
	<!-- navbar -->
	<?php include 'admin-navbar.php'; ?>
	<div class="container">
		<?php
			$queryLogs = "SELECT routingID, routing.slipID, dateIn, dateOut, slip.officeID AS 'originatingOffice', routing.officeID AS 'receivingOffice', documentNum, subject, priorityNum, status FROM slip LEFT JOIN routing ON slip.slipID = routing.slipID;";
			$getLogs = mysqli_query($connection, $queryLogs);
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

	<!-- required scripts -->
	<!-- jquery 
    <script src="jquery/dist/jquery.js"></script>-->
    <!--<script src="jquery/dist/jquery.min.js"></script>-->
    <!-- bootstrap 
    <script type="text/javascript" src=js/bootstrap.min.js"></script>-->
    <!-- datatables 
    <script type="text/javascript" src="datatables/DataTables-1.10.16/js/jquery.dataTables.js"></script>-->
	<script>
		$(function () {
			$('#logstable').DataTable({ 
				dom: 'Bfrtip', 
				buttons: [ 'print', 'pdf' ] //////////// PDF TO BE FIXED ///////////////
			})
		});
	</script>
</body>
	<?php 
	//include($_SERVER['DOCUMENT_ROOT'] . '/pma_all/footer.php');
	include ('footer.php'); 
	?>
</html>