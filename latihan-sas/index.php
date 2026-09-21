<?php
require_once 'controllers/BarangController.php';

$controller = new BarangController();

// Mengambil aksi dari URL (contoh: index.php?action=create)
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Mengarahkan request ke method controller yang sesuai
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