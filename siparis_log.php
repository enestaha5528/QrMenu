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
    exit();
}

$limit = 30; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$totalLogsQuery = "SELECT COUNT(*) FROM siparis_log";
$totalLogsStmt = $pdo->query($totalLogsQuery);
$totalLogs = $totalLogsStmt->fetchColumn();
$totalPages = ceil($totalLogs / $limit); 

$logQuery = "SELECT * FROM siparis_log ORDER BY siparis_tarihi DESC LIMIT :limit OFFSET :offset";
$logsStmt = $pdo->prepare($logQuery);
$logsStmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$logsStmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$logsStmt->execute();
$logs = $logsStmt->fetchAll(PDO::FETCH_ASSOC);

$masaSiparisQuery = "SELECT masa_numarasi, COUNT(*) AS siparis_sayisi FROM siparis_log GROUP BY masa_numarasi";
$masaSiparisStmt = $pdo->query($masaSiparisQuery);
$masaSiparisleri = $masaSiparisStmt->fetchAll(PDO::FETCH_ASSOC);

$enFazlaSiparisQuery = "SELECT masa_numarasi, COUNT(*) AS siparis_sayisi FROM siparis_log GROUP BY masa_numarasi ORDER BY siparis_sayisi DESC LIMIT 1";
$enFazlaSiparisStmt = $pdo->query($enFazlaSiparisQuery);
$enFazlaSiparis = $enFazlaSiparisStmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Logları</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Girassol&display=swap');
        body {
            font-family: "Girassol", sans-serif;
            background-color: #222; 
            color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
            color: #f0f0f0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .box {
            background-color: #333; 
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #444;
            padding: 10px;
        }

        th {
            background-color: #444;
            color: #f0f0f0;
        }

        td {
            color: #ddd;
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

        }
        .urun:hover{
            background-color:#2c2c2c;

        }
        .admin:hover{
            background-color:#2c2c2c;
        }
        .log{
            background-color:#2c2c2c;
            width: 50%;
            height:10vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        
        .log:hover{
            background-color:#2c2c2c;
        }
        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            margin: 0 5px;
            padding: 10px 15px;
            color: #f0f0f0;
            background-color: #333;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .pagination a:hover {
            background-color: #555;
        }

        .pagination .active {
            background-color: #444;
            font-weight: bold;
        }
        @media only screen and (max-width: 767px) {
            table, th, td {
                font-size: 0.9em;
            }
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
        <h1>Sipariş Logları</h1>

        <div class="box">
            <h2>En Fazla Sipariş Yapılan Masa</h2>
            <p><strong>Masa Numarası:</strong> <?php echo $enFazlaSiparis['masa_numarasi']; ?></p>
            <p><strong>Sipariş Sayısı:</strong> <?php echo $enFazlaSiparis['siparis_sayisi']; ?></p>
        </div>

        <div class="box">
            <h2>Masa Başına Toplam Sipariş Sayısı</h2>
            <table>
                <thead>
                    <tr>
                        <th>Masa Numarası</th>
                        <th>Sipariş Sayısı</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($masaSiparisleri as $masa): ?>
                        <tr>
                            <td><?php echo $masa['masa_numarasi']; ?></td>
                            <td><?php echo $masa['siparis_sayisi']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="box">
            <h2>Tüm Siparişler</h2>
            <table>
                <thead>
                    <tr>
                        <th>Masa Numarası</th>
                        <th>Ürün Adı</th>
                        <th>Fiyat</th>
                        <th>Miktar</th>
                        <th>Sipariş Tarihi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?php echo $log['masa_numarasi']; ?></td>
                            <td><?php echo $log['urun_ad']; ?></td>
                            <td><?php echo $log['urun_fiyat']; ?> TL</td>
                            <td><?php echo $log['miktar']; ?></td>
                            <td><?php echo $log['siparis_tarihi']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>