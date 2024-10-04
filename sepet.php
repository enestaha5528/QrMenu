<?php
session_start();

if (!isset($_SESSION['sepet'])) {
    $_SESSION['sepet'] = []; 
}

if (isset($_POST['urun_ad']) && isset($_POST['urun_fiyat'])) {
    $urun = [
        'ad' => $_POST['urun_ad'],
        'fiyat' => (float)$_POST['urun_fiyat'],
        'miktar' => 1, 
    ];

    $_SESSION['sepet'][] = $urun;
}

if (isset($_POST['sepeti_bosalt'])) {
    $_SESSION['sepet'] = []; 
}

if (isset($_POST['action']) && isset($_POST['index'])) {
    $index = (int)$_POST['index'];
    if ($_POST['action'] == 'arttir') {
        $_SESSION['sepet'][$index]['miktar']++;
    } elseif ($_POST['action'] == 'azalt' && $_SESSION['sepet'][$index]['miktar'] > 1) {
        $_SESSION['sepet'][$index]['miktar']--; 
    }
}

if (isset($_POST['sil']) && isset($_POST['index'])) {
    $index = (int)$_POST['index'];
    array_splice($_SESSION['sepet'], $index, 1);
}

if (isset($_POST['siparisi_onayla'])) {
    header('Location: masa_numarasi.php');
    exit();
}
if (isset($_POST['menudon'])) {
    header('Location: index.php');
    exit(); 
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/enes.png" type="image/x-icon" />

    <title>Sepet</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Girassol&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Girassol", serif;
        }
        body{
            background-color: #333;
            color:white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
       
        .sepet-container {
            background-color: #1c1c1c;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            width: 80%;
        }
        .sepet-item {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .sepet-item:last-child {
            border-bottom: none;
        }
        .bosalt-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .bosalt-btn:hover {
            background-color: #ff1a1a;
        }
        .siparis-onayla {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .siparis-onayla:hover {
            background-color: #45a049;
        }
        .menu-don{
            background-color:#333;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .menu-don:hover {
            background-color: #282727;
        }
        .miktar-btn {
            border: none;
            background: none;
            cursor: pointer;
            margin: 0 10px;
            color:white;
        }
        .sil-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .sil-btn:hover {
            background-color: #ff1a1a;
        }
    </style>
</head>
<body>

<div class="sepet-container">
    <h1>Sepetiniz</h1>
    <?php if (count($_SESSION['sepet']) > 0): ?>
        <form method="post">
            <?php 
            $toplam_fiyat = 0;
            foreach ($_SESSION['sepet'] as $index => $item): 
                $toplam_fiyat += $item['fiyat'] * $item['miktar'];
            ?>
                <div class="sepet-item">
                    <p><?php echo htmlspecialchars($item['ad']); ?></p>
                    <p><?php echo htmlspecialchars($item['fiyat']); ?> TL</p>
                    <div>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="hidden" name="action" value="azalt">
                            <button type="submit" class="miktar-btn">-</button>
                        </form>
                        <span><?php echo $item['miktar']; ?></span>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="hidden" name="action" value="arttir">
                            <button type="submit" class="miktar-btn">+</button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit" name="sil" class="sil-btn">Sil</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="sepet-item">
                <strong>Toplam: <?php echo $toplam_fiyat; ?> TL</strong>
            </div>
            <form method="post" style="margin-top: 20px;">
                <button type="submit" name="sepeti_bosalt" class="bosalt-btn">Sepeti Boşalt</button>
                <button type="submit" name="siparisi_onayla" class="siparis-onayla">Siparişi Onayla</button>
                <button type="submit" name="menudon" class="menu-don">Menüye Geri Dön</button>

            </form>
        </form>
    <?php else: ?>
        <p>Sepetinizde ürün bulunmamaktadır.</p>
    <?php endif; ?>
</div>

</body>
</html>