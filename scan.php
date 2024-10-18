<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');

$jsonFile = 'config.json';
$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);


if (isset($_GET["action"])) {
    if ($_GET["action"] == "start") {
        if(file_exists(".last")){
         exit();
        }
        exec("screen -dmS myscreen php backend.php");
        echo "Tarama işlemi başladı.";
        unlink(".lastpost");
        exit();
    } elseif ($_GET["action"] == "log") {

        $logFile = 'phishing.log'; // Log dosyasının yolu
        $positionFile = '.lastpost'; // Son konum dosyasının yolu

        // Son konumu saklamak için .lastpost dosyasını oku
        if (!file_exists($positionFile)) {
            file_put_contents($positionFile, '0'); // Eğer dosya yoksa, 0 olarak oluştur
        }

        // Son konumu oku
        $last_pos = (int)file_get_contents($positionFile);

        // Log dosyasını oku
        if (file_exists($logFile)) {
            $current = file_get_contents($logFile);
            $currentLines = explode("\n", $current);
            // Son konuma göre yeni satırları al
            $newLines = array_slice($currentLines, $last_pos);

            // Yeni konumu güncelle
            $new_pos = count($currentLines); // Yeni son pozisyon
            file_put_contents($positionFile, $new_pos); // Güncellenmiş pozisyonu .lastpost dosyasına yaz

            // Yeni satırları döndür
            if (count($newLines) > 0) {
                // Boş satırları temizle
                $newLines = array_filter($newLines);
                echo implode("\n", $newLines);
            } else {
                echo ""; // Hiç yeni satır yoksa boş döndür
            }
        } else {
            echo "Log dosyası bulunamadı.";
        }
        exit();
    }elseif ($_GET["action"] == "getScore") {
        header('Content-Type: application/json');
        echo file_get_contents("user_scores.json");
        exit();

    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $wordlist = isset($_POST['wordlist']) ? $_POST['wordlist'] : [];
    $extention = isset($_POST['extention']) ? $_POST['extention'] : [];

    // Yeni JSON yapısını oluştur
    $newData = [
        'wordlist' => explode("\n", trim($wordlist)),
        'extention' => explode("\n", trim($extention))
    ];

    // JSON dosyasını güncelle
    file_put_contents($jsonFile, json_encode($newData, JSON_PRETTY_PRINT));

    // Değişikliklerin görünmesi için sayfayı yenile
    header('Location: scan.php');
    exit;
}


?>

<?php
require_once('/usr/local/cpanel/php/WHM.php');
WHM::header('Phising Scanner', 0, 0);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phishing Scanner</title>

    <link rel="stylesheet" href="style.css">
    <script>
    let updateInterval; // Güncelleme aralığını tutacak değişken

    function startScan() {
        document.getElementById('results').style.display = '';
        document.getElementById('tables').style.display = 'none';
        document.getElementById('log').innerHTML = 'Tarama yapılıyor...';
        fetch('scan.php?action=start')
            .then(response => response.text())
            .then(message => {
                document.getElementById('log').innerHTML = message;
                startUpdatingLog(); // Tarama başlatıldıktan sonra log'u güncelle
            })
            .catch(error => {
                document.getElementById('log').innerHTML = 'Hata: ' + error;
            });
    }

    function getScore() {
        document.getElementById('results').style.display = 'none';
        document.getElementById('tables').style.display = '';

        fetch('scan.php?action=getScore')
            .then(response => response.json()) // Yanıtı JSON olarak al
            .then(data => {
                // Verileri sıralamak için entries haline getirip sayılara göre sıralayalım
                let sortedData = Object.entries(data).sort((a, b) => b[1] - a[
                1]); // Sayılara göre büyükten küçüğe sırala

                // Tablo gövdesini (tbody) temizle
                const tbody = document.getElementById('scoreBody');
                tbody.innerHTML = ''; // Önceki içeriği temizle

                // Verileri tabloya ekle
                sortedData.forEach(([key, value]) => {
                    let row = `<tr>
                                    <td>${key}</td>
                                    <td>${value}</td>
                                  </tr>`;
                    tbody.innerHTML += row;
                });
            })
            .catch(error => {
                // Hata olursa ekrana bas
                alert('Hata: ' + error);
            });
    }

    function startUpdatingLog() {
        updateLog(); // İlk güncellemeyi hemen yap
        updateInterval = setInterval(updateLog, 2000); // Her 2 saniyede bir log'u güncelle
    }

    function stopUpdatingLog() {
        clearInterval(updateInterval); // Güncellemeyi durdur
    }

    function updateLog() {
        fetch('scan.php?action=log') // Log dosyasını okuyan PHP dosyası
            .then(response => response.text()) // Düz metin olarak al
            .then(data => {
                if (data.trim() !== "") { // Boş değilse yazdır
                    const resultsDiv = document.getElementById('results');
                    resultsDiv.innerText += data + "\n"; // Yeni satırları ekle
                    resultsDiv.scrollTop = resultsDiv.scrollHeight; // Aşağı kaydır
                }
            })
            .catch(error => {
                console.error('Hata:', error);
            });
    }

    function updateConfig() {
        document.getElementById('results').style.display = 'none';
        document.getElementById('tables').style.display = 'none';
        document.getElementById('edit').style.display = '';
    }

    // Sayfa kapatıldığında veya diğer butonlara basıldığında güncellemeyi durdur
    window.addEventListener('beforeunload', stopUpdatingLog);
    </script>
</head>

<body>
    <h1>Phishing Scanner</h1>
    <button class="btn btn-warning btn-lg" onClick="window.location.reload();">Anasayfa</button>
    <button class="btn btn-primary btn-lg" onclick="startScan()">Tarama Başlat</button>
    <button class="btn btn-info btn-lg" onclick="getScore()">Tarama Skorları</button>
    <button class="btn btn-success btn-lg" onclick="updateConfig()">Yapılandırma</button>

    <br> <br>
    <a href="https://nosayazilim.com.tr/"><img src="https://nosayazilim.com.tr/images/logo_dark.png"
            style="float:right;margin:10px;"></a>
    <div id="log"></div>
    <pre id="results" style="max-height: 400px; overflow-y: scroll;width:100%;"></pre>

    <!-- Statik tablo yapısı, sadece tbody kısmını dinamik olarak dolduracağız -->
    <table id="tables" style="display:none;" class="table table-striped nonsortable dataTable no-footer">
        <thead>
            <tr>
                <th>Kullanıcı</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody id="scoreBody">
            <!-- Veriler buraya eklenecek -->
        </tbody>
    </table>

    <form method="POST" action="scan.php" style="display:none;" id="edit">
        <h3>Taranacak Kelimeler</h3>
        <textarea class="form-control" name="wordlist" class="form-control" rows="10"
            cols="30"><?php echo implode("\n", $data['wordlist']); ?></textarea>

        <h3>Taranacak Uzantılar</h3>
        <textarea class="form-control" name="extention" rows="5"
            cols="30"><?php echo implode("\n", $data['extention']); ?></textarea>

        <br><br>
        <button class="btn btn-info btn-success" type="submit">Değişiklikleri kaydet</button>
    </form>
    <div class="copyright-text text-center" bis_skin_checked="1">
        Copyright © 2024 <a href="https://nosayazilim.com.tr/">Nosa Yazılım</a> Tüm Hakları Saklıdır.
    </div>

</body>

</html>

<?php
WHM::footer();
?>
