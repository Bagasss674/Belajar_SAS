Rangkuman rumus, struktur folder, dan pola koding CRUD berbasis MVC (Model-View-Controller) menggunakan PHP Native dan PDO Prepared Statements.

---

## 📁 Struktur Folder Standard

```text
project-crud/
├── config/
│   └── database.php
├── controllers/
│   └── DataController.php
├── models/
│   └── DataModel.php
├── views/
│   ├── index.php
│   ├── create.php
│   └── edit.php
└── index.php (Router Utama)

database.php
<?php
class Database {
    private $host = "localhost";
    private $db_name = "nama_database"; // ⚠️ Sesuaikan dengan soal
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Koneksi Error: " . $e->getMessage();
        }
        return $this->conn;
    }
}


DataModel.php
<?php
class sekolah { // ⚠️ UBAH INI: Nama Class (samakan dengan nama file model)
    private $conn;
    private $table_name = "sekolah"; // ⚠️ UBAH INI: Nama Tabel di MySQL

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. READ ALL (Tampil Semua Data)
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. READ BY ID (Ambil 1 Data buat Edit)
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 3. CREATE (Tambah Data)
    public function create($data) {
        // ⚠️ UBAH INI: Sesuaikan nama kolom database & placeholder (:nis, :nama, dst)
        $query = "INSERT INTO " . $this->table_name . " (nis, nama, kelas, jurusan) VALUES (:nis, :nama, :kelas, :jurusan)";
        $stmt = $this->conn->prepare($query);
        
        // ⚠️ UBAH INI: Bind semua kolom sesuai inputan $data['...']
        $stmt->bindParam(':nis', $data['nis']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':kelas', $data['kelas']);
        $stmt->bindParam(':jurusan', $data['jurusan']);
        
        return $stmt->execute();
    }

    // 4. UPDATE (Edit Data)
    public function update($id, $data) {
        // ⚠️ UBAH INI: Sesuaikan nama kolom database
        $query = "UPDATE " . $this->table_name . " SET nis = :nis, nama = :nama, kelas = :kelas, jurusan = :jurusan WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // ⚠️ UBAH INI: Bind semua kolom dan ID
        $stmt->bindParam(':nis', $data['nis']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':kelas', $data['kelas']);
        $stmt->bindParam(':jurusan', $data['jurusan']);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    // 5. DELETE (Hapus Data)
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}


DataController.php
<?php
require_once 'config/database.php';
require_once 'models/siswa.php'; // ⚠️ UBAH INI: Nama file model kamu

class SekolahController { // ⚠️ UBAH INI: Nama Class Controller
    private $sekolahModel; // ⚠️ KONSISTENSI: Nama properti bebas, tapi HARUS SAMA dari atas sampai bawah

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->sekolahModel = new sekolah($db); // ⚠️ UBAH INI: Panggil Class Model yang di-import
    }

    // Tampil Halaman Utama
    public function index() {
        $siswaList = $this->sekolahModel->getAll();
        require_once 'views/index.php';
    }

    // Tambah Data
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // ⚠️ UBAH INI: Key array ('nis', 'nama', dll) harus SAMAKAN dengan name="..." di Form HTML
            $data = [
                'nis'     => $_POST['nis'],
                'nama'    => $_POST['nama'],
                'kelas'   => $_POST['kelas'],
                'jurusan' => $_POST['jurusan']
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
            // ⚠️ UBAH INI: Key array harus SAMAKAN dengan name="..." di Form HTML
            $data = [
                'nis'     => $_POST['nis'],
                'nama'    => $_POST['nama'],
                'kelas'   => $_POST['kelas'],
                'jurusan' => $_POST['jurusan']
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

index.php (luar)
<?php
require_once 'controllers/SekolahController.php'; // ⚠️ UBAH INI: Nama file Controller kamu

$controller = new SekolahController(); // ⚠️ UBAH INI: Instansiasi Class Controller

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        if ($id) {
            $controller->edit($id);
        } else {
            header("Location: index.php");
        }
        break;
    case 'delete':
        if ($id) {
            $controller->delete($id);
        } else {
            header("Location: index.php");
        }
        break;
    default:
        $controller->index();
        break;
}

views/index.php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa</title>
</head>
<body>
    <h2>Daftar Data Siswa</h2>
    <a href="index.php?action=create">+ Tambah Data</a>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <!-- ⚠️ UBAH INI: Header Tabel sesuai Soal -->
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($siswaList)): ?>
                <?php $no = 1; foreach ($siswaList as $item): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <!-- ⚠️ UBAH INI: Cetak kolom array $item['...'] sesuai database -->
                    <td><?= htmlspecialchars($item['nis']); ?></td>
                    <td><?= htmlspecialchars($item['nama']); ?></td>
                    <td><?= htmlspecialchars($item['kelas']); ?></td>
                    <td><?= htmlspecialchars($item['jurusan']); ?></td>
                    <td>
                        <a href="index.php?action=edit&id=<?= $item['id']; ?>">Edit</a>
                        <a href="index.php?action=delete&id=<?= $item['id']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">Data kosong.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

views/create.php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa</title>
</head>
<body>
    <h2>Tambah Data Siswa</h2>
    <form action="index.php?action=create" method="POST">
        <!-- ⚠️ UBAH INI: Pastikan atribut name="..." SAMA DENGAN $_POST['...'] di Controller -->
        <p><label>NIS:</label><br><input type="text" name="nis" required></p>
        <p><label>Nama:</label><br><input type="text" name="nama" required></p>
        <p><label>Kelas:</label><br><input type="text" name="kelas" required></p>
        <p><label>Jurusan:</label><br><input type="text" name="jurusan" required></p>
        <button type="submit">Simpan</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>

views/edit.php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
</head>
<body>
    <h2>Edit Data Siswa</h2>
    <form action="index.php?action=edit&id=<?= $siswa['id']; ?>" method="POST">
        <!-- ⚠️ UBAH INI: Isikan value="<?= htmlspecialchars($siswa['...']); ?>" sesuai kolom db -->
        <p><label>NIS:</label><br><input type="text" name="nis" value="<?= htmlspecialchars($siswa['nis']); ?>" required></p>
        <p><label>Nama:</label><br><input type="text" name="nama" value="<?= htmlspecialchars($siswa['nama']); ?>" required></p>
        <p><label>Kelas:</label><br><input type="text" name="kelas" value="<?= htmlspecialchars($siswa['kelas']); ?>" required></p>
        <p><label>Jurusan:</label><br><input type="text" name="jurusan" value="<?= htmlspecialchars($siswa['jurusan']); ?>" required></p>
        <button type="submit">Update</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>