-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 
-- サーバのバージョン： 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rosetta`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `categoty_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discounted_price` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `items`
--

INSERT INTO `items` (`item_id`, `name`, `price`, `discounted_price`, `description`) VALUES
(1, 'Classe-S snakechain 1.2mm première', 225800, 19800, 'ROSETTAの最高品質premièreクラスに分類される、シンプルでありながら揺らめくように輝く存在感を放つ、細いスネークチェーンのネックレス。\r\n\r\n');

-- --------------------------------------------------------

--
-- テーブルの構造 `item_categories`
--

CREATE TABLE `item_categories` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `item_images`
--

CREATE TABLE `item_images` (
  `item_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `item_images`
--

INSERT INTO `item_images` (`item_id`, `filename`, `num`) VALUES
(1, 'snake1.jpg', 2),
(1, 'snake2.jpg', 1),
(1, 'snake3.jpg', 3);

-- --------------------------------------------------------

--
-- テーブルの構造 `item_reviews`
--

CREATE TABLE `item_reviews` (
  `review_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `item_id` int(11) NOT NULL,
  `stars` float NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `item_reviews`
--

INSERT INTO `item_reviews` (`review_id`, `title`, `item_id`, `stars`, `text`, `created_at`) VALUES
(1, '細いのに圧倒的存在感', 1, 5, '細いのに立体感があり、素肌に付けているだけでとても目立ちます。 今までネックレスを付けていても誰かに反応されることはなかったのですが、ROSETTAのネックレスは存在感があって、色んな人に「それどこの？」と 聞かれます。\r\n\r\n', '2025-06-29 20:22:01'),
(2, '翌日には届いた', 1, 5, '後払いで購入し、翌日には手元に届きました！\r\n彼氏へのプレゼント用で購入しましたが、 箱も高級感があって、品質保証書も付いていたので、 プレゼント用に最適だと思いました！ 次はお揃いで購入しようと思います！', '2025-06-29 20:22:26'),
(3, '軽い', 1, 5, '一日中つけても重さを感じず、寝るときも気になりません。本当に身体の一部になったかのようです。', '2025-06-29 20:45:09'),
(4, 'ギフト映え', 1, 5, 'しっかりとした箱に品質保証書も同封されていて、高級感が伝わるギフトになりました。', '2025-06-29 20:45:09'),
(5, '2連に！', 1, 4, '別ブランドのペンダントと二連にして着けています。チェーンのしなやかさに感動しました。', '2025-06-29 20:46:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `review_images`
--

CREATE TABLE `review_images` (
  `review_id` int(11) NOT NULL,
  `filename` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `review_images`
--

INSERT INTO `review_images` (`review_id`, `filename`) VALUES
(3, 'sample.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_reviews`
--
ALTER TABLE `item_reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_reviews`
--
ALTER TABLE `item_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
