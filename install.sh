#!/bin/bash

TARGET_DIR="/usr/local/cpanel/whostmgr/docroot/cgi/phising_scanner"
mkdir -p "$TARGET_DIR"

FILES=(
    "https://raw.githubusercontent.com/mertkaracali/phising-scanner/refs/heads/main/app.conf"
    "https://raw.githubusercontent.com/mertkaracali/phising-scanner/refs/heads/main/backend.php"
    "https://raw.githubusercontent.com/mertkaracali/phising-scanner/refs/heads/main/config.json"
    "https://raw.githubusercontent.com/mertkaracali/phising-scanner/refs/heads/main/scan.php"
    "https://raw.githubusercontent.com/mertkaracali/phising-scanner/refs/heads/main/user_scores.json"
)

# Her bir dosyayı hedef klasöre indir
for file in "${FILES[@]}"; do
    wget -q "$file" -P "$TARGET_DIR"
done

/usr/local/cpanel/bin/register_appconfig /usr/local/cpanel/whostmgr/docroot/cgi/phising_scanner/app.conf
