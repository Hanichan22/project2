<?php  
// Mulai sesi hanya jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek jika pengguna bukan admin, redirect ke halaman login
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'Admin') {
    header('Location: login.php'); // Ganti dengan halaman login
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #d3d3d3; /* Mengubah warna latar belakang menjadi abu-abu muda */
        }
        h3 {
            color: #4A4A4A;
            font-size: 28px; /* Mengubah ukuran font */
            text-align: center; /* Mengatur teks ke tengah */
            text-transform: uppercase; /* Mengubah semua huruf menjadi kapital */
            letter-spacing: 1px; /* Jarak antar huruf */
            margin-bottom: 20px; /* Jarak bawah judul */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Menambahkan bayangan pada teks */
        }
        .container {
            display: flex; /* Menggunakan flexbox untuk tata letak */
            gap: 20px; /* Jarak antara form dan tabel */
        }
        form {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white; /* Mengubah latar belakang form menjadi putih */
            max-width: 250px; /* Lebar maksimal form diperkecil */
            flex-shrink: 0; /* Mencegah form mengecil */
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold; /* Membuat label lebih tebal */
            font-size: 10px; /* Mengurangi ukuran font label */
            color: #333; /* Warna label */
        }
        input[type="text"], input[type="number"], select {
            width: 90%; /* Lebar input penuh */
            padding: 5px; /* Padding di dalam input */
            margin-bottom: 10px; /* Jarak bawah input */
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 10px; /* Ukuran font input */
        }
        button {
            padding: 8px 12px; /* Ukuran tombol lebih kecil */
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px; /* Ukuran font tombol */
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white; /* Mengubah latar belakang tabel menjadi putih */
        }
        th, td {
            border: 1px solid #ccc;
            padding: 4px; /* Padding dikurangi untuk membuat tabel lebih tipis */
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .logout {
            margin-top: 10px; /* Mengurangi jarak antara tombol logout dan tabel */
            display: inline-block;
            padding: 10px 15px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            position: fixed; /* Memposisikan logout secara tetap */
            right: 20px; /* Jarak dari kanan */
            bottom: 20px; /* Jarak dari bawah */
        }
        .logout:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h3>Data Produk</h3>
    
    <div class="container">
        <!-- Form untuk memasukkan data Produk -->
        <form action="?id=barang.php" method="post" id="formsiswa">
            <label for="idbarang">Id Produk:</label>
            <input type="text" id="idbarang" name="idbarang" required>

            <label for="namabrg">Nama Produk:</label>
            <input type="text" id="namabrg" name="namabrg" required>

            <label for="harga">Harga:</label>
            <select name="harga" required>
                <option value='10000'>Small</option>
                <option value='15000'>Medium</option>
                <option value='20000'>Large</option>
            </select>

            <label for="qty">QTY:</label>
            <input type="number" id="qty" name="qty" required>

            <button type="submit" value="Kirim" name="Kirim">Kirim</button>
        </form>

        <?php
        $berkas = "data/barang.json";
        $dataBarang = array();

        // Cek jika file JSON ada
        if (file_exists($berkas)) {
            $dataJson = file_get_contents($berkas);
            $dataBarang = json_decode($dataJson, true);
        }

        // Proses jika tombol Kirim ditekan
        if (isset($_POST['Kirim'])) {
            $dataBaru = array(
                'idbarang' => $_POST['idbarang'],
                'namabrg' => $_POST['namabrg'],
                'harga' => $_POST['harga'],
                'qty' => $_POST['qty'],
            );

            // Cek apakah barang dengan id yang sama sudah ada
            foreach ($dataBarang as $barang) {
                if ($barang['idbarang'] == $_POST['idbarang']) {
                    echo "<p style='color:red;'>Id Produk sudah ada!</p>";
                    return; // Hentikan proses jika ID sudah ada
                }
            }

            array_push($dataBarang, $dataBaru);

            // Menyimpan data ke file JSON
            $dataJson = json_encode($dataBarang, JSON_PRETTY_PRINT);
            file_put_contents($berkas, $dataJson);
        }
        ?>

        <!-- Tabel untuk menampilkan data barang -->
        <table>
            <tr>
                <th>No.</th>
                <th>Id Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>QTY</th>
            </tr>

            <?php
            $counter = 1;
            foreach ($dataBarang as $barang) {
                echo "<tr>
                        <td>".$counter."</td>
                        <td>".$barang['idbarang']."</td>
                        <td>".$barang['namabrg']."</td>
                        <td>".$barang['harga']."</td>
                        <td>".$barang['qty']."</td>
                    </tr>";
                $counter++;
            }
            ?>
        </table>
    </div>

    <a href="logout.php" class="logout">Logout</a>

</body>
</html>
