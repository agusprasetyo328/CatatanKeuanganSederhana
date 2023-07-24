<?php
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

// Get data from the HTML form
$jenis = $_POST['jenis'];
$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$jumlah = $_POST['jumlah'];

// Prepare and execute the SQL statement
$sql = "INSERT INTO transactions (jenis, tanggal, keterangan, jumlah) VALUES ('$jenis', '$tanggal', '$keterangan', $jumlah)";
if ($conn->query($sql) === TRUE) {
    echo "New transaction saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
