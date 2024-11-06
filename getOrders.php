<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qrmenu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$sql = "SELECT * FROM siparisler ORDER BY masa_numarasi ASC";
$result = $conn->query($sql);

if (!$result) {
    die("Sorgu hatası: " . $conn->error);
}

$siparisler = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $siparisler[$row['masa_numarasi']][] = $row;
    }
} else {
    echo json_encode([]);
    exit();  
}

echo json_encode($siparisler);
$conn->close();
?>