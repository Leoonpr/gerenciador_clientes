CREATE DATABASE `gerenciador_clientes`;

USE `gerenciador_clientes`;

CREATE TABLE `clientes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `cpf_cnpj` VARCHAR(20) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;