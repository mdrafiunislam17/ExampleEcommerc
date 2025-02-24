-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 06:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example_ecommerc`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `text2` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `association_web_links`
--

CREATE TABLE `association_web_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `web_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `association_web_links`
--

INSERT INTO `association_web_links` (`id`, `name`, `web_url`, `created_at`, `updated_at`) VALUES
(1, 'Sean Carver', 'https://www.qimebifal.us', '2025-02-19 10:09:14', '2025-02-19 10:09:14'),
(3, 'asif', 'https://www.rol.com', '2025-02-19 10:12:06', '2025-02-19 10:38:32'),
(4, 'rafiun', 'https://www.peca.cm', '2025-02-19 10:22:48', '2025-02-19 10:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lars Golden', 'Dignissimos assumend', '1739592816.jpg', 'Veritatis quia aut n', 'inactive', '2025-02-14 22:13:38', '2025-02-14 22:13:38'),
(2, 'Omar Vance', 'Et sequi et expedita', '1739592855.jpg', 'Non accusamus nisi m', 'active', '2025-02-14 22:14:15', '2025-02-14 22:14:15'),
(3, 'Sierra Mcguire', 'Tempor expedita pers', NULL, 'Praesentium laborum', 'active', '2025-02-14 22:14:25', '2025-02-14 22:14:25'),
(4, 'Porter Mccormick', 'Ex et quaerat cillum', '1739592878.jpg', 'Magna dolores ex vol', 'active', '2025-02-14 22:14:38', '2025-02-14 22:14:38'),
(5, 'Quynn Clark', 'Impedit dolor excep', NULL, 'Necessitatibus est q', 'inactive', '2025-02-14 22:14:47', '2025-02-14 22:14:47'),
(6, 'Hall Booker', 'Necessitatibus et pr', NULL, 'Dolor rem voluptatib', 'active', '2025-02-14 22:14:54', '2025-02-14 22:14:54'),
(7, 'Marah Roman', 'Dolorum aliqua Cum', NULL, 'Qui exercitationem a', 'inactive', '2025-02-14 22:15:01', '2025-02-14 22:15:01'),
(8, 'Juliet Wiggins', 'Aut hic quidem nulla', NULL, 'Velit molestiae et a', 'inactive', '2025-02-14 22:15:06', '2025-02-14 22:15:06'),
(9, 'Cain Ray', 'Nisi fugit molestia', NULL, 'Omnis in id deserun', 'inactive', '2025-02-14 22:15:12', '2025-02-14 22:15:12'),
(10, 'Drew Mcmahon', 'Et ratione aut a fac', NULL, 'Sunt tempora itaque', 'inactive', '2025-02-14 22:15:20', '2025-02-14 22:15:20'),
(11, 'Lev Hays', 'Optio qui sunt qui', NULL, 'Amet praesentium co', 'active', '2025-02-14 22:15:26', '2025-02-14 22:15:26'),
(12, 'Nathan Shaw', 'Duis laborum Maxime', NULL, 'Qui recusandae Quid', 'active', '2025-02-14 22:15:34', '2025-02-14 22:15:34'),
(13, 'Liberty Mcmahon', 'Rerum autem adipisci', NULL, 'Nostrum aute volupta', 'active', '2025-02-14 22:15:42', '2025-02-14 22:15:42'),
(14, 'Caleb Lynch', 'Iusto in quisquam ut', '1739593345.png', 'Voluptates ut dolore', 'inactive', '2025-02-14 22:22:25', '2025-02-14 22:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_testimonials`
--

CREATE TABLE `client_testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_testimonials`
--

INSERT INTO `client_testimonials` (`id`, `name`, `designation`, `image`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Sydney Curry', 'Consequuntur volupta', '1740416875.png', 'Veniam quam neque e', '2025-02-24 11:07:55', '2025-02-24 11:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `customer_categories`
--

CREATE TABLE `customer_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_categories`
--

INSERT INTO `customer_categories` (`id`, `name`, `sort`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Merritt Obrien', 11, NULL, 1, '2025-02-16 10:24:34', '2025-02-16 10:24:34'),
(2, 'Merritt Obriena', 11, NULL, 0, '2025-02-16 10:25:26', '2025-02-16 10:30:06'),
(3, 'Malik Santiago', 97, NULL, 1, '2025-02-16 10:26:35', '2025-02-16 10:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `capacity` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
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
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Deleniti lorem nostr', '2025-02-12 09:29:42', '2025-02-12 09:29:42'),
(2, 'Quod fugiat id minu', '2025-02-12 09:33:35', '2025-02-12 09:33:35'),
(3, 'Quod fugiat id minu', '2025-02-12 09:36:39', '2025-02-12 09:36:39'),
(4, 'Quod fugiat id minu', '2025-02-12 09:38:26', '2025-02-12 09:38:26'),
(5, 'Quibusdam ipsum ea s', '2025-02-12 09:38:40', '2025-02-12 09:38:40'),
(7, 'aa', '2025-02-12 09:54:51', '2025-02-12 09:54:51'),
(8, 'zzz', '2025-02-12 09:57:07', '2025-02-12 09:57:07'),
(9, 'aa', '2025-02-12 09:58:08', '2025-02-12 09:58:08'),
(10, 'aas', '2025-02-12 10:01:06', '2025-02-12 10:01:06'),
(11, 'Labore cillum enim s', '2025-02-12 10:04:18', '2025-02-12 10:04:18'),
(12, 'Labore cillum enim s', '2025-02-12 10:08:15', '2025-02-12 10:08:15'),
(13, 'aa', '2025-02-12 10:08:27', '2025-02-12 10:08:27'),
(14, 'aaaa', '2025-02-12 10:09:20', '2025-02-12 10:09:20'),
(15, 'hhh', '2025-02-12 10:32:42', '2025-02-12 10:32:42'),
(16, 'Ipsum anim possimus', '2025-02-12 10:36:39', '2025-02-12 10:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_id` bigint(20) UNSIGNED NOT NULL,
  `sort` int(10) UNSIGNED DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `thumbs` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items`
--

CREATE TABLE `gallery_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_notices`
--

CREATE TABLE `job_notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_notices`
--

INSERT INTO `job_notices` (`id`, `title`, `description`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'In odio dignissimos', 'Deserunt ipsum odit', 'Ad ratione tenetur e', 'active', '2025-02-15 12:15:16', '2025-02-16 07:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_02_10_134801_create_menus_table', 1),
(7, '2025_02_10_135322_create_sub_menus_table', 1),
(8, '2025_02_10_142348_create_projects_table', 1),
(9, '2025_02_10_142751_create_says_table', 1),
(10, '2025_02_10_143342_create_sliders_table', 1),
(11, '2025_02_10_143643_create_gallery_items_table', 1),
(12, '2025_02_10_145841_create_members_table', 1),
(13, '2025_02_10_150035_create_activities_table', 1),
(14, '2025_02_10_150218_create_clients_table', 1),
(15, '2025_02_10_150411_create_certificates_table', 1),
(16, '2025_02_10_150617_create_equipment_table', 1),
(17, '2025_02_10_150816_create_product_categories_table', 1),
(18, '2025_02_10_151038_create_products_table', 1),
(19, '2025_02_10_151634_create_product_images_table', 1),
(20, '2025_02_10_152009_create_galleries_table', 1),
(21, '2025_02_10_152322_create_gallery_images_table', 1),
(22, '2025_02_10_152705_create_customer_categories_table', 1),
(23, '2025_02_10_153232_create_online_jobs_table', 1),
(24, '2025_02_10_153710_create_client_testimonials_table', 1),
(25, '2025_02_10_154259_create_association_web_links_table', 1),
(26, '2025_02_10_154454_create_services_table', 1),
(27, '2025_02_10_154727_create_trackers_table', 1),
(28, '2025_02_10_155917_create_product_sub_categories_table', 2),
(30, '2025_02_11_155434_create_abouts_table', 3),
(31, '2025_02_14_152904_create_brands_table', 4),
(33, '2025_02_14_154457_add_brand_id_to_products_table', 5),
(34, '2025_02_15_151722_add_price_to_products_table', 6),
(35, '2025_02_15_164453_create_job_notices_table', 7),
(36, '2025_02_16_144611_add_cv_to_online_jobs_table', 8),
(38, '2025_02_21_030158_create_teams_table', 9),
(39, '2025_02_23_133809_create_news_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `name`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Brody Stewart', '1740418183.jpeg', '<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2025-02-24 11:11:15', '2025-02-24 11:29:43'),
(4, 'Anika Brooks', '1740418198.png', '<p>chidljf/as;d</p>', '2025-02-24 11:21:27', '2025-02-24 11:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `online_jobs`
--

CREATE TABLE `online_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '1 = Male, 2 = Female',
  `martial_status` tinyint(4) NOT NULL COMMENT '1 = Single, 2 = Married, 3 = Divorced, 4 = Widowed',
  `national_id` varchar(255) NOT NULL,
  `religion_status` varchar(255) NOT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `cv` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `online_jobs`
--

INSERT INTO `online_jobs` (`id`, `name`, `father_name`, `mother_name`, `date_of_birth`, `gender`, `martial_status`, `national_id`, `religion_status`, `present_address`, `permanent_address`, `email`, `mobile`, `photo`, `cv`, `created_at`, `updated_at`) VALUES
(1, 'Alec Mullins', 'Honorato Mcclain', 'Tyler Weber', '1997-07-11', 2, 3, 'Voluptatem pariatur', 'Accusantium non odit', 'Voluptates earum vol', 'Cupidatat ea odio do', 'nohaluxox@mailinator.com', '01928784783', 'photos/FHGNCCamR1DVXg4fQmGxCY3To8vWzpuuRXrsdvlM.png', 'cvs/DykXYavN8Ly8Mx12Xw34raKETZiq2hHyaNsf5vVM.pdf', '2025-02-17 08:34:35', '2025-02-17 08:34:35'),
(2, 'Noel Gaines', 'Donovan Richards', 'Boris Hernandez', '2000-02-12', 2, 3, 'Iure iste ab occaeca', 'Quaerat magnam dolor', 'Soluta labore volupt', 'Modi fugiat ipsum', 'hosohiw@mailinator.com', '1833452353', 'photos/R1IoCKNjJ1kdgcjlhoQ6cKfbjOZEk1VPU0HNxtzZ.jpg', 'cvs/mC0crmEV39KeKLajGYs6tmr30yQnzYjmdkSlMK5Q.pdf', '2025-02-17 08:48:18', '2025-02-17 08:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `description`, `slug`, `status`, `created_at`, `updated_at`, `brand_id`) VALUES
(1, 'Meredith Duke', NULL, 9, 'Provident ad minim', 'Expedita rem esse r', 'active', '2025-02-15 08:58:40', '2025-02-15 08:58:40', 12),
(2, 'Rhea Adkins', NULL, 9, 'Ex velit non pariatu', 'Voluptas eos praesen', 'inactive', '2025-02-15 08:59:56', '2025-02-15 08:59:56', 3),
(3, 'Lester Kinney', 407.00, 14, 'Sed recusandae Exer', 'Voluptatum voluptate', 'active', '2025-02-15 09:34:08', '2025-02-15 09:34:08', 1),
(4, 'Yvonne Deleon', 38.00, 13, 'Aliquip ad animi in', 'Impedit qui autem a', 'inactive', '2025-02-15 09:36:46', '2025-02-15 09:36:46', 13),
(5, 'Yvonne Deleon', 38.00, 13, 'Aliquip ad animi in', 'Impedit qui autem a', 'inactive', '2025-02-15 09:36:49', '2025-02-15 09:36:49', 13),
(6, 'Yvonne Deleon', 38.00, 13, 'Aliquip ad animi in', 'Impedit qui autem a', 'inactive', '2025-02-15 09:36:51', '2025-02-15 09:36:51', 13),
(7, 'Yvonne Deleon', 38.00, 13, 'Aliquip ad animi in', 'Impedit qui autem a', 'inactive', '2025-02-15 09:36:53', '2025-02-15 09:36:53', 13),
(8, 'Fleur Knight', 333.00, 6, 'Neque eiusmod distin', 'Ex magnam neque volu', 'active', '2025-02-15 09:40:38', '2025-02-15 09:40:38', 13),
(9, 'Fleur Knight', 333.00, 6, 'Neque eiusmod distin', 'Ex magnam neque volu', 'active', '2025-02-15 09:40:43', '2025-02-15 09:40:43', 13),
(10, 'Fleur Knight', 333.00, 6, 'Neque eiusmod distin', 'Ex magnam neque volu', 'active', '2025-02-15 09:40:46', '2025-02-15 09:40:46', 13),
(11, 'Fleur Knight', 333.00, 6, 'Neque eiusmod distin', 'Ex magnam neque volu', 'active', '2025-02-15 09:40:46', '2025-02-15 09:40:46', 13),
(12, 'Ferdinand Ramos', 457.00, 11, 'Enim consectetur ir', 'Aut illum pariatur', 'active', '2025-02-15 09:43:31', '2025-02-15 09:43:31', 13),
(13, 'Sharon Branch', 125.00, 8, 'Cupiditate suscipit', 'Distinctio Ut repre', 'active', '2025-02-15 09:45:17', '2025-02-15 09:45:17', 10),
(14, 'Sharon Branch', 125.00, 8, 'Cupiditate suscipit', 'Distinctio Ut repre', 'active', '2025-02-15 09:45:21', '2025-02-15 09:45:21', 10),
(15, 'Dahlia Padilla', 725.00, 16, 'Accusamus do dolore', 'Unde sed molestiae q', 'active', '2025-02-15 09:45:31', '2025-02-15 09:45:31', 12),
(16, 'Timon Wright', 826.00, 7, 'Enim quas deleniti a', 'Temporibus perferend', 'active', '2025-02-15 09:49:31', '2025-02-15 10:18:25', 11),
(17, 'Frances Craig', 490.00, 11, 'Tempora enim aut eos', 'Odio voluptatem bea', 'active', '2025-02-15 09:51:32', '2025-02-15 09:51:32', 12),
(18, 'Peter Stewart', 57.00, 11, 'Dolorem dolor tempor', 'Vitae voluptate ut r', 'active', '2025-02-15 09:55:08', '2025-02-15 09:55:08', 9),
(19, 'Peter Stewart', 57.00, 11, 'Dolorem dolor tempor', 'Vitae voluptate ut r', 'active', '2025-02-15 09:55:46', '2025-02-15 09:55:46', 9),
(20, '11Peter Stewart', 57.00, 11, 'Dolorem dolor tempor', 'Vitae voluptate ut r', 'active', '2025-02-15 09:56:31', '2025-02-15 10:11:47', 9);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `sort`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Morgan Schwartz', 13, 'Dolores id atque at', 'active', '2025-02-15 01:11:26', '2025-02-15 02:43:57'),
(7, 'Tatum Maxwell', 43, 'Doloribus voluptates', 'active', '2025-02-15 02:29:42', '2025-02-15 02:29:42'),
(8, 'Colorado Schneider', 40, 'Hic pariatur Eaque', 'active', '2025-02-15 02:44:06', '2025-02-15 02:44:06'),
(9, 'Aimee Garza', 41, 'Aliquam quia itaque', 'inactive', '2025-02-15 02:44:14', '2025-02-15 02:44:14'),
(10, 'Bruce Hunt', 85, 'Ullamco eum velit v', 'inactive', '2025-02-15 02:44:27', '2025-02-15 02:44:27'),
(11, 'Emerald Pratt', 95, 'Suscipit tempora sol', 'inactive', '2025-02-15 02:44:35', '2025-02-15 02:44:35'),
(12, 'Alika Cleveland', 88, 'Laboriosam reprehen', 'active', '2025-02-15 02:44:42', '2025-02-15 02:44:42'),
(13, 'Erich Galloway', 31, 'Eius est nihil earu', 'active', '2025-02-15 02:44:49', '2025-02-15 02:44:49'),
(14, 'Aristotle Delgado', 47, 'Inventore irure alia', 'active', '2025-02-15 02:44:55', '2025-02-15 02:44:55'),
(15, 'Kuame Singleton', 93, 'Sed qui explicabo N', 'active', '2025-02-15 02:45:05', '2025-02-15 02:45:05'),
(16, 'Finn Anderson', 60, 'Reprehenderit neces', 'active', '2025-02-15 02:45:13', '2025-02-15 02:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `sort` int(10) UNSIGNED DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `thumbs` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `product_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = Inactive, 1 = Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `says`
--

CREATE TABLE `says` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `show_home` tinyint(1) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sort` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `subheading` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `sort`, `image`, `heading`, `subheading`, `color`, `created_at`, `updated_at`) VALUES
(4, 100, '1739507234.jpeg', 'Et quia odio et volu', 'Assumenda similique', NULL, '2025-02-13 22:27:14', '2025-02-13 22:27:14'),
(5, 23, '1739513722.jpg', 'Dolores corrupti ex', 'Sint ea irure laudan', NULL, '2025-02-14 00:15:22', '2025-02-14 00:15:22'),
(6, 82, '1739513737.jpg', 'Quasi et et neque ut', 'In itaque dolor ut q', NULL, '2025-02-14 00:15:37', '2025-02-14 00:15:37'),
(7, 88, '1739513751.jpg', 'Odio qui veniam pro', 'Non eiusmod molestia', NULL, '2025-02-14 00:15:51', '2025-02-14 00:15:51'),
(8, 67, '1739513769.png', 'Inventore asperiores', 'Ad nulla magni id la', NULL, '2025-02-14 00:16:09', '2025-02-14 00:16:09'),
(9, 91, '1739513783.jpg', 'Error quam dolores n', 'Ullamco iste fuga M', NULL, '2025-02-14 00:16:24', '2025-02-14 00:16:24'),
(10, 20, '1739513803.png', 'Non sed animi conse', 'Omnis autem exercita', NULL, '2025-02-14 00:16:43', '2025-02-14 00:16:43'),
(11, 94, '1739513821.jpg', 'Velit rerum porro qu', 'Elit est inventore', NULL, '2025-02-14 00:17:01', '2025-02-14 00:17:01'),
(12, 14, '1739513850.jpg', 'Ea culpa dolorum sun', 'Repudiandae eligendi', NULL, '2025-02-14 00:17:30', '2025-02-14 00:17:30'),
(13, 77, '1739513870.png', 'Qui consectetur elit', 'Placeat laboris vel', NULL, '2025-02-14 00:17:50', '2025-02-14 00:17:50'),
(14, 35, '1739513893.jpg', 'Repudiandae mollitia', 'Culpa recusandae Es', NULL, '2025-02-14 00:18:13', '2025-02-14 00:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE `sub_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `sort` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `title`, `image`, `sort`, `created_at`, `updated_at`) VALUES
(1, NULL, '1740108310.png', 29, '2025-02-20 21:25:10', '2025-02-20 21:25:10'),
(2, NULL, '1740108333.jpeg', 52, '2025-02-20 21:25:33', '2025-02-20 21:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `trackers`
--

CREATE TABLE `trackers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` text NOT NULL,
  `visit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$s4VnHomU1PNs6IIjOGppjOpwJ/Prfespx0npC/8q/IC1KFWPg0qXO', NULL, '2025-02-11 09:05:37', '2025-02-11 09:05:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `association_web_links`
--
ALTER TABLE `association_web_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `association_web_links_web_url_unique` (`web_url`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_testimonials`
--
ALTER TABLE `client_testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_categories`
--
ALTER TABLE `customer_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_images_gallery_id_foreign` (`gallery_id`);

--
-- Indexes for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_notices`
--
ALTER TABLE `job_notices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_notices_slug_unique` (`slug`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_jobs`
--
ALTER TABLE `online_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `online_jobs_national_id_unique` (`national_id`),
  ADD UNIQUE KEY `online_jobs_email_unique` (`email`),
  ADD UNIQUE KEY `online_jobs_mobile_unique` (`mobile`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sub_categories_service_id_foreign` (`service_id`),
  ADD KEY `product_sub_categories_product_category_id_foreign` (`product_category_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `says`
--
ALTER TABLE `says`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_menus_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trackers`
--
ALTER TABLE `trackers`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `association_web_links`
--
ALTER TABLE `association_web_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_testimonials`
--
ALTER TABLE `client_testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_categories`
--
ALTER TABLE `customer_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_items`
--
ALTER TABLE `gallery_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_notices`
--
ALTER TABLE `job_notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `online_jobs`
--
ALTER TABLE `online_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `says`
--
ALTER TABLE `says`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trackers`
--
ALTER TABLE `trackers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD CONSTRAINT `gallery_images_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD CONSTRAINT `product_sub_categories_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_sub_categories_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD CONSTRAINT `sub_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
