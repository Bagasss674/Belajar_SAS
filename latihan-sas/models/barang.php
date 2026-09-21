<?php
class Barang {
    private $conn;
    private $table_name = "barang";

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
        $query = "INSERT INTO " . $this->table_name . " (kode_barang, nama_barang, kategori, harga, stok) 
                  VALUES (:kode_barang, :nama_barang, :kategori, :harga, :stok)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':kode_barang', $data['kode_barang']);
        $stmt->bindParam(':nama_barang', $data['nama_barang']);
        $stmt->bindParam(':kategori', $data['kategori']);
        $stmt->bindParam(':harga', $data['harga']);
        $stmt->bindParam(':stok', $data['stok']);

        return $stmt->execute();
    }

    // UPDATE: Simpan Perubahan Data
    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " 
                  SET kode_barang = :kode_barang, nama_barang = :nama_barang, 
                      kategori = :kategori, harga = :harga, stok = :stok 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':kode_barang', $data['kode_barang']);
        $stmt->bindParam(':nama_barang', $data['nama_barang']);
        $stmt->bindParam(':kategori', $data['kategori']);
        $stmt->bindParam(':harga', $data['harga']);
        $stmt->bindParam(':stok', $data['stok']);

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