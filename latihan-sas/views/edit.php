<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { width: 300px; }
        p { margin-bottom: 10px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 8px 15px; background: #28a745; color: white; border: none; cursor: pointer; }
        a { margin-left: 10px; color: #555; }
    </style>
</head>
<body>
    <h2>Edit Data Barang</h2>
    <form action="index.php?action=edit&id=<?= $barang['id']; ?>" method="POST">
        <p>
            <label>Kode Barang:</label>
            <input type="text" name="kode_barang" value="<?= htmlspecialchars($barang['kode_barang']); ?>" required>
        </p>
        <p>
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" value="<?= htmlspecialchars($barang['nama_barang']); ?>" required>
        </p>
        <p>
            <label>Kategori:</label>
            <input type="text" name="kategori" value="<?= htmlspecialchars($barang['kategori']); ?>" required>
        </p>
        <p>
            <label>Harga:</label>
            <input type="number" name="harga" value="<?= $barang['harga']; ?>" required>
        </p>
        <p>
            <label>Stok:</label>
            <input type="number" name="stok" value="<?= $barang['stok']; ?>" required>
        </p>
        <button type="submit">Update</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>