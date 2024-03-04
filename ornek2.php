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