CREATE TABLE classes (
  classe_id INT AUTO_INCREMENT PRIMARY KEY,
  classe_nome VARCHAR(20) NOT NULL UNIQUE
);

CREATE TABLE aventureiros (
  aventureiro_id INT AUTO_INCREMENT PRIMARY KEY,
  aventureiro_nome VARCHAR(20) NOT NULL,
  status ENUM('Y', 'N') NOT NULL DEFAULT 'Y',
  xp INT NOT NULL DEFAULT 0,
  data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  classe_id INT NOT NULL,
  user_id INT NOT NULL,
  FOREIGN KEY (classe_id) REFERENCES classes(classe_id),
);

CREATE TABLE missao (
  missao_id INT AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE missoes_relacao (
  missao_id INT NOT NULL,
  aventureiro_id INT NOT NULL,
  PRIMARY KEY (missao_id, aventureiro_id),
  FOREIGN KEY (missao_id) REFERENCES missao(missao_id),
  FOREIGN KEY (aventureiro_id) REFERENCES aventureiros(aventureiro_id)
);

SELECT * FROM usuarios