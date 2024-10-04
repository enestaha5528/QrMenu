<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/enes.png" type="image/x-icon" />
    <title>Menü</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="menu-container">
        <div class="menu-header">
            <img src="img/enes.png" alt="Logo" class="menu-logo">
            <h1>MENÜ</h1>
        </div>
        <?php
            $servername = "localhost"; 
            $username = "root"; 
            $password = ""; 
            $dbname = "qrmenu"; 

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Bağlantı hatası: " . $conn->connect_error);
            }
        ?>
        <div class="menu-section">
            <div class="menu-category">
                <h2>BAŞLANGIÇ</h2>
                <?php
                $sql = "SELECT urun_ad, urun_fiyat, urun_aciklama FROM urunler WHERE urun_kategori = 'baslangic'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='menu-item'>
                                <div class='menu-item-title'>
                                    <p>{$row['urun_ad']}</p>
                                    <p>{$row['urun_fiyat']} TL</p>
                                </div>
                                <span>{$row['urun_aciklama']}</span>
                                <form action='sepet.php' method='POST'>
                                    <input type='hidden' name='urun_ad' value='{$row['urun_ad']}'>
                                    <input type='hidden' name='urun_fiyat' value='{$row['urun_fiyat']}'>
                                    <button type='submit'>Sepete Ekle</button>
                                </form>
                              </div>";
                    }
                } else {
                    echo "<p>Başlangıç kategorisinde ürün bulunamadı.</p>";
                }
                ?>
            </div>

            <div class="menu-category">
                <h2>ARA SICAK</h2>
                <?php
                $sql = "SELECT urun_ad, urun_fiyat, urun_aciklama FROM urunler WHERE urun_kategori = 'arasicak'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='menu-item'>
                                <div class='menu-item-title'>
                                    <p>{$row['urun_ad']}</p>
                                    <p>{$row['urun_fiyat']} TL</p>
                                </div>
                                <span>{$row['urun_aciklama']}</span>
                                <form action='sepet.php' method='POST'>
                                    <input type='hidden' name='urun_ad' value='{$row['urun_ad']}'>
                                    <input type='hidden' name='urun_fiyat' value='{$row['urun_fiyat']}'>
                                    <button type='submit'>Sepete Ekle</button>
                                </form>
                              </div>";
                    }
                } else {
                    echo "<p>Ara Sıcak kategorisinde ürün bulunamadı.</p>";
                }
                ?>
            </div>

            <div class="menu-category">
                <h2>ANA YEMEK</h2>
                <?php
                $sql = "SELECT urun_ad, urun_fiyat, urun_aciklama FROM urunler WHERE urun_kategori = 'anayemek'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='menu-item'>
                                <div class='menu-item-title'>
                                    <p>{$row['urun_ad']}</p>
                                    <p>{$row['urun_fiyat']} TL</p>
                                </div>
                                <span>{$row['urun_aciklama']}</span>
                                <form action='sepet.php' method='POST'>
                                    <input type='hidden' name='urun_ad' value='{$row['urun_ad']}'>
                                    <input type='hidden' name='urun_fiyat' value='{$row['urun_fiyat']}'>
                                    <button type='submit'>Sepete Ekle</button>
                                </form>
                              </div>";
                    }
                } else {
                    echo "<p>Ana Yemek kategorisinde ürün bulunamadı.</p>";
                }
                ?>
            </div>

            <div class="menu-category">
                <h2>TATLI</h2>
                <?php
                $sql = "SELECT urun_ad, urun_fiyat, urun_aciklama FROM urunler WHERE urun_kategori = 'tatli'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='menu-item'>
                                <div class='menu-item-title'>
                                    <p>{$row['urun_ad']}</p>
                                    <p>{$row['urun_fiyat']} TL</p>
                                </div>
                                <span>{$row['urun_aciklama']}</span>
                                <form action='sepet.php' method='POST'>
                                    <input type='hidden' name='urun_ad' value='{$row['urun_ad']}'>
                                    <input type='hidden' name='urun_fiyat' value='{$row['urun_fiyat']}'>
                                    <button type='submit'>Sepete Ekle</button>
                                </form>
                              </div>";
                    }
                } else {
                    echo "<p>Tatlı kategorisinde ürün bulunamadı.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>