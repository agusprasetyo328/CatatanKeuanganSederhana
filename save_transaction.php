<?php
// Pastikan untuk mengganti nilai-nilai berikut sesuai dengan konfigurasi database Anda
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "catatan_keuangan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk membersihkan input dari potensi serangan SQL injection
function clean_input($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// Get data from the HTML form after cleaning the input
$jenis = clean_input($_POST['jenis']);
$tanggal = clean_input($_POST['tanggal']);
$keterangan = clean_input($_POST['keterangan']);
$jumlah = (int) $_POST['jumlah']; // Pastikan jumlah adalah bilangan bulat

// Prepare and execute the SQL statement dengan menggunakan prepared statement untuk mencegah SQL injection
$stmt = $conn->prepare("INSERT INTO transactions (jenis, tanggal, keterangan, jumlah) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $jenis, $tanggal, $keterangan, $jumlah);

if ($stmt->execute()) {
    echo "New transaction saved successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>