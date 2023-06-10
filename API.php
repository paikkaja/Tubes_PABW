<?php
header('Content-Type: application/json; charset=utf8');

// Allow cross-origin requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Content-Type: application/json; charset=utf8');

$koneksi = mysqli_connect("localhost", "root", "", "pencarian");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM pencarianproduk";
    $query = mysqli_query($koneksi, $sql);
    $array_data = array();
    while ($data = mysqli_fetch_assoc($query)) {
        $array_data[] = $data;
    }
    echo json_encode($array_data, JSON_PRETTY_PRINT);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi_produk = $_POST['deskripsi_produk'];
    $sql = "INSERT INTO pencarianproduk (id_produk,nama_produk,deskripsi_produk) VALUES('$id_produk','$nama_produk','$deskripsi_produk')";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode([$data], JSON_PRETTY_PRINT);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode([$data], JSON_PRETTY_PRINT);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id_produk = $_GET['id_produk'];
    $sql = "DELETE FROM pencarianproduk WHERE id_produk='$id_produk'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode([$data], JSON_PRETTY_PRINT);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode([$data], JSON_PRETTY_PRINT);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $id_produk = $_GET['id_produk'];
    $nama_produk = $_GET['nama_produk'];
    $deskripsi_produk = $_GET['deskripsi_produk'];

    $sql = "UPDATE pencarianproduk SET nama_produk='$nama_produk', deskripsi_produk='$deskripsi_produk' WHERE id_produk='$id_produk'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode([$data], JSON_PRETTY_PRINT);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode([$data], JSON_PRETTY_PRINT);
    }
}
?>