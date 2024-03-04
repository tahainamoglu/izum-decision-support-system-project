<?php
include 'baglanti2.php';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title class="baslık">İzum Konumlandırma Sistemi</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="">
    <body>
    

<header>
    <h1>İzum Çekici Konumlandırma Sistemi</h1>
</header>
<style>
  header h1{
    color:white;
  }
body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: linear-gradient(to right, #DECBA4, #3E5151);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }


        header {
          background-image: linear-gradient(to right, #434343 0%, black 100%);
            color: white;
            text-align: center;
            padding: 2em;
            box-sizing: border-box;
            
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
    </style>

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
        <a href="tavsiye.php" class="w3-bar-item w3-red w3-button">Tavsiye</a>
    </div>

    <div class="menu-item">
        <a href="giris3.php" class="w3-bar-item w3-red w3-button">Çıkış</a>
    </div>
</nav>
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
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Google Charts Sütun Grafiği</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <style>
    .container {
    border-radius: 10px;
    background-color: #fff;
    padding-left: 10px;
    border-left-width: 10%;
    margin: auto;
    width: 30%;
    border: 3px solid green; /* border-color özelliği ile kenar rengini değiştirin */
    padding: 20px;
    background:black;
    margin-top: 200px;
            
        }
    .row {
            margin: auto;
            width: 30%;
            padding: 20px;
            margin-top: 700px;
          
    }
  </style>
</head>
<body>
  <div id="googleBarchart" class="container" style="position:absolute;
  top: 100px;
  left: 100px;
  right: 50px;
  width: 1300px;
  height: 500px;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <div class="row" style="position:absolute";></div> 
 

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

  // SQL sorgusu
  $sql = "SELECT ilce_ad, cekici_sayisi FROM cekici_sayisi_vw";

  $result = $conn->query($sql);

  // Verileri alın
  $data = array();
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }

  // Veritabanı bağlantısını kapat
  $conn->close();
  ?>

  <script>
    // Google Charts ile sütun grafiği oluşturun
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawGoogleChart);

    function drawGoogleChart() {
      var googleData = new google.visualization.DataTable();
      googleData.addColumn('string', 'Ilce');
      googleData.addColumn('number', 'cekici Sayisi');

      // Veritabanından gelen verileri Google Chart için ekleyin
      <?php
      foreach ($data as $row) {
        echo "googleData.addRow(['{$row['ilce_ad']}', {$row['cekici_sayisi']}]);";
      }
      ?>

      var googleOptions = {
        title: 'İlçelere Göre Çekici Sayısı',
        legend: { position: 'none' },
        colors: ['#006400'],
        bar: { groupWidth: '80%' },
        animation: { duration: 1000, easing: 'out', startup: true },
        hAxis: {
          title: 'Ilce',
          textStyle: {
            fontSize: 12,
            color: '#5e5e5e'
          },
        },
        vAxis: {
          title: 'Çekici Sayisi',
          baselineColor: '#ddd',
          gridlineColor: '#ddd',
          textStyle: {
            fontSize: 12,
            color: '#5e5e5e'
          },
        },
      };

      var googleChart = new google.visualization.ColumnChart(document.getElementById('googleBarchart'));
      googleChart.draw(googleData, googleOptions);
    }
  </script>
</body>
</html>
</html>