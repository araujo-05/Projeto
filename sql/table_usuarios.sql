CREATE  TABLE usuarios(
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(255) NOT NULL DEFAULT '',
email VARCHAR(255) NOT NULL DEFAULT '(vazio)',
usuario VARCHAR(255) NOT NULL UNIQUE,
senha VARCHAR(255) NOT NULL DEFAULT '',
telefone VARCHAR(15) NOT NULL,
adm VARCHAR(1) NOT NULL DEFAULT 'N',
ativo VARCHAR(1) NOT NULL DEFAULT 'N'
);

INSERT INTO usuarios(nome, email, usuario, senha, telefone, adm, ativo)
VALUES('Abraão Castro', 'abraao.ar05@gmail.com', 'abraaoc', '#wks#1793', 11971083685 , 'S', 'S');


SELECT * FROM usuarios;


