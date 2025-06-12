<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'gerenciador_clientes');
define('DB_USER', 'SEU_NOME_DE_USUARIO');
define('DB_PASS', 'SUA_SENHA');  

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>