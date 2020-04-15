-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2020 at 11:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Table structure for table `crypto_acceptance`
--

CREATE TABLE `crypto_acceptance` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_low` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place_type` int(11) NOT NULL,
  `contact_person` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` int(11) DEFAULT NULL,
  `isd_code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active,2=deleted',
  `added_date` datetime DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `crypto_acceptance`
--

INSERT INTO `crypto_acceptance` (`id`, `title`, `location`, `image`, `image_low`, `website`, `latitude`, `longitude`, `place_type`, `contact_person`, `contact_email`, `contact_number`, `isd_code`, `currency`, `status`, `added_date`, `added_by`, `updated_date`, `updated_by`) VALUES
(1, 'Test', 'Ahmedabad, Gujarat, India', '1545827978-1535543797mango-by-air.jpg', '1545827978-1535543797mango-by-air.jpg', 'https://www.edge196.com', '23.022505', '72.5713621', 2, 'Jaypal', 'jaypal@nristartupindia.com', 2147483647, '', '2', 0, '2019-01-10 06:24:12', 0, NULL, 0),
(2, 'test 2', 'Ahmedabad, Gujarat, India', '1545829007-EDGE196-Logo.jpg', '1545829007-EDGE196-Logo.jpg', 'http://www.websitename.com', '23.022505', '72.5713621', 2, 'pk', 'test22@gmail.com', 2147483647, '', '1,2,4', 0, '2019-01-10 06:24:12', 0, NULL, 0),
(3, 'TAX MEN PS', 'United States', '', '', 'http://www.taxmenps.com', '37.09024', '-95.712891', 13, 'RYAN LAZANIS', 'info@xenaccounting.com', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(4, 'GlassUp', 'South Africa', '', '', 'http://www.glassup.net/', '-30.559482', '22.937506', 13, 'Francesco Giartosio', 'info@glassup.net', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(5, 'Biuro Rachunkowe Finesti', 'Poland', '', '', 'http://www.finesti.pl', '51.919438', '19.145136', 13, 'Anna Małecka', 'biuro@finesti.pl', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(6, 'Connell Wise & Associates, LLP', 'United States', '', '', 'http://www.wise-associates.com/', '37.09024', '-95.712891', 13, 'Dr. Connell Wise', 'info@wise-associates.com', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(7, 'SIMPLE COMPTABILITÉ INC.', 'Canada', '', '', 'http://www.simplecomptabilite.com', '56.130366', '-106.346771', 13, 'Michael Ford', 'simplecomptabilite@gmail.com', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(8, 'Eberhart Accounting Services PC', 'United States', '', '', 'http://www.eataxes.com', '37.09024', '-95.712891', 13, 'Karen Eberhart Miller', 'expert@eataxes.com', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(9, 'Boost', 'United States', '', '', 'http://boost.vc', '37.09024', '-95.712891', 13, 'Adam Draper', 'info@boost.vc', 0, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(10, 'Surf Capital Management Inc', 'United States', '', '', 'http://surfcapitalmanagement.com', '37.09024', '-95.712891', 13, 'Garrett J. Keirns', 'GarrettKeirns@SurfCapitalManagement.com', 0, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(11, 'Schmidt Barg Rechtsanwälte', 'Germany', '', '', 'http://www.sbkw.de', '51.165691', '10.451526', 13, 'Mr. Eberhard Peter Barg', 'kanzlei@sbkw.de', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(12, 'EIGER', 'Taipei City, Taiwan', '', '', 'http://www.eigerlaw.com', '25.0329694', '121.5654177', 13, 'Mr. Lloyd G. ROBERTS III', 'lloyd.roberts@eiger.law', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(13, 'Law Offices Of Roger E Naghash', 'United States', '', '', 'http://www.lawfirm4u.com/', '37.09024', '-95.712891', 13, 'Mr. Roger E. Naghash', 'lawfirm@lawfirm4u.com', 0, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(14, 'Law Offices of Jennifer A. Jacobs, LLC', 'United States', '', '', 'http://www.thejajlawfirm.com', '37.09024', '-95.712891', 13, 'Ms. Jennifer A. Jacobs', 'help@thejajlawfirm.com', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(15, 'Law Offices of Martin & Hipple, PLLC', 'United States', '', '', 'http://www.nhlegalservices.com', '37.09024', '-95.712891', 13, 'Mr. Stephen T. Martin', 'Contact@NHLegalServices.com', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(16, 'Bret Lusskin, P.A. The Ticket Cricket', 'United States', '', '', 'http://www.theticketcricket.com', '37.09024', '-95.712891', 13, 'Mr. Bret Lusskin', 'info@theticketcricket.com', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(17, '\"U.S. Immigration Law/ Law Offices of  Sung-Ho Hwang, LLC\"', 'United States', '', '', 'http://hwanglaw.com', '37.09024', '-95.712891', 13, 'Mr. Sung-Ho Hwang', 'sh@hwanglaw.com', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(18, 'Logan Fairfax Law', 'United States', '', '', 'http://www.loganfairfaxlaw.com', '37.09024', '-95.712891', 13, 'Mr. Logan Fairfax', 'loganfairfaxlaw@gmail.com', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(19, 'Oliver & Partners', 'Italy', '', '', 'http://www.oliverpartners.it/', '41.87194', '12.56738', 13, 'Ms. Charlotte Oliver', 'legal@oliverpartners.it', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(20, 'Click Jurídico – Abogados Online', 'Spain', '', '', 'http://clickjuridico.es', '40.463667', '-3.74922', 13, 'Mr. Marcos Díaz Janeiro ', 'info@clickjuridico.es', 346866352, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(21, 'SKJ Juris Services (P) Ltd', 'India', '', '', 'http://www.skjjuris.com', '20.593684', '78.96288', 13, 'Mr Pankaj Jain', 'support@skjjuris.com', 2147483647, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(22, 'Addison Cameron-Huff, Barrister & Solicitor', 'Canada', '', '', 'http://www.cameronhuff.com', '56.130366', '-106.346771', 13, 'Mr. Addison Cameron-Huff', 'addison@cameronhuff.com', 0, '', '1', 1, '2019-01-10 06:24:12', 0, NULL, 0),
(23, 'Oliver & Partners', 'Italy', '', '', 'http://www.archistico.com', '41.87194', '12.56738', 13, 'Charlotte Oliver', 'legal@oliverpartners.it', 2147483647, '', '1', 1, '2019-01-18 07:17:58', 0, NULL, 0),
(24, 'Dr. Avi Nov', 'Israel', '', '', 'http://israeltaxlaw.com', '31.046051', '34.851612', 13, 'Dr. Avi Nov', 'avinov@bezeqint.net', 35298016, '', '1', 1, '2019-01-18 07:19:56', 0, NULL, 0),
(25, 'Establish Brazil', 'Brazil', '', '', 'http://www.establishbrazil.com', '-14.235004', '-51.92528', 13, 'Alexandre De Jong', 'contact@establishbrazil.com', 0, '', '1', 1, '2019-01-18 07:25:51', 0, NULL, 0),
(26, 'ASESORIA Y SEGUROS ROMA-LOPEZ', 'Spain', '', '', 'http://www.romalopez.com', '40.463667', '-3.74922', 13, 'Roma Lopez', 'info@romalopez.com', 2147483647, '', '1', 1, '2019-01-18 07:34:56', 0, NULL, 0),
(27, 'Ticket Computer', 'Jubail', '', '', 'https://ticketcomputers.com', '26.9597709', '49.5687416', 13, 'Ticket Computer Person', 'bitcoin@ticketcomputers.com', 2147483647, '', '1', 1, '2019-01-18 07:37:53', 0, NULL, 0),
(28, 'SP Bedarev A.A.', 'Russian Federation', '', '', 'https://yandex.ru', '61.52401', '105.318756', 13, 'Bedarev', 'infotehpp@yandex.ru', 2147483647, '', '1', 1, '2019-01-18 07:41:46', 0, NULL, 0),
(29, 'BATMKenya', 'Nairobi, Kenya', '', '', 'https://kushcryptominer.com', '-1.2920659', '36.8219462', 13, 'BATM Person', 'atm@kushcryptominer.com', 0, '', '1', 1, '2019-01-18 07:46:05', 0, NULL, 0),
(30, 'Montebit', 'Monterrey, Nuevo Leon, Mexico', '', '', 'https://montebit.com', '25.6866142', '-100.3161126', 13, 'Montebit Person', 'david@montebit.com', 0, '', '1', 1, '2019-01-18 07:48:48', 0, NULL, 0),
(31, 'National Information Technology Park', 'Ulaanbaatar, Mongolia', '', '', 'https://trade.mn', '47.8863988', '106.9057439', 13, 'Digital Exchange Mongolia', 'info@trade.mn', 2147483647, '', '1', 1, '2019-01-18 07:57:39', 0, NULL, 0),
(32, 'Freo\'s Finest', 'Fremantle WA, Australia', '', '', 'https://fremantlesfinest.com', '-32.0569', '115.7439', 13, 'Freo\'s Finest Team', 'info@fremantlesfinest.com', 893356249, '', '1', 1, '2019-01-18 07:59:31', 0, NULL, 0),
(33, 'Walmart Constituyentes', 'Buenos Aires, Argentina', '', '', 'https://athenabitcoin.com.ar', '-34.6036844', '-58.3815591', 13, 'Athena Bitcoin', 'soporte@athenabitcoin.com.ar', 2147483647, '', '1', 1, '2019-01-18 08:02:04', 0, NULL, 0),
(34, 'Bailyk Finance', 'Bailyk Finance, Respublika Avenue, Astana, Kazakhstan', '', '', 'https://zzbit.com', '51.1605227', '71.4703558', 13, 'zzBit', 'help@zzbit.com', 0, '', '1', 1, '2019-01-18 08:36:22', 0, NULL, 0),
(35, 'Hlemmur Square Hotel', 'Hlemmur Square, Reykjavík, Iceland', '', '', 'https://icetor.is', '64.1431845', '-21.9149666', 13, ' Icetor ehf.', 'btm@icetor.is', 0, '', '1', 1, '2019-01-18 08:37:42', 0, NULL, 0),
(36, 'Centro Comercial Unicentro / Torre Panamericana', 'Centro Comercial Colombia, Calle 17, Pasto, Narino, Colombia', '', '', 'https://sarcoin.biz', '1.2112606', '-77.2782513', 13, 'Sarcoin ATM Network', 'info@sarcoin.biz', 2147483647, '', '1', 1, '2019-01-18 08:40:49', 0, NULL, 0),
(37, 'Recoleta Mall - 1st Floor', 'Recoleta, Buenos Aires, Argentina', '', '', 'http://athenabitcoin.com.ar', '-34.5895459', '-58.3973636', 13, 'Athena Bitcoin', 'soporte@athenabitcoin.com.ar', 2147483647, '', '1', 1, '2019-01-18 08:42:17', 0, NULL, 0),
(38, 'Petit Colon ', 'Japan', '', '', 'https://coinoutlet.io', '36.204824', '138.252924', 13, ' CoinOutlet', 'support@coinoutlet.io', 2147483647, '', '1', 1, '2019-01-18 08:44:35', 0, NULL, 0),
(39, 'Hashbx Global Co.,Ltd ', 'Hashbx Office Ratchadaphisek Road, Huai Khwang, Bangkok, Thailand', '', '', 'https://hashbx.com', '13.7700337', '100.5737179', 13, 'MoveX', 'rafaelf@hashbx.com', 21079115, '', '1', 1, '2019-01-18 08:52:19', 0, NULL, 0),
(40, 'Dunedin Security', 'Dunedin, New Zealand', '', '', 'https://dunedinsecurity.co.nz', '-45.8787605', '170.5027976', 13, 'Dunedin Security', 'bitcoinsupport@dunedinsecurity.co.nz', 2147483647, '', '1', 1, '2019-01-18 08:54:56', 0, NULL, 0),
(41, 'Vaping Giant', 'Vaping Giant, Euclid Avenue, Thunder Bay, ON, Canada', '', '', 'https://gonetcoins.com', '48.3804329', '-89.291393', 13, ' Netcoins', 'support@gonetcoins.com', 844515, '', '1', 1, '2019-01-18 08:56:49', 0, NULL, 0),
(42, 'Ticket Computer Center', 'Jubail Saudi Arabia', '', '', 'http://ticketcomputers.com', '26.9597709', '49.5687416', 13, 'TicketComputer', 'bitcoin@ticketcomputers.com', 2147483647, '', '1', 1, '2019-01-19 05:18:58', 0, NULL, 0),
(43, 'Valkea Oulu ', 'Köpcentrum Valkea, Isokatu, Oulu, Finland', '', '', 'https://bittimaatti.fi', '65.0116014', '25.472827', 13, 'Bittimaatti', 'support@bittimaatti.fi', 2147483647, '', '1', 1, '2019-01-19 05:20:42', 0, NULL, 0),
(44, 'Bitt office', 'Bridgetown, Barbados', '', '', 'https://bitt.com', '13.0968511', '-59.6144819', 13, 'Bitt', 'support@bitt.com', 0, '', '1', 1, '2019-01-19 05:22:16', 0, NULL, 0),
(45, 'Your Local Shop', 'Cork, Ireland', '', '', 'https://boinnex.com', '51.8985143', '-8.4756035', 13, 'Boinnex', 'support@boinnex.com', 0, '', '1', 1, '2019-01-19 05:23:23', 0, NULL, 0),
(46, 'Babylon Damp ', 'Babylon Vapeshop - E-Cigarettes in Kristiansand, Markens gate, Kristiansand, Norway', '', '', 'https://gmail.com', '58.1472837', '7.9893386', 13, ' Babylon Vapeshop AS', 'david.johannessen@gmail.com', 2147483647, '', '1', 1, '2019-01-19 05:25:45', 0, NULL, 0),
(47, 'World Travel Lounge', 'Blackpool, UK', '', '', 'https://getcoins.com', '53.8175053', '-3.0356748', 13, 'GetCoins', 'support@getcoins.com', 2147483647, '', '1', 1, '2019-01-19 05:27:52', 0, NULL, 0),
(48, 'Bitwork', 'Kowloon, Hong Kong', '', '', 'https://genesisblockhk.com', '22.3185673', '114.1796057', 13, 'Genesis Block', 'info@genesisblockhk.com', 0, '', '1', 1, '2019-01-19 05:31:39', 0, NULL, 0),
(49, 'Pharmasave Newtown Pharmac', 'Pharmasave Newtown Pharmacy, King Street, Newtown NSW, Australia', '', '', 'https://pharmasave.net.au', '-33.893108', '151.1848918', 13, 'Pharmasave Bitcoin', 'newtown@pharmasave.net.au', 295571376, '', '1', 1, '2019-01-19 05:36:18', 0, NULL, 0),
(50, 'Case & Covers', 'BITCOIN ATM, Av. Garcilaso de la Vega, Lima District, Peru', '', '', 'https://cajero.pe', '-12.0571938', '-77.0384566', 13, 'Cajero', 'hola@cajero.pe', 0, '', '1', 1, '2019-01-19 05:40:03', 0, NULL, 0),
(51, 'Trafik Fritz', 'Feldkirch, Austria', '', '', 'https://orderbob.com', '47.24128', '9.6019', 13, 'Orderbob', 'office@orderbob.com', 2147483647, '', '1', 1, '2019-01-19 05:42:56', 0, NULL, 0),
(52, 'Bitcoin ATM machine ', 'Fremantle WA, Australia', '', '', 'https://fremantlesfinest.com', '-32.0569', '115.7439', 13, 'Freo\'s Finest', 'info@fremantlesfinest.com', 893356249, '', '1', 1, '2019-01-19 05:44:36', 0, NULL, 0),
(53, 'Uganda Post Office', 'Kampala, Uganda', '', '', 'https://bit2big.com', '0.3475964', '32.5825197', 13, ' KIPYA Bit2Big LTD', 'contact@bit2big.com', 2147483647, '', '1', 1, '2019-01-19 05:45:44', 0, NULL, 0),
(54, 'Bitcoin.ai Ltd.', 'The Valley, Anguilla', '', '', 'https://gmail.com', '18.2148129', '-63.0574406', 13, 'Bitcoin.ai Ltd.', 'vincecate@gmail.com', 2147483647, '', '1', 1, '2019-01-19 05:47:11', 0, NULL, 0),
(55, 'Bailyk Finance', 'Astana, Kazakhstan', '', '', 'https://zzbit.com', '51.1605227', '71.4703558', 13, 'zzBit', 'help@zzbit.com', 0, '', '1', 1, '2019-01-19 05:49:08', 0, NULL, 0),
(56, 'KiirAutoLaen', 'Tallinn, Estonia', '', '', 'https://decrypto.ee', '59.4369608', '24.7535747', 13, 'DeCrypto OÜ', 'btc@decrypto.ee', 37253446, '', '1', 1, '2019-01-19 05:53:21', 0, NULL, 0),
(57, 'National Information Technology Park ', 'Ulaanbaatar, Mongolia', '', '', 'https://trade.mn', '47.8863988', '106.9057439', 13, 'Digital Exchange Mongolia', 'info@trade.mn', 2147483647, '', '1', 1, '2019-01-19 05:54:41', 0, NULL, 0),
(58, 'Rewell Center', 'Vaasa, Finland', '', '', 'https://bitco.ltd', '63.095089', '21.6164564', 13, 'Doers & Co.', 'support@bitco.ltd', 2147483647, '', '1', 1, '2019-01-19 05:56:21', 0, NULL, 0),
(59, 'Levendulavirag ', 'Békéscsaba, Hungary', '', '', 'http://gmail.com', '46.6735939', '21.0877309', 13, 'Gergely Szeplaki', 'gergo.szeplaki@gmail.com', 2147483647, '', '1', 1, '2019-01-19 05:58:42', 0, NULL, 0),
(60, 'The Mall', 'Sofia, Bulgaria', '', '', 'https://dg.cash', '42.6977082', '23.3218675', 13, ' DG.Cash', 'sofia@dg.cash', 2147483647, '', '1', 1, '2019-01-19 06:00:17', 0, NULL, 0),
(61, 'B4U ', 'Kuala Lumpur, Federal Territory of Kuala Lumpur, Malaysia', '', '', 'https://gmail.com', '3.139003', '101.686855', 13, 'B4U EXC (M) SDN BHD', 'b4uatm@gmail.com', 2147483647, '', '1', 1, '2019-01-19 06:02:11', 0, NULL, 0),
(62, 'Bitcoin ATM machine ', 'San Cristóbal de La Laguna, Spain', '', '', 'https://wamalax.com', '28.4874009', '-16.3159061', 13, 'Wamalax', 'info@wamalax.com', 2147483647, '', '1', 1, '2019-01-19 06:04:28', 0, NULL, 0),
(63, 'Walmart La Plata', 'Buenos Aires, Argentina', '', '', 'https://athenabitcoin.com.ar', '-34.6036844', '-58.3815591', 13, 'Athena Bitcoin', 'soporte@athenabitcoin.com.ar', 2147483647, '', '1', 1, '2019-01-19 06:05:41', 0, NULL, 0),
(64, 'Macaulay Cleanskins Wine', 'Melbourne VIC, Australia', '', '', 'https://bitrocket.io', '-37.8136276', '144.9630576', 13, ' BitRocket', 'info@bitrocket.io', 2147483647, '', '1', 1, '2019-01-19 06:22:12', 0, NULL, 0),
(65, 'Al-Ghalayini Center', 'Jeddah Saudi Arabia', '', '', 'https://gmail.com', '21.485811', '39.1925048', 13, 'Dr. Ahmed AlGhalayini', 'ghalamini@gmail.com', 2147483647, '', '1', 1, '2019-01-19 06:53:11', 0, NULL, 0),
(66, 'Test', 'Ahmedabad, Gujarat, India', '', '', 'http://www.googlem.com', '23.022505', '72.5713621', 1, 'Mital', 'mital.gal88@gmail.com', 1234467890, '', '1,2', 1, '2019-10-07 06:17:54', 0, NULL, 0),
(67, 'Test2', 'Gandhinagar, Gujarat, India', '', '', 'http://www.indiatimes.com', '23.2156354', '72.6369415', 1, 'Mital j', 'Mit8@gmail.com', 1234467899, '', '2,7', 1, '2019-10-07 06:20:28', 0, NULL, 0),
(68, 'TES TEST TEST', 'Ahmedabad, Gujarat, India', '1586596148-Capture001.png', '1586596148-Capture001.png', 'https://www.google.com', '23.022505', '72.5713621', 20, 'ABCBCB', 'abc@yopmail.com', NULL, NULL, '1', 1, '2020-04-11 09:09:08', NULL, NULL, NULL),
(69, 'Sent SMS', 'Rajkot Junction, Railway Station Road, Junction Plot, Rajkot, Gujarat, India', '', '', 'https://www.google.com', '22.3131558', '70.8025101', 3, 'ABCBCB', 'ghg@ayopmail.com', NULL, NULL, '2', 1, '2020-04-11 09:11:01', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crypto_acceptance_place_type`
--

CREATE TABLE `crypto_acceptance_place_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=inactive, 1= active, 2= deleted',
  `added_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `crypto_acceptance_place_type`
--

INSERT INTO `crypto_acceptance_place_type` (`id`, `name`, `status`, `added_date`) VALUES
(1, 'Shop', 1, NULL),
(2, 'Shopping Mall', 1, NULL),
(3, 'Fule station', 1, NULL),
(4, 'Hospital', 1, NULL),
(5, 'Restaurant/Food', 1, NULL),
(6, 'School', 1, NULL),
(7, 'Pharmacy', 1, NULL),
(8, 'Gym', 1, NULL),
(9, 'Garage ', 1, NULL),
(10, 'Airport', 1, NULL),
(11, 'Railway Station', 1, NULL),
(12, 'Parking', 1, NULL),
(13, 'Financial Services', 1, NULL),
(14, 'Education', 1, NULL),
(15, 'Health & Media', 1, NULL),
(16, 'Mass Media', 1, NULL),
(17, 'IT Services', 1, NULL),
(18, 'Hotel & Travel', 1, NULL),
(19, 'Internet Service Provider', 1, NULL),
(20, 'Real Estate', 1, NULL),
(21, 'Movie Theater', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currency_master`
--

CREATE TABLE `currency_master` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `crypto` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currency_master`
--

INSERT INTO `currency_master` (`id`, `name`, `currency_code`, `crypto`, `status`) VALUES
(1, 'Bitcoin', 'BTC', 1, 1),
(2, 'BitShares', 'BTS', 1, 1),
(3, 'Dash', 'DASH', 1, 1),
(4, 'DogeCoin', 'DOGE', 1, 1),
(5, 'EarthCoin', 'EAC', 1, 1),
(6, 'Emercoin', 'EMC', 1, 1),
(7, 'Ethereum', 'ETH', 1, 1),
(8, 'Factom', 'FCT', 1, 1),
(9, 'Feathercoin', 'FTC', 1, 1),
(10, 'Linden Dollar', 'LD', 1, 1),
(11, 'LiteCoin', 'LTC', 1, 1),
(12, 'Namecoin', 'NMC', 1, 1),
(13, 'NovaCoin', 'NVC', 1, 1),
(14, 'Nxt', 'NXT', 1, 1),
(15, 'Peercoin', 'PPC', 1, 1),
(16, 'Stellar', 'STR', 1, 1),
(17, 'Venezuelan Bolívar (Black Market)', 'VEF_BLKMKT', 1, 1),
(18, 'Venezuelan Bolívar (DICOM)', 'VEF_DICOM', 1, 1),
(19, 'Venezuelan Bolívar (DIPRO)', 'VEF_DIPRO', 1, 1),
(20, 'VertCoin', 'VTC', 1, 1),
(21, 'Monero', 'XMR', 1, 1),
(22, 'Primecoin', 'XPM', 1, 1),
(23, 'Ripple', 'XRP', 1, 1),
(24, 'Mauritanian Ouguiya', 'MRU', 1, 1),
(25, 'São Tomé and Príncipe Dobra', 'STN', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` bigint(20) NOT NULL,
  `firstname` varchar(191) NOT NULL,
  `lastname` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `order_type` enum('Delivery','Servicing','Installation') NOT NULL,
  `order_value` float(23,19) DEFAULT NULL,
  `scheduled_date` date NOT NULL,
  `street_address` text NOT NULL,
  `city` varchar(191) NOT NULL,
  `state` varchar(191) DEFAULT NULL,
  `postal_zipcode` varchar(191) DEFAULT NULL,
  `country` varchar(191) NOT NULL,
  `status` enum('Pending','Assigned','On Route','Done','Cancelled') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crypto_acceptance`
--
ALTER TABLE `crypto_acceptance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crypto_acceptance_place_type`
--
ALTER TABLE `crypto_acceptance_place_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_master`
--
ALTER TABLE `currency_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crypto_acceptance`
--
ALTER TABLE `crypto_acceptance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `crypto_acceptance_place_type`
--
ALTER TABLE `crypto_acceptance_place_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `currency_master`
--
ALTER TABLE `currency_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
