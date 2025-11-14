CREATE DATABASE unipe_db;
USE unipe_db;

-- Configurações iniciais para garantir a consistência do banco de dados
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ----------------------------------------------------------
-- Tabela: Usuarios
-- Armazena os dados de login e informações básicas comuns a todos.
--
CREATE TABLE `Usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(100) NOT NULL,
  `sobrenome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `senha_hash` VARCHAR(255) NOT NULL,
  `tipo_usuario` ENUM('Aluno', 'Professor', 'Admin') NOT NULL,
  `data_cadastro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `status` ENUM('Ativo', 'Inativo') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- Tabela: Alunos
-- Armazena os dados pessoais e de correspondência dos alunos.
--
CREATE TABLE `Alunos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario_id` INT NOT NULL UNIQUE,
  `cpf` VARCHAR(14) NOT NULL UNIQUE,
  `rg` VARCHAR(20),
  `data_nascimento` DATE NOT NULL,
  `genero` ENUM('Masculino', 'Feminino', 'Outro'),
  `telefone` VARCHAR(20),
  `cep` VARCHAR(9),
  `endereco` VARCHAR(255),
  `numero` VARCHAR(10),
  `complemento` VARCHAR(100),
  `bairro` VARCHAR(100),
  `cidade` VARCHAR(100),
  `estado` VARCHAR(2),
  FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- Tabela: Professores
-- Armazena dados específicos dos professores.
--
CREATE TABLE `Professores` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario_id` INT NOT NULL UNIQUE,
  `cpf` VARCHAR(14) NOT NULL UNIQUE,
  `telefone` VARCHAR(20),
  `qualificacao` TEXT COMMENT 'Ex: Doutorado em Engenharia de Software',
  FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- Tabela: Cursos
-- Lista os cursos ou disciplinas oferecidas.
--
CREATE TABLE `Cursos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome_curso` VARCHAR(255) NOT NULL,
  `descricao` TEXT,
  `carga_horaria` INT,
  `professor_id` INT,
  FOREIGN KEY (`professor_id`) REFERENCES `Professores`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- Tabela: Matriculas
-- Tabela de associação que liga um aluno a um curso.
--
CREATE TABLE `Matriculas` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `aluno_id` INT NOT NULL,
  `curso_id` INT NOT NULL,
  `data_matricula` DATE NOT NULL,
  `status` ENUM('Ativa', 'Concluida', 'Cancelada') NOT NULL DEFAULT 'Ativa',
  UNIQUE KEY `aluno_curso_unico` (`aluno_id`, `curso_id`),
  FOREIGN KEY (`aluno_id`) REFERENCES `Alunos`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`curso_id`) REFERENCES `Cursos`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- Tabela: ListaPresenca
-- Registra a presença de um aluno em uma aula de um determinado curso/matrícula.
--
CREATE TABLE `ListaPresenca` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `matricula_id` INT NOT NULL,
  `data_aula` DATE NOT NULL,
  `presente` BOOLEAN NOT NULL COMMENT '1 para Presente, 0 para Ausente',
  `observacoes` TEXT,
  FOREIGN KEY (`matricula_id`) REFERENCES `Matriculas`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- Tabela: RecuperacaoSenha
-- Armazena tokens para a redefinição de senha.
--
CREATE TABLE `RecuperacaoSenha` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario_id` INT NOT NULL,
  `token` VARCHAR(255) NOT NULL UNIQUE,
  `data_expiracao` DATETIME NOT NULL,
  `utilizado` BOOLEAN NOT NULL DEFAULT FALSE,
  FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;