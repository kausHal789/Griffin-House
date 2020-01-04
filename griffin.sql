-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2020 at 03:02 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `griffin`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Film & Animation'),
(2, 'Autos & Vehicles'),
(3, 'Music'),
(4, 'Pets & Animals'),
(5, 'Sports'),
(6, 'Travel'),
(7, 'Events'),
(8, 'Gaming'),
(9, 'People & Blog'),
(10, 'Comedy'),
(11, 'Entertainment'),
(12, 'News & Politics'),
(13, 'Art'),
(14, 'Style'),
(15, 'Education'),
(16, 'Science & Technology'),
(17, 'Non-profit & Activism');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `posted_by` varchar(200) NOT NULL,
  `video_id` int(11) NOT NULL,
  `response_to` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `posted_by`, `video_id`, `response_to`, `body`, `created_at`) VALUES
(2, 'testuser3', 41, 0, 'powejr', '2019-11-04 21:35:05'),
(3, 'testuser3', 41, 0, 'alkre', '2019-11-04 21:35:38'),
(4, 'testuser3', 41, 0, 'oikijdfg', '2019-11-04 21:36:44'),
(5, 'testuser3', 41, 0, 'gjhg', '2019-11-04 21:37:04'),
(6, 'testuser3', 41, 0, 'lasfpodokd', '2019-11-04 21:41:24'),
(7, 'testuser3', 41, 0, 'oj', '2019-11-04 21:47:26'),
(8, 'testuser3', 41, 0, 'lslfsa', '2019-11-04 21:49:21'),
(9, 'testuser3', 41, 0, 'odsjgfopds', '2019-11-04 21:52:03'),
(10, 'testuser3', 41, 0, 'dskfl;ds', '2019-11-04 21:54:36'),
(11, 'testuser3', 41, 0, 'lskkjfs', '2019-11-04 22:45:14'),
(12, 'testuser3', 41, 0, 'pskofs', '2019-11-04 22:49:40'),
(13, 'testuser3', 41, 0, 'jakas', '2019-11-05 09:30:31'),
(14, 'testuser3', 41, 0, 'ojesrgd', '2019-11-05 09:42:38'),
(15, 'testuser3', 41, 0, 'sladkf', '2019-11-05 09:45:08'),
(16, 'testuser3', 41, 0, 'oisjf', '2019-11-05 10:23:14'),
(17, 'testuser3', 41, 0, 'ojrwerf', '2019-11-05 10:48:05'),
(18, 'testuser3', 41, 0, 'lkjdfs', '2019-11-05 11:19:43'),
(19, 'testuser3', 41, 0, 'oidfjgdf', '2019-11-05 11:22:39'),
(20, 'testuser3', 41, 0, 'oijj', '2019-11-05 11:24:02'),
(21, 'testuser3', 41, 0, 'ledflsdff', '2019-11-05 11:24:34'),
(22, 'testuser3', 41, 0, 'skjdjfs', '2019-11-05 11:44:04'),
(23, 'testuser3', 41, 0, 'lsladjf', '2019-11-05 12:17:42'),
(24, 'testuser3', 41, 0, 'sgtdfg', '2019-11-05 12:21:22'),
(25, 'testuser3', 41, 0, 'laskmlsa', '2019-11-05 12:47:54'),
(26, 'testuser3', 41, 0, 'wekfd', '2019-11-05 12:49:10'),
(27, 'testuser3', 41, 0, 'sasldmf', '2019-11-05 12:49:26'),
(28, 'testuser3', 41, 0, 'lsdlmmflds', '2019-11-05 12:50:03'),
(29, 'testuser3', 41, 0, 'lsjd', '2019-11-05 12:51:43'),
(30, 'testuser3', 41, 0, 'alkmdlas', '2019-11-05 12:58:59'),
(31, 'testuser3', 41, 0, 'opaskfosd', '2019-11-05 13:03:18'),
(32, 'testuser3', 41, 0, 'sdlsd\n', '2019-11-05 13:04:09'),
(33, 'testuser3', 41, 0, 'slkfsdl', '2019-11-05 13:05:47'),
(34, 'testuser3', 41, 0, 'sdklfsd', '2019-11-05 13:09:55'),
(35, 'testuser3', 41, 0, 'lsokdjfklsdl', '2019-11-05 13:11:57'),
(36, 'testuser3', 41, 4, 'tako', '2019-11-05 13:55:47'),
(37, 'testuser3', 41, 0, 'new coment', '2019-11-05 14:15:04'),
(38, 'testuser3', 41, 37, 'hello', '2019-11-05 14:27:30'),
(39, 'testuser3', 41, 35, 'hello', '2019-11-05 15:34:34'),
(40, 'testuser3', 41, 39, 'hello there', '2019-11-05 15:34:45'),
(41, 'testuser', 42, 0, 'hello', '2019-11-12 22:27:31'),
(42, 'testuser3', 45, 0, 'hi\n', '2019-11-12 22:29:25'),
(43, 'testuser', 42, 0, 'kasdlknsa', '2019-11-12 22:29:48'),
(44, 'testuser3', 46, 0, 'slkdfksd', '2019-11-12 22:33:24'),
(45, 'testuser3', 46, 0, 'lksdflfd', '2019-11-12 22:34:44'),
(46, 'testuser3', 46, 0, 'lmldfsd', '2019-11-12 22:36:02'),
(47, 'testuser3', 46, 0, 'lklxlkd', '2019-11-12 22:37:00'),
(48, 'testuser3', 46, 0, 'skjfkjf', '2019-11-12 22:37:52'),
(49, 'testuser3', 46, 47, 'lskdfdslk', '2019-11-12 22:38:08'),
(50, 'testuser3', 46, 0, 'almsldd', '2019-11-12 22:38:43'),
(51, 'testuser3', 46, 48, 'lkffglkdf', '2019-11-12 22:39:15'),
(52, 'testuser3', 46, 0, 'kksklskddsk', '2019-11-12 22:40:40'),
(53, 'testuser3', 46, 0, 'skfksf', '2019-11-12 22:45:20'),
(54, 'testuser3', 46, 0, 'lksekjfklsdfsdlk', '2019-11-12 22:46:25'),
(55, 'testuser3', 46, 0, 'ljggffg', '2019-11-12 22:46:43'),
(56, 'testuser3', 46, 55, ';llmesl', '2019-11-12 22:48:49'),
(57, 'testuser3', 46, 54, ',dm,dsnds', '2019-11-12 22:49:10'),
(58, 'testuser3', 46, 0, 'jjkjk', '2019-11-12 22:49:32'),
(59, 'testuser3', 46, 0, 'slsmfsdlkm', '2019-11-12 22:50:03'),
(60, 'testuser3', 46, 0, ',mlsdlsmds', '2019-11-12 22:50:53'),
(61, 'testuser3', 46, 0, 'dsllfmsdlf', '2019-11-12 22:53:12'),
(62, 'testuser3', 46, 0, 'jkj', '2019-11-12 22:55:02'),
(63, 'testuser3', 46, 0, 'slmlsa', '2019-11-12 22:55:36'),
(64, 'testuser3', 46, 0, 'mlksmsa', '2019-11-12 22:55:47'),
(65, 'testuser3', 46, 0, 'sdjdlksd', '2019-11-12 22:56:30'),
(66, 'testuser3', 46, 0, 'lslmlsd', '2019-11-12 22:56:34'),
(67, 'testuser3', 46, 66, 'lmldsmds', '2019-11-12 22:56:38'),
(68, 'testuser3', 46, 66, 'dndskdnsda', '2019-11-12 22:59:04'),
(69, 'testuser3', 46, 0, 'jkjjkjlkjk', '2019-11-12 23:00:09'),
(70, 'testuser3', 46, 69, 'hello', '2019-11-12 23:02:30'),
(71, 'testuser3', 46, 69, 'kfjdkf', '2019-11-12 23:03:27'),
(72, 'testuser3', 46, 65, 'hello', '2019-11-12 23:06:33'),
(73, 'testuser3', 46, 68, 'dlasdla', '2019-11-12 23:06:45'),
(74, 'testuser3', 46, 66, 'kknksz', '2019-11-12 23:06:53'),
(75, 'testuser3', 45, 0, 'hello', '2019-11-12 23:07:58'),
(76, 'testuser3', 45, 75, 'no hello', '2019-11-12 23:08:08'),
(77, 'testuser', 42, 41, 'hiii', '2019-11-12 23:12:49'),
(78, 'testuser', 46, 0, 'really car', '2019-11-12 23:16:17'),
(79, 'testuser', 45, 0, 'this is dog', '2019-11-12 23:17:19'),
(80, 'testuser', 45, 79, 's;lmsd;lds', '2019-11-12 23:17:40'),
(81, 'testuser', 45, 0, 'ksksakdsakdjsal', '2019-11-12 23:17:47'),
(82, 'testuser3', 45, 0, 'adlkaslasdsa', '2019-11-12 23:18:48'),
(83, 'testuser3', 45, 0, 'lkskdjklsdajlkadsjd', '2019-11-12 23:18:56'),
(84, 'testuser', 45, 0, ',m.,sdmsdsd,', '2019-11-12 23:19:23'),
(85, 'testuser3', 45, 0, 'sa,mdldsmsd', '2019-11-12 23:19:36'),
(86, 'testuser', 45, 0, 'slkkjkfsdklds', '2019-11-12 23:19:53'),
(87, 'testuser', 45, 0, 'slms;ldsdlsd', '2019-11-12 23:20:04'),
(88, 'testuser', 45, 85, 'lkjkl', '2019-11-12 23:27:35'),
(89, 'testuser2', 43, 0, 'owww ', '2019-11-12 23:38:53'),
(90, 'testuser3', 43, 89, 'aww', '2019-11-12 23:39:56'),
(91, 'testuser2', 41, 0, 'Dogs', '2019-11-12 23:40:23'),
(92, 'testuser', 49, 0, 'ojdtojdogffdog', '2019-11-13 23:16:30'),
(93, 'testuser', 49, 0, 'lsddsfsldf', '2019-11-13 23:16:59'),
(94, 'testuser', 49, 0, 'lxcnkmvx', '2019-11-13 23:18:40'),
(95, 'testuser3', 49, 0, 'nkldffmd', '2019-11-13 23:19:47'),
(96, 'testuser3', 49, 0, 'sdlknesk', '2019-11-13 23:21:07'),
(97, 'testuser3', 49, 0, 'sjfsdi', '2019-11-13 23:22:43'),
(98, 'testuser3', 49, 0, ',fsdmfsd', '2019-11-13 23:23:15'),
(99, 'testuser3', 49, 0, 'dkldssd', '2019-11-13 23:33:35'),
(100, 'testuser3', 49, 0, 's;lmdslf', '2019-11-13 23:33:49'),
(101, 'testuser3', 49, 0, 'lkzlkxz', '2019-11-13 23:34:21'),
(102, 'testuser3', 49, 0, 'lmcmlxzmzdx', '2019-11-13 23:35:41'),
(103, 'testuser3', 49, 0, 'lxmld', '2019-11-13 23:36:15'),
(104, 'testuser2', 41, 0, 'not bad', '2019-11-23 23:57:31'),
(105, 'testuser2', 48, 0, 'This is public comment', '2019-11-23 23:58:14'),
(106, 'testuser2', 48, 105, 'Comment reply', '2019-11-23 23:58:40'),
(107, 'testuser4', 49, 97, 'hii', '2019-11-24 00:06:21'),
(108, 'testuser', 42, 0, 'Dog!!', '2019-11-24 00:07:34'),
(109, 'testuser4', 42, 108, 'yes dog dude', '2019-11-24 00:08:12'),
(110, 'testuser', 42, 109, 'hmm', '2019-11-24 00:08:33'),
(111, 'testuser3', 49, 103, 'hii', '2019-12-02 08:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `commentid` int(11) NOT NULL,
  `videoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `username`, `commentid`, `videoid`) VALUES
(17, 'testuser3', 0, 31),
(18, 'testuser3', 0, 31),
(19, 'testuser3', 0, 32),
(20, 'testuser3', 0, 32),
(21, 'testuser3', 0, 33),
(22, 'testuser3', 0, 33),
(23, 'testuser3', 0, 33),
(24, 'testuser3', 0, 33),
(25, 'testuser3', 0, 33),
(32, 'testuser2', 0, 41),
(33, 'testuser2', 106, 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `commentid` int(11) NOT NULL,
  `videoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `commentid`, `videoid`) VALUES
(61, 'testuser3', 26, 0),
(68, 'testuser3', 35, 0),
(69, 'testuser3', 4, 0),
(70, 'testuser3', 0, 41),
(71, 'testuser3', 49, 0),
(72, 'testuser3', 47, 0),
(73, 'testuser3', 89, 0),
(74, 'testuser2', 37, 0),
(76, 'testuser2', 0, 48),
(77, 'testuser2', 105, 0),
(78, 'testuser4', 0, 47);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `user_to` varchar(200) NOT NULL,
  `user_from` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `user_to`, `user_from`) VALUES
(34, 'testuser', 'testuser3'),
(35, 'testuser2', 'testuser'),
(36, 'testuser2', 'testuser3'),
(38, 'testuser', 'testuser4');

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `selected` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `video_id`, `url`, `selected`, `created_at`) VALUES
(85, 41, 'storage/public/videos/thumbnails/41-5dbed754632e5-5dbed754632dd.jpg', 0, '2019-11-03 19:04:13'),
(86, 41, 'storage/public/videos/thumbnails/41-5dbed75555889-5dbed7555587f.jpg', 1, '2019-11-03 19:04:14'),
(87, 41, 'storage/public/videos/thumbnails/41-5dbed756ddfed-5dbed756ddfe6.jpg', 0, '2019-11-03 19:04:16'),
(88, 42, 'storage/public/videos/thumbnails/42-5dc192087b01a-5dc192087b013.jpg', 1, '2019-11-05 20:45:21'),
(89, 42, 'storage/public/videos/thumbnails/42-5dc19209bc05f-5dc19209bc052.jpg', 0, '2019-11-05 20:45:23'),
(90, 42, 'storage/public/videos/thumbnails/42-5dc1920b39d73-5dc1920b39d6b.jpg', 0, '2019-11-05 20:45:25'),
(91, 43, 'storage/public/videos/thumbnails/43-5dc194ee8ed89-5dc194ee8ed83.jpg', 1, '2019-11-05 20:57:43'),
(92, 43, 'storage/public/videos/thumbnails/43-5dc194ef6e55f-5dc194ef6e556.jpg', 0, '2019-11-05 20:57:44'),
(93, 43, 'storage/public/videos/thumbnails/43-5dc194f0f1f3c-5dc194f0f1f33.jpg', 0, '2019-11-05 20:57:47'),
(94, 44, 'storage/public/videos/thumbnails/44-5dc19589954dd-5dc19589954d3.jpg', 1, '2019-11-05 21:00:19'),
(95, 44, 'storage/public/videos/thumbnails/44-5dc1958bc65dd-5dc1958bc65d2.jpg', 0, '2019-11-05 21:00:22'),
(96, 44, 'storage/public/videos/thumbnails/44-5dc1958e72179-5dc1958e7216e.jpg', 0, '2019-11-05 21:00:25'),
(97, 45, 'storage/public/videos/thumbnails/45-5dc19597e45c6-5dc19597e45bd.jpg', 1, '2019-11-05 21:00:32'),
(98, 45, 'storage/public/videos/thumbnails/45-5dc195991653b-5dc1959916531.jpg', 0, '2019-11-05 21:00:34'),
(99, 45, 'storage/public/videos/thumbnails/45-5dc1959a8567f-5dc1959a85676.jpg', 0, '2019-11-05 21:00:36'),
(100, 46, 'storage/public/videos/thumbnails/46-5dc8291d6c00e-5dc8291d6bff6.jpg', 1, '2019-11-10 20:43:35'),
(101, 46, 'storage/public/videos/thumbnails/46-5dc8291fc4f4e-5dc8291fc4f34.jpg', 0, '2019-11-10 20:43:37'),
(102, 46, 'storage/public/videos/thumbnails/46-5dc82921830d2-5dc82921830ca.jpg', 0, '2019-11-10 20:43:39'),
(103, 47, 'storage/public/videos/thumbnails/47-5dc82a41ce27e-5dc82a41ce268.jpg', 1, '2019-11-10 20:48:26'),
(104, 47, 'storage/public/videos/thumbnails/47-5dc82a42ce4c0-5dc82a42ce4b9.jpg', 0, '2019-11-10 20:48:28'),
(105, 47, 'storage/public/videos/thumbnails/47-5dc82a443e7e5-5dc82a443e7db.jpg', 0, '2019-11-10 20:48:30'),
(106, 48, 'storage/public/videos/thumbnails/48-5dcae44643027-5dcae44643020.jpg', 0, '2019-11-12 22:26:39'),
(107, 48, 'storage/public/videos/thumbnails/48-5dcae44728205-5dcae447281fb.jpg', 0, '2019-11-12 22:26:40'),
(108, 48, 'storage/public/videos/thumbnails/48-5dcae4484c4b2-5dcae4484c4a9.jpg', 1, '2019-11-12 22:26:41'),
(109, 49, 'storage/public/videos/thumbnails/49-5dcaf72ca2701-5dcaf72ca26f4.jpg', 1, '2019-11-12 23:47:18'),
(110, 49, 'storage/public/videos/thumbnails/49-5dcaf72edd742-5dcaf72edd727.jpg', 0, '2019-11-12 23:47:22'),
(111, 49, 'storage/public/videos/thumbnails/49-5dcaf7321b839-5dcaf7321b82d.jpg', 0, '2019-11-12 23:47:26'),
(112, 50, 'storage/public/videos/thumbnails/50-5dd97e39b2234-5dd97e39b221a.jpg', 1, '2019-11-24 00:15:15'),
(113, 50, 'storage/public/videos/thumbnails/50-5dd97e3b31ad8-5dd97e3b31ace.jpg', 0, '2019-11-24 00:15:17'),
(114, 50, 'storage/public/videos/thumbnails/50-5dd97e3dd9c41-5dd97e3dd9c35.jpg', 0, '2019-11-24 00:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `profile` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `created_at`, `profile`) VALUES
(1, 'testuser', 'Test', 'Userxyz', 'test1@test.com', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', '2019-11-03 14:04:46', 'assets/image/profile image/cat_profile_96px.png'),
(2, 'testuser2', 'Abc', 'Xyz', 'test2@test.com', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', '2019-11-03 14:09:06', 'assets/image/profile image/cat_profile_96px.png'),
(3, 'testuser3', 'Test', 'User', 'test3@test.com', '12b03226a6d8be9c6e8cd5e55dc6c7920caaa39df14aab92d5e3ea9340d1c8a4d3d0b8e4314f1f6ef131ba4bf1ceb9186ab87c801af0d5c95b1befb8cedae2b9', '2019-11-03 14:10:36', 'assets/image/profile image/cat_profile_96px.png'),
(4, 'testuser4', 'Test', 'User', 'test4@test.com', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', '2019-11-24 00:02:55', 'assets/image/profile image/cat_profile_96px.png');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `category` int(11) NOT NULL,
  `privacy` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `views` int(11) NOT NULL,
  `duration` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `username`, `title`, `description`, `category`, `privacy`, `url`, `created_at`, `views`, `duration`) VALUES
(41, 'testuser3', 's;dlfkm', ';ldmfgl', 4, 1, 'storage/public/videos/5dbed73724007.mp4', '2019-11-03 19:04:11', 445, '00:09'),
(42, 'testuser2', 'dog', 'Dog in the snow', 4, 0, 'storage/public/videos/5dc191e8556e8.mp4', '2019-11-05 20:45:19', 13, '00:09'),
(43, 'testuser2', 'kfddfm', 'djvfdkvdf', 14, 0, 'storage/public/videos/5dc194cf5ed69.mp4', '2019-11-05 20:57:41', 10, '00:10'),
(44, 'testuser', 'car', 'This is car', 6, 1, 'storage/public/videos/5dc195307c898.mp4', '2019-11-05 21:00:15', 13, '00:08'),
(45, 'testuser2', 'Littlr dog', 'Playing dog', 4, 0, 'storage/public/videos/5dc1954f9d825.mp4', '2019-11-05 21:00:30', 22, '00:05'),
(46, 'testuser', 'A car', 'Car on the way', 2, 1, 'storage/public/videos/5dc828f6b3207.mp4', '2019-11-10 20:43:31', 27, '00:08'),
(47, 'testuser', 'A girl', 'Girl doing will Computer', 16, 1, 'storage/public/videos/5dc82a272edaa.mp4', '2019-11-10 20:48:25', 7, '00:06'),
(48, 'testuser3', 'A girl with mobile', 'with mobile phone', 14, 1, 'storage/public/videos/5dcae42e2db0c.mp4', '2019-11-12 22:26:36', 4, '00:04'),
(49, 'testuser2', 'Dogs', 'dflmd', 4, 1, 'storage/public/videos/5dcaf6d47bca9.mp4', '2019-11-12 23:47:15', 18, '00:09'),
(50, 'testuser4', 'sdkkfk', 'k', 1, 1, 'storage/public/videos/5dd97dffd685e.mp4', '2019-11-24 00:15:09', 0, '00:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
