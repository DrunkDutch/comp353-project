<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
            padding: 5px;
        }

        th {text-align: left;}
    </style>
</head>
<body>

<?php
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/comp353-project/config/dbMakeConnection.php');

$status = Connected();
if($status == 1) return;

try{
    $d = new dbMakeConnection;
}

catch(PDOException $e){ echo($e);}

$u = $_SESSION['username'];
$stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UName = :u");
$stmt->bindParam(':u', $u);
$stmt->execute();
echo("OKuser");
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Email</th>
<th>DOB</th>
<th>Balance</th>
<th>Phone</th>
<th>Permit Number</th>
<th>Insurance Number</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['Age'] . "</td>";
    echo "<td>" . $row['Hometown'] . "</td>";
    echo "<td>" . $row['Job'] . "</td>";
    echo "</tr>";
}
echo "</table>";
//mysqli_close($con);
?>
</body>
</html>