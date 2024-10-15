<?php  
// Mulai sesi hanya jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek jika pengguna bukan kasir, redirect ke halaman login
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'Kasir') {
    header('Location: login.php'); // Ganti dengan halaman login
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #d3d3d3; /* Warna latar belakang abu-abu muda */
        }
        h3 {
            color: #4A4A4A;
            font-size: 28px; /* Ukuran font */
            text-align: center; /* Teks ke tengah */
            text-transform: uppercase; /* Huruf kapital */
            letter-spacing: 1px; /* Jarak antar huruf */
            margin-bottom: 20px; /* Jarak bawah judul */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Bayangan pada teks */
        }
        .container {
            display: flex; /* Menggunakan flexbox untuk tata letak */
            gap: 20px; /* Jarak antara form dan tabel */
        }
        form {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white; /* Latar belakang form putih */
            max-width: 300px; /* Lebar maksimal form */
            flex-shrink: 0; /* Mencegah form mengecil */
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold; /* Membuat label lebih tebal */
            font-size: 10px; /* Ukuran font label */
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
            padding: 8px 12px; /* Ukuran tombol */
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
            width: 100%; /* Lebar tabel penuh */
            border-collapse: collapse; /* Menghapus jarak antara border tabel */
            margin-top: 20px; /* Jarak atas tabel */
            background-color: white; /* Latar belakang tabel putih */
        }
        th, td {
            border: 1px solid #ccc; /* Border tabel */
            padding: 4px; /* Padding di dalam sel */
            text-align: center; /* Teks di tengah */
        }
        th {
            background-color: #f2f2f2; /* Latar belakang header tabel */
        }
        .bdr {
            border: 1px solid black !important; /* Border untuk sel tabel */
            text-align: center; /* Teks di tengah */
        }
        .logout {
            margin-top: 10px; /* Jarak antara tombol logout dan tabel */
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
    <h3>Data Penjualan</h3>
    
    <div class="container">
        <!-- Form untuk memasukkan data penjualan -->
        <form action="?id=penjualan.php" method="post" id="formpenjualan">
            <label for="nama">Nama Customer:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="namabrg">Nama Produk:</label>
            <input type="text" id="namabrg" name="namabrg" required>

            <label for="harga">Harga:</label>
            <select name="harga" required>
                <option value="10000">Small</option>
                <option value="15000">Medium</option>
                <option value="20000">Large</option>
            </select>

            <label for="qty">QTY:</label>
            <input type="number" id="qty" name="qty" required>

            <button type="submit" form="formpenjualan" value="Kirim" name="Kirim">Kirim</button>
        </form>

        <!-- Tabel untuk menampilkan data penjualan -->
        <table>
            <tr>
                <th class='bdr'>No.</th>
                <th class='bdr'>Nama Customer</th>
                <th class='bdr'>Nama Barang</th>
                <th class='bdr'>Harga</th>
                <th class='bdr'>QTY</th>
                <th class='bdr'>Jumlah</th>
            </tr>

            <?php
            $berkasPenjualan = "data/penjualan.json"; 
            $dataPenjualan = array();
            
            // Mengambil data dari file penjualan
            if (file_exists($berkasPenjualan)) {
                $dataJsonPenjualan = file_get_contents($berkasPenjualan);
                $dataPenjualan = json_decode($dataJsonPenjualan, true);
            }

            if (isset($_POST['Kirim'])) {
                $namabrg = $_POST['namabrg'];
                $qtyTerjual = $_POST['qty'];

                // Menambahkan data penjualan baru ke file penjualan.json
                $dataBaruPenjualan = array(
                    'nama' => $_POST['nama'],
                    'namabrg' => $namabrg,
                    'harga' => $_POST['harga'],
                    'qty' => $qtyTerjual,
                );
                array_push($dataPenjualan, $dataBaruPenjualan);
                $dataJsonPenjualan = json_encode($dataPenjualan, JSON_PRETTY_PRINT);
                file_put_contents($berkasPenjualan, $dataJsonPenjualan);

                // Mengambil data dari file barang.json
                $berkasBarang = "data/barang.json";
                $dataBarang = array();

                if (file_exists($berkasBarang)) {
                    $dataJsonBarang = file_get_contents($berkasBarang);
                    $dataBarang = json_decode($dataJsonBarang, true);

                    // Mengurangi QTY barang yang sesuai dengan nama produk
                    for ($i = 0; $i < count($dataBarang); $i++) {
                        if ($dataBarang[$i]['namabrg'] == $namabrg) {
                            // Mengurangi QTY barang
                            $dataBarang[$i]['qty'] -= $qtyTerjual;

                            // Jika QTY negatif, set QTY ke 0 (agar tidak minus)
                            if ($dataBarang[$i]['qty'] < 0) {
                                $dataBarang[$i]['qty'] = 0;
                            }
                            break; // Keluar dari loop jika barang ditemukan
                        }
                    }

                    // Menyimpan perubahan ke file barang.json
                    $dataJsonBarang = json_encode($dataBarang, JSON_PRETTY_PRINT);
                    file_put_contents($berkasBarang, $dataJsonBarang);
                }
            }

            $counter = 1;
            for ($i = 0; $i < count($dataPenjualan); $i++) {
                $nama = $dataPenjualan[$i]['nama'];
                $namabrg = $dataPenjualan[$i]['namabrg'];
                $harga = $dataPenjualan[$i]['harga'];
                $qty = $dataPenjualan[$i]['qty'];
                $jumlah = $harga * $qty;

                echo "<tr>
                        <td class='bdr'>".$counter."</td>
                        <td class='bdr'>".$nama."</td>
                        <td class='bdr'>".$namabrg."</td>
                        <td class='bdr'>".$harga."</td>
                        <td class='bdr'>".$qty."</td>
                        <td class='bdr'>".$jumlah."</td>
                    </tr>";

                $counter++;
            }
            ?>
        </table>
    </div>

    <a href="logout.php" class="logout">Logout</a>
</body>
</html>
