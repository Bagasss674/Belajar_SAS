<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Barang - Inventaris</title>
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
    <h2>Daftar Inventaris Barang</h2>
    <a href="index.php?action=create" class="btn">+ Tambah Barang Baru</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($barangList)): ?>
                <?php $no = 1; foreach ($barangList as $item): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($item['kode_barang']); ?></td>
                    <td><?= htmlspecialchars($item['nama_barang']); ?></td>
                    <td><?= htmlspecialchars($item['kategori']); ?></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td><?= $item['stok']; ?></td>
                    <td>
                        <a href="index.php?action=edit&id=<?= $item['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="index.php?action=delete&id=<?= $item['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada data barang.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>