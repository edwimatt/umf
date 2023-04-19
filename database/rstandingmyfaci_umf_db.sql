-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2023 at 04:37 AM
-- Server version: 5.7.42
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rstandingmyfaci_umf`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_group_id` int(11) NOT NULL DEFAULT '1',
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `last_login_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `forgot_password_hash` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `forgot_password_hash_created_at` timestamp NULL DEFAULT NULL,
  `remember_login_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_login_token_created_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_group_id`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `is_active`, `last_login_at`, `forgot_password_hash`, `forgot_password_hash_created_at`, `remember_login_token`, `remember_login_token_created_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Adminisstrator', '', 'admin@admin.com', 'ff7d279c14ee6dc77d7d8f3bb1b48f14', NULL, 1, '2018-07-10 07:21:02', '', NULL, '', NULL, '2018-07-10 02:21:02', '2018-07-10 02:21:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_group`
--

CREATE TABLE `admin_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_group_relation`
--

CREATE TABLE `admin_group_relation` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_user`
--

CREATE TABLE `api_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `api_user`
--

INSERT INTO `api_user` (`id`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'api_user', 'e3084f7e404fb3ad1bc637f4ea034627', '2018-08-18 10:49:53', '2018-08-18 10:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(20) NOT NULL,
  `category_type` varchar(33) DEFAULT 'quiz',
  `parent_id` int(20) DEFAULT '0',
  `category_name` varchar(225) DEFAULT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `spanish_category_name` varchar(255) DEFAULT NULL,
  `spanish_description` text,
  `description` text,
  `certificate_requirement` text,
  `certificate_confirmation` text,
  `display_order` int(10) DEFAULT NULL,
  `is_show_on_place_ad` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_type`, `parent_id`, `category_name`, `short_name`, `spanish_category_name`, `spanish_description`, `description`, `certificate_requirement`, `certificate_confirmation`, `display_order`, `is_show_on_place_ad`, `created_at`, `updated_at`) VALUES
(6, 'quiz', 0, 'UNDERSTANDING MY FACILITY SYSTEMS', NULL, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES:', '<p class=\"MsoNoSpacing\">La mayoría de los asociados de atención médica no\r\ncomprenden completamente los complicados sistemas del entorno en el que deben\r\nbrindar atención a sus pacientes. En nuestros módulos innovadores, divertidos y\r\nfáciles de entender \"Easy Facilities Systems Video Series \", hemos\r\ndescrito todos los sistemas críticos de una instalación de atención médica.<span style=\"font-size:10.5pt\"><o:p></o:p></span></p><p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\">\r\n\r\n</p><p class=\"MsoNoSpacing\"><b><span lang=\"ES\">Cuando se\r\neduca al personal sobre los elementos de un entorno seguro, es más probable que\r\nsigan los procesos para identificar, informar y tomar medidas sobre los riesgos\r\nambientales.</span></b><span style=\"font-size:10.5pt\"><o:p></o:p></span></p>', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:12.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-hansi-font-family:calibri;mso-bidi-font-family:calibri;=\"\" color:#666666;border:none=\"\" windowtext=\"\" 1.0pt;mso-border-alt:none=\"\" 0in;=\"\" padding:0in\"=\"\">Most healthcare associates do not fully comprehend the complicated\r\nsystems of the environment where they have to provide care to their patients.\r\nIn our innovative, fun, and simple to understand module “Easy Facilities\r\nSystems Video Series”, we have described all the critical systems of a\r\nhealthcare facility.  </span></p><p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><b><span style=\"font-size: 12pt; font-family: \" segoe=\"\" ui=\"\" black\",=\"\" sans-serif;\"=\"\">When staff are educated about the\r\nelements of a safe environment, they are more likely to follow processes for\r\nidentifying, reporting, and taking action on environmental risks.<o:p></o:p></span></b></p>', NULL, NULL, NULL, 0, '2022-03-10 00:49:26', '2022-11-10 08:55:37'),
(7, 'video', 0, 'HOW CAN I HELP?', NULL, 'CÓMO NOS PUEDES AYUDAR?', '<p class=\"MsoNoSpacing\"><span style=\"font-size:12.0pt;mso-ascii-font-family:Calibri;\r\nmso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri\"> </span>Ahora que tiene una mejor\r\ncomprensión de los sistemas críticos de las instalaciones que se necesitan para\r\nproporcionar un entorno de atención seguro y cómodo para nuestros pacientes,<span style=\"font-size:10.5pt\"><o:p></o:p></span></p><p class=\"MsoNoSpacing\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">visitantes\r\ny asociados. Permítanos mostrarle cómo puede ayudarnos a preservar la seguridad\r\ny la calidad de nuestro Hospital evitando problemas e interrupciones\r\ninnecesarias de seguridad y servicios públicos. <span style=\"font-size:10.5pt\"><o:p></o:p></span></p><p style=\"margin-bottom: 0in; line-height: 27pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNoSpacing\"><span lang=\"ES\"><span times=\"\" new=\"\" \";=\"\" mso-bidi-font-family:calibri;mso-bidi-theme-font:minor-latin;color:#202124;=\"\" \"=\"\"> </span><span segoe=\"\" ui=\"\" \",sans-serif;=\"\" \"times=\"\" new=\"\" \";mso-bidi-font-family:calibri;=\"\" \"=\"\">Como\r\ntodos sabemos:<span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"> </span></span><b><span style=\"color: rgb(107, 165, 74); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><span segoe=\"\" ui=\"\" \",sans-serif;=\"\" \"times=\"\" new=\"\" \";mso-bidi-font-family:calibri;=\"\" mso-bidi-theme-font:minor-latin;color:#70ad47;mso-themecolor:accent6;=\"\" \"=\"\">El conocimiento es poder.</span></span></b></span><span style=\"font-size:10.5pt\"><o:p></o:p></span></p>', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size: 12pt;\">Now that you have a better understanding of the critical facility\r\nsystems that are needed to provide a safe and comfortable environment of care\r\nfor our patients, visitors and associates. Let us show you how you can help us\r\npreserve the safety and the quality of our Hospital avoiding unnecessary safety\r\nand utility issues and disruptions.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\">\r\n\r\n</p><p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:12.0pt;font-family:\" segoe=\"\" ui=\"\" black\",sans-serif;mso-fareast-font-family:=\"\" \"times=\"\" new=\"\" roman\";mso-bidi-font-family:calibri;color:#666666;border:none=\"\" windowtext=\"\" 1.0pt;=\"\" mso-border-alt:none=\"\" 0in;padding:0in\"=\"\"> As you all know: </span><span style=\"color: rgb(112, 173, 71); font-family: \"Segoe UI Black\", sans-serif; font-size: 12pt;\">knowledge is power</span></p>', NULL, NULL, NULL, 0, '2022-03-10 00:50:32', '2022-12-20 20:08:56'),
(8, 'video', 0, 'GENERAL SAFETY ORIENTATION FOR ALL HEALTHCARE ASSOCIATES', NULL, 'ORIENTACIÓN GENERAL DE SEGURIDAD PARA TODOS LOS ASOCIADOS DE SALUD', '<p class=\"MsoNoSpacing\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">En nuestro centro de atención médica, la seguridad es un\r\nesfuerzo de equipo, lo que requiere que todos los asociados tomen precauciones\r\npara que los pacientes, visitantes y asociados estén protegidos contra\r\ndiscapacidades graves, lesiones e incluso la muerte cuando se encuentren en las\r\ninstalaciones. En nuestra exclusiva e innovadora “Serie de videos de\r\norientación de seguridad general para todos los asociados de atención médica”;\r\nCubrimos de una manera divertida y muy fácil de comprender las principales\r\npreocupaciones de seguridad en su centro de atención médica.</span></p><p class=\"MsoNoSpacing\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><br></span><span lang=\"ES\" segoe=\"\" ui=\"\" black\",=\"\" sans-serif;\"=\"\" style=\"font-size: 12pt;\">Como todos saben: </span><span lang=\"ES\" segoe=\"\" ui=\"\" black\",sans-serif;=\"\" mso-fareast-font-family:\"times=\"\" new=\"\" roman\";mso-bidi-font-family:\"courier=\"\" new\";=\"\" color:#70ad47;mso-themecolor:accent6;mso-ansi-language:es\"=\"\" style=\"font-size: 12pt;\"><font color=\"#6ba54a\"><b>el conocimiento\r\naumenta la seguridad, la seguridad maximiza la calidad y la calidad es nuestro\r\nobjetivo número 1!</b></font></span></p>', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size: 12pt; color: rgb(102, 102, 102); border: 1pt none windowtext; padding: 0in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">In our healthcare facility, safety is a team\r\neffort, requiring all associates to take precautions so patients, visitors, and\r\nassociates are protected from serious disabilities, injuries and even death\r\nwhen on premises. In our unique and innovative “General Safety Orientation for\r\nAll Healthcare Associates Video Series”; we cover in a fun and very easy way to\r\nunderstand the major safety concerns in your healthcare facility.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><b><span style=\"font-size:12.0pt;font-family:\r\n\" segoe=\"\" ui=\"\" black\",sans-serif;mso-fareast-font-family:\"times=\"\" new=\"\" roman\";=\"\" mso-bidi-font-family:calibri;color:#666666;border:none=\"\" windowtext=\"\" 1.0pt;=\"\" mso-border-alt:none=\"\" 0in;padding:0in\"=\"\">As you all know: </span></b><b><span style=\"font-size:12.0pt;font-family:\r\n\" segoe=\"\" ui=\"\" black\",sans-serif;mso-fareast-font-family:\"times=\"\" new=\"\" roman\";=\"\" mso-bidi-font-family:calibri;color:#70ad47;mso-themecolor:accent6;border:none=\"\" windowtext=\"\" 1.0pt;=\"\" mso-border-alt:none=\"\" 0in;padding:0in\"=\"\"><font color=\"#6ba54a\">knowledge increases safety,\r\nsafety maximizes quality, and quality is our # 1 objective!</font><o:p></o:p></span></b></p>', NULL, NULL, NULL, 0, '2022-03-10 00:52:55', '2022-11-10 08:55:58'),
(9, 'video', 0, 'PREPARATION FOR THE JOINT COMMISSION ACCREDITATION SURVEY', NULL, 'PREPARACION PARA LA ACREDITACION DE SUS INSTALACIONES Y PROCESOS', '<p class=\"MsoListParagraphCxSpFirst\" style=\"text-indent:-.25in;mso-list:l0 level1 lfo1;\r\ntab-stops:list .5in\">        <span style=\"font-size: 12pt;\">En casi todos los 50 estados de la union Americana, las instalaciones\r\nde atencion medica estan acreditadas y son elegibles para el reembolso de\r\nMedical al cumplir con los estandares de Joint Commission u otras agencias de\r\nacreditacion aprobadas.</span><span style=\"font-size: 12pt;\">  </span><span style=\"font-size: 12pt;\">En este video,\r\ncubrimos algunos de estos estandares para que siempre pueda estar listo y ser\r\nun participante en cualquier encuesta regulatoria.</span></p><p class=\"MsoListParagraphCxSpMiddle\"><span style=\"font-size: 12pt;\">NOTA: ESTE VIDEO ESTA EN PRODUCCION</span><br></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;line-height:27.0pt;tab-stops:45.8pt 91.6pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt;\r\nbackground:#F8F9FA\"><br></p>', '<p class=\"MsoListParagraphCxSpFirst\"><span style=\"font-size:12.0pt;line-height:\r\n107%;mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:\r\nCalibri\">In nearly all of the 50 States, healthcare facilities are accredited\r\nand eligible for Medicaid reimbursement by meeting the standards of the Joint\r\nCommission or other approved accreditation agencies.  In this video, we will cover some of these\r\nstandards so you can always be ready and be a team player in any regulatory\r\nsurvey.</span></p><p class=\"MsoListParagraphCxSpFirst\"><span style=\"font-size: 12pt;\">Note: THIS VIDEO IS IN PRODUCTION</span></p>', NULL, NULL, NULL, 0, '2022-03-10 00:53:53', '2022-11-10 08:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_room_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `file_url` text,
  `file_data` text,
  `message_type` varchar(100) NOT NULL DEFAULT 'text',
  `ip_address` varchar(100) DEFAULT NULL,
  `is_anonymous` tinyint(2) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `user_id`, `chat_room_id`, `message`, `file_url`, `file_data`, `message_type`, `ip_address`, `is_anonymous`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'hi\n', '', '{}', 'text', NULL, 0, '2023-03-23 14:01:35', NULL, NULL),
(2, 2, 1, 'Hello', NULL, NULL, 'text', NULL, 0, '2023-03-23 14:01:41', NULL, NULL),
(3, 2, 1, 'Hello', NULL, NULL, 'text', NULL, 0, '2023-03-23 14:02:20', NULL, NULL),
(4, 1, 1, 'hi\n', '', '{}', 'text', NULL, 0, '2023-03-23 14:02:26', NULL, NULL),
(5, 1, 1, 'hi\n', '', '{}', 'text', NULL, 0, '2023-03-23 14:02:37', NULL, NULL),
(6, 1, 1, 'abcd\n', '', '{}', 'text', NULL, 0, '2023-03-23 14:02:41', NULL, NULL),
(7, 2, 1, 'Abcd', NULL, NULL, 'text', NULL, 0, '2023-03-23 14:02:53', NULL, NULL),
(8, 2, 1, 'Abcd', NULL, NULL, 'text', NULL, 0, '2023-03-23 14:02:57', NULL, NULL),
(9, 1, 1, 'xyz\n', '', '{}', 'text', NULL, 0, '2023-03-23 14:11:57', NULL, NULL),
(10, 2, 1, 'Xyz', NULL, NULL, 'text', NULL, 0, '2023-03-23 14:12:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_message_delete`
--

CREATE TABLE `chat_message_delete` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_room_id` int(11) DEFAULT '0',
  `chat_message_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_message_status`
--

CREATE TABLE `chat_message_status` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_room_id` int(11) DEFAULT '0',
  `chat_message_id` int(11) NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_message_status`
--

INSERT INTO `chat_message_status` (`id`, `user_id`, `chat_room_id`, `chat_message_id`, `is_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 1, '2023-03-23 08:01:35', NULL, NULL),
(2, 1, 1, 1, 1, '2023-03-23 08:01:35', NULL, NULL),
(3, 2, 1, 2, 1, '2023-03-23 08:01:41', NULL, NULL),
(4, 1, 1, 2, 1, '2023-03-23 08:01:41', NULL, NULL),
(5, 2, 1, 3, 1, '2023-03-23 08:02:20', NULL, NULL),
(6, 1, 1, 3, 1, '2023-03-23 08:02:20', NULL, NULL),
(7, 2, 1, 4, 1, '2023-03-23 08:02:26', NULL, NULL),
(8, 1, 1, 4, 1, '2023-03-23 08:02:26', NULL, NULL),
(9, 2, 1, 5, 1, '2023-03-23 08:02:37', NULL, NULL),
(10, 1, 1, 5, 1, '2023-03-23 08:02:37', NULL, NULL),
(11, 2, 1, 6, 1, '2023-03-23 08:02:41', NULL, NULL),
(12, 1, 1, 6, 1, '2023-03-23 08:02:41', NULL, NULL),
(13, 2, 1, 7, 1, '2023-03-23 08:02:53', NULL, NULL),
(14, 1, 1, 7, 1, '2023-03-23 08:02:53', NULL, NULL),
(15, 2, 1, 8, 1, '2023-03-23 08:02:57', NULL, NULL),
(16, 1, 1, 8, 1, '2023-03-23 08:02:57', NULL, NULL),
(17, 2, 1, 9, 1, '2023-03-23 08:11:57', NULL, NULL),
(18, 1, 1, 9, 1, '2023-03-23 08:11:57', NULL, NULL),
(19, 2, 1, 10, 1, '2023-03-23 08:12:03', NULL, NULL),
(20, 1, 1, 10, 1, '2023-03-23 08:12:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_rooms`
--

CREATE TABLE `chat_rooms` (
  `id` int(11) NOT NULL,
  `identifier` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `image_url` text,
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `type` enum('single','group') NOT NULL,
  `member_limit` int(11) NOT NULL DEFAULT '0',
  `is_anonymous` tinyint(2) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_rooms`
--

INSERT INTO `chat_rooms` (`id`, `identifier`, `created_by`, `title`, `slug`, `image_url`, `description`, `status`, `type`, `member_limit`, `is_anonymous`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'single-1679558495-1679558495', 1, 'single-1679558495', 'single-1679558495', 'https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg', NULL, 1, 'single', 0, 0, '2023-03-23 08:01:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_room_users`
--

CREATE TABLE `chat_room_users` (
  `id` int(11) NOT NULL,
  `chat_room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_owner` int(11) NOT NULL DEFAULT '0',
  `last_chat_message_id` int(11) DEFAULT '0',
  `last_message_timestamp` datetime DEFAULT NULL,
  `unread_message_counts` int(11) DEFAULT '0',
  `is_anonymous` tinyint(2) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_room_users`
--

INSERT INTO `chat_room_users` (`id`, `chat_room_id`, `user_id`, `is_owner`, `last_chat_message_id`, `last_message_timestamp`, `unread_message_counts`, `is_anonymous`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 0, 10, '2023-03-23 02:12:03', 0, 0, '2023-03-23 08:01:35', NULL, NULL),
(2, 1, 1, 1, 10, '2023-03-23 02:12:03', 0, 0, '2023-03-23 08:01:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_apicustom`
--

CREATE TABLE `cms_apicustom` (
  `id` int(10) UNSIGNED NOT NULL,
  `permalink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tabel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_query_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sql_where` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `method_type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` longtext COLLATE utf8mb4_unicode_ci,
  `responses` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_apikey`
--

CREATE TABLE `cms_apikey` (
  `id` int(10) UNSIGNED NOT NULL,
  `screetkey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_dashboard`
--

CREATE TABLE `cms_dashboard` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_email_queues`
--

CREATE TABLE `cms_email_queues` (
  `id` int(10) UNSIGNED NOT NULL,
  `send_at` datetime DEFAULT NULL,
  `email_recipient` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_cc_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_content` text COLLATE utf8mb4_unicode_ci,
  `email_attachments` text COLLATE utf8mb4_unicode_ci,
  `is_sent` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_email_templates`
--

CREATE TABLE `cms_email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cc_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_email_templates`
--

INSERT INTO `cms_email_templates` (`id`, `name`, `slug`, `subject`, `content`, `description`, `from_name`, `from_email`, `cc_email`, `created_at`, `updated_at`) VALUES
(1, 'Email Template Forgot Password Backend', 'forgot_password_backend', NULL, '<p>Hi,</p><p>Someone requested forgot password, here is your new password : </p><p>[password]</p><p><br></p><p>--</p><p>Regards,</p><p>Admin</p>', '[password]', 'System', 'system@crudbooster.com', NULL, '2018-10-07 13:40:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_logs`
--

CREATE TABLE `cms_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `ipaddress` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `useragent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `id_cms_users` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_logs`
--

INSERT INTO `cms_logs` (`id`, `ipaddress`, `useragent`, `url`, `description`, `details`, `id_cms_users`, `created_at`, `updated_at`) VALUES
(1, '103.86.55.218', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'https://understandingmyfacility.com/admin/logout', 'admin@umf.com logout', '', 24, '2023-04-19 11:45:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_menus`
--

CREATE TABLE `cms_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'url',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_dashboard` tinyint(1) NOT NULL DEFAULT '0',
  `id_cms_privileges` int(11) DEFAULT NULL,
  `sorting` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_menus`
--

INSERT INTO `cms_menus` (`id`, `name`, `type`, `path`, `color`, `icon`, `parent_id`, `is_active`, `is_dashboard`, `id_cms_privileges`, `sorting`, `created_at`, `updated_at`) VALUES
(3, 'Users', 'Route', 'AdminPhysiciansControllerGetIndex', 'normal', 'fa fa-users', 0, 1, 0, 1, 3, '2019-06-17 15:29:44', '2021-05-25 01:04:07'),
(16, 'Faqs', 'Route', 'AdminFaqs25ControllerGetIndex', 'normal', 'fa fa-glass', 0, 1, 0, 1, 4, '2019-07-06 15:23:49', '2021-11-09 05:08:01'),
(17, 'Hospitals', 'Route', 'AdminHospitalControllerGetIndex', 'normal', 'fa fa-link', 0, 1, 0, 1, 5, '2019-08-20 01:44:58', '2021-04-27 19:27:06'),
(19, 'Contents', 'Route', 'AdminSiteContentsControllerGetIndex', 'normal', 'fa fa-sticky-note', 0, 1, 0, 1, 6, '2019-09-23 02:44:49', '2019-09-29 17:51:23'),
(20, 'Dashboard', 'Statistic', 'statistic_builder/show/admin', 'normal', 'fa fa-dashboard', 0, 1, 1, 1, 1, '2019-09-23 03:24:22', '2023-04-18 18:04:29'),
(22, 'Categories', 'Route', 'AdminCategoriesControllerGetIndex', 'normal', 'fa fa-star', 0, 1, 0, 1, 7, '2021-04-21 20:02:26', '2021-05-25 01:02:59'),
(23, 'Courses', 'Route', 'AdminCoursesControllerGetIndex', 'normal', 'fa fa-play-circle-o', 0, 1, 0, 1, 8, '2021-04-22 18:52:18', '2021-05-25 01:03:28'),
(24, 'Course Quizzes', 'Route', 'AdminCourseQuizzesControllerGetIndex', 'normal', 'fa fa-times', 0, 1, 0, 1, 9, '2021-04-27 15:46:45', '2021-05-25 01:03:43'),
(25, 'News', 'Route', 'AdminNewsControllerGetIndex', 'normal', 'fa fa-envelope-o', 0, 1, 0, 1, 10, '2021-05-05 04:39:57', '2022-10-14 03:27:18'),
(26, 'Hospitals', 'Route', 'AdminHospitalControllerGetIndex', 'normal', 'fa fa-hospital-o', 0, 1, 0, 1, 2, '2022-04-05 00:42:31', '2023-04-18 17:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `cms_menus_privileges`
--

CREATE TABLE `cms_menus_privileges` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_cms_menus` int(11) DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_menus_privileges`
--

INSERT INTO `cms_menus_privileges` (`id`, `id_cms_menus`, `id_cms_privileges`) VALUES
(4, 4, 1),
(5, 5, 1),
(8, 8, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(15, 15, 1),
(55, 19, 3),
(56, 19, 1),
(77, 2, 3),
(78, 2, 1),
(90, 6, 3),
(91, 6, 1),
(92, 7, 3),
(93, 7, 1),
(94, 9, 1),
(99, 18, 1),
(100, 21, 1),
(101, 1, 3),
(102, 1, 1),
(113, 17, 1),
(114, 17, 3),
(122, 22, 1),
(123, 22, 3),
(124, 23, 1),
(125, 23, 3),
(126, 24, 1),
(127, 24, 3),
(130, 3, 1),
(131, 3, 3),
(134, 16, 1),
(135, 16, 3),
(136, NULL, 1),
(137, NULL, 3),
(143, 25, 1),
(144, 25, 3),
(151, 26, 1),
(152, 26, 3),
(153, 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cms_moduls`
--

CREATE TABLE `cms_moduls` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_protected` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_moduls`
--

INSERT INTO `cms_moduls` (`id`, `name`, `icon`, `path`, `table_name`, `controller`, `is_protected`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Notifications', 'fa fa-cog', 'notifications', 'cms_notifications', 'NotificationsController', 1, 1, '2018-10-07 13:40:03', NULL, NULL),
(2, 'Privileges', 'fa fa-cog', 'privileges', 'cms_privileges', 'PrivilegesController', 1, 1, '2018-10-07 13:40:03', NULL, NULL),
(3, 'Privileges Roles', 'fa fa-cog', 'privileges_roles', 'cms_privileges_roles', 'PrivilegesRolesController', 1, 1, '2018-10-07 13:40:03', NULL, NULL),
(4, 'Users Management', 'fa fa-users', 'users', 'cms_users', 'AdminCmsUsersController', 0, 1, '2018-10-07 13:40:03', NULL, NULL),
(5, 'Settings', 'fa fa-cog', 'settings', 'cms_settings', 'SettingsController', 1, 1, '2018-10-07 13:40:03', NULL, NULL),
(6, 'Module Generator', 'fa fa-database', 'module_generator', 'cms_moduls', 'ModulsController', 1, 1, '2018-10-07 13:40:03', NULL, NULL),
(7, 'Menu Management', 'fa fa-bars', 'menu_management', 'cms_menus', 'MenusController', 1, 1, '2018-10-07 13:40:03', NULL, NULL),
(8, 'Email Templates', 'fa fa-envelope-o', 'email_templates', 'cms_email_templates', 'EmailTemplatesController', 1, 1, '2018-10-07 13:40:03', NULL, NULL),
(9, 'Statistic Builder', 'fa fa-dashboard', 'statistic_builder', 'cms_statistics', 'StatisticBuilderController', 1, 1, '2018-10-07 13:40:03', NULL, NULL),
(10, 'API Generator', 'fa fa-cloud-download', 'api_generator', '', 'ApiCustomController', 1, 1, '2018-10-07 13:40:03', NULL, NULL),
(11, 'Log User Access', 'fa fa-flag-o', 'logs', 'cms_logs', 'LogsController', 1, 1, '2018-10-07 13:40:03', NULL, NULL),
(12, 'Department', 'fa fa-dashboard', 'physicians_department', 'user_department', 'AdminPhysiciansDepartmentController', 0, 0, '2019-06-17 05:27:17', NULL, NULL),
(13, 'Physicians specialty', 'fa fa-dashboard', 'physicians_speciality', 'user_speciality', 'AdminPhysiciansSpecialityController', 0, 0, '2019-06-17 05:28:22', NULL, NULL),
(14, 'Users', 'fa fa-users', 'appusers', 'user', 'AdminPhysiciansController', 0, 0, '2019-06-17 05:29:43', NULL, NULL),
(15, 'Doctor', 'fa fa-glass', 'doctors', 'user', 'AdminDoctorsController', 0, 0, '2019-06-28 06:24:20', NULL, '2019-06-28 06:26:41'),
(16, 'Weekend Group', 'fa fa-glass', 'weekend_group', 'weekend_group', 'AdminWeekendGroupController', 0, 0, '2019-06-28 06:42:59', NULL, '2019-06-28 06:46:21'),
(17, 'Weekend group', 'fa fa-dashboard', 'weekend_group', 'weekend_group', 'AdminWeekendGroupController', 0, 0, '2019-06-28 06:46:44', NULL, NULL),
(18, 'Hours shifts', 'fa fa-dashboard', 'hours_shifts', 'hours_shifts', 'AdminHoursShiftsController', 0, 0, '2019-06-28 07:27:16', NULL, NULL),
(19, 'Physicians Schedule', 'fa fa-glass', 'physicians_scheduling', 'user_scheduling', 'AdminPhysiciansSchedulingController', 0, 0, '2019-07-01 12:10:08', NULL, '2019-07-02 01:54:49'),
(20, 'Physicians scheduling', 'fa fa-dashboard', 'user_scheduling', 'user_scheduling', 'AdminUserSchedulingController', 0, 0, '2019-07-02 01:56:47', NULL, NULL),
(21, 'Faq Categories', 'fa fa-glass', 'faq_categories', 'faq_categories', 'AdminFaqCategoriesController', 0, 0, '2019-07-06 05:13:13', NULL, '2019-07-06 05:16:06'),
(22, 'Faq Categories', 'fa fa-glass', 'faq_categories', 'faq_categories', 'AdminFaqCategoriesController', 0, 0, '2019-07-06 05:16:39', NULL, '2019-07-06 05:17:35'),
(23, 'Faq categories', 'fa fa-dashboard', 'faq_categories', 'faq_categories', 'AdminFaqCategoriesController', 0, 0, '2019-07-06 05:18:24', NULL, NULL),
(24, 'Faqs', 'fa fa-glass', 'faqs', 'faqs', 'AdminFaqsController', 0, 0, '2019-07-06 05:19:08', NULL, '2019-07-06 05:23:39'),
(25, 'Faqs', 'fa fa-heart', 'faqs25', 'faqs', 'AdminFaqs25Controller', 0, 0, '2019-07-06 05:23:49', NULL, NULL),
(26, 'Hospitals', 'fa fa-link', 'hospital', 'hospital', 'AdminHospitalController', 0, 0, '2019-08-19 15:44:58', NULL, NULL),
(27, 'Schedule report', 'fa fa-dashboard', 'reports', 'reports', 'AdminReportsController', 0, 0, '2019-09-20 20:55:56', NULL, NULL),
(28, 'Contents', 'fa fa-sticky-note', 'site_contents', 'site_contents', 'AdminSiteContentsController', 0, 0, '2019-09-22 16:44:49', NULL, NULL),
(29, 'Dashboard', 'fa fa-dashboard', 'dashboard', 'dashboard', 'AdminDashboardController', 0, 0, '2019-09-22 17:24:22', NULL, NULL),
(30, 'Manage schedule', 'fa fa-user-times', 'manage_schedule', 'user_scheduling', 'AdminManageScheduleController', 0, 0, '2020-06-16 00:48:07', NULL, NULL),
(31, 'Categories', 'fa fa-star', 'categories', 'categories', 'AdminCategoriesController', 0, 0, '2021-04-21 10:02:26', NULL, NULL),
(32, 'Courses', 'fa fa-play-circle', 'courses', 'courses', 'AdminCoursesController', 0, 0, '2021-04-22 08:52:18', NULL, NULL),
(33, 'Course Quizzes', 'fa fa-glass', 'course_quizzes', 'course_quizzes', 'AdminCourseQuizzesController', 0, 0, '2021-04-27 05:46:45', NULL, NULL),
(34, 'News', 'fa fa-glass', 'news', 'news', 'AdminNewsController', 0, 0, '2021-05-04 18:39:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_notifications`
--

CREATE TABLE `cms_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_cms_users` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_privileges`
--

CREATE TABLE `cms_privileges` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_superadmin` tinyint(1) DEFAULT NULL,
  `theme_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_privileges`
--

INSERT INTO `cms_privileges` (`id`, `name`, `is_superadmin`, `theme_color`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', 1, 'skin-green', '2018-10-07 13:40:03', NULL),
(3, 'Understanding My Facility', 0, 'skin-blue', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_privileges_roles`
--

CREATE TABLE `cms_privileges_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_visible` tinyint(1) DEFAULT NULL,
  `is_create` tinyint(1) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `is_edit` tinyint(1) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `id_cms_moduls` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_privileges_roles`
--

INSERT INTO `cms_privileges_roles` (`id`, `is_visible`, `is_create`, `is_read`, `is_edit`, `is_delete`, `id_cms_privileges`, `id_cms_moduls`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 12, NULL, NULL),
(2, 1, 1, 1, 1, 1, 1, 13, NULL, NULL),
(3, 1, 1, 1, 1, 1, 1, 14, NULL, NULL),
(4, 1, 1, 1, 1, 1, 1, 15, NULL, NULL),
(5, 1, 1, 1, 1, 1, 1, 16, NULL, NULL),
(6, 1, 1, 1, 1, 1, 1, 17, NULL, NULL),
(7, 1, 1, 1, 1, 1, 1, 18, NULL, NULL),
(8, 1, 1, 1, 1, 1, 1, 19, NULL, NULL),
(9, 1, 1, 1, 1, 1, 1, 20, NULL, NULL),
(10, 1, 1, 1, 1, 1, 1, 21, NULL, NULL),
(11, 1, 1, 1, 1, 1, 1, 22, NULL, NULL),
(12, 1, 1, 1, 1, 1, 1, 23, NULL, NULL),
(13, 1, 1, 1, 1, 1, 1, 24, NULL, NULL),
(14, 1, 1, 1, 1, 1, 1, 25, NULL, NULL),
(22, 1, 1, 1, 1, 1, 1, 26, NULL, NULL),
(23, 1, 1, 1, 1, 1, 1, 27, NULL, NULL),
(24, 1, 1, 1, 1, 1, 1, 28, NULL, NULL),
(25, 1, 1, 1, 1, 1, 1, 29, NULL, NULL),
(39, 1, 1, 1, 1, 1, 1, 30, NULL, NULL),
(51, 1, 1, 1, 1, 1, 1, 31, NULL, NULL),
(52, 1, 1, 1, 1, 1, 1, 32, NULL, NULL),
(53, 1, 1, 1, 1, 1, 1, 33, NULL, NULL),
(62, 1, 1, 1, 1, 1, 1, 34, NULL, NULL),
(63, 1, 1, 1, 1, 1, 3, 31, NULL, NULL),
(64, 1, 1, 1, 1, 1, 3, 28, NULL, NULL),
(65, 1, 1, 1, 1, 1, 3, 33, NULL, NULL),
(66, 1, 1, 1, 1, 1, 3, 32, NULL, NULL),
(67, 1, 1, 1, 1, 1, 3, 29, NULL, NULL),
(68, 1, 1, 1, 1, 1, 3, 25, NULL, NULL),
(69, 1, 1, 1, 1, 1, 3, 26, NULL, NULL),
(70, 1, 1, 1, 1, 1, 3, 34, NULL, NULL),
(71, 1, 1, 1, 1, 1, 3, 14, NULL, NULL),
(72, 0, 0, 0, 1, 0, 3, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_settings`
--

CREATE TABLE `cms_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `content_input_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dataenum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `helper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_setting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_settings`
--

INSERT INTO `cms_settings` (`id`, `name`, `content`, `content_input_type`, `dataenum`, `helper`, `created_at`, `updated_at`, `group_setting`, `label`) VALUES
(1, 'login_background_color', 'transparent', 'text', NULL, 'Input hexacode', '2018-10-07 13:40:04', NULL, 'Login Register Style', 'Login Background Color'),
(2, 'login_font_color', 'ffffff', 'text', NULL, 'Input hexacode', '2018-10-07 13:40:04', NULL, 'Login Register Style', 'Login Font Color'),
(3, 'login_background_image', 'uploads/2018-10/5745230637b8b806bfd96b5142fb43c7.jpg', 'upload_image', NULL, NULL, '2018-10-07 13:40:04', NULL, 'Login Register Style', 'Login Background Image'),
(4, 'email_sender', 'noreplyunderstandingmyfacility@gmail.com', 'text', NULL, NULL, '2018-10-07 13:40:04', NULL, 'Email Setting', 'Email Sender'),
(5, 'smtp_driver', 'smtp', 'select', 'smtp,mail,sendmail', NULL, '2018-10-07 13:40:04', NULL, 'Email Setting', 'Mail Driver'),
(6, 'smtp_host', 'smtp.gmail.com', 'text', NULL, NULL, '2018-10-07 13:40:04', NULL, 'Email Setting', 'SMTP Host'),
(7, 'smtp_port', '587', 'text', NULL, 'default 25', '2018-10-07 13:40:04', NULL, 'Email Setting', 'SMTP Port'),
(8, 'smtp_username', 'noreplyunderstandingmyfacility@gmail.com', 'text', NULL, NULL, '2018-10-07 13:40:04', NULL, 'Email Setting', 'SMTP Username'),
(9, 'smtp_password', 'pybvrmggffmgohnk', 'text', NULL, NULL, '2018-10-07 13:40:04', NULL, 'Email Setting', 'SMTP Password'),
(10, 'appname', 'Understanding My Facility', 'text', NULL, NULL, '2018-10-07 13:40:04', NULL, 'Application Setting', 'Application Name'),
(11, 'default_paper_size', 'A4', 'text', NULL, 'Paper size, ex : A4, Legal, etc', '2018-10-07 13:40:04', NULL, 'Application Setting', 'Default Paper Print Size'),
(12, 'logo', 'uploads/2023-03/910cacd1724acdca0ef86cd99a0d4e9f.png', 'upload_image', NULL, NULL, '2018-10-07 13:40:04', NULL, 'Application Setting', 'Logo'),
(13, 'favicon', 'uploads/2023-03/fd2130774b711be810a6bc5fd42832ba.png', 'upload_image', NULL, NULL, '2018-10-07 13:40:04', NULL, 'Application Setting', 'Favicon'),
(14, 'api_debug_mode', 'true', 'select', 'true,false', NULL, '2018-10-07 13:40:04', NULL, 'Application Setting', 'API Debug Mode'),
(15, 'google_api_key', NULL, 'text', NULL, NULL, '2018-10-07 13:40:04', NULL, 'Application Setting', 'Google API Key'),
(16, 'google_fcm_key', NULL, 'text', NULL, NULL, '2018-10-07 13:40:04', NULL, 'Application Setting', 'Google FCM Key');

-- --------------------------------------------------------

--
-- Table structure for table `cms_statistics`
--

CREATE TABLE `cms_statistics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_statistics`
--

INSERT INTO `cms_statistics` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Hospitals', 'hospitals', '2022-04-04 14:13:55', NULL),
(2, 'Admin', 'admin', '2022-04-04 14:43:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_statistic_components`
--

CREATE TABLE `cms_statistic_components` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_cms_statistics` int(11) DEFAULT NULL,
  `componentID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sorting` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `config` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_statistic_components`
--

INSERT INTO `cms_statistic_components` (`id`, `id_cms_statistics`, `componentID`, `component_name`, `area_name`, `sorting`, `name`, `config`, `created_at`, `updated_at`) VALUES
(1, 1, '2bef6280e42d4d9bd7664f170e74a2e6', 'panelcustom', NULL, 0, 'Untitled', NULL, '2019-03-13 02:57:43', NULL),
(2, 1, '1b02aff2a99573ed22c7c99a5fbeba69', 'panelcustom', NULL, 0, 'Untitled', NULL, '2019-03-13 02:57:50', NULL),
(3, 1, '3d57deca5f93841408c6dd5eda24e81c', 'panelarea', NULL, 1, 'Untitled', NULL, '2019-03-13 02:57:53', NULL),
(4, 1, '18cf1f928a33ff96ff2b98043f7bd904', 'panelarea', NULL, 0, 'Untitled', NULL, '2019-03-13 02:58:02', NULL),
(5, 1, 'f16698d3eeba9d9dd863ec60c8abd60d', 'panelarea', 'area1', 0, NULL, '{\"name\":\"Physicians\",\"content\":\"<a class=\\\"fa fa-heart text-normal\\\" href=\\\"admin\\/member\\\"><span  style=\\\"font-family: \'Source Sans Pro\',\'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size:15px;\\\"> Physicians<\\/span><\\/a>\"}', '2019-03-13 02:58:11', NULL),
(6, 1, '264348157e3d1da574f34adf63109738', 'panelarea', 'area2', 0, NULL, '{\"name\":\"Contacts\",\"content\":\"<a class=\\\"fa fa-users text-normal\\\" href=\\\"admin\\/contact_us\\\" ><span  style=\\\"font-size:15px;font-family: \'Source Sans Pro\',\'Helvetica Neue\',Helvetica,Arial,sans-serif;\\\"> Contacts<\\/span><\\/a>\"}', '2019-03-13 02:58:49', NULL),
(7, 1, '3fb7215ab7c61243e889dcde8edcbb61', 'panelarea', 'area3', 0, NULL, '{\"name\":\"User Leaves\",\"content\":\"<a class=\\\"fa fa-user text-normal\\\" href=\\\"admin\\/user_leaves\\\"> <span style=\\\"font-family: \'Source Sans Pro\',\'Helvetica Neue\',Helvetica,Arial,sans-serif;font-size:15px\\\"> User Leaves<\\/span><\\/a>\"}', '2019-03-13 02:59:34', NULL),
(8, 2, '44ae70a2c403934958f5d531567f8a09', 'smallbox', 'area1', 0, NULL, '{\"name\":\"Hospital\",\"icon\":\"hosiptal\",\"color\":\"bg-green\",\"link\":\"https:\\/\\/understandingmyfacility.com\\/admin\\/hospital\",\"sql\":\"SELECT COUNT(*) FROM `user` WHERE user_type=\\\"hospital\\\" AND deleted_at IS NULL;\"}', '2022-04-04 14:44:12', NULL),
(9, 2, 'cc44469c2dbb93ea326ebc00d756ba4c', 'smallbox', 'area2', 0, NULL, '{\"name\":\"Physician\",\"icon\":\"Physician\",\"color\":\"bg-yellow\",\"link\":\"https:\\/\\/understandingmyfacility.com\\/admin\\/appusers\",\"sql\":\"SELECT COUNT(*) FROM `user` WHERE user_type=\\\"physician\\\" AND deleted_at IS NULL;\"}', '2022-04-04 14:50:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_users`
--

CREATE TABLE `cms_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_users`
--

INSERT INTO `cms_users` (`id`, `name`, `photo`, `email`, `password`, `id_cms_privileges`, `created_at`, `updated_at`, `status`) VALUES
(15, 'Test Admin', 'uploads/15/2023-03/logo_1.png', 'admin@crudbooster.com', '$2y$10$DSt6aXzCoKwYgZhCc0tLwuMFSmDUhw571EiIqfl8LQn/x8ww4rX7S', 1, '2019-07-09 10:36:14', '2023-03-16 12:37:42', NULL),
(24, 'Super Admin', 'uploads/24/2023-03/anime_girl_wallpaper_2022_576x1024.jpg', 'admin@umf.com', '$2y$10$GDvNi771iU94wQL132Pm0OcQ2lFvgR7hl5SDiYocuNtVZ7yLqJOAa', 3, '2021-04-27 09:25:55', '2023-03-16 12:23:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(20) NOT NULL,
  `course_type` varchar(33) DEFAULT 'quiz',
  `category_id` int(20) DEFAULT NULL,
  `passing_percentage` int(20) DEFAULT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `spanish_course_title` varchar(255) DEFAULT NULL,
  `course_certificate_file` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_publish` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_type`, `category_id`, `passing_percentage`, `course_title`, `spanish_course_title`, `course_certificate_file`, `created_at`, `updated_at`, `is_publish`) VALUES
(1, 'quiz', 6, 90, 'Intro', 'Intro', NULL, '2022-05-23 11:12:56', '2022-11-14 15:20:30', 1),
(2, 'quiz', 6, 90, 'UNDERSTANDING MY FACILITY SYSTEM', 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', NULL, '2022-05-23 11:36:13', '2022-11-23 12:40:51', 1),
(3, 'quiz', 6, 90, 'THE ELECTRICAL DISTRIBUTION SYSTEM', 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', NULL, '2022-05-23 11:43:11', '2022-12-20 18:48:36', 1),
(4, 'quiz', 6, 90, 'THE TRANSPORTATION SYSTEM', 'EL SISTEMA DE TRANSPORTE', NULL, '2022-05-23 13:05:57', '2022-12-08 08:32:03', 1),
(5, 'quiz', 6, 90, 'THE HVAC SYSTEM', '', NULL, '2022-05-23 13:20:49', '2022-05-23 13:20:54', 1),
(7, 'quiz', 6, 90, 'THE PLUMBING SYSTEM', '', NULL, '2022-05-23 13:42:17', '2022-12-21 15:22:43', 1),
(8, 'quiz', 6, 90, 'THE MEDICAL GAS SYSTEM', '', NULL, '2022-05-23 13:55:34', '2022-05-23 13:55:38', 1),
(9, 'quiz', 6, 90, 'THE BOILER AND STEAM SYSTEM', '', NULL, '2022-05-23 14:08:09', '2022-05-23 14:14:53', 1),
(10, 'quiz', 6, 90, 'THE COMMUNICATION SYSTEM', '', NULL, '2022-05-23 14:16:21', '2022-05-23 14:50:39', 1),
(11, 'quiz', 6, 90, 'THE FIRE DETECTION SYSTEM', '', NULL, '2022-05-23 14:28:11', '2022-05-23 14:50:42', 1),
(12, 'quiz', 6, 90, 'THE FIRE SUPRESSSION SYSTEM', '', NULL, '2022-05-23 14:52:02', '2022-05-23 14:52:06', 1),
(13, 'video', 7, 100, 'FLUSHABLE', 'LAVABLE', NULL, '2022-05-23 15:12:12', '2022-11-10 09:00:14', 1),
(14, 'video', 8, 100, 'GENERAL SAFETY ORIENTATION', 'ORIENTACIÓN GENERAL DE SEGURIDAD', NULL, '2022-05-24 08:45:46', '2022-07-21 13:38:00', 1),
(15, 'video', 8, 100, 'BACK SAFETY', 'SEGURIDAD DE LA ESPALDA', NULL, '2022-05-24 09:08:10', '2022-10-27 11:43:43', 1),
(16, 'video', 8, 100, 'ERGONOMICS', 'ERGONOMIA', NULL, '2022-05-24 09:10:14', '2022-05-24 09:40:30', 1),
(17, 'video', 8, 100, 'HAZARDOUS MATERIALS SAFETY', 'SEGURIDAD SOBRE MATERIALES PELIGROSOS', NULL, '2022-05-24 11:37:43', '2022-05-24 11:46:52', 1),
(18, 'video', 8, 100, 'RADIATION SAFETY', 'SEGURIDAD RADIOLOGICA', NULL, '2022-05-24 11:54:32', '2022-05-24 13:11:11', 1),
(19, 'video', 8, 100, 'ELECTRICAL SAFETY AND FIRE SAFETY', 'SEGURIDAD ELECTRICA Y SEGURIDAD CONTRA INCENDIOS', NULL, '2022-05-24 12:44:16', '2022-05-24 13:11:20', 1),
(20, 'video', 8, 100, 'CONSTRUCTION SAFETY', 'SEGURIDAD EN LA CONSTRUCCION', NULL, '2022-05-24 12:51:46', '2022-05-24 13:11:26', 1),
(21, 'video', 8, 100, 'BIOTERRORISM', 'BIOTERRORISMO', NULL, '2022-05-24 13:10:44', '2022-05-24 13:11:34', 1),
(22, 'video', 8, 100, 'EMERGENCY PREPAREDNESS', 'PREPARACION PARA EMERGENCIAS', NULL, '2022-05-24 13:15:20', '2022-05-24 13:16:12', 1),
(23, 'video', 8, 100, 'HOSPITAL INCIDENT COMMAND CENTER SYSTEM', 'SISTEMA DE MANDO DE INCIDENTES HOSPITALARIOS', NULL, '2022-05-24 13:24:02', '2022-05-24 13:24:15', 1),
(25, 'video', 8, 100, 'GENERAL SAFETY ORIENTATION FOR ALL HEALTHCARE ASSOCIATES', 'ORIENTACION GENERAL DE SEGURIDAD PARA TODOS LOS ASOCIADOS DE SALUD', NULL, '2022-06-10 10:10:08', '2022-06-10 11:24:08', 1),
(26, 'video', 9, 100, '4- PREPARATION FOR YOUR FACILITY ACCREDITATION SURVEY', '4- PREPARACION PARA LA ACREDITACION DE SUS INSTALACIONES Y PROCESOS', NULL, '2022-06-10 11:24:02', '2022-10-27 11:43:47', 1),
(27, 'video', 7, 100, 'FLUSHABLE', 'COMO NOS PUEDE AYUDAR', NULL, '2022-05-23 15:11:12', '2022-11-14 15:21:10', 1),
(28, 'video', 10, 100, 'pruebas cursos', 'pruebas curso en ingles', NULL, '2022-12-21 05:12:03', '2022-12-21 05:19:06', 1),
(29, 'quiz', 11, 100, 'pruebas cursos', 'pruebas curso en español', NULL, '2022-12-21 14:21:09', '2022-12-21 14:21:14', 1),
(30, 'video', 12, 80, 'pruebas cursos en ingles', 'pruebas curso en español', NULL, '2022-12-21 14:46:41', '2022-12-21 14:47:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_certificates`
--

CREATE TABLE `course_certificates` (
  `id` int(20) NOT NULL,
  `course_id` int(20) DEFAULT NULL,
  `language_id` int(20) DEFAULT '1',
  `course_certificate_title` varchar(225) DEFAULT NULL,
  `course_certificate_file` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_certificates`
--

INSERT INTO `course_certificates` (`id`, `course_id`, `language_id`, `course_certificate_title`, `course_certificate_file`, `created_at`, `updated_at`) VALUES
(113, 1, 2, 'Completed Successfully', NULL, '2022-06-30 07:37:50', '2022-06-30 07:37:50'),
(157, 14, 1, 'Completed Successfully', NULL, '2022-07-21 13:33:33', '2022-07-21 13:33:33'),
(181, 1, 1, 'Completed Successfully', NULL, '2022-11-23 12:43:29', '2022-11-23 12:43:29'),
(190, 27, 1, 'Completed Successfully', NULL, '2022-12-20 19:09:44', '2022-12-20 19:09:44'),
(191, 15, 1, 'Completed Successfully', NULL, '2022-12-20 19:39:38', '2022-12-20 19:39:38'),
(192, 16, 1, 'Completed Successfully', NULL, '2022-12-20 19:39:46', '2022-12-20 19:39:46'),
(193, 17, 1, 'Completed Successfully', NULL, '2022-12-20 19:39:57', '2022-12-20 19:39:57'),
(194, 18, 1, 'Completed Successfully', NULL, '2022-12-20 19:40:04', '2022-12-20 19:40:04'),
(195, 19, 1, 'Completed Successfully', NULL, '2022-12-20 19:41:06', '2022-12-20 19:41:06'),
(196, 20, 1, 'Completed Successfully', NULL, '2022-12-20 19:41:12', '2022-12-20 19:41:12'),
(197, 21, 1, 'Completed Successfully', NULL, '2022-12-20 19:41:20', '2022-12-20 19:41:20'),
(198, 22, 1, 'Completed Successfully', NULL, '2022-12-20 19:41:26', '2022-12-20 19:41:26'),
(199, 23, 1, 'Completed Successfully', NULL, '2022-12-20 19:41:31', '2022-12-20 19:41:31'),
(201, 25, 1, 'complete successfully', NULL, '2022-12-20 19:48:50', '2022-12-20 19:48:50'),
(202, 2, 2, 'Completed Successfully', NULL, '2022-12-20 19:55:10', '2022-12-20 19:55:10'),
(203, 12, 2, 'Completed Successfully', NULL, '2022-12-20 19:56:40', '2022-12-20 19:56:40'),
(204, 11, 2, 'Completed Successfully', NULL, '2022-12-20 19:56:46', '2022-12-20 19:56:46'),
(205, 10, 2, 'Completed Successfully', NULL, '2022-12-20 19:56:51', '2022-12-20 19:56:51'),
(206, 9, 2, 'Completed Successfully', NULL, '2022-12-20 19:56:57', '2022-12-20 19:56:57'),
(207, 8, 2, 'Completed Successfully', NULL, '2022-12-20 19:57:02', '2022-12-20 19:57:02'),
(209, 5, 2, 'Completed Successfully', NULL, '2022-12-20 19:57:14', '2022-12-20 19:57:14'),
(210, 4, 2, 'certificate completed', NULL, '2022-12-20 19:57:19', '2022-12-20 19:57:19'),
(211, 3, 2, 'Completed Successfully', NULL, '2022-12-20 19:57:24', '2022-12-20 19:57:24'),
(214, 13, 2, 'Completed Successfully', NULL, '2022-12-20 20:08:35', '2022-12-20 20:08:35'),
(215, 27, 2, 'Completed Successfully', NULL, '2022-12-20 20:08:44', '2022-12-20 20:08:44'),
(220, 21, 2, 'Completed Successfully', NULL, '2022-12-20 20:17:56', '2022-12-20 20:17:56'),
(221, 20, 2, 'Completed Successfully', NULL, '2022-12-20 20:18:02', '2022-12-20 20:18:02'),
(222, 19, 2, 'Completed Successfully', NULL, '2022-12-20 20:18:07', '2022-12-20 20:18:07'),
(223, 18, 2, 'Completed Successfully', NULL, '2022-12-20 20:18:12', '2022-12-20 20:18:12'),
(224, 17, 2, 'Completed Successfully', NULL, '2022-12-20 20:18:18', '2022-12-20 20:18:18'),
(225, 16, 2, 'Completed Successfully', NULL, '2022-12-20 20:18:23', '2022-12-20 20:18:23'),
(226, 15, 2, 'Completed Successfully', NULL, '2022-12-20 20:18:29', '2022-12-20 20:18:29'),
(227, 25, 2, 'complete successfully', NULL, '2022-12-20 20:19:19', '2022-12-20 20:19:19'),
(229, 13, 1, 'Completed Successfully', NULL, '2022-12-21 13:32:47', '2022-12-21 13:32:47'),
(230, 29, 1, 'Pruebas certificacion', '57966a03691c6d67ca8d74.jpg', '2022-12-21 14:40:45', '2022-12-21 14:40:45'),
(233, 7, 2, 'Completed Successfully', NULL, '2022-12-21 15:59:27', '2022-12-21 15:59:27'),
(234, 22, 2, 'Completed Successfully', NULL, '2022-12-21 16:05:00', '2022-12-21 16:05:00'),
(235, 23, 2, 'Completed Successfully', NULL, '2022-12-21 16:08:50', '2022-12-21 16:08:50'),
(236, 12, 1, 'Completed Successfully', NULL, '2022-12-21 16:12:51', '2022-12-21 16:12:51'),
(237, 11, 1, 'Completed Successfully', NULL, '2022-12-21 16:12:57', '2022-12-21 16:12:57'),
(238, 10, 1, 'Completed Successfully', NULL, '2022-12-21 16:13:02', '2022-12-21 16:13:02'),
(239, 9, 1, 'Completed Successfully', NULL, '2022-12-21 16:13:11', '2022-12-21 16:13:11'),
(240, 8, 1, 'Completed Successfully', NULL, '2022-12-21 16:13:14', '2022-12-21 16:13:14'),
(241, 7, 1, 'Completed Successfully', NULL, '2022-12-21 16:13:17', '2022-12-21 16:13:17'),
(242, 5, 1, 'Completed Successfully', NULL, '2022-12-21 16:13:19', '2022-12-21 16:13:19'),
(243, 4, 1, 'Completed Successfully', NULL, '2022-12-21 16:13:22', '2022-12-21 16:13:22'),
(244, 3, 1, 'Completed Successfully', NULL, '2022-12-21 16:13:28', '2022-12-21 16:13:28'),
(245, 2, 1, 'Completed Successfully', NULL, '2022-12-21 16:13:31', '2022-12-21 16:13:31'),
(246, 14, 2, 'Completed Successfully', NULL, '2022-12-21 16:15:26', '2022-12-21 16:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `course_quizzes`
--

CREATE TABLE `course_quizzes` (
  `id` int(20) NOT NULL,
  `course_id` int(20) DEFAULT NULL,
  `course_quiz_title` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_quizzes`
--

INSERT INTO `course_quizzes` (`id`, `course_id`, `course_quiz_title`, `created_at`, `updated_at`) VALUES
(2, 2, 'UNDERSTANDING MY FACILITY', '2022-05-23 11:40:44', '2022-11-21 12:36:41'),
(3, 3, 'UNDESTANDING MY FACILITY', '2022-05-23 11:46:08', '2022-12-20 18:40:09'),
(4, 4, 'UNDESTANDING MY FACILITY', '2022-05-23 13:06:16', '2022-11-10 09:08:40'),
(5, 5, 'UNDESTANDING MY FACILITY', '2022-05-23 13:21:37', '2022-11-10 09:08:29'),
(6, 7, 'UNDESTANDING MY FACILITY', '2022-05-23 13:45:28', '2022-11-10 09:08:22'),
(7, 8, 'UNDESTANDING MY FACILITY', '2022-05-23 14:00:30', '2022-11-10 09:08:13'),
(8, 9, 'UNDESTANDING MY FACILITY', '2022-05-23 14:09:57', '2022-11-10 09:08:03'),
(9, 10, 'UNDESTANDING MY FACILITY', '2022-05-23 14:19:44', '2022-11-10 09:07:52'),
(10, 11, 'UNDESTANDING MY FACILITY', '2022-05-23 14:34:49', '2022-11-10 09:07:42'),
(11, 12, 'UNDESTANDING MY FACILITY', '2022-05-23 14:54:58', '2022-11-10 09:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(20) NOT NULL,
  `faq_categories_id` int(20) DEFAULT NULL,
  `question` varchar(5000) DEFAULT NULL,
  `answer` varchar(5000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faq_categories_id`, `question`, `answer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'a', 'a', '2019-07-02 09:24:22', NULL, '2019-07-05 14:52:12'),
(2, 2, 'a', 'aa', '2019-07-02 09:24:30', NULL, '2019-07-05 14:52:12'),
(3, 1, 'Hello', 'Hello', '2020-11-20 12:38:11', '2020-11-20 12:38:29', '2020-11-20 12:38:38'),
(4, NULL, 'What is UMF App?', 'Our experts created UMF a unique and simple tool to enhance the knowledge of all healthcare associates. With the use of our unique and innovated APP you can educate and engage all your associates.', '2021-11-08 12:08:01', NULL, NULL),
(5, NULL, 'What is the benefit of having UMF training?', 'You can achieve significant savings on your facility operating budget and improve the communication, safety and satisfaction of your patients, employees and everyone else who enters your facilities.', '2021-11-08 12:08:59', NULL, NULL),
(6, NULL, 'Why is it necessary for the medical professionals to keep updating their knowledge?', 'Due to the rapid and constant changes in healthcare, administrators are facing significant challenges in focusing their financial resources. Innovation, staff training and education are essential to increase knowledge, safety, maximize quality and improve', '2021-11-08 12:09:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `name` varchar(33) DEFAULT NULL,
  `hospital_contact_number` varchar(225) DEFAULT NULL,
  `hospital_address` varchar(1000) DEFAULT NULL,
  `hospital_image` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `employees_registration` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `user_id`, `name`, `hospital_contact_number`, `hospital_address`, `hospital_image`, `created_at`, `updated_at`, `deleted_at`, `employees_registration`) VALUES
(1, 1, 'ABC', NULL, NULL, NULL, '2023-03-23 13:54:58', '2023-03-23 13:54:58', NULL, 5),
(2, 3, 'CommonSpirit Health', NULL, NULL, '65d21a7a6d0b2a830a6984823f17d4ce.png', '2023-04-10 21:55:24', '2023-04-10 21:55:24', NULL, 10),
(3, 5, 'Brian D. Allgood Army Community H', NULL, NULL, 'b2a70d95c2a4b165c0cd63cd7f952ef8.png', '2023-04-14 23:37:29', '2023-04-14 23:37:29', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `hospital_courses`
--

CREATE TABLE `hospital_courses` (
  `id` int(20) NOT NULL,
  `hospital_id` int(20) DEFAULT NULL,
  `course_id` int(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_email`
--

CREATE TABLE `hospital_email` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) DEFAULT '0',
  `email` varchar(33) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital_email`
--

INSERT INTO `hospital_email` (`id`, `hospital_id`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'test12@yopmail.com', '2023-04-18 05:56:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(20) NOT NULL,
  `language_name` varchar(225) DEFAULT NULL,
  `flag` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `flag`) VALUES
(1, 'English', 'english@3x.png'),
(2, 'Spanish', 'spanish@3x.png');

-- --------------------------------------------------------

--
-- Table structure for table `language_to_courses`
--

CREATE TABLE `language_to_courses` (
  `id` int(20) NOT NULL,
  `course_type` varchar(33) DEFAULT 'quiz',
  `course_id` int(20) DEFAULT NULL,
  `language_id` int(20) DEFAULT NULL,
  `course_name` varchar(1000) DEFAULT NULL,
  `video_file` varchar(225) DEFAULT NULL,
  `video_file_thumb` varchar(225) DEFAULT NULL,
  `video_heading` varchar(1000) DEFAULT NULL,
  `video_description` text,
  `is_intro` tinyint(3) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language_to_courses`
--

INSERT INTO `language_to_courses` (`id`, `course_type`, `course_id`, `language_id`, `course_name`, `video_file`, `video_file_thumb`, `video_heading`, `video_description`, `is_intro`, `created_at`, `updated_at`) VALUES
(4, 'quiz', 3, 1, 'UNDERSTANDING MY FACILITY', 'ef0b0707a1d351d568d118e5906aef50.mp4', 'ef0b0707a1d351d568d118e5906aef50.jpg', 'THE ELECTRICAL DISTRIBUTION SYSTEM', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size: 14px;\"><b>In this video, we help all healthcare associates understand the critical electrical system.</b></span><br></p>', 0, '2022-05-23 11:45:50', '2022-12-21 16:13:28'),
(6, 'quiz', 4, 1, 'UNDERSTANDING MY FACILITY', 'debcc611e29e331013c9dd7015e37ee4.mp4', 'debcc611e29e331013c9dd7015e37ee4.jpg', 'THE TRANSPORTATION SYSTEM', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:11.0pt;line-height:107%;\r\nfont-family:\" calibri\",sans-serif;mso-fareast-font-family:\"times=\"\" new=\"\" roman\";=\"\" mso-ansi-language:en-us;mso-fareast-language:en-us;mso-bidi-language:ar-sa\"=\"\"><b>In\r\nthis video, we’ll go over the two\r\ntypes of transportation system in your healthcare facility</b></span><br></p>', 0, '2022-05-23 13:10:29', '2022-12-21 16:13:22'),
(7, 'quiz', 5, 1, 'UNDERSTANDING MY FACILITY', '5618f8e8329a73b1f7120a99d54de171.mp4', '5618f8e8329a73b1f7120a99d54de171.jpg', 'THE HVAC SYSTEM', '<p class=\"MsoListParagraph\"><b>In this video we’ll cover the critical HVAC\r\nsystem in a healthcare facility</b><o:p></o:p></p>', 0, '2022-05-23 13:25:53', '2022-12-21 16:13:19'),
(8, 'quiz', 7, 1, 'UNDERSTANDING MY FACILITY', '81d49a8f12532cdf269ac1e711da29a8.mp4', '81d49a8f12532cdf269ac1e711da29a8.jpg', 'THE PLUMBING SYSTEM', '<p class=\"MsoListParagraph\" style=\"margin-bottom: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-hansi-font-family:calibri;mso-bidi-font-family:calibri;=\"\" color:#666666\"=\"\"><b>In this video, we’ll cover the domestic cold water system,\r\ndomestic hot water system, the sanitary system and the storm system of your\r\nhealthcare facility.</b><o:p></o:p></span></p>', 0, '2022-05-23 13:44:38', '2022-12-21 16:13:17'),
(9, 'quiz', 8, 1, 'UNDERSTANDING MY FACILITY', '6ed6f02b4d364162901fa9c002ca5ff8.mp4', '6ed6f02b4d364162901fa9c002ca5ff8.jpg', 'THE MEDICAL GAS SYSTEM', '<p class=\"MsoListParagraph\"><span style=\"font-size: 14px;\"><b>In this video, we’ll go over another important function pf your healthcare facility: the transport of lifesaving medical gases.</b></span><br></p>', 0, '2022-05-23 13:57:22', '2022-12-21 16:13:14'),
(10, 'quiz', 9, 1, 'UNDESTANDING YOUR FACILITY', '2eb991d80d537ee48e970e628e61f537.mp4', '2eb991d80d537ee48e970e628e61f537.jpg', 'THE BOILER AND STEAM SYSTEM', '<p class=\"MsoListParagraph\" style=\"margin-bottom: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-hansi-font-family:calibri;mso-bidi-font-family:calibri;=\"\" color:#666666\"=\"\"><span style=\"font-size: 14px;\"><b>In this video, we’ll cover a very important aspect of your\r\nplumbing system: the boiler and the steam system in your healthcare facility</b></span><o:p></o:p></span></p>', 0, '2022-05-23 14:09:33', '2022-12-21 16:13:11'),
(11, 'quiz', 10, 1, 'UNDERSTANDING MY FACILITY', '4cfee12d906bf99a42ac8fcf5dc39e9f.mp4', '4cfee12d906bf99a42ac8fcf5dc39e9f.jpg', 'THE COMMUNICATION SYSTEM', '<p class=\"MsoListParagraph\" style=\"margin-bottom: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:9.0pt;font-family:\" cambria\",serif;mso-fareast-font-family:=\"\" \"times=\"\" new=\"\" roman\";mso-bidi-font-family:\"times=\"\" roman\";color:#666666\"=\"\"><span style=\"font-size: 14px;\"><b>In this\r\nvideo, we’ll cover the different methods of communication systems used in a\r\nhealthcare facility in order to provide quality healthcare.</b></span><o:p></o:p></span></p>', 0, '2022-05-23 14:18:10', '2022-12-21 16:13:02'),
(12, 'quiz', 11, 1, 'UNDERSTANDING MY FACILITY', '84922efc0e07b04c91ab100021a9326c.mp4', '84922efc0e07b04c91ab100021a9326c.jpg', 'THE FIRE DETECTION SYSTEM', '<p class=\"MsoListParagraph\" style=\"margin-bottom: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-hansi-font-family:calibri;mso-bidi-font-family:calibri;=\"\" color:#666666\"=\"\"><span style=\"font-size: 14px;\"><b>In this video, we’ll discuss one of the most important\r\nresponsibilities all healthcare associates have: understanding the fire\r\ndetection system and working together to make sure we’re ready in case of fire.</b></span><o:p></o:p></span></p>', 0, '2022-05-23 14:32:06', '2022-12-21 16:12:57'),
(13, 'quiz', 12, 1, 'UNDERSTANDING MY FACILITY', '0d2a98755d1719dbe908998bbf8afc02.mp4', '0d2a98755d1719dbe908998bbf8afc02.jpg', 'THE FIRE SUPRESSSION SYSTEM', '<span style=\"font-size: 14px; line-height: 107%;\" cambria\",serif;mso-fareast-font-family:\"times=\"\" new=\"\" roman\";=\"\" mso-bidi-font-family:\"times=\"\" roman\";color:#666666;mso-ansi-language:en-us;=\"\" mso-fareast-language:en-us;mso-bidi-language:ar-sa\"=\"\"><b>In this video, we’ll\r\ndescribe the six main components of the fire suppression system.</b></span>', 0, '2022-05-23 14:54:03', '2022-12-21 16:12:51'),
(14, 'video', 13, 1, 'HOW CAN I HELP?', 'b7ff57cd1357e855a63aabbb21e5472a.mp4', 'b7ff57cd1357e855a63aabbb21e5472a.jpg', 'To Flush or Not to Flush?', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size: 12pt;\">Now that you have a better understanding of the critical facility\r\nsystems that are needed to provide a safe and comfortable environment of care\r\nfor our patients, visitors and associates. Let us show you how you can help us\r\npreserve the safety and the quality of our Hospital avoiding unnecessary safety\r\nand utility issues and disruptions.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\">\r\n\r\n</p><p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:12.0pt;font-family:\" segoe=\"\" ui=\"\" black\",sans-serif;mso-fareast-font-family:=\"\" \"times=\"\" new=\"\" roman\";mso-bidi-font-family:calibri;color:#666666;border:none=\"\" windowtext=\"\" 1.0pt;=\"\" mso-border-alt:none=\"\" 0in;padding:0in\"=\"\"> As you all know:<b> </b></span><span style=\"color: rgb(112, 173, 71); font-family: \" segoe=\"\" ui=\"\" black\",=\"\" sans-serif;=\"\" font-size:=\"\" 12pt;\"=\"\"><b>knowledge is power.</b></span></p>', 0, '2022-05-23 15:19:40', '2022-12-21 13:32:47'),
(15, 'video', 13, 2, 'COMO NOS PUEDES AYUDAR?', 'c4ef7f63cfb23b636708dca19d2a1252.mp4', 'c4ef7f63cfb23b636708dca19d2a1252.jpg', 'Vaciar o no Vaciar?', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size: 12pt;\">Ahora que tiene una mejor comprension de los sistemas criticos de\r\nlas instalaciones que se necesitan para proporcionar un entorno de atencion\r\nseguro y comodo para nuestros pacientes, visitantes y asociados.  Permitanos mostrarle como puede ayudarnos a preservar\r\nla seguridad y la calidad de nuestro Hospital evitando problemas e\r\ninterrupciones innecesarias de seguridad y servicios publicos.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:12.0pt;font-family:\" segoe=\"\" ui=\"\" black\",sans-serif;mso-fareast-font-family:=\"\" \"times=\"\" new=\"\" roman\";mso-bidi-font-family:calibri;color:#666666;border:none=\"\" windowtext=\"\" 1.0pt;=\"\" mso-border-alt:none=\"\" 0in;padding:0in\"=\"\">Como todos sabemos:</span><span style=\"color: rgb(112, 173, 71); font-family: \" segoe=\"\" ui=\"\" black\",=\"\" sans-serif;=\"\" font-size:=\"\" 12pt;\"=\"\"><b>El conocimiento es poder.</b></span></p>', 0, '2022-05-24 08:29:44', '2022-12-20 20:08:35'),
(16, 'video', 14, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', '2dc69995adf54399b2aa485ce00af041.mp4', '2dc69995adf54399b2aa485ce00af041.jpg', 'DERRAMES & INFORME DE LESIONES', '<p class=\"MsoNormal\"><b>En nuestro hospital,\r\nlos derrames pueden ocurrir en cualquier momento debido a equipos rotos,\r\ndefectuosos o por errors humanos.<o:p></o:p></b></p>', 0, '2022-05-24 09:01:09', '2022-12-21 16:15:26'),
(17, 'video', 14, 1, 'GENERAL SAFETY ORIENTATION', '965d3656ea0aa7f43a60f4a439ea103b.mp4', '965d3656ea0aa7f43a60f4a439ea103b.jpg', 'SPILLS AND REPORTING INJURIES', '<p class=\"MsoNormal\"><b><span style=\"font-family: Arial, sans-serif; color: rgb(32, 33, 36); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">In hospital spills can occur at any time due to broken or\r\nfaulty equipment or human error</span></b><span style=\"font-family: Arial, sans-serif; color: rgb(32, 33, 36); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">.<o:p></o:p></span></p>', 0, '2022-05-24 09:21:22', '2022-07-21 13:33:33'),
(18, 'video', 15, 1, 'GENERAL SAFETY ORIENTATION', '75faf0daa87bc6a5bb5ee411f70fb4ee.mp4', '75faf0daa87bc6a5bb5ee411f70fb4ee.jpg', 'BACK SAFETY', '<p class=\"MsoNormal\"><b><span style=\"font-family: Arial, sans-serif; color: rgb(32, 33, 36); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Because your spine is a delicate structure, you will\r\nexperience pain whenever you strain, sprain, or in some way injure your back.<o:p></o:p></span></b></p>', 0, '2022-05-24 12:20:06', '2022-12-20 19:39:38'),
(19, 'video', 15, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', 'e38534e0995f55d098f47f4adb5507f7.mp4', 'e38534e0995f55d098f47f4adb5507f7.jpg', 'SEGURIDAD DE LA ESPALDA', '<font face=\"Calibri, sans-serif\"><span style=\"font-size: 14.6667px;\"><b>Debido a que su columna vertebral es una estructura delicada, experimentará dolor cada vez que se esfuerce, se tuerza o se lesione la espalda de alguna manera.</b></span></font><br>', 0, '2022-05-24 12:23:11', '2022-12-20 20:18:29'),
(20, 'video', 16, 1, 'GENERAL SAFETY ORIENTATION', '630a8282f0d8aacc4e0c7946b7bbf11a.mp4', '630a8282f0d8aacc4e0c7946b7bbf11a.jpg', 'ERGONOMICS', '<p><b><span style=\"font-size: 11pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(32, 33, 36); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Ergonomics can roughly be defined as the study of people in their working environment</span></b><br></p>', 0, '2022-05-24 12:26:11', '2022-12-20 19:39:46'),
(21, 'video', 16, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', '42a7872280664289c724a1094172789e.mp4', '42a7872280664289c724a1094172789e.jpg', 'ERGONOMIA', 'La ergonomía se puede definir aproximadamente como el estudio de las personas en su entorno de trabajo.', 0, '2022-05-24 12:28:54', '2022-12-20 20:18:23'),
(22, 'video', 17, 1, 'GENERAL SAFETY ORIENTATION', '86da216a31b684c6928b74867fabd7f9.mp4', '86da216a31b684c6928b74867fabd7f9.jpg', 'HAZARDOUS MATERIALS SAFETY', '<font color=\"#5f6368\" face=\"Arial, sans-serif\"><b>Hazardous materials are defined as substances that have the potential to harm a person or the environment upon contact</b></font><br>', 0, '2022-05-24 12:31:46', '2022-12-20 19:39:57'),
(23, 'video', 17, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', '62050271f52a8d66a07619a9ba0ac63b.mp4', '62050271f52a8d66a07619a9ba0ac63b.jpg', 'SEGURIDAD SOBRE MATERIALES PELIGROSOS', '<font face=\"Calibri, sans-serif\"><span style=\"font-size: 14.6667px;\"><b>Los materiales peligrosos se definen como sustancias que tienen el potencial de dañar a una persona o al medio ambiente al entrar en contacto</b></span></font><br>', 0, '2022-05-24 12:34:10', '2022-12-20 20:18:18'),
(24, 'video', 18, 1, 'GENERAL SAFETY ORIENTATION', 'f81cda47754d7026e6f62e55934bef49.mp4', 'f81cda47754d7026e6f62e55934bef49.jpg', 'RADIATION SAFETY', '<p class=\"MsoNormal\"><font color=\"#4d5156\" face=\"Arial, sans-serif\"><b>Hospitals are required to provide protective devices, such as lead aprons and shields, and show they are worn as required.</b></font><br></p>', 0, '2022-05-24 12:37:16', '2022-12-20 19:40:04'),
(25, 'video', 18, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', '2095002e784da24ee4384c6801f788a1.mp4', '2095002e784da24ee4384c6801f788a1.jpg', 'SEGURIDAD RADIOLOGICA', 'Los hospitales deben proporcionar dispositivos de protección, como delantales y escudos de plomo, y mostrar que se usan según sea necesario.', 0, '2022-05-24 12:39:01', '2022-12-20 20:18:12'),
(26, 'video', 19, 1, 'GENERAL SAFETY ORIENTATION', '37de0a64e663c6deac3d4fa5907b9a8a.mp4', '37de0a64e663c6deac3d4fa5907b9a8a.jpg', 'ELECTRICAL SAFETY AND FIRE SAFETY', '<p class=\"MsoNormal\"><b><span style=\"font-size: 10.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(77, 81, 86); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Here are important guidelines on Electrical and\r\nFire Safety in our Healthcare Facility.<o:p></o:p></span></b></p>', 0, '2022-05-24 12:46:41', '2022-12-20 19:41:06'),
(27, 'video', 19, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', '64104ff26bb0adb62540b7a7a38bd1be.mp4', '64104ff26bb0adb62540b7a7a38bd1be.jpg', 'SEGURIDAD ELECTRICA Y SEGURIDAD CONTRA INCENDIOS', '<font face=\"Calibri, sans-serif\"><span style=\"font-size: 14.6667px;\"><b>Estas son pautas importantes sobre seguridad eléctrica y contra incendios en nuestro centro de atención médica.</b></span></font><br>', 0, '2022-05-24 12:50:17', '2022-12-20 20:18:07'),
(28, 'video', 20, 1, 'GENERAL SAFETY ORIENTATION', 'e2d2a85cdb27c26423421ea7b4026347.mp4', 'e2d2a85cdb27c26423421ea7b4026347.jpg', 'CONSTRUCTION SAFETY', '<p class=\"MsoNormal\"><b><span style=\"font-size: 10.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(77, 81, 86); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Construction and Renovation Safety is very\r\nimportant in our Healthcare Facility.<o:p></o:p></span></b></p>', 0, '2022-05-24 12:54:05', '2022-12-20 19:41:12'),
(29, 'video', 20, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', '061494955318714b6767a7cda891e96f.mp4', '061494955318714b6767a7cda891e96f.jpg', 'SEGURIDAD EN LA CONSTRUCCION', '<font face=\"Calibri, sans-serif\"><span style=\"font-size: 14.6667px;\"><b>La seguridad en la construcción y la renovación es muy importante en nuestro centro de salud.</b></span></font><br>', 0, '2022-05-24 12:58:04', '2022-12-20 20:18:02'),
(30, 'video', 21, 1, 'GENERAL SAFETY ORIENTATION', '422b8cbf2c77ceee49eabc3ba352b7e5.mp4', '422b8cbf2c77ceee49eabc3ba352b7e5.jpg', 'BIOTERRORISM', '<p class=\"MsoNormal\"><font color=\"#5f6368\" face=\"Arial, sans-serif\"><b>Hospital and clinical laboratories play crucial roles in responding to bioterrorism agent infections and emergent exposures diseases.</b></font><br></p>', 0, '2022-05-24 13:13:03', '2022-12-20 19:41:20'),
(31, 'video', 21, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', '4bb634990121531dbf719f13198286ba.mp4', '4bb634990121531dbf719f13198286ba.jpg', 'BIOTERRORISMO', '<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;line-height:107%\">Los\r\nHospitales y Laboratorios clinicos desempenan un papel crucial en la respuesta\r\na las infecciones por agentes de bioterrorismo y las enfermedades por\r\nexposicion emergentes.<o:p></o:p></span></p>', 0, '2022-05-24 13:14:22', '2022-12-20 20:17:56'),
(32, 'video', 22, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', 'f24bc38b99772587aaeae26fa82731ea.mp4', 'f24bc38b99772587aaeae26fa82731ea.jpg', 'PREPARACION PARA EMERGENCIAS', '<span style=\"line-height: 107%;\" calibri\",sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:=\"\" calibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;=\"\" mso-bidi-font-family:\"times=\"\" new=\"\" roman\";mso-bidi-theme-font:minor-bidi;=\"\" color:red;mso-ansi-language:en-us;mso-fareast-language:en-us;mso-bidi-language:=\"\" ar-sa\"=\"\"><font face=\"Calibri, sans-serif\"><span style=\"font-size: 14.6667px;\"><b>En este video presentamos los mejores consejos para el manejo de emergencias en el cuidado de la salud. </b></span></font><span style=\"font-size: 11pt;\"><b>  </b></span></span>', 0, '2022-05-24 13:18:46', '2022-12-21 16:05:00'),
(33, 'video', 23, 1, 'GENERAL SAFETY ORIENTATION', '1a7b4e38864cfcadc168c3fd54ba033e.mp4', '1a7b4e38864cfcadc168c3fd54ba033e.jpg', 'HOSPITAL INCIDENT COMMAND CENTER SYSTEM', '<b><span style=\"font-size: 10.5pt; line-height: 107%; font-family: Arial, sans-serif; color: rgb(77, 81, 86); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Standardized approach to disaster response use in all Hospitals in the United\r\nStates</span></b><br>', 0, '2022-05-24 13:26:31', '2022-12-20 19:41:31'),
(34, 'video', 23, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', '32960575132becd44122e3b21f621626.mp4', '32960575132becd44122e3b21f621626.jpg', 'SISTEMA DE MANDO DE INCIDENTES HOSPITALARIOS', '<span style=\"line-height: 107%;\"><font face=\"Calibri, sans-serif\"><span style=\"font-size: 14.6667px;\"><b>Enfoque estandarizado para el uso de respuesta a desastres en todos los hospitales de los Estados Unidos</b></span><span style=\"font-size: 11pt;\"><b> </b></span></font></span><span style=\"font-weight: bold; font-size: 11pt; line-height: 107%;\" calibri\",sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:=\"\" calibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;=\"\" mso-bidi-font-family:\"times=\"\" new=\"\" roman\";mso-bidi-theme-font:minor-bidi;=\"\" color:red;mso-ansi-language:en-us;mso-fareast-language:en-us;mso-bidi-language:=\"\" ar-sa\"=\"\">  </span>', 0, '2022-05-24 13:30:11', '2022-12-21 16:08:50'),
(35, 'video', 22, 1, 'GENERAL SAFETY ORIENTATION', 'ed10a95137536953349adbeb7edce70b.mp4', 'ed10a95137536953349adbeb7edce70b.jpg', 'EMERGENCY PREPAREDNESS', '<p class=\"MsoNormal\"><font color=\"#4d5156\" face=\"Arial, sans-serif\"><b>In this video we present the Top emergency management tips in healthcare.</b></font><br></p>', 0, '2022-06-10 09:53:24', '2022-12-20 19:41:26'),
(36, 'video', 25, 1, 'GENERAL SAFETY ORIENTATION', '2c42166a83e1192122a3838645e917ee.mp4', '2c42166a83e1192122a3838645e917ee.jpg', 'GENERAL SAFETY ORIENTATION FOR ALL HEALTHCARE ASSOCIATES', '<b><span style=\"font-size: 18px;\">FULL VIDEO</span></b>', 0, '2022-06-10 10:19:54', '2022-12-20 19:48:50'),
(37, 'video', 25, 2, 'ORIENTACIÓN GENERAL DE SEGURIDAD', '22f5d8217fcda2517ae7265a1ef30515.mp4', '22f5d8217fcda2517ae7265a1ef30515.jpg', 'ORIENTACIÓN GENERAL DE SEGURIDAD PARA TODOS LOS ASOCIADOS DE SALUD', '<span style=\"font-size: 18px;\"><b>VÍDEO COMPLETO</b></span><br>', 0, '2022-06-10 10:24:33', '2022-12-20 20:19:19'),
(39, 'quiz', 4, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', 'd6df1eb49434dc4b11c4fd78883d0559.mp4', 'd6df1eb49434dc4b11c4fd78883d0559.jpg', 'EL SISTEMA DE TRANSPORTE', '<p class=\"MsoListParagraph\">In this video, we’ll go over the <b>two types of transportation system</b> in your healthcare facility.<o:p></o:p></p>', 0, '2022-06-10 14:31:04', '2022-12-20 19:57:19'),
(40, 'quiz', 5, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', '92684a0e2f6b1592c2d7acc43df1584f.mp4', '92684a0e2f6b1592c2d7acc43df1584f.jpg', 'EL SISTEMA HVAC', '<p class=\"MsoListParagraph\">In this video we’ll cover the critical HVAC\r\nsystem in a healthcare facility<o:p></o:p></p>', 0, '2022-06-10 15:01:28', '2022-12-20 19:57:14'),
(41, 'quiz', 7, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', '7453f490ea9ec6e34977c674a17fc7ff.mp4', '7453f490ea9ec6e34977c674a17fc7ff.jpg', 'EL SISTEMA DE PLOMERIA', '<div><span style=\"font-size: 13.3333px;\"><b>In this video, we’ll cover the domestic cold-water system, domestic hot-water system, the sanitary system and the storm system of your healthcare facility.</b></span></div><div><br></div>', 0, '2022-06-10 15:04:11', '2022-12-21 15:59:27'),
(42, 'quiz', 8, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', 'd6b740dcd50d0f7d7049bf270af75256.mp4', 'd6b740dcd50d0f7d7049bf270af75256.jpg', 'EL SISTEMA DE GASES MÉDICOS', '<span style=\"font-size:9.0pt;line-height:107%;\r\nfont-family:\"Cambria\",serif;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\r\nminor-latin;mso-bidi-font-family:Calibri;mso-ansi-language:EN-US;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">In this video, we’ll go over another important\r\nfunction pf your healthcare facility: the transport of lifesaving medical gases</span>', 0, '2022-06-10 15:11:51', '2022-12-20 19:57:02'),
(43, 'quiz', 9, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', '080c565b28f833317437adbc0ce55903.mp4', '080c565b28f833317437adbc0ce55903.jpg', 'EL SISTEMA DE CALDERA Y VAPOR', '<p class=\"MsoListParagraph\" style=\"margin-bottom: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:\r\n\"Times New Roman\";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;\r\ncolor:#666666\">In this video, we’ll cover a very important aspect of your\r\nplumbing system: the boiler and the steam system in your healthcare facility<o:p></o:p></span></p>', 0, '2022-06-10 15:14:23', '2022-12-20 19:56:57'),
(44, 'quiz', 10, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', 'ba21fbb2f4f64937535b7b8c52b5b54a.mp4', 'ba21fbb2f4f64937535b7b8c52b5b54a.jpg', 'EL SISTEMA DE COMUNICACIÓN', '<span style=\"font-size:9.0pt;line-height:107%;\r\nfont-family:\"Cambria\",serif;mso-fareast-font-family:\"Times New Roman\";\r\nmso-bidi-font-family:\"Times New Roman\";color:#666666;mso-ansi-language:EN-US;\r\nmso-fareast-language:EN-US;mso-bidi-language:AR-SA\">In this video, we’ll cover\r\nthe different methods of communication systems used in a healthcare facility in\r\norder to provide quality healthcare</span>', 0, '2022-06-10 15:17:31', '2022-12-20 19:56:51'),
(45, 'quiz', 11, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', '622db41cc83733efd6ac38d8ca360888.mp4', '622db41cc83733efd6ac38d8ca360888.jpg', 'EL SISTEMA DE DETECCIÓN DE INCENDIOS', '<p class=\"MsoListParagraph\" style=\"margin-bottom: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:9.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:\r\n\"Times New Roman\";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;\r\ncolor:#666666\">In this video, we’ll discuss one of the most important\r\nresponsibilities all healthcare associates have: understanding the fire\r\ndetection system and working together to make sure we’re ready in case of fire.<o:p></o:p></span></p>', 0, '2022-06-10 15:23:40', '2022-12-20 19:56:46'),
(46, 'quiz', 12, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', '542dc7f9e5c7751b0ef4a61929519039.mp4', '542dc7f9e5c7751b0ef4a61929519039.jpg', 'EL SISTEMA DE EXTINCIÓN DE INCENDIOS', '<p class=\"MsoListParagraph\" style=\"margin-bottom: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:9.0pt;font-family:\"Cambria\",serif;mso-fareast-font-family:\r\n\"Times New Roman\";mso-bidi-font-family:\"Times New Roman\";color:#666666\">In this\r\nvideo, we’ll describe the six main components of the fire suppression system.<o:p></o:p></span></p>', 0, '2022-06-10 15:25:54', '2022-12-20 19:56:40'),
(47, 'video', 27, 1, 'HOW CAN I HELP?', '0209574b7a9183b173d9891a340632a1.mp4', '0209574b7a9183b173d9891a340632a1.jpg', 'Electrical and Fire Safety.', '<span style=\"font-size: 12pt; line-height: 107%; font-family: Calibri, sans-serif;\">Now that you have a better understanding of the critical facility\r\nsystems that are needed to provide a safe and comfortable environment of care\r\nfor our patients, visitors and associates. Let us show you how you can help us\r\npreserve the safety and the quality of our Hospital avoiding unnecessary safety\r\nand utility issues and disruptions</span>', 0, '2022-06-13 08:11:39', '2022-12-20 19:09:44'),
(48, 'video', 27, 2, 'COMO NOS PUEDES AYUDAR?', '52f38e438844bf5e7cf34e0427ab88b9.mp4', '52f38e438844bf5e7cf34e0427ab88b9.jpg', 'Seguridad eléctrica y contra incendios.', '<p class=\"MsoNormal\" style=\"text-align: left; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size: 16px;\">Ahora que tiene una mejor comprensión de los sistemas críticos de las instalaciones que se necesitan para proporcionar un entorno de atención seguro y cómodo para nuestros pacientes, visitantes y asociados. Permítanos mostrarle cómo puede ayudarnos a preservar la seguridad y la calidad de nuestro Hospital evitando problemas e interrupciones innecesarias de seguridad y servicios públicos.</span><br></p>', 0, '2022-06-13 11:42:55', '2022-12-20 20:08:44'),
(49, 'quiz', 2, 1, 'UNDERSTANDING MY FACILITY', '43b85e3ff3831d459e5029f28e4bb0da.mp4', '43b85e3ff3831d459e5029f28e4bb0da.jpg', 'UNDERSTANDING MY FACILITY', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:12.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:\r\n\" times=\"\" new=\"\" roman\";mso-hansi-font-family:calibri;mso-bidi-font-family:calibri;=\"\" color:#666666;border:none=\"\" windowtext=\"\" 1.0pt;mso-border-alt:none=\"\" 0in;=\"\" padding:0in\"=\"\"><b>Most healthcare associates do not fully comprehend the complicated\r\nsystems of the environment where they have to provide care to their patients.\r\nIn our innovative, fun and simple to understand modules “Easy Facilities\r\nSystems Video Series”, we have described all the critical systems of a\r\nhealthcare facility.&nbsp; </b><o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><b><span style=\"font-size: 12pt; font-family: \" segoe=\"\" ui=\"\" black\",=\"\" sans-serif;\"=\"\">When staff are educated about the\r\nelements of a safe environment, they are more likely to follow processes for\r\nidentifying, reporting, and taking action on environmental risks.<o:p></o:p></span></b></p>', 0, '2022-06-13 13:17:21', '2022-12-21 16:13:31'),
(50, 'quiz', 1, 1, 'UNDERSTANDING YOUR FACILITY', '5430768d48e7fb5dfcb35df53942c203.mp4', '5430768d48e7fb5dfcb35df53942c203.jpg', 'Intro', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:12.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:\r\n\"Times New Roman\";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;\r\ncolor:#666666;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0in;\r\npadding:0in\">Most healthcare associates do not fully comprehend the complicated\r\nsystems of the environment where they have to provide care to their patients.\r\nIn our innovative, fun and simple to </span>understand modules “Easy Facilities Systems Video Series”, we have described all the critical systems of a healthcare facility. \r\n\r\nWhen staff are educated about the elements of a safe environment, they are more likely to follow processes for identifying, reporting, and taking action on environmental risks.</p><p class=\"MsoNormal\" style=\"box-sizing: border-box; margin-top: 0px; margin-right: 0px; margin-bottom: 10px; color: rgb(0, 0, 0); font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"box-sizing: border-box; font-size: 12pt; color: rgb(102, 102, 102); border: 1pt none windowtext; padding: 0in;\">understand modules “Easy Facilities Systems Video Series”, we have described all the critical systems of a healthcare facility. <o:p style=\"box-sizing: border-box;\"></o:p></span></p><p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><br></p><p class=\"MsoNormal\" style=\"box-sizing: border-box; margin-top: 0px; margin-right: 0px; margin-bottom: 10px; color: rgb(0, 0, 0); font-family: \"Source Sans Pro\", \"Helvetica Neue\", Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><b style=\"box-sizing: border-box; font-weight: 700;\"><span style=\"box-sizing: border-box; font-size: 12pt; font-family: \"Segoe UI Black\", sans-serif;\">When staff are educated about the elements of a safe environment, they are more likely to follow processes for identifying, reporting, and taking action on environmental risks.</span></b></p><p class=\"MsoNormal\" style=\"margin-left: 0.5in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><br></p><p class=\"MsoNormal\" style=\"margin-left: 0.5in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><b><span style=\"font-size: 12pt; font-family: \"Segoe UI Black\", sans-serif;\"><o:p></o:p></span></b></p>', 0, '2022-06-13 13:49:27', '2022-11-23 12:43:29'),
(51, 'quiz', 2, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', '2329bdda7d61158913ab44c727aadc44.mp4', '2329bdda7d61158913ab44c727aadc44.jpg', 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:12.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:\r\n\"Times New Roman\";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;\r\ncolor:#666666;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0in;\r\npadding:0in\">La mayoria de los asociados de atencion medica no comprenden\r\ncompletamente los complicados sistemas del entorno en el que deben brindar\r\natencion a sus pacientes.  En nuestros\r\nmodulos innovadores, divertidos y faciles de entender “ Easy Facilities Systems\r\nVideo Series”, hemos descrito todos los sistemas criticos de una instalacion de\r\natencion medica.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><b><span style=\"font-size: 12pt; font-family: \"Segoe UI Black\", sans-serif;\">Cuando se educa al personal sobre los\r\nelementos de un entorno seguro, es mas probable que sigan los procesos para\r\nidentificar, informar y tomar medidas sobre los riesgos ambientales.<o:p></o:p></span></b></p>', 0, '2022-06-13 14:10:20', '2022-12-20 19:55:10'),
(52, 'quiz', 3, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', '4fafb1f86504f816d19bbc7d55820b2c.mp4', '4fafb1f86504f816d19bbc7d55820b2c.jpg', 'EL SISTEMA DE DISTRIBUCIÓN ELÉCTRICA', '<p class=\"MsoListParagraph\">In this video we help all healthcare associates\r\nunderstand the critical electrical system<o:p></o:p></p>', 0, '2022-06-15 07:54:54', '2022-12-20 19:57:24'),
(53, 'quiz', 1, 2, 'ENTENDIENDO LOS SISTEMAS DE MIS INSTALACIONES', '8822dfed0d416745cff309efd49eef77.mp4', '8822dfed0d416745cff309efd49eef77.jpg', 'Intro', '<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size:12.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:\r\n\"Times New Roman\";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;\r\ncolor:#666666;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0in;\r\npadding:0in\">La mayoria de los asociados de atencion medica no comprenden\r\ncompletamente los complicados sistemas del entorno en el que deben brindar\r\natencion a sus pacientes.  En nuestros\r\nmodulos innovadores, divertidos y faciles de entender “ Easy Facilities Systems\r\nVideo Series”, hemos descrito todos los sistemas criticos de una instalacion de\r\natencion medica.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><b><span style=\"font-size: 12pt; font-family: \"Segoe UI Black\", sans-serif;\">Cuando se educa al personal sobre los\r\nelementos de un entorno seguro, es mas probable que sigan los procesos para\r\nidentificar, informar y tomar medidas sobre los riesgos ambientales.<o:p></o:p></span></b></p>', 0, '2022-06-17 12:44:45', '2022-06-30 07:37:50'),
(56, 'video', 28, 1, 'Videos de prueba', '8ab51d1a0b6f8540e62d602bff48c926.mp4', '8ab51d1a0b6f8540e62d602bff48c926.jpg', 'Video pruebas', 'videos de pruebas ejemplo', 0, '2022-12-21 05:15:30', '2022-12-21 05:15:30'),
(57, 'quiz', 29, 1, 'Videos de prueba', '68dcad7b31f8a0e7c832a3ae5d89a796.mp4', '68dcad7b31f8a0e7c832a3ae5d89a796.jpg', 'Video pruebas', 'Pruebas', 0, '2022-12-21 14:40:44', '2022-12-21 14:40:45'),
(58, 'video', 30, 1, 'Videos de prueba', '409994e1fb122f208b4756c5fbd16a96.mp4', '409994e1fb122f208b4756c5fbd16a96.jpg', 'Video pruebas', 'video puebas', 0, '2022-12-21 14:47:21', '2022-12-21 14:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `language_to_course_contents`
--

CREATE TABLE `language_to_course_contents` (
  `id` int(20) NOT NULL,
  `course_id` int(20) DEFAULT NULL,
  `language_id` int(20) DEFAULT NULL,
  `lecture_number` varchar(1000) DEFAULT NULL,
  `lecture_heading` varchar(1000) DEFAULT NULL,
  `lecture_content` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language_to_course_contents`
--

INSERT INTO `language_to_course_contents` (`id`, `course_id`, `language_id`, `lecture_number`, `lecture_heading`, `lecture_content`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', 'UNDERSTANDING MY FACILITY SYSTEMS', 'Most healthcare associates do not fully comprehend the complicated systems of the environment where they have to provide care to their patients. In our innovative, fun and simple to understand modules “Easy Facilities Systems Video Series”, we have described all the critical systems of a healthcare facility.  \r\nWhen staff are educated about the elements of a safe environment, they are more likely to follow processes for identifying, reporting, and taking action on environmental risks.', '2022-05-23 12:12:30', '2022-05-23 12:12:30'),
(2, 2, 1, '1', 'UNDERSTANDING MY FACILITY SYSTEMS', 'Most healthcare associates do not fully comprehend the complicated systems of the environment where they have to provide care to their patients. In our innovative, fun and simple to understand modules “Easy Facilities Systems Video Series”, we have described all the critical systems of a healthcare facility.  \r\nWhen staff are educated about the elements of a safe environment, they are more likely to follow processes for identifying, reporting, and taking action on environmental risks.', '2022-05-23 12:25:33', '2022-05-23 12:25:33'),
(3, 3, 1, '2', 'THE ELECTRICAL DISTRIBUTION SYSTEM', 'In this video we help all healthcare associates understand the critical electrical system', '2022-06-17 09:38:42', '2022-12-20 18:42:17'),
(4, 4, 1, '3', 'THE TRANSPORTATION SYSTEM', 'In this video, we’ll go over the two types of transportation system in your healthcare facility.', '2022-06-17 09:41:16', '2022-06-17 09:41:16'),
(5, 5, 1, '4', 'THE HVAC SYSTEM', 'In this video we’ll cover the critical HVAC system in a healthcare facility', '2022-06-17 09:41:53', '2022-06-17 09:41:53'),
(6, 7, 1, '5', 'THE PLUMBING SYSTEM', 'In this video, we’ll cover the domestic cold water system, domestic hot water system, the sanitary system and the storm system of your healthcare facility.', '2022-06-17 09:42:34', '2022-06-17 09:42:34'),
(7, 8, 1, '6', 'THE MEDICAL GAS SYSTEM', 'In this video, we’ll go over another important function pf your healthcare facility: the transport of lifesaving medical gases.', '2022-06-17 09:43:17', '2022-06-17 09:43:17'),
(8, 9, 1, '7', 'THE BOILER AND STEAM SYSTEM', 'In this video, we’ll cover a very important aspect of your plumbing system: the boiler and the steam system in your healthcare facility', '2022-06-17 09:45:51', '2022-06-17 09:45:51'),
(9, 10, 1, '8', 'THE COMMUNICATION SYSTEM', 'In this video, we’ll cover the different methods of communication systems used in a healthcare facility in order to provide quality healthcare.', '2022-06-17 09:46:36', '2022-06-17 09:46:36'),
(10, 11, 1, '9', 'THE FIRE DETECTION SYSTEM', 'In this video, we’ll discuss one of the most important responsibilities all healthcare associates have: understanding the fire detection system and working together to make sure we’re ready in case of fire.', '2022-06-17 09:47:14', '2022-06-17 09:47:14'),
(11, 12, 1, '10', 'THE FIRE SUPRESSSION SYSTEM', 'In this video, we’ll describe the six main components of the fire suppression system.', '2022-06-17 09:47:51', '2022-06-17 09:47:51'),
(12, 3, 2, '2', 'THE ELECTRICAL DISTRIBUTION SYSTEM', 'In this video we help all healthcare associates understand the critical electrical system', '2022-06-17 10:58:58', '2022-06-17 10:59:07'),
(13, 1, 2, '1', 'UNDERSTANDING MY FACILITY SYSTEMS', 'Introduction', '2022-06-17 11:39:06', '2022-06-17 11:39:06'),
(14, 2, 2, '1', 'EL SISTEMA DE DISTRIBUCIÓN ELÉCTRICA', 'In this video we help all healthcare associates understand the critical electrical system', '2022-06-17 12:48:48', '2022-06-17 12:48:48'),
(15, 5, 2, '4', 'EL SISTEMA HVAC', 'En este video, cubriremos el sistema HVAC crítico en un centro de atención médica.', '2022-06-17 13:02:37', '2022-06-17 13:02:37'),
(16, 4, 2, '3', 'EL SISTEMA DE TRANSPORTE', 'En este video, repasaremos los dos tipos de sistemas de transporte en su centro de atención médica', '2022-11-03 13:10:40', '2022-11-03 13:10:40'),
(17, 26, 1, '01', '01', 'sds', '2022-11-07 04:27:38', '2022-11-07 04:27:47'),
(18, 7, 2, '5', 'EL SISTEMA DE FONTANERÍA', 'In this video, we’ll cover the domestic cold water system, domestic hot water system, the sanitary system and the storm system of your healthcare facility.', '2022-12-22 10:39:39', '2022-12-22 10:39:39'),
(19, 8, 2, '6', 'EL SISTEMA DE GASES MÉDICOS', 'In this video, we’ll go over another important function pf your healthcare facility: the transport of lifesaving medical gases.', '2022-12-22 10:55:29', '2022-12-22 10:55:49'),
(20, 9, 2, '7', 'EL SISTEMA DE CALDERA Y VAPOR', 'In this video, we’ll cover a very important aspect of your plumbing system: the boiler and the steam system in your healthcare facility', '2022-12-22 10:56:55', '2022-12-22 10:57:04'),
(21, 10, 2, '8', 'EL SISTEMA DE COMUNICACIÓN', 'In this video, we’ll cover the different methods of communication systems used in a healthcare facility in order to provide quality healthcare.', '2022-12-22 10:57:50', '2022-12-22 10:57:50'),
(22, 11, 2, '9', 'EL SISTEMA DE DETECCIÓN DE INCENDIOS', 'In this video, we’ll discuss one of the most important responsibilities all healthcare associates have: understanding the fire detection system and working together to make sure we’re ready in case of fire.', '2022-12-22 10:58:53', '2022-12-22 10:58:53'),
(23, 12, 2, '10', 'EL SISTEMA DE EXTINCIÓN DE INCENDIOS', 'In this video, we’ll describe the six main components of the fire suppression system.', '2022-12-22 10:59:57', '2022-12-22 10:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `mail_template`
--

CREATE TABLE `mail_template` (
  `id` int(10) UNSIGNED NOT NULL,
  `identifier` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hint` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `wildcards` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_template`
--

INSERT INTO `mail_template` (`id`, `identifier`, `subject`, `hint`, `body`, `wildcards`, `from`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_forgot_password', 'Forgot Password Recovery Email', 'User forgot password email', '[LOGO]\r\n<br />\r\n<p>Hi [USER_NAME],</p><br /> <p>A request has been made to recover password for your account. </p><p>Please follow below link to confirm your email and generate new password for your account :</p><br /><a href=\"[CONFIRMATION_LINK]\">[CONFIRMATION_LINK]</a><br /> <p>In case you have not requested new password for your account, please ignore this email.</p><p>Thank you,</p><p>[APP_NAME]</p>', '[USER_NAME],[CONFIRMATION_LINK],[USER_LINK],[APP_NAME],[LOGO]', '', NULL, NULL, NULL),
(2, 'admin_contact_us', 'Contact us form Query', 'Contact us form Query', '<p>Hi ,</p><br /> \\r\\n<p>A query has been made from contact us form by [USER_NAME] . </p>\\r\\n<p>Query detail:</p><br /> \\r\\n<br />\nName: [USER_NAME] \\r\\n<br /> \nEmail: [EMAIL] \\r\\n<br /> \nMobile No: [MOBILE_NO] \\r\\n<br /> \nSubject: [SUBJECT] \\r\\n<br /> \n<p>Message: [MESSAGE] </p>\\r\\n<br /> \n\\r\\n<p>Thank you,</p><br /> \\r\\n<p>[APP_NAME]</p>', '[USER_NAME],[EMAIL],[MOBILE_NO],[SUBJECT],[MESSAGE],[APP_NAME],[LOGO]', '', NULL, NULL, NULL),
(3, 'user_registration_email', 'Registration Email', 'register_email', '[LOGO]\r\n<p>Hi [USER_NAME],</p><br>\r\n<p>Thank you for Signing Up at Understanding My Facility App. Your registration request has been received and pending for approval. Once approved by admin you will receive an email accordingly.</p>\r\n<br><p>Regards,</p>\r\n<p>[APP_NAME] Team</p>', '[USER_NAME],[LOGIN_LINK],[EMAIL],[PASSWORD],[APP_NAME],[LOGO]', '', NULL, NULL, NULL),
(4, 'new_user_registration_email_admin', 'New Registration Email', 'Admin Notify', '[LOGO]\r\n<p>Hi Admin,</p><br>\r\n<p>You have received a new registration request. Please check and update accordingly.</p>\r\n[LINK]\r\n<br><p>Regards,</p>\r\n<p>[APP_NAME] Team</p>', '[USER_NAME],[LOGIN_LINK],[EMAIL],[PASSWORD],[APP_NAME],[LOGO],[LINK]', '', NULL, NULL, NULL),
(5, 'user_registration_approve_email', 'Account Approved', 'User Notify', '[LOGO]\r\n<p>Hi [USER_NAME],</p><br>\r\n<p>Your account has been approved and created successfully. Please login with your credentials.</p>\r\n<p>Email: [EMAIL]</p>\r\n<br><p>Regards,</p>\r\n<p>[APP_NAME]</p>', '[USER_NAME],[LOGIN_LINK],[EMAIL],[PASSWORD],[APP_NAME],[LOGO]', '', NULL, NULL, NULL),
(6, 'contact_email_admin', 'Contact Us', 'Admin Notify', '[LOGO]\r\n<p>Hi Admin,</p>\r\n<p>[USER_NAME] contacted from web contact form; below are the details.</p>\r\n<p>User Name: [USER_NAME]</p>\r\n<p>Email: [EMAIL]</p>\r\n<p>Message: [MESSAGE]</p>\r\n<br><p>Thank you,</p>\r\n<p>[APP_NAME]</p>', '[USER_NAME],[LOGIN_LINK],[EMAIL],[MESSAGE],[APP_NAME],[LOGO]', '', NULL, NULL, NULL),
(8, '', 'Hospital Registration Email', 'Admin Notify', '<p>Hi ,</p><br /> \\r\\n<p>A query has been made from contact us form by [USER_NAME] . </p>\\r\\n<p>Query detail:</p><br /> \\r\\n<br />\r\nName: [USER_NAME] \\r\\n<br /> \r\nEmail: [EMAIL] \\r\\n<br /> \r\nMobile No: [MOBILE_NO] \\r\\n<br /> \r\nSubject: [SUBJECT] \\r\\n<br /> \r\n<p>Message: [MESSAGE] </p>\\r\\n<br /> \r\n\\r\\n<p>Thank you,</p><br /> \\r\\n<p>[APP_NAME]</p>', '[USER_NAME],[EMAIL],[MOBILE_NO],[SUBJECT],[MESSAGE],[APP_NAME],[LOGO]', '', NULL, NULL, NULL),
(9, 'on_certificate_complete_user', 'User complete course', 'Certificate Complete User', 'Congratulations!  you have successfully completed your course [COURSE_NAME]', '[COURSE_NAME]', '', NULL, NULL, NULL),
(10, 'on_certificate_complete', 'Admin complete course', 'Certificate Complete Admin', 'Your employee [USER_NAME] have completed the course [COURSE_NAME]', '[COURSE_NAME],[USER_NAME]', '', '2022-03-30 14:53:11', NULL, NULL),
(11, 'news_alert', 'News Alert', 'News Alert', '[NEWS_DESCRIPTION]', '[USER_NAME],[CONFIRMATION_LINK],[USER_LINK],[APP_NAME],[LOGO],[NEWS_DESCRIPTION]', '', '2022-10-13 13:07:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `source_id` int(11) NOT NULL,
  `source_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `media_type` enum('image','audio','video') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_08_07_145904_add_table_cms_apicustom', 1),
(2, '2016_08_07_150834_add_table_cms_dashboard', 1),
(3, '2016_08_07_151210_add_table_cms_logs', 1),
(4, '2016_08_07_151211_add_details_cms_logs', 1),
(5, '2016_08_07_152014_add_table_cms_privileges', 1),
(6, '2016_08_07_152214_add_table_cms_privileges_roles', 1),
(7, '2016_08_07_152320_add_table_cms_settings', 1),
(8, '2016_08_07_152421_add_table_cms_users', 1),
(9, '2016_08_07_154624_add_table_cms_menus_privileges', 1),
(10, '2016_08_07_154624_add_table_cms_moduls', 1),
(11, '2016_08_17_225409_add_status_cms_users', 1),
(12, '2016_08_20_125418_add_table_cms_notifications', 1),
(13, '2016_09_04_033706_add_table_cms_email_queues', 1),
(14, '2016_09_16_035347_add_group_setting', 1),
(15, '2016_09_16_045425_add_label_setting', 1),
(16, '2016_09_17_104728_create_nullable_cms_apicustom', 1),
(17, '2016_10_01_141740_add_method_type_apicustom', 1),
(18, '2016_10_01_141846_add_parameters_apicustom', 1),
(19, '2016_10_01_141934_add_responses_apicustom', 1),
(20, '2016_10_01_144826_add_table_apikey', 1),
(21, '2016_11_14_141657_create_cms_menus', 1),
(22, '2016_11_15_132350_create_cms_email_templates', 1),
(23, '2016_11_15_190410_create_cms_statistics', 1),
(24, '2016_11_17_102740_create_cms_statistic_components', 1),
(25, '2017_06_06_164501_add_deleted_at_cms_moduls', 1),
(26, '2018_06_08_092223_create_admin_table', 1),
(27, '2018_06_08_092241_create_admin_group_table', 1),
(28, '2018_06_08_092258_create_admin_group_relation_table', 1),
(29, '2018_06_08_092353_create_mail_template_table', 1),
(30, '2018_06_08_092415_create_user_table', 1),
(31, '2018_06_25_120119_create_setting_table', 1),
(32, '2018_06_28_070537_create_api_user_table', 1),
(33, '2018_06_28_070603_create_module_table', 1),
(34, '2018_07_18_112803_create_notification_table', 1),
(35, '2018_08_06_111048_create_user_group_table', 1),
(36, '2018_08_06_111057_create_user_vote_table', 1),
(37, '2018_08_06_111104_create_user_setting_table', 1),
(38, '2018_08_06_111110_create_user_event_relation_table', 1),
(39, '2018_08_06_111122_create_user_wishlist_relation_table', 1),
(40, '2018_08_06_111147_create_donation_table', 1),
(41, '2018_08_06_111209_create_event_table', 1),
(42, '2018_08_06_111219_create_wishlist_table', 1),
(43, '2018_08_08_061005_create_user_property_table', 1),
(44, '2018_08_08_062451_create_user_genre_table', 1),
(45, '2018_08_08_121931_create_media_table', 1),
(46, '2018_08_14_075820_add_user_group_id_column', 1),
(47, '2018_08_15_074641_alter_user_device_token_column', 1),
(48, '2018_08_15_111706_alter_user_image_url_column', 1),
(49, '2018_08_16_123014_alter_user_lat_long_column', 1),
(50, '2018_09_14_110916_create_user_transaction_table', 1),
(51, '2018_10_04_103441_alter_donation_column', 1),
(52, '2019_06_11_043152_create_business_categories_table', 2),
(53, '2019_06_11_045839_create_businesses_table', 3),
(54, '2019_06_11_063001_create_deal_categories_table', 4),
(55, '2019_06_12_031832_create_favourite_businesses_table', 5),
(56, '2019_06_12_053648_create_deals_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_session` tinyint(4) NOT NULL DEFAULT '0',
  `detail` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(20) NOT NULL,
  `hospital_id` int(11) NOT NULL DEFAULT '0',
  `news_title` varchar(1000) DEFAULT NULL,
  `news_description` text,
  `news_image` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `hospital_id`, `news_title`, `news_description`, `news_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'hello', 'hello', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(10) UNSIGNED NOT NULL,
  `notification_identifier_id` int(11) DEFAULT NULL,
  `actor_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_module` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('push','email') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `is_notify_expired` tinyint(1) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_viewed` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_anonymous` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notification_identifier_id`, `actor_id`, `target_id`, `reference_id`, `reference_module`, `type`, `title`, `description`, `is_notify_expired`, `is_read`, `is_viewed`, `created_at`, `updated_at`, `deleted_at`, `is_anonymous`) VALUES
(1, 1, 0, 2, 1, 'news', 'push', 'News Alert', 'hello', 0, 0, 0, '2023-04-18 18:39:21', '2023-04-18 18:39:21', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_identifier`
--

CREATE TABLE `notification_identifier` (
  `id` int(11) NOT NULL,
  `identifier` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `notification_type` enum('push','email','none','web') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `send_type` enum('actor','target','both') COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification_identifier`
--

INSERT INTO `notification_identifier` (`id`, `identifier`, `notification_type`, `send_type`, `title`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'news_alert', 'push', 'target', 'news_alert', 'news_alert', '2022-09-22 09:04:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

CREATE TABLE `notification_settings` (
  `id` int(20) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `is_notification_on` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id` int(20) NOT NULL,
  `quiz_question_id` int(20) DEFAULT NULL,
  `language_id` int(20) DEFAULT NULL,
  `answer_option_title` varchar(225) DEFAULT NULL,
  `answer_title` varchar(1000) DEFAULT NULL,
  `is_correct_answer` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`id`, `quiz_question_id`, `language_id`, `answer_option_title`, `answer_title`, `is_correct_answer`, `created_at`, `updated_at`) VALUES
(5, 3, 1, 'A1:', 'Emergency Physical Plant', 0, '2022-05-23 11:47:07', '2022-05-23 11:47:07'),
(6, 3, 1, 'A:2', 'Emergency Physician Services', 0, '2022-05-23 11:47:38', '2022-05-23 11:47:38'),
(7, 3, 1, 'A3:', 'Emergency Power System', 1, '2022-05-23 11:48:09', '2022-05-23 11:48:09'),
(13, 6, 1, 'A:1', 'yes', 1, '2022-05-23 12:51:54', '2022-05-23 12:51:54'),
(14, 6, 1, 'A:2', 'no', 0, '2022-05-23 12:52:02', '2022-05-23 12:52:02'),
(15, 7, 1, 'A1:', 'Administration, Admitting, Compliance', NULL, '2022-05-23 13:01:18', '2022-05-23 13:02:31'),
(16, 7, 1, 'A2:', 'Equipment, Life safety, Critical', 1, '2022-05-23 13:01:39', '2022-05-23 13:02:21'),
(17, 7, 1, 'A3:', 'Emergency room, Operating Room, Laboratory', 0, '2022-05-23 13:02:12', '2022-05-23 13:02:12'),
(18, 8, 1, 'A1:', 'Red', 1, '2022-05-23 13:04:19', '2022-05-23 13:04:19'),
(19, 8, 1, 'A2:', 'Bright Orange', 0, '2022-05-23 13:04:38', '2022-05-23 13:04:38'),
(20, 8, 1, 'A3:', 'Black', 0, '2022-05-23 13:05:01', '2022-05-23 13:05:01'),
(21, 9, 1, 'A1:', 'Transportation of medication and lab specimens', 1, '2022-05-23 13:07:30', '2022-05-23 13:07:30'),
(22, 9, 1, 'A2:', 'Transport meals', 0, '2022-05-23 13:07:50', '2022-05-23 13:07:50'),
(23, 9, 1, 'A3:', 'Transport cleaning supplies', 0, '2022-05-23 13:08:12', '2022-05-23 13:08:12'),
(24, 10, 1, 'A1:', 'The Fire Department', 0, '2022-05-23 13:12:07', '2022-05-23 13:12:07'),
(25, 10, 1, 'A2:', 'The State Health Department', 0, '2022-05-23 13:12:24', '2022-05-23 13:12:24'),
(26, 10, 1, 'A3:', 'Facilities Department', 1, '2022-05-23 13:12:45', '2022-05-23 13:12:45'),
(27, 11, 1, 'A1:', 'To move visitors, supplies, & equipment', 0, '2022-05-23 13:13:49', '2022-05-23 13:13:49'),
(28, 11, 1, 'A2:', 'To move patients', 0, '2022-05-23 13:14:07', '2022-05-23 13:14:07'),
(29, 11, 1, 'A3:', 'To move staff', 0, '2022-05-23 13:14:23', '2022-05-23 13:14:23'),
(30, 11, 1, 'A4:', 'All are correct', 1, '2022-05-23 13:14:49', '2022-05-23 13:14:49'),
(31, 12, 1, 'A1:', 'To disposed old medical equipment', 0, '2022-05-23 13:15:52', '2022-05-23 13:15:52'),
(32, 12, 1, 'A2:', 'To dispose medication', 0, '2022-05-23 13:16:11', '2022-05-23 13:16:11'),
(33, 12, 1, 'A3:', 'To dispose dirty linen', 1, '2022-05-23 13:16:31', '2022-05-23 13:16:31'),
(34, 14, 1, 'A1:', 'Help spread infections', 0, '2022-05-23 13:27:56', '2022-05-23 13:27:56'),
(35, 14, 1, 'A2:', 'Move dirty air in to the patient rooms', 0, '2022-05-23 13:28:18', '2022-05-23 13:28:18'),
(36, 14, 1, 'A3:', 'Maintain a clean, temperature-controlled environment', 1, '2022-05-23 13:28:38', '2022-05-23 13:28:38'),
(37, 15, 1, 'A1:', 'Cool down the HVAC water', 1, '2022-05-23 13:36:10', '2022-05-23 13:36:10'),
(38, 15, 1, 'A2:', 'Cool down the blood', 0, '2022-05-23 13:36:34', '2022-05-23 13:36:34'),
(39, 15, 1, 'A3:', 'Circulate medical air', 0, '2022-05-23 13:36:54', '2022-05-23 13:36:54'),
(40, 16, 1, 'A1:', 'Cafeteria', 0, '2022-05-23 13:38:19', '2022-05-23 13:38:19'),
(41, 16, 1, 'A2:', 'Patient Isolation Room', 1, '2022-05-23 13:38:36', '2022-05-23 13:38:36'),
(42, 16, 1, 'A3:', 'Administration', 0, '2022-05-23 13:39:04', '2022-05-23 13:39:04'),
(43, 17, 1, 'A1:', 'Minimize the risk for the spread of infections from airborne pathogens', 0, '2022-05-23 13:40:08', '2022-05-23 13:40:08'),
(44, 17, 1, 'A2:', 'Remove contaminated air', 0, '2022-05-23 13:40:26', '2022-05-23 13:40:26'),
(45, 17, 1, 'A3:', 'Eliminate odors', 0, '2022-05-23 13:40:40', '2022-05-23 13:40:40'),
(46, 17, 1, 'A4:', 'All are correct', 1, '2022-05-23 13:40:58', '2022-05-23 13:40:58'),
(47, 18, 1, 'A1:', 'Roof drains, parking drains, and gutters', 1, '2022-05-23 13:50:07', '2022-05-23 13:50:07'),
(48, 18, 1, 'A2:', 'Disposed of medical waste', 0, '2022-05-23 13:50:27', '2022-05-23 13:50:27'),
(49, 18, 1, 'A3:', 'Shower patients', 0, '2022-05-23 13:50:47', '2022-05-23 13:50:47'),
(50, 19, 1, 'A1:', 'The domestic cold and hot water', 0, '2022-05-23 13:51:44', '2022-05-23 13:51:44'),
(51, 19, 1, 'A2:', 'All are correct', 1, '2022-05-23 13:52:06', '2022-05-23 13:52:06'),
(52, 19, 1, 'A3:', 'The medical gas system', 0, '2022-05-23 13:52:23', '2022-05-23 13:52:23'),
(53, 19, 1, 'A4:', 'The sanitary and storm system', 0, '2022-05-23 13:52:40', '2022-05-23 13:52:40'),
(54, 20, 1, 'A1:', 'To maintain a constant flow of oxygen', 0, '2022-05-23 13:54:01', '2022-05-23 13:54:01'),
(55, 20, 1, 'A2:', 'To increase patient blood circulation', 0, '2022-05-23 13:54:19', '2022-05-23 13:54:19'),
(56, 20, 1, 'A3:', 'To maintain a constant water pressure in the facility', 1, '2022-05-23 13:54:36', '2022-05-23 13:54:36'),
(57, 21, 1, 'A1:', 'Oxygen and Medical Air', 0, '2022-05-23 14:02:01', '2022-05-23 14:02:01'),
(58, 21, 1, 'A2:', 'Nitrogen Dioxide and other gases', 0, '2022-05-23 14:02:19', '2022-05-23 14:02:19'),
(59, 21, 1, 'A3:', 'Medical vacuum, Nitrogen and Nitrous Oxide', 0, '2022-05-23 14:02:46', '2022-05-23 14:02:46'),
(60, 21, 1, 'A4:', 'All are correct', 1, '2022-05-23 14:03:08', '2022-05-23 14:03:08'),
(61, 22, 1, 'A1:', 'Clean patient rooms', 0, '2022-05-23 14:04:32', '2022-05-23 14:04:32'),
(62, 22, 1, 'A2:', 'Clean electronic equipment', 0, '2022-05-23 14:04:49', '2022-05-23 14:04:49'),
(63, 22, 1, 'A3:', 'Therapeutic treatment and patients with respiratory issues', 1, '2022-05-23 14:05:44', '2022-05-23 14:05:44'),
(64, 23, 1, 'A1:', 'Anesthesia purposes', 1, '2022-05-23 14:06:57', '2022-05-23 14:06:57'),
(65, 23, 1, 'A2:', 'Bathe patients', 0, '2022-05-23 14:07:15', '2022-05-23 14:07:15'),
(66, 23, 1, 'A3:', 'Wash dishes', 0, '2022-05-23 14:07:31', '2022-05-23 14:07:31'),
(67, 24, 1, 'A1:', 'Lighting', 0, '2022-05-23 14:10:47', '2022-05-23 14:10:47'),
(68, 24, 1, 'A2:', 'Transportation', 0, '2022-05-23 14:11:04', '2022-05-23 14:11:04'),
(69, 24, 1, 'A3:', 'Generating steam', 1, '2022-05-23 14:11:22', '2022-05-23 14:11:22'),
(70, 25, 1, 'A1:', 'Irrigation', 0, '2022-05-23 14:12:27', '2022-05-23 14:12:27'),
(71, 25, 1, 'A2:', 'Laundry services and large equipment operations', 1, '2022-05-23 14:12:44', '2022-05-23 14:12:44'),
(72, 25, 1, 'A3:', 'Clean floors', 0, '2022-05-23 14:13:02', '2022-05-23 14:13:02'),
(73, 26, 1, 'A1:', 'Certified and tested annually', 0, '2022-05-23 14:14:00', '2022-05-23 14:14:00'),
(74, 26, 1, 'A2:', 'Licensed in water pressure pumps', 0, '2022-05-23 14:14:24', '2022-05-23 14:14:24'),
(75, 26, 1, 'A3:', 'Licensed in stationary engineering', 1, '2022-05-23 14:14:42', '2022-05-23 14:14:42'),
(76, 27, 1, 'A1:', 'Page break time', 0, '2022-05-23 14:20:32', '2022-05-23 14:20:32'),
(77, 27, 1, 'A2:', 'Announce universal codes and emergencies', 1, '2022-05-23 14:20:51', '2022-05-23 14:20:51'),
(78, 27, 1, 'A3:', 'Communicate and announce patient information', 0, '2022-05-23 14:21:08', '2022-05-23 14:21:08'),
(79, 28, 1, 'A1:', 'Nurse and pharmacy communication only', 0, '2022-05-23 14:22:11', '2022-05-23 14:22:11'),
(80, 28, 1, 'A2:', 'Nurse to nurse communication only', 0, '2022-05-23 14:22:29', '2022-05-23 14:22:29'),
(81, 28, 1, 'A3:', 'Patients and clinical staff communication', 1, '2022-05-23 14:22:48', '2022-05-23 14:22:48'),
(82, 29, 1, 'A1:', 'Intrusion detection system, Door access system and Infant protection system', 0, '2022-05-23 14:24:28', '2022-05-23 14:24:28'),
(83, 29, 1, 'A2:', 'Intrusion detection system, Door access system, Infant protection system and CCTV surveillance system', 1, '2022-05-23 14:24:48', '2022-05-23 14:24:48'),
(84, 29, 1, 'A3:', 'CCTV surveillance system ONLY', NULL, '2022-05-23 14:26:13', '2022-05-23 14:26:33'),
(85, 29, 1, 'A4:', 'Door access system and Infant protection system', 0, '2022-05-23 14:27:19', '2022-05-23 14:27:19'),
(86, 30, 1, 'A1:', 'A main fire alarm system panel, Smoke and heat detectors and pull stations', 1, '2022-05-23 14:35:39', '2022-05-23 14:35:39'),
(87, 30, 1, 'A2:', 'Smoke and heat detectors only', 0, '2022-05-23 14:35:55', '2022-05-23 14:35:55'),
(88, 30, 1, 'A3:', 'A Main fire alarm system panel, smoke and heat detectors, sound and illumination system', 0, '2022-05-23 14:36:15', '2022-05-23 14:36:15'),
(89, 30, 1, 'A4:', 'Pull stations and duct detectors, a main fire alarm system panel', 0, '2022-05-23 14:36:36', '2022-05-23 14:36:36'),
(90, 31, 1, 'A1:', 'Detect propane gas', 0, '2022-05-23 14:37:39', '2022-05-23 14:37:39'),
(91, 31, 1, 'A2:', 'Detect oxygen leaks', 0, '2022-05-23 14:37:56', '2022-05-23 14:37:56'),
(92, 31, 1, 'A3:', 'Detect smoke and activate fire alarm in case of fire', 1, '2022-05-23 14:38:18', '2022-05-23 14:38:18'),
(93, 32, 1, 'A1:', 'Regenerate, Accelerate, Compose, Expand', 0, '2022-05-23 14:45:09', '2022-05-23 14:45:09'),
(94, 32, 1, 'A2:', 'Rescue, Activate, Contain, Extinguish', 1, '2022-05-23 14:45:25', '2022-05-23 14:45:25'),
(95, 32, 1, 'A3:', 'Reactivate, Action, Contain, Expose', 0, '2022-05-23 14:45:42', '2022-05-23 14:45:42'),
(96, 33, 1, 'A1:', 'Prevent the spread of smoke and fire', 1, '2022-05-23 14:46:49', '2022-05-23 14:46:49'),
(97, 33, 1, 'A2:', 'Prevent water floods', 0, '2022-05-23 14:47:05', '2022-05-23 14:47:05'),
(98, 33, 1, 'A3:', 'Stop and prevent infection spread', 0, '2022-05-23 14:47:23', '2022-05-23 14:47:23'),
(99, 34, 1, 'A1:', 'Manually activate the nearest fire pull station', 1, '2022-05-23 14:48:23', '2022-05-23 14:48:23'),
(100, 34, 1, 'A2:', 'Pull the smoke detector', 0, '2022-05-23 14:48:40', '2022-05-23 14:48:40'),
(101, 34, 1, 'A3:', 'Call 911', 0, '2022-05-23 14:51:29', '2022-05-23 14:51:29'),
(102, 35, 1, 'A1:', 'Class XS, M and L', 0, '2022-05-23 15:03:48', '2022-05-23 15:03:48'),
(103, 35, 1, 'A2:', 'Class A, B, C, and K', 1, '2022-05-23 15:04:07', '2022-05-23 15:04:07'),
(104, 35, 1, 'A3:', 'Class XS, A, B and C', 0, '2022-05-23 15:04:43', '2022-05-23 15:04:43'),
(105, 35, 1, 'A4:', 'Class A and Class B only', 0, '2022-05-23 15:05:07', '2022-05-23 15:05:07'),
(106, 36, 1, 'A1:', 'Combustible liquids', 0, '2022-05-23 15:06:12', '2022-05-23 15:06:12'),
(107, 36, 1, 'A2:', 'Electrical equipment', 0, '2022-05-23 15:06:28', '2022-05-23 15:06:28'),
(108, 36, 1, 'A3:', 'Wood and paper', 0, '2022-05-23 15:06:45', '2022-05-23 15:06:45'),
(109, 36, 1, 'A4:', 'All are correct', 1, '2022-05-23 15:07:02', '2022-05-23 15:07:02'),
(110, 37, 1, 'A1:', 'Irrigation and maintenance of the facility', 0, '2022-05-23 15:08:09', '2022-05-23 15:08:09'),
(111, 37, 1, 'A2:', 'Supply domestic cold water to the kitchen', 0, '2022-05-23 15:08:25', '2022-05-23 15:08:25'),
(112, 37, 1, 'A3:', 'Supply a constant flow of high-pressure water for fighting fires', 1, '2022-05-23 15:08:43', '2022-05-23 15:08:43'),
(113, 38, 1, 'A1:', 'Pull, Aim, Squeeze, Sweep', 1, '2022-05-23 15:09:35', '2022-05-23 15:09:35'),
(114, 38, 1, 'A2:', 'Pass, Alert, Squeeze, Swap', 0, '2022-05-23 15:09:52', '2022-05-23 15:09:52'),
(115, 38, 1, 'A3:', 'Push, Act, Suppress, Sweep', 0, '2022-05-23 15:10:07', '2022-05-23 15:10:07'),
(123, 42, 2, 'A1:', 'yes', 1, '2022-06-23 08:56:08', '2022-06-23 08:56:08'),
(124, 42, 2, 'A2:', 'no', 0, '2022-06-23 08:56:19', '2022-06-23 08:56:19'),
(125, 43, 2, 'A1:', 'Emergency Physical Plant', 0, '2022-06-23 11:27:38', '2022-06-23 11:27:38'),
(126, 43, 2, 'A2:', 'Emergency Physician Services', 0, '2022-06-23 11:27:52', '2022-06-23 11:27:52'),
(127, 43, 2, 'A3:', 'Emergency Power System', 1, '2022-06-23 11:28:18', '2022-06-23 11:28:18'),
(128, 44, 2, 'A1:', 'Automatic Transfer Switch', 1, '2022-06-23 11:29:17', '2022-06-23 11:29:17'),
(129, 44, 2, 'A2:', 'Antiaging Treatment System', 0, '2022-06-23 11:29:31', '2022-06-23 11:29:31'),
(130, 44, 2, 'A3:', 'Automatic Test Services', 0, '2022-06-23 11:29:45', '2022-06-23 11:29:45'),
(131, 45, 2, 'A1:', 'Administration, Admitting, Compliance', 0, '2022-06-23 11:31:09', '2022-06-23 11:31:09'),
(132, 45, 2, 'A2:', 'Equipment, Life safety, Critical', 1, '2022-06-23 11:31:24', '2022-06-23 11:31:24'),
(133, 45, 2, 'A3:', 'Emergency room, Operating Room, Laboratory', 0, '2022-06-23 11:31:38', '2022-06-23 11:31:38'),
(134, 46, 2, 'A1:', 'Red', 1, '2022-06-23 11:32:54', '2022-06-23 11:32:54'),
(135, 46, 2, 'A2:', 'Bright Orange', 0, '2022-06-23 11:33:15', '2022-06-23 11:33:15'),
(136, 46, 2, 'A3:', 'Black', 0, '2022-06-23 11:33:28', '2022-06-23 11:33:28'),
(140, 47, 2, 'A1:', 'Transportation of medication and lab specimens', 1, '2022-06-23 11:36:14', '2022-12-21 15:15:52'),
(141, 47, 2, 'A2:', 'Transport meals', NULL, '2022-06-23 11:37:26', '2022-12-21 15:16:06'),
(142, 47, 2, 'A3:', 'Transport cleaning supplies', NULL, '2022-06-23 11:37:40', '2022-12-21 15:16:22'),
(143, 49, 2, 'A1:', 'To move visitors, supplies, & equipment', 0, '2022-06-23 11:38:52', '2022-06-23 11:38:52'),
(144, 49, 2, 'A2:', 'To move patients', 0, '2022-06-23 11:39:05', '2022-06-23 11:39:05'),
(145, 49, 2, 'A3:', 'To move staff', 0, '2022-06-23 11:39:23', '2022-06-23 11:39:23'),
(146, 49, 2, 'A4:', 'All are correct', 1, '2022-06-23 11:39:36', '2022-06-23 11:39:36'),
(147, 50, 2, 'A1:', 'To disposed old medical equipment', 0, '2022-06-23 11:41:10', '2022-06-23 11:41:10'),
(148, 50, 2, 'A2:', 'To dispose medication', 0, '2022-06-23 11:41:24', '2022-06-23 11:41:24'),
(149, 50, 2, 'A3:', 'To dispose dirty linen', 1, '2022-06-23 11:41:37', '2022-06-23 11:41:37'),
(150, 51, 2, 'A1:', 'Help spread infections', 0, '2022-06-23 11:47:38', '2022-06-23 11:47:38'),
(151, 51, 2, 'A2:', 'Move dirty air in to the patient rooms', 0, '2022-06-23 11:47:53', '2022-06-23 11:47:53'),
(152, 51, 2, 'A3:', 'Maintain a clean, temperature-controlled environment', 1, '2022-06-23 11:48:08', '2022-06-23 11:48:08'),
(153, 52, 2, 'A1:', 'Cool down the HVAC water', 1, '2022-06-23 11:49:13', '2022-06-23 11:49:13'),
(154, 52, 2, 'A2:', 'Cool down the blood', 0, '2022-06-23 11:49:30', '2022-06-23 11:49:30'),
(155, 52, 2, 'A3:', 'Circulate medical air', 0, '2022-06-23 11:49:43', '2022-06-23 11:49:43'),
(156, 53, 2, 'A1:', 'Cafeteria', 0, '2022-06-23 11:50:50', '2022-06-23 11:50:50'),
(157, 53, 2, 'A2:', 'Patient Isolation Room', 1, '2022-06-23 11:51:06', '2022-06-23 11:51:06'),
(158, 53, 2, 'A3:', 'Administration', 0, '2022-06-23 11:51:23', '2022-06-23 11:51:23'),
(159, 54, 2, 'A1:', 'Minimize the risk for the spread of infections from airborne pathogens', 0, '2022-06-23 11:55:07', '2022-06-23 11:55:07'),
(160, 54, 2, 'A2:', 'Remove contaminated air', 0, '2022-06-23 11:55:26', '2022-06-23 11:55:26'),
(161, 54, 2, 'A3:', 'Eliminate odors', 0, '2022-06-23 11:57:49', '2022-06-23 11:57:49'),
(162, 54, 2, 'A4:', 'All are correct', 1, '2022-06-23 11:58:02', '2022-06-23 11:58:02'),
(163, 55, 2, 'A1:', 'Roof drains, parking drains, and gutters', 1, '2022-06-23 11:59:13', '2022-06-23 11:59:13'),
(164, 55, 2, 'A2:', 'Disposed of medical waste', 0, '2022-06-23 11:59:28', '2022-06-23 11:59:28'),
(165, 55, 2, 'A3:', 'Shower patients', 0, '2022-06-23 11:59:40', '2022-06-23 11:59:40'),
(166, 56, 2, 'A1:', 'The domestic cold and hot water', 0, '2022-06-23 12:02:40', '2022-06-23 12:02:40'),
(167, 56, 2, 'A2:', 'All are correct', 1, '2022-06-23 12:02:53', '2022-06-23 12:02:53'),
(168, 56, 2, 'A3:', 'The medical gas system', 0, '2022-06-23 12:03:06', '2022-06-23 12:03:06'),
(169, 56, 2, 'A4:', 'The sanitary and storm system', 0, '2022-06-23 12:03:20', '2022-06-23 12:03:20'),
(170, 57, 2, 'A1:', 'To maintain a constant flow of oxygen', 0, '2022-06-23 12:04:32', '2022-06-23 12:04:32'),
(171, 57, 2, 'A2:', 'To increase patient blood circulation', 0, '2022-06-23 12:04:45', '2022-06-23 12:04:45'),
(172, 57, 2, 'A3:', 'To maintain a constant water pressure in the facility', 1, '2022-06-23 12:04:59', '2022-06-23 12:04:59'),
(173, 58, 2, 'A1:', 'Oxygen and Medical Air', 0, '2022-06-23 12:06:23', '2022-06-23 12:06:23'),
(174, 58, 2, 'A2:', 'Nitrogen Dioxide and other gases', 0, '2022-06-23 12:06:36', '2022-06-23 12:06:36'),
(175, 58, 2, 'A3:', 'Medical vacuum, Nitrogen and Nitrous Oxide', 0, '2022-06-23 12:06:49', '2022-06-23 12:06:49'),
(176, 58, 2, 'A4:', 'All are correct', 1, '2022-06-23 12:07:01', '2022-06-23 12:07:01'),
(177, 59, 2, 'A1:', 'Clean patient rooms', 0, '2022-06-23 12:08:34', '2022-06-23 12:08:34'),
(178, 59, 2, 'A2:', 'Clean electronic equipment', 0, '2022-06-23 12:08:50', '2022-06-23 12:08:50'),
(179, 59, 2, 'A3:', 'Therapeutic treatment and patients with respiratory issues', 1, '2022-06-23 12:09:06', '2022-06-23 12:09:06'),
(180, 60, 2, 'A1:', 'Anesthesia purposes', 1, '2022-06-23 12:10:09', '2022-06-23 12:10:09'),
(181, 60, 2, 'A2:', 'Bathe patients', 0, '2022-06-23 12:10:34', '2022-06-23 12:10:34'),
(182, 60, 2, 'A3:', 'Wash dishes', 0, '2022-06-23 12:10:45', '2022-06-23 12:10:45'),
(183, 61, 2, 'A1:', 'Lighting', 0, '2022-06-23 12:11:50', '2022-06-23 12:11:50'),
(184, 61, 2, 'A2:', 'Transportation', 0, '2022-06-23 12:12:03', '2022-06-23 12:12:03'),
(185, 61, 2, 'A3:', 'Generating steam', 1, '2022-06-23 12:12:17', '2022-06-23 12:12:17'),
(186, 62, 2, 'A1:', 'Irrigation', 0, '2022-06-23 12:13:37', '2022-06-23 12:13:37'),
(187, 62, 2, 'A2:', 'Laundry services and large equipment operations', 1, '2022-06-23 12:14:14', '2022-06-23 12:14:14'),
(188, 62, 2, 'A3:', 'Clean floors', 0, '2022-06-23 12:14:30', '2022-06-23 12:14:30'),
(189, 63, 2, 'A1:', 'Certified and tested annually', 0, '2022-06-23 12:15:32', '2022-06-23 12:15:32'),
(190, 63, 2, 'A2:', 'Licensed in water pressure pumps', 0, '2022-06-23 12:15:49', '2022-06-23 12:15:49'),
(191, 63, 2, 'A3:', 'Licensed in stationary engineering', 1, '2022-06-23 12:16:01', '2022-06-23 12:16:01'),
(192, 64, 2, 'A1:', 'Page break time', 0, '2022-06-23 12:18:01', '2022-06-23 12:18:01'),
(193, 64, 2, 'A2:', 'Announce universal codes and emergencies', 1, '2022-06-23 12:18:16', '2022-06-23 12:18:16'),
(194, 64, 2, 'A3:', 'Communicate and announce patient information', 0, '2022-06-23 12:18:30', '2022-06-23 12:18:30'),
(195, 65, 2, 'A1:', 'Nurse and pharmacy communication only', 0, '2022-06-23 12:19:35', '2022-06-23 12:19:35'),
(196, 65, 2, 'A2:', 'Nurse to nurse communication only', 0, '2022-06-23 12:19:47', '2022-06-23 12:19:47'),
(197, 65, 2, 'A3:', 'Patients and clinical staff communication', 1, '2022-06-23 12:20:03', '2022-06-23 12:20:03'),
(198, 66, 2, 'A1:', 'Intrusion detection system, Door access system and Infant protection system', 0, '2022-06-23 12:20:59', '2022-06-23 12:20:59'),
(199, 66, 2, 'A2:', 'Intrusion detection system, Door access system, Infant protection system and CCTV surveillance system', 1, '2022-06-23 12:21:15', '2022-06-23 12:21:15'),
(200, 66, 2, 'A3:', 'CCTV surveillance system ONLY', 0, '2022-06-23 12:21:27', '2022-06-23 12:21:27'),
(201, 66, 2, 'A4:', 'Door access system and Infant protection system', 0, '2022-06-23 12:21:46', '2022-06-23 12:21:46'),
(202, 67, 2, 'A1:', 'A main fire alarm system panel, Smoke and heat detectors and pull stations', 1, '2022-06-23 12:23:22', '2022-06-23 12:23:22'),
(203, 67, 2, 'A2:', 'Smoke and heat detectors only', 0, '2022-06-23 12:23:34', '2022-06-23 12:23:34'),
(204, 67, 2, 'A3:', 'A Main fire alarm system panel, smoke and heat detectors, sound and illumination system', 0, '2022-06-23 12:23:47', '2022-06-23 12:23:47'),
(205, 67, 2, 'A4:', 'Pull stations and duct detectors, a main fire alarm system panel', 0, '2022-06-23 12:24:00', '2022-06-23 12:24:00'),
(206, 68, 2, 'A1:', 'Detect propane gas', 0, '2022-06-23 12:25:08', '2022-06-23 12:25:08'),
(207, 68, 2, 'A2:', 'Detect oxygen leaks', 0, '2022-06-23 12:25:23', '2022-06-23 12:25:23'),
(208, 68, 2, 'A3:', 'Detect smoke and activate fire alarm in case of fire', 1, '2022-06-23 12:25:37', '2022-06-23 12:25:37'),
(209, 69, 2, 'A1:', 'Regenerate, Accelerate, Compose, Expand', 0, '2022-06-23 12:26:25', '2022-06-23 12:26:25'),
(210, 69, 2, 'A2:', 'Rescue, Activate, Contain, Extinguish', 1, '2022-06-23 12:26:38', '2022-06-23 12:26:38'),
(211, 69, 2, 'A3:', 'Reactivate, Action, Contain, Expose', 0, '2022-06-23 12:26:50', '2022-06-23 12:26:50'),
(212, 70, 2, 'A1:', 'Prevent the spread of smoke and fire', 1, '2022-06-23 12:27:53', '2022-06-23 12:27:53'),
(213, 70, 2, 'A2:', 'Prevent water floods', NULL, '2022-06-23 12:28:15', '2022-06-23 12:28:44'),
(214, 70, 2, 'A3:', 'Stop and prevent infection spread', 0, '2022-06-23 12:28:56', '2022-06-23 12:28:56'),
(215, 71, 2, 'A1:', 'Manually activate the nearest fire pull station', 1, '2022-06-23 12:30:01', '2022-06-23 12:30:01'),
(216, 71, 2, 'A2:', 'Pull the smoke detector', 0, '2022-06-23 12:30:13', '2022-06-23 12:30:13'),
(217, 71, 2, 'A3:', 'Call 911', 0, '2022-06-23 12:30:29', '2022-06-23 12:30:29'),
(218, 72, 2, 'A1:', 'Class XS, M and L', 0, '2022-06-23 12:31:19', '2022-06-23 12:31:19'),
(219, 72, 2, 'A2:', 'Class A, B, C, and K', 1, '2022-06-23 12:31:31', '2022-06-23 12:31:31'),
(220, 72, 2, 'A3:', 'Class XS, A, B and C', 0, '2022-06-23 12:31:43', '2022-06-23 12:31:43'),
(221, 72, 2, 'A4:', 'Class A and Class B only', 0, '2022-06-23 12:32:01', '2022-06-23 12:32:01'),
(222, 73, 2, 'A1:', 'Combustible liquids', 0, '2022-06-23 12:32:45', '2022-06-23 12:32:45'),
(223, 73, 2, 'A2:', 'Electrical equipment', 0, '2022-06-23 12:32:57', '2022-06-23 12:32:57'),
(224, 73, 2, 'A3:', 'Wood and paper', 0, '2022-06-23 12:33:09', '2022-06-23 12:33:09'),
(225, 73, 2, 'A4:', 'All are correct', 1, '2022-06-23 12:33:22', '2022-06-23 12:33:22'),
(226, 74, 2, 'A1:', 'Irrigation and maintenance of the facility', 0, '2022-06-23 12:34:14', '2022-06-23 12:34:14'),
(227, 74, 2, 'A2:', 'Supply domestic cold water to the kitchen', 0, '2022-06-23 12:34:27', '2022-06-23 12:34:27'),
(228, 74, 2, 'A3:', 'Supply a constant flow of high-pressure water for fighting fires', 1, '2022-06-23 12:34:39', '2022-06-23 12:34:39'),
(229, 75, 2, 'A1:', 'Pull, Aim, Squeeze, Sweep', 1, '2022-06-23 12:35:24', '2022-06-23 12:35:24'),
(230, 75, 2, 'A2:', 'Pass, Alert, Squeeze, Swap', 0, '2022-06-23 12:35:36', '2022-06-23 12:35:36'),
(231, 75, 2, 'A3:', 'Push, Act, Suppress, Sweep', 0, '2022-06-23 12:35:47', '2022-06-23 12:35:47'),
(233, 4, 1, 'A1:', 'Automatic Transfer Switch', 1, '2022-06-28 13:41:52', '2022-06-28 13:41:52'),
(234, 4, 1, 'A2:', 'Antiaging Treatment System', 0, '2022-06-28 13:42:08', '2022-06-28 13:42:08'),
(235, 4, 1, 'A3:', 'Automatic Test Services', 0, '2022-06-28 13:42:25', '2022-06-28 13:42:25'),
(239, 48, 2, 'A1', 'The Fire Department', 0, '2022-12-21 15:17:04', '2022-12-21 15:17:04'),
(240, 48, 2, 'A2', 'The State Health Department', 0, '2022-12-21 15:17:19', '2022-12-21 15:17:19'),
(241, 48, 2, 'A3', 'Facilities Department', 1, '2022-12-21 15:17:37', '2022-12-21 15:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(20) NOT NULL,
  `course_quiz_id` int(20) DEFAULT NULL,
  `course_id` int(20) DEFAULT NULL,
  `language_id` int(20) DEFAULT NULL,
  `question_option_title` varchar(225) DEFAULT NULL,
  `question_title` varchar(1000) DEFAULT NULL,
  `is_multiple_choice_question` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `course_quiz_id`, `course_id`, `language_id`, `question_option_title`, `question_title`, `is_multiple_choice_question`, `created_at`, `updated_at`) VALUES
(3, 3, 3, 1, 'Q:1', 'What does EPS mean?', 1, '2022-05-23 11:46:41', '2022-05-23 11:46:41'),
(4, 3, 3, 1, 'Q:2', 'What does ATS stand for?', 1, '2022-05-23 11:52:35', '2022-05-23 11:52:35'),
(6, 2, 2, 1, 'Q:1', 'Are you ready for your next lesson?', 1, '2022-05-23 12:51:45', '2022-05-23 12:51:45'),
(7, 3, 3, 1, 'Q:3', 'What are the three ESSENTIAL BRANCHES of your healthcare facility ELECTRICAL DISTRIBUTION SYSTEM?', 1, '2022-05-23 13:00:57', '2022-05-23 13:00:57'),
(8, 3, 3, 1, 'Q:4', 'What is the color of the EMERGENCY ELECTRICAL outlets?', 1, '2022-05-23 13:03:32', '2022-05-23 13:03:32'),
(9, 4, 4, 1, 'Q:1', 'What is the main purpose of the PNEUMATIC TUBE SYSTEM in your healthcare facility?', 1, '2022-05-23 13:06:59', '2022-05-23 13:06:59'),
(10, 4, 4, 1, 'Q:2', 'In the event of a SPILL, who would you call to decontaminate THE PNEUMATIC TUBE SYSTEM?', 1, '2022-05-23 13:11:46', '2022-05-23 13:11:46'),
(11, 4, 4, 1, 'Q:3', 'In a healthcare facility THE ELEVATORS are use for?', 1, '2022-05-23 13:13:24', '2022-05-23 13:13:24'),
(12, 4, 4, 1, 'Q:4', 'What is the primary use of THE CHUTE in your healthcare facility?', 1, '2022-05-23 13:15:25', '2022-05-23 13:15:25'),
(14, 5, 5, 1, 'Q:1', 'The HVAC system in a healthcare facility is essential to?', 1, '2022-05-23 13:26:54', '2022-05-23 13:26:54'),
(15, 5, 5, 1, 'Q:2', 'The CHILLER in a Healthcare facility is used to?', 1, '2022-05-23 13:32:48', '2022-05-23 13:32:48'),
(16, 5, 5, 1, 'Q:3', 'Which of the following areas in the healthcare facility is required to have NEGATIVE PRESSURE?', 1, '2022-05-23 13:37:54', '2022-05-23 13:37:54'),
(17, 5, 5, 1, 'Q:4', 'The AIR FLOW in a healthcare facility is controlled in order to?', 1, '2022-05-23 13:39:44', '2022-05-23 13:39:44'),
(18, 6, 7, 1, 'Q:1', 'The healthcare facility’s STORM SYSTEM is used to?', 1, '2022-05-23 13:49:22', '2022-05-23 13:49:22'),
(19, 6, 7, 1, 'Q:2', 'The PLUMBING SYSTEM of a healthcare facility includes?', 1, '2022-05-23 13:51:25', '2022-05-23 13:51:25'),
(20, 6, 7, 1, 'Q:3', 'What are the BOOSTING PUMPS used for in a healthcare facility?', 1, '2022-05-23 13:53:26', '2022-05-23 13:53:26'),
(21, 7, 8, 1, 'Q:1', 'The MEDICAL GAS SYSTEM of a healthcare facility is comprised of?', 1, '2022-05-23 14:01:28', '2022-05-23 14:01:28'),
(22, 7, 8, 1, 'Q:2', 'In a healthcare facility, OXYGEN is used to/for?', 1, '2022-05-23 14:03:55', '2022-05-23 14:03:55'),
(23, 7, 8, 1, 'Q:3', 'In a healthcare facility, NITROUS OXIDE is used to/for:', 1, '2022-05-23 14:06:37', '2022-05-23 14:06:37'),
(24, 8, 9, 1, 'Q:1', 'Healthcare facilities use BOILERS for?', 1, '2022-05-23 14:10:29', '2022-05-23 14:10:29'),
(25, 8, 9, 1, 'Q:2', 'In a Healthcare facility HIGH PRESSURE STEAM is used for/to?', 1, '2022-05-23 14:12:07', '2022-05-23 14:12:07'),
(26, 8, 9, 1, 'Q:3', 'In certain areas of the country healthcare facility BOILER OPERATORS must be?', 1, '2022-05-23 14:13:37', '2022-05-23 14:13:37'),
(27, 9, 10, 1, 'Q:1', 'In Hospitals the OVERHEAD SYSTEM is used to?', 1, '2022-05-23 14:20:15', '2022-05-23 14:20:15'),
(28, 9, 10, 1, 'Q:2', 'In Hospitals the NURSE CALL SYSTEM is used for?', 1, '2022-05-23 14:21:45', '2022-05-23 14:21:45'),
(29, 9, 10, 1, 'Q:3', 'What does the ELECTRONIC SECURITY SYSTEM include?', 1, '2022-05-23 14:24:05', '2022-05-23 14:24:05'),
(30, 10, 11, 1, 'Q:1', 'A hospital’s FIRE DETECTION SYSTEM is comprised of?', 1, '2022-05-23 14:35:19', '2022-05-23 14:35:19'),
(31, 10, 11, 1, 'Q:2', 'Hospital SMOKE DETECTORS are used to?', 1, '2022-05-23 14:37:19', '2022-05-23 14:37:19'),
(32, 10, 11, 1, 'Q:3', 'What does the acronym RACE stand for?', 1, '2022-05-23 14:44:52', '2022-05-23 14:44:52'),
(33, 10, 11, 1, 'Q:4', 'Healthcare facilities are required to have FIRE AND SMOKE DAMPERS to?', 1, '2022-05-23 14:46:29', '2022-05-23 14:46:29'),
(34, 10, 11, 1, 'Q:5', 'In case of a real FIRE the fastest way to activate the FIRE ALARM SYSTEM is to:', 1, '2022-05-23 14:48:01', '2022-05-23 14:48:01'),
(35, 11, 12, 1, 'Q:1', 'What are the types of EXTINGUISHERS in a healthcare facility?', 1, '2022-05-23 15:03:27', '2022-05-23 15:03:27'),
(36, 11, 12, 1, 'Q:2', 'Most of the EXTINGUISHERS in a healthcare facility must be rated for?', 1, '2022-05-23 15:05:56', '2022-05-23 15:05:56'),
(37, 11, 12, 1, 'Q:3', 'PRIVATE FIRE HYDRANTS are installed around the perimeter of the healthcare facility to?', 1, '2022-05-23 15:07:51', '2022-05-23 15:07:51'),
(38, 11, 12, 1, 'Q:4', 'What does the acronym PASS stand for?', 1, '2022-05-23 15:09:17', '2022-05-23 15:09:17'),
(42, 2, 2, 2, 'Q:1', 'Are you ready for your next lesson?', 1, '2022-06-23 08:55:47', '2022-06-23 08:55:47'),
(43, 3, 3, 2, 'Q:1', 'What does EPS mean?', 1, '2022-06-23 11:27:13', '2022-06-23 11:27:13'),
(44, 3, 3, 2, 'Q:2', 'What does ATS stand for?', 1, '2022-06-23 11:28:56', '2022-06-23 11:28:56'),
(45, 3, 3, 2, 'Q:3', 'What are the three ESSENTIAL BRANCHES of your healthcare facility ELECTRICAL DISTRIBUTION SYSTEM?', 1, '2022-06-23 11:30:40', '2022-06-23 11:30:40'),
(46, 3, 3, 2, 'Q:4', 'What is the color of the EMERGENCY ELECTRICAL outlets?', 1, '2022-06-23 11:32:32', '2022-06-23 11:32:32'),
(47, 4, 4, 2, 'Q:1', 'What is the main purpose of the PNEUMATIC TUBE SYSTEM in your healthcare facility?', 1, '2022-06-23 11:34:10', '2022-06-23 11:34:10'),
(48, 4, 4, 2, 'Q:2', 'In the event of a SPILL, who would you call to decontaminate THE PNEUMATIC TUBE SYSTEM?', 1, '2022-06-23 11:35:45', '2022-06-23 11:35:45'),
(49, 4, 4, 2, 'Q:3', 'In a healthcare facility THE ELEVATORS are use for?', 1, '2022-06-23 11:38:19', '2022-06-23 11:38:19'),
(50, 4, 4, 2, 'Q:4', 'What is the primary use of THE CHUTE in your healthcare facility?', 1, '2022-06-23 11:40:09', '2022-06-23 11:40:50'),
(51, 5, 5, 2, 'Q:1', 'The HVAC system in a healthcare facility is essential to?', 1, '2022-06-23 11:47:07', '2022-06-23 11:47:24'),
(52, 5, 5, 2, 'Q:2', 'The CHILLER in a Healthcare facility is used to?', 1, '2022-06-23 11:48:57', '2022-06-23 11:48:57'),
(53, 5, 5, 2, 'Q:3', 'Which of the following areas in the healthcare facility is required to have NEGATIVE PRESSURE?', 1, '2022-06-23 11:50:19', '2022-06-23 11:50:19'),
(54, 5, 5, 2, 'Q:4', 'The AIR FLOW in a healthcare facility is controlled in order to?', 1, '2022-06-23 11:54:47', '2022-06-23 11:54:47'),
(55, 6, 7, 2, 'Q:1', 'The healthcare facility’s STORM SYSTEM is used to?', 1, '2022-06-23 11:58:56', '2022-06-23 11:58:56'),
(56, 6, 7, 2, 'Q:2', 'The PLUMBING SYSTEM of a healthcare facility includes?', 1, '2022-06-23 12:01:45', '2022-06-23 12:02:28'),
(57, 6, 7, 2, 'Q:3', 'What are the BOOSTING PUMPS used for in a healthcare facility?', 1, '2022-06-23 12:04:10', '2022-06-23 12:04:10'),
(58, 7, 8, 2, 'Q:1', 'The MEDICAL GAS SYSTEM of a healthcare facility is comprised of?', 1, '2022-06-23 12:06:08', '2022-06-23 12:06:08'),
(59, 7, 8, 2, 'Q:2', 'In a healthcare facility, OXYGEN is used to/for?', 1, '2022-06-23 12:08:06', '2022-06-23 12:08:06'),
(60, 7, 8, 2, 'Q:3', 'In a healthcare facility, NITROUS OXIDE is used to/for?', 1, '2022-06-23 12:09:42', '2022-06-23 12:09:42'),
(61, 8, 9, 2, 'Q:1', 'Healthcare facilities use BOILERS for?', 1, '2022-06-23 12:11:32', '2022-06-23 12:11:32'),
(62, 8, 9, 2, 'Q:2', 'In a Healthcare facility HIGH PRESSURE STEAM is used for/to?', 1, '2022-06-23 12:13:17', '2022-06-23 12:13:17'),
(63, 8, 9, 2, 'Q:3', 'In certain areas of the country healthcare facility BOILER OPERATORS must be?', 1, '2022-06-23 12:15:06', '2022-06-23 12:15:06'),
(64, 9, 10, 2, 'Q:1', 'In Hospitals the OVERHEAD SYSTEM is used to?', 1, '2022-06-23 12:17:44', '2022-06-23 12:17:44'),
(65, 9, 10, 2, 'Q:2', 'In Hospitals the NURSE CALL SYSTEM is used for?', 1, '2022-06-23 12:19:15', '2022-06-23 12:19:15'),
(66, 9, 10, 2, 'Q:3', 'What does the ELECTRONIC SECURITY SYSTEM include?', 1, '2022-06-23 12:20:44', '2022-06-23 12:20:44'),
(67, 10, 11, 2, 'Q:1', 'A hospital’s FIRE DETECTION SYSTEM is comprised of?', 1, '2022-06-23 12:22:34', '2022-06-23 12:22:34'),
(68, 10, 11, 2, 'Q:2', 'Hospital SMOKE DETECTORS are used to?', 1, '2022-06-23 12:24:46', '2022-06-23 12:24:46'),
(69, 10, 11, 2, 'Q:3', 'What does the acronym RACE stand for?', 1, '2022-06-23 12:26:07', '2022-06-23 12:26:07'),
(70, 10, 11, 2, 'Q:4', 'Healthcare facilities are required to have FIRE AND SMOKE DAMPERS to?', 1, '2022-06-23 12:27:36', '2022-06-23 12:27:36'),
(71, 10, 11, 2, 'Q:5', 'In case of a real FIRE the fastest way to activate the FIRE ALARM SYSTEM is to?', 1, '2022-06-23 12:29:29', '2022-06-23 12:29:29'),
(72, 11, 12, 2, 'Q:1', 'What are the types of EXTINGUISHERS in a healthcare facility?', 1, '2022-06-23 12:31:05', '2022-06-23 12:31:05'),
(73, 11, 12, 2, 'Q:2', 'Most of the EXTINGUISHERS in a healthcare facility must be rated for?', 1, '2022-06-23 12:32:30', '2022-06-23 12:32:30'),
(74, 11, 12, 2, 'Q:3', 'PRIVATE FIRE HYDRANTS are installed around the perimeter of the healthcare facility to?', 1, '2022-06-23 12:33:51', '2022-06-23 12:33:51'),
(75, 11, 12, 2, 'Q:4', 'What does the acronym PASS stand for?', 1, '2022-06-23 12:35:08', '2022-06-23 12:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_type` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `key`, `value`, `key_type`, `created_at`) VALUES
(1, 'send_email', 'noreplyunderstandingmyfacility@gmail.com', 'admin', '2022-04-01 14:38:04'),
(2, 'receive_email', 'noreplyunderstandingmyfacility@gmail.com', 'admin', '2022-04-01 14:38:01'),
(3, 'push_notification', '1', 'user', '2018-09-09 13:58:55'),
(4, 'email_notification', '1', 'user', '2018-09-09 13:58:55'),
(5, 'featured_deal_charges', '60.00', 'admin', '2018-11-26 03:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `site_contents`
--

CREATE TABLE `site_contents` (
  `id` int(20) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_contents`
--

INSERT INTO `site_contents` (`id`, `title`, `content`) VALUES
(1, 'Terms and Conditions', '<p class=\"MsoNormal\"><b>Before using the\r\napplication, please read these terms of use carefully<o:p></o:p></b></p><p class=\"MsoNormal\" style=\"text-align:justify\">Your use of the UMF mobile\r\napplication indicate that you have read, understand, and agree to these terms\r\nand conditions and any other applicable laws, statutes, and regulations. Your\r\ncontinued use of the App will be considered your acceptance to the revised\r\nterms and conditions.<o:p></o:p></p><p class=\"MsoNormal\">You are solely responsible for the following:</p><ol><li>All passwords related to your account.<o:p></o:p></li><li>All activities that occur under your account, including all\r\nactivities of any persons who gain access to your account with or without your\r\npermission.</li><li style=\"text-align: justify;\">You agree to provide true,\r\ncurrent, accurate and complete customer information as requested by us from\r\ntime to time. You agree to promptly notify us of any changes to this\r\ninformation as required to keep such information half by us current complete\r\nand you agree not to use the Application for any unlawful purpose prohibited\r\nunder this clause.<o:p></o:p></li></ol><p class=\"MsoListParagraphCxSpLast\" style=\"text-align:justify;text-indent:-.25in;\r\nmso-list:l0 level1 lfo1\"><o:p></o:p></p>'),
(2, 'Privacy Policy', '<div>Privacy Policy</div><div>1. Collection of personal information</div><div>•<span style=\"white-space:pre\">	</span>Username</div><div>•<span style=\"white-space:pre\">	</span>Email address</div><div>2. Forms and methods of collection</div><div>Your personal information is collected through the following methods</div><div>•<span style=\"white-space:pre\">	</span>App registration form</div><div>•<span style=\"white-space:pre\">	</span>Sign up Form</div><div>We use the collected data for the following purposes:</div><div>•<span style=\"white-space:pre\">	</span>Statistics</div><div>•<span style=\"white-space:pre\">	</span>Contact</div><div>•<span style=\"white-space:pre\">	</span>Managing the Application</div><div><br></div><div>3. Sharing of personal information</div><div>The personal information collected by the application is not transmitted to any third party and is processed only by us.</div><div><br></div><div>4. Storage period of personal information</div><div>The controller will keep in its computer systems, in reasonable security conditions, the entirety of the personal information collected for the following duration of your active account. Hosting of personal information. Our application is hosted by RetroCube Apps. The host may be contacted at the following email: understandingmyfacility@gmail.com</div><div>5. Acceptance of our privacy policy</div><div>By using our application, you certify that you have read and understood this privacy policy.</div>');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `key` varchar(145) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  `description` text,
  `duration` varchar(45) DEFAULT NULL,
  `duration_unit` varchar(45) DEFAULT NULL,
  `total_deals` int(11) DEFAULT NULL,
  `total_featured_deals` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `key`, `title`, `amount`, `description`, `duration`, `duration_unit`, `total_deals`, `total_featured_deals`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'free', 'Free', '0.00', 'Free plan detail', '7', 'days', 0, 0, '2018-10-23 10:05:55', NULL, NULL),
(2, 'plan_a', 'Plan A', '30.00', 'Plan B detail', '1', 'month', 0, 0, '2018-10-23 10:05:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_group_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `gateway_user_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT '0',
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT 'uploads/default_user.png',
  `latitude` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'male',
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `mobile_no` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `referral` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` mediumtext COLLATE utf8mb4_unicode_ci,
  `device_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expiry_at` date DEFAULT NULL,
  `subscription_expiry_date` date DEFAULT NULL,
  `forgot_password_hash` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forgot_password_hash_date` date DEFAULT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `user_scheduling_status` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT 'no-submission' COMMENT 'no-submission,pending,rejected,approved',
  `is_plan_subscribed` tinyint(1) DEFAULT '0',
  `plan_expiry_date` datetime DEFAULT NULL,
  `purchase_date` datetime DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT '0',
  `user_type` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT 'physician',
  `language_id` int(20) DEFAULT '1',
  `online_status` int(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(3) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `social_id`, `social_type`, `user_group_id`, `company_id`, `gateway_user_id`, `age`, `address`, `image_url`, `latitude`, `longitude`, `gender`, `city`, `state`, `about_me`, `mobile_no`, `hospital_id`, `speciality_id`, `department_id`, `referral`, `website`, `device_type`, `device_token`, `device`, `created_at`, `updated_at`, `deleted_at`, `token`, `token_expiry_at`, `subscription_expiry_date`, `forgot_password_hash`, `forgot_password_hash_date`, `subscription_id`, `user_scheduling_status`, `is_plan_subscribed`, `plan_expiry_date`, `purchase_date`, `is_approved`, `user_type`, `language_id`, `online_status`, `is_active`) VALUES
(1, 'Test', 'User', 'test123@yopmail.com', '94b1fa813c4f5fb76b23d175e3d2287c', NULL, NULL, 0, NULL, NULL, 0, '', 'uploads/default_user.png', NULL, NULL, 'male', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-23 13:54:58', '2023-04-18 11:52:03', NULL, NULL, NULL, NULL, '', '2023-04-18', NULL, 'no-submission', 0, NULL, NULL, 1, 'hospital', 1, 0, 1),
(2, 'bond', 'mic', 'bond123@yopmail.com', 'ed15495b1c0fccc31ab142fd0a9b49ef', NULL, NULL, 0, NULL, NULL, 0, '', '2a5a60a4e38015ebb237c7ba7a2e1b37.jpg', NULL, NULL, 'male', NULL, NULL, NULL, '+123456789', 1, NULL, NULL, NULL, NULL, 'android', 'undefined', NULL, '2023-03-23 14:00:48', '2023-04-18 18:07:27', NULL, '229825e374cfae33c9396421b8872766', NULL, NULL, NULL, NULL, NULL, 'no-submission', 0, NULL, NULL, 0, 'physician', 1, 0, 1),
(3, 'CommonSpirit Health', 'CommonSpirit Health', 'CommonSpiritHealth@gmail.com', '94b1fa813c4f5fb76b23d175e3d2287c', NULL, NULL, 0, NULL, NULL, 0, '', '7a1b800019ca9f69cf9c397ef6be247e.png', NULL, NULL, 'male', NULL, NULL, NULL, '123456789', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-10 21:55:24', '2023-04-10 22:12:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no-submission', 0, NULL, NULL, 1, 'hospital', 1, 0, 1),
(4, 'testCommonspirit', 'testCommonspirit', 'testCommonspirit@gmail.com', 'bd78fe3443ce2e06368e2220191de4bf', NULL, NULL, 0, NULL, NULL, 0, '', '41681143207.png', NULL, NULL, 'male', NULL, NULL, NULL, '1234567890', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-10 21:58:35', '2023-04-15 00:02:19', NULL, '7f132b6085a8e674b33aad3eecaa7963', NULL, NULL, NULL, NULL, NULL, 'no-submission', 0, NULL, NULL, 0, 'physician', 1, 0, 1),
(5, 'Brian D', 'Allgood Army', 'briandallgood@gmail.com', '94b1fa813c4f5fb76b23d175e3d2287c', NULL, NULL, 0, NULL, NULL, 0, '', 'b2a70d95c2a4b165c0cd63cd7f952ef8.png', NULL, NULL, 'male', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-14 23:37:29', '2023-04-19 11:43:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no-submission', 0, NULL, NULL, 1, 'hospital', 1, 0, 1),
(6, 'Brian D', 'Allgood Army', 'briandallgoodtest@gmail.com', '896af5c0799f62e837e0a35036b4e86e', NULL, NULL, 0, NULL, NULL, 0, '', 'fdd4aee893381f8b919238e8d5ed9cbc.png', NULL, NULL, 'male', NULL, NULL, NULL, '31245698', 3, NULL, NULL, NULL, NULL, 'ios', '80ae7740-85d8-4f0e-bb3b-4a1cf1f95aea', NULL, '2023-04-14 23:40:22', '2023-04-19 00:03:29', NULL, '36b00821c553e213309a449a4eba5547', NULL, NULL, NULL, NULL, NULL, 'no-submission', 0, NULL, NULL, 0, 'physician', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_course_attempt`
--

CREATE TABLE `user_course_attempt` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_course_attempt`
--

INSERT INTO `user_course_attempt` (`id`, `user_id`, `course_id`, `hospital_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 2, '2023-04-12 22:31:51', NULL),
(2, 2, 2, 1, '2023-04-18 11:57:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_course_certificates`
--

CREATE TABLE `user_course_certificates` (
  `id` int(20) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `course_certificate_id` int(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_quizzes`
--

CREATE TABLE `user_quizzes` (
  `id` int(20) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `course_quiz_id` int(20) DEFAULT NULL,
  `quiz_percentage` int(20) DEFAULT NULL,
  `is_quiz_completed` tinyint(1) DEFAULT '0',
  `is_quiz_passed` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_quizzes`
--

INSERT INTO `user_quizzes` (`id`, `user_id`, `course_quiz_id`, `quiz_percentage`, `is_quiz_completed`, `is_quiz_passed`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 100, 1, 1, '2023-04-12 22:31:50', '2023-04-12 22:31:51'),
(2, 2, 2, 100, 1, 1, '2023-04-18 11:57:09', '2023-04-18 11:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_answers`
--

CREATE TABLE `user_quiz_answers` (
  `id` int(20) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `user_quiz_id` int(20) DEFAULT NULL,
  `quiz_question_id` int(20) DEFAULT NULL,
  `quiz_answer_id` int(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_quiz_answers`
--

INSERT INTO `user_quiz_answers` (`id`, `user_id`, `user_quiz_id`, `quiz_question_id`, `quiz_answer_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 6, 13, '2023-04-12 22:31:50', '2023-04-12 22:31:50'),
(2, 2, 2, 6, 13, '2023-04-18 11:57:09', '2023-04-18 11:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_question_statuses`
--

CREATE TABLE `user_quiz_question_statuses` (
  `id` int(20) NOT NULL,
  `quiz_question_id` int(20) DEFAULT NULL,
  `quiz_answer_status` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_setting`
--

CREATE TABLE `user_setting` (
  `setting_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `value` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `admin_group`
--
ALTER TABLE `admin_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_group_relation`
--
ALTER TABLE `admin_group_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_user`
--
ALTER TABLE `api_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`,`is_show_on_place_ad`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message_delete`
--
ALTER TABLE `chat_message_delete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message_status`
--
ALTER TABLE `chat_message_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_room_users`
--
ALTER TABLE `chat_room_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_apicustom`
--
ALTER TABLE `cms_apicustom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_apikey`
--
ALTER TABLE `cms_apikey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_dashboard`
--
ALTER TABLE `cms_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_email_queues`
--
ALTER TABLE `cms_email_queues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_email_templates`
--
ALTER TABLE `cms_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_logs`
--
ALTER TABLE `cms_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_menus`
--
ALTER TABLE `cms_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_menus_privileges`
--
ALTER TABLE `cms_menus_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_moduls`
--
ALTER TABLE `cms_moduls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_notifications`
--
ALTER TABLE `cms_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_privileges`
--
ALTER TABLE `cms_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_privileges_roles`
--
ALTER TABLE `cms_privileges_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_settings`
--
ALTER TABLE `cms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_statistics`
--
ALTER TABLE `cms_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_statistic_components`
--
ALTER TABLE `cms_statistic_components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_users`
--
ALTER TABLE `cms_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_certificates`
--
ALTER TABLE `course_certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_quizzes`
--
ALTER TABLE `course_quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital_courses`
--
ALTER TABLE `hospital_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital_email`
--
ALTER TABLE `hospital_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_to_courses`
--
ALTER TABLE `language_to_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_to_course_contents`
--
ALTER TABLE `language_to_course_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_template`
--
ALTER TABLE `mail_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_identifier`
--
ALTER TABLE `notification_identifier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_contents`
--
ALTER TABLE `site_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_course_attempt`
--
ALTER TABLE `user_course_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_course_certificates`
--
ALTER TABLE `user_course_certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_quizzes`
--
ALTER TABLE `user_quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_quiz_answers`
--
ALTER TABLE `user_quiz_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_quiz_question_statuses`
--
ALTER TABLE `user_quiz_question_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_setting`
--
ALTER TABLE `user_setting`
  ADD PRIMARY KEY (`setting_id`,`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_group`
--
ALTER TABLE `admin_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_group_relation`
--
ALTER TABLE `admin_group_relation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_user`
--
ALTER TABLE `api_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chat_message_delete`
--
ALTER TABLE `chat_message_delete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_message_status`
--
ALTER TABLE `chat_message_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat_room_users`
--
ALTER TABLE `chat_room_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_apicustom`
--
ALTER TABLE `cms_apicustom`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_apikey`
--
ALTER TABLE `cms_apikey`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_dashboard`
--
ALTER TABLE `cms_dashboard`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_email_queues`
--
ALTER TABLE `cms_email_queues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_email_templates`
--
ALTER TABLE `cms_email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms_logs`
--
ALTER TABLE `cms_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms_menus`
--
ALTER TABLE `cms_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cms_menus_privileges`
--
ALTER TABLE `cms_menus_privileges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `cms_moduls`
--
ALTER TABLE `cms_moduls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `cms_notifications`
--
ALTER TABLE `cms_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_privileges`
--
ALTER TABLE `cms_privileges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_privileges_roles`
--
ALTER TABLE `cms_privileges_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `cms_settings`
--
ALTER TABLE `cms_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cms_statistics`
--
ALTER TABLE `cms_statistics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_statistic_components`
--
ALTER TABLE `cms_statistic_components`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cms_users`
--
ALTER TABLE `cms_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `course_certificates`
--
ALTER TABLE `course_certificates`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `course_quizzes`
--
ALTER TABLE `course_quizzes`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospital_courses`
--
ALTER TABLE `hospital_courses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital_email`
--
ALTER TABLE `hospital_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `language_to_courses`
--
ALTER TABLE `language_to_courses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `language_to_course_contents`
--
ALTER TABLE `language_to_course_contents`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mail_template`
--
ALTER TABLE `mail_template`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification_identifier`
--
ALTER TABLE `notification_identifier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification_settings`
--
ALTER TABLE `notification_settings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `site_contents`
--
ALTER TABLE `site_contents`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_course_attempt`
--
ALTER TABLE `user_course_attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_course_certificates`
--
ALTER TABLE `user_course_certificates`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_quizzes`
--
ALTER TABLE `user_quizzes`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_quiz_answers`
--
ALTER TABLE `user_quiz_answers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_quiz_question_statuses`
--
ALTER TABLE `user_quiz_question_statuses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_setting`
--
ALTER TABLE `user_setting`
  MODIFY `setting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
