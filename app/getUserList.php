<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px lightgrey;
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
// get all users except yourself
$stmt = $d->conn->prepare("SELECT * FROM comp353.Member WHERE UName <> :u");
$stmt->bindParam(':u', $u);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<table>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Username</th>
</tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['FName'] . "</td>";
    echo "<td>" . $row['LName'] . "</td>";
    echo "<td>" . $row['UName'] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
</body>
</html>