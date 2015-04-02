-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02 Kwi 2015, 18:15
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `workshop1`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `text`) VALUES
(1, 4, 1, 'Podoba mi sie'),
(2, 4, 1, 'Podoba mi sie'),
(3, 4, 1, 'Nowy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id1` (`user_id1`,`user_id2`),
  KEY `user_id2` (`user_id2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `friends`
--

INSERT INTO `friends` (`id`, `user_id1`, `user_id2`) VALUES
(1, 1, 2),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `text` text COLLATE utf8_polish_ci NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_from` (`user_from`,`user_to`),
  KEY `user_to` (`user_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `user_from`, `user_to`, `text`, `is_read`) VALUES
(1, 1, 2, '', 0),
(2, 1, 2, 'Test 2 Test 2 Test 2', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `text` varchar(140) COLLATE utf8_polish_ci NOT NULL,
  `is_private` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `text`, `is_private`) VALUES
(2, 1, 'Test test test', 0),
(3, 1, 'Test 2 Test 2 Test 2', 0),
(4, 2, 'A', 0),
(5, 2, 'B', 0),
(6, 2, 'C', 0),
(7, 2, 'D', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `mail`, `password`, `name`, `surname`) VALUES
(1, 'Admin', 'admin@admin', '$2y$11$6a5xm8Zh/krmNkTdExTIA.iTlVNW0iC0mlcaigiOpPpGYfcsU3VCy', 'maxiz', 'AAAaa'),
(2, 'ktos', 'ktos@ktos', '$2y$11$An8uHBYriyG3KltsD0WEi.0MpUg45.0c9vlQ.m16BG1UByg0ndNaO', 'ktos', 'ktos1'),
(3, 'jacek', 'jacek@jacek', '$2y$11$iR5vsEeemPKFtAchLetigeZBvLIcQUGqqWvCDRrpCkJix0Gad1xEa', 'jacek', 'jacek1');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `post_comment` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friend_higher_id` FOREIGN KEY (`user_id2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friend_lower_id` FOREIGN KEY (`user_id1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `reciever` FOREIGN KEY (`user_to`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sender` FOREIGN KEY (`user_from`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user_post` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
