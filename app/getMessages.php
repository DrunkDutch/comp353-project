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

        th {
            text-align: left;
        }
    </style>
</head>
<body>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/config.php');
include($_SERVER['DOCUMENT_ROOT'] . '/comp353-project/config/dbMakeConnection.php');

$status = Connected();
if ($status != 1) return;

try {
    $d = new dbMakeConnection;
} catch (PDOException $e) {
    echo($e);
}

$u = $_SESSION['username'];
$stmt = $d->conn->prepare(/* QUERY TO GET YOUR EMAILS */);
$stmt->bindParam(':u', $u);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<table>
<tr>
<th>Sender</th>
<th>Content</th>
<th>Date</th>
</tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['Sender'] . "</td>";
    echo "<td>" . $row['Content'] . "</td>"; // ToDo: change this to a link to reply
    echo "<td>" . $row['Date'] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
</body>
</html>