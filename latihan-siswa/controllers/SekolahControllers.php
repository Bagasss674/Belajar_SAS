<?php
require_once 'config/database.php';
require_once 'models/siswa.php';

class SekolahController {
    private $sekolahModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->sekolahModel = new sekolah($db);
    }

    // Tampil Halaman Utama
    public function index() {
        $siswaList = $this->sekolahModel->getAll();
        require_once 'views/index.php';
    }

    // Tambah Data
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nis' => $_POST['nis'],
                'nama' => $_POST['nama'],
                'kelas'    => $_POST['kelas'],
                'jurusan'       => $_POST['jurusan']
            ];
            $this->sekolahModel->create($data);
            header("Location: index.php");
            exit;
        }
        require_once 'views/create.php';
    }

    // Edit Data
    public function edit($id) {
        $siswa = $this->sekolahModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nis' => $_POST['nis'],
                'nama' => $_POST['nama'],
                'kelas'    => $_POST['kelas'],
                'jurusan'       => $_POST['jurusan']
            ];
            $this->sekolahModel->update($id, $data);
            header("Location: index.php");
            exit;
        }
        require_once 'views/edit.php';
    }

    // Hapus Data
    public function delete($id) {
        $this->sekolahModel->delete($id);
        header("Location: index.php");
        exit;
    }
}