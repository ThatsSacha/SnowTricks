-- phpMyAdmin SQL Dump
-- version 4.9.9
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Snowtricks`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `trick_id`, `user_id`, `content`, `created_at`) VALUES
(1, 9, 1, 'Trop frais, j’aime trop !', '2022-02-02 06:59:13'),
(2, 17, 2, 'Je me suis entraîné cet hiver, j\'ai enfin réussi !', '2022-02-03 10:35:31'),
(3, 17, 1, 'Wow c\'est ouf, bien joué mec ! Moi je m\'entraîne encore et encore... ;)', '2022-02-03 10:36:08'),
(4, 2, 1, 'Hmmm pas mal !', '2022-02-03 10:37:30'),
(5, 5, 3, 'La base...', '2022-02-03 10:40:20'),
(6, 2, 3, 'Oui, ça va c\'est sympa mais pas hyper dur', '2022-02-03 10:40:49'),
(7, 6, 3, 'C\'est mon frère !', '2022-02-03 10:41:12'),
(8, 17, 3, 'Les gars y\'a rien de fifou non plus, ça fait parti de la base quoi...', '2022-02-03 10:41:59'),
(9, 17, 1, 'On n\'a pas tous la chance de prendre tous les jours le snow pour aller en cours nous...', '2022-02-03 10:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `trick`
--

CREATE TABLE `trick` (
  `id` int(11) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `trick_group_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trick`
--

INSERT INTO `trick` (`id`, `created_by_id`, `trick_group_id`, `name`, `description`, `created_at`, `slug`, `updated_at`) VALUES
(1, 2, 1, 'Mute', 'Saisie de la carre frontside de la planche entre les deux pieds avec la main avant', '2022-02-02 06:25:18', 'mute', NULL),
(2, 2, 1, 'Sad', 'Saisie de la carre frontside de la planche entre les deux pieds avec la main avant', '2022-02-02 06:26:58', 'sad', NULL),
(3, 2, 1, 'Indy', 'Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière', '2022-02-02 06:27:48', 'indy', NULL),
(4, 2, 1, 'Stalefish', 'Saisie de la carre backside de la planche entre les deux pieds avec la main arrière', '2022-02-02 06:29:28', 'stalefish', NULL),
(5, 2, 1, 'Tail grab', 'Saisie de la partie arrière de la planche, avec la main arrière', '2022-02-02 06:31:19', 'tail-grab', NULL),
(6, 2, 1, 'Nose grab', 'Saisie de la partie avant de la planche, avec la main avant', '2022-02-02 06:33:06', 'nose-grab', NULL),
(7, 2, 1, 'Japan air', 'Saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside', '2022-02-02 06:34:42', 'japan-air', NULL),
(8, 2, 1, 'Seat belt', 'Saisie du carre frontside à l\'arrière avec la main avant', '2022-02-02 06:36:08', 'seat-belt', NULL),
(9, 2, 1, 'Truck driver', 'Saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)', '2022-02-02 06:37:14', 'truck-driver', NULL),
(10, 2, 2, '180', 'Un 180 désigne un demi-tour, soit 180 degrés d\'angle', '2022-02-02 07:32:10', '180', NULL),
(11, 1, 2, '360', 'Trois six pour un tour complet', '2022-02-03 10:15:06', '360', NULL),
(12, 1, 2, '540', 'Cinq quatre pour un tour et demi', '2022-02-03 10:16:11', '540', NULL),
(13, 1, 2, '720', 'Sept deux pour deux tours complets', '2022-02-03 10:17:32', '720', NULL),
(14, 1, 2, '900', 'Pour deux tours et demi', '2022-02-03 10:19:34', '900', NULL),
(15, 1, 2, '1080', 'Appelé aussi big foot pour trois tours', '2022-02-03 10:21:15', '1080', NULL),
(16, 1, 3, 'Front flip', 'Le front flip est une rotation verticale en avant', '2022-02-03 10:25:42', 'front-flip', NULL),
(17, 1, 3, 'Back flip', 'Le back flip est une rotation verticale par l\'arrière', '2022-02-03 10:27:33', 'back-flip', NULL),
(18, 1, 3, 'Mac Twist', 'Rotation verticale agrémentée d\'une vrille', '2022-02-03 10:28:56', 'mac-twist', NULL),
(19, 1, 4, 'Rodeo', 'Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation', '2022-02-03 10:31:11', 'rodeo', NULL),
(20, 2, 1, 'Nose slide', 'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.', '2022-02-03 10:34:06', 'nose-slide', NULL),
(21, 2, 1, 'Tail slide', 'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.', '2022-02-03 10:34:36', 'tail-slide', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trick_group`
--

CREATE TABLE `trick_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trick_group`
--

INSERT INTO `trick_group` (`id`, `name`, `description`) VALUES
(1, 'Les grabs', 'Un grab consiste à attraper la planche avec la main pendant le saut.'),
(2, 'Les rotations', 'On désigne par le mot « rotation » uniquement des rotations horizontales; les rotations verticales sont des flips. Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal.'),
(3, 'Les flips', 'Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière.'),
(4, 'Les rotations désaxées', 'Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu\'initialement horizontales, font passer la tête en bas.'),
(5, 'Les slides', 'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.'),
(6, 'Les One Foot Tricks', 'Figures réalisée avec un pied décroché de la fixation, afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n\'est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception.'),
(7, 'Old school', 'Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990');

-- --------------------------------------------------------

--
-- Table structure for table `trick_media`
--

CREATE TABLE `trick_media` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) NOT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci,
  `is_img` tinyint(1) NOT NULL,
  `embed` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trick_media`
--

INSERT INTO `trick_media` (`id`, `trick_id`, `url`, `is_img`, `embed`) VALUES
(1, 1, 'https://a-static.besthdwallpaper.com/skiing-wallpaper-1280x768-4247_13.jpg', 1, NULL),
(2, 1, 'https://i1.adis.ws/i/bca/backcountry-ski-tricks-101-execute-freestyle-grabs?w=1200', 1, NULL),
(3, 2, 'https://media.istockphoto.com/photos/female-extreme-freestyle-snowboarder-jump-picture-id921572034?k=20&m=921572034&s=170667a&w=0&h=n8PwM263T1E3Hez92zFTRHkaO9vAFJ_qTm0nlcCzWos=', 1, NULL),
(4, 3, 'https://upload.wikimedia.org/wikipedia/commons/0/08/Snowboardertindygrab.jpg', 1, NULL),
(5, 3, 'https://www.thesnowpros.org/wp-content/uploads/2020/04/Burton_Official-Supplier_rogers.chris_2019-scaled.jpg', 1, NULL),
(6, 4, 'https://images.newschoolers.com/images/17/00/33/75/05/337505.jpeg', 1, NULL),
(7, 5, 'http://cdn.shopify.com/s/files/1/0230/1351/articles/5_1024x1024.jpg?v=1506718440', 1, NULL),
(8, 5, 'https://external-preview.redd.it/E6_jENjhycil2Xq9KCoGjdqPzvLW3aQ_XlM4aCty_0k.jpg?width=640&crop=smart&auto=webp&s=b4fed737daf06b5b05751976773a7d01fd1a4fcb', 1, NULL),
(9, 5, 'https://live.staticflickr.com/7004/6769020405_e6ddfb7bf5_b.jpg', 1, NULL),
(10, 5, NULL, 0, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/_Qq-YoXwNQY\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(11, 6, NULL, 0, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/mfm3a3og3LI\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(12, 6, 'https://www.thesnowpros.org/wp-content/uploads/2020/04/Burton_Official-Supplier_rogers.chris_2019-scaled.jpg', 1, NULL),
(13, 7, 'https://arts-majeurs.com/uploads/images/tricks/170.jpg', 1, NULL),
(14, 7, 'https://cdn-japantimes.com/wp-content/uploads/2021/03/np_file_76068.jpeg', 1, NULL),
(15, 8, 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Snowboardertindygrab.jpg/1200px-Snowboardertindygrab.jpg', 1, NULL),
(16, 8, NULL, 0, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/4vGEOYNGi_c\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(17, 9, 'https://ucarecdn.com/b6aa154c-3a98-4dcd-b2f9-282467820b6a/-/sharp/3/-/format/jpeg/-/progressive/yes/-/quality/normal/-/scale_crop/298x298/center/', 1, NULL),
(18, 10, 'https://coresites-cdn-adm.imgix.net/whitelines_new/wp-content/uploads/2013/09/Cab_180_Piste_Cudlip_REP-620x413.jpg', 1, NULL),
(19, 11, 'https://coresites-cdn-adm.imgix.net/onboardfr/wp-content/uploads/2015/12/wpid-how-to-frontside-360-snowboard-800.jpg', 1, NULL),
(20, 11, 'https://www.imperiumsnow.com/upload/friedl-fs-360-0.jpg', 1, NULL),
(21, 11, 'https://coresites-cdn-adm.imgix.net/whitelines_new/wp-content/uploads/2011/11/Whitelines-94-b-s-360-tail-620x274.jpg', 1, NULL),
(22, 11, NULL, 0, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/GS9MMT_bNn8\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(23, 12, 'https://coresites-cdn-adm.imgix.net/whitelines_new/wp-content/uploads/2015/12/how-to-frontside-540-snowboard-800.jpg?fit=crop', 1, NULL),
(24, 12, 'https://coresites-cdn-adm.imgix.net/whitelines_new/wp-content/uploads/2011/11/Whitelines-94-backside-rodeo-540-melon.jpg', 1, NULL),
(25, 13, 'https://coresites-cdn-adm.imgix.net/whitelines_new/wp-content/uploads/2015/12/how-to-backside-720-snowboard-800.jpg', 1, NULL),
(26, 13, NULL, 0, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/4JfBfQpG77o\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(27, 13, 'http://snowtricks-oc.herokuapp.com/images/720.jpg', 1, NULL),
(28, 14, 'https://img.olympicchannel.com/images/image/private/t_16-9_1920/primary/p6vmguw4xapxrazntloj', 1, NULL),
(29, 15, 'https://coresites-cdn-adm.imgix.net/onboardfr/wp-content/uploads/2015/11/wpid-Sven-Thorgren-Riksgransen.jpg?fit=crop', 1, NULL),
(30, 16, 'https://arts-majeurs.com/uploads/images/tricks/178.jpg', 1, NULL),
(31, 17, 'https://miro.medium.com/max/5000/1*UdPvCPU7SQlvXgy15ZGxrQ.jpeg', 1, NULL),
(32, 18, 'https://vibrantlifeblog.files.wordpress.com/2010/02/kazuhiro-kokubo-mctwist.jpg', 1, NULL),
(33, 19, 'https://coresites-cdn-adm.imgix.net/whitelines_new/wp-content/uploads/2011/11/Whitelines-94-backside-rodeo-540-melon.jpg', 1, NULL),
(34, 19, NULL, 0, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/pI-iykKk_z4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(35, 20, 'https://zpks.com/p/5/4/54123/9715-4.jpg', 1, NULL),
(36, 21, 'https://i.pinimg.com/736x/70/68/14/70681422b024957b07dfa77653f6d531--skate-surf-motocross.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_account_confirmed` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `cover`, `token`, `is_account_confirmed`, `created_at`) VALUES
(1, 'contact@sacha-cohen.fr', '[\"ROLE_USER\"]', '$2y$13$xhU.5q6D1fDPEhKV9k2aQuWqgZq1/YUdrejn2XHqzWGKW0biuPvEi', 'ThatsSacha', '4d53782b0d1a5c2b596f9685b1cf9ae2.jpg', NULL, 1, '2022-02-02 06:16:40'),
(2, 'ThatsSacha@gmail.com', '[\"ROLE_USER\"]', '$2y$13$otOpbrSXEhOKEbo1IlgoReSot9Am8IXcKoY6wfXHDaz/sKAU2RwhO', 'xRaptor0', 'c0bdec25cd1a0ad9608d91d800b18e50.jpg', '815ca3f1a333d842c1685d7559f5ad09cca8cd9b4cec635b11d7f1248edd09623f67de6fca067eb2d3e08709170b2c95042d38bba8619799d4845ed5311a0ad8', 1, '2022-02-02 06:19:50'),
(3, 'whitehat.Privacy4myself@gmail.com', '[\"ROLE_USER\"]', '$2y$13$J8o2mrESurXY8dkdt7g6B.MOJ3MhnQVnTCdu58ymhFsCHrMQiB4iS', 'The Snowboarder', 'ebd656a2937b88f0b4ace4cc411c0bea.png', NULL, 1, '2022-02-03 10:39:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CB281BE2E` (`trick_id`),
  ADD KEY `IDX_9474526CA76ED395` (`user_id`);

--
-- Indexes for table `trick`
--
ALTER TABLE `trick`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D8F0A91EB03A8386` (`created_by_id`),
  ADD KEY `IDX_D8F0A91E9B875DF8` (`trick_group_id`);

--
-- Indexes for table `trick_group`
--
ALTER TABLE `trick_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trick_media`
--
ALTER TABLE `trick_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A103A1B3B281BE2E` (`trick_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `trick`
--
ALTER TABLE `trick`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `trick_group`
--
ALTER TABLE `trick_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trick_media`
--
ALTER TABLE `trick_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Constraints for table `trick`
--
ALTER TABLE `trick`
  ADD CONSTRAINT `FK_D8F0A91E9B875DF8` FOREIGN KEY (`trick_group_id`) REFERENCES `trick_group` (`id`),
  ADD CONSTRAINT `FK_D8F0A91EB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `trick_media`
--
ALTER TABLE `trick_media`
  ADD CONSTRAINT `FK_A103A1B3B281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
