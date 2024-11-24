<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $nim = trim($_POST['nim']);
    $password = trim($_POST['password']);
    $uploadFile = $_FILES['uploadFile'];

    if (strlen($name) < 3) {
        die("Nama harus lebih dari 3 karakter.");
    }
    if (strlen($password) < 6) {
        die("Kata sandi harus minimal 6 karakter.");
    }
    if ($uploadFile['size'] > 2 * 1024 * 1024) { // Batas 2MB
        die("Ukuran file maksimal 2MB.");
    }
    if ($uploadFile['type'] !== "application/pdf") {
        die("Hanya file PDF yang diperbolehkan.");
    }

    // Memindahkan file ke folder tujuan
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $filePath = $uploadDir . basename($uploadFile['name']);
    if (move_uploaded_file($uploadFile['tmp_name'], $filePath)) {
        $fileUrl = $filePath;
    } else {
        die("Terjadi kesalahan saat mengunggah file.");
    }

    // Informasi browser dan OS
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // Menampilkan data
    echo "<h2>Data Pendaftaran</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Nama</th><td>$name</td></tr>";
    echo "<tr><th>Email</th><td>$email</td></tr>";
    echo "<tr><th>NIM</th><td>$nim</td></tr>";
    echo "<tr><th>Browser/Sistem Operasi</th><td>$userAgent</td></tr>";
    echo "<tr><th>File PDF</th><td><a href='$fileUrl' target='_blank'>Lihat PDF</a></td></tr>";
    echo "</table>";
}
?>
