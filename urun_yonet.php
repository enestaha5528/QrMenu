<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "qrmenu"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$message = '';
$messageType = '';

if (isset($_POST['ekle'])) {
    $urun_ad = trim($_POST['urun_ad']);
    $urun_fiyat = trim($_POST['urun_fiyat']);
    $urun_aciklama = trim($_POST['urun_aciklama']);
    $urun_kategori = trim($_POST['urun_kategori']);

    if (empty($urun_ad) || empty($urun_fiyat) || empty($urun_aciklama) || empty($urun_kategori)) {
        $message = "Lütfen tüm alanları doldurun.";
        $messageType = "error";
    } else {
        $urun_ekle_query = "INSERT INTO urunler (urun_ad, urun_fiyat, urun_aciklama, urun_kategori) VALUES ('$urun_ad', '$urun_fiyat', '$urun_aciklama', '$urun_kategori')";
        
        if ($conn->query($urun_ekle_query)) {
            $message = "Ürün başarıyla eklendi.";
            $messageType = "success";
        } else {
            $message = "Ürün eklerken hata: " . $conn->error;
            $messageType = "error";
        }
    }
}

if (isset($_POST['sil'])) {
    $urun_id = $_POST['urun_id'];
    $urun_sil_query = "DELETE FROM urunler WHERE id='$urun_id'";
    if ($conn->query($urun_sil_query)) {
        $message = "Ürün başarıyla silindi.";
        $messageType = "success";
    } else {
        $message = "Ürün silinirken hata: " . $conn->error;
        $messageType = "error";
    }
}

$urun_query = "SELECT * FROM urunler";
$urun_result = $conn->query($urun_query);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Ekle</title>
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Girassol&display=swap');
        body {
            font-family: "Girassol", serif;
            background-color: #222; 
            color: white; 
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 90%; 
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #444; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); 
            margin-top:100px;
        }
        h1, h2 {
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding-top: 10px;
            padding-bottom: 10px;
            border: 1px solid #666;
            border-radius: 4px;
            background-color: #555; 
            color: white; 
            resize: none;
        }
        button {
            background-color: #28a745; 
            color: white; 
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            display: block;
            width: 100%;
        }
        .sil-btn {
            background-color: #dc3545; 
            color: white; 
            border-radius: 4px;
            padding: 5px 10px;
            width: auto; 
            margin-left: 10px; 
        }
        .list-group {
            margin-top: 20px;
            padding: 0;
            list-style-type: none;
        }
        .list-group-item {
            background-color: #555; 
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            display: none; 
        }
        .alert.success {
            background-color: #28a745; 
            color: white; 
            display: block;
        }
        .alert.error {
            background-color: #dc3545; 
            color: white; 
            display: block;
        }
        .navbar{
            width: 100%;
            background-color: #333;
            display:flex;
            color:white;
        }
        a{
            text-decoration: none;
        }
        a>h1{
            color:white;
        }
        .admin{
            width: 50%;
            height:10vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .urun{
            width: 50%;
            height:10vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background-color:#2c2c2c;

        }
        .admin:hover{
            background-color:#2c2c2c;
        }
        .log{
            width: 50%;
            height:10vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .log:hover{
            background-color:#2c2c2c;
        }
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        @media only screen and (max-width: 767px) {
            a{
                font-size:10px
            }

        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="admin">
            <a href="admin.php"><h1>SIPARISLER</h1></a>
        </div>
        <div class="urun">
            <a href="urun_yonet.php"><h1>URUNLER</h1></a>
        </div>
        <div class="log">
            <a href="siparis_log.php"><h1>LOGLAR</h1></a>
        </div>
    </div>
    <div class="container">
        <h1>Ürün Ekle</h1>
        <form method="POST" onsubmit="return validateForm()">
            <label for="urun_ad">Ürün Adı:</label>
            <input type="text" name="urun_ad" id="urun_ad" required>

            <label for="urun_fiyat">Ürün Fiyatı:</label>
            <input type="number" name="urun_fiyat" id="urun_fiyat" required>

            <label for="urun_aciklama">Ürün Açıklaması:</label>
            <textarea name="urun_aciklama" id="urun_aciklama" rows="4" required></textarea>

            <label for="urun_kategori">Kategori:</label>
            <input type="text" name="urun_kategori" id="urun_kategori" required>

            <button type="submit" name="ekle">Ekle</button>
        </form>

        <h2>Mevcut Ürünler</h2>
        <ul class="list-group">
            <?php while ($urun = $urun_result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <?php echo $urun['urun_ad']; ?> - <?php echo $urun['urun_fiyat']; ?> TL  -<?php echo $urun['urun_kategori']; ?>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="urun_id" value="<?php echo $urun['id']; ?>">
                        <button type="submit" name="sil" class="sil-btn">Sil</button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <script>
        function validateForm() {
            const urunAd = document.getElementById('urun_ad').value.trim();
            const urunFiyat = document.getElementById('urun_fiyat').value.trim();
            const urunAciklama = document.getElementById('urun_aciklama').value.trim();
            const urunKategori = document.getElementById('urun_kategori').value.trim();

            if (!urunAd || !urunFiyat || !urunAciklama || !urunKategori) {
                alert('Lütfen tüm alanları doldurun.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>