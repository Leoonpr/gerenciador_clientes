# Gerenciador de Clientes

Sistema simples de CRUD (Create, Read, Update, Delete) de clientes desenvolvido como solução para um teste técnico.

---

## Demonstração Online

**Acesse a aplicação funcionando em tempo real no link abaixo:**

[➡️ **Clique aqui para ver a demonstração**](http://clientes-gerenciador.rf.gd/)

---

## Tecnologias Utilizadas

* **Backend:** PHP 8+
* **Frontend:** HTML5, Bootstrap 5, JavaScript, JQuery
* **Banco de Dados:** MySQL
* **Arquitetura:** MVC (Model-View-Controller)

## Como Rodar a Solução Localmente

Siga os passos abaixo para executar o projeto em seu ambiente local.

### Pré-requisitos

* Um servidor web local (XAMPP, WAMP, MAMP, ou similar) com suporte a PHP e MySQL.
* Git instalado.

### Passos

1.  **Clone o repositório:**
   Abra seu terminal e execute o seguinte comando:
    ```bash
    git clone [https://github.com/Leoonpr/gerenciador_clientes.git](https://github.com/Leoonpr/gerenciador_clientes.git)
    ```
    Em seguida, acesse a pasta do projeto:
    ```bash
    cd gerenciador_clientes
    ```

2.  **Crie o Banco de Dados:**
    * Acesse seu gerenciador de banco de dados (ex: phpMyAdmin).
    * Crie um novo banco de dados chamado `gerenciador_clientes`.
    * Importe o arquivo `script.sql` (ou copie e cole o script SQL abaixo) para criar a tabela `clientes`.

    ```sql
    CREATE TABLE `clientes` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `nome` VARCHAR(255) NOT NULL,
      `cpf_cnpj` VARCHAR(20) NOT NULL UNIQUE,
      `email` VARCHAR(255) NOT NULL,
      `telefone` VARCHAR(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ```

3.  **Configure a Conexão:**
    * Abra o arquivo `/config/database.php`.
    * Altere as constantes `DB_USER` e `DB_PASS` com suas credenciais de acesso ao banco de dados MySQL.
    ```php
    define('DB_USER', 'SEU_NOME_DE_USUARIO'); // ex: root
    define('DB_PASS', 'SUA_SENHA');   // ex: ""
    ```

4.  **Inicie o Servidor:**
    * Coloque a pasta do projeto no diretório do seu servidor web (ex: `htdocs` no XAMPP).
    * Inicie os serviços Apache e MySQL.
    * Abra seu navegador e acesse
    * Ou utilize o comando ```php -S localhost:8080```
      

