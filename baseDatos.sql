/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.6.4-MariaDB : Database - gestorbase
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `app_areas` */

DROP TABLE IF EXISTS `app_areas`;

CREATE TABLE `app_areas` (
  `idArea` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreArea` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idArea`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `app_auditoria_general` */

DROP TABLE IF EXISTS `app_auditoria_general`;

CREATE TABLE `app_auditoria_general` (
  `idAuditoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipoAuditoria` text DEFAULT NULL,
  `textAuditoria` text DEFAULT NULL,
  `idUsuario` bigint(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idAuditoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `app_cargos` */

DROP TABLE IF EXISTS `app_cargos`;

CREATE TABLE `app_cargos` (
  `idCargo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreCargo` text DEFAULT NULL,
  `especialista` int(11) DEFAULT 0,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idCargo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `app_cesantias` */

DROP TABLE IF EXISTS `app_cesantias`;

CREATE TABLE `app_cesantias` (
  `id_app_cesantias` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombrefondocesantias` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`id_app_cesantias`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `app_citas` */

DROP TABLE IF EXISTS `app_citas`;

CREATE TABLE `app_citas` (
  `idCita` bigint(20) NOT NULL AUTO_INCREMENT,
  `idServicio` bigint(20) DEFAULT NULL,
  `idEspecialista` bigint(20) DEFAULT NULL,
  `idPaciente` bigint(20) DEFAULT NULL,
  `fechaCita` date DEFAULT NULL,
  `horaCita` time DEFAULT NULL,
  `fechaFinCita` date DEFAULT NULL,
  `horaFinCita` time DEFAULT NULL,
  `usuarioCrea` bigint(20) DEFAULT NULL,
  `fechaCrea` datetime DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `tomada` int(11) DEFAULT 1,
  `observaciones` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idCita`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Table structure for table `app_ciudades` */

DROP TABLE IF EXISTS `app_ciudades`;

CREATE TABLE `app_ciudades` (
  `ID_PAIS` varchar(10) NOT NULL,
  `ID_DPTO` varchar(10) NOT NULL,
  `ID_CIUDAD` varchar(10) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`ID_PAIS`,`ID_DPTO`,`ID_CIUDAD`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `app_departamentos` */

DROP TABLE IF EXISTS `app_departamentos`;

CREATE TABLE `app_departamentos` (
  `ID_PAIS` varchar(10) NOT NULL,
  `ID_DPTO` varchar(10) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`ID_PAIS`,`ID_DPTO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `app_empresas` */

DROP TABLE IF EXISTS `app_empresas`;

CREATE TABLE `app_empresas` (
  `idEmpresa` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` text DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` text DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `departamento` int(11) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `tipoDocumento` int(11) DEFAULT NULL,
  `nroDocumento` int(11) DEFAULT NULL,
  `tipoActividad` int(11) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `nombreEncargado` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `ultimoIngreso` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `app_estadopago` */

DROP TABLE IF EXISTS `app_estadopago`;

CREATE TABLE `app_estadopago` (
  `idPago` bigint(20) NOT NULL AUTO_INCREMENT,
  `idEmpresa` bigint(20) DEFAULT NULL,
  `esDemo` int(11) DEFAULT 1,
  `descripcion` text DEFAULT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `cantComprada` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idPago`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `app_estados` */

DROP TABLE IF EXISTS `app_estados`;

CREATE TABLE `app_estados` (
  `idEstado` int(11) NOT NULL,
  `nombreEstado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `app_lista_religiones` */

DROP TABLE IF EXISTS `app_lista_religiones`;

CREATE TABLE `app_lista_religiones` (
  `id_religion` bigint(20) NOT NULL AUTO_INCREMENT,
  `des_religiones` text DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_religion`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

/*Table structure for table `app_listado_afp` */

DROP TABLE IF EXISTS `app_listado_afp`;

CREATE TABLE `app_listado_afp` (
  `id_afp` bigint(20) NOT NULL AUTO_INCREMENT,
  `des_afp` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`id_afp`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Table structure for table `app_listado_eps` */

DROP TABLE IF EXISTS `app_listado_eps`;

CREATE TABLE `app_listado_eps` (
  `id_eps` bigint(20) NOT NULL AUTO_INCREMENT,
  `des_eps` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`id_eps`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Table structure for table `app_listas` */

DROP TABLE IF EXISTS `app_listas`;

CREATE TABLE `app_listas` (
  `idLista` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idLista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `app_login` */

DROP TABLE IF EXISTS `app_login`;

CREATE TABLE `app_login` (
  `idLogin` bigint(20) NOT NULL AUTO_INCREMENT,
  `idGeneral` bigint(20) DEFAULT NULL,
  `tipoLogin` int(11) DEFAULT NULL,
  `usuario` text DEFAULT NULL,
  `clave` text DEFAULT NULL,
  `clave64` text DEFAULT NULL,
  `cambioClave` int(11) DEFAULT 1,
  `primeraVez` int(11) DEFAULT 1,
  `verificado` int(11) DEFAULT 0,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idLogin`)
) ENGINE=InnoDB AUTO_INCREMENT=539 DEFAULT CHARSET=latin1;

/*Table structure for table `app_mails` */

DROP TABLE IF EXISTS `app_mails`;

CREATE TABLE `app_mails` (
  `idMail` bigint(20) NOT NULL AUTO_INCREMENT,
  `para` text DEFAULT NULL,
  `asunto` text DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `fechaEnvio` datetime DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idMail`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `app_modulos` */

DROP TABLE IF EXISTS `app_modulos`;

CREATE TABLE `app_modulos` (
  `idModulo` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPadre` bigint(20) DEFAULT NULL,
  `nombreModulo` text DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `urlModulo` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `orden` int(11) DEFAULT 0,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idModulo`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Table structure for table `app_paises` */

DROP TABLE IF EXISTS `app_paises`;

CREATE TABLE `app_paises` (
  `ID_PAIS` varchar(10) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_PAIS`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `app_perfiles` */

DROP TABLE IF EXISTS `app_perfiles`;

CREATE TABLE `app_perfiles` (
  `idPerfil` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombrePerfil` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `app_personas` */

DROP TABLE IF EXISTS `app_personas`;

CREATE TABLE `app_personas` (
  `idPersona` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPerfil` int(11) DEFAULT NULL,
  `nombre` text DEFAULT NULL,
  `apellido` text DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` text DEFAULT NULL,
  `celular` text DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `departamento` int(11) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `tipoDocumento` int(11) DEFAULT NULL,
  `nroDocumento` bigint(20) DEFAULT NULL,
  `tarjetaProfesional` text DEFAULT NULL,
  `idCargo` bigint(20) DEFAULT NULL,
  `salario` text DEFAULT NULL,
  `cuenta` text DEFAULT NULL,
  `idArea` bigint(20) DEFAULT NULL,
  `idSexo` int(11) DEFAULT NULL,
  `idProfesion` text DEFAULT NULL,
  `tipoUsuario` int(11) DEFAULT 2,
  `ciudadExpedicionCedula` varchar(10) DEFAULT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `contrato` text DEFAULT NULL,
  `fechaIngreso` date DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `barrio` tinytext DEFAULT NULL,
  `titulo` tinytext DEFAULT NULL,
  `institucion` tinytext DEFAULT NULL,
  `fechaRetiro` date DEFAULT NULL,
  `id_eps` bigint(20) DEFAULT NULL,
  `id_afp` bigint(20) DEFAULT NULL,
  `id_app_cesantias` bigint(20) DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `ultimoIngreso` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Table structure for table `app_pertenencia_etnica` */

DROP TABLE IF EXISTS `app_pertenencia_etnica`;

CREATE TABLE `app_pertenencia_etnica` (
  `id_grupo_etnico` bigint(20) NOT NULL AUTO_INCREMENT,
  `grupo_etnia` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`id_grupo_etnico`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `app_profesiones` */

DROP TABLE IF EXISTS `app_profesiones`;

CREATE TABLE `app_profesiones` (
  `idProfesion` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreProfesion` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idProfesion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `app_registroslogin` */

DROP TABLE IF EXISTS `app_registroslogin`;

CREATE TABLE `app_registroslogin` (
  `idRegistro` bigint(20) NOT NULL AUTO_INCREMENT,
  `idLogin` bigint(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `disp` text DEFAULT NULL,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idRegistro`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=latin1;

/*Table structure for table `app_rel_perfil_modulo` */

DROP TABLE IF EXISTS `app_rel_perfil_modulo`;

CREATE TABLE `app_rel_perfil_modulo` (
  `idRelacion` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPerfil` bigint(20) DEFAULT NULL,
  `idModulo` bigint(20) DEFAULT NULL,
  `ver` int(11) DEFAULT 0,
  `crear` int(11) DEFAULT 0,
  `editar` int(11) DEFAULT 0,
  `borrar` int(11) DEFAULT 0,
  PRIMARY KEY (`idRelacion`)
) ENGINE=InnoDB AUTO_INCREMENT=451 DEFAULT CHARSET=latin1;

/*Table structure for table `app_rel_personas_empresa` */

DROP TABLE IF EXISTS `app_rel_personas_empresa`;

CREATE TABLE `app_rel_personas_empresa` (
  `idRelPerEmp` bigint(20) NOT NULL AUTO_INCREMENT,
  `idEmpresa` bigint(20) DEFAULT NULL,
  `idPersona` bigint(20) DEFAULT NULL,
  `fechaRelacion` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idRelPerEmp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `app_sexo` */

DROP TABLE IF EXISTS `app_sexo`;

CREATE TABLE `app_sexo` (
  `idSexo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreSexo` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idSexo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `app_tipos_doc` */

DROP TABLE IF EXISTS `app_tipos_doc`;

CREATE TABLE `app_tipos_doc` (
  `idTipoDoc` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreTipoDoc` text DEFAULT NULL,
  `sigla` varchar(5) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idTipoDoc`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `app_variablesglobales` */

DROP TABLE IF EXISTS `app_variablesglobales`;

CREATE TABLE `app_variablesglobales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variable` text NOT NULL,
  `valor` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `aud_areas` */

DROP TABLE IF EXISTS `aud_areas`;

CREATE TABLE `aud_areas` (
  `idAuditoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `idArea` bigint(20) DEFAULT NULL,
  `textAuditoria` text DEFAULT NULL,
  `idUsuario` bigint(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idAuditoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
