<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" type="text/css" href="css/stylesdetail.css">
</head>
<body>
    <div class="container">
        <h2 class="h2">Detail Pesanan</h2>
        <div class="order-details">
        <?php
// Periksa apakah ada parameter "id" yang diterima melalui URL
if (isset($_GET['id'])) {
    // Ambil ID pesanan dari parameter URL
    $id_pesanan = $_GET['id'];

    // Koneksi ke database
    require_once("config.php");

    // Query SQL untuk mengambil detail pesanan berdasarkan ID
    $sql = "SELECT pemesanan.*, produk.nama_produk, profil_pengguna.nama AS nama_pemesan, profil_pengguna.alamat AS alamat_pengiriman
            FROM pemesanan 
            INNER JOIN produk ON pemesanan.jenis_produk = produk.id
            INNER JOIN profil_pengguna ON pemesanan.customer_id = profil_pengguna.customers_id
            WHERE pemesanan.id = :id_pesanan";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_pesanan', $id_pesanan);
    $stmt->execute();

    // Periksa apakah query berhasil dieksekusi
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        // Periksa apakah ada data pesanan yang ditemukan
        if (count($result) > 0) {
            // Tampilkan detail pesanan
            foreach ($result as $row) {
                // Tampilkan informasi pemesanan
                echo "<div class='order-item'>";
                echo "<div class='product-details'>";
                echo "<p class='order-id'>ID Pesanan: " . $row["id"] . "</p>";
                echo "<p class='customer-id'>ID Pelanggan: " . $row["customer_id"] . "</p>";
                echo "<p class='nama-pemesan'>Nama Pemesan: " . $row["nama_pemesan"] . "</p>"; // Tampilkan nama pemesan
                echo "<p class='alamat-pengiriman'>Alamat Pengiriman: " . $row["alamat_pengiriman"] . "</p>"; // Tampilkan alamat pengiriman
                echo "<p class='nama-produk'>Nama Produk: " . $row["nama_produk"] . "</p>"; // Tampilkan nama produk
                echo "<p class='jumlah'>Jumlah: " . $row["jumlah"] . "</p>";
                echo "<p class='metode-pembayaran'>Metode Pembayaran: " . $row["metode_pembayaran"] . "</p>";
                echo "<p class='rincian-pembayaran'>Rincian Pembayaran: " . $row["rincian_pembayaran"] . "</p>";
                echo "<p class='total-pembayaran'>Total Pembayaran: Rp " . number_format($row["total_pembayaran"], 0, ',', '.') . "</p>";
                echo "<p class='status'>Status Pesanan: " . $row["status"] . "</p>";
                echo "<p class='created-at'>Waktu Pemesanan: " . $row["created_at"] . "</p>";

                // Tampilkan waktu terima pesanan jika pesanan sudah diterima
                if ($row["status"] == 'Diterima' && !empty($row["waktu_penerimaan"])) {
                    echo "<p class='accepted-at'>Waktu Terima Pesanan: " . $row["waktu_penerimaan"] . "</p>";
                }

                // Tampilkan waktu pembatalan pesanan jika pesanan sudah dibatalkan
                if ($row["status"] == 'Dibatalkan' && !empty($row["waktu_pembatalan"])) {
                    echo "<p class='cancelled-at'>Waktu Batalkan Pesanan: " . $row["waktu_pembatalan"] . "</p>";
                }

                // Tambahkan kolom-kolom lain dari tabel pemesanan sesuai kebutuhan
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Tidak ada detail pesanan yang tersedia.</p>";
        }
    } else {
        echo "Error: Gagal mengeksekusi kueri.";
    }
} else {
    echo "<p>Parameter ID pesanan tidak ditemukan dalam URL.</p>";
}
?>

        </div>
        <div class="action-buttons">
            <!-- Form untuk tombol penerimaan pesanan -->
            <form id="konfirmasiForm" action="proses_penerimaan.php" method="post">
                <input type="hidden" name="id_pesanan_konfirmasi" value="<?php echo isset($id_pesanan) ? $id_pesanan : ''; ?>">
                <button type="button" onclick="konfirmasi('Apakah Anda yakin ingin menerima pesanan ini?')" class="confirm-btn" id="konfirmasiBtn">Pesanan Diterima</button>
            </form>
            <!-- Tombol untuk pembatalan pesanan -->
            <form id="batalForm" action="proses_pembatalan.php" method="post">
                <input type="hidden" name="id_pesanan" value="<?php echo isset($id_pesanan) ? $id_pesanan : ''; ?>">
                <button type="button" onclick="konfirmasi('Apakah Anda yakin ingin membatalkan pesanan ini?')" class="cancel-btn" id="batalBtn">Batalkan Pesanan</button>
            </form>
        </div>
        <a href="notifikasi.php" class="back-btn">Kembali</a>
    </div>
    <footer class="footer">
        <p>&copy; 2024 Detail Pesanan. All rights reserved.</p>
    </footer>
    <script>
        function konfirmasi(pesan) {
            if (confirm(pesan)) {
                if (pesan.includes("menerima")) {
                    // Menonaktifkan tombol konfirmasi penerimaan pesanan
                    document.getElementById("konfirmasiBtn").disabled = true;
                    // Mengirimkan formulir konfirmasi penerimaan
                    document.getElementById("konfirmasiForm").submit();
                } else if (pesan.includes("membatalkan")) {
                    // Menonaktifkan tombol konfirmasi pembatalan pesanan
                    document.getElementById("batalBtn").disabled = true;
                    // Mengirimkan formulir konfirmasi pembatalan
                    document.getElementById("batalForm").submit();
                }
            }
        }
    </script>
</body>
</html>