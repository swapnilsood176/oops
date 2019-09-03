-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2015 at 09:59 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mytrack`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delcat`(IN `ccod` INT)
    NO SQL
begin
delete from tbcat where catcod=ccod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delplylst`(IN `plcod` INT)
    NO SQL
begin
delete from tbplylst where plylstcod=plcod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delplylsttrk`(IN `pltcod` INT)
    NO SQL
begin
delete from  tbplylsttrk  where plylsttrkcod=pltcod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deltrk`(IN `tcod` INT)
    NO SQL
begin
delete from  tbtrk where trkcod=tcod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delusr`(IN `ucod` INT)
    NO SQL
begin
delete from tbusr where usrcod=ucod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dspcat`()
    NO SQL
begin
select * from tbcat ;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dspforplylst`(IN `ccod` INT, IN `pcod` INT)
    NO SQL
begin
select * from tbtrk where trkcatcod=ccod and
trkcod not in(select plylsttrktrkcod from
tbplylsttrk where plylstplylstcod=pcod);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dspplylst`()
    NO SQL
begin
select * from tbplylst;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dspplylstbycat`(IN `ccod` INT)
    NO SQL
select plylstcod,plylsttit,usreml,plylstdsc,plylstlik,plylstdat,
usrcod
from tbplylst,tbusr where 
plylstusrcod=usrcod and plylstcatcod=
ccod order by plylstlik desc$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dspplylsttrk`(IN `pcod` INT)
    NO SQL
begin
select * from  tbplylsttrk where plylstplylstcod=pcod order by
plylsttrkord;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dsptrk`(IN `catcod` INT)
    NO SQL
begin
select * from  tbtrk where trkcatcod=catcod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dspusr`()
    NO SQL
begin
select * from tbusr;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fndcat`(IN `ccod` INT)
    NO SQL
begin
select * from  tbcat  where catcod=ccod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fndplylst`(IN `plcod` INT)
    NO SQL
begin
select * from tbplylst where plylstcod=plcod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fndplylsttrk`(IN `pltcod` INT)
    NO SQL
begin
select * from  tbplylsttrk  where plylsttrkcod=pltcod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fndtrk`(IN `tcod` INT)
    NO SQL
begin
select * from  tbtrk where trkcod=tcod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fndusr`(IN `ucod` INT)
    NO SQL
begin
select * from tbusr where usrcod=ucod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inscat`(IN `cnam` VARCHAR(50))
    NO SQL
begin
insert tbcat values(null,cnam);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insplylst`(IN `pldat` DATETIME, IN `plucod` INT, IN `pltit` VARCHAR(100), IN `pldsc` VARCHAR(500), IN `plccod` INT, IN `pllik` INT, OUT `cod` INT)
    NO SQL
begin
insert tbplylst value(null,pldat,plucod,pltit,pldsc,plccod,pllik);
select last_insert_id() into cod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insplylsttrk`(IN `plplcod` INT, IN `plttcod` INT, IN `pltord` INT)
    NO SQL
begin
insert tbplylsttrk values(null,plplcod,plttcod,pltord);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `instrk`(IN `tccod` INT, IN `tlyr` VARCHAR(1000), IN `tdsc` VARCHAR(500), IN `tfil` VARCHAR(500), IN `tuucod` INT, IN `tudat` DATETIME, OUT `cod` INT)
    NO SQL
begin
insert tbtrk values(null,tccod,tlyr,tdsc,tfil,tuucod,tudat);
select last_insert_id() into cod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insusr`(IN `ueml` VARCHAR(50), IN `upwd` VARCHAR(50), IN `urdat` DATETIME)
    NO SQL
begin
insert tbusr value(null,ueml,upwd,urdat);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `logincheck`(IN `eml` VARCHAR(50), IN `pwd` VARCHAR(50), OUT `cod` INT)
    NO SQL
begin
declare actpwd varchar(50);
select usrpwd from tbusr where usreml=eml into @actpwd;
if @actpwd=pwd then
	select usrcod from tbusr where usreml=eml into cod;
else
	set cod=-1;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updcat`(IN `ccod` INT, IN `cnam` VARCHAR(50))
    NO SQL
begin
update tbcat set catnam=cnam where catcod=ccod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updplylst`(IN `plcod` INT)
    NO SQL
begin
declare r int;
select plylstlik from tbplylst where plylstcod=plcod into @r;
update tbplylst set plylstlik=@r+1 where plylstcod=plcod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updplylsttrk`(IN `pltcod` INT, IN `plplcod` INT, IN `plttcod` INT, IN `pltord` INT)
    NO SQL
begin
update tbplylsttrk set plylstplylstcod=plplcod,plylsttrktrkcod=plttcod,plylsttrkord=pltord where plylsttrkcod=pltcod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updtrk`(IN `tcod` INT, IN `tccod` INT, IN `tlyr` VARCHAR(1000), IN `tdsc` VARCHAR(500), IN `tfil` VARCHAR(50), IN `tuucod` INT, IN `tudat` DATETIME)
    NO SQL
begin
update tbtrk set trkcatcod=tccod,trklyr=tlyr,trkdsc=tdsc,trkfil=tfil,trkuplusrcod=tuucod,trkupldat=tudat where trkcod=tcod;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updusr`(IN `ucod` INT, IN `ueml` VARCHAR(50), IN `upwd` VARCHAR(50), IN `urdat` DATETIME)
    NO SQL
begin
update tbusr set usreml=ueml,usrpwd=upwd,usrregdat=urdat where usrcod=ucod;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbcat`
--

CREATE TABLE IF NOT EXISTS `tbcat` (
  `catcod` int(11) NOT NULL AUTO_INCREMENT,
  `catnam` varchar(50) NOT NULL,
  PRIMARY KEY (`catcod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbcat`
--

INSERT INTO `tbcat` (`catcod`, `catnam`) VALUES
(1, 'Ghazals'),
(2, 'Jazz'),
(3, 'Bollywood'),
(4, 'punjabi');

-- --------------------------------------------------------

--
-- Table structure for table `tbplylst`
--

CREATE TABLE IF NOT EXISTS `tbplylst` (
  `plylstcod` int(11) NOT NULL AUTO_INCREMENT,
  `plylstdat` datetime NOT NULL,
  `plylstusrcod` int(11) NOT NULL,
  `plylsttit` varchar(100) NOT NULL,
  `plylstdsc` varchar(500) NOT NULL,
  `plylstcatcod` int(11) NOT NULL,
  `plylstlik` int(11) NOT NULL,
  PRIMARY KEY (`plylstcod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbplylst`
--

INSERT INTO `tbplylst` (`plylstcod`, `plylstdat`, `plylstusrcod`, `plylsttit`, `plylstdsc`, `plylstcatcod`, `plylstlik`) VALUES
(1, '2015-07-12 00:00:00', 1, 'Unforgetable Kishore', 'This playlist has evergreen songs of kishore which enlighten your mood, whenever you listen to them.', 3, 2),
(3, '2015-07-14 00:00:00', 14, 'english', 'best english song', 2, 0),
(4, '2015-07-14 00:00:00', 15, 'bollywood', 'non stop bollywood', 3, 1),
(5, '2015-07-14 00:00:00', 1, 'aaa', 'fgfgh', 2, 0),
(6, '2015-07-14 00:00:00', 16, 'bollywood best songs', 'good sound songs', 2, 1),
(7, '2015-07-15 00:00:00', 17, 'my fav punjabi', 'One of the things I enjoy about  my playlist, is that I get to share music I enjoy, with people all around the world. But how great would it be if it was possible to customize your playlists, to make it your very own.', 4, 1),
(8, '2015-07-15 00:00:00', 13, 'old is gold', 'The ghazal is a poetic form consisting of rhyming couplets and a refrain, with each line sharing the same meter. A ghazal may be understood as a poetic expression of both the pain of loss or separation and the beauty of love in spite of that pain.', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbplylsttrk`
--

CREATE TABLE IF NOT EXISTS `tbplylsttrk` (
  `plylsttrkcod` int(11) NOT NULL AUTO_INCREMENT,
  `plylstplylstcod` int(11) NOT NULL,
  `plylsttrktrkcod` int(11) NOT NULL,
  `plylsttrkord` int(11) NOT NULL,
  PRIMARY KEY (`plylsttrkcod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbplylsttrk`
--

INSERT INTO `tbplylsttrk` (`plylsttrkcod`, `plylstplylstcod`, `plylsttrktrkcod`, `plylsttrkord`) VALUES
(1, 1, 1, 1),
(2, 4, 4, 1),
(3, 4, 2, 2),
(4, 4, 8, 3),
(5, 5, 4, 1),
(7, 5, 9, 2),
(9, 6, 5, 2),
(10, 6, 4, 3),
(11, 7, 11, 1),
(12, 7, 12, 2),
(13, 8, 15, 1),
(14, 8, 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbtrk`
--

CREATE TABLE IF NOT EXISTS `tbtrk` (
  `trkcod` int(11) NOT NULL AUTO_INCREMENT,
  `trkcatcod` int(11) NOT NULL,
  `trklyr` varchar(1000) NOT NULL,
  `trkdsc` varchar(500) NOT NULL,
  `trkfil` varchar(50) NOT NULL,
  `trkuplusrcod` int(11) NOT NULL,
  `trkupldat` datetime NOT NULL,
  PRIMARY KEY (`trkcod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbtrk`
--

INSERT INTO `tbtrk` (`trkcod`, `trkcatcod`, `trklyr`, `trkdsc`, `trkfil`, `trkuplusrcod`, `trkupldat`) VALUES
(1, 1, 'songs', 'werqwer qwer qewr wer wer ', '.mp3', 0, '2015-07-09 00:00:00'),
(4, 3, 'ankho me teri ajab si adayen hai', 'om shanti om ring tone\r\nanu malik \r\nfarha khan', '.mp3', 0, '2015-07-14 00:00:00'),
(5, 3, 'hello honey bunny', 'honey bunny new tone\r\nvishal and shekhar\r\nsonu nigam', '.mp3', 0, '2015-07-14 00:00:00'),
(8, 3, 'Sai Mantra  bhajan', 'Sai Mantra New\r\nalka yagnik\r\njaved akhatar\r\ngulshan T series', '.mp3', 0, '2015-07-14 00:00:00'),
(9, 3, 'selfie le le', 'selfie le le, vishal,shankar,2015\r\n', '.mp3', 0, '2015-07-14 00:00:00'),
(10, 2, 'Punjabiyaan Di Battery', 'Punjabiyaan Di Battery\r\nmere dad ki maruti\r\nanu', '.mp3', 0, '2015-07-14 00:00:00'),
(11, 4, 'saturday saturday krdi rehndi ae', 'saturday saturday \r\nhouny singh\r\ngarri sandhu', '.mp3', 0, '2015-07-15 00:00:00'),
(12, 4, 'ek numbr de tharki yaar kaminey', 'yaar kaminey\r\nManjeet Singh\r\n', '.mp3', 0, '2015-07-15 00:00:00'),
(13, 4, 'hai mera dil', 'hai mera dil\r\nalfaaz\r\n honey singh', '.mp3', 0, '2015-07-15 00:00:00'),
(14, 1, 'Aaj Phir Tum Pe', 'Aaj Phir Tum Pe\r\nPankaj Udhas\r\n (DJJOhAL.Com)', '.mp3', 0, '2015-07-15 00:00:00'),
(15, 1, 'Hum Tere Shehr Mein Aaye', 'Hum Tere Shehr Mein Aaye\r\n Ghulam Ali \r\n(DJJOhAL.Com)', '.mp3', 0, '2015-07-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbusr`
--

CREATE TABLE IF NOT EXISTS `tbusr` (
  `usrcod` int(11) NOT NULL AUTO_INCREMENT,
  `usreml` varchar(50) NOT NULL,
  `usrpwd` varchar(50) NOT NULL,
  `usrregdat` datetime NOT NULL,
  PRIMARY KEY (`usrcod`),
  UNIQUE KEY `usreml` (`usreml`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbusr`
--

INSERT INTO `tbusr` (`usrcod`, `usreml`, `usrpwd`, `usrregdat`) VALUES
(1, 'cs@cssoftsolutions.com', 'abc123#', '2015-07-09 00:00:00'),
(13, 'bantu@gmail.com', 'bantu12', '2015-07-13 00:00:00'),
(14, 'bhupi@gmail.com', '123', '2015-07-14 00:00:00'),
(15, 'vicky@gmail.com', '123', '2015-07-14 00:00:00'),
(16, 'bantu1@gmail.com', '12', '2015-07-14 00:00:00'),
(17, 'kishan@gmail.com', '123', '2015-07-15 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
