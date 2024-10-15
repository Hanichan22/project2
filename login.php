<html>
<body>
    <form action="proses.php?proses=login" method="post">
        <table>
            <tr><td>Username</td><td><input type="text" name="username"></td></tr>
            <tr><td>Password</td><td><input type="password" name="pass"></td></tr>
            <tr><td colspan="2"><input type="submit" value="Login"></td></tr>
        </table>
        <style>
            form {
                display: flex; /* Menggunakan Flexbox */
                flex-direction: column; /* Menyusun elemen dalam kolom */
                align-items: center; /* Memusatkan elemen secara horizontal */
                margin-top: 150px; /* Jarak atas dari judul */
            }
            table {
                border-collapse: collapse; /* Menghilangkan jarak antara border */
                margin: 0 auto; /* Memusatkan tabel */
                font-weight: bold; /* Membuat label lebih tebal */
                font-size: 14px; /* Ukuran font label */
                color: #333; /* Warna label */
                background-color: white; /* Latar belakang tabel */
                padding: 20px; /* Padding di dalam tabel */
                border-radius: 5px; /* Membulatkan sudut tabel */
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Bayangan pada tabel */
            }
            td {
                padding: 10px; /* Padding untuk sel tabel */
                text-align: center; /* Menyelaraskan teks di tengah */
                border: none; /* Menghilangkan border pada sel */
            }
            input[type="text"], input[type="password"] {
                padding: 8px; /* Padding di dalam input */
                width: 100%; /* Lebar input penuh */
                border: 1px solid #ccc; /* Border input */
                border-radius: 4px; /* Membulatkan sudut input */
            }
            input[type="submit"] {
                padding: 8px; /* Padding tombol */
                background-color: pink; /* Warna latar belakang tombol */
                color: whitesmoke; /* Warna teks tombol */
                border: none; /* Menghilangkan border tombol */
                border-radius: 4px; /* Membulatkan sudut tombol */
                cursor: pointer; /* Mengubah kursor saat hover */
                width: 50%; /* Lebar tombol penuh */
                font-weight: bold; /* Menebalkan teks tombol */
            }
            input[type="submit"]:hover {
                background-color: #ff69b4; /* Warna tombol saat hover */
            }
            th {
                border: none; /* Menghilangkan border pada header */
                background-color: #f2f2f2; /* Warna latar belakang header */
            }
        </style>
    </form>
</body>
</html>
