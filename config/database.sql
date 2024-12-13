-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 02:15 AM
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
-- Database: `game`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `account_id`) VALUES
(3, 14),
(6, 16),
(7, 20);

-- --------------------------------------------------------

--
-- Table structure for table `bai_bao`
--

CREATE TABLE `bai_bao` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bai_bao`
--

INSERT INTO `bai_bao` (`id`, `description`, `image_url`, `title`) VALUES
(1, 'Game 1: The Adventure Begins', 'https://149455152.v2.pressablecdn.com/wp-content/uploads/2020/09/DDAB_title-image.jpg', 'This is the first popular game article about an epic adventure'),
(2, 'Game 2: Mystery Unfolded', 'https://img.freepik.com/free-vector/old-witch-with-spell-book-cartoon-style-dark-cave-background_1308-45301.jpg', 'Dive into the mystery of Game 2, where every decision counts.'),
(3, 'Game 3: The Final Showdown', 'https://i0.wp.com/news.qoo-app.com/en/wp-content/uploads/sites/3/2023/04/Virtua-Fighter-5-Final-Showdown-Strikes-The-King-of-Fighters-Allstar-in-Exciting-Collab-Starting-April-25.jpg?w=1200&ssl=1', 'Prepare for the ultimate battle in Game 3, the final chapter of the series.'),
(4, 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `bao_loi`
--

CREATE TABLE `bao_loi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `error_description` text DEFAULT NULL,
  `ngay_bao_loi` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id`, `order_id`, `game_id`, `quantity`) VALUES
(48, 51, 14, 1),
(50, 53, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `danh_gia`
--

CREATE TABLE `danh_gia` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `score` int(11) DEFAULT NULL CHECK (`score` between 1 and 5),
  `comment` text DEFAULT NULL,
  `review_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date DEFAULT curdate(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `payment_status` varchar(20) DEFAULT 'Unpaid',
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id`, `user_id`, `order_date`, `total_amount`, `status`, `payment_status`, `payment_method`, `payment_date`) VALUES
(51, 11, '2024-12-13', 47.99, 'Paid', 'Paid', NULL, '2024-12-13'),
(53, 17, '2024-12-13', 18.99, 'Paid', 'Paid', NULL, '2024-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `game_name` varchar(100) NOT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `downloads` int(11) DEFAULT 0,
  `release_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `avt` varchar(255) DEFAULT NULL,
  `background` varchar(255) DEFAULT NULL,
  `introduction` text DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `download_link` varchar(255) DEFAULT NULL,
  `recOS` varchar(50) DEFAULT NULL,
  `recProcessor` varchar(100) DEFAULT NULL,
  `recMemory` varchar(50) DEFAULT NULL,
  `recGraphics` varchar(100) DEFAULT NULL,
  `recDirectX` varchar(50) DEFAULT NULL,
  `recStorage` varchar(50) DEFAULT NULL,
  `minOS` varchar(50) DEFAULT NULL,
  `minProcessor` varchar(100) DEFAULT NULL,
  `minMemory` varchar(50) DEFAULT NULL,
  `minGraphics` varchar(100) DEFAULT NULL,
  `minDirectX` varchar(50) DEFAULT NULL,
  `minStorage` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `game_name`, `publisher`, `genre`, `price`, `discount`, `downloads`, `release_date`, `description`, `avt`, `background`, `introduction`, `rating`, `download_link`, `recOS`, `recProcessor`, `recMemory`, `recGraphics`, `recDirectX`, `recStorage`, `minOS`, `minProcessor`, `minMemory`, `minGraphics`, `minDirectX`, `minStorage`) VALUES
(1, 'Call of Duty: Modern Warfare', 'Activision', 'Action', 59.99, 10.00, 1000, '2022-01-01', 'A thrilling action-packed shooter game', 'https://th.bing.com/th/id/R.0eaceca7a69ff7adfeeae1595d771a46?rik=a5kxZMQI6KeRcg&pid=ImgRaw&r=0', 'https://th.bing.com/th/id/R.54dad2bead7efddfd032a9d8011a0b36?rik=KjPnjSdRhYW2Mw&pid=ImgRaw&r=0', 'Introduction to the Call of Duty franchise', 4.50, 'https://example.com/cod', 'Windows 10', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 12', '100GB', 'Windows 7', 'Intel i3', '4GB', 'NVIDIA GTX 950', 'DirectX 11', '50GB'),
(2, 'The Legend of Zelda: Breath of the Wild', 'Nintendo', 'Adventure', 39.99, 5.00, 500, '2021-05-01', 'An exciting open-world adventure game', 'https://th.bing.com/th/id/R.91a8626adf47815328cc9d82b6e3de3a?rik=uBT1b9Q8%2b9JYPA&pid=ImgRaw&r=0', 'https://assets.nintendo.com/image/upload/v1681238674/Microsites/zelda-tears-of-the-kingdom/videos/posters/totk_microsite_officialtrailer3_1304xj47am', 'Introduction to the new Zelda universe', 4.00, 'https://example.com/zelda', 'Switch', 'NVIDIA Custom Tegra', '4GB', 'NVIDIA Custom Tegra', NULL, '14GB', 'Switch', 'NVIDIA Custom Tegra', '4GB', 'NVIDIA Custom Tegra', NULL, '14GB'),
(3, 'Elden Ring', 'Bandai Namco', 'Action', 69.99, 0.00, 1500, '2023-06-15', 'A fantastic cooperative RPG game', 'https://th.bing.com/th/id/R.4639fed79ca6fd43c1050efceeb62017?rik=md6w5YJbvgZEDw&pid=ImgRaw&r=0', 'https://gameluster.com/wp-content/uploads/2021/06/ELDENRING_01_4K-scaled.jpg', 'Introduction to the Elden Ring world', 4.70, 'https://example.com/eldenring', 'Windows 10', 'AMD Ryzen 5', '16GB', 'AMD Radeon RX 580', 'DirectX 12', '150GB', 'Windows 7', 'Intel i5', '8GB', 'NVIDIA GTX 1060', 'DirectX 12', '60GB'),
(4, 'Microsoft Flight Simulator', 'Microsoft', 'Simulation', 49.99, 20.00, 2000, '2022-08-10', 'An immersive flight simulation game', 'https://th.bing.com/th/id/OIP.M7taxtWHYxsOFHPH5limXAHaHa?w=480&h=480&rs=1&pid=ImgDetMain', 'https://th.bing.com/th/id/R.479315c32395c46f7921180707f7e7b3?rik=8N7KwqZGhySmwQ&pid=ImgRaw&r=0', 'Introduction to realistic flying', 4.20, 'https://example.com/flightsim', 'Windows 10', 'Intel i7', '16GB', 'AMD Radeon Pro 560', 'DirectX 12', '150GB', 'Windows 7', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 11', '50GB'),
(5, 'Civilization VI', '2K Games', 'Action', 29.99, 0.00, 285, '2020-02-20', 'A historical strategy game', 'https://th.bing.com/th/id/OIP.xc5evg6ssnd8amiOCwiYkQHaKg?rs=1&pid=ImgDetMain', 'https://assets.nintendo.com/image/upload/c_fill,w_1200/q_auto:best/f_auto/dpr_2.0/ncom/pt_BR/games/switch/s/sid-meiers-civilization-vi-switch/hero', 'Introduction to Civilization Building', 3.80, 'https://example.com/civ6', 'Windows 10', 'Intel i3', '4GB', 'NVIDIA GTX 750', 'DirectX 11', '20GB', 'Windows 7', 'Intel i3', '2GB', 'Intel HD Graphics', 'DirectX 10', '10GB'),
(6, 'Portal 2', 'Valve', 'Puzzle', 19.99, 5.00, 100, '2023-09-01', 'A challenging puzzle game built upon Aperture Science', 'https://assets-prd.ignimgs.com/2021/12/08/portal2-1638924084230.jpg', 'https://cdn.akamai.steamstatic.com/steam/apps/620/ss_8a772608d29ffd56ac013d2ac7c4388b96e87a21.1920x1080.jpg?t=1610490805', 'Introduction to Portal mechanics', 4.30, 'https://example.com/portal2', 'Windows 10', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 11', '50GB', 'Windows 7', 'Intel i3', '4GB', 'Intel HD Graphics', 'DirectX 10', '30GB'),
(7, 'DOOM Eternal', 'Bethesda', 'Action', 59.99, 15.00, 2000, '2021-06-01', 'A high-paced shooter game with intense action', 'https://th.bing.com/th/id/OIP.OpP_1gOOiOm-VcNvkiyi8wHaHa?rs=1&pid=ImgDetMain', 'https://th.bing.com/th/id/R.6d128d1df6feca1559ce63b0151cbe9d?rik=ZWhfWcSPx2vM8A&pid=ImgRaw&r=0', 'Introduction to the DOOM universe', 4.80, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 'Resident Evil Village', 'Capcom', 'Horror', 49.99, 10.00, 800, '2020-08-15', 'A terrifying horror game in a European village', 'https://upload.wikimedia.org/wikipedia/en/2/2c/Resident_Evil_Village.png', 'https://th.bing.com/th/id/R.41f28a0302a3c2ac97868000488a802c?rik=0ek8nCJ5ZHp%2bwA&pid=ImgRaw&r=0', 'Introduction to Resident Evil Village', 4.10, 'https://example.com/revillage', 'Windows 10', 'Intel i5', '8GB', 'NVIDIA GTX 1060', 'DirectX 12', '50GB', 'Windows 7', 'Intel i3', '4GB', 'NVIDIA GTX 950', 'DirectX 10', '40GB'),
(9, 'Forza Horizon 5', 'Xbox Game Studios', 'Racing', 39.99, 20.00, 1500, '2023-03-01', 'A fast-paced racing game with an open world', 'https://th.bing.com/th/id/R.8f87b4b4b7427145aef289e6406ac05a?rik=zMx57%2fqwKlcQ7A&pid=ImgRaw&r=0', 'https://mp1st.com/wp-content/uploads/2021/09/forza-horizon-5-pc-specs.jpg', 'Introduction to the Forza racing experience', 4.40, 'https://example.com/forzahorizon5', 'Windows 10', 'Intel i7', '16GB', 'AMD Radeon Pro 560', 'DirectX 12', '100GB', 'Windows 7', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 11', '50GB'),
(10, 'Uncharted 4: A Thief End', 'Naughty Dog', 'Adventure', 59.99, 10.00, 1800, '2021-11-20', 'A gripping adventure game following the story of Nathan Drake', 'https://th.bing.com/th/id/OIP.DEKWcxvYg-PRbMk_OWl7wwHaJ4?rs=1&pid=ImgDetMain', 'https://wallsdesk.com/wp-content/uploads/2016/04/Uncharted-4-A-Thiefs-End-Widescreen.jpg', 'Introduction to cinematic storytelling', 4.70, 'https://example.com/uncharted4', 'Windows 10', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 11', '80GB', 'Windows 7', 'Intel i3', '4GB', 'NVIDIA GTX 950', 'DirectX 10', '40GB'),
(11, 'StarCraft II', 'Blizzard Entertainment', 'Strategy', 29.99, 5.00, 900, '2020-05-10', 'A tactical strategy game with a science fiction theme', 'https://th.bing.com/th/id/OIP.3zZWd80NY0otGKVMOtlAmQHaKf?rs=1&pid=ImgDetMain', 'https://th.bing.com/th/id/R.5ec429998fa9c40f73146fa88501036e?rik=4td7J3tfy5Yckw&pid=ImgRaw&r=0', 'Introduction to the StarCraft universe', 4.00, 'https://example.com/sc2', 'Windows 10', 'Intel i3', '4GB', 'NVIDIA GTX 750', 'DirectX 10', '30GB', 'Windows 7', 'Intel i3', '2GB', 'Intel HD Graphics', 'DirectX 9', '20GB'),
(12, 'Assassin\'s Creed: Valhalla', 'Ubisoft', 'Action', 77.00, 0.00, 2500, '2022-01-15', 'An epic action game set in the Viking era', 'https://th.bing.com/th/id/OIP.EpKMvwzEG4jvtH4_2npVBgHaJ4?rs=1&pid=ImgDetMain', 'https://wallpapercave.com/wp/wp6196238.jpg', 'Introduction to the Assassin\'s Creed series', 4.90, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 'The Sims 4', 'Electronic Arts', 'Simulation', 49.99, 10.00, 1300, '2021-09-12', 'A life simulation game where you control virtual people', 'https://th.bing.com/th/id/OIP.Cg8oCes8MFVoNQCmqvzEvAHaKd?rs=1&pid=ImgDetMain', 'https://cdn1.epicgames.com/offer/2a14cf8a83b149919a2399504e5686a6/EGS_TheSims4_ElectronicArts_S1_2560x1440-330b00849edfdacc61578d1486f47b31', 'Introduction to life simulation', 4.20, 'https://example.com/sims4', 'Windows 10', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 11', '70GB', 'Windows 7', 'Intel i3', '4GB', 'Intel HD Graphics', 'DirectX 10', '30GB'),
(14, 'The Witcher 3: Wild Hunt', 'CD Projekt', 'RPG', 59.99, 20.00, 1600, '2023-07-20', 'A fantasy RPG game with an expansive open world', 'https://th.bing.com/th/id/OIP.Olq7Tn1FvY1b8UGrqPzWQgHaKY?rs=1&pid=ImgDetMain', 'https://th.bing.com/th/id/OIP.xc5evg6ssnd8amiOCwiYkQHaKg?rs=1&pid=ImgDetMain', 'Introduction to the Witcher universe', 4.60, 'https://example.com/witcher3', 'Windows 10', 'Intel i7', '16GB', 'NVIDIA GTX 1660 Ti', 'DirectX 12', '150GB', 'Windows 7', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 12', '50GB'),
(15, 'Cyberpunk 2077', 'CD Projekt', 'Action', 59.99, 10.00, 1400, '2020-12-10', 'A story-driven open world RPG set in a dark future.', 'https://th.bing.com/th/id/OIP.NSlU9gXGETC-UJGhdMRJUwHaLH?rs=1&pid=ImgDetMain', 'https://gamingbolt.com/wp-content/uploads/2023/06/Cyberpunk-2077-Phantom-Liberty.jpg', 'Introduction to the Cyberpunk universe', 4.00, 'https://example.com/cyberpunk2077', 'Windows 10', 'Intel i7', '16GB', 'NVIDIA GTX 1070', 'DirectX 12', '70GB', 'Windows 7', 'Intel i5', '8GB', 'NVIDIA GTX 780', 'DirectX 11', '70GB'),
(16, 'Hades', 'Supergiant Games', 'Rogue-like', 24.99, 5.00, 700, '2020-09-17', 'A rogue-like dungeon crawler with sharp characters.', 'https://media.wired.com/photos/5f6cf5ec6f32a729dc0b3a89/master/w_1600%2Cc_limit/Culture_inline_Hades_PackArt.jpg', 'https://th.bing.com/th/id/R.16704c8bbb0862187d982c56c5af6be5?rik=RiLbQh4KoiAsDQ&pid=ImgRaw&r=0', 'Introduction to Greek mythology in a new light', 4.90, 'https://example.com/hades', 'Windows 10', 'Intel Dual Core', '4GB', 'NVIDIA GeForce 9400', 'DirectX 10', '15GB', 'Windows 7', 'Intel Dual Core', '4GB', 'NVIDIA GeForce 9400', 'DirectX 10', '15GB'),
(17, 'Ghost of Tsushima', 'Sony Interactive Entertainment', 'Action-Adventure', 59.99, 15.00, 900, '2020-07-17', 'A beautiful action-adventure set in feudal Japan.', 'https://static0.gamerantimages.com/wordpress/wp-content/uploads/2023/09/ghost-of-tsushima-director-s-cut.jpg', 'https://th.bing.com/th/id/OIP.xc5evg6ssnd8amiOCwiYkQHaKg?rs=1&pid=ImgDetMain', 'Introduction to the world of samurai and ninjas', 4.80, 'https://example.com/got', 'PS4', NULL, NULL, NULL, NULL, NULL, 'PS4', NULL, NULL, NULL, NULL, NULL),
(18, 'Among Us', 'InnerSloth', 'Action', 50.00, 0.00, 5000, '2018-11-16', 'A multiplayer party game about teamwork and betrayal.', 'https://static1.srcdn.com/wordpress/wp-content/uploads/2020/11/Among-Us-Cover-Art.jpg', 'https://cdn1.epicgames.com/salesEvent/salesEvent/amoguslandscape_2560x1440-3fac17e8bb45d81ec9b2c24655758075', 'Introduction to social deduction games', 4.50, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(19, 'Stardew Valley', 'ConcernedApe', 'Simulation', 14.99, 0.00, 2000, '2016-02-26', 'An open-ended country-life RPG.', 'https://th.bing.com/th/id/OIP.LEvxtkHFfoS0DfB57BaYTAHaLH?rs=1&pid=ImgDetMain', 'https://www.mmogames.com/wp-content/uploads/2018/05/Stardew-Valley-Screenshot-11.jpg', 'Introduction to the soothing farm life sim', 4.80, 'https://example.com/stardew', 'Windows Vista', 'Intel Core 2 Duo', '2GB', 'Integrated graphics', 'DirectX 10', '500MB', 'Windows Vista', 'Intel Core 2 Duo', '2GB', 'Integrated graphics', 'DirectX 10', '500MB'),
(20, 'Hollow Knight', 'Team Cherry', 'Metroidvania', 14.99, 10.00, 1200, '2017-02-24', 'A challenging and artful Metroidvania game.', 'https://image.api.playstation.com/cdn/UP1822/CUSA13632_00/GuFQKWlrIVODEA1su20fCOrNZEYX5CB9.png', 'https://th.bing.com/th/id/OIP.3uDiFHs1ltniHHMWxZRFngHaDt?rs=1&pid=ImgDetMain', 'Introduction to a dark and beautifully crafted world', 4.75, 'https://example.com/hollowknight', 'Windows 10', 'Intel Core 2 Duo', '4GB', 'NVIDIA GeForce 9800GTX', 'DirectX 11', '9GB', 'Windows 7', 'Intel Core 2 Duo', '2GB', 'NVIDIA GeForce 9800GTX', 'DirectX 11', '9GB');

-- --------------------------------------------------------

--
-- Table structure for table `quan_ly_bai_bao`
--

CREATE TABLE `quan_ly_bai_bao` (
  `admin_id` int(11) NOT NULL,
  `bai_bao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quan_ly_game`
--

CREATE TABLE `quan_ly_game` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quan_ly_user`
--

CREATE TABLE `quan_ly_user` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `registration_date` date DEFAULT curdate(),
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL CHECK (`role` in ('User','Admin')),
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tai_khoan`
--

INSERT INTO `tai_khoan` (`id`, `username`, `firstName`, `lastName`, `password`, `full_name`, `date_of_birth`, `registration_date`, `phone_number`, `email`, `role`, `avatar`) VALUES
(6, 'johndoe', 'John', 'Doe', '$2y$10$Vtg3lbvHWshCaoEBmynRm.MJtvjM.X.XGZG3bheU7Oalcda7kqPiy', NULL, NULL, '2024-12-11', '', 'hieu@gmail.com', 'User', NULL),
(7, 'a', 'a', 'a', '$2y$10$wkzUfM.SykcV54GTkOkZD.45cYmld37ySTZn5yW8PlCUYBjVyVR6e', NULL, NULL, '2024-12-11', '', 'danhsonha113@gmail.com', 'User', NULL),
(8, 'hieu', 'abc', 'abc', '$2y$10$fZfCPcH7U.KFm1c2JuxJ2.taOgqEN4WvNxVA26KyeyJ5Tvk8JAKRG', NULL, NULL, '2024-12-11', '', '2003letrunghieu2@gmail.com', 'User', NULL),
(9, 'hieuuu', 'abc', 'acdcada', '$2y$10$9I1STLd84m0BHePgflLgQOJPI2j/7in1G0uX2fMVltuZsocQNjwJq', NULL, NULL, '2024-12-11', '', 'hoang@gmail.com', 'User', NULL),
(10, 'abc', 'ádfsdfs', 'èwefwe', '$2y$10$sg7hl4duuwZQ6/A20Rl1R.jHmL4IpTmKbeKQTtCDs5g5XdbU6LtAO', NULL, NULL, '2024-12-11', '', 'tai@gmail.com', 'admin', NULL),
(11, 'taolahieu', 'rdsfdsf', 'dsafdsfa', '$2y$10$/N.mUJo2lN4eqLTTaEtHa.xEXVeWZw4P0AJGNNRCzfdKAYekRmHPK', NULL, NULL, '2024-12-12', '', 'hieule@gmail.com', 'User', NULL),
(12, 'admin', 'fsdfsd', 'dfsdfsa', '$2y$10$bFoVcmE3cuJ9Dmaw1Adar.q8OT6iS9FcjYC8rT1U4TIQjFURbSGBe', NULL, NULL, '2024-12-12', '', 'admin@gmail.com', 'Admin', NULL),
(14, 'hieule@gmail.com', 'abc', 'abc', '$2y$10$1DSx4z.CGlmIKTUCjm1qC./IsBBcVXpzkkOEX9n875cjGxwyt52QC', NULL, NULL, '2024-12-12', '', 'metmoi@gmail.com', 'User', NULL),
(15, 'fwefew', 'avsdfsd', 'fwefew', '$2y$10$lDT6nnZZU6OXp5gC3cBZ9OYnoaBZdYWyvvqJjgN5lYDwHeVerPty2', NULL, NULL, '2024-12-12', '', 'met@gmail.com', 'User', NULL),
(16, 'aa', 'aa', 'aa', '$2y$10$QlcqXDC6AVa37886DGcB1ubcuHk0enjbiL.xPIo0fWvOJZsG2c4N2', NULL, NULL, '2024-12-12', '', 'aa@gmail.com', 'Admin', NULL),
(18, 'ac', 'ac', 'ac', '$2y$10$mJnTZR20Ny0Upd6y0SGFve7taTz3OLBROgyNLHOFdo/ECHk2ICjXq', NULL, NULL, '2024-12-13', '', 'ac@gmail.com', 'User', NULL),
(19, 'sonsonha', 'ha', 'son', '$2y$10$1.kbjc1fQg9RsKNo.Cu6G.MVO9q/5XkDu4FgQUKLOdASSAgQsd2zm', 'Danh Son Ha', '2008-06-25', '2024-12-13', '0123456789', 'sonha123@gmail.com', 'User', 'https://cdn.akamai.steamstatic.com/steam/apps/620/ss_8a772608d29ffd56ac013d2ac7c4388b96e87a21.1920x1080.jpg?t=1610490805'),
(20, 'Admin1', 'Admin1', 'Admin1', '$2y$10$SB44Vnl1MNuOEtSVR3/IHO3Q45xPVI6sLG9wV478xz7aJ1IEYWR0K', 'Admin1', '1999-09-09', '2024-12-13', '', 'admin1@gmail.com', 'Admin', 'https://th.bing.com/th/id/OIP.M7taxtWHYxsOFHPH5limXAHaHa?w=480&h=480&rs=1&pid=ImgDetMain'),
(21, 'Accountte', 'Account1', 'Account', '$2y$10$8u0SemkXE0F4mKefHZ6Wy.4lZiPMzPwI7IllmLmwCv4tZtp0FvcwS', NULL, NULL, '2024-12-13', '', 'Account1@mail.com', 'User', NULL),
(22, 'Yantae', 'Yante', 'yes', '$2y$10$p.pp8TzPMmVLj0RNQgoAXOWBoLa9YjAiKLRiEiv1HAwc39zpzLndW', NULL, NULL, '2024-12-13', '', 'yante@gmail.com', 'User', NULL),
(23, 'testacc', 'testacc', 'testacc', '$2y$10$8xXk5fSPZYMPVoDj8nJqIe62LaraEqXsEBxfYUCjmC.U0VudRVp/q', NULL, NULL, '2024-12-13', '', 'testacc@gmail.com', 'User', NULL),
(24, 'user123', 'user123', 'user', '$2y$10$..vuqG6S0FGY2JnK2UGneOxbMn1VIYUgRB7t9hSW5w2f60Ih0/sHK', NULL, NULL, '2024-12-13', '', 'user@gmail.com', 'User', NULL);

--
-- Triggers `tai_khoan`
--
DELIMITER $$
CREATE TRIGGER `after_insert_tai_khoan` AFTER INSERT ON `tai_khoan` FOR EACH ROW BEGIN
    INSERT INTO user (account_id, coins, status)
    VALUES (NEW.id, 0, 1);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_role` AFTER UPDATE ON `tai_khoan` FOR EACH ROW BEGIN
    IF NEW.role = 'Admin' and OLD.role = 'User' THEN
        -- Thêm vào bảng admin
        INSERT INTO admin (account_id)
        VALUES (NEW.id);

        -- Xóa khỏi bảng user
        DELETE FROM user WHERE account_id = NEW.id;
    ELSEIF NEW.role = 'User' and OLD.role = 'Admin' THEN
        -- Thêm vào bảng user
        INSERT INTO user (account_id, coins, status)
        VALUES (NEW.id, 0, 1);

        -- Xóa khỏi bảng admin
        DELETE FROM admin WHERE account_id = NEW.id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` enum('image','video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `game_id`, `url`, `type`) VALUES
(1, 2, 'https://assets.nintendo.com/image/upload/c_fill,w_1200/q_auto:best/f_auto/dpr_2.0/ncom/software/switch/70010000000025/7137262b5a64d921e193653f8aa0b722925abc5680380ca0e18a5cfd91697f58', 'image'),
(2, 3, 'https://i.ytimg.com/vi/JldMvQMO_5U/maxresdefault.jpg', 'image'),
(3, 4, 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1250410/ss_d31fefd20eda54107d0414c779d0058c8b030233.1920x1080.jpg?t=1730994202', 'image'),
(4, 5, 'https://i.ytimg.com/vi/xEi3tjXbKIQ/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLBq5VURtCuRYyoFqxEE7gKzo2FAiA', 'image'),
(5, 6, 'https://shared.cloudflare.steamstatic.com/store_item_assets/steam/apps/620/header.jpg', 'image'),
(6, 7, 'https://image.api.playstation.com/vulcan/ap/rnd/202010/0114/ERNPc4gFqeRDG1tYQIfOKQtM.png', 'image'),
(7, 8, 'https://image.api.playstation.com/vulcan/ap/rnd/202101/0812/FkzwjnJknkrFlozkTdeQBMub.png', 'image'),
(8, 9, 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1551360/capsule_616x353.jpg?t=1730830713', 'image'),
(9, 10, 'https://i.ytimg.com/vi_webp/y1Rx-Bbht5E/maxresdefault.webp', 'image'),
(10, 11, 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2013/03/214395-analisis-starcraft-ii-heart-swarm.jpg?tf=3840x', 'image'),
(11, 12, 'https://image.api.playstation.com/vulcan/img/rnd/202011/0302/01quIFlCq8SsABef4U70Tnks.jpg', 'image'),
(12, 13, 'https://shared.cloudflare.steamstatic.com/store_item_assets/steam/apps/1222670/capsule_616x353.jpg?t=1731608003', 'image'),
(13, 14, 'https://herogame.vn/ad-min/assets/js/libs/kcfinder/upload/images/Herogame_TW3WHCPEDI_01.jpg', 'image'),
(14, 15, 'https://shared.cloudflare.steamstatic.com/store_item_assets/steam/apps/1091500/capsule_616x353.jpg?t=1730212296', 'image'),
(15, 16, 'https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/hades-game.jpg', 'image'),
(16, 17, 'https://i.ytimg.com/vi/cD5FrDNx9QU/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCuBxpSFHQMM6-3ARnVsNy8bG1wUg', 'image'),
(17, 18, 'https://images2.thanhnien.vn/528068263637045248/2023/6/28/among-us-16879157558491830914451.jpg', 'image'),
(18, 19, 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/413150/capsule_616x353.jpg?t=1711128146', 'image'),
(19, 20, 'https://assets.nintendo.com/image/upload/c_fill,w_1200/q_auto:best/f_auto/dpr_2.0/ncom/software/switch/70010000003208/4643fb058642335c523910f3a7910575f56372f612f7c0c9a497aaae978d3e51', 'image'),
(20, 2, 'https://www.akibagamers.it/wp-content/uploads/2017/03/the-legend-of-zelda-breath-of-the-wild-recensione-boxart.jpg', 'image'),
(21, 2, 'https://www.hdwallpapers.in/download/the_legend_of_zelda_breath_of_the_wild_68_hd_games-HD.jpg', 'image'),
(22, 2, 'https://th.bing.com/th/id/R.c8c27f5f4dd7729220a6c94ba18e9e2e?rik=SfeBDTeHwtHqkw&pid=ImgRaw&r=0', 'image'),
(23, 2, 'https://external-preview.redd.it/kl3TULI0N4INaubyhK2h9vGm4raHjrdlDLozB_f2z_A.jpg?auto=webp&s=a0b5cd932fdbc6ca0dca483f61dcc36af59aa893', 'image'),
(24, 2, 'https://youtu.be/zw47_q9wbBE', 'video');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `coins` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `coins`, `status`, `account_id`) VALUES
(7, 0, 1, 15),
(11, 5392, 1, 18),
(12, 0, 1, 19),
(14, 0, 1, 21),
(15, 0, 1, 22),
(16, 0, 0, 23),
(17, 981, 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `user_game`
--

CREATE TABLE `user_game` (
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_game`
--

INSERT INTO `user_game` (`user_id`, `game_id`) VALUES
(11, 1),
(11, 2),
(11, 3),
(11, 7),
(11, 9),
(11, 11),
(11, 12),
(11, 14),
(11, 16),
(11, 18),
(17, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `bai_bao`
--
ALTER TABLE `bai_bao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bao_loi`
--
ALTER TABLE `bao_loi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quan_ly_bai_bao`
--
ALTER TABLE `quan_ly_bai_bao`
  ADD PRIMARY KEY (`admin_id`,`bai_bao_id`),
  ADD KEY `bai_bao_id` (`bai_bao_id`);

--
-- Indexes for table `quan_ly_game`
--
ALTER TABLE `quan_ly_game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `quan_ly_user`
--
ALTER TABLE `quan_ly_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `user_game`
--
ALTER TABLE `user_game`
  ADD PRIMARY KEY (`user_id`,`game_id`),
  ADD KEY `game_id` (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bai_bao`
--
ALTER TABLE `bai_bao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bao_loi`
--
ALTER TABLE `bao_loi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `danh_gia`
--
ALTER TABLE `danh_gia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `quan_ly_game`
--
ALTER TABLE `quan_ly_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quan_ly_user`
--
ALTER TABLE `quan_ly_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `tai_khoan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bao_loi`
--
ALTER TABLE `bao_loi`
  ADD CONSTRAINT `bao_loi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bao_loi_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `don_hang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD CONSTRAINT `danh_gia_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `danh_gia_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quan_ly_bai_bao`
--
ALTER TABLE `quan_ly_bai_bao`
  ADD CONSTRAINT `quan_ly_bai_bao_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quan_ly_bai_bao_ibfk_2` FOREIGN KEY (`bai_bao_id`) REFERENCES `bai_bao` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quan_ly_game`
--
ALTER TABLE `quan_ly_game`
  ADD CONSTRAINT `quan_ly_game_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quan_ly_game_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quan_ly_user`
--
ALTER TABLE `quan_ly_user`
  ADD CONSTRAINT `quan_ly_user_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quan_ly_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD CONSTRAINT `thumbnails_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `tai_khoan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_game`
--
ALTER TABLE `user_game`
  ADD CONSTRAINT `user_game_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_game_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
