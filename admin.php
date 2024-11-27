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

$sql = "SELECT * FROM siparisler ORDER BY masa_numarasi ASC";
$result = $conn->query($sql);

$siparisler = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $siparisler[$row['masa_numarasi']][] = $row;
    }
}

if (isset($_POST['siparis_tamamlandi'])) {
    $masa_numarasi = $_POST['masa_numarasi'];
    $sql = "DELETE FROM siparisler WHERE masa_numarasi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $masa_numarasi);
    $stmt->execute();
    $stmt->close();

    header("Location: admin.php");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/enes.png" type="image/x-icon" />
    <title>Admin Sayfası</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Girassol&display=swap');

        body {
            font-family: "Girassol", serif;
            margin: 0;
            padding: 20px;
            background-color: #222; 
            color: #f0f0f0; 
        }

        .admincont {
            padding: 30px;
            margin-top:100px;
            background-color: #333; 
            border-radius: 10px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5); 
        }

        h1, h2 {
            color: white; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #444; 
        }

        th, td {
            border: 1px solid white; 
            padding: 12px; 
            text-align: left;
        }

        th {
            color: white; 
        }

        .tamamla-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .tamamla-btn:hover {
            background-color: #218838;
        }

        .masa-numarasi {
            font-weight: bold;
            font-size: 22px;
            margin-top: 20px;
            margin-bottom:20px;
            color: white; 
        }

        .toplu-tamamla-btn {
            margin-top: 10px;
        }

        .total-sum {
            font-weight: bold;
            text-align: left;
            padding: 8px;
            background-color: #555; 
        }

        .navbar{
            width: 100%;
            background-color: #333;
            display:flex;
        }

        .admin{
            width: 50%;
            height:10vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background-color:#2c2c2c;
        }

        .urun{
            width: 50%;
            height:10vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .urun:hover{
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
        a{
            text-decoration:none;
        }

        @media only screen and (max-width: 767px){
            #siparisler{
                font-size:10px;
            }

            .admincont{
                padding:5px;
            }
            body{
                padding:0;
            }
            a{
                font-size:10px
            }
            table{
                font-size:10px;
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
    <div class="admincont">
        <h1>Tüm Siparişler</h1>
        <div id="siparisler"></div>
        <?php if (empty($siparisler)): ?>
            <p></p>
        <?php endif; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function getOrders() {
            var lastSiparisCount = 0; 
            var currentSiparisCount = 0;
            $.ajax({
                url: 'getOrders.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let siparislerHtml = '';
                    currentSiparisCount = 0;

                    $.each(response, function(masa_numarasi, siparisler_listesi) {
                        currentSiparisCount += siparisler_listesi.length;
                        siparislerHtml += '<div class="masa-numarasi">Masa Numarası: ' + masa_numarasi + '</div>';
                        siparislerHtml += '<table>';
                        siparislerHtml += '<tr><th>ID</th><th>Ürün Adı</th><th>Miktar</th><th>Fiyat (TL)</th><th>Toplam Fiyat (TL)</th><th>Tarih</th></tr>';
                        
                        let masa_toplam_fiyat = 0;
                        $.each(siparisler_listesi, function(index, siparis) {
                            const toplam_fiyat = siparis.urun_fiyat * siparis.miktar;
                            masa_toplam_fiyat += toplam_fiyat;
                            siparislerHtml += '<tr>';
                            siparislerHtml += '<td>' + siparis.id + '</td>';
                            siparislerHtml += '<td>' + siparis.urun_ad + '</td>';
                            siparislerHtml += '<td>' + siparis.miktar + '</td>';
                            siparislerHtml += '<td>' + siparis.urun_fiyat + ' TL</td>';
                            siparislerHtml += '<td>' + toplam_fiyat + ' TL</td>';
                            siparislerHtml += '<td>' + (siparis.created_at || 'Tarih mevcut değil') + '</td>';
                            siparislerHtml += '</tr>';
                        });
                        siparislerHtml += '<tr><td colspan="4" class="total-sum">Masa Toplamı: ' + masa_toplam_fiyat + ' TL</td></tr>';
                        siparislerHtml += '</table>';
                        siparislerHtml += '<form method="post" class="toplu-tamamla-btn">';
                        siparislerHtml += '<input type="hidden" name="masa_numarasi" value="' + masa_numarasi + '">';
                        siparislerHtml += '<button type="submit" name="siparis_tamamlandi" class="tamamla-btn">Bu Masadaki Tüm Siparişleri Tamamla</button>';
                        siparislerHtml += '</form>';
                    });

                    $('#siparisler').html(siparislerHtml || '<p>Sipariş bulunmamaktadır.</p>');
                    lastSiparisCount = currentSiparisCount;
                }
                
            });
        }   

        getOrders();
        setInterval(function() {
            getOrders();
        }, 10000);
    </script>
</body>
</html>