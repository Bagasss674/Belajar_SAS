<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 6px 12px; text-decoration: none; background: #28a745; color: white; border-radius: 4px; display: inline-block; }
        .btn-edit { background: #ffc107; color: black; }
        .btn-delete { background: #dc3545; color: white; }
    </style>
</head>
<body>
    <h2>Daftar Siswa</h2>
    <a href="index.php?action=create" class="btn">+ Tambah Siswa Baru</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
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
                    <td><?= htmlspecialchars($item['nis']); ?></td>
                    <td><?= htmlspecialchars($item['nama']); ?></td>
                    <td><?= htmlspecialchars($item['kelas']); ?></td>
                    <td><?= htmlspecialchars($item['jurusan']); ?></td>
                    <td>
                        <a href="index.php?action=edit&id=<?= $item['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="index.php?action=delete&id=<?= $item['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin hapus data siswa ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data siswa.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>