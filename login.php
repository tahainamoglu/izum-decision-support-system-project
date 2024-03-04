<?php
@session_start();

// Veritabanı bağlantısı
$servername = "localhost"; // Sunucu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifre
$database = "db"; // Veritabanı adı

$conn = new mysqli($servername, $username, $password, $database);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan kullanıcı adı ve şifreyi al
    $kullaniciAdi = $_POST["kullaniciAdi"];
    $sifre = $_POST["sifre"];

    // Temel doğrulamayı gerçekleştir
    if (!empty($kullaniciAdi) && !empty($sifre)) {
        // Veritabanında kullanıcı adı ve şifreyi kontrol et
        $query = "SELECT * FROM kullanici WHERE kullaniciAdi = ? AND sifre = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $kullaniciAdi, $sifre);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION["loggedin"] = true;
            header("Location: ana.php");
            exit;
        } else {
            $hata_mesaji = "Geçersiz kullanıcı adı veya şifre";
        }
    } else {
        $hata_mesaji = "Lütfen hem kullanıcı adını hem de şifreyi girin";
    }
}
!
// Veritabanı bağlantısını kapat
$conn->close();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" href="login.css" type="text/css">
<style>
    

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding-left:40px;
  border-left-width: 10%;
  margin: auto;
  margin-top:260px;
  width: 20%;
  height: 200px;
  border: 3px white;
  padding: 5px;
  background: rgba(0, 0, 0, 0.3);
  opacity: 1;
  
}
</style>
<body>
    


<div class="container">

        <form method="post" action="">
            <?php if (isset($hata_mesaji)) : ?>
                <p style="color: red;"><?php echo $hata_mesaji; ?></p>
            <?php endif; ?>
            <label for="kullaniciAdi">KULLANICI ADI:</label>
            <input type="text" id="kullaniciAdi" name="kullaniciAdi" placeholder="Kullanıcı Adı.." required>
            <br></br>

            <label for="sifre">ŞİFRE:</label>
            <input type="password" id="sifre" name="sifre" placeholder="Şifrenizi Giriniz.." required>
            <br></br>

            <input type="submit" value="Giriş">
        </form>
    </div>
    </body>
    </head>
    </html>
