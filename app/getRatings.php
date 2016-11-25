<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px lightgray;
            padding: 5px;
        }

        th {text-align: left;}
    </style>
</head>
<body>

<?php
include('../config/config.php');
include('../config/dbMakeConnection.php');

$status = Connected();
if($status != 1) return;

try{
    $d = new dbMakeConnection;
}

catch(PDOException $e){ echo($e);}

$u = $_SESSION['username'];
$stmt = $d->conn->prepare("SELECT UserId FROM comp353.Member WHERE UName = :u");
$stmt->bindParam(':u', $u);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$rateeId = $result['UserId'];

$stmt = $d->conn->prepare("SELECT max(Score) as High, min(Score) as Low, avg(Score) as Avg FROM comp353.Ratings WHERE RateeId = :r");
$stmt->bindParam(':r', $rateeId);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<table><tr><td>Highest Score</td>";
echo "<td>" . $result['High'] . "</td>";
echo "<tr>";

echo "<td>Average Score</td>";
echo "<td>" . $result['Avg'] . "</td>";
echo "</tr>";

echo "<td>Lowest Score</td>";
echo "<td>" . $result['Low'] . "</td>";
echo "</tr>";

echo "</table>";
?>
</body>
</html>
