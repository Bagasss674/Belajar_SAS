<?php
require_once 'config/database.php';
require_once 'models/Barang.php';

class BarangController {
    private $barangModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->barangModel = new Barang($db);
    }

    // Tampil Halaman Utama
    public function index() {
        $barangList = $this->barangModel->getAll();
        require_once 'views/index.php';
    }

    // Tambah Data
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'kode_barang' => $_POST['kode_barang'],
                'nama_barang' => $_POST['nama_barang'],
                'kategori'    => $_POST['kategori'],
                'harga'       => $_POST['harga'],
                'stok'        => $_POST['stok']
            ];
            $this->barangModel->create($data);
            header("Location: index.php");
            exit;
        }
        require_once 'views/create.php';
    }

    // Edit Data
    public function edit($id) {
        $barang = $this->barangModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'kode_barang' => $_POST['kode_barang'],
                'nama_barang' => $_POST['nama_barang'],
                'kategori'    => $_POST['kategori'],
                'harga'       => $_POST['harga'],
                'stok'        => $_POST['stok']
            ];
            $this->barangModel->update($id, $data);
            header("Location: index.php");
            exit;
        }
        require_once 'views/edit.php';
    }

    // Hapus Data
    public function delete($id) {
        $this->barangModel->delete($id);
        header("Location: index.php");
        exit;
    }
}