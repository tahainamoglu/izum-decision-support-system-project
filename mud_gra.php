<?php
include 'baglanti2.php';
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>İzum Konumlandırma Sistemi</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
            background-color: white;
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
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .container {
            border-radius: 10px;
            background-color: #f2f2f2;
            padding-left: 10px;
            border-left-width: 10%;
            margin: auto;
            width: 30%;
            border: 3px white;
            padding: 20px;
            background: rgba(10, 1, 0, 0.8);
            margin-top: 20px;
        }

        .chart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
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

    <div class="chart-container">
        <div id="line_chart_1" style="width: 100%; height: 500px;"></div>
        <div id="line_chart_2" style="width: 100%; height: 500px; margin-top: 20px;"></div>
        <div id="line_chart_3" style="width: 100%; height: 500px; margin-top: 50px;"></div>
    </div>

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

    // SQL sorgusu 1
    $sql = "SELECT ilce_ad, kaza_sayisi FROM kaza_sayisi_vw";
    $result = $conn->query($sql);

    // Verileri alın 1
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // SQL sorgusu 2
    $sql2 = "SELECT durum_ad, arac_mudahale FROM arac_mudahale_vw";
    $result2 = $conn->query($sql2);

    // Verileri alın 2
    $data2 = array();
    while ($row2 = $result2->fetch_assoc()) {
        $data2[] = $row2;
    }

    $sql3 = "SELECT yol_ad, yol_mudahale FROM yol_durumu_vw";
    $result3 = $conn->query($sql3);

    // Verileri alın 2
    $data3 = array();
    while ($row3 = $result3->fetch_assoc()) {
        $data3[] = $row3;
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
    ?>

    <script>
        // Google Charts ile sütun grafiği oluşturun
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawGoogleChart);

        function drawGoogleChart() {
            var googleData = new google.visualization.DataTable();
            googleData.addColumn('string', 'Ilce');
            googleData.addColumn('number', 'Kaza Sayisi');

            // Veritabanından gelen verileri Google Chart için ekleyin 1
            <?php
            foreach ($data as $row) {
                echo "googleData.addRow(['{$row['ilce_ad']}', {$row['kaza_sayisi']}]);";
            }
            ?>

            var googleOptions = {
                title: 'İlçelere Göre Kaza Sayısı',
                legend: { position: 'none' },
                colors: ['#4285F4'],
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
                    title: 'Kaza Sayisi',
                    baselineColor: '#ddd',
                    gridlineColor: '#ddd',
                    textStyle: {
                        fontSize: 12,
                        color: '#5e5e5e'
                    },
                },
            };

            var googleChart = new google.visualization.ColumnChart(document.getElementById('line_chart_1'));
            googleChart.draw(googleData, googleOptions);

            // İkinci grafik için
            var googleData2 = new google.visualization.DataTable();
            googleData2.addColumn('string', 'Ilce');
            googleData2.addColumn('number', 'Kaza Sayisi');

            // Veritabanından gelen verileri Google Chart için ekleyin 2
            <?php
            foreach ($data2 as $row2) {
                echo "googleData2.addRow(['{$row2['durum_ad']}', {$row2['arac_mudahale']}]);";
            }
            ?>

            var googleOptions2 = {
                title: 'Araç Durumuna Göre Kaza Sayısı',
                legend: { position: 'none' },
                colors: ['#4285F4'],
                bar: { groupWidth: '80%' },
                animation: { duration: 1000, easing: 'out', startup: true },
                hAxis: {
                    title: 'durum ad',
                    textStyle: {
                        fontSize: 12,
                        color: '#5e5e5e'
                    },
                },
                vAxis: {
                    title: 'kaza sayısı',
                    baselineColor: '#ddd',
                    gridlineColor: '#ddd',
                    textStyle: {
                        fontSize: 12,
                        color: '#5e5e5e'
                    },
                },
            };

            var googleChart2 = new google.visualization.ColumnChart(document.getElementById('line_chart_2'));
            googleChart2.draw(googleData2, googleOptions2);

            // Üçüncü grafik için
            var googleData3 = new google.visualization.DataTable();
            googleData3.addColumn('string', 'Yol Durumu');
            googleData3.addColumn('number', 'Mudahale Sayilari');

            // Veritabanından gelen verileri Google Chart için ekleyin 3
            <?php
            foreach ($data3 as $row3) {
                echo "googleData3.addRow(['{$row3['yol_ad']}', {$row3['yol_mudahale']}]);";
            }
            ?>

            var googleOptions3 = {
                title: 'Yol Durumuna Göre Müdahale Sayıları',
                legend: { position: 'none' },
                colors: ['#4285F4'],
                bar: { groupWidth: '80%' },
                animation: { duration: 1000, easing: 'out', startup: true },
                hAxis: {
                    title: 'Yol Durumu',
                    textStyle: {
                        fontSize: 12,
                        color: '#5e5e5e'
                    },
                },
                vAxis: {
                    title: 'Mudahale Sayilari',
                    baselineColor: '#ddd',
                    gridlineColor: '#ddd',
                    textStyle: {
                        fontSize: 12,
                        color: '#5e5e5e'
                    },
                },
            };

            var googleChart3 = new google.visualization.ColumnChart(document.getElementById('line_chart_3'));
            googleChart3.draw(googleData3, googleOptions3);
        }
    </script>
</body>

</html>


