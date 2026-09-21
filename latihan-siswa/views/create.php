<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 300px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 8px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn-batal { padding: 8px 15px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; display: inline-block; }
    </style>
</head>
<body>
    <h2>Tambah Data Siswa</h2>
    <form action="index.php?action=create" method="POST">
        <div class="form-group">
            <label>NIS:</label>
            <input type="text" name="nis" required>
        </div>
        <div class="form-group">
            <label>Nama Siswa:</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>Kelas:</label>
            <input type="text" name="kelas" required>
        </div>
        <div class="form-group">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" required>
        </div>
        <button type="submit">Simpan Data</button>
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>