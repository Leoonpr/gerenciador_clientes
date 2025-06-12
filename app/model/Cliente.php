<?php

class Cliente {

    public ?int $id;
    public string $nome;
    public string $cpf_cnpj;
    public string $email;
    public string $telefone;

    public function __construct(string $nome = '', string $cpf_cnpj = '', string $email = '', string $telefone = '', ?int $id = null) {
        $this->nome = $nome;
        $this->cpf_cnpj = $cpf_cnpj;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->id = $id;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf_cnpj' => $this->cpf_cnpj,
            'email' => $this->email,
            'telefone' => $this->telefone
        ];
    }
}
?>