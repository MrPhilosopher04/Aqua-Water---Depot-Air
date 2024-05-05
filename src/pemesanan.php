<?php
// Buat koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "depot_air1";
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query SQL untuk mengambil data produk dari tabel produk beserta harga
$sql_produk = "SELECT id, nama_produk, harga FROM produk";
$result_produk = $conn->query($sql_produk);

// Cek apakah query berhasil
if ($result_produk->num_rows > 0) {
    // Inisialisasi variabel untuk menyimpan opsi dropdown
    $produkOptions = "";

    // Loop melalui hasil query dan tambahkan setiap produk sebagai opsi dropdown
    while ($row_produk = $result_produk->fetch_assoc()) {
        $produkOptions .= "<option value='" . $row_produk['id'] . "' data-price='" . $row_produk['harga'] . "'>" . $row_produk['nama_produk'] . "</option>";
    }
} else {
    $produkOptions = "<option value=''>Tidak ada produk yang tersedia</option>";
}

// Tangkap data dari formulir HTML hanya jika formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis_produk = isset($_POST['jenis_produk']) ? $_POST['jenis_produk'] : '';
    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
    $metode_pembayaran = isset($_POST['metode_pembayaran']) ? $_POST['metode_pembayaran'] : '';
    $rincian_pembayaran = isset($_POST['rincian_pembayaran']) ? $_POST['rincian_pembayaran'] : '';
    
    // Perhitungan total pembayaran
    $sql_harga_produk = "SELECT harga FROM produk WHERE id = '$jenis_produk'";
    $result_harga_produk = $conn->query($sql_harga_produk);
    if ($result_harga_produk->num_rows == 1) {
        $row_harga_produk = $result_harga_produk->fetch_assoc();
        $harga_produk = $row_harga_produk['harga'];
        $total_pembayaran = $harga_produk * $jumlah;
    } else {
        echo "Produk tidak ditemukan.";
        exit;
    }

    // Ambil ID pelanggan dari sesi
    session_start();
    $customer_id = $_SESSION['user']['id'];

    // Validasi data yang diterima
    if (empty($jenis_produk) || empty($jumlah) || empty($metode_pembayaran) || empty($rincian_pembayaran) || empty($total_pembayaran)) {
        echo "Semua field harus diisi.";
    } else {
        // Buat dan jalankan query SQL untuk menyimpan data ke tabel pemesanan
        $sql = "INSERT INTO pemesanan (customer_id, jenis_produk, jumlah, metode_pembayaran, rincian_pembayaran, total_pembayaran, status, created_at) 
        VALUES ('$customer_id', '$jenis_produk', '$jumlah', '$metode_pembayaran', '$rincian_pembayaran', '$total_pembayaran', '$status', CURRENT_TIMESTAMP)";

        if ($conn->query($sql) === TRUE) {
            header("Location: notifikasi.php"); // Mengarahkan ke halaman notifikasi pesanan
            exit; // Pastikan untuk keluar dari skrip agar tidak melanjutkan eksekusi
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Menutup koneksi database
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan AquaSafe</title>
    <link rel="stylesheet" href="css/pemesanan.css">
</head>

<body>
    <div class="container">
        <h2 class="title">Pemesanan AquaSafe</h2>
        <form id="orderForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="jenis_produk">Jenis Produk:</label>
                <select id="jenis_produk" name="jenis_produk" required onchange="calculateTotal()">
                    <?php echo $produkOptions; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah Botol:</label>
                <input type="number" id="jumlah" name="jumlah" min="1" required onchange="calculateTotal()">
            </div>

            <div class="form-group">
                <label for="metode_pembayaran">Metode Pembayaran:</label>
                <select id="metode_pembayaran" name="metode_pembayaran" required>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="OVO">OVO</option>
                    <option value="GoPay">GoPay</option>
                    <option value="Dana">Dana</option>
                    <option value="COD">COD</option>
                </select>
            </div>

            <div class="form-group">
                <label for="rincian_pembayaran">Rincian Pembayaran:</label>
                <textarea id="rincian_pembayaran" name="rincian_pembayaran" readonly></textarea>
            </div>

            <div class="form-group">
                <label for="total_pembayaran">Total Pembayaran:</label>
                <input type="text" id="total_pembayaran" name="total_pembayaran" readonly>
            </div>

            <div class="form-group">
                <input type="submit" value="Buat Pesanan" onclick="return confirmOrder()">
                <button onclick="window.location.href = 'pelanggan.php';">Kembali</button>
            </div>
        </form>
    </div>

    <script>
        function calculateTotal() {
            var selectedProduct = document.getElementById("jenis_produk");
            var price = selectedProduct.options[selectedProduct.selectedIndex].getAttribute("data-price");
            var quantity = document.getElementById("jumlah").value;
            var total = price * quantity;

            document.getElementById("rincian_pembayaran").value = "Harga per botol: Rp " + price + "\nJumlah botol: " + quantity;
            document.getElementById("total_pembayaran").value = "Rp " + total.toLocaleString('id-ID'); // Add the currency symbol
        }

        function confirmOrder() {
            return confirm("Apakah Anda yakin ingin membuat pesanan?");
        }
    </script>
</body>

</html>