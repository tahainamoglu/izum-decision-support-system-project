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

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>PHP ve Bootstrap Tablo</title>
</head>
<body>

<div class="container mt-5">
    <h2>Veritabanı Tablosu</h2>
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

</body>
</html>

<?php
// MySQL bağlantısını kapat
$con->close();
?>