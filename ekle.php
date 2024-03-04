User
<?php
include 'baglanti2.php';

?>

<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çekici Ekle</title>
    <style>
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
        /* CSS stilleri buraya gelecek */
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
            <a href="mud_ekle.php" class="w3-bar-item w3-button">Müdahale Ekle</a>
        </div>
    </div>

    <div class="menu-item">
        <a href="oneri.php" class="w3-bar-item w3-red w3-button">Tavsiye</a>
    </div>

    <div class="menu-item">
        <a href="giris3.php" class="w3-bar-item w3-red w3-button">Çıkış</a>
    </div>
</nav>
<section>
    <!-- Buraya sayfanızın geri kalan içeriği gelecek -->
</section>
<script>
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}

function myDropFunc() {
  var x = document.getElementById("demoDrop");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}
</script>

<?php
    include('baglanti2.php');
    if (isset($_POST["submit"])) {
        $ist = $_POST['ad'];
        $mahalle = $_POST['ilce'];
        $query = mysqli_query($con, "INSERT INTO cekici (cekici_ad, ilce_id) VALUES ('$ist', '$mahalle')");
        if ($query) {
            echo "<script>alert('done')</script>";
        } else {
            echo "<script>alert('error')</script>";
        }
    }
    ?>
<form method="POST">
            <font color="red">Çekici Adı:</font>
            <input type="text" name="ad" /><br /><br />
            <font color="red">İlçe Adı:</font>
            <select name="ilce">
                <?php
                $mahalle = mysqli_query($con, "SELECT * FROM ilce");

                while ($mah = mysqli_fetch_array($mahalle)) {
                ?>
                <option value="<?php echo $mah['ilce_id'] ?>"><?php echo $mah['ilce_ad'] ?></option>
                <?php } ?>
            </select> <br /><br />

            <input type="submit" name="submit" value="EKLE..">
        </form>

</body>
</html>
