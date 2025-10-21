-- Criação do schema
CREATE SCHEMA IF NOT EXISTS `bd_ong` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bd_ong`;

-- Desativa verificação de chaves estrangeiras temporariamente
SET FOREIGN_KEY_CHECKS = 0;

-- Dropa as tabelas na ordem correta
DROP TABLE IF EXISTS tb_calendario_projetos_has_tb_eventos;
DROP TABLE IF EXISTS tb_perfis;
DROP TABLE IF EXISTS tb_aulas_has_tb_usuarios;
DROP TABLE IF EXISTS tb_aulas;
DROP TABLE IF EXISTS tb_calendario_projetos;
DROP TABLE IF EXISTS tb_eventos;
DROP TABLE IF EXISTS tb_usuarios;
DROP TABLE IF EXISTS tb_ongs;

-- Ativa novamente
SET FOREIGN_KEY_CHECKS = 1;



-- Tabela ONGs
CREATE TABLE IF NOT EXISTS `tb_ongs` (
    `cd_ong` INT NOT NULL AUTO_INCREMENT,
    `nm_ong` VARCHAR(100) NOT NULL,
    `cnpj_ong` VARCHAR(14) NOT NULL,
    `nm_email` VARCHAR(100) NOT NULL,
    `nr_telefone` VARCHAR(15) NOT NULL,
    `nm_endereco` VARCHAR(150) NOT NULL,
    `nr_endereco` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`cd_ong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela Usuários
CREATE TABLE IF NOT EXISTS `tb_usuarios` (
    `cd_usuario` INT NOT NULL AUTO_INCREMENT,
    `nm_usuario` VARCHAR(100) NOT NULL,
    `cpf` VARCHAR(14) DEFAULT NULL,
    `cnpj` VARCHAR(14) DEFAULT NULL,
    `rg` VARCHAR(20) DEFAULT NULL,
    `dt_nascimento` DATE DEFAULT NULL,
    `nm_responsavel` VARCHAR(100) DEFAULT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `senha` VARCHAR(255) NOT NULL,
    `tipo_usuario` ENUM('administrador','voluntario','aluno') NOT NULL,
    `fk_cd_ong` INT NOT NULL,
    PRIMARY KEY (`cd_usuario`),
    CONSTRAINT `fk_usuarios_ongs` FOREIGN KEY (`fk_cd_ong`) REFERENCES `tb_ongs`(`cd_ong`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela Calendário de Projetos
CREATE TABLE IF NOT EXISTS `tb_calendario_projetos` (
    `cd_projeto` INT NOT NULL AUTO_INCREMENT,
    `nm_titulo_projeto` VARCHAR(100) NOT NULL,
    `ds_projeto` TEXT NOT NULL,
    `dt_inicio` DATE NOT NULL,
    `dt_termino` DATE NOT NULL,
    `st_projeto` VARCHAR(45) NOT NULL,
    `fk_cd_ong` INT NOT NULL,
    `fk_cd_administrador` INT NOT NULL,
    PRIMARY KEY (`cd_projeto`),
    CONSTRAINT `fk_calendario_projetos_ongs` FOREIGN KEY (`fk_cd_ong`) REFERENCES `tb_ongs`(`cd_ong`),
    CONSTRAINT `fk_calendario_projetos_usuarios` FOREIGN KEY (`fk_cd_administrador`) REFERENCES `tb_usuarios`(`cd_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela Aulas
CREATE TABLE IF NOT EXISTS `tb_aulas` (
    `cd_aula` INT NOT NULL AUTO_INCREMENT,
    `nm_aula` VARCHAR(100) NOT NULL,
    `dt_aula` DATE NOT NULL,
    `nm_local` VARCHAR(100) NOT NULL,
    `dt_inicio` DATE NOT NULL,
    `dt_termino` DATE NOT NULL,
    `fk_cd_ong` INT NOT NULL,
    `fk_cd_projeto` INT NOT NULL,
    PRIMARY KEY (`cd_aula`),
    CONSTRAINT `fk_aulas_ongs` FOREIGN KEY (`fk_cd_ong`) REFERENCES `tb_ongs`(`cd_ong`),
    CONSTRAINT `fk_aulas_calendario_projetos` FOREIGN KEY (`fk_cd_projeto`) REFERENCES `tb_calendario_projetos`(`cd_projeto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela Relação Aulas x Usuários (alunos inscritos)
CREATE TABLE IF NOT EXISTS `tb_aulas_has_tb_usuarios` (
    `fk_cd_aula` INT NOT NULL,
    `fk_cd_usuario` INT NOT NULL,
    PRIMARY KEY (`fk_cd_aula`, `fk_cd_usuario`),
    CONSTRAINT `fk_aulas_has_tb_aulas` FOREIGN KEY (`fk_cd_aula`) REFERENCES `tb_aulas`(`cd_aula`),
    CONSTRAINT `fk_aulas_has_tb_usuarios` FOREIGN KEY (`fk_cd_usuario`) REFERENCES `tb_usuarios`(`cd_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela Eventos
CREATE TABLE IF NOT EXISTS `tb_eventos` (
    `cd_evento` INT NOT NULL AUTO_INCREMENT,
    `nm_evento` VARCHAR(100) NOT NULL,
    `nm_local_evento` VARCHAR(100) NOT NULL,
    `dt_horario` DATETIME NOT NULL,
    `dt_dia` DATE NOT NULL,
    `img_evento` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`cd_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela Perfis (para exibir imagem e nome do perfil)
CREATE TABLE IF NOT EXISTS `tb_perfis` (
    `cd_perfil` INT NOT NULL AUTO_INCREMENT,
    `img_perfil` VARCHAR(255) NOT NULL,
    `nm_usuario` VARCHAR(100) NOT NULL,
    `fk_cd_usuario` INT NOT NULL,
    PRIMARY KEY (`cd_perfil`),
    CONSTRAINT `fk_perfis_usuarios` FOREIGN KEY (`fk_cd_usuario`) REFERENCES `tb_usuarios`(`cd_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Relacionamento Projeto x Evento
CREATE TABLE IF NOT EXISTS `tb_calendario_projetos_has_tb_eventos` (
    `fk_cd_projeto` INT NOT NULL,
    `fk_cd_evento` INT NOT NULL,
    PRIMARY KEY (`fk_cd_projeto`, `fk_cd_evento`),
    CONSTRAINT `fk_calendario_projetos_has_tb_eventos_projetos` FOREIGN KEY (`fk_cd_projeto`) REFERENCES `tb_calendario_projetos`(`cd_projeto`),
    CONSTRAINT `fk_calendario_projetos_has_tb_eventos_eventos` FOREIGN KEY (`fk_cd_evento`) REFERENCES `tb_eventos`(`cd_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================
-- Inserção inicial da ONG
-- =====================================
INSERT INTO tb_ongs (
    nm_ong, cnpj_ong, nm_email, nr_telefone, nm_endereco, nr_endereco
)
VALUES (
    'Espaço Tia Jú', '12345678000199', 'contato@tiaju.org', '13991234567', 'Rua Santa Cecilia', '560'
);

-- =====================================
-- Inserção de administrador válido
-- =====================================
-- Senha = admin123 (bcrypt gerado previamente)
INSERT INTO tb_usuarios (
    nm_usuario,
    email,
    senha,
    tipo_usuario,
    fk_cd_ong
)
VALUES (
    'Willian Administrador',
    'willianfeikk@gmail.com',
    '$2y$10$8eIo8l09DoKEK3UuZhYxwO0Tw4dfkIYBccgdEtU/xEDn5RQuCDnKq', -- "admin123"
    'administrador',
    1
);
