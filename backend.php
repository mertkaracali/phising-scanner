<?php
file_put_contents(".last",strtotime(date("d-m-Y H:i:s")));
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);

//$wordlist = ["instagram login", "blue tick", "instagram verify","instagram"];
//$extention = ["php", "html"];

$jsonData = file_get_contents('config.json');
$data = json_decode($jsonData, true);
$wordlist = $data['wordlist'];
$extention = $data['extention'];

$results = [];


function ext1($file) {
    return substr(strrchr($file, '.'), 1);
}

function find_phishing($file, $username) {
    global $wordlist, $extention, $results;

    if (in_array(ext1($file), $extention)) {
        $fileContents = file_get_contents($file);
        foreach ($wordlist as $element) {
            if (strstr($fileContents, $element)) {
                // Kullanıcı skorunu arttır
                if (!isset($results[$username])) {
                    $results[$username] = 0;
                }
                $results[$username] += 10; // Bulunan her öğe için skoru arttır
                file_put_contents("phishing.log", "Phishing : Element : $element : $file \n", FILE_APPEND);
            }
        }
    } else {
        file_put_contents("phishing.log", "Dosya atlama : $file \n", FILE_APPEND);
    }
}

function isdirector($file) {
    $username = explode('/', $file)[2]; // Kullanıcı adını dizinden al
    if (is_dir($file)) {
        file_put_contents("phishing.log", "Klasör : $file \n", FILE_APPEND);
        foreach (glob($file . "/*") as $fi) {
            isdirector($fi);
        }
    } else {
        file_put_contents("phishing.log", "Dosya : $file \n", FILE_APPEND);
        find_phishing($file, $username);
    }
}

// Dosya taraması yap
$dirsToScan = glob('/home/*/public_html/*') ?: glob('/vhosts/*/httpdocs/*');
foreach ($dirsToScan as $file) {
    isdirector($file);
}

// Skorları JSON olarak kaydet
file_put_contents("user_scores.json", json_encode($results, JSON_PRETTY_PRINT));
unlink(".last");
?>
