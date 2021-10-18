-- -----------------------------------------------------
-- Schema datosiot
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema datosiot
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `datosiot` DEFAULT CHARACTER SET utf8 ;
USE `datosiot` ;

-- -----------------------------------------------------
-- Table `datosiot`.`registro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `datosiot`.`registro` (
  `idregistro` INT NOT NULL AUTO_INCREMENT,
  `humedad` FLOAT NOT NULL,
  `temperatura` FLOAT NOT NULL,
  `lluvia` BOOLEAN NOT NULL,
  `fecha_hora` TIMESTAMP NOT NULL,
  PRIMARY KEY (`idregistro`))
ENGINE = InnoDB;
