<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'konter199';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    exit('Koneksi gagal: '.$conn->connect_error);
}

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$data = [];

if (! empty($keyword)) {
    $stmt = $conn->prepare('SELECT kode_produk, nama_produk FROM produk WHERE nama_produk LIKE ? OR kode_produk LIKE ? LIMIT 10');
    $search_term = '%'.$keyword.'%';
    $stmt->bind_param('ss', $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
