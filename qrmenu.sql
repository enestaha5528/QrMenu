-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 04 Eki 2024, 14:49:24
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `qrmenu`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `id` int(11) NOT NULL,
  `urun_ad` varchar(255) DEFAULT NULL,
  `urun_fiyat` decimal(10,2) DEFAULT NULL,
  `miktar` int(11) DEFAULT NULL,
  `masa_numarasi` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`id`, `urun_ad`, `urun_fiyat`, `miktar`, `masa_numarasi`, `created_at`) VALUES
(89, 'Humus', 100.00, 1, '3', '2024-10-04 12:11:30'),
(90, 'Sigara Böreği', 100.00, 3, '3', '2024-10-04 12:11:30'),
(91, 'İskender', 100.00, 1, '3', '2024-10-04 12:11:30');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `urun_ad` text NOT NULL,
  `urun_fiyat` int(11) NOT NULL,
  `urun_aciklama` text NOT NULL,
  `urun_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `urun_ad`, `urun_fiyat`, `urun_aciklama`, `urun_kategori`) VALUES
(1, 'Humus', 100, 'Yoğun kıvamlı nohut püresi, tahin, sarımsak ve zeytinyağı ile hazırlanmış humus.', 'baslangic'),
(2, 'Muhammara', 100, 'Kırmızı biber, ceviz, sarımsak ve nar ekşisiyle yapılmış lezzetli bir acılı biber ezmesi.', 'baslangic'),
(3, 'Sigara Böreği', 100, 'İnce yufka içinde peynir, ıspanak veya kıyma ile hazırlanan nefis börekler.', 'baslangic'),
(4, 'İçli Köfte', 100, 'İç harcıyla doldurulmuş, baharatlı bulgurun sarıldığı nefis içli köfteler.', 'arasicak'),
(5, 'Mücver', 100, 'Kabak, havuç ve patatesin rendelenip kızartılmasıyla yapılan hafif ve nefis mücver.', 'arasicak'),
(6, 'Paçanga Böreği', 100, 'Pastırma ve kaşar peyniri içeren ince yufka ile hazırlanan lezzetli bir börek.', 'arasicak'),
(7, 'İskender', 100, 'Döner etin üzerine sıcak tereyağı ve yoğurt sosu ile servis edilir.', 'anayemek'),
(8, 'Hünkar Beğendi', 100, 'Kuzu etiyle yapılmış güveçte, közlenmiş patlıcan püresi üzerine dökülen beşamel soslu bir yemek.', 'anayemek'),
(9, 'Ali Nazik Kebap', 100, 'Izgara patlıcan püresi ve yoğurt ile servis edilen tavuk veya kuzu tandır kebabı.', 'anayemek'),
(10, 'Baklava', 100, 'Ceviz içi ve şerbetle tatlandırılmış ince baklava tabakları arasında nefis bir tatlı.', 'tatli'),
(11, 'Sütlaç', 100, 'Fırında pişirilmiş ve üzerine tarçın serpilmiş, geleneksel Türk sütlaç.', 'tatli'),
(12, 'Kazandibi', 100, 'Tavada karamelize edilmiş pirinç unu ve süt ile yapılan, üzerine tarçın serpilmiş lezzetli bir tatlı.', 'tatli');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
