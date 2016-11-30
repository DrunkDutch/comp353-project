<!DOCTYPE html>
<html>
<head>
    <?php  if (session_status() == PHP_SESSION_NONE) {
	 session_start();
	  
     }  ?>
	<title> Messages </title>
	<!-- This section is for the Head -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Head.php'); ?>
<style></style>
</head>
<body>
<!-- Page Content -->
<!-- This Section is for the Navigation file -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Header.php'); ?>
<!-- INCLUDE CONTENT OF PAGE HERE -->
<div id="page-content-wrapper">
	<h1>My Messages</h1>
	<a href="/comp353-project/public/view/main/Secured/SentMessages.php"><button class="btn btn-default">View Sent Messages</button></a>

	<!-- Trigger the modal with a button -->
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">New Message</button>


	<?php
	include ($_SERVER['DOCUMENT_ROOT'] ."/comp353-project/app/sendMessage.php");

	if(!empty($_GET['alert'])){
		echo '<div class="row" style="background-color:orange; height:100px;margin-top:50px;"><h4>'.$_GET['alert'].'</h4></div>';
	}

	?>
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
					<form action="../../../../app/sendMessage.php" method="POST">
						<div class="form-group">
							<label for="user">To:</label>
							<input type="text" class="form-control" name="user" id="user" placeholder="Enter Username" required="required">
						</div>
						<div class="form-group">
							<label for="message">Message:</label>
							<textarea class="form-control" rows="5" name="message" id="message" placeholder="Enter message" required="required"></textarea>
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
		GetMessages();
		function GetMessages() {
			include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

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
					from ".$GLOBALS['db_name'].".Message m join ".$GLOBALS['db_name'].".Member mem2 on ".$GLOBALS['db_name'].".m.SenderId = ".$GLOBALS['db_name'].".mem2.UserId 
					join ".$GLOBALS['db_name'].".Member mem on ".$GLOBALS['db_name'].".m.ReceiverId = ".$GLOBALS['db_name'].".mem.UserId 
					where ".$GLOBALS['db_name'].".mem.UName like :u");
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
						$url = 'https://tpc353_2.encs.concordia.ca/comp353-project/public/view/main/Secured/Message-Details.php?id=' . $mId;
						// Create HTML...
						echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Sender:&nbsp' . $sId . '</p><p>Date:&nbsp' . $date . '&nbsp</p><p>Content:&nbsp' . $content . '&nbsp</p><a href="' . $url . '"><button class="btn btn-success">Get Details</button></a></div>';
					}
				}

				// GET USER GROUP MESSAGES
				$stmt = $d->conn->prepare("select m.MessageId, mem2.UName, m.Date, m.Content from ".$GLOBALS['db_name'].".Message m join ".$GLOBALS['db_name'].".Member mem2 on ".$GLOBALS['db_name'].".m.SenderId = ".$GLOBALS['db_name'].".mem2.UserId join ".$GLOBALS['db_name'].".Member mem on ".$GLOBALS['db_name'].".m.ReceiverId =".$GLOBALS['db_name'].".mem.Privilege
where ".$GLOBALS['db_name'].".mem.UName like :u");
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
						$url = 'https://tpc353_2.encs.concordia.ca/comp353-project/public/view/main/Secured/Message-Details.php?id=' . $mId;
						// Create HTML...
						echo '<div class="row" style="height:150px;border-style:solid; border-width:3px;"><p style="margin-top:20px;">Sender:&nbsp' . $sId . '</p><p>Date:&nbsp' . $date . '&nbsp</p><p>Content:&nbsp' . $content . '&nbsp</p><a href="' . $url . '"><button class="btn btn-success">Get Details</button></a></div>';
					}
				}
			}
		}


		?>

	</div>

</div>

<!-- END OF CONTENT -->
<div><?php echo $this_page; ?></div>
<!-- This Section is for the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/public/view/include/Footer.php'); ?>
</body>

</html>
