-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 15, 2018 lúc 05:03 PM
-- Phiên bản máy phục vụ: 10.1.32-MariaDB
-- Phiên bản PHP: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `royal`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Chan Chan Man', 'admin@gmail.com', '$2y$10$Wz89TQy.unQFp.GHmnAVJue4hwBUAUDIo6tZF5Jnm.KBT3MCI2b.e', NULL, NULL, NULL, '2018-07-21 23:01:45', '2018-07-21 23:01:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inform_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `type`, `inform_name`, `active`, `created_at`, `updated_at`) VALUES
(2, 'Hãng sản xuất', 'select', 'hang-san-xuat', 1, '2018-07-29 01:27:04', '2018-07-29 01:27:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `attribute_id`, `name`, `created_at`, `updated_at`) VALUES
(4, 2, 'Thái Lan', '2018-07-29 01:27:04', '2018-07-29 01:27:04'),
(5, 2, 'Hàn Quốc', '2018-07-29 01:27:04', '2018-07-29 01:27:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `order` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `image`, `order`, `description`, `active`, `created_at`, `updated_at`) VALUES
(2, 0, 'Sen tắm', 'sen-tam', '13851198ce22ffd0b36efe7be6e5a4ab26a305fc3B.jpg', 1, 'Sen tắm nóng lạnh', 1, '2018-07-22 10:39:30', '2018-08-11 20:57:10'),
(3, 0, 'Bồn tắm', 'bon-tam', '7574a4e5a9322a938817b6cabff21361dcdd2b3eTD.jpg', 2, 'Bồn tắm', 1, '2018-08-04 03:49:00', '2018-08-11 20:56:41'),
(4, 2, 'Vòi sen TOTO', 'voi-sen-toto', '72e6831b5c09a9a015622eb9e88dcc1ec6ecc47fQS.jpg', 200, 'vòi sen toto', 1, '2018-08-04 03:54:48', '2018-08-04 03:55:00'),
(5, 2, 'Vòi Lavabo nóng lạnh', 'voi-lavabo-nong-lanh', 'bcc1664e56faef3ba509a6b5dca4ce7a474ecfb3uy.jpg', 1, 'Vòi Lavabo nóng lạnh', 1, '2018-08-11 20:41:09', '2018-08-11 20:41:09'),
(6, 0, 'Vòi chậu', 'voi-chau', 'a5e55567411726be21480698ef526cd764484631a3.jpg', 200, 'vòi chậu', 1, '2018-08-11 21:48:09', '2018-08-11 21:57:21'),
(7, 0, 'Phụ kiện', 'phu-kien', '30276ad64180338cad74aa2b18053763084ba3d1iD.jpg', 200, 'Phụ kiện phòng tắm', 1, '2018-08-11 21:57:02', '2018-08-11 21:57:02'),
(8, 0, 'Chậu rửa', 'chau-rua', '3f2267ee68dbc2f65d18c8771cd10666b18bbbf9Cy.jpg', 200, 'Chậu rửa', 1, '2018-08-11 23:07:54', '2018-08-11 23:07:54'),
(9, 2, 'Sen nóng lạnh', 'sen-nong-lanh', 'be931f0a59923658b96bcbf3f3976f3078b7462bIu.jpg', 200, 'Sen nóng lạnh', 1, '2018-08-12 03:08:56', '2018-08-12 03:08:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_product`
--

CREATE TABLE `category_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_product`
--

INSERT INTO `category_product` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 3, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_21_134600_create_admins_table', 1),
(4, '2018_07_21_043901_create_products_table', 1),
(5, '2018_03_31_083752_create_category_product_table', 2),
(6, '2016_02_15_204651_create_categories_table', 3),
(7, '2018_04_07_074500_create_attribute_table', 3),
(8, '2018_04_07_090508_create_attribute_value_table', 3),
(9, '2018_04_07_090650_create_product_attribute_table', 3),
(10, '2018_08_07_074500_create_attribute_table', 4),
(11, '2018_08_07_090650_create_product_attribute_table', 4),
(12, '2018_07_29_030655_create_attributes_table', 5),
(13, '2018_04_25_155318_create_orders_table', 6),
(14, '2018_04_25_155334_create_order_product_table', 7),
(15, '2018_08_21_043901_create_products_table', 8),
(16, '2018_06_10_093425_create_order_statuses_table', 9),
(17, '2018_06_10_093451_create_payment_methods_table', 9),
(18, '2018_08_25_155318_create_orders_table', 10),
(19, '2018_08_26_155318_create_orders_table', 11),
(20, '2018_09_10_093425_create_order_statuses_table', 12),
(21, '2018_09_10_093451_create_payment_methods_table', 12),
(22, '2018_09_10_093426_create_order_statuses_table', 13),
(23, '2018_09_10_093452_create_payment_methods_table', 13),
(24, '2018_09_10_093427_create_order_statuses_table', 14),
(25, '2018_09_11_093427_create_order_statuses_table', 15),
(26, '2018_09_11_093452_create_payment_methods_table', 16),
(27, '2018_08_05_155725_create_shipping_methods_table', 17),
(28, '2018_09_11_155318_create_orders_table', 18),
(29, '2018_09_11_155319_create_orders_table', 19),
(31, '2018_09_11_093428_create_order_status_table', 20),
(32, '2018_05_20_142712_create_post_tag_table', 21),
(33, '2018_05_20_143825_create_post_topic_table', 21),
(34, '2018_05_20_143846_create_tags_table', 21),
(35, '2018_05_20_145504_create_topics_table', 21),
(36, '2018_05_20_146146_create_posts_table', 21),
(37, '2018_05_20_146147_create_posts_table', 22),
(38, '2018_05_20_143826_create_post_topic_table', 23);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postalcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT '0',
  `discount_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `delivery_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_method_id` int(11) DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `order_status_id` int(11) DEFAULT NULL,
  `customer_message` text COLLATE utf8_unicode_ci,
  `customer_paid` int(11) DEFAULT NULL,
  `order_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `email`, `billing_name`, `address`, `city`, `province`, `postalcode`, `phone`, `card_name`, `card_number`, `discount`, `discount_code`, `subtotal`, `tax`, `total`, `delivery_date`, `shipping_method_id`, `payment_method_id`, `order_status_id`, `customer_message`, `customer_paid`, `order_description`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin@gmail.com', 'Customer', '10 An hoa', 'Hà Nội', 'Ha dong', '1000', '123466799', NULL, NULL, 0, NULL, 38, 0, 38, '2018-07-21', NULL, 1, 0, NULL, NULL, NULL, '2018-08-05 10:12:50', '2018-08-05 10:12:50'),
(2, NULL, 'admin@gmail.com', 'Customer', '10 An hoa', 'Hà Nội', 'Ha dong', '1000', '123466799', NULL, NULL, 0, NULL, 7, 0, 7, '2018-07-21', NULL, 1, 1, NULL, NULL, NULL, '2018-08-05 10:36:57', '2018-08-05 10:36:57'),
(3, NULL, 'admin@gmail.com', 'Customer', '10 An hoa', 'Hà Nội', 'Ha dong', '1000', '123466799', NULL, NULL, 0, NULL, 38, 0, 38, '2018-07-21', NULL, 1, 1, NULL, NULL, NULL, '2018-08-05 10:39:13', '2018-08-05 10:39:13'),
(4, NULL, 'admin@gmail.com', 'Customer', '10 An hoa', 'Hà Nội', 'Ha dong', '1000', '123466799', NULL, NULL, 0, NULL, 38000000, 0, 38000000, '2018-07-21', NULL, 1, 1, NULL, NULL, NULL, '2018-08-05 11:01:02', '2018-08-05 11:01:02'),
(5, NULL, 'admin@gmail.com', 'Customer', '10 An hoa', 'Hà Nội', 'Ha dong', '1000', '123466799', NULL, NULL, 0, NULL, 60800000, 0, 60800000, '2018-07-21', NULL, 1, 1, NULL, NULL, NULL, '2018-08-07 09:10:55', '2018-08-07 09:10:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, '2018-08-05 10:12:50', '2018-08-05 10:12:50'),
(2, 2, 1, 1, '2018-08-05 10:36:57', '2018-08-05 10:36:57'),
(3, 3, 1, 5, '2018-08-05 10:39:13', '2018-08-05 10:39:13'),
(4, 4, 1, 5, '2018-08-05 11:01:02', '2018-08-05 11:01:02'),
(5, 5, 1, 8, '2018-08-07 09:10:55', '2018-08-07 09:10:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_status`
--

CREATE TABLE `order_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_status`
--

INSERT INTO `order_status` (`id`, `name`, `code`, `description`, `details`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 'pending', NULL, NULL, 1, '2018-08-07 09:42:28', '2018-08-07 09:42:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `code`, `description`, `details`, `image`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Chuyển khoản', 'chuyen-khoan', 'Khách hàng chuyển khoản 50%', NULL, NULL, 1, '2018-07-29 09:52:26', '2018-08-05 07:39:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `slug`, `image`, `post_content`, `meta_title`, `meta_desc`, `meta_keyword`, `active`, `featured`, `created_at`, `updated_at`) VALUES
(5, 'Jodie', 'ádasd', 'jodie', '2d7f76711dad6a4f17000ab175f0db8fb3bb240525.jpg', '&aacute;dad', 'ádas', 'sd', 'dasda', 1, 0, '2018-08-11 08:28:59', '2018-08-11 08:28:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_topic`
--

CREATE TABLE `post_topic` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `topic_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_topic`
--

INSERT INTO `post_topic` (`id`, `post_id`, `topic_id`, `created_at`, `updated_at`) VALUES
(3, 5, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `visibility` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `in_stock` tinyint(1) NOT NULL DEFAULT '0',
  `images` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `sort_order` int(11) NOT NULL DEFAULT '100',
  `type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `child_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `slug`, `meta_title`, `meta_desc`, `meta_keyword`, `discount_price`, `price`, `quantity`, `details`, `description`, `featured`, `visibility`, `active`, `in_stock`, `images`, `image`, `sort_order`, `type_id`, `parent_id`, `child_id`, `created_at`, `updated_at`) VALUES
(1, 'Vòi xả bồn nóng lạnh kèm sen tắm Matsu (loại đặt sàn)', 'TBP01301A/TBN01105B', 'voi-xa-bon-nong-lanh-kem-sen-tam-matsu-loai-dat-san', NULL, NULL, NULL, NULL, 7600000, 76, '<ul><li>Thiết kế hiện đại h&agrave;i h&ograve;a với d&ograve;ng sản phẩm New NEOREST - Matsu</li><li>Lớp mạ bền vững với thời gian</li><li>Th&acirc;n van bằng đồng thau</li><li>Van đĩa bằng sứ chống b&aacute;m cặn bẩn gi&uacute;p kh&oacute;a nước ho&agrave;n to&agrave;n</li></ul>', NULL, 1, 0, 1, 1, '[\"478ff4ad3b5fb1a7482dadb170cfc53cc991345ccq.jpg\",\"371426fe1627618d79b9d440a28ccbe0545366c1rT.jpg\"]', NULL, 200, 'simple', NULL, NULL, '2018-07-29 01:20:33', '2018-08-09 09:39:08'),
(2, 'Cút nối tường', 'TBW02013B', 'cut-noi-tuong', NULL, NULL, NULL, NULL, 580000, 100, '<ul><li>Thiết kế hiện đại sang trọng h&agrave;i h&ograve;a</li><li>Lớp mạ bền vững với thời gian</li></ul>', NULL, 1, 0, 1, 1, '[\"c3116a2254f731d13b9674bcff6952bca19d0af9xw.jpg\"]', NULL, 200, 'simple', NULL, NULL, '2018-07-29 01:25:10', '2018-07-30 10:49:07'),
(3, 'Vòi xả bồn nóng lạnh kèm sen tắm LB (4 lỗ)', 'TBS01202B', 'voi-xa-bon-nong-lanh-kem-sen-tam-lb-4-lo', NULL, NULL, NULL, NULL, 1100000, 100, '<ul><li>Thiết kế hiện đại h&agrave;i h&ograve;a với d&ograve;ng sản phẩm LB</li><li>Lớp mạ bền vững với thời gian</li><li>Th&acirc;n van bằng đồng thau</li><li>Van đĩa bằng sứ chống b&aacute;m cặn bẩn gi&uacute;p kh&oacute;a nước ho&agrave;n to&agrave;n</li></ul>', NULL, 1, 0, 0, 0, '[\"058df7cc8158399a3c7cceb14c6c0db91c97d1d1an.jpg\"]', NULL, 200, 'simple', NULL, NULL, '2018-07-29 01:28:58', '2018-08-11 02:03:26'),
(4, 'Sen cây nóng lạnh 2 chế độ massage (bát sen tròn),', 'TBW01303B', 'sen-cay-nong-lanh-2-che-do-massage-bat-sen-tron', NULL, NULL, NULL, NULL, 16000000, 100, '<ul><li>Thiết kế sang trọng</li><li>Lớp mạ bền vững với thời gian</li><li>Th&acirc;n van bằng đồng thau</li></ul>', NULL, 0, 0, 0, 0, '[\"580ccd74e17622a93f3a6628a9737631bf6a5784Aj.jpg\"]', NULL, 200, 'simple', '[6]', NULL, '2018-07-29 01:30:33', '2018-07-29 01:42:18'),
(5, 'Bát sen mạ (bao gồm gác sen)', 'TBW02017A', 'bat-sen-ma-bao-gom-gac-sen', NULL, NULL, NULL, NULL, 1500000, 100, '<ul><li>Thiết kế hiện đại, sang trọng</li><li>Lớp mạ bền vững với thời gian</li></ul>', NULL, 0, 0, 1, 0, '[\"df47022be563910123ff0afadaf76e3017386396xA.jpg\"]', NULL, 200, 'simple', '[6]', NULL, '2018-07-29 01:32:25', '2018-07-29 01:42:18'),
(6, 'Bộ tủ, chậu kệ gương Lavabo mini ZT-LV942', 'ZT-LV942', 'bo-tu-chau-ke-guong-lavabo-mini-zt-lv942', NULL, NULL, NULL, NULL, 3000000, 5, NULL, 'Bộ tủ, chậu & kệ gương Lavabo là sự kết hợp hoàn hảo giữa chậu lavabo, gương & tủ đựng đồ giúp bạn sắp xếp các vật dụng một cách gọn gàng, tiện lợi khi sử dụng đồng thời tạo phong cách hiện đại, thời thượng cho phòng tắm của gia đình', 0, 0, 1, 0, '[\"a7e02cba3906a7d1cecd16ebf385f9ee4f99d07bJF.jpg\",\"25410eee201674cbc2e6a6d84614639a09fd11c11n.jpg\",\"8c5c90c3f38c359345bd9452a2d3f5782335df3cKP.jpg\",\"aa669cfc5411f1ab6fd3b7c557ee4d17f0899e8avl.jpg\"]', NULL, 100, 'group', NULL, '[5,4]', '2018-07-29 01:42:18', '2018-07-30 10:47:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `attribute_value_id` int(10) UNSIGNED NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `product_id`, `attribute_value_id`, `active`, `created_at`, `updated_at`) VALUES
(3, 1, 4, 0, '2018-07-29 01:27:15', '2018-08-09 09:39:08'),
(4, 5, 4, 0, '2018-07-29 01:32:25', '2018-07-29 01:32:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`, `code`, `price`, `description`, `details`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Free Ship', 'free-ship', '0', NULL, NULL, 1, '2018-08-05 10:02:15', '2018-08-07 08:57:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `topics`
--

CREATE TABLE `topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `topics`
--

INSERT INTO `topics` (`id`, `name`, `slug`, `description`, `parent_id`, `active`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Bài mới', 'bai-moi', NULL, 0, NULL, NULL, '2018-08-11 08:13:03', '2018-08-11 08:13:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `birthday`, `gender`, `address`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Chan Chan Man', 'customer@gmail.com', '$2y$10$RqXTQhJhgTEU9gi4UqzISOf3SLoxMmafb.YkBpuOJWqNBFyWoWTVq', NULL, NULL, NULL, NULL, NULL, '2018-07-21 23:01:45', '2018-07-21 23:01:45');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Chỉ mục cho bảng `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attributes_name_unique` (`name`),
  ADD UNIQUE KEY `attributes_inform_name_unique` (`inform_name`);

--
-- Chỉ mục cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_topic`
--
ALTER TABLE `post_topic`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `topics_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `post_topic`
--
ALTER TABLE `post_topic`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
