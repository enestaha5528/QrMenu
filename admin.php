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

$siparisler = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $siparisler[$row['masa_numarasi']][] = $row;
    }
}
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
            background-color: #333;
            color:white;
        }
        .admincont{
            padding: 30px;
            background-color:#1c1c1c;
        }
       
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            color: white;
        }
        .tamamla-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
           
           
            cursor: pointer;
        }
        .tamamla-btn:hover {
            background-color: #45a049;
        }
        .masa-numarasi {
            font-weight: bold;
            font-size: 20px;
            margin-top: 20px;
        }
        .toplu-tamamla-btn {
            margin-top: 10px;
        }
        .total-sum {
            font-weight: bold;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
<div class="admincont">
    <h1>Tüm Siparişler</h1>

    <?php foreach ($siparisler as $masa_numarasi => $siparisler_listesi): ?>
        <div class="masa-numarasi">Masa Numarası: <?php echo htmlspecialchars($masa_numarasi); ?></div>
        <table>
            <tr>
                <th>ID</th>
                <th>Ürün Adı</th>
                <th>Fiyat (TL)</th>
                <th>Miktar</th>
                <th>Toplam Fiyat (TL)</th>
                <th>Tarih</th>
            </tr>
            <?php 
            $masa_toplam_fiyat = 0;
            foreach ($siparisler_listesi as $siparis): 
                $toplam_fiyat = $siparis['urun_fiyat'] * $siparis['miktar'];
                $masa_toplam_fiyat += $toplam_fiyat;
            ?>
                <tr>
                    <td><?php echo $siparis['id']; ?></td>
                    <td><?php echo htmlspecialchars($siparis['urun_ad']); ?></td>
                    <td><?php echo htmlspecialchars($siparis['urun_fiyat']); ?> TL</td>
                    <td><?php echo htmlspecialchars($siparis['miktar']); ?></td>
                    <td><?php echo $toplam_fiyat; ?> TL</td>
                    <td><?php echo isset($siparis['created_at']) ? htmlspecialchars($siparis['created_at']) : 'Tarih mevcut değil'; ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4" class="total-sum">Masa Toplamı: <?php echo $masa_toplam_fiyat; ?> TL</td>
            </tr>
        </table>
        <form method="post" class="toplu-tamamla-btn">
            <input type="hidden" name="masa_numarasi" value="<?php echo $masa_numarasi; ?>">
            <button type="submit" name="siparis_tamamlandi" class="tamamla-btn">Bu Masadaki Tüm Siparişleri Tamamla</button>
        </form>
        <?php endforeach; ?>
        <?php if (empty($siparisler)): ?>
            <p>Sipariş bulunmamaktadır.</p>
        <?php endif; ?>
        <?php
        if (isset($_POST['siparis_tamamlandi'])) {
            $masa_numarasi = $_POST['masa_numarasi'];
            $sql = "DELETE FROM siparisler WHERE masa_numarasi = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $masa_numarasi);
            $stmt->execute();
            $stmt->close();

            header("Location: admin.php");
        }

        $conn->close();
        ?>
</div>



</body>
</html>