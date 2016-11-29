<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 0;
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
if($status != 1) return;

try{
    $d = new dbMakeConnection;
}

catch(PDOException $e){ echo($e);}

$u = $_SESSION['username'];
$stmt = $d->conn->prepare("SELECT * FROM ".$GLOBALS['db_name'].".Member WHERE UName = :u");
$stmt->bindParam(':u', $u);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<table><tr><td>Firstname</td>";
echo "<td>" . $result['FName'] . "</td>";
echo "<tr>";

echo "<td>Lastname</td>";
echo "<td>" . $result['LName'] . "</td>";
echo "</tr>";

echo "<td>Email</td>";
echo "<td>" . $result['Email'] . "</td>";
echo "</tr>";

echo "<td>DOB</td>";
echo "<td>" . $result['DOB'] . "</td>";
echo "</tr>";

echo "<td>Balance</td>";
echo "<td>" . $result['Balance'] . "</td>";
echo "</tr>";

echo "<td>Phone</td>";
echo "<td>" . $result['Phone'] . "</td>";
echo "</tr>";

echo "<td>Permit Number</td>";
echo "<td>" . $result['Permit'] . "</td>";
echo "</tr>";

echo "<td>Insurance Number</td>";
echo "<td>" . $result['Insurance'] . "</td>";
echo "</tr>";

echo "</table>";
?>
</body>
</html>
