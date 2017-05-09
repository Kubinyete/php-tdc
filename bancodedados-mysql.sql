/**
 * Criando o banco de dados
 */

CREATE DATABASE phptdc;
USE phptdc;

/**
 * Criando tabelas
 */

CREATE TABLE Aliancas (
	-- Não vamos manipular apenas uma aliança, portanto precisamos de uma tabela de alianças
	ali_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	ali_nome VARCHAR(64) NOT NULL
);

CREATE TABLE Grupos (
	-- Cada grupo deve pertencer a uma aliança
	-- Máximo de grupos: 3
	ali_id FOREIGN KEY REFERENCES Aliancas(ali_id),
	grp_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	grp_nome VARCHAR(64) NULL
);

CREATE TABLE Jogadores (
	jgd_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	jgd_nome VARCHAR(64) NULL,
	jgd_nickname VARCHAR(64) NOT NULL,
	jgd_nivel INT NOT NULL DEFAULT 0,
	jgd_telefone VARCHAR(16) NULL,
	jgd_email VARCHAR(64) NOT NULL,
	jgd_tipo TINYINT(1) NOT NULL DEFAULT 0,
	-- Tipos de jogador
	-- 0 - Jogador normal
	-- 1 - Jogador moderador
	-- 2 - Jogador líder
	jgd_status TINYINT(1) NOT NULL DEFAULT 1,
	jgd_observacoes VARCHAR(256) NULL
); 

-- Tabela que controla quais jogadores estão em quais grupos
-- Relação MUITOS -> MUITOS
CREATE TABLE JogadoresEmGrupos (
	grp_id FOREIGN KEY REFERENCES Grupos(grp_id),
	jgd_id FOREIGN KEY REFERENCES Jogadores(jgd_id)
);

CREATE TABLE Mapas (
	map_id INT PRIMARY KEY AUTO_INCREMENT,
	map_nome VARCHAR(64) NOT NULL
);

-- TODO:
-- Adicionar os mapas na hora da criação do banco de dados,
-- Pois os mesmos são estáticos e nunca mudarão

CREATE TABLE Missoes (
	mis_id INT NOT NULL,
	map_id FOREIGN KEY REFERENCES Mapas(map_id),
	-- mis_pontualcao_total -> poderá ser obtida através da soma de pontos de cada jogador em uma missão
	mis_vitoria TINYINT(1) NOT NULL DEFAULT 0,
	mis_percentual_explorado TINYINT(1) NOT NULL DEFAULT 0,
);

-- TODO:
-- O restante...
