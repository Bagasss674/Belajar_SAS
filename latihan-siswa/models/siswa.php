<?php
class sekolah {
    private $conn;
    private $table_name = "sekolah";

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ: Ambil Semua Data Barang
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // READ: Ambil 1 Data Berdasarkan ID (Untuk Form Edit)
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // CREATE: Tambah Data Barang Baru
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (nis, nama, kelas, jurusan) 
                  VALUES (:nis, :nama, :kelas, :jurusan)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nis', $data['nis']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':kelas', $data['kelas']);
        $stmt->bindParam(':jurusan', $data['jurusan']);

        return $stmt->execute();
    }

    // UPDATE: Simpan Perubahan Data
    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " 
                  SET nis = :nis, nama = :nama, 
                      kelas = :kelas, jurusan = :jurusan
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nis', $data['nis']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':kelas', $data['kelas']);
        $stmt->bindParam(':jurusan', $data['jurusan']);

        return $stmt->execute();
    }

    // DELETE: Hapus Data Barang
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}