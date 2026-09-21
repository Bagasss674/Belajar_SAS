<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 300px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 8px 15px; background: #ffc107; color: black; border: none; border-radius: 4px; cursor: pointer; }
        .btn-batal { padding: 8px 15px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; display: inline-block; }
    </style>
</head>
<body>
    <h2>Edit Data Siswa</h2>
    <form action="index.php?action=edit&id=<?= $siswa['id']; ?>" method="POST">
        <div class="form-group">
            <label>NIS:</label>
            <input type="text" name="nis" value="<?= htmlspecialchars($siswa['nis']); ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Siswa:</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($siswa['nama']); ?>" required>
        </div>
        <div class="form-group">
            <label>Kelas:</label>
            <input type="text" name="kelas" value="<?= htmlspecialchars($siswa['kelas']); ?>" required>
        </div>
        <div class="form-group">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" value="<?= htmlspecialchars($siswa['jurusan']); ?>" required>
        </div>
        <button type="submit">Update Data</button>
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>