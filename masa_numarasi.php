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

        $log_stmt = $pdo->prepare("INSERT INTO siparis_log (urun_ad, urun_fiyat, miktar, masa_numarasi) VALUES (:urun_ad, :urun_fiyat, :miktar, :masa_numarasi)");
        $log_stmt->execute([
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
            background-color: #222;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .masa-numarasi-container {
            background-color: #1c1c1c;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: white;
        }

        label {
            font-size: 1.2em;
            margin-bottom: 10px;
            display: block;
        }

        input[type="number"] {
            width: 94%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid white;
            background-color: #333;
            color: white;
            font-size: 1.1em;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #4CAF50;
            background-color: #444;
        }

        .gonder-btn {
            width: 100%;
            background-color: white;
            color: #333;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(255, 87, 34, 0.2);
        }

        .gonder-btn:hover {
            background-color: #333;
            color:white;
            box-shadow: 0 6px 12px rgba(186, 186, 186, 0.4);
        }
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        @media only screen and (max-width: 767px) {
            body {
                padding: 0;
            }
            .masa-numarasi-container {
                padding: 20px;
                width: 90%;
            }
            h1 {
                font-size: 2em;
            }
            .gonder-btn {
                padding: 10px;
                font-size: 1.1em;
            }
        }
    </style>
</head>
<body>

<div class="masa-numarasi-container">
    <h1>Masa Numarasını Girin</h1>
    <form method="post">
        <label for="masa_numarasi">Masa Numarası:</label>
        <input type="number" name="masa_numarasi" id="masa_numarasi" required>
        <button type="submit" class="gonder-btn">Gönder</button>
    </form>
</div>

</body>
</html>