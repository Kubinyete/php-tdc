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
	usr_senha CHAR(64) NOT NULL,
	usr_data_criacao DATETIME NOT NULL DEFAULT NOW()
);

CREATE TABLE Aliancas (
	usr_id INT NOT NULL,
	ali_id INT PRIMARY KEY AUTO_INCREMENT,
	ali_nome VARCHAR(64) CHARSET UTF8 NOT NULL,
	ali_data_criacao DATETIME NOT NULL DEFAULT NOW(),

	FOREIGN KEY (usr_id) REFERENCES Usuarios(usr_id)
);

CREATE TABLE Grupos (
	ali_id int NOT NULL,
	grp_id INT PRIMARY KEY AUTO_INCREMENT,
	grp_nome VARCHAR(64) CHARSET UTF8 NULL,
	grp_data_criacao DATETIME  NOT NULL DEFAULT NOW(),

	FOREIGN KEY (ali_id) REFERENCES Aliancas(ali_id)
);

CREATE TABLE Jogadores (
	ali_id INT NOT NULL,
	jgd_id INT PRIMARY KEY AUTO_INCREMENT,
	jgd_nome VARCHAR(64) CHARSET UTF8 NULL,
	jgd_nickname VARCHAR(64) NOT NULL,
	jgd_nivel INT NOT NULL DEFAULT 0,
	jgd_telefone VARCHAR(16) NULL,
	jgd_email VARCHAR(64) NOT NULL,
	jgd_tipo TINYINT(1) NOT NULL DEFAULT 0,
	jgd_status TINYINT(1) NOT NULL DEFAULT 1,
	jgd_observacoes VARCHAR(256) CHARSET UTF8 NULL,
	jgd_data_criacao DATETIME NOT NULL DEFAULT NOW(),

	FOREIGN KEY (ali_id) REFERENCES Aliancas(ali_id)
); 

-- Tabela que controla quais jogadores estão em quais grupos
-- Relação MUITOS -> MUITOS
CREATE TABLE JogadoresEmGrupos (
	grp_id INT NOT NULL,
	jgd_id INT NOT NULL,
	jeu_data_adicionado DATETIME NOT NULL DEFAULT NOW(),

	FOREIGN KEY (grp_id) REFERENCES Grupos(grp_id),
	FOREIGN KEY (jgd_id) REFERENCES Jogadores(jgd_id)
);

CREATE TABLE Mapas (
	map_id INT PRIMARY KEY AUTO_INCREMENT,
	map_nome VARCHAR(64) CHARSET UTF8 NOT NULL
);

-- Criando os mapas padrões
INSERT INTO Mapas(map_nome)
VALUES ('Mapa 1');
INSERT INTO Mapas(map_nome)
VALUES ('Mapa 2');
INSERT INTO Mapas(map_nome)
VALUES ('Mapa 3');
INSERT INTO Mapas(map_nome)
VALUES ('Mapa 4');
INSERT INTO Mapas(map_nome)
VALUES ('Mapa 5');
INSERT INTO Mapas(map_nome)
VALUES ('Mapa 6');

CREATE TABLE Missoes (
	ali_id INT NOT NULL,
	map_id INT NOT NULL,
	mis_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	mis_vitoria TINYINT(1) NOT NULL DEFAULT 0,
	mis_percentual_explorado TINYINT(1) NOT NULL DEFAULT 0,
	mis_data_criacao DATETIME NOT NULL DEFAULT NOW(),

	FOREIGN KEY (ali_id) REFERENCES Aliancas(ali_id),
	FOREIGN KEY (map_id) REFERENCES Mapas(map_id)
);

CREATE TABLE JogadoresEmMissoes (
	jgd_id INT NOT NULL,
	mis_id INT NOT NULL,
	grp_id INT NOT NULL,
	jem_pontuacao INT NOT NULL DEFAULT 0,

	FOREIGN KEY (jgd_id) REFERENCES Jogadores(jgd_id),
	FOREIGN KEY (mis_id) REFERENCES Missoes(mis_id),
	FOREIGN KEY (grp_id) REFERENCES Grupos(grp_id)
);

CREATE TABLE Guerras (
	ali_id INT NOT NULL,
	grr_id INT PRIMARY KEY AUTO_INCREMENT,
	grr_nome_adversario VARCHAR(64) CHARSET UTF8 NOT NULL, 
	grr_vitoria TINYINT(1) NOT NULL DEFAULT 0,
	grr_data_criacao DATETIME NOT NULL DEFAULT NOW(),

	FOREIGN KEY (ali_id) REFERENCES Aliancas(ali_id)
);

CREATE TABLE JogadoresEmGuerras (
	jgd_id INT NOT NULL,
	grr_id INT NOT NULL,
	grp_id INT NOT NULL,
	jeg_pontuacao INT NOT NULL DEFAULT 0,

	FOREIGN KEY (jgd_id) REFERENCES Jogadores(jgd_id),
	FOREIGN KEY (grr_id) REFERENCES Guerras(grr_id),
	FOREIGN KEY (grp_id) REFERENCES Grupos(grp_id)
);
