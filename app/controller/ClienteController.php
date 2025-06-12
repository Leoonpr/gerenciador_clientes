<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../model/ClienteRepository.php';

$clienteRepo = new ClienteRepository($pdo);
$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'listar':
        $clientes = $clienteRepo->getAll();
        echo json_encode(array_map(fn($cliente) => $cliente->toArray(), $clientes));
        break;

    case 'buscar':
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $cliente = $clienteRepo->findById($id);
            echo json_encode($cliente ? $cliente->toArray() : null);
        }
        break;

    case 'salvar':
        $cliente = new Cliente(
            $_POST['nome'] ?? '',
            $_POST['cpf_cnpj'] ?? '',
            $_POST['email'] ?? '',
            $_POST['telefone'] ?? '',
            empty($_POST['id']) ? null : (int)$_POST['id']
        );

        $result = $clienteRepo->save($cliente);
        echo json_encode(['success' => $result]);
        break;

    case 'excluir':
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $result = $clienteRepo->delete($id);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID inválido.']);
        }
        break;
    
    default:
        echo json_encode(['success' => false, 'message' => 'Ação não reconhecida.']);
        break;
}
?>