<?php
session_start(); 

$host = 'localhost'; 
$db   = 'qrmenu';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['masa_numarasi'])) {
    $masa_numarasi = $_POST['masa_numarasi'];
    
    foreach ($_SESSION['sepet'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO siparisler (urun_ad, urun_fiyat, miktar, masa_numarasi) VALUES (:urun_ad, :urun_fiyat, :miktar, :masa_numarasi)");
        $stmt->execute([
            ':urun_ad' => $item['ad'],
            ':urun_fiyat' => $item['fiyat'],
            ':miktar' => $item['miktar'],
            ':masa_numarasi' => $masa_numarasi,
        ]);
    }
    
    $_SESSION['sepet'] = [];
    
    echo "<script>alert('Siparişiniz başarıyla alındı!'); window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/enes.png" type="image/x-icon" />
    <title>Masa Numarası Girişi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Girassol&display=swap');
        body {
            font-family: "Girassol", serif;
            margin: 0;
            padding: 20px;
            background-color: #333;
            color:white;
        }
       
        .masa-numarasi-container {
            background-color: #1c1c1c;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .gonder-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .gonder-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="masa-numarasi-container">
    <h1>Masa Numarasını Girin</h1>
    <form method="post">
        <label for="masa_numarasi">Masa Numarası:</label>
        <input type="text" name="masa_numarasi" id="masa_numarasi" required>
        <button type="submit" class="gonder-btn">Gönder</button>
    </form>
</div>

</body>
</html>