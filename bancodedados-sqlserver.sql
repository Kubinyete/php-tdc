-- -----------------------------------------------------
-- Table grupos
-- -----------------------------------------------------
CREATE TABLE grupos (					
  gr_id INT PRIMARY KEY IDENTITY(1,1),      
  gr_nome VARCHAR(45) NULL,
  );

-- -----------------------------------------------------
-- Table jogadores
-- -----------------------------------------------------
CREATE TABLE jogadores (
  jo_id INT PRIMARY KEY IDENTITY(1,1),
  jo_nome VARCHAR(90) NULL,
  jo_nickname VARCHAR(90) NULL,
  jo_nivel INT NULL,
  jo_fone VARCHAR(45) NULL,
  jo_email VARCHAR(90) NULL,
  jo_tipo VARCHAR(90) NULL,
  jo_status BIT NULL,
  jo_obs TEXT NULL,
  gr_id INT NOT NULL,
  
  CONSTRAINT fk_jogadores_grupos1
  FOREIGN KEY (gr_id)
  REFERENCES grupos(gr_id)
  );


-- -----------------------------------------------------
-- Table mapas
-- -----------------------------------------------------
CREATE TABLE  mapas (
  ma_id INT PRIMARY KEY IDENTITY(1,1),
  ma_nome VARCHAR(90) NULL,
  );


-- -----------------------------------------------------
-- Table missoes
-- -----------------------------------------------------
CREATE TABLE  missoes (
  mi_id INT PRIMARY KEY IDENTITY(1,1),
  mapas_ma_id INT NOT NULL,
  mi_pontuacaototal INT NULL,
  mi_vitoria BIT NULL,
  mi_explorado INT NULL, --COMMENT 'Percentual de conclusão da missão.'
  CONSTRAINT fk_missoes_mapas1
    FOREIGN KEY (mapas_ma_id)
    REFERENCES mapas(ma_id)
    );



-- -----------------------------------------------------
-- Table jogadoresmissoes
-- -----------------------------------------------------
CREATE TABLE  jogadoresmissoes (
  jo_id INT NOT NULL,
  mi_id INT NOT NULL,
  gr_id INT NOT NULL,
  jm_pontuacao INT NULL,
  PRIMARY KEY (jo_id, mi_id),

  CONSTRAINT fk_jogadores_has_missoes1_jogadores1
    FOREIGN KEY (jo_id)
    REFERENCES jogadores (jo_id),

  CONSTRAINT fk_jogadores_has_missoes1_missoes1
    FOREIGN KEY (mi_id)
    REFERENCES missoes (mi_id),

  CONSTRAINT fk_jogadoresmissoes_grupos1
    FOREIGN KEY (gr_id)
    REFERENCES grupos (gr_id)
	);


-- -----------------------------------------------------
-- Table guerras
-- -----------------------------------------------------
CREATE TABLE  guerras (
  gue_id INT PRIMARY KEY IDENTITY(1,1),
  mapas_ma_id INT NOT NULL,
  gue_pontuacaototal INT NULL,
  gue_vitoria BIT NULL,


  CONSTRAINT fk_guerras_mapas1
    FOREIGN KEY (mapas_ma_id)
    REFERENCES mapas (ma_id)
	);
    --ON DELETE NO ACTION
    --ON UPDATE NO ACTION) NÃO É INTERESSANTE ESSAS DUAS LINHAS EM UM DB.



-- -----------------------------------------------------
-- Table jogadoresguerras
-- -----------------------------------------------------
CREATE TABLE  jogadoresguerras (
  jogadores_jo_id INT NOT NULL,
  Guerras_gue_id INT NOT NULL,
  grupos_gr_id INT NOT NULL,
  jg_pontuacao INT NULL,
  PRIMARY KEY (jogadores_jo_id, Guerras_gue_id),

  CONSTRAINT fk_jogadores_has_Guerras_jogadores1
    FOREIGN KEY (jogadores_jo_id)
    REFERENCES jogadores (jo_id),

  CONSTRAINT fk_jogadores_has_guerras_guerras1
    FOREIGN KEY (Guerras_gue_id)
    REFERENCES guerras (gue_id),

  CONSTRAINT fk_jogadores_has_Guerras_grupos1
    FOREIGN KEY (grupos_gr_id)
    REFERENCES grupos (gr_id)
	);


--SET SQL_MODE=@OLD_SQL_MODE;
--SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
--SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
