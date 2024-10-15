<?php  
session_start();

// Pastikan parameter 'proses' ada dalam URL
if (isset($_GET['proses']) && $_GET['proses'] == 'login') {
    
    // Pastikan POST data 'username' dan 'pass' di-set sebelum digunakan
    if (isset($_POST['username']) && isset($_POST['pass'])) {
        $user = $_POST['username'];
        $pass = $_POST['pass'];
        
        // Data login (username, password, status)
        $data = array(
            array('Kasir', password_hash('1234', PASSWORD_DEFAULT), 'Kasir'), // User: Kasir, Password: 1234, Status: Kasir
            array('Admin', password_hash('admin123', PASSWORD_DEFAULT), 'Admin') // User: Admin, Password: admin123, Status: Admin
        );
        
        $loginBerhasil = false; // Flag untuk mengecek status login

        // Loop untuk pengecekan username dan password
        foreach ($data as $userData) {
            if ($user == $userData[0] && password_verify($pass, $userData[1])) {
                $_SESSION['status'] = $userData[2]; // Simpan status pengguna dalam sesi
                $loginBerhasil = true; // Set flag ke true
                break; // Keluar dari loop jika login berhasil
            }
        }
        
        // Jika login berhasil
        if ($loginBerhasil) {
            // Cek status pengguna
            if ($_SESSION['status'] == 'Kasir') {
                header('Location: penjualan.php'); // Redirect ke penjualan.php untuk Kasir
            } else {
                header('Location: barang.php'); // Redirect ke barang.php untuk Admin
            }
            exit();
        } else {
            // Jika login gagal, tampilkan pesan
            echo "<p><br></p>";
            echo "<b><p><br><div style='font-size: 150px; text-align: center; background-color: lightpink; color: deeppink;'> Username atau Password salah! Silakan coba lagi. </div></p></b>";
        }
    } else {
        echo "Silakan masukkan username dan password.";
    }
} else {
    echo "Proses login tidak valid.";
}
?>
