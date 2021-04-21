-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 04:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbuku`
--

-- --------------------------------------------------------

--
-- Table structure for table `entri_buku`
--

CREATE TABLE `entri_buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `penerbit` varchar(30) NOT NULL,
  `genre` varchar(300) NOT NULL,
  `harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entri_buku`
--

INSERT INTO `entri_buku` (`id`, `judul`, `pengarang`, `penerbit`, `genre`, `harga`) VALUES
(7, 'Harry Potter : The Goblet Of Fire ', 'J.k. Rowling', 'Sinar Star Book', 'Fantasy Fiction, Drama, Young Adult, Mystery, Thriller, Novels', 260000),
(8, 'Selena', 'Tere Liye', 'Gramedia Pustaka Utama', 'Fantasy, Literature, Fiction, Adventure, Young Adult, Novels', 85000),
(9, 'Bintang ', 'Tere Liye', 'Gramedia Pustaka Utama', 'Fantasy, Fiction, Adventure, Literature, Young Adult, Science Fiction, Action, Childrens, Novels', 88000),
(10, 'Nebula', 'Tere Liye', 'Gramedia Pustaka Utama', 'Fiction, Fantasy, Adventure, Science Fiction, Young Adult, Literature, Novels', 85000),
(11, 'Selamat Tinggal ', 'Tere Liye', 'Gramedia Pustaka Utama', '\r\nFiction, Inspirational, Novels', 85000),
(12, 'Milea Suara Dari Dilan ', 'Pidi Baiq', 'Mizan Publishing', 'Fiction, Young Adult, Roman, Contemporary, Comedy, Drama, Literature, Novels ', 89000),
(13, 'Bumi - New Cover ', 'Tere Liye', 'Gramedia Pustaka Utama', '\r\nFantasy, Fiction, Novels, Adventure, Young Adult, Science Fiction, Childrens, Family, Mystery ', 103000),
(14, 'Ten Years Challenge ', 'Mutiarini', 'Gramedia Pustaka Utama', 'Romance, Young Adult ', 69000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES
(2, 'maulanafanny38@gmail.com', 'maulanafanny', '$2y$10$DFcLPXHY4/IOsXmZu.YBguszpSk7DjSGZBT0F7igiD9tGEfC89Wae');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entri_buku`
--
ALTER TABLE `entri_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entri_buku`
--
ALTER TABLE `entri_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
