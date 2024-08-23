-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2024 at 08:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexa_mart_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'apple', '1724324265_66c719a99abfc.jpg', 1, '2024-08-22 11:57:48', '2024-08-22 11:57:48'),
(2, 'Canon', 'canon', '1724324307_66c719d37edde.png', 1, '2024-08-22 11:58:43', '2024-08-22 11:58:43'),
(3, 'Adidas', 'adidas', '1724324352_66c71a00d1416.png', 1, '2024-08-22 11:59:15', '2024-08-22 11:59:15'),
(4, 'Gucci', 'gucci', '1724324425_66c71a49ee848.png', 1, '2024-08-22 12:00:28', '2024-08-22 12:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'electronics', '1724322040_66c710f8d7be4.jpg', 1, '2024-08-22 11:20:42', '2024-08-22 11:20:42'),
(2, 'Fashion', 'fashion', '1724319011_66c70523bd758.jpg', 1, '2024-08-22 10:30:14', '2024-08-22 10:30:14'),
(3, 'Home & Kitchen', 'home-kitchen', '1724319046_66c7054667193.jpg', 1, '2024-08-22 10:30:50', '2024-08-22 10:30:50'),
(4, 'Beauty & Personal Care', 'beauty-personal-care', '1724319156_66c705b43fa62.jfif', 1, '2024-08-22 10:32:38', '2024-08-22 10:32:38'),
(5, 'Sports & Outdoors', 'sports-outdoors', '1724319277_66c7062d72daa.jpg', 1, '2024-08-22 10:34:39', '2024-08-22 10:34:39'),
(6, 'Automotive', 'automotive', '1724319302_66c7064686fe5.jpg', 1, '2024-08-22 10:35:04', '2024-08-22 10:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', NULL, NULL),
(2, 'Albania', 'AL', NULL, NULL),
(3, 'Algeria', 'DZ', NULL, NULL),
(4, 'American Samoa', 'AS', NULL, NULL),
(5, 'Andorra', 'AD', NULL, NULL),
(6, 'Angola', 'AO', NULL, NULL),
(7, 'Anguilla', 'AI', NULL, NULL),
(8, 'Antarctica', 'AQ', NULL, NULL),
(9, 'Antigua and/or Barbuda', 'AG', NULL, NULL),
(10, 'Argentina', 'AR', NULL, NULL),
(11, 'Armenia', 'AM', NULL, NULL),
(12, 'Aruba', 'AW', NULL, NULL),
(13, 'Australia', 'AU', NULL, NULL),
(14, 'Austria', 'AT', NULL, NULL),
(15, 'Azerbaijan', 'AZ', NULL, NULL),
(16, 'Bahamas', 'BS', NULL, NULL),
(17, 'Bahrain', 'BH', NULL, NULL),
(18, 'Bangladesh', 'BD', NULL, NULL),
(19, 'Barbados', 'BB', NULL, NULL),
(20, 'Belarus', 'BY', NULL, NULL),
(21, 'Belgium', 'BE', NULL, NULL),
(22, 'Belize', 'BZ', NULL, NULL),
(23, 'Benin', 'BJ', NULL, NULL),
(24, 'Bermuda', 'BM', NULL, NULL),
(25, 'Bhutan', 'BT', NULL, NULL),
(26, 'Bolivia', 'BO', NULL, NULL),
(27, 'Bosnia and Herzegovina', 'BA', NULL, NULL),
(28, 'Botswana', 'BW', NULL, NULL),
(29, 'Bouvet Island', 'BV', NULL, NULL),
(30, 'Brazil', 'BR', NULL, NULL),
(31, 'British lndian Ocean Territory', 'IO', NULL, NULL),
(32, 'Brunei Darussalam', 'BN', NULL, NULL),
(33, 'Bulgaria', 'BG', NULL, NULL),
(34, 'Burkina Faso', 'BF', NULL, NULL),
(35, 'Burundi', 'BI', NULL, NULL),
(36, 'Cambodia', 'KH', NULL, NULL),
(37, 'Cameroon', 'CM', NULL, NULL),
(38, 'Canada', 'CA', NULL, NULL),
(39, 'Cape Verde', 'CV', NULL, NULL),
(40, 'Cayman Islands', 'KY', NULL, NULL),
(41, 'Central African Republic', 'CF', NULL, NULL),
(42, 'Chad', 'TD', NULL, NULL),
(43, 'Chile', 'CL', NULL, NULL),
(44, 'China', 'CN', NULL, NULL),
(45, 'Christmas Island', 'CX', NULL, NULL),
(46, 'Cocos (Keeling) Islands', 'CC', NULL, NULL),
(47, 'Colombia', 'CO', NULL, NULL),
(48, 'Comoros', 'KM', NULL, NULL),
(49, 'Congo', 'CG', NULL, NULL),
(50, 'Cook Islands', 'CK', NULL, NULL),
(51, 'Costa Rica', 'CR', NULL, NULL),
(52, 'Croatia (Hrvatska)', 'HR', NULL, NULL),
(53, 'Cuba', 'CU', NULL, NULL),
(54, 'Cyprus', 'CY', NULL, NULL),
(55, 'Czech Republic', 'CZ', NULL, NULL),
(56, 'Democratic Republic of Congo', 'CD', NULL, NULL),
(57, 'Denmark', 'DK', NULL, NULL),
(58, 'Djibouti', 'DJ', NULL, NULL),
(59, 'Dominica', 'DM', NULL, NULL),
(60, 'Dominican Republic', 'DO', NULL, NULL),
(61, 'East Timor', 'TP', NULL, NULL),
(62, 'Ecudaor', 'EC', NULL, NULL),
(63, 'Egypt', 'EG', NULL, NULL),
(64, 'El Salvador', 'SV', NULL, NULL),
(65, 'Equatorial Guinea', 'GQ', NULL, NULL),
(66, 'Eritrea', 'ER', NULL, NULL),
(67, 'Estonia', 'EE', NULL, NULL),
(68, 'Ethiopia', 'ET', NULL, NULL),
(69, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL),
(70, 'Faroe Islands', 'FO', NULL, NULL),
(71, 'Fiji', 'FJ', NULL, NULL),
(72, 'Finland', 'FI', NULL, NULL),
(73, 'France', 'FR', NULL, NULL),
(74, 'France, Metropolitan', 'FX', NULL, NULL),
(75, 'French Guiana', 'GF', NULL, NULL),
(76, 'French Polynesia', 'PF', NULL, NULL),
(77, 'French Southern Territories', 'TF', NULL, NULL),
(78, 'Gabon', 'GA', NULL, NULL),
(79, 'Gambia', 'GM', NULL, NULL),
(80, 'Georgia', 'GE', NULL, NULL),
(81, 'Germany', 'DE', NULL, NULL),
(82, 'Ghana', 'GH', NULL, NULL),
(83, 'Gibraltar', 'GI', NULL, NULL),
(84, 'Greece', 'GR', NULL, NULL),
(85, 'Greenland', 'GL', NULL, NULL),
(86, 'Grenada', 'GD', NULL, NULL),
(87, 'Guadeloupe', 'GP', NULL, NULL),
(88, 'Guam', 'GU', NULL, NULL),
(89, 'Guatemala', 'GT', NULL, NULL),
(90, 'Guinea', 'GN', NULL, NULL),
(91, 'Guinea-Bissau', 'GW', NULL, NULL),
(92, 'Guyana', 'GY', NULL, NULL),
(93, 'Haiti', 'HT', NULL, NULL),
(94, 'Heard and Mc Donald Islands', 'HM', NULL, NULL),
(95, 'Honduras', 'HN', NULL, NULL),
(96, 'Hong Kong', 'HK', NULL, NULL),
(97, 'Hungary', 'HU', NULL, NULL),
(98, 'Iceland', 'IS', NULL, NULL),
(99, 'India', 'IN', NULL, NULL),
(100, 'Indonesia', 'ID', NULL, NULL),
(101, 'Iran (Islamic Republic of)', 'IR', NULL, NULL),
(102, 'Iraq', 'IQ', NULL, NULL),
(103, 'Ireland', 'IE', NULL, NULL),
(104, 'Israel', 'IL', NULL, NULL),
(105, 'Italy', 'IT', NULL, NULL),
(106, 'Ivory Coast', 'CI', NULL, NULL),
(107, 'Jamaica', 'JM', NULL, NULL),
(108, 'Japan', 'JP', NULL, NULL),
(109, 'Jordan', 'JO', NULL, NULL),
(110, 'Kazakhstan', 'KZ', NULL, NULL),
(111, 'Kenya', 'KE', NULL, NULL),
(112, 'Kiribati', 'KI', NULL, NULL),
(113, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL),
(114, 'Korea, Republic of', 'KR', NULL, NULL),
(115, 'Kuwait', 'KW', NULL, NULL),
(116, 'Kyrgyzstan', 'KG', NULL, NULL),
(117, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL),
(118, 'Latvia', 'LV', NULL, NULL),
(119, 'Lebanon', 'LB', NULL, NULL),
(120, 'Lesotho', 'LS', NULL, NULL),
(121, 'Liberia', 'LR', NULL, NULL),
(122, 'Libyan Arab Jamahiriya', 'LY', NULL, NULL),
(123, 'Liechtenstein', 'LI', NULL, NULL),
(124, 'Lithuania', 'LT', NULL, NULL),
(125, 'Luxembourg', 'LU', NULL, NULL),
(126, 'Macau', 'MO', NULL, NULL),
(127, 'Macedonia', 'MK', NULL, NULL),
(128, 'Madagascar', 'MG', NULL, NULL),
(129, 'Malawi', 'MW', NULL, NULL),
(130, 'Malaysia', 'MY', NULL, NULL),
(131, 'Maldives', 'MV', NULL, NULL),
(132, 'Mali', 'ML', NULL, NULL),
(133, 'Malta', 'MT', NULL, NULL),
(134, 'Marshall Islands', 'MH', NULL, NULL),
(135, 'Martinique', 'MQ', NULL, NULL),
(136, 'Mauritania', 'MR', NULL, NULL),
(137, 'Mauritius', 'MU', NULL, NULL),
(138, 'Mayotte', 'TY', NULL, NULL),
(139, 'Mexico', 'MX', NULL, NULL),
(140, 'Micronesia, Federated States of', 'FM', NULL, NULL),
(141, 'Moldova, Republic of', 'MD', NULL, NULL),
(142, 'Monaco', 'MC', NULL, NULL),
(143, 'Mongolia', 'MN', NULL, NULL),
(144, 'Montserrat', 'MS', NULL, NULL),
(145, 'Morocco', 'MA', NULL, NULL),
(146, 'Mozambique', 'MZ', NULL, NULL),
(147, 'Myanmar', 'MM', NULL, NULL),
(148, 'Namibia', 'NA', NULL, NULL),
(149, 'Nauru', 'NR', NULL, NULL),
(150, 'Nepal', 'NP', NULL, NULL),
(151, 'Netherlands', 'NL', NULL, NULL),
(152, 'Netherlands Antilles', 'AN', NULL, NULL),
(153, 'New Caledonia', 'NC', NULL, NULL),
(154, 'New Zealand', 'NZ', NULL, NULL),
(155, 'Nicaragua', 'NI', NULL, NULL),
(156, 'Niger', 'NE', NULL, NULL),
(157, 'Nigeria', 'NG', NULL, NULL),
(158, 'Niue', 'NU', NULL, NULL),
(159, 'Norfork Island', 'NF', NULL, NULL),
(160, 'Northern Mariana Islands', 'MP', NULL, NULL),
(161, 'Norway', 'NO', NULL, NULL),
(162, 'Oman', 'OM', NULL, NULL),
(163, 'Pakistan', 'PK', NULL, NULL),
(164, 'Palau', 'PW', NULL, NULL),
(165, 'Panama', 'PA', NULL, NULL),
(166, 'Papua New Guinea', 'PG', NULL, NULL),
(167, 'Paraguay', 'PY', NULL, NULL),
(168, 'Peru', 'PE', NULL, NULL),
(169, 'Philippines', 'PH', NULL, NULL),
(170, 'Pitcairn', 'PN', NULL, NULL),
(171, 'Poland', 'PL', NULL, NULL),
(172, 'Portugal', 'PT', NULL, NULL),
(173, 'Puerto Rico', 'PR', NULL, NULL),
(174, 'Qatar', 'QA', NULL, NULL),
(175, 'Republic of South Sudan', 'SS', NULL, NULL),
(176, 'Reunion', 'RE', NULL, NULL),
(177, 'Romania', 'RO', NULL, NULL),
(178, 'Russian Federation', 'RU', NULL, NULL),
(179, 'Rwanda', 'RW', NULL, NULL),
(180, 'Saint Kitts and Nevis', 'KN', NULL, NULL),
(181, 'Saint Lucia', 'LC', NULL, NULL),
(182, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL),
(183, 'Samoa', 'WS', NULL, NULL),
(184, 'San Marino', 'SM', NULL, NULL),
(185, 'Sao Tome and Principe', 'ST', NULL, NULL),
(186, 'Saudi Arabia', 'SA', NULL, NULL),
(187, 'Senegal', 'SN', NULL, NULL),
(188, 'Serbia', 'RS', NULL, NULL),
(189, 'Seychelles', 'SC', NULL, NULL),
(190, 'Sierra Leone', 'SL', NULL, NULL),
(191, 'Singapore', 'SG', NULL, NULL),
(192, 'Slovakia', 'SK', NULL, NULL),
(193, 'Slovenia', 'SI', NULL, NULL),
(194, 'Solomon Islands', 'SB', NULL, NULL),
(195, 'Somalia', 'SO', NULL, NULL),
(196, 'South Africa', 'ZA', NULL, NULL),
(197, 'South Georgia South Sandwich Islands', 'GS', NULL, NULL),
(198, 'Spain', 'ES', NULL, NULL),
(199, 'Sri Lanka', 'LK', NULL, NULL),
(200, 'St. Helena', 'SH', NULL, NULL),
(201, 'St. Pierre and Miquelon', 'PM', NULL, NULL),
(202, 'Sudan', 'SD', NULL, NULL),
(203, 'Suriname', 'SR', NULL, NULL),
(204, 'Svalbarn and Jan Mayen Islands', 'SJ', NULL, NULL),
(205, 'Swaziland', 'SZ', NULL, NULL),
(206, 'Sweden', 'SE', NULL, NULL),
(207, 'Switzerland', 'CH', NULL, NULL),
(208, 'Syrian Arab Republic', 'SY', NULL, NULL),
(209, 'Taiwan', 'TW', NULL, NULL),
(210, 'Tajikistan', 'TJ', NULL, NULL),
(211, 'Tanzania, United Republic of', 'TZ', NULL, NULL),
(212, 'Thailand', 'TH', NULL, NULL),
(213, 'Togo', 'TG', NULL, NULL),
(214, 'Tokelau', 'TK', NULL, NULL),
(215, 'Tonga', 'TO', NULL, NULL),
(216, 'Trinidad and Tobago', 'TT', NULL, NULL),
(217, 'Tunisia', 'TN', NULL, NULL),
(218, 'Turkey', 'TR', NULL, NULL),
(219, 'Turkmenistan', 'TM', NULL, NULL),
(220, 'Turks and Caicos Islands', 'TC', NULL, NULL),
(221, 'Tuvalu', 'TV', NULL, NULL),
(222, 'Uganda', 'UG', NULL, NULL),
(223, 'Ukraine', 'UA', NULL, NULL),
(224, 'United Arab Emirates', 'AE', NULL, NULL),
(225, 'United Kingdom', 'GB', NULL, NULL),
(226, 'United States', 'US', NULL, NULL),
(227, 'United States minor outlying islands', 'UM', NULL, NULL),
(228, 'Uruguay', 'UY', NULL, NULL),
(229, 'Uzbekistan', 'UZ', NULL, NULL),
(230, 'Vanuatu', 'VU', NULL, NULL),
(231, 'Vatican City State', 'VA', NULL, NULL),
(232, 'Venezuela', 'VE', NULL, NULL),
(233, 'Vietnam', 'VN', NULL, NULL),
(234, 'Virgin Islands (British)', 'VG', NULL, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', NULL, NULL),
(236, 'Wallis and Futuna Islands', 'WF', NULL, NULL),
(237, 'Western Sahara', 'EH', NULL, NULL),
(238, 'Yemen', 'YE', NULL, NULL),
(239, 'Yugoslavia', 'YU', NULL, NULL),
(240, 'Zaire', 'ZR', NULL, NULL),
(241, 'Zambia', 'ZM', NULL, NULL),
(242, 'Zimbabwe', 'ZW', NULL, NULL),
(99991, 'Rest of the World', 'RT', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `order_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE `discount_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'percent',
  `discount` double NOT NULL DEFAULT 0,
  `min_purchased` double NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(154, '0001_01_01_000000_create_users_table', 1),
(155, '0001_01_01_000001_create_cache_table', 1),
(156, '0001_01_01_000002_create_jobs_table', 1),
(157, '2024_07_28_060403_add_role_to_users_table', 1),
(158, '2024_07_29_092127_create_categories_table', 1),
(159, '2024_07_30_144741_create_sub_categories_table', 1),
(160, '2024_07_31_041438_create_brands_table', 1),
(161, '2024_07_31_094417_create_products_table', 1),
(162, '2024_07_31_094826_create_product_images_table', 1),
(163, '2024_08_08_085555_alter_products_table', 1),
(164, '2024_08_10_053205_create_countries_table', 1),
(165, '2024_08_10_053339_alter_users_table', 1),
(166, '2024_08_11_023252_create_discount_coupons_table', 1),
(167, '2024_08_11_045220_create_customer_addresses_table', 1),
(168, '2024_08_11_045521_create_orders_table', 1),
(169, '2024_08_11_045616_create_order_items_table', 1),
(170, '2024_08_12_064726_create_shipping_charges_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_address_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double NOT NULL DEFAULT 0,
  `shipping` double NOT NULL DEFAULT 0,
  `discount_coupon_id` bigint(20) UNSIGNED NOT NULL,
  `discount` double DEFAULT NULL,
  `grand_total` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `total` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `shipping_returns` text DEFAULT NULL,
  `price` double NOT NULL,
  `compare_price` double DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('yes','no') NOT NULL DEFAULT 'no',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('yes','no') NOT NULL DEFAULT 'yes',
  `qty` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `short_description`, `shipping_returns`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Stylish Jacket', 'stylish-jacket', '<p>This jacket is made from high-quality materials, offering both comfort and durability. Perfect for casual outings or party.<br></p>', '<p>A stylish and comfortable jacket for woman.<br></p>', '<p>Free shipping on orders over $50. </p><p>Easy returns within 30 days.<br></p>', 29.99, 39.99, 2, 5, NULL, 'yes', 'WJT-001', '123456789012', 'yes', 100, 1, '2024-08-22 12:27:56', '2024-08-22 12:27:56'),
(2, 'MacBook Pro 14', 'macbook-pro-14', '<p>The MacBook Pro 14 combines a lightweight design with powerful performance. Featuring a 14-inch Full HD display, Intel Core i7 processor, 16GB RAM, and 512GB SSD, it’s perfect for work and play on the go. Enjoy up to 12 hours of battery life, fast charging, and a backlit keyboard.<br></p>', '<p>A sleek and powerful 14-inch laptop designed for professionals.<br></p>', '<p>Free shipping. </p><p>30-day money-back guarantee.<br></p>', 1199.99, 1299.99, 1, 2, 1, 'yes', 'MAC-PRO-14', '987654321098', 'yes', 20, 1, '2024-08-22 12:37:25', '2024-08-22 12:37:25'),
(3, 'Canon EOS R6 Camera', 'canon-eos-r6-camera', '<p>The Canon EOS R6 features a 20.1 MP Full-Frame CMOS sensor, 4K video recording, and Dual Pixel CMOS AF II. With up to 12 fps mechanical shutter and up to 20 fps electronic (silent) shutter, this camera is built for speed and precision. Ideal for professionals and enthusiasts alike.<br></p>', '<p>A versatile mirrorless camera perfect for both photography and videography.<br></p>', '<p>Free shipping on orders over $500.</p><p> 30-day return policy.<br></p>', 2499.99, 2699.99, 1, 3, 2, 'yes', 'CAN-EOS-R6', '123456789000', 'yes', 30, 1, '2024-08-22 12:40:42', '2024-08-22 12:47:22'),
(4, 'Office Chair', 'office-chair', '<p>The Ergonomic Office Chair features adjustable height, lumbar support, and a reclining function. Upholstered in high-quality mesh fabric for breathability and comfort. Perfect for any home or office setup, this chair ensures proper posture and reduced strain during extended work sessions.<br></p>', '<p>A comfortable and adjustable office chair designed for long hours of work.<br></p>', '<p>Free shipping on orders over $75. </p><p>30-day return policy with free returns.<br></p>', 179.99, 199.99, 3, 7, NULL, 'yes', 'CHAIR-2024', '543216789012', 'yes', 10, 1, '2024-08-22 12:45:53', '2024-08-22 12:45:53'),
(5, 'Apple Watch Series 8', 'apple-watch-series-8', '<p>The Apple Watch Series 8 features a sleek design with a large, always-on display. It includes advanced health monitoring capabilities like ECG, blood oxygen, and temperature sensors. With improved durability, fast charging, and seamless integration with iOS devices, it’s perfect for tracking your fitness, health, and daily activities.<br></p>', '<p>The latest Apple Watch with advanced health monitoring and fitness features.<br></p>', '<p>Free shipping on all orders.</p><p> 30-day return policy with free returns.<br></p>', 399.99, 499.99, 2, NULL, 1, 'yes', 'AP-WATCH-8', '678901234567', 'yes', 20, 1, '2024-08-22 12:53:51', '2024-08-22 12:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '1724325988_66c720645a3b3.jpg', 0, '2024-08-22 12:27:56', '2024-08-22 12:27:56'),
(2, 1, '1724325988_66c72064b6222.jpg', 0, '2024-08-22 12:27:56', '2024-08-22 12:27:56'),
(3, 2, '1724326485_66c722559f2e2.jfif', 0, '2024-08-22 12:37:25', '2024-08-22 12:37:25'),
(4, 2, '1724326563_66c722a39bc43.png', 0, '2024-08-22 12:37:25', '2024-08-22 12:37:25'),
(5, 3, '1724326782_66c7237e980c7.jpg', 0, '2024-08-22 12:40:42', '2024-08-22 12:40:42'),
(6, 4, '1724326994_66c72452b2c12.jpg', 0, '2024-08-22 12:45:53', '2024-08-22 12:45:53'),
(7, 5, '1724327561_66c7268969e54.jpg', 0, '2024-08-22 12:53:51', '2024-08-22 12:53:51'),
(8, 5, '1724327561_66c726896c91d.jpg', 0, '2024-08-22 12:53:51', '2024-08-22 12:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 226, 50, '2024-08-22 17:59:07', '2024-08-23 06:16:48'),
(2, 18, 10, '2024-08-22 17:59:20', '2024-08-23 06:17:02'),
(3, 13, 30, '2024-08-22 17:59:36', '2024-08-23 06:17:14'),
(5, 99991, 100, '2024-08-22 19:35:22', '2024-08-22 19:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Mobile Phones', 'mobile-phones', 1, 1, '2024-08-22 11:50:11', '2024-08-22 11:50:11'),
(2, 'Laptops & Computers', 'laptops-computers', 1, 1, '2024-08-22 11:50:31', '2024-08-22 11:50:31'),
(3, 'Cameras & Photography', 'cameras-photography', 1, 1, '2024-08-22 11:50:49', '2024-08-22 11:50:49'),
(4, 'Men\'s Clothing', 'mens-clothing', 1, 2, '2024-08-22 11:51:11', '2024-08-22 11:51:11'),
(5, 'Women\'s Clothing', 'womens-clothing', 1, 2, '2024-08-22 11:51:31', '2024-08-22 11:51:31'),
(6, 'Jewelry', 'jewelry', 1, 2, '2024-08-22 11:52:06', '2024-08-22 11:52:06'),
(7, 'Furniture', 'furniture', 1, 3, '2024-08-22 11:52:32', '2024-08-22 11:52:32'),
(8, 'Kitchen Appliances', 'kitchen-appliances', 1, 3, '2024-08-22 11:52:53', '2024-08-22 11:52:53'),
(9, 'Home Decor', 'home-decor', 1, 3, '2024-08-22 11:53:23', '2024-08-22 11:53:23'),
(10, 'Skincare', 'skincare', 1, 4, '2024-08-22 11:53:44', '2024-08-22 11:53:44'),
(11, 'Hair Care', 'hair-care', 1, 4, '2024-08-22 11:53:57', '2024-08-22 11:53:57'),
(12, 'Makeup & Cosmetics', 'makeup-cosmetics', 1, 4, '2024-08-22 11:54:12', '2024-08-22 11:54:12'),
(13, 'Exercise Equipment', 'exercise-equipment', 1, 5, '2024-08-22 11:54:40', '2024-08-22 11:54:40'),
(14, 'Sportswear', 'sportswear', 1, 5, '2024-08-22 11:55:08', '2024-08-22 11:55:08'),
(15, 'Car Accessories', 'car-accessories', 1, 6, '2024-08-22 11:55:33', '2024-08-22 11:55:33'),
(16, 'Motorcycle Gear', 'motorcycle-gear', 1, 6, '2024-08-22 11:55:57', '2024-08-22 11:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'user@gmail.com', '0123456789', 'user', '2024-08-23 00:36:39', '$2y$12$7qllaHtcy1ksNB/Yj1OvKOiC71gA6ZkHqoyTKxuJmxAXzZSFnHdWa', 'O5F2w6KK2a', '2024-08-23 00:36:40', '2024-08-23 00:36:40'),
(2, 'Test Admin', 'admin@gmail.com', '0123456789', 'admin', '2024-08-23 00:36:40', '$2y$12$XFYvWuDM6mt3ZpPo6kqFoeIOAP0U5MxuU7IKCaUAnS.SUoyjM8ORe', 'Sd8WX3urhe', '2024-08-23 00:36:40', '2024-08-23 00:36:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `discount_coupons_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_customer_address_id_foreign` (`customer_address_id`),
  ADD KEY `orders_discount_coupon_id_foreign` (`discount_coupon_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_charges_country_id_foreign` (`country_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99992;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_address_id_foreign` FOREIGN KEY (`customer_address_id`) REFERENCES `customer_addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_discount_coupon_id_foreign` FOREIGN KEY (`discount_coupon_id`) REFERENCES `discount_coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD CONSTRAINT `shipping_charges_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
