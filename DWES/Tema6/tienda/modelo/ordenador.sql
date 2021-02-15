USE bdtienda;

CREATE TABLE IF NOT EXISTS ordenador (
  cod varchar(12) NOT NULL,
  procesador varchar(50) NOT NULL,
  RAM int(11) NOT NULL,
  disco varchar(50) NOT NULL,
  grafica varchar(50) NOT NULL,
  unidadoptica varchar(50) NOT NULL,
  SO varchar(50) NOT NULL,
  otros varchar(250) DEFAULT NULL,
  PRIMARY KEY (cod)
) ENGINE=InnoDB;

-- Insertamos los datos en la tabla `ordenador`
INSERT INTO `ordenador` (`cod`, `procesador`, `RAM`, `disco`, `grafica`, `unidadoptica`, `SO`, `otros`) VALUES
('ACERAX3950', 'Intel Core i5-650', 4, '1 disco SATA2 1TB', 'Nvidia GT320 1GB', 'DVD+-R DL 16x', 'Windows 7 Home Premium', NULL),
('PBELLI810323', 'Intel Core i3-550', 4, '1 disco SATA2 640GB', 'Nvidia G210M D3 512MB', 'DVD+-R DL', 'Windows 7 Home Premium', 'Equpo integrado con pantalla táctil 16:9 HD 23"');
