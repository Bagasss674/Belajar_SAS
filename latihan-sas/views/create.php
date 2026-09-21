<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { width: 300px; }
        p { margin-bottom: 10px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 8px 15px; background: #007bff; color: white; border: none; cursor: pointer; }
        a { margin-left: 10px; color: #555; }
    </style>
</head>
<body>
    <h2>Tambah Barang Baru</h2>
    <form action="index.php?action=create" method="POST">
        <p>
            <label>Kode Barang:</label>
            <input type="text" name="kode_barang" required>
        </p>
        <p>
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" required>
        </p>
        <p>
            <label>Kategori:</label>
            <input type="text" name="kategori" required>
        </p>
        <p>
            <label>Harga:</label>
            <input type="number" name="harga" required>
        </p>
        <p>
            <label>Stok:</label>
            <input type="number" name="stok" required>
        </p>
        <button type="submit">Simpan</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>