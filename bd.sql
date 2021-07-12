-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tpdam
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `relprestadorservicos`
--

DROP TABLE IF EXISTS `relprestadorservicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relprestadorservicos` (
  `codPrestadorServico` int(11) NOT NULL AUTO_INCREMENT,
  `disponibilidade1` datetime DEFAULT NULL,
  `disponibilidade2` datetime DEFAULT NULL,
  `disponibilidade3` datetime DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `obs` varchar(45) DEFAULT NULL,
  `tblServico_codServico` int(11) NOT NULL,
  `tblPrestador_codPrestador` int(11) NOT NULL,
  PRIMARY KEY (`codPrestadorServico`,`tblServico_codServico`,`tblPrestador_codPrestador`),
  KEY `fk_relPrestadorServicos_tblServico1_idx` (`tblServico_codServico`),
  KEY `fk_relPrestadorServicos_tblPrestador1_idx` (`tblPrestador_codPrestador`),
  CONSTRAINT `fk_relPrestadorServicos_tblPrestador1` FOREIGN KEY (`tblPrestador_codPrestador`) REFERENCES `tblprestador` (`codPrestador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_relPrestadorServicos_tblServico1` FOREIGN KEY (`tblServico_codServico`) REFERENCES `tblservico` (`codServico`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relprestadorservicos`
--

LOCK TABLES `relprestadorservicos` WRITE;
/*!40000 ALTER TABLE `relprestadorservicos` DISABLE KEYS */;
INSERT INTO `relprestadorservicos` VALUES (2,NULL,NULL,NULL,NULL,NULL,1,1);
/*!40000 ALTER TABLE `relprestadorservicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relreservaprestacaoservicos`
--

DROP TABLE IF EXISTS `relreservaprestacaoservicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relreservaprestacaoservicos` (
  `docReservaPrestacaoServicos` int(11) NOT NULL AUTO_INCREMENT,
  `codServico` int(11) DEFAULT NULL,
  `codPrestador` int(11) DEFAULT NULL,
  `dataInicio` datetime DEFAULT NULL,
  `dataFim` datetime DEFAULT NULL,
  `obs` varchar(45) DEFAULT NULL,
  `relPrestadorServicos_codPrestadorServico` int(11) NOT NULL,
  `relPrestadorServicos_tblServico_codServico` int(11) NOT NULL,
  `relPrestadorServicos_tblPrestador_codPrestador` int(11) NOT NULL,
  `tblUtente_codUtente` int(11) NOT NULL,
  `tblOperadores_codOpreador` int(11) NOT NULL,
  PRIMARY KEY (`docReservaPrestacaoServicos`,`relPrestadorServicos_codPrestadorServico`,`relPrestadorServicos_tblServico_codServico`,`relPrestadorServicos_tblPrestador_codPrestador`,`tblUtente_codUtente`,`tblOperadores_codOpreador`),
  KEY `fk_relReservaPrestacaoServicos_relPrestadorServicos1_idx` (`relPrestadorServicos_codPrestadorServico`,`relPrestadorServicos_tblServico_codServico`,`relPrestadorServicos_tblPrestador_codPrestador`),
  KEY `fk_relReservaPrestacaoServicos_tblUtente1_idx` (`tblUtente_codUtente`),
  KEY `fk_relReservaPrestacaoServicos_tblOperadores1_idx` (`tblOperadores_codOpreador`),
  CONSTRAINT `fk_relReservaPrestacaoServicos_relPrestadorServicos1` FOREIGN KEY (`relPrestadorServicos_codPrestadorServico`, `relPrestadorServicos_tblServico_codServico`, `relPrestadorServicos_tblPrestador_codPrestador`) REFERENCES `relprestadorservicos` (`codPrestadorServico`, `tblServico_codServico`, `tblPrestador_codPrestador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_relReservaPrestacaoServicos_tblOperadores1` FOREIGN KEY (`tblOperadores_codOpreador`) REFERENCES `tbloperadores` (`codOpreador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_relReservaPrestacaoServicos_tblUtente1` FOREIGN KEY (`tblUtente_codUtente`) REFERENCES `tblutente` (`codUtente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relreservaprestacaoservicos`
--

LOCK TABLES `relreservaprestacaoservicos` WRITE;
/*!40000 ALTER TABLE `relreservaprestacaoservicos` DISABLE KEYS */;
INSERT INTO `relreservaprestacaoservicos` VALUES (5,1,1,'2021-06-18 20:12:00','2021-06-18 20:14:00','Servico1',2,1,1,1,1);
/*!40000 ALTER TABLE `relreservaprestacaoservicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbloperadores`
--

DROP TABLE IF EXISTS `tbloperadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbloperadores` (
  `codOpreador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `morada` varchar(45) DEFAULT NULL,
  `telefone` varchar(9) DEFAULT NULL,
  `password` varchar(350) DEFAULT NULL,
  `tblTipoOperador_codTipoOperador` int(11) NOT NULL,
  PRIMARY KEY (`codOpreador`,`tblTipoOperador_codTipoOperador`),
  KEY `fk_tblOperadores_tblTipoOperador1_idx` (`tblTipoOperador_codTipoOperador`),
  CONSTRAINT `fk_tblOperadores_tblTipoOperador1` FOREIGN KEY (`tblTipoOperador_codTipoOperador`) REFERENCES `tbltipooperador` (`codTipoOperador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbloperadores`
--

LOCK TABLES `tbloperadores` WRITE;
/*!40000 ALTER TABLE `tbloperadores` DISABLE KEYS */;
INSERT INTO `tbloperadores` VALUES (1,'Primeiro','Faro','0000000','123445678',1),(3,'TesteHash','Faro','123456789','12345678',1),(10,'TesteHaash2','Faro','123456789','$2y$10$w/wviP0pETjgsqig9Ui.J.VhJx03rrdVKXx5YU1lIfui/RCZAXrB6',2),(11,'TesteHaash2','Faro','123456789','$2y$10$w/wviP0pETjgsqig9Ui.J.VhJx03rrdVKXx5YU1lIfui/RCZAXrB6',2),(23,'funciona','faro','123456789','123456789',2),(24,'funciona','faro','123456789','123456789',2),(25,'Admin','Faro','000000','12345678',1),(26,'admin2','Faro','0000000','$2y$10$TMZir2h7/c0onHTyO1TVe.MTUHDpS1X8FTz5lz6ZlskO86kLVOcQ6',1),(27,'hash','Faro','00000','$2y$10$ENHf7eOk8jhlgA5lHOU/bu7BONEKydnmyrspfq/MOmBHOoI9qk//e',1);
/*!40000 ALTER TABLE `tbloperadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblprestador`
--

DROP TABLE IF EXISTS `tblprestador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblprestador` (
  `codPrestador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `telefone` varchar(9) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `morada` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codPrestador`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblprestador`
--

LOCK TABLES `tblprestador` WRITE;
/*!40000 ALTER TABLE `tblprestador` DISABLE KEYS */;
INSERT INTO `tblprestador` VALUES (1,'Prest0','000000','any@test.com','M','1900-12-20','Faro'),(2,'Teste2','11111111','some@mail.com','M','1987-06-19','Faro'),(3,'Teste2','11111111','some@mail.com','M','1987-06-19','Faro'),(4,'Teste2','11111111','some@mail.com','M','1987-06-19','Faro'),(5,'testeValid','0000000','teste@valid.com','M','1997-12-28','Faro'),(6,'testevalid2','123153215','afas','M','2021-06-02','algum lugar'),(7,'testevalid4','00000','aFSF','M','2021-06-08','Faro'),(8,'testeValid5','123456789','afaf','M','2021-06-09','Faro'),(9,'val6','00000','','M','2021-06-22','afdasf'),(10,'afafa','00000','','M','2021-06-10','afadsvs'),(11,'','','',NULL,'1970-01-01',''),(12,'','','',NULL,'1970-01-01',''),(13,'','','',NULL,'1970-01-01',''),(14,'','','',NULL,'1970-01-01',''),(15,'','','',NULL,'1970-01-01',''),(16,'asgdsags','00000','','M','2021-06-17','sbfdfgng'),(17,'','','',NULL,'1970-01-01',''),(18,'ehrtjryj','00000','','M','2021-06-24','fjfhj'),(19,'szxgfzbh','sgbasfcb','','M','2021-06-04','xbxzbxv'),(20,'xv xvn ds','x xvndn','abc@xyz.com','M','2021-06-17','sadbfs'),(21,'sfbsdfnbf','dfsndsfn','abc@xyz.com','M','2021-06-24','ntn'),(22,'qwgewrh','dfshgdj','abc@mnb.com','M','2021-06-10','dnyt');
/*!40000 ALTER TABLE `tblprestador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblservico`
--

DROP TABLE IF EXISTS `tblservico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblservico` (
  `codServico` int(6) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`codServico`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblservico`
--

LOCK TABLES `tblservico` WRITE;
/*!40000 ALTER TABLE `tblservico` DISABLE KEYS */;
INSERT INTO `tblservico` VALUES (1,'servTeste'),(2,'SegundoServ');
/*!40000 ALTER TABLE `tblservico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltipooperador`
--

DROP TABLE IF EXISTS `tbltipooperador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbltipooperador` (
  `codTipoOperador` int(11) NOT NULL,
  `tipoOperador` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codTipoOperador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltipooperador`
--

LOCK TABLES `tbltipooperador` WRITE;
/*!40000 ALTER TABLE `tbltipooperador` DISABLE KEYS */;
INSERT INTO `tbltipooperador` VALUES (1,'Administrativo'),(2,'Operação corrente');
/*!40000 ALTER TABLE `tbltipooperador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblutente`
--

DROP TABLE IF EXISTS `tblutente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblutente` (
  `codUtente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `morada` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codUtente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblutente`
--

LOCK TABLES `tblutente` WRITE;
/*!40000 ALTER TABLE `tblutente` DISABLE KEYS */;
INSERT INTO `tblutente` VALUES (1,'Teste','Faro','123456789'),(2,'Teste3','Algum Lugar','2222222'),(3,'funcione','FAro','123456789'),(5,'TesteUp','Faro','123456789');
/*!40000 ALTER TABLE `tblutente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-20 23:27:01
