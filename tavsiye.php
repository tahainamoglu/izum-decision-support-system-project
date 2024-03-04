<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>İzum Konumlandırma Sistemi</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
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

        h1 {
            color: #333;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }

        .section {
            text-align: center;
            margin: 10px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            color:white;
            background-color:green;
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

    <div class="container">
        <div class="section" id="konak">
            <button onclick="showAverage('konak')">KONAK</button>
        </div>
        <div class="section" id="bornova">
            <button onclick="showAverage('bornova')">BORNOVA</button>
        </div>
        <div class="section" id="karsiyaka">
            <button onclick="showAverage('karsiyaka')">KARŞIYAKA</button>
        </div>
        <div class="section" id="karabaglar">
            <button onclick="showAverage('karabaglar')">KARABAĞLAR</button>
        </div>
        <div class="section" id="buca">
            <button onclick="showAverage('buca')">BUCA</button>
        </div>
        <div class="section" id="bayrakli">
            <button onclick="showAverage('bayrakli')">BAYRAKLI</button>
        </div>
        <div class="section" id="gaziemir">
            <button onclick="showAverage('gaziemir')">GAZİEMİR</button>
        </div>
        <div class="section" id="cigli">
            <button onclick="showAverage('cigli')">ÇİĞLİ</button>
        </div>
    </div>

    <script>
        function showAverage(section) {
            var sectionName = section.toUpperCase();
            var average = 118.15;

            var vehicleCount;
            var message;

            switch (section) {
                case 'konak':
                    vehicleCount = 420;
                    message = `GENEL KAZA ORTALAMASI = ${average.toFixed(2)}\n${sectionName} = ${vehicleCount}\n${sectionName} ORTALAMANIN ÜZERİNDEDİR\nÇEKİCİ SAYISI YETERLİDİR\nDİKKAT EDİLMESİ GEREKİR`;
                    break;
                case 'bornova':
                    vehicleCount = 502;
                    message = `GENEL KAZA ORTALAMASI = ${average.toFixed(2)}\n${sectionName} = ${vehicleCount}\n${sectionName} ORTALAMANIN ÜZERİNDEDİR\n${sectionName}'da DAHA FAZLA ÇEKİCİ BULUNDURULMASI GEREKİR`;
                    break;
                case 'karsiyaka':
                    vehicleCount = 146;
                    message = `GENEL KAZA ORTALAMASI = ${average.toFixed(2)}\n${sectionName} = ${vehicleCount}\n${sectionName} ORTALAMANIN ÜZERİNDEDİR\nÇEKİCİ SAYISI YETERLİDİR`;
                    break;
                case 'karabaglar':
                    vehicleCount = 146;
                    message = `GENEL KAZA ORTALAMASI = ${average.toFixed(2)}\n${sectionName} = ${vehicleCount}\n${sectionName} ORTALAMANIN ÜZERİNDEDİR\nÇEKİCİ SAYISI YETERSİZDİR\n${sectionName}'da DAHA FAZLA ÇEKİCİ BULUNDURULMASI GEREKİR`;
                    break;
                case 'buca':
                    vehicleCount = 146;
                    message = `GENEL KAZA ORTALAMASI = ${average.toFixed(2)}\n${sectionName} = ${vehicleCount}\n${sectionName} ORTALAMANIN ÜZERİNDEDİR\nÇEKİCİ SAYISI YETERLİDİR`;
                    break;
                case 'bayrakli':
                    vehicleCount = 182;
                    message = `GENEL KAZA ORTALAMASI = ${average.toFixed(2)}\n${sectionName} = ${vehicleCount}\n${sectionName} ORTALAMANIN ÜZERİNDEDİR\nÇEKİCİ SAYISI YETERLİDİR`;
                    break;
                    case 'gaziemir':
                    vehicleCount = 166;
                    message = `GENEL KAZA ORTALAMASI = ${average.toFixed(2)}\n${sectionName} = ${vehicleCount}\n${sectionName} ORTALAMANIN ÜZERİNDEDİR\nÇEKİCİ SAYISI YETERLİDİR`;
                    break;
                    case 'cigli':
                    vehicleCount = 146;
                    message = `GENEL KAZA ORTALAMASI = ${average.toFixed(2)}\n${sectionName} = ${vehicleCount}\n${sectionName} ORTALAMANIN ÜZERİNDEDİR\nÇEKİCİ SAYISI YETERSİZDİR\n${sectionName}'da DAHA FAZLA ÇEKİCİ BULUNDURULMASI GEREKİR`;
                    break;
                // Diğer bölgeleri buraya ekleyebilirsiniz.
                default:
                    break;
            }

            alert(message);
        }

        function toggleSubMenu(id) {
            var submenu = document.getElementById(id);
            if (submenu.style.display === "block") {
                submenu.style.display = "none";
            } else {
                submenu.style.display = "block";
            }
        }
    </script>
</body>

</html>



















    

