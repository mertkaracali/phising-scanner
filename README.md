# phising-scanner
WHM / cPanel Phishing Scanner

Kurulum adımları:
Terminal (SSH) üzerine aşağıdaki komutları girerek phising scanner kurabilirsiniz.

bash <(curl https://raw.githubusercontent.com/mertkaracali/phising-scanner/refs/heads/main/install.sh)


WHM / cPanel Phishing Scanner: Web Sunucularını Güvenli Tutmak İçin Etkili Bir Araç

Web hosting hizmeti sunanların karşılaştığı en büyük sorunlardan biri, phishing (oltalama) saldırılarıdır. Phishing saldırıları, saldırganların kullanıcıların hassas bilgilerini ele geçirmek amacıyla yanıltıcı web siteleri ve e-postalar oluşturmalarıyla gerçekleşir. Özellikle popüler web sunucuları, bu tür saldırılar için cazip hedeflerdir. Bu noktada, WHM (Web Host Manager) ve cPanel gibi hosting yönetim platformları, güvenlik çözümleri sunarak bu tehditlere karşı kullanıcılarını korumaya çalışır. WHM Phishing Scanner, bu çözümlerden biridir.

WHM Phishing Scanner Nedir?
WHM Phishing Scanner, sunucularınızı phishing amaçlı içeriklerden korumak için kullanılan bir güvenlik aracıdır. Bu araç, sunucunuzda yer alan dosyaları ve web sitelerini tarayarak şüpheli içerikleri tespit eder ve bunları temizlemenize yardımcı olur. Birçok web hosting sağlayıcısı, bu aracı kullanarak müşterilerinin sitelerindeki güvenliği sağlamakta ve kullanıcı bilgilerini güvende tutmaktadır.

Phishing Scanner Nasıl Çalışır?
WHM Phishing Scanner, sunucudaki dosyaları ve dizinleri düzenli olarak tarar. Tarama işlemi sırasında, bilinen phishing şablonlarını, kötü amaçlı kodları veya zararlı JavaScript kodlarını analiz eder. Araç, tarama sırasında şüpheli aktiviteleri algıladığında, kullanıcıya bir bildirim gönderir ve potansiyel tehditler hakkında bilgi verir.

Phishing Scanner'ın çalışma adımları şunlardır:

Düzenli Tarama: Sunucudaki her bir site ve dosya taranır. Bu taramalar, manuel olarak başlatılabileceği gibi, zamanlanmış görevler ile düzenli hale getirilebilir.

Şüpheli İçerik Analizi: Tarama esnasında, WHM Phishing Scanner şüpheli e-posta formları, yanıltıcı giriş sayfaları ve kötü amaçlı komut dosyalarını arar.

Raporlama: Tespit edilen her türlü şüpheli içerik, ayrıntılı bir raporla sunucu yöneticisine bildirilir. Bu raporlar, tespit edilen tehditlerin hangi dizinlerde olduğunu, hangi dosyaların şüpheli olduğunu belirtir.

Temizleme Seçenekleri: Araç, tespit edilen dosyaların nasıl ele alınacağını belirler. Şüpheli dosyaları karantinaya almak, tamamen silmek veya incelemek için ayırmak gibi seçenekler sunar.

Phishing Scanner'ın Faydaları
Güvenlik Artışı: Phishing Scanner, sunucunuzdaki potansiyel phishing tehditlerini tespit ederek, sunucu güvenliğini artırır.
Kullanıcı Verilerinin Korunması: Kullanıcıların kişisel bilgilerini çalmayı amaçlayan kötü niyetli sitelerden korunmasını sağlar.
Müşteri Güvenini Artırma: Hosting hizmeti sunanlar için müşteri güveni çok önemlidir. Phishing Scanner ile güvenli bir hizmet sunduğunuzu gösterebilir ve kullanıcı memnuniyetini artırabilirsiniz.
Zaman Tasarrufu: Manuel olarak dosyaları kontrol etmek oldukça zaman alıcı olabilir. Phishing Scanner, bu işlemi otomatik hale getirerek zamandan tasarruf sağlar.
WHM Phishing Scanner'ın Özellikleri
Otomatik Tarama: Zamanlanmış taramalar ile phishing içerikleri düzenli olarak kontrol edilir.
Kapsamlı Raporlama: Tarama sonucunda, hangi dosyaların şüpheli olduğu ayrıntılı bir şekilde raporlanır.
Kolay Yönetim: Kullanıcı dostu arayüzü sayesinde sunucu yöneticileri kolayca tehditleri tespit edebilir ve yönetebilir.
Kapsamlı Tespit: Bilinen phishing tekniklerinin yanı sıra yeni saldırı yöntemlerine karşı da güncellenen bir tehdit veri tabanına sahiptir.
Phishing Saldırılarına Karşı Alınabilecek Diğer Önlemler
Phishing Scanner'ın kullanımı oldukça etkili bir güvenlik çözümü olsa da, tek başına yeterli olmayabilir. İşte phishing saldırılarına karşı alabileceğiniz ek önlemler:

SSL/TLS Sertifikası Kullanmak: SSL sertifikası, kullanıcı ve sunucu arasındaki veri akışını şifreleyerek verilerin korunmasını sağlar.
Güncellemeleri İzlemek: cPanel ve diğer yazılımlarınızı düzenli olarak güncellemek, bilinen güvenlik açıklarını kapatmanızı sağlar.
Kullanıcı Eğitimleri: Müşterilerinizi phishing saldırılarına karşı bilinçlendirmek, saldırılara karşı farkındalığı artırır.
Web Uygulama Güvenlik Duvarı (WAF) Kullanmak: WAF, sunucunuzdaki potansiyel tehditleri algılayarak koruma sağlar.
