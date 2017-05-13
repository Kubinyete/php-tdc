/**
 * Criando o banco de dados
 */

CREATE DATABASE phptdc;
USE phptdc;

/**
 * Criando tabelas
 */

CREATE TABLE Usuarios (
	usr_id INT PRIMARY KEY AUTO_INCREMENT,
	usr_login VARCHAR(16) NOT NULL,
	-- senha -> sha256 64 carácteres
	usr_senha CHAR(64) NOT NULL
);

CREATE TABLE Aliancas (
	FOREIGN KEY usr_id INT REFERENCES Usuarios(usr_id),
	-- Não vamos manipular apenas uma aliança, portanto precisamos de uma tabela de alianças
	ali_id INT PRIMARY KEY AUTO_INCREMENT,
	ali_nome VARCHAR(64) CHARSET UTF8 NOT NULL,
	ali_data_criacao DATETIME NOT NULL DEFAULT NOW()
);

CREATE TABLE Grupos (
	-- Cada grupo deve pertencer a uma aliança
	-- Máximo de grupos: 3
	FOREIGN KEY ali_id INT REFERENCES Aliancas(ali_id),
	grp_id INT PRIMARY KEY AUTO_INCREMENT,
	grp_nome VARCHAR(64) CHARSET UTF8 NULL
);

CREATE TABLE Jogadores (
	FOREIGN KEY ali_id INT REFERENCES Aliancas(ali_id),
	jgd_id INT PRIMARY KEY AUTO_INCREMENT,
	jgd_nome VARCHAR(64) CHARSET UTF8 NULL,
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
	jgd_observacoes VARCHAR(256) CHARSET UTF8 NULL,
	jgd_data_criacao DATETIME NOT NULL DEFAULT NOW()
); 

-- Tabela que controla quais jogadores estão em quais grupos
-- Relação MUITOS -> MUITOS
CREATE TABLE JogadoresEmGrupos (
	FOREIGN KEY grp_id INT REFERENCES Grupos(grp_id),
	FOREIGN KEY jgd_id INT REFERENCES Jogadores(jgd_id),
	jeu_data_adicionado DATETIME NOT NULL DEFAULT NOW()
);

CREATE TABLE Mapas (
	map_id INT PRIMARY KEY AUTO_INCREMENT,
	map_nome VARCHAR(64) CHARSET UTF8 NOT NULL
);

-- TODO:
-- Adicionar os mapas na hora da criação do banco de dados,
-- Pois os mesmos são estáticos e nunca mudarão

CREATE TABLE Missoes (
	FOREIGN KEY ali_id INT REFERENCES Aliancas(ali_id),
	mis_id INT NOT NULL,
	FOREIGN KEY map_id INT REFERENCES Mapas(map_id),
	-- mis_pontuacao_total -> poderá ser obtida através da soma de pontos de cada jogador em uma missão.
	mis_vitoria TINYINT(1) NOT NULL DEFAULT 0,
	mis_percentual_explorado TINYINT(1) NOT NULL DEFAULT 0,
	mis_data_criacao DATETIME NOT NULL DEFAULT NOW()
);

CREATE TABLE JogadoresEmMissoes (
	FOREIGN KEY jgd_id INT REFERENCES Jogadores(jgd_id),
	FOREIGN KEY mis_id INT REFERENCES Missoes(mis_id),
	FOREIGN KEY grp_id INT REFERENCES Grupos(grp_id),
	jem_pontuacao INT NOT NULL DEFAULT 0
);

CREATE TABLE Guerras (
	grr_id INT PRIMARY KEY AUTO_INCREMENT,
	-- map_id -> Só temos um mapa para guerras, não necessário
	-- grr_pontuacao_total -> poderá ser obtido através da soma de pontos de cada jogador em uma guerra.
	grr_vitoria TINYINT(1) NOT NULL DEFAULT 0,
	grr_data_criacao DATETIME NOT NULL DEFAULT NOW()
);

CREATE TABLE JogadoresEmGuerras (
	FOREIGN KEY jgd_id INT REFERENCES Jogadores(jgd_id),
	FOREIGN KEY grr_id INT REFERENCES Guerras(grr_id),
	FOREIGN KEY grp_id INT REFERENCES Grupos(grp_id),
	jeg_pontuacao INT NOT NULL DEFAULT 0
);
