-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2024 at 07:08 PM
-- Server version: 8.0.36-0ubuntu0.20.04.1
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intercombio`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_masters`
--

CREATE TABLE `action_masters` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint DEFAULT '0',
  `action` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_in_menu` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_in_permission` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_order` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0' COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `availabilities`
--

CREATE TABLE `availabilities` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `availabilities`
--

INSERT INTO `availabilities` (`id`, `user_id`, `day`, `time_from`, `time_to`, `created_at`, `updated_at`) VALUES
(1, '2', 'Monday', '2:17 AM', '4:17 AM', '2024-01-25 11:00:12', NULL),
(2, '2', 'Tuesday', '2:17 AM', '5:17 AM', '2024-01-25 11:00:12', NULL),
(3, '5', 'Monday', '2:56 PM', '5:56 PM', '2024-01-02 09:26:37', NULL),
(4, '5', 'Tuesday', '2:56 PM', '6:56 PM', '2024-01-02 09:26:37', NULL),
(5, '9', 'Monday', '9:00 AM', '11:00 AM', '2024-01-04 16:11:26', NULL),
(6, '9', 'Wednesday', '9:00 AM', '11:00 AM', '2024-01-04 16:11:26', NULL),
(7, '10', 'Monday', '4:10 PM', '5:11 PM', '2024-02-17 03:56:11', NULL),
(8, '10', 'Tuesday', '3:11 PM', '3:11 PM', '2024-02-17 03:56:11', NULL),
(9, '15', 'Monday', '1:08 PM', '2:08 PM', '2024-01-29 07:39:14', NULL),
(10, '15', 'Tuesday', '2:10 PM', '4:21 PM', '2024-01-29 07:39:14', NULL),
(11, '21', 'Monday', '12:24 PM', '6:24 PM', '2024-02-21 00:42:20', NULL),
(12, '21', 'Wednesday', '7:24 PM', '7:24 PM', '2024-02-21 00:42:20', NULL),
(13, '21', 'Tuesday', '12:11 PM', '1:11 PM', '2024-02-21 00:42:20', NULL),
(16, '39', 'Monday', '09:00', '17:00', '2024-03-13 06:48:57', NULL),
(17, '39', 'Tuesday', '09:00', '17:00', '2024-03-13 06:48:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `state_id` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `zipcode`, `state_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Broomfield', '80020', 4, 1, '1', '1', '2023-12-14 10:02:53', '2024-01-15 09:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `level`, `title`, `class_type`, `course_id`, `course_name`, `course_type`, `user_type`, `batch_id`, `batch_name`, `short_description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '5L', '5L - Online - Teacher', 'Online', 'clj4fej92kq0n85op3b0', 'Level 5L - Online Program', 'course materials', 'Teacher', 'clj4fej92kq0n85op3bg', '5L - Lessons', 'Materials for Book 5L for online participants', 1, '1', NULL, '2024-02-13 05:36:29', '2024-02-13 05:36:29'),
(2, '5L', '5L - Online - Teacher', 'Online', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 05:38:25', '2024-02-13 05:38:25'),
(3, '5L', '5L - Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 05:41:08', '2024-02-13 05:41:08'),
(4, '5R', '5R - Online - Teacher', 'Online', 'cl02eddonhcr4dfed410', 'Level 5R- Online Program', 'course materials', 'Teacher', 'cl02eddonhcr4dfed41g', '5R - Lessons', 'Materials for Book 5R for online participants', 1, '1', NULL, '2024-02-13 05:43:09', '2024-02-13 05:43:09'),
(5, '5R', '5R - Online - Teacher', 'Online', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 05:45:18', '2024-02-13 05:45:18'),
(6, '5R', '5R - Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 05:46:50', '2024-02-13 05:46:50'),
(7, '4L', '4L - Online - Teacher', 'Online', 'ckvu2rlonhcr4dfealrg', 'Level 4L - Online Program', 'course materials', 'Teacher', 'ckvu2rlonhcr4dfeals0', '4L - Lessons', 'Materials for Book 4L for online participants', 1, '1', NULL, '2024-02-13 05:48:59', '2024-02-13 05:48:59'),
(8, '4L', '4L - Online - Teacher', 'Online', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 05:50:20', '2024-02-13 05:50:20'),
(9, '4L', '4L - Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 05:52:37', '2024-02-13 05:52:37'),
(10, '4R', '4R - Online - Teacher', 'Online', 'cma7lcr92kq4586fr6pg', 'Level 4R - Online Program', 'course materials', 'Teacher', 'cl4h70r92kq9v22mbkg0', '4R - Lessons', 'Materials for Book 4R for online participants', 1, '1', NULL, '2024-02-13 05:54:12', '2024-02-13 05:54:12'),
(11, '4R', '4R - Online - Teacher', 'Online', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 05:55:41', '2024-02-13 05:55:41'),
(12, '4R', '4R - Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 05:57:32', '2024-02-13 05:57:32'),
(13, '3L', '3L - Online - Teacher', 'Online', 'clnoc6j92kq93pkidq50', 'Level 3L - Online Program', 'course materials', 'Teacher', 'clnoc6j92kq93pkidq5g', '3L - Lessons', 'Materials for Book 3L for online participants', 1, '1', NULL, '2024-02-13 05:59:56', '2024-02-13 05:59:56'),
(14, '3L', '3L - Online - Teacher', 'Online', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 06:01:33', '2024-02-13 06:01:33'),
(15, '3L', '3L - Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 06:03:20', '2024-02-13 06:03:20'),
(16, '3R', '3R - Online - Teacher', 'Online', 'clnplrpnuvtc37dnh5og', 'Level 3R - Online Program', 'course materials', 'Teacher', 'clnplrpnuvtc37dnh5p0', '3R - Lessons', 'Materials for Book 3R for online participants', 1, '1', NULL, '2024-02-13 06:05:08', '2024-02-13 06:05:08'),
(17, '3R', '3R - Online - Teacher', 'Online', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 06:06:33', '2024-02-13 06:06:33'),
(18, '3R', '3R - Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 06:13:21', '2024-02-13 06:13:21'),
(19, '2L', '2L - Online - Teacher', 'Online', 'cloc8k1nuvtc37dnk23g', 'Level 2L - Online Program', 'course materials', 'Teacher', 'cloc8k1nuvtc37dnk240', '2L - Lessons', 'Materials for Book 2L for online participants', 1, '1', NULL, '2024-02-13 06:15:14', '2024-02-13 06:15:14'),
(20, '2L', '2L - Online - Teacher', 'Online', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 06:17:41', '2024-02-13 06:17:41'),
(21, '2L', '2L - Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 06:19:11', '2024-02-13 06:19:11'),
(22, '2R', '2R - Online - Teacher', 'Online', 'cloedlhnuvtc37dnk9t0', 'Level 2R - Online Program', 'course materials', 'Teacher', 'cloedlhnuvtc37dnk9tg', '2R - Lessons', 'Materials for Book 2R for online participants', 1, '1', NULL, '2024-02-13 06:21:14', '2024-02-13 06:21:14'),
(23, '2R', '2R - Lessons', 'Online', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 06:23:49', '2024-02-13 06:23:49'),
(24, '2R', '2R - Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 06:26:48', '2024-02-13 06:26:48'),
(25, '1L', '1L - Online - Teacher', 'Online', 'Level 1L - Online Program', 'clp17eb92kq93pkoj7e0', 'course materials', 'Teacher', 'clp17eb92kq93pkoj7eg', '1L - Lessons', 'Materials for Book 1L for online participants', 1, '1', NULL, '2024-02-13 06:29:20', '2024-02-13 06:29:20'),
(26, '1L', '1L - Online - Teacher', 'Online', '1L - Online - Teacher', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'Orientation for online teachers', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 06:30:46', '2024-02-13 06:30:46'),
(27, '1L', '1L - Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 06:33:34', '2024-02-13 06:33:34'),
(28, '1R', '1R- Online - Teacher', 'Online', 'clp1imj92kq93pkokv1g', 'Level 1R - Online Program', 'course materials', 'Teacher', 'clp1imj92kq93pkokv20', '1R - Lessons', 'Materials for Book 1R for online participants', 1, '1', NULL, '2024-02-13 06:35:13', '2024-02-13 06:35:13'),
(29, '1R', '1R- Online - Teacher', 'Online', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 06:37:14', '2024-02-13 06:37:14'),
(30, '1R', '1R- Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 06:38:47', '2024-02-13 06:38:47'),
(31, 'Intro', 'Intro - Online - Teacher', 'Online', 'clp3q5r92kq93pkoo1t0', 'Intro - Online Program', 'course materials', 'Teacher', 'clp3q5r92kq93pkoo1tg', 'Intro - Lessons', 'Materials for Book Intro for online participants', 1, '1', NULL, '2024-02-13 06:41:11', '2024-02-13 06:41:11'),
(32, 'Intro', 'Intro - Online - Teacher', 'Online', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'orientation', 'Teacher', 'cjhqbn85utj49margtg0', 'Orientation for One-on-One Teachers Online', 'Orientation for online teachers', 1, '1', NULL, '2024-02-13 06:43:02', '2024-02-13 06:43:02'),
(33, 'Intro', 'Intro - Online - Teacher', 'Online', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 06:44:46', '2024-02-13 06:44:46'),
(34, '5L', '5L - One-on-One BCP - Teacher', 'One To One', 'clpkp2j92kq93pkql810', 'Level 5L - Boulder County Program', 'course materials', 'Teacher', 'cmrajchnuvta4ptn0mvg', '5L - Boulder County One-on-One', 'Materials for Book 5L for Boulder County participants', 1, '1', NULL, '2024-02-13 06:48:08', '2024-02-13 06:48:08'),
(35, '5L', '5L - One-on-One BCP - Teacher', 'One To One', 'cmg50ej92kqcqhg13bpg', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 06:49:59', '2024-02-13 06:49:59'),
(36, '5L', '5L - One-on-One BCP - Teacher', 'One To One', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 06:52:35', '2024-02-13 06:52:35'),
(37, '5R', '5R- One-on-One BCP - Teacher', 'One To One', 'cma7i7pnuvt09kqq630g', 'Level 5R - Boulder County Program', 'course materials', 'Teacher', 'cn24hnj92kq4rc5kdqtg', '5R - Boulder County One-on-One', 'Materials for Book 5R for Boulder County participants', 1, '1', NULL, '2024-02-13 06:54:32', '2024-02-13 06:54:32'),
(38, '5R', '5R- One-on-One BCP - Teacher', 'One To One', 'cmg50ej92kqcqhg13bpg', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 06:57:38', '2024-02-13 06:57:38'),
(39, '5R', '5R- One-on-One BCP - Teacher', 'One To One', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 06:59:36', '2024-02-13 06:59:36'),
(40, '4L', '4L - One-on-One BCP - Teacher', 'One To One', 'cma7k19nuvt09kqq63t0', 'Level 4L - Boulder County Program', 'course materials', 'Teacher', 'cmrsbphnuvt7d8k7u2c0', '4L - Boulder County One-on-One', 'Materials for Book 4L for Boulder County participants', 1, '1', NULL, '2024-02-13 07:01:26', '2024-02-13 07:01:26'),
(41, '4L', '4L - One-on-One BCP - Teacher', 'One To One', 'cmg50ej92kqcqhg13bpg', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 07:06:12', '2024-02-13 07:06:12'),
(42, '4L', '4L - One-on-One BCP - Teacher', 'One To One', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 07:07:37', '2024-02-13 07:07:37'),
(43, '4R', '4R - One-on-One BCP - Teacher', 'One To One', 'cma7lcr92kq4586fr6pg', 'Level 4R - Boulder County Program', 'course materials', 'Teacher', 'cn24ia392kq4rc5kdtig', '4R - Boulder County One-on-One', 'Materials for Book 4R for Boulder County participants', 1, '1', NULL, '2024-02-13 07:09:31', '2024-02-13 07:09:31'),
(44, '4R', '4R - One-on-One BCP - Teacher', 'One To One', 'cmg50ej92kqcqhg13bpg', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 07:11:01', '2024-02-13 07:11:01'),
(45, '4R', '4R - One-on-One BCP - Teacher', 'One To One', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 07:12:36', '2024-02-13 07:12:36'),
(46, '3L', '3L - One-on-One BCP - Teacher', 'One To One', 'cma7mh392kq4586fr8u0', 'Level 3L - Boulder County Program', 'course materials', 'Teacher', 'cmrse79nuvt7d8k7u35g', '3L - Boulder County One-on-One', 'Materials for Book 3L for Boulder County participants', 1, '1', NULL, '2024-02-13 07:14:07', '2024-02-13 07:14:07'),
(47, '3L', '3L - One-on-One BCP - Teacher', 'One To One', 'cmg50ej92kqcqhg13bpg', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 07:15:40', '2024-02-13 07:15:40'),
(48, '3L', '3L - One-on-One BCP - Teacher', 'One To One', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 07:16:59', '2024-02-13 07:16:59'),
(49, '3R', '3R - One-on-One BCP - Teacher', 'One To One', 'cma7nohnuvt09kqq65n', 'Level 3R - Boulder County Program', 'course materials', 'Teacher', 'cn24ihr92kq4rc5kduqg', '3R - Boulder County One-on-One', 'Materials for Book 3R for Boulder County participants', 1, '1', NULL, '2024-02-13 07:18:27', '2024-02-13 07:18:27'),
(50, '3R', '3R - One-on-One BCP - Teacher', 'One To One', '3R - One-on-One BCP - Teacher', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 07:19:48', '2024-02-13 07:19:48'),
(51, '3R', '3R - One-on-One BCP - Teacher', 'One To One', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 07:21:15', '2024-02-13 07:21:15'),
(52, '2L', '2L - One-on-One BCP - Teacher', 'One To One', 'cma7p7hnuvt09kqq66f0', 'Level 2L - Boulder County Program', 'course materials', 'Teacher', 'cmrsf4j92kq5c43ggsqg', '2L - Boulder County One-on-One', 'Level 2L - Boulder County Program', 1, '1', NULL, '2024-02-13 07:22:42', '2024-02-13 07:22:42'),
(53, '2L', '2L - One-on-One BCP - Teacher', 'One To One', 'cmg50ej92kqcqhg13bpg', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 07:24:28', '2024-02-13 07:24:28'),
(54, '2L', '2L - One-on-One BCP - Teacher', 'One To One', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 07:26:48', '2024-02-13 07:26:48'),
(55, '2R', '2R - One-on-One BCP - Teacher', 'One To One', 'cma7qh392kq4586frhug', 'Level 2R - Boulder County Program', 'course materials', 'Teacher', 'cn24ikj92kq4rc5kdve0', '2R - Boulder County One-on-One', 'Materials for Book 2R for Boulder County participants', 1, '1', NULL, '2024-02-13 07:28:01', '2024-02-13 07:28:01'),
(56, '2R', '2R - One-on-One BCP - Teacher', 'One To One', 'cmg50ej92kqcqhg13bpg', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 07:29:08', '2024-02-13 07:29:08'),
(57, '2R', '2R - One-on-One BCP - Teacher', 'One To One', 'cma7qh392kq4586frhug', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 07:30:30', '2024-02-13 07:30:30'),
(58, '1L', '1L - One-on-One BCP - Teacher', 'One To One', 'cma7rqpnuvt09kqq67gg', 'Level 1L - Boulder County Program', 'course materials', 'Teacher', 'cmrsfl392kq5c43gguag', '1L - Boulder County One-on-One', 'Materials for Book 1L for Boulder County participants', 1, '1', NULL, '2024-02-13 07:32:03', '2024-02-13 07:32:03'),
(59, '1L', '1L - One-on-One BCP - Teacher', 'One To One', 'cmg50ej92kqcqhg13bpg', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 07:33:39', '2024-02-13 07:33:39'),
(60, '1L', '1L - One-on-One BCP - Teacher', 'One To One', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 07:35:31', '2024-02-13 07:35:31'),
(61, '1R', '1R - One-on-One BCP - Teacher', 'One To One', 'cma7suj92kq4586frnmg', 'Level 1R - Boulder County Program', 'course materials', 'Teacher', 'cn24io1nuvt09uicvibg', '1R - Boulder County One-on-One', 'Materials for Book 1R for Boulder County participants', 1, '1', NULL, '2024-02-13 07:36:53', '2024-02-13 07:36:53'),
(62, '1R', '1R - One-on-One BCP - Teacher', 'One To One', 'cmg50ej92kqcqhg13bpg', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 07:38:04', '2024-02-13 07:38:04'),
(63, '1R', '1R - One-on-One BCP - Teacher', 'One To One', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 07:43:22', '2024-02-13 07:43:22'),
(64, 'Intro', 'Intro - One-on-One BCP - Teacher', 'One To One', 'cma7tvr92kq4586frql0', 'Level Intro - Boulder County Program', 'course materials', 'Teacher', 'cmrsg2r92kq5c43ggvs0', 'Intro - Boulder County One-on-One', 'Materials for Book Intro for Boulder County participants', 1, '1', NULL, '2024-02-13 07:44:51', '2024-02-13 07:44:51'),
(65, 'Intro', 'Intro - One-on-One BCP - Teacher', 'One To One', 'cmg50ej92kqcqhg13bpg', 'Volunteer Teacher Training Course', 'orientation', 'Teacher', 'cmg50ej92kqcqhg13bq0', 'Teacher Training Course', 'Training for volunteer teachers', 1, '1', NULL, '2024-02-13 07:46:26', '2024-02-13 07:46:26'),
(66, 'Intro', 'Intro - One-on-One BCP - Teacher', 'One To One', 'cjt7uhb92kq579gemsng', 'Volunteer Resources', 'volunteer resources', 'Teacher', 'cjt7um1nuvt5a16k0ncg', 'Class Materials and Additional Training', 'Class Materials and Additional Training', 1, '1', NULL, '2024-02-13 07:49:24', '2024-02-13 07:49:24'),
(67, '5L', '5L - Online - Student', 'Online', 'clj4fej92kq0n85op3b0', 'Level 5L - Online Program', NULL, 'Student', 'clj4fej92kq0n85op3bg', '5L - Lessons', 'Materials for Book 5L for online participants', 1, '1', NULL, '2024-02-13 09:02:53', '2024-02-13 09:02:53'),
(68, '4L', '4L - Online- Student', 'Online', 'ckvu2rlonhcr4dfealrg', 'Level 4L - Online Program', NULL, 'Student', 'ckvu2rlonhcr4dfeals0', '4L - Lessons', 'Materials for Book 4L for online participants', 1, '1', NULL, '2024-02-13 09:04:07', '2024-02-13 09:04:07'),
(69, '3L', '3L - Online - Student', 'Online', 'clnoc6j92kq93pkidq50', 'Level 3L - Online Program', NULL, 'Student', 'clnoc6j92kq93pkidq5g', '3L - Lessons', 'Materials for Book 3L for online participants', 1, '1', NULL, '2024-02-13 09:05:19', '2024-02-13 09:05:19'),
(70, '2L', '2L - Online - Student', 'Online', 'cloc8k1nuvtc37dnk23g', 'Level 2L - Online Program', NULL, 'Student', 'cloc8k1nuvtc37dnk240', '2L - Lessons', 'Materials for Book 2L for online participants', 1, '1', NULL, '2024-02-13 09:11:27', '2024-02-13 09:11:27'),
(71, '1L', '1L - Online - Student', 'Online', 'clp17eb92kq93pkoj7e0', 'Level 1L - Online Program', NULL, 'Student', 'clp17eb92kq93pkoj7eg', '1L - Lessons', 'Materials for Book 1L for online participants', 1, '1', NULL, '2024-02-13 09:12:29', '2024-02-13 09:12:29'),
(72, 'Intro', 'Intro - Online - Student', 'Online', 'clp3q5r92kq93pkoo1t0', 'Intro - Online Program', NULL, 'Student', 'clp3q5r92kq93pkoo1tg', 'Intro - Lessons', 'Materials for Book Intro for online participants', 1, '1', NULL, '2024-02-13 09:14:52', '2024-02-13 09:14:52'),
(73, '5L', '5L - One-on-One BCP - Student', 'One To One', 'clpkp2j92kq93pkql810', 'Level 5L - Boulder County Program', NULL, 'Student', 'cmrajchnuvta4ptn0mvg', '5L - Boulder County One-on-One', 'Materials for Book 5L for Boulder County participants', 1, '1', NULL, '2024-02-13 09:16:08', '2024-02-13 09:16:08'),
(74, '4L', '4L - One-on-One BCP - Student', 'One To One', 'cma7k19nuvt09kqq63t0', 'Level 4L - Boulder County Program', NULL, 'Student', 'cmrsbphnuvt7d8k7u2c0', '4L - Boulder County One-on-One', 'Materials for Book 4L for Boulder County participants', 1, '1', NULL, '2024-02-13 09:17:21', '2024-02-13 09:17:21'),
(75, '3L', '3L - One-on-One BCP - Student', 'One To One', 'cma7mh392kq4586fr8u0', 'Level 3L - Boulder County Program', NULL, 'Student', 'cmrse79nuvt7d8k7u35g', '3L - Boulder County One-on-One', 'Materials for Book 3L for Boulder County participants', 1, '1', NULL, '2024-02-13 09:18:27', '2024-02-13 09:18:27'),
(76, '2L', '2L - One-on-One BCP - Student', 'One To One', 'cma7p7hnuvt09kqq66f0', 'Level 2L - Boulder County Program', NULL, 'Student', 'cmrsf4j92kq5c43ggsqg', '2L - Boulder County One-on-One', 'Materials for Book 2L for Boulder County participants', 1, '1', NULL, '2024-02-13 09:19:22', '2024-02-13 09:19:22'),
(77, '1L', '1L - One-on-One BCP - Student', 'One To One', 'cma7rqpnuvt09kqq67gg', 'Level 1L - Boulder County Program', NULL, 'Student', 'cmrsfl392kq5c43gguag', '1L - Boulder County One-on-One', 'Materials for Book 1L for Boulder County participants', 1, '1', NULL, '2024-02-13 09:21:24', '2024-02-13 09:21:24'),
(78, 'Intro', 'Intro - One-on-One BCP - Student', 'One To One', 'cma7tvr92kq4586frql0', 'Level Intro - Boulder County Program', NULL, 'Student', 'cmrsg2r92kq5c43ggvs0', 'Intro - Boulder County One-on-One', 'Materials for Book Intro for Boulder County participants', 1, '1', NULL, '2024-02-13 09:22:32', '2024-02-13 09:22:32'),
(79, '5L', '5L - Group Class BCP - Student', 'Group Class', 'clpkp2j92kq93pkql810', 'Level 5L - Boulder County Program', NULL, 'Student', 'clpksj1nuvtc37dnsed0,clpksrpnuvtc37dnsejg,cmbh0nb92kq4586l312g,cmc2me392kq4586o87qg', '5L - Longmont, 10am-12pm Tuesday and Thursday,5L - Longmont, 6 - 8pm, Tuesday and Thursday,5L - Boulder, 10am-12pm Tuesday and Thursday,5L - Boulder, 6-8pm Tuesday and Thursday', 'Materials for Book 5L for Boulder County participants', 1, '1', NULL, '2024-02-13 09:26:11', '2024-02-13 09:26:11'),
(80, '5R', '5R - Group Class BCP -Student', 'Group Class', 'cma7i7pnuvt09kqq630g', 'Level 5R - Boulder County Program', NULL, 'Student', 'cmc2mtr92kq4586o8blg,cmc2n0hnuvt09kqqidkg,cmc2n5r92kq4586o8dj0,cmc2n8hnuvt09kqqidug', '5R - Longmont, 10am-12pm Tuesday and Thursday,5R - Longmont, 6 - 8pm, Tuesday and Thursday,5R - Boulder, 10am-12pm Tuesday and Thursday,5R - Boulder, 6-8pm Tuesday and Thursday', 'Materials for Book 5R for Boulder County participants', 1, '1', NULL, '2024-02-13 09:28:53', '2024-02-13 09:28:53'),
(81, '4L', '4L - Group Class BCP -Student', 'Group Class', 'cma7k19nuvt09kqq63t0', 'Level 4L - Boulder County Program', NULL, 'Student', 'cmc2nhb92kq4586o8gl0,cmc2njpnuvt09kqqie60,cmc2nlpnuvt09kqqieb0,cmc2no392kq4586o8i90', '4L - Longmont, 10am-12pm Tuesday and Thursday, Start Date - January 18th, 2024,4L - Longmont, 6 - 8pm, Tuesday and Thursday, Start Date - January 18th, 2024,4L - Boulder, 10am-12pm Tuesday and Thursday, Start Date - January 18th, 2024,4L - Boulder, 6-8pm Tuesday and Thursday, Start Date - January 18th, 2024', 'Materials for Book 4L for Boulder County participants', 1, '1', NULL, '2024-02-13 09:41:53', '2024-02-13 09:41:53'),
(82, '4R', '4R - Group Class BCP -Student', 'Group Class', 'cma7lcr92kq4586fr6pg', 'Level 4R - Boulder County Program', NULL, 'Student', 'cmc2nvr92kq4586o8kbg,cmc2o2b92kq4586o8l10,cmc2o5392kq4586o8lo0,cmc2o91nuvt09kqqiel0', '4R - Longmont, 10am-12pm Tuesday and Thursday,4R - Longmont, 6 - 8pm, Tuesday and Thursday,4R - Boulder, 10am-12pm Tuesday and Thursday,4R - Boulder, 6-8pm Tuesday and Thursday', 'Materials for Book 4R for Boulder County participants', 1, '1', NULL, '2024-02-13 09:44:56', '2024-02-13 09:44:56'),
(83, '3L', '3L - Group Class BCP -Student', 'Group Class', 'cma7mh392kq4586fr8u0', 'Level 3L - Boulder County Program', NULL, 'Student', 'cmc2odr92kq4586o8nsg,cmc2ofpnuvt09kqqietg,cmc2ohr92kq4586o8on0,cmc2ok1nuvt09kqqif2g', '3L - Longmont, 10am-12pm Tuesday and Thursday,3L - Longmont, 6 - 8pm, Tuesday and Thursday,3L - Boulder, 10am-12pm Tuesday and Thursday,3L - Boulder, 6-8pm Tuesday and Thursday', 'Materials for Book 3L for Boulder County participants', 1, '1', NULL, '2024-02-13 09:47:54', '2024-02-13 09:47:54'),
(84, '3R', '3R - Group Class BCP -Student', 'Group Class', 'cma7nohnuvt09kqq65ng', 'Level 3R - Boulder County Program', NULL, 'Student', 'cmc2oq1nuvt09kqqif9g,cmc2os1nuvt09kqqifeg,cmc2ouj92kq4586o8r0g,cmc2p0392kq4586o8r70', '3R - Longmont, 10am-12pm Tuesday and Thursday,3R - Longmont, 6 - 8pm, Tuesday and Thursday,3R - Boulder, 10am-12pm Tuesday and Thursday,3R - Boulder, 6-8pm Tuesday and Thursday', 'Materials for Book 3R for Boulder County participants', 1, '1', NULL, '2024-02-13 09:50:18', '2024-02-13 09:50:18'),
(85, '2L', '2L - Group Class BCP -Student', 'Group Class', 'cma7p7hnuvt09kqq66f0', 'Level 2L - Boulder County Program', NULL, 'Student', 'cmc2p89nuvt09kqqiftg,cmc2p9pnuvt09kqqig2g,cmc2pbr92kq4586o8s10,cmc2pdpnuvt09kqqigeg', '2L - Longmont, 10am-12pm Tuesday and Thursday,2L - Longmont, 6 - 8pm, Tuesday and Thursday,2L - Boulder, 10am-12pm Tuesday and Thursday,2L - Boulder, 6-8pm Tuesday and Thursday', 'Materials for Book 2L for Boulder County participants', 1, '1', NULL, '2024-02-13 09:52:56', '2024-02-13 09:52:56'),
(86, '2R', '2R - Group Class BCP -Student', 'Group Class', 'cma7qh392kq4586frhug', 'Level 2R - Boulder County Program', NULL, 'Student', 'cmc2pjpnuvt09kqqigk0,cmkm87b92kqfhklm3nbg,cmc2po1nuvt09kqqigv0,cmc2pq9nuvt09kqqih4g', '2R - Longmont, 10am-12pm Tuesday and Thursday, 2R - Longmont, 6 - 8pm, Tuesday and Thursday,2R - Boulder, 10am-12pm Tuesday and Thursday,2R - Boulder, 6-8pm Tuesday and Thursday', 'Materials for Book 2R for Boulder County participants', 1, '1', NULL, '2024-02-13 09:55:55', '2024-02-13 09:55:55'),
(87, '1L', '1L - Group Class BCP -Student', 'Group Class', '/cma7rqpnuvt09kqq67gg', 'Level 1L - Boulder County Program', NULL, 'Student', 'cmc2pvr92kq4586o8ud0,cmc2q1hnuvt09kqqihag,cmc2q3r92kq4586o8ur0,cmc2q5j92kq4586o8v1g', '1L - Longmont, 10am-12pm Tuesday and Thursday,1L - Longmont, 6 - 8pm, Tuesday and Thursday,1L - Boulder, 10am-12pm Tuesday and Thursday,1L - Boulder, 6-8pm Tuesday and Thursday', 'Materials for Book 1L for Boulder County participants', 1, '1', NULL, '2024-02-13 09:58:07', '2024-02-13 09:58:07'),
(88, '1R', '1R - Group Class BCP -Student', 'Group Class', 'cma7suj92kq4586frnmg', 'Level 1R - Boulder County Program', NULL, 'Student', 'cmc2qb9nuvt09kqqiho0,cmc2qd9nuvt09kqqii00,cmc2qf9nuvt09kqqii60,cmc2qh392kq4586o8vt0', '1R - Longmont, 10am-12pm Tuesday and Thursday,1R - Longmont, 6 - 8pm, Tuesday and Thursday,1R - Boulder, 10am-12pm Tuesday and Thursday,1R - Boulder, 6-8pm Tuesday and Thursday', 'Materials for Book 1R for Boulder County participants', 1, '1', NULL, '2024-02-13 10:00:19', '2024-02-13 10:00:19'),
(89, 'Intro', 'Intro - Group Class BCP -Student', 'Group Class', 'cma7tvr92kq4586frql0', 'Level Intro - Boulder County Program', NULL, 'Student', 'cmc2qr1nuvt09kqqij40,cmc2qt9nuvt09kqqij90,cmc2qvj92kq4586o9170,cmc2r1pnuvt09kqqijgg', 'Intro - Longmont, 10am-12pm Tuesday and Thursday,Intro - Longmont, 6 - 8pm, Tuesday and Thursday, Intro - Boulder, 10am-12pm Tuesday and Thursday,Intro - Boulder, 6-8pm Tuesday and Thursday', 'Materials for Book Intro for Boulder County participants', 1, '1', NULL, '2024-02-13 10:02:01', '2024-02-13 10:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finish_courses`
--

CREATE TABLE `finish_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `pairing_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finish_courses`
--

INSERT INTO `finish_courses` (`id`, `pairing_id`, `student_id`, `teacher_id`, `level`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(2, '6', '10', '24', '5L', 'Finished current course', 2, '2024-02-17 03:59:18', NULL),
(3, '9', '10', '24', '5L', 'Finished current course', 1, '2024-02-20 00:48:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merithub_creditionals`
--

CREATE TABLE `merithub_creditionals` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merithub_token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merithub_creditionals`
--

INSERT INTO `merithub_creditionals` (`id`, `client_id`, `client_secret`, `timezone`, `merithub_token`, `created_at`, `updated_at`) VALUES
(1, 'cjhqbn85utj49margtg0', '$2a$04$j/tYv1BLupeM8PDOrlUUvOq9Eel1JSof2msoLUr11z61EqCxY.U.2', 'Asia/Kolkata', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJNSFMiOiJ0bEQ4NUZmIiwiZXhwIjozNTk5OTYzNTY5LCJpZCI6ImNqaHFibjg1dXRqNDltYXJndGcwIiwibnQiOiJjamhxYm44NXV0ajQ5bWFyZ3RnMCIsInBtIjoiVU0gUE0gQkwgQ0MgUEwiLCJybCI6IkEiLCJ0eiI6IkFtZXJpY2EvRGVudmVyIiwidXQiOiJzdSJ9.WmHYsN9WNIxa-De_3gpOFNlNcDb4mmhbvAdOfdVQzXE', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_13_104123_create_questions_table', 2),
(6, '2023_12_13_112015_create_question_options_table', 2),
(7, '2023_12_18_064520_create_students_table', 3),
(8, '2023_12_18_121413_create_question_entries_table', 3),
(9, '2023_12_22_065603_create_teachers_table', 4),
(10, '2023_12_22_131951_create_zip_codes_table', 4),
(11, '2023_12_23_045537_create_teacher_quizzes_table', 5),
(12, '2023_12_27_062914_create_email_templates_table', 6),
(13, '2024_01_05_084107_create_courses_table', 6),
(14, '2024_01_05_105435_create_payments_table', 6),
(15, '2024_02_02_114116_create_purchase_classes_table', 7),
(16, '2024_02_02_114444_create_subscription_credits_table', 7),
(17, '2024_02_03_063453_create_student_payments_table', 8),
(18, '2024_02_05_114326_create_teacher_pairings_table', 9),
(19, '2024_02_06_065754_create_student_pairings_table', 10),
(20, '2024_02_07_112113_create_supports_table', 11),
(21, '2024_02_09_084047_create_finish_courses_table', 12),
(22, '2024_02_13_104446_create_new_batch_pairs_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `new_batch_pairs`
--

CREATE TABLE `new_batch_pairs` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_batch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_batch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_batch_pairs`
--

INSERT INTO `new_batch_pairs` (`id`, `course_id`, `new_batch_id`, `new_batch_name`, `student_id`, `teacher_id`, `level`, `class_type`, `created_at`, `updated_at`) VALUES
(3, 'clpkp2j92kq93pkql810', 'cn5l3kr92kqf7vcuhlkg', '5L Lessons priyanshu, priyanshu', '21', '6', '5L', 'One To One', '2024-02-13 05:56:11', NULL),
(6, 'clpkp2j92kq93pkql810', 'cn6aa1392kqf7vd1ehl0', '5L Lessonss ritu, priyanshu', '21', '6', '5L', 'One To One', '2024-02-14 06:03:25', NULL),
(7, 'clpkp2j92kq93pkql810', 'cn6asur92kqf7vd1m2i0', '5L Lessonddds ritu, priyanshu', '21', '6', '5L', 'One To One', '2024-02-14 06:43:47', NULL),
(8, 'clj4fej92kq0n85op3b0', 'cn6ucf392kq6hu0m2mf0', '5L Lessons ritikatesting, priyanshu2024-02-15 10:23', '10', '6', '5L', 'Online', '2024-02-15 04:53:56', NULL),
(9, 'clj4fej92kq0n85op3b0', 'cn6ug1r92kq6hu0m3f00', '5L Lessons ritikatesting, priyanshu2024-02-15 10:31', '10', '6', '5L', 'Online', '2024-02-15 05:01:36', NULL),
(10, 'clj4fej92kq0n85op3b0', 'cn87mlr92kq6hu0sig7g', '5L Lessons ritikatesting, teacher2024-02-17 09:24', '10', '24', '5L', 'Online', '2024-02-17 03:54:39', NULL),
(11, 'clj4fej92kq0n85op3b0', 'cna47pr92kqfubg3nssg', '5L Lessons ritikatesting, teacher2024-02-20 06:17', '10', '24', '5L', 'Online', '2024-02-20 00:47:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `class_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_classes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `class_type`, `payment_type`, `fee`, `no_of_classes`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Group Class', 'subscriptions', '78', NULL, 1, '1', '1', '2024-01-06 06:45:37', '2024-01-08 07:28:51'),
(2, 'One To One', 'subscriptions', '50', '6', 1, '1', '1', '2024-01-06 06:46:03', '2024-01-15 22:39:12'),
(4, 'Group Class', 'terms basis', '50', '16', 1, '1', '1', '2024-01-12 17:16:16', '2024-01-19 06:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_classes`
--

CREATE TABLE `purchase_classes` (
  `id` bigint UNSIGNED NOT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` tinyint DEFAULT '0',
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_classes`
--

INSERT INTO `purchase_classes` (`id`, `order_no`, `user_id`, `course_id`, `batch_id`, `batch_name`, `amount`, `total_class`, `payment_method`, `payment_type`, `stripe_order_id`, `is_completed`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Intercambio1707987146', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '50', '16', 'Stripe', 'term basis', 'ch_3Ok0gBA7cZJgXns30jOD3wFw', 1, 1, '2024-02-15 03:22:26', '2024-02-15 03:22:26'),
(2, 'Intercambio1708067861', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '50', '16', 'Stripe', 'term basis', 'ch_3OkLg2A7cZJgXns317sEkbkN', 1, 1, '2024-02-16 01:47:41', '2024-02-16 01:47:41'),
(3, 'Intercambio1708162035', '10', '1', 'cn87mlr92kq6hu0sig7g', '5L Lessons ritikatesting, teacher2024-02-17 09:24', '60', '16', 'Stripe', 'term basis', 'ch_3OkkAyA7cZJgXns31vObjqvO', 1, 1, '2024-02-17 03:57:15', '2024-02-17 03:57:15'),
(4, 'Intercambio1708164938', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', 'term basis', 'ch_3OkkvnA7cZJgXns31fewy6O6', 1, 1, '2024-02-17 04:45:38', '2024-02-17 04:45:38'),
(5, 'Intercambio1708930846', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 01:30:46', '2024-02-26 01:30:46'),
(6, 'Intercambio1708931084', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 01:34:44', '2024-02-26 01:34:44'),
(7, 'Intercambio1708932040', '21', '79', 'cmbh0nb92kq4586l312g', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 01:50:40', '2024-02-26 01:50:40'),
(8, 'Intercambio1708932105', '21', '79', 'cmbh0nb92kq4586l312g', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 01:51:45', '2024-02-26 01:51:45'),
(9, 'Intercambio1708932254', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 01:54:14', '2024-02-26 01:54:14'),
(10, 'Intercambio1708932581', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 01:59:41', '2024-02-26 01:59:41'),
(11, 'Intercambio1708932652', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 02:00:52', '2024-02-26 02:00:52'),
(12, 'Intercambio1708932754', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 02:02:34', '2024-02-26 02:02:34'),
(13, 'Intercambio1708932817', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 02:03:37', '2024-02-26 02:03:37'),
(14, 'Intercambio1708933499', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 02:14:59', '2024-02-26 02:14:59'),
(15, 'Intercambio1708933518', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 02:15:18', '2024-02-26 02:15:18'),
(16, 'Intercambio1708933531', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 02:15:31', '2024-02-26 02:15:31'),
(17, 'Intercambio1708933600', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 02:16:40', '2024-02-26 02:16:40'),
(18, 'Intercambio1708933654', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 02:17:34', '2024-02-26 02:17:34'),
(19, 'Intercambio1708933672', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 02:17:52', '2024-02-26 02:17:52'),
(20, 'Intercambio1708934246', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '78', '0', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 02:27:26', '2024-02-26 02:27:26'),
(21, 'Intercambio1708936706', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:08:26', '2024-02-26 03:08:26'),
(22, 'Intercambio1708936726', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:08:46', '2024-02-26 03:08:46'),
(23, 'Intercambio1708937246', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:17:26', '2024-02-26 03:17:26'),
(24, 'Intercambio1708937892', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:28:12', '2024-02-26 03:28:12'),
(25, 'Intercambio1708937909', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:28:29', '2024-02-26 03:28:29'),
(26, 'Intercambio1708937984', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:29:44', '2024-02-26 03:29:44'),
(27, 'Intercambio1708938059', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:30:59', '2024-02-26 03:30:59'),
(28, 'Intercambio1708938076', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:31:16', '2024-02-26 03:31:16'),
(29, 'Intercambio1708938207', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:33:27', '2024-02-26 03:33:27'),
(30, 'Intercambio1708938240', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:34:00', '2024-02-26 03:34:00'),
(31, 'Intercambio1708938304', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:35:04', '2024-02-26 03:35:04'),
(32, 'Intercambio1708938895', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:44:55', '2024-02-26 03:44:55'),
(33, 'Intercambio1708938930', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:45:30', '2024-02-26 03:45:30'),
(34, 'Intercambio1708938941', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:45:41', '2024-02-26 03:45:41'),
(35, 'Intercambio1708938949', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:45:49', '2024-02-26 03:45:49'),
(36, 'Intercambio1708938964', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:46:04', '2024-02-26 03:46:04'),
(37, 'Intercambio1708938974', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:46:14', '2024-02-26 03:46:14'),
(38, 'Intercambio1708938994', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:46:34', '2024-02-26 03:46:34'),
(39, 'Intercambio1708939006', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:46:46', '2024-02-26 03:46:46'),
(40, 'Intercambio1708939239', '21', '79', 'cmc2me392kq4586o87qg', ' 6 - 8pm', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:50:39', '2024-02-26 03:50:39'),
(41, 'Intercambio1708939270', '21', '79', 'cmc2me392kq4586o87qg', ' 6 - 8pm', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 03:51:10', '2024-02-26 03:51:10'),
(42, 'Intercambio1708947254', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 06:04:14', '2024-02-26 06:04:14'),
(43, 'Intercambio1708947940', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-26 06:15:40', '2024-02-26 06:15:40'),
(44, 'Intercambio1709104388', '21', '79', 'clpksrpnuvtc37dnsejg', ' 10am-12pm Tuesday and Thursday', '60', '16', 'Stripe', 'term basis', 'ch_3OohKDCHHdYKkxfg0OSglDdV', 1, 1, '2024-02-28 01:43:08', '2024-02-28 01:43:08'),
(45, 'Intercambio1709105458', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-28 02:00:58', '2024-02-28 02:00:58'),
(46, 'Intercambio1709105515', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-28 02:01:55', '2024-02-28 02:01:55'),
(47, 'Intercambio1709105527', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-28 02:02:07', '2024-02-28 02:02:07'),
(48, 'Intercambio1709105737', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-28 02:05:37', '2024-02-28 02:05:37'),
(49, 'Intercambio1709105891', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-28 02:08:11', '2024-02-28 02:08:11'),
(50, 'Intercambio1709105957', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', NULL, NULL, 0, 1, '2024-02-28 02:09:17', '2024-02-28 02:09:17'),
(51, 'Intercambio1709105973', '21', '79', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '60', '16', 'Stripe', 'term basis', 'ch_3OohjnCHHdYKkxfg121z62ba', 1, 1, '2024-02-28 02:09:33', '2024-02-28 02:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `q_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `question_type` tinyint DEFAULT NULL COMMENT '0 => picklists, 1 => mulitple, 2 => other ',
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=>student ,1=>teacher',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `q_id`, `question`, `status`, `question_type`, `user_type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, '2', 'How did you hear about Intercambio?', 1, 0, '0', '1', '1', '2023-12-25 05:25:57', '2023-12-25 06:26:06'),
(4, '3', 'What is your first language?', 1, 0, '0', '1', '1', '2023-12-25 05:29:41', '2023-12-25 06:26:32'),
(5, '4', 'Country of Origin', 1, 0, '0', '1', '1', '2023-12-25 05:48:59', '2023-12-25 06:26:48'),
(6, '5', 'Do you identify as Latino or Hispanic?', 1, 0, '0', '1', '1', '2023-12-25 05:49:15', '2023-12-25 06:30:13'),
(7, '6', 'What is your race?', 1, 0, '0', '1', '1', '2023-12-25 05:49:38', '2023-12-25 06:30:33'),
(8, '7', 'In what year did you enter the US?', 1, 0, '0', '1', '1', '2023-12-25 05:50:00', '2023-12-25 06:30:59'),
(10, '8', 'What is your employment status?', 1, 0, '0', '1', '1', '2023-12-25 05:50:13', '2023-12-26 05:38:48'),
(11, '9', 'What is the highest level of education have you completed, in the US or in your home country?', 1, 0, '0', '1', '1', '2023-12-25 05:50:24', '2023-12-25 06:31:52'),
(12, '10', 'What is your total household Income (of everyone who lives with you):', 1, 0, '0', '1', '1', '2023-12-25 05:51:23', '2023-12-25 06:32:14'),
(13, '11', 'How many people (including you) live in your home?', 1, 0, '0', '1', '1', '2023-12-25 05:51:33', '2023-12-25 06:32:37'),
(14, '12', 'Thinking about work, what are the reasons you want to improve your English?', 1, 1, '0', '1', '1', '2023-12-25 05:51:48', '2023-12-25 06:32:49'),
(15, '13', 'Thinking about education, what are the reasons you want to improve your English?', 1, 1, '0', '1', '1', '2023-12-25 05:52:27', '2023-12-25 06:33:04'),
(16, '14', 'Thinking about your family, what are the reasons you want to learn / improve your English?', 1, 1, '0', '1', NULL, '2023-12-25 05:52:59', '2023-12-25 05:52:59'),
(17, '15', 'Thinking about the community, what are the reasons you want to learn / improve your English?', 1, 1, '0', '1', NULL, '2023-12-25 05:53:11', '2023-12-25 05:53:11'),
(18, '16', 'How long do you want to take English classes?', 1, 0, '0', '1', '1', '2023-12-25 05:53:21', '2023-12-26 07:12:01'),
(19, '1', 'What gender would you like your teacher to be?', 1, 0, '0', '1', '1', '2023-12-25 06:19:06', '2023-12-29 13:17:44'),
(20, '17', 'How did you hear about Us?', 1, 0, '1', '1', '1', '2023-12-26 03:50:21', '2023-12-26 07:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `question_entries`
--

CREATE TABLE `question_entries` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_entries`
--

INSERT INTO `question_entries` (`id`, `user_id`, `question_id`, `option_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', '3', '14', 1, '2024-01-25 10:59:55', '2023-12-29 09:57:46'),
(2, '2', '4', '24', 1, '2024-01-25 10:59:55', '2023-12-29 09:57:46'),
(3, '2', '5', '283', 1, '2024-01-25 10:59:55', '2023-12-29 09:57:46'),
(4, '2', '6', '156', 1, '2024-01-25 11:00:02', '2023-12-29 09:57:46'),
(5, '2', '7', '161', 1, '2024-01-25 11:00:02', '2023-12-29 09:57:46'),
(6, '2', '8', '170', 1, '2024-01-25 11:00:02', '2023-12-29 09:57:46'),
(7, '2', '10', '214', 1, '2024-01-25 11:00:02', '2023-12-29 09:57:46'),
(8, '2', '11', '221', 1, '2024-01-25 11:00:02', '2023-12-29 09:57:46'),
(9, '2', '12', '228', 1, '2024-01-25 11:00:02', '2023-12-29 09:57:46'),
(10, '2', '13', '234', 1, '2024-01-25 11:00:02', '2023-12-29 09:57:46'),
(11, '2', '18', '247', 1, '2024-01-25 11:00:07', '2023-12-29 09:57:46'),
(12, '2', '19', '267', 1, '2024-01-25 10:59:55', '2023-12-29 09:57:46'),
(13, '2', '20', '457', 1, '2023-12-29 05:47:59', NULL),
(14, '2', '14', '250', 1, '2024-01-25 11:00:07', '2023-12-29 09:57:46'),
(15, '2', '15', '264', 1, '2024-01-25 11:00:07', '2023-12-29 09:57:46'),
(16, '2', '16', '275', 1, '2024-01-25 11:00:07', '2023-12-29 09:57:46'),
(17, '2', '17', '276', 1, '2024-01-25 11:00:07', '2023-12-29 09:57:46'),
(18, '5', '19', '266', 1, '2024-01-02 09:27:16', NULL),
(19, '5', '3', '11', 1, '2024-01-02 09:27:16', NULL),
(20, '5', '4', '20', 1, '2024-01-02 09:27:16', NULL),
(21, '5', '5', '284', 1, '2024-01-02 09:27:16', NULL),
(22, '5', '6', '155', 1, '2024-01-02 09:26:00', NULL),
(23, '5', '7', '159', 1, '2024-01-02 09:26:00', NULL),
(24, '5', '8', '185', 1, '2024-01-02 09:26:00', NULL),
(25, '5', '10', '213', 1, '2024-01-02 09:26:00', NULL),
(26, '5', '11', '218', 1, '2024-01-02 09:26:00', NULL),
(27, '5', '12', '228', 1, '2024-01-02 09:26:00', NULL),
(28, '5', '13', '233', 1, '2024-01-02 09:26:00', NULL),
(29, '5', '14', '250', 1, '2024-01-02 09:26:15', NULL),
(30, '5', '15', '259', 1, '2024-01-02 09:26:15', NULL),
(31, '5', '16', '271', 1, '2024-01-02 09:26:15', NULL),
(32, '5', '17', '279', 1, '2024-01-02 09:26:15', NULL),
(33, '5', '18', '247', 1, '2024-01-02 09:26:15', NULL),
(34, '9', '19', '268', 1, '2024-01-04 16:09:13', NULL),
(35, '9', '3', '15', 1, '2024-01-04 16:09:13', NULL),
(36, '9', '4', '59', 1, '2024-01-04 16:09:13', NULL),
(37, '9', '5', '358', 1, '2024-01-04 16:09:13', NULL),
(38, '9', '6', '156', 1, '2024-01-04 16:10:04', NULL),
(39, '9', '7', '162', 1, '2024-01-04 16:10:04', NULL),
(40, '9', '8', '182', 1, '2024-01-04 16:10:04', NULL),
(41, '9', '10', '212', 1, '2024-01-04 16:10:04', NULL),
(42, '9', '11', '224', 1, '2024-01-04 16:10:04', NULL),
(43, '9', '12', '227', 1, '2024-01-04 16:10:04', NULL),
(44, '9', '13', '232', 1, '2024-01-04 16:10:04', NULL),
(45, '9', '14', '251', 1, '2024-01-04 16:10:40', NULL),
(46, '9', '15', '264', 1, '2024-01-04 16:10:40', NULL),
(47, '9', '16', '271', 1, '2024-01-04 16:10:40', NULL),
(48, '9', '17', '281', 1, '2024-01-04 16:10:40', NULL),
(49, '9', '18', '248', 1, '2024-01-04 16:10:40', NULL),
(50, '10', '19', '267', 1, '2024-02-17 03:55:48', NULL),
(51, '10', '3', '12', 1, '2024-02-17 03:55:48', NULL),
(52, '10', '4', '22', 1, '2024-02-17 03:55:48', NULL),
(53, '10', '5', '285', 1, '2024-02-17 03:55:48', NULL),
(54, '10', '6', '156', 1, '2024-02-17 03:55:53', NULL),
(55, '10', '7', '159', 1, '2024-02-17 03:55:53', NULL),
(56, '10', '8', '167', 1, '2024-02-17 03:55:53', NULL),
(57, '10', '10', '213', 1, '2024-02-17 03:55:53', NULL),
(58, '10', '11', '219', 1, '2024-02-17 03:55:53', NULL),
(59, '10', '12', '228', 1, '2024-02-17 03:55:53', NULL),
(60, '10', '13', '233', 1, '2024-02-17 03:55:53', NULL),
(61, '10', '14', '250', 1, '2024-02-17 03:56:06', NULL),
(62, '10', '15', '257', 1, '2024-02-17 03:56:06', NULL),
(63, '10', '16', '269', 1, '2024-02-17 03:56:06', NULL),
(64, '10', '17', '276', 1, '2024-02-17 03:56:06', NULL),
(65, '10', '18', '247', 1, '2024-02-17 03:56:06', NULL),
(66, '15', '19', '268', 1, '2024-01-29 07:32:26', NULL),
(67, '15', '3', '11', 1, '2024-01-29 07:32:26', NULL),
(68, '15', '4', '67', 1, '2024-01-29 07:32:26', NULL),
(69, '15', '5', '310', 1, '2024-01-29 07:32:26', NULL),
(70, '15', '6', '155', 1, '2024-01-29 12:42:16', NULL),
(71, '15', '7', '159', 1, '2024-01-29 12:42:16', NULL),
(72, '15', '8', '167', 1, '2024-01-29 12:42:16', NULL),
(73, '15', '10', '212', 1, '2024-01-29 12:42:16', NULL),
(74, '15', '11', '218', 1, '2024-01-29 12:42:16', NULL),
(75, '15', '12', '226', 1, '2024-01-29 12:42:16', NULL),
(76, '15', '13', '232', 1, '2024-01-29 12:42:16', NULL),
(77, '15', '14', '252', 1, '2024-01-29 12:42:21', NULL),
(78, '15', '15', '257', 1, '2024-01-29 12:42:21', NULL),
(79, '15', '16', '271', 1, '2024-01-29 12:42:21', NULL),
(80, '15', '17', '282', 1, '2024-01-29 12:42:21', NULL),
(81, '15', '18', '247', 1, '2024-01-29 12:42:21', NULL),
(82, '17', '19', '266', 1, '2024-01-29 07:53:57', NULL),
(83, '17', '3', '12', 1, '2024-01-29 07:53:57', NULL),
(84, '17', '4', '22', 1, '2024-01-29 07:53:57', NULL),
(85, '17', '5', '354', 1, '2024-01-29 07:53:57', NULL),
(86, '17', '6', '155', 1, '2024-01-29 07:54:25', NULL),
(87, '17', '7', '159', 1, '2024-01-29 07:54:25', NULL),
(88, '17', '8', '166', 1, '2024-01-29 07:54:25', NULL),
(89, '17', '10', '213', 1, '2024-01-29 07:54:25', NULL),
(90, '17', '11', '218', 1, '2024-01-29 07:54:25', NULL),
(91, '17', '12', '227', 1, '2024-01-29 07:54:25', NULL),
(92, '17', '13', '233', 1, '2024-01-29 07:54:25', NULL),
(93, '17', '14', '250', 1, '2024-01-29 07:57:56', NULL),
(94, '17', '15', '262', 1, '2024-01-29 07:57:56', NULL),
(95, '17', '16', '271', 1, '2024-01-29 07:57:56', NULL),
(96, '17', '17', '279', 1, '2024-01-29 07:57:56', NULL),
(97, '17', '18', '247', 1, '2024-01-29 07:57:56', NULL),
(98, '20', '19', '267', 1, '2024-01-29 12:37:28', NULL),
(99, '20', '3', '12', 1, '2024-01-29 12:37:28', NULL),
(100, '20', '4', '22', 1, '2024-01-29 12:37:28', NULL),
(101, '20', '5', '354', 1, '2024-01-29 12:37:28', NULL),
(102, '20', '6', '155', 1, '2024-01-29 12:37:52', NULL),
(103, '20', '7', '158', 1, '2024-01-29 12:37:52', NULL),
(104, '20', '8', '168', 1, '2024-01-29 12:37:52', NULL),
(105, '20', '10', '212', 1, '2024-01-29 12:37:52', NULL),
(106, '20', '11', '219', 1, '2024-01-29 12:37:52', NULL),
(107, '20', '12', '228', 1, '2024-01-29 12:37:52', NULL),
(108, '20', '13', '233', 1, '2024-01-29 12:37:52', NULL),
(109, '20', '14', '251', 1, '2024-01-29 12:43:25', NULL),
(110, '20', '15', '259', 1, '2024-01-29 12:43:25', NULL),
(111, '20', '16', '272', 1, '2024-01-29 12:43:25', NULL),
(112, '20', '17', '280', 1, '2024-01-29 12:43:25', NULL),
(113, '20', '18', '247', 1, '2024-01-29 12:43:25', NULL),
(114, '21', '19', '266', 1, '2024-02-21 00:42:04', NULL),
(115, '21', '3', '13', 1, '2024-02-21 00:42:04', NULL),
(116, '21', '4', '67', 1, '2024-02-21 00:42:04', NULL),
(117, '21', '5', '354', 1, '2024-02-21 00:42:04', NULL),
(118, '21', '6', '155', 1, '2024-02-21 00:42:08', NULL),
(119, '21', '7', '158', 1, '2024-02-21 00:42:08', NULL),
(120, '21', '8', '176', 1, '2024-02-21 00:42:08', NULL),
(121, '21', '10', '212', 1, '2024-02-21 00:42:08', NULL),
(122, '21', '11', '221', 1, '2024-02-21 00:42:08', NULL),
(123, '21', '12', '229', 1, '2024-02-21 00:42:08', NULL),
(124, '21', '13', '232', 1, '2024-02-21 00:42:08', NULL),
(125, '21', '14', '250', 1, '2024-02-21 00:42:12', NULL),
(126, '21', '15', '262', 1, '2024-02-21 00:42:12', NULL),
(127, '21', '16', '271', 1, '2024-02-21 00:42:12', NULL),
(128, '21', '17', '279', 1, '2024-02-21 00:42:12', NULL),
(129, '21', '18', '247', 1, '2024-02-21 00:42:12', NULL),
(130, '39', '19', '266', 1, '2024-03-13 06:48:44', NULL),
(131, '39', '3', '12', 1, '2024-03-13 06:48:44', NULL),
(132, '39', '4', '20', 1, '2024-03-13 06:48:44', NULL),
(133, '39', '5', '283', 1, '2024-03-13 06:48:44', NULL),
(134, '39', '6', '155', 1, '2024-03-13 06:48:48', NULL),
(135, '39', '7', '160', 1, '2024-03-13 06:48:48', NULL),
(136, '39', '8', '167', 1, '2024-03-13 06:48:48', NULL),
(137, '39', '10', '213', 1, '2024-03-13 06:48:48', NULL),
(138, '39', '11', '218', 1, '2024-03-13 06:48:48', NULL),
(139, '39', '12', '228', 1, '2024-03-13 06:48:48', NULL),
(140, '39', '13', '234', 1, '2024-03-13 06:48:48', NULL),
(141, '39', '14', '[\"250\",\"251\"]', 1, '2024-03-13 06:48:53', NULL),
(142, '39', '15', '[\"260\",\"262\"]', 1, '2024-03-13 06:48:53', NULL),
(143, '39', '16', '[\"272\",\"274\"]', 1, '2024-03-13 06:48:53', NULL),
(144, '39', '17', '[\"277\",\"281\"]', 1, '2024-03-13 06:48:53', NULL),
(145, '39', '18', '[null]', 1, '2024-03-13 06:48:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` bigint UNSIGNED NOT NULL,
  `option` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `option`, `question_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Male', '1', 1, '1', NULL, '2023-12-25 05:24:11', '2023-12-25 05:24:11'),
(2, 'Female', '1', 1, '1', NULL, '2023-12-25 05:24:11', '2023-12-25 05:24:11'),
(3, 'Non-Binary', '1', 1, '1', NULL, '2023-12-25 05:24:11', '2023-12-25 05:24:11'),
(4, 'Mountain Time', '2', 1, '1', NULL, '2023-12-25 05:25:44', '2023-12-25 05:25:44'),
(5, 'Eastern Time', '2', 1, '1', NULL, '2023-12-25 05:25:44', '2023-12-25 05:25:44'),
(6, 'Central Time', '2', 1, '1', NULL, '2023-12-25 05:25:44', '2023-12-25 05:25:44'),
(7, 'Pacific Time', '2', 1, '1', NULL, '2023-12-25 05:25:44', '2023-12-25 05:25:44'),
(8, 'Hawaii', '2', 1, '1', NULL, '2023-12-25 05:25:44', '2023-12-25 05:25:44'),
(9, 'Alaska', '2', 1, '1', NULL, '2023-12-25 05:25:44', '2023-12-25 05:25:44'),
(10, 'Puerto Rico', '2', 1, '1', NULL, '2023-12-25 05:25:44', '2023-12-25 05:25:44'),
(11, 'A program in my community', '3', 1, '1', NULL, '2023-12-25 05:28:47', '2023-12-25 05:28:47'),
(12, 'Email', '3', 1, '1', NULL, '2023-12-25 05:28:47', '2023-12-25 05:28:47'),
(13, 'Facebook', '3', 1, '1', NULL, '2023-12-25 05:28:47', '2023-12-25 05:28:47'),
(14, 'Friend', '3', 1, '1', NULL, '2023-12-25 05:28:47', '2023-12-25 05:28:47'),
(15, 'Online Search', '3', 1, '1', NULL, '2023-12-25 05:28:47', '2023-12-25 05:28:47'),
(16, 'Radio / TV', '3', 1, '1', NULL, '2023-12-25 05:28:47', '2023-12-25 05:28:47'),
(17, 'Social Media', '3', 1, '1', NULL, '2023-12-25 05:28:47', '2023-12-25 05:28:47'),
(18, 'Word of Mouth', '3', 1, '1', NULL, '2023-12-25 05:28:47', '2023-12-25 05:28:47'),
(19, 'Other', '3', 1, '1', NULL, '2023-12-25 05:28:47', '2023-12-25 05:28:47'),
(20, 'Abkhaz', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(21, 'Adangame', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(22, 'Afar', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(23, 'Afrikaans', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(24, 'Albanian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(25, 'Amharic', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(26, 'Arabic', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(27, 'Armenian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(28, 'Azerbaijani', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(29, 'Aymara', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(30, 'Belarusian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(31, 'Bengali', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(32, 'Bosnian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(33, 'Bulgarian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(34, 'Burmese', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(35, 'Cantonese', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(36, 'Catalan', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(37, 'Chewa', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(38, 'Chibarwe', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(39, 'Chichewa', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(40, 'Comorian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(41, 'Cook Islands Maori', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(42, 'Creole', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(43, 'Croatian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(44, 'Czech', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(45, 'Dagaare', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(46, 'Dagbani', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(47, 'Danish', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(48, 'Dari', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(49, 'Dhivehi', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(50, 'Dutch', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(51, 'Estonian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(52, 'Fante', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(53, 'Fijian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(54, 'Filipino', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(55, 'Finnish', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(56, 'French', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(57, 'Frisian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(58, 'Ga', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(59, 'Gaelic', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(60, 'Georgian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(61, 'German', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(62, 'Greek', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(63, 'Guarani', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(64, 'Guechua', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(65, 'Haitian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(66, 'Hebrew', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(67, 'Hindi', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(68, 'Hiri Motu', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(69, 'Hungarian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(70, 'Icelandic', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(71, 'Indonesian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(72, 'Irish', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(73, 'Italian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(74, 'Japanese', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(75, 'Kalanga', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(76, 'Kazakh', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(77, 'Khmer', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(78, 'Khoisan', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(79, 'Kirundi', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(80, 'Korean', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(81, 'Kurdish', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(82, 'Kyrgyz', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(83, 'Lao', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(84, 'Latvian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(85, 'Lithuanian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(86, 'Luxembourgish', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(87, 'Macedonian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(88, 'Malagasy', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(89, 'Malay', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(90, 'Maltese', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(91, 'Mandarin', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(92, 'Maori', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(93, 'Moldovan', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(94, 'Mongolian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(95, 'Montenegrin', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(96, 'Nambya', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(97, 'Nauruan', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(98, 'Ndau', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(99, 'Ndebele', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(100, 'Nepali', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(101, 'Niuean', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(102, 'Norfuk', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(103, 'Norwegian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(104, 'Oromo', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(105, 'Ossetian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(106, 'Palauan', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(107, 'Pashto', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(108, 'Persian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(109, 'Polish', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(110, 'Portugese', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(111, 'Quechua', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(112, 'Romanian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(113, 'Romansh', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(114, 'Russian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(115, 'Sami', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(116, 'Scots', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(117, 'Serbian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(118, 'Seychellois Creole', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(119, 'Shangani', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(120, 'Shona', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(121, 'Sinhala', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(122, 'Slovak', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(123, 'Slovene', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(124, 'Somali', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(125, 'Sotho', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(126, 'Southern Ndebele', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(127, 'Spanish', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(128, 'Swahili', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(129, 'Swazi', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(130, 'Swedish', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(131, 'Tajik', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(132, 'Tamazight', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(133, 'Tamil', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(134, 'Thai', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(135, 'Tibetan', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(136, 'Tigrinya', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(137, 'Tok Pisin', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(138, 'Tokelauan', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(139, 'Tonga', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(140, 'Tongan', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(141, 'Tsonga', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(142, 'Tswana', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(143, 'Turkish', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(144, 'Turkmen', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(145, 'Tuvaluan', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(146, 'Ukrainian', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(147, 'Urdu', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(148, 'Uzbek', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(149, 'Venda', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(150, 'Vietnamese', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(151, 'Welsh', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(152, 'Xhosa', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(153, 'Zulu', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(154, 'Other', '4', 1, '1', NULL, '2023-12-25 05:48:07', '2023-12-25 05:48:07'),
(155, 'Yes', '6', 1, '1', NULL, '2023-12-25 05:54:05', '2023-12-25 05:54:05'),
(156, 'No', '6', 1, '1', NULL, '2023-12-25 05:54:05', '2023-12-25 05:54:05'),
(157, 'Prefer not to answer', '6', 1, '1', NULL, '2023-12-25 05:54:05', '2023-12-25 05:54:05'),
(158, 'American Indian or Alaskan Native', '7', 1, '1', NULL, '2023-12-25 05:55:47', '2023-12-25 05:55:47'),
(159, 'Asian', '7', 1, '1', NULL, '2023-12-25 05:55:47', '2023-12-25 05:55:47'),
(160, 'Black or African American', '7', 1, '1', NULL, '2023-12-25 05:55:47', '2023-12-25 05:55:47'),
(161, 'Other', '7', 1, '1', NULL, '2023-12-25 05:55:47', '2023-12-25 05:55:47'),
(162, 'White', '7', 1, '1', NULL, '2023-12-25 05:55:47', '2023-12-25 05:55:47'),
(163, 'Hispanic or Latino/a', '7', 1, '1', NULL, '2023-12-25 05:55:47', '2023-12-25 05:55:47'),
(164, 'Mixed Race', '7', 1, '1', NULL, '2023-12-25 05:55:47', '2023-12-25 05:55:47'),
(165, 'Prefer not to answer', '7', 1, '1', NULL, '2023-12-25 05:55:47', '2023-12-25 05:55:47'),
(166, '2025', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(167, '2024', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(168, '2023', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(169, '2022', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(170, '2021', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(171, '2020', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(172, '2019', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(173, '2018', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(174, '2017', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(175, '2016', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(176, '2015', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(177, '2014', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(178, '2013', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(179, '2012', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(180, '2011', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(181, '2010', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(182, '2009', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(183, '2008', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(184, '2007', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(185, '2006', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(186, '2005', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(187, '2004', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(188, '2003', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(189, '2002', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(190, '2001', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(191, '2000', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(192, '1999', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(193, '1998', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(194, '1997', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(195, '1996', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(196, '1995', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(197, '1994', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(198, '1993', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(199, '1992', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(200, '1991', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(201, '1990', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(202, '1989', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(203, '1988', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(204, '1987', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(205, '1986', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(206, '1985', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(207, '1984', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(208, '1983', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(209, '1982', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(210, '1981', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(211, '1980', '8', 1, '1', NULL, '2023-12-25 06:00:47', '2023-12-25 06:00:47'),
(212, 'Employed', '10', 1, '1', NULL, '2023-12-25 06:02:28', '2023-12-25 06:02:28'),
(213, 'Student', '10', 1, '1', NULL, '2023-12-25 06:02:28', '2023-12-25 06:02:28'),
(214, 'Retired', '10', 1, '1', NULL, '2023-12-25 06:02:28', '2023-12-25 06:02:28'),
(215, 'Unemployed', '10', 1, '1', NULL, '2023-12-25 06:02:28', '2023-12-25 06:02:28'),
(216, 'Unemployed- not looking for a job', '10', 1, '1', NULL, '2023-12-25 06:02:28', '2023-12-25 06:02:28'),
(217, 'Unemployed- looking for a job', '10', 1, '1', NULL, '2023-12-25 06:02:28', '2023-12-25 06:02:28'),
(218, 'No school', '11', 1, '1', NULL, '2023-12-25 06:06:41', '2023-12-25 06:06:41'),
(219, 'Primary/elementary school', '11', 1, '1', NULL, '2023-12-25 06:06:41', '2023-12-25 06:06:41'),
(220, 'Some high school/secondary school', '11', 1, '1', NULL, '2023-12-25 06:06:41', '2023-12-25 06:06:41'),
(221, 'Completed high school or GED certificate', '11', 1, '1', NULL, '2023-12-25 06:06:41', '2023-12-25 06:06:41'),
(222, 'Some college, university, or technical school classes', '11', 1, '1', NULL, '2023-12-25 06:06:41', '2023-12-25 06:06:41'),
(223, 'Completed certificate or degree at university, college or technical school', '11', 1, '1', NULL, '2023-12-25 06:06:41', '2023-12-25 06:06:41'),
(224, 'Completed a master’s or doctorate degree', '11', 1, '1', NULL, '2023-12-25 06:06:41', '2023-12-25 06:06:41'),
(225, 'Prefer not to answer', '11', 1, '1', NULL, '2023-12-25 06:06:41', '2023-12-25 06:06:41'),
(226, 'Below $30,000', '12', 1, '1', NULL, '2023-12-25 06:07:49', '2023-12-25 06:07:49'),
(227, '$30,000 to $50,000', '12', 1, '1', NULL, '2023-12-25 06:07:49', '2023-12-25 06:07:49'),
(228, '$50,000 to $70,000', '12', 1, '1', NULL, '2023-12-25 06:07:49', '2023-12-25 06:07:49'),
(229, 'Above $70,000', '12', 1, '1', NULL, '2023-12-25 06:07:49', '2023-12-25 06:07:49'),
(230, 'Prefer not to answer', '12', 1, '1', NULL, '2023-12-25 06:07:49', '2023-12-25 06:07:49'),
(231, '1', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(232, '2', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(233, '3', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(234, '4', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(235, '5', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(236, '6', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(237, '7', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(238, '8', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(239, '9', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(240, '10', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(241, '11', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(242, '12', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(243, '13', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(244, '14', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(245, '15', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(246, 'Prefer not to answer', '13', 1, '1', NULL, '2023-12-25 06:08:54', '2023-12-25 06:08:54'),
(247, 'Less than 6 months', '18', 1, '1', NULL, '2023-12-25 06:09:47', '2023-12-25 06:09:47'),
(248, 'More than 6 months', '18', 1, '1', NULL, '2023-12-25 06:09:47', '2023-12-25 06:09:47'),
(249, 'Other', '18', 1, '1', NULL, '2023-12-25 06:09:47', '2023-12-25 06:09:47'),
(250, 'Find a job', '14', 1, '1', NULL, '2023-12-25 06:12:16', '2023-12-25 06:12:16'),
(251, 'Get a better job', '14', 1, '1', NULL, '2023-12-25 06:12:16', '2023-12-25 06:12:16'),
(252, 'Get a promotion at same workplace', '14', 1, '1', NULL, '2023-12-25 06:12:16', '2023-12-25 06:12:16'),
(253, 'Start my own business', '14', 1, '1', NULL, '2023-12-25 06:12:16', '2023-12-25 06:12:16'),
(254, 'Improve work skills', '14', 1, '1', NULL, '2023-12-25 06:12:16', '2023-12-25 06:12:16'),
(255, 'I do not have a goal', '14', 1, '1', NULL, '2023-12-25 06:12:16', '2023-12-25 06:12:16'),
(256, 'Other', '14', 1, '1', NULL, '2023-12-25 06:12:16', '2023-12-25 06:12:16'),
(257, 'To be fluent in English', '15', 1, '1', NULL, '2023-12-25 06:13:24', '2023-12-25 06:13:24'),
(258, 'Complete all levels of Intercambio\'s classes', '15', 1, '1', NULL, '2023-12-25 06:13:24', '2023-12-25 06:13:24'),
(259, 'Become a Volunteer Teacher Assistant at Intercambio', '15', 1, '1', NULL, '2023-12-25 06:13:24', '2023-12-25 06:13:24'),
(260, 'Get my GED (high school diploma)', '15', 1, '1', NULL, '2023-12-25 06:13:24', '2023-12-25 06:13:24'),
(261, 'Go to College', '15', 1, '1', NULL, '2023-12-25 06:13:24', '2023-12-25 06:13:24'),
(262, 'Take a course to improve my skills', '15', 1, '1', NULL, '2023-12-25 06:13:24', '2023-12-25 06:13:24'),
(263, 'Validate my foreign degree', '15', 1, '1', NULL, '2023-12-25 06:13:24', '2023-12-25 06:13:24'),
(264, 'I do not have an education goal', '15', 1, '1', NULL, '2023-12-25 06:13:24', '2023-12-25 06:13:24'),
(265, 'Other', '15', 1, '1', NULL, '2023-12-25 06:13:24', '2023-12-25 06:13:24'),
(266, 'Male', '19', 1, '1', NULL, '2023-12-25 06:22:43', '2023-12-25 06:22:43'),
(267, 'Female', '19', 1, '1', NULL, '2023-12-25 06:22:43', '2023-12-25 06:22:43'),
(268, 'No preference', '19', 1, '1', NULL, '2023-12-25 06:22:43', '2023-12-25 06:22:43'),
(269, 'Support children\'s education (go to meetings, help with homework, etc.)', '16', 1, '1', NULL, '2023-12-25 06:43:11', '2023-12-25 06:43:11'),
(270, 'Send my children to college', '16', 1, '1', NULL, '2023-12-25 06:43:11', '2023-12-25 06:43:11'),
(271, 'Communicate with relatives', '16', 1, '1', NULL, '2023-12-25 06:43:11', '2023-12-25 06:43:11'),
(272, 'Be a role model', '16', 1, '1', NULL, '2023-12-25 06:43:11', '2023-12-25 06:43:11'),
(273, 'Family is financially secure', '16', 1, '1', NULL, '2023-12-25 06:43:11', '2023-12-25 06:43:11'),
(274, 'I do not have a family goal', '16', 1, '1', NULL, '2023-12-25 06:43:11', '2023-12-25 06:43:11'),
(275, 'Other', '16', 1, '1', NULL, '2023-12-25 06:43:11', '2023-12-25 06:43:11'),
(276, 'Have friends from other countries', '17', 1, '1', NULL, '2023-12-25 06:45:33', '2023-12-25 06:45:33'),
(277, 'Understand other people\'s cultures', '17', 1, '1', NULL, '2023-12-25 06:45:33', '2023-12-25 06:45:33'),
(278, 'Build community of friends here', '17', 1, '1', NULL, '2023-12-25 06:45:33', '2023-12-25 06:45:33'),
(279, 'Help other immigrants', '17', 1, '1', NULL, '2023-12-25 06:45:33', '2023-12-25 06:45:33'),
(280, 'Participate in community events', '17', 1, '1', NULL, '2023-12-25 06:45:33', '2023-12-25 06:45:33'),
(281, 'Be a leader in my community', '17', 1, '1', NULL, '2023-12-25 06:45:33', '2023-12-25 06:45:33'),
(282, 'Other', '17', 1, '1', NULL, '2023-12-25 06:45:33', '2023-12-25 06:45:33'),
(283, 'Afghanistan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(284, 'Albania', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(285, 'Algeria', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(286, 'Angola', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(287, 'Argentina', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(288, 'Armenia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(289, 'Australia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(290, 'Austria', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(291, 'Azerbaijan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(292, 'Bahamas', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(293, 'Bahrain', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(294, 'Bangladesh', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(295, 'Barbados', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(296, 'Belarus', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(297, 'Belgium', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(298, 'Belize', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(299, 'Benin', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(300, 'Bermuda', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(301, 'Bhutan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(302, 'Bolivia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(303, 'Bosnia and Herzegovina', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(304, 'Botswana', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(305, 'Brazil', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(306, 'Bulgaria', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(307, 'Burma', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(308, 'Burundi', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(309, 'Cambodia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(310, 'Cameroon', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(311, 'Canada', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(312, 'Cayman Islands', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(313, 'Chad', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(314, 'Chile', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(315, 'China', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(316, 'Colombia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(317, 'Congo', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(318, 'Costa Rica', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(319, 'Croatia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(320, 'Cuba', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(321, 'Cyprus', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(322, 'Czech Republic', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(323, 'Denmark', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(324, 'Dominica', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(325, 'Dominican Republic', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(326, 'Ecuador', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(327, 'Egypt', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(328, 'El Salvador', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(329, 'Eritrea', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(330, 'Estonia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(331, 'Ethiopia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(332, 'Fiji', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(333, 'Finland', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(334, 'France', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(335, 'French Guiana', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(336, 'French Polynesia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(337, 'Gabon', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(338, 'Gambia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(339, 'Georgia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(340, 'Germany', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(341, 'Ghana', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(342, 'Greece', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(343, 'Grenada', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(344, 'Guadeloupe', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(345, 'Guam', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(346, 'Guatemala', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(347, 'Guinea', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(348, 'Guyana', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(349, 'Haiti', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(350, 'Honduras', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(351, 'Hong Kong', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(352, 'Hungary', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(353, 'Iceland', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(354, 'India', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(355, 'Indonesia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(356, 'Iran, Islamic Republic of Iran', '5', 1, '1', '1', '2023-12-25 07:11:59', '2023-12-26 04:54:49'),
(357, 'Iraq', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(358, 'Ireland', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(359, 'Israel', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(360, 'Italy', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(361, 'Ivory Coast', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(362, 'Jamaica', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(363, 'Japan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(364, 'Jordan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(365, 'Kazakhstan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(366, 'Kenya', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(367, 'Kuwait', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(368, 'Kyrgyzstan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(369, 'Lao People\'s Democratic Republic', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(370, 'Latvia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(371, 'Lebanon', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(372, 'Liberia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(373, 'Libya', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(374, 'Lithuania', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(375, 'Luxembourg', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(376, 'Macao', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(377, 'Macedonia, The Former Yugoslav Republic of Macedonia', '5', 1, '1', '1', '2023-12-25 07:11:59', '2023-12-26 04:55:38'),
(378, 'Madagascar', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(379, 'Malawi', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(380, 'Malaysia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(381, 'Mali', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(382, 'Mexico', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(383, 'Micronesia, Federated States of Micronesia', '5', 1, '1', '1', '2023-12-25 07:11:59', '2023-12-26 04:56:50'),
(384, 'Moldova, Republic of Moldova', '5', 1, '1', '1', '2023-12-25 07:11:59', '2023-12-26 04:55:56'),
(385, 'Mongolia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(386, 'Morocco', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(387, 'Mozambique', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(388, 'Myanmar', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(389, 'Namibia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(390, 'Nepal', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(391, 'Netherlands', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(392, 'Netherlands Antilles', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(393, 'Nicaragua', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(394, 'Niger', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(395, 'Nigeria', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(396, 'North Korea', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(397, 'Norway', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(398, 'Oman', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(399, 'Pakistan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(400, 'Palestinian Territory, Occupied', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(401, 'Panama', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(402, 'Papua New Guinea', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(403, 'Paraguay', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(404, 'Peru', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(405, 'Philippines', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(406, 'Poland', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(407, 'Portugal', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(408, 'Puerto Rico', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(409, 'Qatar', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(410, 'Romania', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(411, 'Russian Federation', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(412, 'Rwanda', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(413, 'Samoa', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(414, 'Saudi Arabia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(415, 'Senegal', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(416, 'Serbia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(417, 'Sierra Leone', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(418, 'Singapore', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(419, 'Slovakia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(420, 'Slovenia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(421, 'Somalia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(422, 'South Africa', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(423, 'South Korea', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(424, 'Spain', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(425, 'Sri Lanka', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(426, 'Sudan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(427, 'Swaziland', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(428, 'Sweden', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(429, 'Switzerland', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(430, 'Syrian Arab Republic', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(431, 'Taiwan, Province of China', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(432, 'Tajikistan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(433, 'Tanzania, United Republic of', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(434, 'Thailand', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(435, 'Tibet', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(436, 'Togo', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(437, 'Tonga', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(438, 'Trinidad and Tobago', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(439, 'Tunisia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(440, 'Turkey', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(441, 'Turkmenistan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(442, 'Uganda', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(443, 'Ukraine', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(444, 'United Arab Emirates', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(445, 'United States', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(446, 'Uruguay', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(447, 'Uzbekistan', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(448, 'Venezuela', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(449, 'Vietnam', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(450, 'Yemen', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(451, 'Zambia', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(452, 'Zimbabwe', '5', 1, '1', NULL, '2023-12-25 07:11:59', '2023-12-25 07:11:59'),
(453, 'Social Media', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(454, 'Friend', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(455, 'Email', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(456, 'Conference', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(457, 'Flyer', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(458, 'Event', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(459, 'Newspaper', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(460, 'Online Search', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(461, 'Radio', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(462, 'Schools', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(463, 'Signs', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(464, 'University', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(465, 'Volunteer Agency', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(466, 'Volunteer Fair', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51'),
(467, 'Other', '20', 1, '1', NULL, '2023-12-26 03:52:51', '2023-12-26 03:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sub Admin', 'ddd', 1, '1', NULL, '2024-01-15 07:50:57', '2024-01-15 07:50:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` int DEFAULT NULL,
  `permission_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `short_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 'Alabama', 'AL', 1, '1', NULL, '2023-12-23 07:40:52', '2023-12-23 07:40:52'),
(5, 'Alaska', 'AK', 1, '1', NULL, '2023-12-23 07:42:29', '2023-12-23 07:42:29'),
(6, 'Arizona', 'AZ', 1, '1', NULL, '2023-12-23 07:42:44', '2023-12-23 07:42:44'),
(7, 'Arkansas', 'AR', 1, '1', NULL, '2023-12-23 07:43:16', '2023-12-23 07:43:16'),
(8, 'California', 'CA', 1, '1', '1', '2023-12-23 07:43:27', '2023-12-29 08:53:26'),
(9, 'Colorado', 'CO', 1, '1', NULL, '2023-12-23 07:44:11', '2023-12-23 07:44:11'),
(10, 'Connecticut', 'CT', 1, '1', NULL, '2023-12-23 07:44:27', '2023-12-23 07:44:27'),
(11, 'Delaware', 'DE', 1, '1', NULL, '2023-12-23 07:45:11', '2023-12-23 07:45:11'),
(12, 'Florida', 'FL', 1, '1', NULL, '2023-12-23 07:45:21', '2023-12-23 07:45:21'),
(13, 'Georgia', 'GA', 1, '1', '1', '2023-12-23 07:45:44', '2023-12-23 07:58:37'),
(14, 'Hawaii', 'HI', 1, '1', NULL, '2023-12-23 07:45:57', '2023-12-23 07:45:57'),
(15, 'Idaho', 'ID', 1, '1', NULL, '2023-12-23 07:46:11', '2023-12-23 07:46:11'),
(16, 'Illinois', 'IL', 1, '1', NULL, '2023-12-23 07:46:24', '2023-12-23 07:46:24'),
(17, 'Indiana', 'IN', 1, '1', NULL, '2023-12-23 07:46:35', '2023-12-23 07:46:35'),
(18, 'Iowa', 'IA', 1, '1', NULL, '2023-12-23 07:46:46', '2023-12-23 07:46:46'),
(19, 'Kansas', 'KS', 1, '1', NULL, '2023-12-23 07:46:59', '2023-12-23 07:46:59'),
(20, 'Kentucky', 'KY', 1, '1', NULL, '2023-12-23 07:47:14', '2023-12-23 07:47:14'),
(21, 'Louisiana', 'LA', 1, '1', NULL, '2023-12-23 07:47:53', '2023-12-23 07:47:53'),
(22, 'Maine', 'ME', 1, '1', NULL, '2023-12-23 07:48:10', '2023-12-23 07:48:10'),
(23, 'Maryland', 'MD', 1, '1', NULL, '2023-12-23 07:48:22', '2023-12-23 07:48:22'),
(24, 'Massachusetts', 'MA', 1, '1', NULL, '2023-12-23 07:48:54', '2023-12-23 07:48:54'),
(25, 'Michigan', 'MI', 1, '1', NULL, '2023-12-23 07:49:05', '2023-12-23 07:49:05'),
(26, 'Minnesota', 'MN', 1, '1', NULL, '2023-12-23 07:49:20', '2023-12-23 07:49:20'),
(27, 'Mississippi', 'MS', 1, '1', NULL, '2023-12-23 07:49:40', '2023-12-23 07:49:40'),
(28, 'Missouri', 'MO', 1, '1', NULL, '2023-12-23 07:49:52', '2023-12-23 07:49:52'),
(29, 'Montana', 'MT', 1, '1', NULL, '2023-12-23 07:50:09', '2023-12-23 07:50:09'),
(30, 'Nebraska', 'NE', 1, '1', NULL, '2023-12-23 07:50:26', '2023-12-23 07:50:26'),
(31, 'Nevada', 'NV', 1, '1', NULL, '2023-12-23 07:50:44', '2023-12-23 07:50:44'),
(32, 'New Hampshire', 'NH', 1, '1', NULL, '2023-12-23 07:52:04', '2023-12-23 07:52:04'),
(33, 'New Jersey', 'NJ', 1, '1', NULL, '2023-12-23 07:52:18', '2023-12-23 07:52:18'),
(34, 'New Mexico', 'NM', 1, '1', NULL, '2023-12-23 07:52:42', '2023-12-23 07:52:42'),
(35, 'New York', 'NY', 1, '1', NULL, '2023-12-23 07:53:01', '2023-12-23 07:53:01'),
(36, 'North Carolina', 'NC', 1, '1', NULL, '2023-12-23 07:53:22', '2023-12-23 07:53:22'),
(37, 'North Dakota', 'ND', 1, '1', NULL, '2023-12-23 07:53:36', '2023-12-23 07:53:36'),
(38, 'Ohio', 'OH', 1, '1', NULL, '2023-12-23 07:53:47', '2023-12-23 07:53:47'),
(39, 'Oklahoma', 'OK', 1, '1', NULL, '2023-12-23 07:54:17', '2023-12-23 07:54:17'),
(40, 'Oregon', 'OR', 1, '1', NULL, '2023-12-23 07:54:28', '2023-12-23 07:54:28'),
(41, 'Pennsylvania', 'PA', 1, '1', NULL, '2023-12-23 07:54:40', '2023-12-23 07:54:40'),
(42, 'Rhode Island', 'RI', 1, '1', NULL, '2023-12-23 07:54:52', '2023-12-23 07:54:52'),
(43, 'South Carolina', 'SC', 1, '1', NULL, '2023-12-23 07:55:03', '2023-12-23 07:55:03'),
(44, 'South Dakota', 'SD', 1, '1', NULL, '2023-12-23 07:55:19', '2023-12-23 07:55:19'),
(45, 'Tennessee', 'TN', 1, '1', NULL, '2023-12-23 07:55:34', '2023-12-23 07:55:34'),
(46, 'Texas', 'TX', 1, '1', NULL, '2023-12-23 07:55:49', '2023-12-23 07:55:49'),
(47, 'Utah', 'UT', 1, '1', NULL, '2023-12-23 07:55:59', '2023-12-23 07:55:59'),
(48, 'Vermont', 'VT', 1, '1', NULL, '2023-12-23 07:56:10', '2023-12-23 07:56:10'),
(49, 'Virginia', 'VA', 1, '1', NULL, '2023-12-23 07:56:22', '2023-12-23 07:56:22'),
(50, 'Washington', 'WA', 1, '1', NULL, '2023-12-23 07:56:34', '2023-12-23 07:56:34'),
(51, 'West Viginia', 'WV', 1, '1', NULL, '2023-12-23 07:56:48', '2023-12-23 07:56:48'),
(52, 'Wisconsin', 'WI', 1, '1', NULL, '2023-12-23 07:57:00', '2023-12-23 07:57:00'),
(53, 'Wyoming', 'WY', 1, '1', NULL, '2023-12-23 07:57:10', '2023-12-23 07:57:10'),
(54, 'District of Columbia', 'DC', 1, '1', NULL, '2023-12-23 07:59:59', '2023-12-23 07:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trem_condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_match` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_group_class` tinyint NOT NULL DEFAULT '0',
  `time_zone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `under_age` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `name`, `l_name`, `email`, `password`, `trem_condition`, `phone`, `birthday`, `gender`, `street_address`, `city`, `state`, `zip`, `zip_match`, `is_group_class`, `time_zone`, `under_age`, `emergency_name`, `emergency_number`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2', 'ritu', 'pandey', 'ritika@gmail.com', '$2y$10$mduJ6rPDVVO7/MyvBkwA6epdBmOH9AepJ9tLks.AVNamoLPlDj2y.', '1', '9625688000', '2000-11-30', 'male', 'indra nagar unnao', 'unnao', '19', '80021', 'matched', 0, '6', '2', 'ririka', '1234567654', 1, '1', '2', '2023-12-29 05:47:59', '2024-01-25 11:00:02'),
(3, '9', 'Becky', 'Campbell Howe', 'becky@intercambio.org', '$2y$10$cp0NRzXMaVH4Lv49.v7F0ON7aXz2XDO1wFjak1hjBRoQAbxudPVzq', '1', '3038594298', '1962-04-12', 'male', '123 Main St', 'Longmont', '9', '80501', 'matched', 0, '4', '0', 'Jim Howe', '3038594299', 1, '9', '9', '2024-01-04 16:06:27', '2024-01-04 16:10:04'),
(4, '10', 'ritikatesting', 'pandey', 'ritika888787@gmail.com', '$2y$10$AibkS.oqnmNvTXfVha4sLuwS6LrwdNT1IuVrEq40ZfbCodFheAAyC', '1', '8887870982', '1998-01-24', 'female', 'indra nagar unnao', 'unnao', '6', '1234567', 'not matched', 0, '5', '2', 'ririka ji', '12345676543', 1, '10', '10', '2024-01-06 07:07:38', '2024-02-17 03:55:53'),
(5, '15', 'Kajal', 'Kumari', 'kj.kumari1121@gmail.com', '$2y$10$gztpdyVqrg1eKc0eWph/iuLDANAzcjgoZQ0b69UoIDWcXy2zBp7VG', '1', '8851514287', '2002-02-22', 'male', 'Test Data', 'Naraina vihar', '6', '80021', 'matched', 0, '4', '0', 'Test', '00999937678', 1, '15', '15', '2024-01-29 07:24:47', '2024-01-29 12:42:16'),
(10, '21', 'ritu', 'srivastav', '9918priyanshu@gmail.com', '$2y$10$K9HtWZijZqCYlOg.5D8H/.58ClDdfciQop9uR5otn8tQtAT1FxBNS', '1', '8112912880', '2003-02-28', 'male', 'Techsaga Corporation sector 2 201301.', 'Noida', '5', '80020', 'matched', 0, '4', '5', 'Amul', '7678376001', 1, '21', '21', '2024-01-30 01:20:49', '2024-02-21 00:42:08'),
(11, '35', 'dummy', 'dummy', 'dummy@gmail.com', '$2y$10$T1U64fnIVFpFcFv58n21Gu.6k44bI0kdyAUqc5TEBYTl.RT6kk0tG', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, '35', NULL, NULL, NULL),
(12, '36', 'dummy1', 'dummy1', 'dumm1@gmail.com', '$2y$10$hvE16Q0CXNw9s.7VpmU2Gu7HJLiyD.Cl5vrEEbc3WRRWAm47DfW4q', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, '36', NULL, NULL, NULL),
(13, '37', 'dummy2', 'dummy2', 'dummy2@gmail.com', '$2y$10$j2MZUm1xqgaCEeeveo8IjOJyyVZX1T3yO2drGYY0IxhaAaJa83a7O', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, '37', NULL, NULL, NULL),
(14, '38', 'priyanshu', 'srivastav', 'rs12@mailinator.com', '$2y$10$fk3ygjn.AKP/UaWsVKYtqOBJ/GkWst8Qcof2/JPH0HSIAXTeQRgI6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, '38', NULL, '2024-03-13 02:16:53', '2024-03-13 02:16:53'),
(15, '39', 'priyanshu', 'srivastav', 'test@mailinator.com', '$2y$10$Q9y21wlGxvkUO9Al2Je6FOEN2sgtGjczca9oCXg07zR4bDABhUtbG', NULL, '1234567898', '2000-02-02', 'male', 'test mirzapur up', 'noida', '19', '80020', 'matched', 0, '5', '5', 'Amul', '323113132334', 1, '39', '39', '2024-03-13 05:07:37', '2024-03-13 06:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `student_pairings`
--

CREATE TABLE `student_pairings` (
  `id` bigint UNSIGNED NOT NULL,
  `pairing_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '''0''=>inactive,''1''=>active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_pairings`
--

INSERT INTO `student_pairings` (`id`, `pairing_id`, `user_id`, `order_id`, `subscription_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(2, '7', '21', '2', NULL, '50', 0, '2024-02-16 01:47:43', '2024-02-16 01:47:43'),
(3, '5', '9', '2', NULL, '50', 0, '2024-02-16 01:47:43', '2024-02-16 01:47:43'),
(4, '3', '2', '2', NULL, '50', 0, '2024-02-16 01:47:43', '2024-02-16 01:47:43'),
(5, '2', '15\r\n', '2', NULL, '50', 0, '2024-02-16 01:47:43', '2024-02-16 01:47:43'),
(6, '6', '10', '3', NULL, '60', 0, '2024-02-17 03:57:17', '2024-02-17 03:57:17'),
(7, '8', '21', '4', NULL, '60', 0, '2024-02-17 04:45:40', '2024-02-17 04:45:40'),
(9, NULL, '21', '51', NULL, '60', 0, '2024-02-28 02:09:36', '2024-02-28 02:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_credits`
--

CREATE TABLE `subscription_credits` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `purchase_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `next_payment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint UNSIGNED NOT NULL,
  `pairing_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `pairing_id`, `user_id`, `reason`, `user_type`, `status`, `created_at`, `updated_at`) VALUES
(1, '7', '21', 'My teacher doesn’t want to meet anymore – I’d like a new teacher', 'student', 1, '2024-02-20 00:46:24', NULL),
(2, '9', '24', 'I wish to stop teaching', 'teacher', 1, '2024-02-20 00:47:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volunteer_information` tinyint NOT NULL DEFAULT '0',
  `here_about_us` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiving_text_message` tinyint NOT NULL DEFAULT '0',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+1',
  `country` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'US',
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Chicago',
  `class_teaching_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_type_preference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voluntee_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_commitment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voluntee_for_intercombio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `zip_match` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `name`, `volunteer_information`, `here_about_us`, `receiving_text_message`, `phone`, `birthday`, `gender`, `address`, `country_code`, `country`, `city`, `state`, `zip`, `timezone`, `class_teaching_type`, `class_type_preference`, `voluntee_location`, `location_comment`, `time_commitment`, `voluntee_for_intercombio`, `other_info`, `status`, `zip_match`, `created_at`, `updated_at`) VALUES
(11, '24', 'teacher', 1, 'Social Media', 1, '08112912880', '2003-01-29', 'male', 'hoshiyar pur sector 51', '+1', 'US', 'data', '51', '201301', 'Chicago', 'Online', NULL, NULL, NULL, 'yes', 'testing mode', 'data added', 1, 'not matched', '2024-02-16 00:57:16', '2024-02-16 00:58:48'),
(12, '25', 'teacher', 1, 'Email', 1, '8112912880', '2000-02-01', 'male', 'sector 51 noida values', '+1', 'US', 'noida', '52', '201301', 'Chicago', 'In Person', 'One-on-One Tutoring', 'Boulder', 'testing mode', 'yes', 'ddd', 'ddd', 1, 'not matched', '2024-02-16 01:00:45', '2024-02-16 01:02:24'),
(13, '26', 'teacher group', 1, 'Social Media', 1, '7678376001', '2000-02-09', 'male', 'noida sector 51', '+1', 'US', 'noida', '53', '302923', 'Chicago', 'In Person', 'One-on-One Tutoring', 'Boulder', 'testing mode', 'yes', 'data wold be in order', 'testing mode', 1, 'not matched', '2024-02-16 01:04:39', '2024-02-16 01:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_pairings`
--

CREATE TABLE `teacher_pairings` (
  `id` bigint UNSIGNED NOT NULL,
  `new_batch_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_m_add` tinyint NOT NULL DEFAULT '0',
  `student_m_add` tinyint NOT NULL DEFAULT '0',
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_pairings`
--

INSERT INTO `teacher_pairings` (`id`, `new_batch_id`, `course_id`, `batch_id`, `batch_name`, `student_id`, `teacher_id`, `course_level`, `class_type`, `payment_status`, `teacher_m_add`, `student_m_add`, `status`, `created_at`, `updated_at`) VALUES
(2, NULL, 'clpkp2j92kq93pkql810', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '15', '26', NULL, 'Group Classes', 'paid', 0, 0, 0, '2024-02-16 03:12:09', NULL),
(3, NULL, 'clpkp2j92kq93pkql810', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '2', '26', '5L', 'Group Classes', 'paid', 0, 0, 0, '2024-02-16 03:14:18', NULL),
(5, NULL, 'clpkp2j92kq93pkql810', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '9', '26', '3L', 'Group Classes', 'paid', 0, 0, 0, '2024-02-16 03:17:17', NULL),
(6, '10', 'clj4fej92kq0n85op3b0', 'cn87mlr92kq6hu0sig7g', '5L Lessons ritikatesting, teacher2024-02-17 09:24', '10', '24', '5L', 'Online', 'paid', 0, 0, 0, '2024-02-17 03:54:39', NULL),
(7, NULL, 'clpkp2j92kq93pkql810', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '21', '26', '5L', 'Group Classes', 'paid', 0, 0, 0, '2024-02-17 04:46:09', NULL),
(8, NULL, 'clpkp2j92kq93pkql810', 'clpksj1nuvtc37dnsed0', '5L - Longmont', '21', '26', '5L', 'Group Classes', 'paid', 0, 0, 0, '2024-02-17 04:46:49', NULL),
(9, '11', 'clj4fej92kq0n85op3b0', 'cna47pr92kqfubg3nssg', '5L Lessons ritikatesting, teacher2024-02-20 06:17', '39', '24', '5L', 'one to one', 'paid', 0, 0, 0, '2024-02-20 00:47:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_quizzes`
--

CREATE TABLE `teacher_quizzes` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_zones`
--

CREATE TABLE `time_zones` (
  `id` int NOT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `time_zones`
--

INSERT INTO `time_zones` (`id`, `country_code`, `timezone`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, NULL, 'Mountain Time', 1, '1', NULL, '2023-12-23 09:07:46', '2023-12-23 09:07:46'),
(5, NULL, 'Eastern Time', 1, '1', NULL, '2023-12-23 09:08:00', '2023-12-23 09:08:00'),
(6, NULL, 'Central Time', 1, '1', NULL, '2023-12-23 09:08:29', '2023-12-23 09:08:29'),
(7, NULL, 'Pacific Time', 1, '1', NULL, '2023-12-23 09:08:48', '2023-12-23 09:08:48'),
(8, NULL, 'Hawaii', 1, '1', NULL, '2023-12-23 09:09:09', '2023-12-23 09:09:09'),
(9, NULL, 'Alaska', 1, '1', NULL, '2023-12-23 09:09:22', '2023-12-23 09:09:22'),
(10, NULL, 'Puerto Rico', 1, '1', NULL, '2023-12-23 09:09:38', '2023-12-23 09:09:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `level` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_mark` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` tinyint NOT NULL DEFAULT '0',
  `stripe_customer_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint NOT NULL DEFAULT '0',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` tinyint DEFAULT NULL COMMENT '0 => admin, 1 => user, 2 => teacher, 3 => student	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `l_name`, `email`, `phone`, `role_id`, `email_verified_at`, `password`, `c_password`, `image`, `remember_token`, `status`, `level`, `total_mark`, `is_completed`, `stripe_customer_id`, `is_verified`, `created_by`, `updated_by`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, 'admin@gmail.com', NULL, NULL, NULL, '$2y$10$KAe3HOwj.TQPmnyBQpOhpOXInhPNctT1wU8g5fB93mrrd/n44ZA/m', NULL, NULL, NULL, 1, '5L', '30', 0, NULL, 0, '1', NULL, 0, NULL, NULL),
(2, 'ritu', 'pandey', 'ritika@gmail.com', '9625688000', NULL, NULL, '$2y$10$mduJ6rPDVVO7/MyvBkwA6epdBmOH9AepJ9tLks.AVNamoLPlDj2y.', NULL, NULL, NULL, 1, '5L', '30', 0, NULL, 1, '1', NULL, 3, '2023-12-29 05:47:59', '2024-01-25 10:59:55'),
(9, 'Becky', 'Campbell Howe', 'becky@intercambio.org', '3038594298', NULL, NULL, '$2y$10$cp0NRzXMaVH4Lv49.v7F0ON7aXz2XDO1wFjak1hjBRoQAbxudPVzq', NULL, NULL, NULL, 1, '3L', '17', 0, NULL, 1, NULL, NULL, 3, '2024-01-04 16:06:23', '2024-01-04 16:09:13'),
(10, 'ritikatesting', 'pandey', 'ritika888787@gmail.com', '8887870982', NULL, NULL, '$2y$10$KAe3HOwj.TQPmnyBQpOhpOXInhPNctT1wU8g5fB93mrrd/n44ZA/m', NULL, NULL, NULL, 1, '5L', '30', 1, NULL, 1, NULL, NULL, 3, '2024-01-06 07:07:37', '2024-02-17 03:55:48'),
(11, 'ritu', NULL, 'riti@gmail.com', '8887870982', '6', NULL, '$2y$10$bn2ErFBVFZPhvKq77O8Tn.IGU7n2rarNsnP.YwS/Po9gSZmMOvS9S', '12345678', NULL, NULL, 1, NULL, NULL, 0, NULL, 0, '1', NULL, 1, '2024-01-11 06:28:06', '2024-01-11 06:28:06'),
(14, 'Alaska', NULL, 'alaska@gmail.com', '8851514287', '1', NULL, '$2y$10$VUVlruBLIiDuxx3wculztuAyY46BiNSzF2lIhuiaOvqsPVVPb5hCu', 'alaska@123', NULL, NULL, 1, NULL, NULL, 0, NULL, 0, '1', NULL, 1, '2024-01-12 17:00:26', '2024-01-12 17:00:26'),
(15, 'Kajal', 'Kumari', 'kj.kumari1121@gmail.com', '8851514287', NULL, NULL, '$2y$10$gztpdyVqrg1eKc0eWph/iuLDANAzcjgoZQ0b69UoIDWcXy2zBp7VG', NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, 1, NULL, NULL, 3, '2024-01-29 07:24:47', '2024-01-29 07:32:26'),
(21, 'ritu', 'srivastav', '9918priyanshu@gmail.com', '8112912880', NULL, NULL, '$2y$10$K9HtWZijZqCYlOg.5D8H/.58ClDdfciQop9uR5otn8tQtAT1FxBNS', NULL, NULL, NULL, 1, '5L', '30', 0, 'cus_PUKOmVF3DAdZsV', 0, NULL, NULL, 3, '2024-01-30 01:20:45', '2024-02-21 00:42:04'),
(24, 'teacher', 'priyanshu', 'teacheronline@gmail.com', '08112912880', NULL, NULL, '$2y$10$rp8a6XjgDbqtAQt.m43k/e3QepJS47K95u../QLk6xoeKEcaGtI0u', NULL, NULL, NULL, 1, '5L', '30', 1, NULL, 1, NULL, NULL, 2, '2024-02-16 00:57:13', '2024-02-16 00:58:48'),
(25, 'teacher', 'testone', 'teacherone@gmail.com', '8112912880', NULL, NULL, '$2y$10$fPCXeVzm5XyMChjDwTd.rO9XtF1BcP1uIeRl1/72Rs1lg94pGq0My', NULL, NULL, NULL, 1, '5L', '30', 1, NULL, 1, NULL, NULL, 2, '2024-02-16 01:00:41', '2024-02-16 01:02:24'),
(26, 'teacher group', 'test group', 'teachergroup@gmail.com', '7678376001', NULL, NULL, '$2y$10$ujcQdZdJBLqMhSYs0Z4.Fe1j0LpnM/qG6ehUJWYppT6qxcDAjdANa', NULL, NULL, NULL, 1, '5L', '30', 1, NULL, 1, NULL, NULL, 2, '2024-02-16 01:04:36', '2024-02-16 01:08:56'),
(35, 'dummy', 'dummy', 'dummy@gmail.com', '12345678', 'NULL', NULL, '$2y$10$T1U64fnIVFpFcFv58n21Gu.6k44bI0kdyAUqc5TEBYTl.RT6kk0tG', '12345678', 'NULL', NULL, 1, NULL, NULL, 0, NULL, 1, NULL, NULL, 3, '2024-03-05 03:30:23', '2024-03-05 03:30:23'),
(36, 'dummy1', 'dummy1', 'dumm1@gmail.com', '12345678', 'NULL', NULL, '$2y$10$hvE16Q0CXNw9s.7VpmU2Gu7HJLiyD.Cl5vrEEbc3WRRWAm47DfW4q', '12345678', 'NULL', NULL, 1, NULL, NULL, 0, NULL, 1, NULL, NULL, 3, '2024-03-05 03:30:23', '2024-03-05 03:30:23'),
(37, 'dummy2', 'dummy2', 'dummy2@gmail.com', '12345678', 'NULL', NULL, '$2y$10$j2MZUm1xqgaCEeeveo8IjOJyyVZX1T3yO2drGYY0IxhaAaJa83a7O', '12345678', 'NULL', NULL, 1, NULL, NULL, 0, NULL, 1, NULL, NULL, 3, '2024-03-05 03:30:23', '2024-03-05 03:30:23'),
(38, 'priyanshu', 'srivastav', 'rs12@mailinator.com', NULL, NULL, NULL, '$2y$10$fk3ygjn.AKP/UaWsVKYtqOBJ/GkWst8Qcof2/JPH0HSIAXTeQRgI6', NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, NULL, 3, '2024-03-13 02:16:44', '2024-03-13 02:16:44'),
(39, 'priyanshu', 'srivastav', 'test@mailinator.com', '1234567898', NULL, NULL, '$2y$10$Q9y21wlGxvkUO9Al2Je6FOEN2sgtGjczca9oCXg07zR4bDABhUtbG', NULL, NULL, NULL, 1, '2L', '30', 1, NULL, 1, NULL, NULL, 3, '2024-03-13 05:07:29', '2024-03-13 06:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `zip_codes`
--

CREATE TABLE `zip_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `zipcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zip_codes`
--

INSERT INTO `zip_codes` (`id`, `zipcode`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
(4, '80020', '1', NULL, 1, '2023-12-23 07:14:08', '2023-12-23 07:14:08'),
(5, '80021', '1', NULL, 1, '2023-12-23 07:14:28', '2023-12-23 07:14:28'),
(6, '80023', '1', NULL, 1, '2023-12-23 07:14:42', '2023-12-23 07:14:42'),
(7, '80038', '1', NULL, 1, '2023-12-23 07:14:54', '2023-12-23 07:14:54'),
(8, '80516', '1', NULL, 1, '2023-12-23 07:15:05', '2023-12-23 07:15:05'),
(9, '80025', '1', NULL, 1, '2023-12-23 07:15:26', '2023-12-23 07:15:26'),
(10, '80026', '1', NULL, 1, '2023-12-23 07:15:38', '2023-12-23 07:15:38'),
(11, '80027', '1', NULL, 1, '2023-12-23 07:15:49', '2023-12-23 07:15:49'),
(12, '80301', '1', NULL, 1, '2023-12-23 07:15:59', '2023-12-23 07:15:59'),
(13, '80302', '1', NULL, 1, '2023-12-23 07:16:08', '2023-12-23 07:16:08'),
(14, '80303', '1', NULL, 1, '2023-12-23 07:16:19', '2023-12-23 07:16:19'),
(15, '80304', '1', NULL, 1, '2023-12-23 07:16:29', '2023-12-23 07:16:29'),
(16, '80305', '1', NULL, 1, '2023-12-23 07:16:41', '2023-12-23 07:16:41'),
(17, '80306', '1', NULL, 1, '2023-12-23 07:16:50', '2023-12-23 07:16:50'),
(18, '80307', '1', NULL, 1, '2023-12-23 07:17:01', '2023-12-23 07:17:01'),
(19, '80308', '1', NULL, 1, '2023-12-23 07:17:13', '2023-12-23 07:17:13'),
(20, '80309', '1', NULL, 1, '2023-12-23 07:17:22', '2023-12-23 07:17:22'),
(21, '80310', '1', NULL, 1, '2023-12-23 07:17:32', '2023-12-23 07:17:32'),
(22, '80314', '1', NULL, 1, '2023-12-23 07:17:45', '2023-12-23 07:17:45'),
(23, '80403', '1', NULL, 1, '2023-12-23 07:17:57', '2023-12-23 07:17:57'),
(24, '80455', '1', NULL, 1, '2023-12-23 07:18:07', '2023-12-23 07:18:07'),
(25, '80466', '1', NULL, 1, '2023-12-23 07:18:17', '2023-12-23 07:18:17'),
(26, '80471', '1', NULL, 1, '2023-12-23 07:18:27', '2023-12-23 07:18:27'),
(27, '80481', '1', NULL, 1, '2023-12-23 07:18:37', '2023-12-23 07:18:37'),
(28, '80501', '1', NULL, 1, '2023-12-23 07:18:47', '2023-12-23 07:18:47'),
(29, '80502', '1', NULL, 1, '2023-12-23 07:18:57', '2023-12-23 07:18:57'),
(30, '80503', '1', NULL, 1, '2023-12-23 07:19:07', '2023-12-23 07:19:07'),
(31, '80504', '1', NULL, 1, '2023-12-23 07:19:18', '2023-12-23 07:19:18'),
(32, '80510', '1', NULL, 1, '2023-12-23 07:19:31', '2023-12-23 07:19:31'),
(33, '80516', '1', NULL, 1, '2023-12-23 07:19:41', '2023-12-23 07:19:41'),
(34, '80533', '1', NULL, 1, '2023-12-23 07:19:51', '2023-12-23 07:19:51'),
(35, '80540', '1', NULL, 1, '2023-12-23 07:19:59', '2023-12-23 07:19:59'),
(36, '80544', '1', NULL, 1, '2023-12-23 07:20:09', '2023-12-23 07:20:09'),
(37, '80513', '1', NULL, 1, '2023-12-23 07:20:17', '2023-12-23 07:20:17'),
(38, '80514', '1', NULL, 1, '2023-12-23 07:20:27', '2023-12-23 07:20:27'),
(39, '80520', '1', NULL, 1, '2023-12-23 07:20:37', '2023-12-23 07:20:37'),
(40, '80530', '1', NULL, 1, '2023-12-23 07:20:47', '2023-12-23 07:20:47'),
(41, '80534', '1', NULL, 1, '2023-12-23 07:20:57', '2023-12-23 07:20:57'),
(42, '80542', '1', NULL, 1, '2023-12-23 07:21:08', '2023-12-23 07:21:08'),
(43, '80603', '1', NULL, 1, '2023-12-23 07:21:17', '2023-12-23 07:21:17'),
(44, '80651', '1', NULL, 1, '2023-12-23 07:21:30', '2023-12-23 07:21:30'),
(45, '80003', '1', NULL, 1, '2023-12-23 07:21:38', '2023-12-23 07:21:38'),
(46, '80030', '1', NULL, 1, '2023-12-23 07:21:48', '2023-12-23 07:21:48'),
(47, '80031', '1', NULL, 1, '2023-12-23 07:21:57', '2023-12-23 07:21:57'),
(48, '80035', '1', NULL, 1, '2023-12-23 07:22:07', '2023-12-23 07:22:07'),
(49, '80036', '1', NULL, 1, '2023-12-23 07:22:17', '2023-12-23 07:22:17'),
(50, '80241', '1', NULL, 1, '2023-12-23 07:22:26', '2023-12-23 07:22:26'),
(51, '80601', '1', NULL, 1, '2023-12-23 07:22:36', '2023-12-23 07:22:36'),
(52, '80602', '1', NULL, 1, '2023-12-23 07:22:47', '2023-12-23 07:22:47'),
(53, '80603', '1', NULL, 1, '2023-12-23 07:22:57', '2023-12-23 07:22:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_masters`
--
ALTER TABLE `action_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_masters_parent_index` (`parent_id`);

--
-- Indexes for table `availabilities`
--
ALTER TABLE `availabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `finish_courses`
--
ALTER TABLE `finish_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merithub_creditionals`
--
ALTER TABLE `merithub_creditionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_batch_pairs`
--
ALTER TABLE `new_batch_pairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchase_classes`
--
ALTER TABLE `purchase_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_entries`
--
ALTER TABLE `question_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`short_name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `student_pairings`
--
ALTER TABLE `student_pairings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_credits`
--
ALTER TABLE `subscription_credits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_pairings`
--
ALTER TABLE `teacher_pairings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_quizzes`
--
ALTER TABLE `teacher_quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_zones`
--
ALTER TABLE `time_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `zip_codes`
--
ALTER TABLE `zip_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_masters`
--
ALTER TABLE `action_masters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `availabilities`
--
ALTER TABLE `availabilities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finish_courses`
--
ALTER TABLE `finish_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merithub_creditionals`
--
ALTER TABLE `merithub_creditionals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `new_batch_pairs`
--
ALTER TABLE `new_batch_pairs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_classes`
--
ALTER TABLE `purchase_classes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `question_entries`
--
ALTER TABLE `question_entries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=468;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student_pairings`
--
ALTER TABLE `student_pairings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subscription_credits`
--
ALTER TABLE `subscription_credits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teacher_pairings`
--
ALTER TABLE `teacher_pairings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teacher_quizzes`
--
ALTER TABLE `teacher_quizzes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_zones`
--
ALTER TABLE `time_zones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `zip_codes`
--
ALTER TABLE `zip_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
