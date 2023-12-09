-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 09 déc. 2023 à 18:11
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `shop_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
(106, 'farah', 'd1d1716ffb0b65f5fbceedbaa8644607619a87c8'),
(107, 'mounira', '7b75fc87e6ded874d47b74d75fd0d11ff2e4d4c5'),
(108, 'nour', 'ded51a812e6d46e54ba61c088c621e437e44c57f'),
(109, 'nouraa', '9969ca9431d6892c48945237606173db8d20ca65'),
(110, 'hedia', 'd5ebe6c58272f35bd007e00bfad74f3971a1fab4'),
(111, 'houda', '050689b2f09db61342541a4cd3d8b612f7dcbc02'),
(112, 'hend', '077d5fefa08e56d8c1c359039e3b53f306fe9c6c'),
(113, 'tawfik', '9f961b0c436efbf8065275707ff6f0c4c92d83a0'),
(114, 'salma', 'a950b0e2f8baf6862cab19fc815133c985ecb068'),
(121, 'mariemkahli', '723722112053dfe834edf10df57d3397e6d903cb');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(81, 11, 3, 'sports set', 100, 1, 'femme4.jpg'),
(100, 24, 6, 'tracksuit', 150, 1, 'homme5.jpg'),
(101, 24, 9, 'green legging', 100, 1, 'femme5.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `code` int(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`code`, `nom`, `image`) VALUES
(1, 'Man', 'homme.png'),
(2, 'woman\r\n', 'femme.png'),
(3, 'child', 'enfant.png');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(10, 7, 'mouhanned', '97367862', 'mouhanned@gmail.com', 'cash on delivery', 'soussa, kawkeb, 12 - 123', 'gray legging (150 x 3) - sports set (140 x 3) - sports set (100 x 0) - sports set (100 x 3) - veiled sports set (180 x 3) - ', 1710, '0000-00-00', 'completed'),
(18, 9, 'melek', '53758699', 'melek@gmail.com', 'cash on delivery', 'sfax, bouassida, 12 - 124', 'legging dark (100 x 0) - veiled tracksuit (120 x 1) - ', 120, '0000-00-00', 'completed'),
(37, 7, 'mouhanned', '97367862', 'mouhanned@gmail.com', 'cash on delivery', 'soussa, kawkeb, 12 - 123', 'green legging (100 x 1) - colorful legging (100 x 1) - sports set (140 x 1) - ', 340, '0000-00-00', 'pending'),
(38, 7, 'mouhanned', '97367862', 'mouhanned@gmail.com', 'cash on delivery', 'soussa, kawkeb, 12 - 123', 'colorful legging (100 x 1) - green tracksuit (120 x 1) - ', 220, '0000-00-00', 'pending'),
(40, 35, 'farah khalfallah ', '9878678', 'farah@gmail.com', 'cash on delivery', 'sfax, route gebes , 12 - 1', 'green legging (100 x 3) - set (120 x 1) - legging dark (150 x 2) - ', 720, '0000-00-00', 'completed');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(250) NOT NULL,
  `category` int(100) NOT NULL,
  `details` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`, `details`) VALUES
(1, 'veiled tracksuit', 120, 'femme9.jpg', 2, 'SIZE: XXL - XL - M 🔵🔵 Color : black                           '),
(3, 'sports ', 100, 'homme2.webp', 1, 'SIZE: XXL - XL - M-S-XS 🔵🔵 Color : pink   '),
(5, 'green tracksuit', 120, 'enfant1.jpg', 3, 'SIZE: XXL - XL - M-S 🔵🔵 Color : green  '),
(6, 'tracksuit', 150, 'homme5.jpg', 1, 'SIZE: XXL - XL-L - M 🔵🔵 Color : gray    '),
(7, 'colorful legging', 100, 'enfant4.jpg', 3, 'SIZE: XXL - XL - M-S 🔵🔵 Color : colorful'),
(8, 'white tracksuit', 109, 'femme7.jpg', 2, 'SIZE: XXL - XL - M-S 🔵🔵 Color : white    '),
(9, 'green legging', 100, 'femme5.jpg', 2, 'SIZE: XXL - XL -L- M 🔵🔵 Color : blue'),
(14, 'colorful legging', 90, 'enfant5.jpg', 3, 'SIZE: L - M - S 🔵🔵 Color : blue and black   '),
(18, 'legging dark', 150, 'homme2.webp', 1, 'SIZE: XXL - XL - M 🔵🔵 Color : blue'),
(21, 'sports set', 140, 'homme6.jpg', 1, 'SIZE: XXL - XL - M 🔵🔵 Color : black and blue'),
(22, ' sports set', 100, 'enfant6.jpg', 3, 'SIZE: XXL - XL - M 🔵🔵 Color : blue'),
(47, 'legging', 150, 'homme7.jpg', 1, 'SIZE: XXL - XL - M 🔵🔵 Color : black'),
(48, 'jogging', 160, 'homme8.webp', 1, 'SIZE: XXL - XL - M 🔵🔵 Color : Gray'),
(49, 'jogging sport', 200, 'homme9.webp', 1, 'SIZE: XXL - XL - M 🔵🔵 Color : yellow'),
(50, 'set SD', 100, 'enfant5.jpg', 2, 'SIZE: XXL - XL - M 🔵🔵 Color : blue'),
(51, 'set chic', 200, 'femme10.jpg', 2, 'SIZE: XXL - XL - M 🔵🔵 Color : green'),
(52, 'legging SM', 100, 'femme9.webp', 2, 'SIZE: XXL - XL - M 🔵🔵 Color : white'),
(53, 'set WS', 100, 'homme8.webp', 1, 'SIZE: XXL - XL - M 🔵🔵 Color : gray');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(7, 'mouhanned', 'mouhanned@gmail.com', '97367862', '7b75fc87e6ded874d47b74d75fd0d11ff2e4d4c5', 'soussa, kawkeb, 12 - 123'),
(9, 'melek', 'melek@gmail.com', '53758699', '8807287e0f4ea766d54cd88dfb736db0b3a4c6ff', 'sfax, bouassida, 12 - 124'),
(35, 'farah khalfallah ', 'farah@gmail.com', '9878678', 'd1d1716ffb0b65f5fbceedbaa8644607619a87c8', 'sfax, route gebes , 12 - 1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrainte1` (`category`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `code` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `contrainte1` FOREIGN KEY (`category`) REFERENCES `category` (`code`),
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
