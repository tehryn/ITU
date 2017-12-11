-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Pon 11. pro 2017, 14:05
-- Verze MySQL: 5.6.33
-- Verze PHP: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `xmatej52`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_h_firmy`
--

CREATE TABLE IF NOT EXISTS `itu_h_firmy` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  `ulice` varchar(128) COLLATE latin2_czech_cs DEFAULT NULL,
  `cislo_popisne` varchar(128) COLLATE latin2_czech_cs DEFAULT NULL,
  `psc` int(5) DEFAULT NULL,
  `mesto` int(11) NOT NULL,
  `telefon` int(9) DEFAULT NULL,
  `email` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=15 ;

--
-- Vypisuji data pro tabulku `itu_h_firmy`
--

INSERT INTO `itu_h_firmy` (`ID`, `nazev`, `ulice`, `cislo_popisne`, `psc`, `mesto`, `telefon`, `email`) VALUES
(1, 'Fakultní nemocnice Břeclav', 'Lanžhotská', '1', 69002, 7, 666666666, 'lucifer@email.cz'),
(2, 'Divadlo Františka Preisse', 'Úvoz', '2', 58601, 23, 123123123, 'ferda@email.cz'),
(9, 'NoLife', '', '', NULL, 6, NULL, 'firma1@email.cz'),
(10, 'Nadějní technici', 'Technická', '19b', 11111, 6, NULL, 'firma2@email.cz'),
(11, 'Hloubaví filozofové', 'Imaginární', '345', 10011, 21, NULL, 'firma3@email.cz'),
(12, 'Zběsilý novinář', 'Papírová', '1a', 10011, 47, 602660666, 'firma4@email.cz'),
(13, 'Zbloudilý dobrodruh', 'Pralesní', '194/34', 26410, 55, NULL, 'firma5@email.cz'),
(14, 'Šílený věděc MUHAHAHAHA', NULL, NULL, NULL, 6, NULL, 'firma6@email.cz');

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_h_mesta`
--

CREATE TABLE IF NOT EXISTS `itu_h_mesta` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=76 ;

--
-- Vypisuji data pro tabulku `itu_h_mesta`
--

INSERT INTO `itu_h_mesta` (`ID`, `nazev`) VALUES
(5, 'Beroun'),
(6, 'Brno'),
(7, 'Břeclav'),
(8, 'Česká Lípa'),
(9, 'České Budějovice'),
(10, 'Český Krumlov'),
(11, 'Děčín'),
(12, 'Domažlice'),
(13, 'Frýdek-Místek'),
(14, 'Havlíčkův Brod'),
(15, 'Hodonín'),
(16, 'Hradec Králové'),
(17, 'Cheb'),
(18, 'Chomutov'),
(19, 'Chrudim'),
(20, 'Jablonec nad Nisou'),
(21, 'Jeseník'),
(22, 'Jičín'),
(23, 'Jihlava'),
(24, 'Jindřichův Hradec'),
(25, 'Karlovy Vary'),
(26, 'Karviná'),
(27, 'Kladno'),
(28, 'Klatovy'),
(29, 'Kroměříž'),
(30, 'Kutná Hora'),
(31, 'Liberec'),
(32, 'Litoměřice'),
(33, 'Louny'),
(34, 'Mělník'),
(35, 'Mladá Boleslav'),
(36, 'Most'),
(37, 'Náchod'),
(38, 'Nový Jičín'),
(39, 'Nymburk'),
(40, 'Olomouc'),
(41, 'Opava'),
(42, 'Ostrava'),
(43, 'Pardubice'),
(44, 'Pelhřimov'),
(45, 'Písek'),
(46, 'Plzeň'),
(47, 'Praha'),
(48, 'Prachatice'),
(49, 'Prostějov'),
(50, 'Přerov'),
(51, 'Příbram'),
(52, 'Rakovník'),
(53, 'Rokycany'),
(54, 'Rychnov nad Kněžnou'),
(55, 'Semily'),
(56, 'Sokolov'),
(57, 'Strakonice'),
(58, 'Svitavy'),
(59, 'Šumperk'),
(60, 'Tábor'),
(61, 'Tachov'),
(62, 'Teplice'),
(63, 'Trutnov'),
(64, 'Třebíč'),
(65, 'Uherské Hradiště'),
(66, 'Ústí nad Labem'),
(67, 'Ústí nad Orlicí'),
(68, 'Vsetín'),
(69, 'Vyškov'),
(70, 'Zlín'),
(71, 'Znojmo'),
(72, 'Žďár nad Sázavou'),
(73, 'Benešov'),
(74, 'Blansko'),
(75, 'Bruntál');

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_h_obory`
--

CREATE TABLE IF NOT EXISTS `itu_h_obory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=13 ;

--
-- Vypisuji data pro tabulku `itu_h_obory`
--

INSERT INTO `itu_h_obory` (`ID`, `nazev`) VALUES
(1, 'Historie a umění'),
(2, 'Čeština, literatura a cizí jazyky'),
(3, 'Geologie a geografie'),
(4, 'Matematika a fyzika'),
(6, 'Právo, ekonomie a management'),
(7, 'Společenské vědy a filosofie'),
(8, 'Medicína, zdraví a výživa'),
(9, 'Biologie a chemie'),
(10, 'Učitelství a pedagogika'),
(11, 'Informatika a výpočetní technika');

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_h_podobory`
--

CREATE TABLE IF NOT EXISTS `itu_h_podobory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  `obor` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=116 ;

--
-- Vypisuji data pro tabulku `itu_h_podobory`
--

INSERT INTO `itu_h_podobory` (`ID`, `nazev`, `obor`) VALUES
(1, 'Antropologie', 1),
(2, 'Archeologie', 1),
(3, 'Archivnictví', 1),
(4, 'Dějiny umění', 1),
(5, 'Hudební věda', 1),
(6, 'Restaurování', 1),
(7, 'Pomocné vědy historické', 1),
(9, 'Teorie a dějiny divadla', 1),
(10, 'Teorie a dějiny filmu a audiovizuální kultury', 1),
(11, 'Vizuální tvorba', 1),
(12, 'Anglický jazyk a literatura', 2),
(13, 'Balkanistika', 2),
(14, 'Baltistika', 2),
(15, 'Bulharský jazyk a literatura', 2),
(16, 'Český jazyk a literatura', 2),
(17, 'Filologicko-areálová studia', 2),
(18, 'Francouzský jazyk a literatura', 2),
(19, 'Chorvatský jazyk a literatura', 2),
(20, 'Italský jazyk a literatura', 2),
(21, 'Klasický řecký jazyk a literatura', 2),
(22, 'Latinský jazyk a literatura', 2),
(23, 'Německý jazyk a literatura', 2),
(24, 'Nizozemský jazyk a literatura', 2),
(25, 'Norský jazyk a literatura', 2),
(26, 'Novořecký jazyk a literatura', 2),
(27, 'Obecná jazykověda', 2),
(28, 'Polský jazyk a literatura ', 2),
(29, 'Portugalský jazyk a literatura', 2),
(30, 'Ruský jazyk a literatura', 2),
(31, 'Slovenský jazyk a literatura', 2),
(32, 'Slovinský jazyk a literatura', 2),
(33, 'Srbský jazyk a literatura', 2),
(34, 'Španělský jazyk a literatura', 2),
(35, 'Ukrajinský jazyk a literatura', 2),
(36, 'Fyzioterapie', 8),
(37, 'Intenzivní péče', 8),
(38, 'Lékařská genetika a molekulární diagnostika', 8),
(39, 'Nutriční specialista ', 8),
(40, 'Optometrie', 8),
(41, 'Environmentální studia', 3),
(42, 'Fyzická geografie', 3),
(43, 'Geografická kartografie a geoinformatika', 3),
(44, 'Geologie', 3),
(45, 'Sociální geografie a regionální rozvoj', 3),
(46, 'Algebra a diskrétní matematika', 4),
(47, 'Aplikovaná matematika', 4),
(48, 'Biofyzika', 4),
(49, 'Finanční matematika', 4),
(50, 'Fyzika kondenzovaných látek', 4),
(51, 'Fyzika plazmatu', 4),
(52, 'Fyzikální chemie', 4),
(53, 'Geometrie', 4),
(54, 'Matematická analýza', 4),
(56, 'Statistika a analýza dat', 4),
(57, 'Matematické modelování a numerické metody', 4),
(58, 'Teoretická fyzika a astrofyzika', 4),
(61, 'Ekonomie', 6),
(62, 'Finance', 6),
(63, 'Hospodářská politika', 6),
(65, 'Podniková ekonomika a management', 6),
(66, 'Podniková informatika', 6),
(67, 'Regionální rozvoj a správa', 6),
(68, 'Veřejná ekonomika a správa', 6),
(71, 'Etnologie', 7),
(72, 'Evropská studia', 7),
(74, 'Konfliktní a demokratická studia', 7),
(75, 'Kulturní sociologie', 7),
(76, 'Mediální studia a žurnalistika', 7),
(77, 'Mediteránní studia ', 7),
(78, 'Politologie', 7),
(79, 'Psychologie', 7),
(80, 'Religionistika', 7),
(81, 'Mezinárodní vztahy', 7),
(82, 'Sociální práce', 7),
(83, 'Sociologie', 7),
(84, 'Teorie interaktivních médií', 7),
(85, 'Veřejná politika a lidské zdroje', 7),
(87, 'Analytická biochemie', 9),
(88, 'Analytická chemie', 9),
(89, 'Anorganická chemie', 9),
(91, 'Biochemie', 9),
(92, 'Biomolekulární chemie', 9),
(93, 'Botanika', 9),
(94, 'Genomika a proteomika', 9),
(95, 'Chemie konzervování - restaurování', 9),
(96, 'Chemie životního prostředí', 9),
(97, 'Matematická biologie', 9),
(98, 'Materiálová chemie', 9),
(99, 'Molekulární biologie a genetika', 9),
(100, 'Speciální pedagogika', 10),
(101, 'Andragogika', 10),
(102, 'Galerijní pedagogika a zprostředkování umění', 10),
(103, 'Bezpečnost informačních technologií', 11),
(104, 'Aplikovaná informatika', 11),
(105, 'Bioinformatika', 11),
(106, 'Počítačová lingvistika', 11),
(107, 'Chemoinformatika', 11),
(108, 'Informační systémy', 11),
(109, 'Paralelní a distribuované systémy', 11),
(110, 'Počítačová grafika', 11),
(111, 'Počítačové sítě a komunikace', 11),
(112, 'Počítačové systémy', 11),
(113, 'Teoretická informatika', 11),
(114, 'Umělá inteligence a zpracování přirozeného jazyka', 11),
(115, 'Zpracování obrazu a zvuku', 11);

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_h_prace`
--

CREATE TABLE IF NOT EXISTS `itu_h_prace` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  `zadavatel` int(11) NOT NULL,
  `plat` varchar(39) COLLATE latin2_czech_cs DEFAULT NULL,
  `zadani_strucne` varchar(4000) COLLATE latin2_czech_cs NOT NULL,
  `zadani_odkaz` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  `casova_narocnost` varchar(128) COLLATE latin2_czech_cs DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=27 ;

--
-- Vypisuji data pro tabulku `itu_h_prace`
--

INSERT INTO `itu_h_prace` (`ID`, `nazev`, `zadavatel`, `plat`, `zadani_strucne`, `zadani_odkaz`, `casova_narocnost`) VALUES
(1, 'Nové techniky měření očního tlaku', 1, NULL, 'Práce se zabývá výzkumem nových technik, jak měřit oční tlak. Součástí práce by mělo být prostudování stávajících metod a navrhnout jak pomocí nových technologií zajistit kvalitní měření usnadňující práci našeho očního oddělení.', './zadani/01.zip', '300-400 hodin'),
(2, 'Vliv kožních onemocnění na genetiku', 1, NULL, 'Student bude mít za úkol vybrat si alespoň 3 kožní onemocnění, a prozkoumat jejich vliv na genetické přenášení na potomky.', './zadani/02.zip', '300-400 hodin'),
(17, 'Vliv záření na archivování knih', 11, '100 Kč/h', 'Prozkoumat a důkladně popsat, jaky vliv má záření o různé vlnové délce na dobu životnosti knih. Prověřit na různých vazbách (např. kožená, paperback).', './prace/11_Vliv_zareni_na_archivovani_knih', '200 h'),
(18, 'Jak se stát zbytečným dinosaurem na Měsíci', 11, '', 'Filozoficky zapřemýšlet nad svou existencí a možností vyplnit svůj sen.', './prace/11_Jak_se_stat_zbytecnym_dinosaurem_na_Mesici', ''),
(19, 'Tvorba morálního kodexu politika České republiky', 12, '1000 Kč', 'Promyslete, jak by se měl správný politik chovat a sestavte morální kodex správného českého politika. Kodex se pokuste aplikovat na některé z českých i zahraničních politiků.', './prace/12_Tvorba_moralniho_kodexu_politika_Ceske_republiky', '60 hodin'),
(20, 'Aplikace pro převod formátu odt do jazyka LaTeX', 12, '10000 Kč', 'Navrhněte a naprogramujte aplikaci, která bude schopná soubor ve formátu odt převést do zdrojového kódu pro LaTeX.', './prace/12_Aplikace_pro_prevod_formatu_odt_do_jazyka_LaTeX', '150 hodin'),
(21, 'Zpracovat naměřená data a sestrojit mapu pralesa', 13, 'Dle dohody', 'Zpracujte nasbíraná data našimi dobrodruhy a sestavte mapu, podle které se bude schopna řídit příští expedice do Amazonského pralesa.', './prace/13_Zpracovat_namerena_data_a_sestrojit_mapu_pralesa', '80 hodin'),
(22, 'Navrhnout vhodnou obuv do pralesa', 13, 'Dle dohody', 'Nastudujte si přírodní podmínky panující v Amazonském pralese a navrhněte a otestujte vhodnou obuv pro naše dobrodruhy.', './prace/13_Navrhnout_vhodnou_obuv_do_pralesa', '40-60 hodin'),
(23, 'Automatické učení AI při hraní her', 9, '230 Kč/h', 'Vytvořený program bude mít přístup k aktuálně hraným hrám na serveru. Jeho úkolem bude zjišťovat různé strategie hráčů, zaznamenávat je a následně je reprodukovat do chování AI.', './prace/9_Automaticke_uceni_AI_pri_hrani_her', ''),
(24, 'Sestrojit stroj času', 14, 'Kolik si řeknete', 'Sestrojte zařízení umožňující cestovat časem a prostorem. Jako důkaz funkčnosti tohoto zařízení nám ho představte před vypsáním tohoto tématu (10. 12. 2017).', './prace/14_Sestrojit_stroj_casu', '-250 hodin'),
(25, 'Vytvořit kámen mudrců', 14, 'Kolik si řeknete', 'Vytvořte zařízení schopné přeměnit jakoukoliv látku na zlato, vyléčit všechna zařízení a obdařit člověka věčným životem.', './prace/14_Vytvorit_kamen_mudrcu', '450 hodin'),
(26, 'Snímání středověkých tvrzí na Moravě', 10, '120 Kč/h', 'Práce bude probíhat v samotných tvrzích. Je možnost domluvit vyhlídkové lety. Hlavním cílem je získání trojrozměrných modelů pro následné zpracování.', './prace/10_Snimani_stredovekych_tvrzi_na_Morave', '500 h');

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_h_skoly`
--

CREATE TABLE IF NOT EXISTS `itu_h_skoly` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `jmeno` varchar(128) COLLATE latin2_czech_cs DEFAULT NULL,
  `mesto` int(11) NOT NULL,
  `email` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=11 ;

--
-- Vypisuji data pro tabulku `itu_h_skoly`
--

INSERT INTO `itu_h_skoly` (`ID`, `jmeno`, `mesto`, `email`) VALUES
(1, 'Vysoká škola umělecká', 23, 'patrik@email.cz'),
(2, 'Hippokratova univerzita', 6, 'anicka@email.cz'),
(4, 'Přírodovědecká univerzita Liberec', 31, 'karel@email.cz'),
(5, 'Filozofické učení netechnické', 6, 'skola1@email.cz'),
(6, 'Vysoká překladatelská škola', 28, 'skola2@email.cz'),
(7, 'Univerzita planety Země', 16, 'skola3@email.cz'),
(8, 'Vojenská akademie', 10, 'skola4@email.cz'),
(9, 'Vysoká škola binární', 6, 'skola5@email.cz'),
(10, 'Univerzita Bioinformatiky', 6, 'skola6@email.cz');

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_h_studenti`
--

CREATE TABLE IF NOT EXISTS `itu_h_studenti` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `jmeno` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  `prijmeni` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  `telefon` int(9) DEFAULT NULL,
  `email` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  `skola` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=13 ;

--
-- Vypisuji data pro tabulku `itu_h_studenti`
--

INSERT INTO `itu_h_studenti` (`ID`, `jmeno`, `prijmeni`, `telefon`, `email`, `skola`) VALUES
(2, 'xmatej52', 'Matějka', 0, 'xmatej52@stud.fit.vutbr.cz', 2),
(3, 'test01', 'Kazimírová', 0, 'test01@ether123.net', 2),
(4, 'test06', 'Veliký', 0, 'test06@ether123.net', 2),
(5, 'test12', 'Stavitel', 0, 'test12@ether123.net', 1),
(6, 'test02', 'Jaga', 0, 'test02@ether123.net', 4),
(7, 'user1', '1', 0, 'user1@email.cz', 1),
(8, 'user2', '2', 0, 'user2@email.cz', 2),
(9, 'user3', '3', 0, 'user3@email.cz', 4),
(10, 'user4', '4', 0, 'user4@email.cz', 5),
(11, 'user5', '5', 0, 'user5@email.cz', 7),
(12, 'user6', '6', 0, 'user6@email.cz', 8);

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_h_ucty`
--

CREATE TABLE IF NOT EXISTS `itu_h_ucty` (
  `login` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  `heslo` varchar(128) COLLATE latin2_czech_cs NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs;

--
-- Vypisuji data pro tabulku `itu_h_ucty`
--

INSERT INTO `itu_h_ucty` (`login`, `heslo`) VALUES
('anicka@email.cz', 'anicka'),
('beda@email.cz', 'beda'),
('ferda@email.cz', 'ferda'),
('firma1@email.cz', 'firma1'),
('firma2@email.cz', 'firma2'),
('firma3@email.cz', 'firma3'),
('firma4@email.cz', 'firma4'),
('firma5@email.cz', 'firma5'),
('firma6@email.cz', 'firma6'),
('karel@email.cz', 'karel'),
('kocka@email.cz', 'kocka'),
('lenka@email.cz', 'lenka'),
('lucifer@email.cz', 'lucifer'),
('manic@email.cz', 'manic'),
('patrik@email.cz', 'patrik'),
('skola1@email.cz', 'skola1'),
('skola2@email.cz', 'skola2'),
('skola3@email.cz', 'skola3'),
('skola4@email.cz', 'skola4'),
('skola5@email.cz', 'skola5'),
('skola6@email.cz', 'skola6'),
('test01@ether123.net', 'test01'),
('test02@ether123.net', 'test02'),
('test06@ether123.net', 'test06'),
('test12@ether123.net', 'test12'),
('tomtom@email.cz', 'tomtom'),
('user1@email.cz', 'user1'),
('user2@email.cz', 'user2'),
('user3@email.cz', 'user3'),
('user4@email.cz', 'user4'),
('user5@email.cz', 'user5'),
('user6@email.cz', 'user6'),
('xmatej52@stud.fit.vutbr.cz', 'xmatej52');

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_s_prace_mesta`
--

CREATE TABLE IF NOT EXISTS `itu_s_prace_mesta` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mesto` int(11) NOT NULL,
  `prace` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=21 ;

--
-- Vypisuji data pro tabulku `itu_s_prace_mesta`
--

INSERT INTO `itu_s_prace_mesta` (`ID`, `mesto`, `prace`) VALUES
(1, 6, 1),
(2, 6, 2),
(3, 14, 15),
(4, 23, 15),
(5, 44, 15),
(6, 44, 16),
(7, 6, 20),
(8, 9, 20),
(9, 16, 20),
(10, 23, 20),
(11, 42, 20),
(12, 43, 20),
(13, 47, 20),
(14, 47, 21),
(15, 47, 22),
(16, 6, 24),
(17, 47, 24),
(18, 6, 25),
(19, 47, 25),
(20, 6, 26);

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_s_prace_obory`
--

CREATE TABLE IF NOT EXISTS `itu_s_prace_obory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `prace` int(11) NOT NULL,
  `obor` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=27 ;

--
-- Vypisuji data pro tabulku `itu_s_prace_obory`
--

INSERT INTO `itu_s_prace_obory` (`ID`, `prace`, `obor`) VALUES
(1, 1, 8),
(2, 2, 8);

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_s_prace_podobory`
--

CREATE TABLE IF NOT EXISTS `itu_s_prace_podobory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `prace` int(11) NOT NULL,
  `podobor` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=65 ;

--
-- Vypisuji data pro tabulku `itu_s_prace_podobory`
--

INSERT INTO `itu_s_prace_podobory` (`ID`, `prace`, `podobor`) VALUES
(1, 1, 40),
(2, 2, 38),
(43, 15, 16),
(44, 15, 79),
(45, 15, 83),
(46, 16, 46),
(47, 16, 101),
(48, 17, 3),
(49, 17, 52),
(50, 17, 95),
(51, 18, 17),
(52, 18, 75),
(53, 19, 16),
(54, 19, 63),
(55, 19, 78),
(56, 19, 83),
(57, 20, 108),
(58, 21, 43),
(59, 23, 109),
(60, 23, 114),
(61, 24, 58),
(62, 25, 50),
(63, 25, 52),
(64, 26, 43);

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_s_prace_skoly`
--

CREATE TABLE IF NOT EXISTS `itu_s_prace_skoly` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `skola` int(11) NOT NULL,
  `prace` int(11) NOT NULL,
  `komentar` varchar(4096) COLLATE latin2_czech_cs DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `unique_index` (`prace`,`skola`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=15 ;

--
-- Vypisuji data pro tabulku `itu_s_prace_skoly`
--

INSERT INTO `itu_s_prace_skoly` (`ID`, `skola`, `prace`, `komentar`) VALUES
(1, 2, 1, NULL),
(2, 2, 2, NULL),
(6, 1, 15, 'Badaboom!'),
(11, 5, 18, 'Tohle je přesně to, co hledáme. Práci povede profesor Zbyněk Hloubavý.'),
(14, 6, 20, '');

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_s_prace_studenti`
--

CREATE TABLE IF NOT EXISTS `itu_s_prace_studenti` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `prace` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `zaregistrovano` int(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `unique_index` (`prace`,`student`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=18 ;

--
-- Vypisuji data pro tabulku `itu_s_prace_studenti`
--

INSERT INTO `itu_s_prace_studenti` (`ID`, `prace`, `student`, `zaregistrovano`) VALUES
(11, 18, 2, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `itu_s_skoly_obory`
--

CREATE TABLE IF NOT EXISTS `itu_s_skoly_obory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `skola` int(11) NOT NULL,
  `obor` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=9 ;

--
-- Vypisuji data pro tabulku `itu_s_skoly_obory`
--

INSERT INTO `itu_s_skoly_obory` (`ID`, `skola`, `obor`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 10),
(4, 2, 8),
(5, 2, 9),
(6, 4, 3),
(7, 4, 4),
(8, 4, 9);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
