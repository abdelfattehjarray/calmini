-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 06 mai 2023 à 15:31
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `l_rendezvous`
--

CREATE TABLE `l_rendezvous` (
  `id` int(30) NOT NULL,
  `id_doc` int(30) NOT NULL,
  `id_user` int(30) NOT NULL,
  `calendrier` datetime NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `etatpayment` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `l_rendezvous`
--

INSERT INTO `l_rendezvous` (`id`, `id_doc`, `id_user`, `calendrier`, `etat`, `date_creation`, `etatpayment`, `title`, `note`) VALUES
(104, 1, 100, '2023-04-25 11:15:00', 3, '2023-04-24 12:15:29', 1, '', 5),
(105, 1, 1, '2023-04-26 16:34:00', 1, '2023-04-25 17:34:02', 1, '', 0),
(106, 1, 1, '2023-04-26 16:34:00', 1, '2023-04-25 17:34:02', 1, '', 0),
(107, 1, 1, '2023-04-27 16:36:00', 1, '2023-04-25 17:36:29', 1, '', 0),
(108, 1, 1, '2023-04-27 16:36:00', 1, '2023-04-25 17:36:29', 1, '', 0),
(109, 1, 1, '2023-04-27 16:36:00', 1, '2023-04-25 17:36:29', 1, '', 0),
(110, 1, 1, '2023-04-28 16:41:00', 1, '2023-04-25 17:41:02', 1, '', 0),
(111, 1, 1, '2023-04-28 16:41:00', 1, '2023-04-25 17:41:02', 1, '', 0),
(112, 1, 1, '2023-04-26 17:10:00', 1, '2023-04-25 18:10:23', 1, '', 0),
(113, 1, 2, '2023-05-09 21:03:00', 0, '2023-05-05 22:03:26', 0, '', 0),
(114, 1, 2, '2023-05-12 21:19:00', 0, '2023-05-05 22:19:04', 0, '', 0),
(115, 1, 2, '2023-06-02 21:19:00', 0, '2023-05-05 22:19:52', 0, '', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `l_rendezvous`
--
ALTER TABLE `l_rendezvous`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `l_rendezvous`
--
ALTER TABLE `l_rendezvous`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
