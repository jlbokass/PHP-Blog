-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 19, 2019 at 03:01 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blogphp1`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Formation'),
(2, 'Graphisme'),
(3, 'Sport'),
(4, 'Photographie');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `FK_user_id` int(11) NOT NULL,
  `FK_post_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `FK_user_id`, `FK_post_id`, `content`, `published`, `createdAt`, `updatedAt`) VALUES
(3, 2, 6, 'test', 0, '2019-02-01 22:30:34', NULL),
(4, 2, 6, 'test 4', 0, '2019-02-01 22:31:45', NULL),
(5, 2, 6, 'trterse', 0, '2019-02-01 22:32:00', NULL),
(6, 25, 6, 'test', 0, '2019-02-02 14:48:45', NULL),
(7, 25, 6, 'encore un test', 1, '2019-02-02 14:58:26', NULL),
(8, 25, 6, 'coucou', 1, '2019-02-02 14:59:16', NULL),
(9, 24, 5, 'ici john', 1, '2019-02-02 15:10:29', NULL),
(11, 24, 6, 'Encore un petit test ;)', 1, '2019-02-02 15:28:38', NULL),
(19, 0, 0, 'test de mes fonctions.', 0, '2019-02-09 06:12:32', NULL),
(20, 24, 14, 'Enfin ça marche !!!!', 1, '2019-02-09 06:19:54', NULL),
(21, 25, 8, 'génial chéri !!!!\r\n\r\n', 1, '2019-02-09 10:10:53', NULL),
(22, 24, 15, 'un petit test', 1, '2019-02-09 16:08:41', NULL),
(24, 25, 7, 'un autre test', 1, '2019-02-09 16:16:38', NULL),
(25, 24, 15, 'un petit test supplémentaire', 1, '2019-02-11 02:44:17', NULL),
(26, 24, 6, 'un nouveau test pour savoir si les commentaires marche toujours', 1, '2019-02-14 04:09:07', NULL),
(27, 24, 5, 'srhrthrt', 0, '2019-02-18 08:21:48', NULL),
(29, 2, 6, 'ffujkfuykjfyu', 1, '2019-02-18 11:12:01', '2019-02-18 11:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `FK_user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `FK_user_id`, `title`, `headline`, `content`, `published`, `createdAt`, `updatedAt`) VALUES
(1, 1, 'Mon 1er article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper est orci, sit amet ornare sapien viverra vitae. Cras mollis, nulla in commodo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper est orci, sit amet ornare sapien viverra vitae. Cras mollis, nulla in commodo sollicitudin, tellus massa convallis massa, a lobortis sapien elit ac augue. Praesent pharetra accumsan neque, in pulvinar neque facilisis vel. Cras porta tortor id commodo faucibus. Morbi porttitor condimentum sodales. Praesent sit amet odio molestie, porttitor nibh at, tempus quam. Donec sed euismod arcu, id posuere diam.', 0, '2019-01-23 09:40:16', NULL),
(2, 2, 'Mon 2eme article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper est orci, sit amet ornare sapien viverra vitae. Cras mollis, nulla in commodo', 'Phasellus consequat sem at elit hendrerit, eget tincidunt nunc cursus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut et dolor consectetur, pharetra ligula nec, vulputate velit. Suspendisse eu sapien nisl. Morbi non dapibus enim, id semper libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam eleifend congue massa, quis volutpat neque scelerisque et. Nunc eget mauris quis orci feugiat pellentesque eget id mauris.', 0, '2019-01-23 04:45:11', NULL),
(3, 1, 'Mon 3eme article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper est orci, sit amet ornare sapien viverra vitae. Cras mollis, nulla in commodo', 'Morbi nec quam ac tortor hendrerit gravida sed a lacus. Nunc sit amet pretium ipsum, cursus tempor arcu. Nam ligula felis, blandit vel tempor sed, luctus at arcu. Praesent at accumsan ante. Sed ut metus dui. Pellentesque luctus ante vitae purus euismod, pharetra convallis augue imperdiet. Nullam pharetra tincidunt est, quis eleifend lacus vulputate eu. Aenean vitae ligula lobortis, hendrerit nisl vel, condimentum arcu.', 0, '2019-01-23 17:09:20', NULL),
(4, 2, 'Mon 4eme article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper est orci, sit amet ornare sapien viverra vitae. Cras mollis, nulla in commodo', 'Etiam tincidunt lobortis scelerisque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam porta tortor quis placerat suscipit. Pellentesque posuere vitae erat sit amet rutrum. Suspendisse efficitur at urna at tempus. Nullam enim nulla, lobortis non quam ut, ultricies dignissim lectus. Etiam ultrices eu magna sit amet egestas. Etiam elementum imperdiet cursus. Aenean et quam tristique, condimentum massa eu, tincidunt neque. Etiam velit nisl, egestas at ligula at, lobortis malesuada mauris. Pellentesque sollicitudin pharetra metus a cursus. Proin hendrerit nunc vel varius pharetra.', 0, '2019-01-23 21:12:19', NULL),
(5, 1, 'Mon 5eme article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper est orci, sit amet ornare sapien viverra vitae. Cras mollis, nulla in commodo', 'Vivamus rutrum massa quam, in varius velit lacinia at. Nulla sapien metus, egestas et lobortis quis, dictum in mauris. Mauris facilisis quam nunc, ac rutrum lorem lobortis nec. Integer posuere imperdiet tortor. Suspendisse fringilla nulla ex, id porttitor lacus vulputate sit amet. Quisque eleifend eros massa, in tristique arcu bibendum eu. Etiam non luctus velit. Vestibulum id semper mi. Vestibulum in lorem et odio fringilla euismod nec feugiat quam. Proin cursus pellentesque massa, vel tristique quam dapibus et. Donec vulputate, quam eget fringilla porttitor, est magna feugiat purus, sed blandit tortor risus quis leo. Fusce a tempor sem. Quisque nulla nulla, aliquam ac tellus ut, elementum placerat eros. Fusce non ornare leo.', 0, '2019-01-23 19:26:06', NULL),
(6, 2, 'Mon 6eme article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper est orci, sit amet ornare sapien viverra vitae. Cras mollis, nulla in commodo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper est orci, sit amet ornare sapien viverra vitae. Cras mollis, nulla in commodo sollicitudin, tellus massa convallis massa, a lobortis sapien elit ac augue. Praesent pharetra accumsan neque, in pulvinar neque facilisis vel. Cras porta tortor id commodo faucibus. Morbi porttitor condimentum sodales. Praesent sit amet odio molestie, porttitor nibh at, tempus quam. Donec sed euismod arcu, id posuere diam.', 0, '2019-01-23 06:45:16', NULL),
(7, 24, '1er article de John - date', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper est orci, sit amet ornare sapien viverra vitae. Cras mollis, nulla in commodo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et accumsan quam, eget ullamcorper quam. Vivamus molestie euismod commodo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque ornare arcu magna, eu varius ex sagittis id. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eu tellus feugiat, hendrerit tellus at, dignissim justo. Maecenas fermentum metus ac erat posuere tristique. Mauris lacinia orci id orci pharetra consequat sit amet ut justo. Donec tincidunt est sit amet mollis sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum condimentum accumsan tortor, at porttitor lacus cursus in.', 0, '2019-02-03 04:57:19', '2019-02-07 21:24:38'),
(8, 24, 'Un bon matin !!! bbb', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget mi sed ligula lacinia tincidunt eget ut mi. Maecenas consequat enim neque', 'Aenean at sapien id ex tempor tempor nec in tortor. Morbi nec finibus tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque commodo pellentesque massa in sagittis. Phasellus eros odio, commodo sed arcu sit amet, dictum blandit risus. Nullam sit amet auctor diam. Duis vel ligula diam. Donec varius consectetur turpis ut aliquet. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent aliquam lacus porttitor enim cursus, nec fermentum orci interdum. Cras consequat, est in porta tempus, nibh felis sollicitudin leo, hendrerit rhoncus tortor odio eget arcu. In interdum eu urna non rhoncus. Nullam pretium enim non pellentesque placerat. Vestibulum imperdiet tellus ut odio dapibus congue. Cras malesuada, nunc varius laoreet porta, leo elit rutrum risus, at tincidunt orci orci id justo.', 0, '2019-02-16 11:30:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `category_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`category_id`, `post_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(4, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `remembered_login`
--

CREATE TABLE `remembered_login` (
  `token_hash` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `password_reset_hash` varchar(64) DEFAULT NULL,
  `password_reset_expires_at` datetime DEFAULT NULL,
  `activation_hash` varchar(64) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `registeredAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `role`, `password_reset_hash`, `password_reset_expires_at`, `activation_hash`, `is_active`, `avatar`, `registeredAt`) VALUES
(1, 'Astride', 'test1@me.com', 'test2019', 0, NULL, NULL, NULL, 0, NULL, '2019-01-23 00:00:00'),
(2, 'Patch', 'test2@me.com', 'test2019', 0, NULL, NULL, NULL, 0, NULL, '2019-01-23 00:00:00'),
(24, 'jlbokass33', 'j_dabok@me.com', '$2y$10$mA2S7LX0ywzf6QE72Cx8yexnF..gyW12k7MgyCXvFpGMinV4eteHa', 1, NULL, NULL, NULL, 1, NULL, '2019-02-01 19:15:09'),
(36, 'gaelle33', 'gaelle.labuzan@gmail.com', '$2y$10$EWCTZ.fww/bD3/JU85OgaOERf0u09XXTvqnxxLwynxYiGgXY9VgTS', 0, NULL, NULL, NULL, 1, NULL, '2019-02-19 13:45:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`,`FK_user_id`,`FK_post_id`),
  ADD KEY `persons_comments_fk` (`FK_user_id`),
  ADD KEY `posts_comments_fk` (`FK_post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`,`FK_user_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_user_id` (`FK_user_id`),
  ADD KEY `title` (`title`,`headline`,`published`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`category_id`,`post_id`),
  ADD KEY `post_article_category_fk` (`post_id`);

--
-- Indexes for table `remembered_login`
--
ALTER TABLE `remembered_login`
  ADD PRIMARY KEY (`token_hash`,`user_id`),
  ADD KEY `user_remembered_login_fk` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password_reset_hash` (`password_reset_hash`),
  ADD UNIQUE KEY `activation_hash` (`activation_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `category_article_category_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_article_category_fk` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `remembered_login`
--
ALTER TABLE `remembered_login`
  ADD CONSTRAINT `user_remembered_login_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
