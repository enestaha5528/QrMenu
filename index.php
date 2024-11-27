<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/enesbeyaz.png" type="image/x-icon" />
    <title>Menü</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        
      .sepete-git-btn{
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            background-color: transparent;
            color: white;
            border: 1px solid white;
            font-size: 17px;
            margin-top: 10px;
      }
      .sepete-git-bnt:active{
        background-color:white;
        color:#333 !important;
      }
    </style>
</head>
<body>
    <div class="menu-container">
        <div class="menu-header">
            <img src="img/enesbeyaz.png" alt="Logo" class="menu-logo">
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
            <?php
            $sql_categories = "SELECT DISTINCT urun_kategori FROM urunler";
            $categories_result = $conn->query($sql_categories);

            if ($categories_result->num_rows > 0) {
                while ($category_row = $categories_result->fetch_assoc()) {
                    $category = $category_row['urun_kategori'];
                    $category_uppercase = strtoupper(str_replace(['ç', 'ğ', 'ı', 'ö', 'ş', 'ü'], ['C', 'G', 'I', 'O', 'S', 'U'], $category));
                    echo "<div class='menu-category'><h2>$category_uppercase</h2>";

                    $sql_products = "SELECT urun_ad, urun_fiyat, urun_aciklama FROM urunler WHERE urun_kategori = '$category'";
                    $products_result = $conn->query($sql_products);

                    if ($products_result->num_rows > 0) {
                        while ($product_row = $products_result->fetch_assoc()) {
                            echo "<div class='menu-item'>
                                    <div class='menu-item-title'>
                                        <p>{$product_row['urun_ad']}</p>
                                        <p>{$product_row['urun_fiyat']} TL</p>
                                    </div>
                                    <span>{$product_row['urun_aciklama']}</span>
                                    <form action='sepet.php' method='POST'>
                                        <input type='hidden' name='urun_ad' value='{$product_row['urun_ad']}'>
                                        <input type='hidden' name='urun_fiyat' value='{$product_row['urun_fiyat']}'>
                                        <button type='submit'>Sepete Ekle</button>
                                    </form>
                                </div>";
                        }
                    } else {
                        echo "<p>$category_uppercase kategorisinde ürün bulunamadı.</p>";
                    }
                    echo "</div>"; 
                }
            } else {
                echo "<p>Kategori bulunamadı.</p>";
            }
            ?>
        </div>
            <div class="garsoncagir">
                <button class="sepete-git-btn" onclick="yonlendir()">Sepete Git</button>
            </div>
    </div>

    <script>
        function garsonCagir() {
            const masaNumarasi = prompt("Masa numaranızı giriniz:"); 
            if (masaNumarasi) {
                $.ajax({
                    url: 'garsonCagir.php',
                    type: 'POST',
                    data: { masa_numarasi: masaNumarasi },
                    success: function(response) {
                        alert('Garson çağrıldı!'); 
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                alert("Lütfen geçerli bir masa numarası giriniz.");
            }
        }
        function yonlendir() {
            window.location.href = 'sepet.php'; 
       }
    </script>
    <?php
    $conn->close();
    ?>
</body>
</html>
