<?php
include 'baglanti2.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Veritabanına bağlanılamadı: " . $con->connect_error);
}
$con->set_charset("utf8");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>İzum Konumlandırma Sistemi</title>
    <style>
        /* Diğer stiller buraya gelecek */

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e6e6e6;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 1em;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 1em;
            height: auto;
            position: relative;
        }

        nav img {
            width: 160px;
            height: auto;
        }

        .menu-item {
            position: relative;
            margin: 0 100px 0 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 1em;
            border-bottom: 1px solid #555;
            transition: 0.3s ease;
            cursor: pointer;
        }

        nav a:hover {
            background-color:white;
            
            
        }

        .submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #000;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 3;
            width: 100%;
        }

        .submenu a {
            color: white;
            padding: 12px 16px;
            display: block;
            text-decoration: none;
            border-bottom: 1px solid #555;
            transition: background-color 0.3s ease;
            cursor: pointer;
            text-align: left;
        }

        .submenu a:hover {
            background-color: green;
        }

        section {
            width: 80%;
            padding: 1em;
            margin: 0 auto;
            text-align: center; /* Bu satır eklendi */
        }

        h1 {
            color: #333;
        }
        h2 {
            color: white;
        }
        .container {
        border: 2px solid #4CAF50; /* Tablonun border rengi (yeşil tonu) */
        border-radius: 10px; /* Tablonun kenar yumuşaklığı */
        padding: 20px;
        background-color: black; /* Tablonun arkaplan rengi (siyah) */
    }

    .table {
        color: white; /* Tablonun metin rengi (beyaz) */
    }

    .table th, .table td {
        border: 1px solid #4CAF50; /* Hücre sınırlarının rengi (yeşil tonu) */
    }

    .btn {
        background-color: #4CAF50; /* Buton rengi (yeşil tonu) */
        color: white;
        margin: 5px;
    }

    .btn:hover {
        background-color: white; /* Buton hover rengi */
        color: #4CAF50;
    }
    </style>
</head>
<body>

<header>
    <h1>İzum Çekici Konumlandırma Sistemi</h1>
</header>

<nav>
    <div class="logo">
        <img src="images.jpeg" alt="Logo" width="160px" height="auto">
    </div>

    <div class="menu-item">
        <a href="ana.php" class="w3-bar-item w3-red w3-button">Anasayfa</a>
    </div>

    <div class="menu-item" onmouseover="toggleSubMenu('demoAcc')" onmouseout="toggleSubMenu('demoAcc')">
        <a class="w3-bar-item w3-red w3-button">Çekiciler</a>
        <div id="demoAcc" class="submenu w3-grey w3-card">
            <a href="konum.php" class="w3-bar-item w3-button">Çekici Grafiği</a>
            <a href="ekle.php" class="w3-bar-item w3-button">Çekici Ekle</a>
        </div>
    </div>

    <div class="menu-item" onmouseover="toggleSubMenu('demoDrop')" onmouseout="toggleSubMenu('demoDrop')">
        <a class="w3-bar-item w3-red w3-button">Müdahale</a>
        <div id="demoDrop" class="submenu w3-grey w3-card">
            <a href="mud_bil.php" class="w3-bar-item w3-button">Müdahale Bilgileri</a>
            <a href="mud_gra.php" class="w3-bar-item w3-button">Müdahale Grafikleri</a>
            <a href="ekle2.php" class="w3-bar-item w3-button">Müdahale Ekle</a>
        </div>
    </div>

    <div class="menu-item">
        <a href="tavsiye.php" class="w3-bar-item w3-red w3-button">Tavsiye</a>
    </div>

    <div class="menu-item">
        <a href="login.php" class="w3-bar-item w3-red w3-button">Çıkış</a>
    </div>
</nav>
<section>
    <!-- Buraya sayfanızın geri kalan içeriği gelecek -->
</section>

<script>
    function toggleSubMenu(id) {
        var submenu = document.getElementById(id);
        submenu.style.display = submenu.style.display === "block" ? "none" : "block";
    }
</script>
<?php
// Veritabanı bağlantısı
include "baglanti2.php";

// Bağlantı kontrolü
if ($con->connect_error) {
    die("Bağlantı hatası: " . $con->connect_error);
}

// Verileri çekme
$sql = "select cekici.cekici_id,cekici.cekici_ad,ilce.ilce_ad
FROM cekici,ilce
WHERE cekici.ilce_id=ilce.ilce_id";  // Tablo adınızı buraya ekleyin
$result = $con->query($sql);

?>

<section>
    <!-- Buraya sayfanızın geri kalan içeriği gelecek -->
    <div class="container mt-5 border border-3-danger">
        <h2>Çekici Tablosu</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Çekici Ad</th>
                    <th>İlce Ad</th>
                    <!-- Ek alanlarınızı buraya ekleyebilirsiniz -->
                </tr>
                </thead>
                <tbody>
                <?php
                // Verileri tabloya ekleme
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["cekici_id"] . "</td><td>" . $row["cekici_ad"] . "</td><td>" . $row["ilce_ad"] . "</td></tr>";
                        // Ek alanları buraya ekleyebilirsiniz
                    }
                } else {
                    echo "<tr><td colspan='3'>Tabloda veri bulunamadı.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>
</section>

<script>
    function toggleSubMenu(id) {
        var submenu = document.getElementById(id);
        submenu.style.display = submenu.style.display === "block" ? "none" : "block";
    }
</script>
<?php
// MySQL bağlantısını kapat
$con->close();
?>

</body>
</html>
