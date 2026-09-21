<?php
require_once 'controllers/SekolahControllers.php';

$controller = new SekolahController();

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