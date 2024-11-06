-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 06 Kas 2024, 07:25:08
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
(486, 'Humus', 176.00, 1, '99999', '2024-11-04 11:53:16'),
(487, 'Muhammara', 150.00, 1, '99999', '2024-11-04 11:53:16');

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
(1, 'Humus', 176, 'Yoğun kıvamlı nohut püresi, tahin, sarımsak ve zeytinyağı ile hazırlanmış humus.', 'baslangic'),
(2, 'Muhammara', 150, 'Kırmızı biber, ceviz, sarımsak ve nar ekşisiyle yapılmış lezzetli bir acılı biber ezmesi.', 'baslangic'),
(3, 'Sigara Böreği', 170, 'İnce yufka içinde peynir, ıspanak veya kıyma ile hazırlanan nefis börekler.', 'baslangic'),
(4, 'İçli Köfte (5\'Li)', 200, 'İç harcıyla doldurulmuş, baharatlı bulgurun sarıldığı nefis içli köfteler.', 'arasicak'),
(5, 'Mücver', 100, 'Kabak, havuç ve patatesin rendelenip kızartılmasıyla yapılan hafif ve nefis mücver.', 'arasicak'),
(6, 'Paçanga Böreği', 125, 'Pastırma ve kaşar peyniri içeren ince yufka ile hazırlanan lezzetli bir börek.', 'arasicak'),
(7, 'İskender', 245, 'Döner etin üzerine sıcak tereyağı ve yoğurt sosu ile servis edilir.', 'anayemek'),
(8, 'Hünkar Beğendi', 830, 'Kuzu etiyle yapılmış güveçte, közlenmiş patlıcan püresi üzerine dökülen beşamel soslu bir yemek.', 'anayemek'),
(9, 'Ali Nazik Kebap', 445, 'Izgara patlıcan püresi ve yoğurt ile servis edilen tavuk veya kuzu tandır kebabı.', 'anayemek'),
(10, 'Baklava (300GR)', 250, 'Ceviz içi ve şerbetle tatlandırılmış ince baklava tabakları arasında nefis bir tatlı.', 'tatli'),
(11, 'Sütlaç(Fırında)', 195, 'Fırında pişirilmiş ve üzerine tarçın serpilmiş, geleneksel Türk sütlaç.', 'tatli'),
(12, 'Kazandibi', 195, 'Tavada karamelize edilmiş pirinç unu ve süt ile yapılan, üzerine tarçın serpilmiş lezzetli bir tatlı.', 'tatli'),
(39, 'Fattoush Salatası', 90, 'Taze marul, domates, salatalık ve kızarmış pita ekmeği ile yapılan ferahlatıcı bir salata.', 'baslangic'),
(40, 'Zeytinyağlı Enginar', 95, 'Enginar kalpleri, zeytinyağı ve limonla hazırlanmış hafif bir meze.', 'baslangic'),
(41, 'Kızartılmış Ahtapot (300Gr)', 400, 'Baharatlarla marine edilmiş ahtapotun kızartılarak servis edilmesi.', 'arasicak'),
(42, 'Kumpir', 300, 'Fırınlanmış patatesin içinin tereyağı, kaşar peyniri ve çeşitli malzemelerle doldurulması.', 'arasicak'),
(43, 'Tandır Kebabı', 1000, 'Yavaş pişirilmiş kuzu etinin tandırda hazırlanmasıyla yapılan lezzetli bir yemek.', 'anayemek'),
(44, 'Fırında Tavuk Kanat', 200, 'Özel baharatlarla marine edilmiş tavuk butlarının fırında pişirilmesi.', 'anayemek'),
(45, 'Aşure (250Gr)', 175, 'Buğday, nohut, fasulye ve kuru meyvelerle yapılan geleneksel bir Türk tatlısı.', 'tatli'),
(46, 'Tiramisu', 200, 'Kahve aromalı mascarpone kreması ve kedi dili bisküvisi ile hazırlanan İtalyan tatlısı.', 'tatli'),
(47, 'Çikolatalı Soufflé', 300, 'Sıcak çikolata dolgusuyla hazırlanan, dışı çıtır içi akışkan tatlı.', 'tatli'),
(48, 'Ayran', 20, 'Yoğurt, su ve tuz karıştırılarak yapılan serinletici bir içecek.', 'icecek'),
(49, 'Şalgam', 20, 'Fermente havuç suyu ile yapılan geleneksel bir içecek.', 'icecek'),
(50, 'Nar Suyu', 80, 'Taze sıkılmış narın suyu, zengin vitamin kaynağı.', 'icecek'),
(51, 'Taze Sıkılmış Portakal Suyu', 80, 'Günlük taze portakal sıkılarak hazırlanan doğal bir içecek.', 'icecek'),
(52, 'Türk Kahvesi', 60, 'Geleneksel Türk kahvesi, köpüklü ve yoğun bir tat.', 'icecek'),
(53, 'Çay', 10, 'Sıcak veya soğuk olarak sunulabilen, doğal çay.', 'icecek'),
(54, 'Patates Kızartması', 100, 'Kızartılmış altın rengi patates dilimleri.', 'atistirmalik'),
(55, 'Simit', 20, 'Susam ile kaplı geleneksel Türk simidi, kahvaltılara ve atıştırmalıklara mükemmel.', 'atistirmalik'),
(56, 'Hummuslu Sebzeler', 150, 'Taze sebzelerle birlikte sunulan yoğun kıvamlı humus.', 'atistirmalik'),
(57, 'Peynir Tabağı', 250, 'Çeşitli peynirlerden oluşan şık bir tabak, zeytin ve kuruyemişle birlikte.', 'atistirmalik'),
(58, 'Zeytin Tabağı', 100, 'Çeşitli zeytinlerden oluşan lezzetli bir tabak.', 'atistirmalik');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=491;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
