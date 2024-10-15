<?php
session_start();
session_destroy(); // Hapus sesi
header('Location: index.php'); // Redirect ke halaman login setelah logout
exit();
?>
