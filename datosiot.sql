-- -----------------------------------------------------
-- Schema DatosIoT
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DatosIoT` DEFAULT CHARACTER SET utf8 ;
USE `DatosIoT` ;

-- -----------------------------------------------------
-- Table `DatosIoT`.`registro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DatosIoT`.`registro` (
  `idregistro` INT NOT NULL AUTO_INCREMENT,
  `temperatura` FLOAT NOT NULL,
  `humedad` FLOAT NOT NULL,
  `fecha_hora` TIMESTAMP NOT NULL,
  PRIMARY KEY (`idregistro`))
ENGINE = InnoDB;