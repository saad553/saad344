-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 09:59 PM
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
-- Database: `techweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `details_facture`
--

CREATE TABLE `details_facture` (
  `id_detail` int(11) NOT NULL,
  `id_facture` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `details_facture`
--

INSERT INTO `details_facture` (`id_detail`, `id_facture`, `id_produit`, `quantite`, `prix_unitaire`) VALUES
(2, 2, 1, 0, 7000.00),
(3, 3, 1, 0, 18000.00),
(4, 4, 1, 0, 7000.00),
(5, 5, 1, 0, 7000.00),
(6, 6, 1, 1, 0.00),
(7, 7, 1, 1, 0.00),
(8, 8, 1, 1, 7000.00),
(9, 9, 1, 2, 7000.00),
(10, 10, 1, 2, 7000.00),
(11, 11, 1, 1, 7000.00),
(12, 12, 1, 1, 12000.00);

-- --------------------------------------------------------

--
-- Table structure for table `factures`
--

CREATE TABLE `factures` (
  `id_facture` int(11) NOT NULL,
  `numero_facture` varchar(50) NOT NULL,
  `nom_client` varchar(100) NOT NULL,
  `adresse_client` varchar(255) NOT NULL,
  `total_ht` decimal(10,2) NOT NULL,
  `total_ttc` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `factures`
--

INSERT INTO `factures` (`id_facture`, `numero_facture`, `nom_client`, `adresse_client`, `total_ht`, `total_ttc`) VALUES
(1, '123456', 'John Doe', '123 Main St', 100.00, 120.00),
(2, '123456', 'John Doe', '123 Main St', 0.00, 0.00),
(3, '123456', 'John Doe', '123 Main St', 0.00, 0.00),
(4, '123456', 'John Doe', '123 Main St', 0.00, 0.00),
(5, '123456', 'John Doe', '123 Main St', 0.00, 0.00),
(6, '123456', 'John Doe', '123 Main St', 0.00, 0.00),
(7, '123456', 'John Doe', '123 Main St', 0.00, 0.00),
(8, '123456', 'John Doe', '123 Main St', 7000.00, 8400.00),
(9, '123456', 'John Doe', '123 Main St', 14000.00, 16800.00),
(10, '123456', 'Zine', 'Oujda', 14000.00, 16800.00),
(11, '123456', 'Zine', 'Oujda', 7000.00, 8400.00),
(12, '123456', 'Zine', 'Oujda', 12000.00, 14400.00);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(100) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_ht` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `quantite`, `prix_ht`) VALUES
(1, 'Iphone 14', 50, 7000.00),
(2, 'Macbook', 20, 18000.00),
(3, 'PC', 30, 12000.00),
(4, 'Gaming PC', 15, 15000.00),
(5, 'Iphone 12', 40, 5000.00),
(6, 'PS5', 25, 5000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details_facture`
--
ALTER TABLE `details_facture`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_facture` (`id_facture`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Indexes for table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id_facture`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details_facture`
--
ALTER TABLE `details_facture`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `details_facture`
--
ALTER TABLE `details_facture`
  ADD CONSTRAINT `details_facture_ibfk_1` FOREIGN KEY (`id_facture`) REFERENCES `factures` (`id_facture`),
  ADD CONSTRAINT `details_facture_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
