<!DOCTYPE html>
<html>
<head>
	<title> Messages </title>
	<!-- This section is for the Head -->
    <?php include("../../include/Head.php"); ?>
<style></style>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include("../../include/Header.php"); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
	<h1>My Messages</h1>

	<a href="/comp353-project/public/view/main/Secured/SentMessages.php"><button class="btn btn-default">View Sent Messages</button></a>

	<!-- Trigger the modal with a button -->
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">New Message</button>

	<?php include "/comp353-project/app/sendMessage.php"?>
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">New Message</h4>
				</div>
				<div class="modal-body">
					<form action="/comp353-project/app/sendMessage.php" method="POST">
						<div class="form-group">
							<label for="user">To:</label>
							<input type="text" class="form-control" name="user" id="user" placeholder="Enter Username">
						</div>
						<div class="form-group">
							<label for="message">Message:</label>
							<textarea class="form-control" rows="5" name="message" id="message" placeholder="Enter message"></textarea>
						</div>
						<button class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success">Submit</button>
					</form>
				</div>
			</div>

		</div>
	</div>

	<div class="container" style="border-style:solid; border-width:3px; height:90%; overflow-y:scroll;" id="messages">

		<?php

		function GetMessages() {
			include("../../../../config/dbMakeConnection.php");

			$status = Connected();
			if ($status == 1) {
				try {
					$d = new dbMakeConnection;
				} catch (PDOException $e) {
					echo($e);
				}

				$u = $_SESSION['username'];

				// GET USER MESSAGES
				$stmt = $d->conn->prepare(
					"select m.MessageId, mem2.UName, m.Date, m.Content 
					from comp353.Message m join comp353.Member mem2 on comp353.m.SenderId = comp353.mem2.UserId 
					join comp353.Member mem on comp353.m.ReceiverId = comp353.mem.UserId 
					where comp353.mem.UName like :u");
				$stmt->bindParam(':u', $u);
				$stmt->execute();
				$result = $stmt->fetchAll();

				if (empty($result)) {
					echo "No messages";
				}
				else {
					foreach ($result as &$val) {
						$mId = $val["MessageId"];
						$sId = $val["UName"];
						$date = $val["Date"];
						$content = $val["Content"];
						// Build URL For each Button...
						$url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER[''] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Message-Details.php?id=' . $mId;
						// Create HTML...
						echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Sender:&nbsp' . $sId . '</p><p>Date:&nbsp' . $date . '&nbsp</p><p>Content:&nbsp' . $content . '&nbsp</p><a href="' . $url . '"><button class="btn btn-success">Get Details</button></a></div>';
					}
				}

				// GET USER GROUP MESSAGES
				$stmt = $d->conn->prepare(
					"select m.MessageId, mem2.UName, m.Date, m.Content 
					from comp353.Message m join comp353.Member mem2 on comp353.m.SenderId = comp353.mem2.UserId 
					join comp353.Member mem on comp353.m.ReceiverId = comp353.Member.Privilege
					where comp353.mem.UName like :u");
				$stmt->bindParam(':u', $u);
				$stmt->execute();
				$result = $stmt->fetchAll();

				if (!empty($result)) {
					foreach ($result as &$val) {
						$mId = $val["MessageId"];
						$sId = $val["UName"];
						$date = $val["Date"];
						$content = $val["Content"];
						// Build URL For each Button...
						$url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER[''] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . '/Message-Details.php?id=' . $mId;
						// Create HTML...
						echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Sender:&nbsp' . $sId . '</p><p>Date:&nbsp' . $date . '&nbsp</p><p>Content:&nbsp' . $content . '&nbsp</p><a href="' . $url . '"><button class="btn btn-success">Get Details</button></a></div>';
					}
				}
			}
		}

		GetMessages();
		?>

	</div>

</div>

<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include("../../include/Footer.php"); ?>


</body>
</html>
