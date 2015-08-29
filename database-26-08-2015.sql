{\rtf1\ansi\ansicpg1252\cocoartf1347\cocoasubrtf570
{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural

\f0\fs24 \cf0 -- phpMyAdmin SQL Dump\
-- version 4.4.1.1\
-- http://www.phpmyadmin.net\
--\
-- Host: localhost\
-- Generation Time: Aug 26, 2015 at 03:13 PM\
-- Server version: 5.5.42\
-- PHP Version: 5.6.7\
\
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";\
SET time_zone = "+00:00";\
\
--\
-- Database: `media`\
--\
\
-- --------------------------------------------------------\
\
--\
-- Table structure for table `media`\
--\
\
CREATE TABLE `media` (\
  `id` int(11) NOT NULL,\
  `imdbid` text NOT NULL,\
  `title` text NOT NULL,\
  `year` int(11) NOT NULL,\
  `plot` text NOT NULL,\
  `posterURL` text NOT NULL COMMENT 'URL to the movie poster on IMDB',\
  `director` text NOT NULL,\
  `genre` text NOT NULL,\
  `media_type` text NOT NULL\
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;\
\
--\
-- Dumping data for table `media`\
--\
\
INSERT INTO `media` (`id`, `imdbid`, `title`, `year`, `plot`, `posterURL`, `director`, `genre`, `media_type`) VALUES\
(143, 'tt0286716', 'Hulk', 2003, 'Bruce Banner, a genetics researcher with a tragic past, suffers an accident that causes him to transform into a raging green monster when he gets angry.', 'http://ia.media-imdb.com/images/M/MV5BMTQxNzUxNTE4Nl5BMl5BanBnXkFtZTYwMjcyNTk5._V1_SX300.jpg', 'Ang Lee', 'Action, Sci-Fi', 'bluray');\
\
--\
-- Indexes for dumped tables\
--\
\
--\
-- Indexes for table `media`\
--\
ALTER TABLE `media`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- AUTO_INCREMENT for dumped tables\
--\
\
--\
-- AUTO_INCREMENT for table `media`\
--\
ALTER TABLE `media`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=144;}