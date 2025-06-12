<?php
require_once __DIR__ . '/Cliente.php';

class ClienteRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    
    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM clientes ORDER BY nome");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $clientes = [];

        foreach ($rows as $row) {
            $clientes[] = new Cliente(
                $row['nome'],
                $row['cpf_cnpj'],
                $row['email'],
                $row['telefone'],
                $row['id']
            );
        }

        return $clientes;
    }

    public function findById(int $id): ?Cliente {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Cliente(
            $row['nome'],
            $row['cpf_cnpj'],
            $row['email'],
            $row['telefone'],
            $row['id']
        );
    }

    public function save(Cliente $cliente): array {
        try {
            if ($cliente->id) {
                $this->update($cliente);
            } else {
                $this->add($cliente);
            }
            return ['success' => true];
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return ['success' => false, 'message' => 'Erro: Este CPF/CNPJ já está cadastrado.'];
            }
            return ['success' => false, 'message' => 'Erro no banco de dados.'];
        }
    }

    private function add(Cliente $cliente): bool {
        $sql = "INSERT INTO clientes (nome, cpf_cnpj, email, telefone) VALUES (:nome, :cpf_cnpj, :email, :telefone)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $cliente->nome,
            ':cpf_cnpj' => $cliente->cpf_cnpj,
            ':email' => $cliente->email,
            ':telefone' => $cliente->telefone
        ]);
    }

    private function update(Cliente $cliente): bool {
        $sql = "UPDATE clientes SET nome = :nome, cpf_cnpj = :cpf_cnpj, email = :email, telefone = :telefone WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $cliente->nome,
            ':cpf_cnpj' => $cliente->cpf_cnpj,
            ':email' => $cliente->email,
            ':telefone' => $cliente->telefone,
            ':id' => $cliente->id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>