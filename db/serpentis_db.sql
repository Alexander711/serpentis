-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 07 2015 г., 12:22
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `serpentis_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `priv_transport`
--

CREATE TABLE IF NOT EXISTS `priv_transport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_widget` int(11) DEFAULT NULL,
  `html_priv_transport` text,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `priv_transport`
--

INSERT INTO `priv_transport` (`id`, `id_widget`, `html_priv_transport`, `create_date`) VALUES
(2, 19, '&lt;iframe src=&quot;https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d363540.40474023565!2d33.63802210000001!3d44.61421550000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x409525ef659144f5%3A0xbd2da7afff4d34cc!2z0KHQtdCy0LDRgdGC0L7Qv9C-0LvRjA!5e0!3m2!1sru!2sru!4v1438816018886&quot; width=&quot;487&quot; height=&quot;274&quot; frameborder=&quot;0&quot; style=&quot;border:0&quot; allowfullscreen&gt;&lt;/iframe&gt;', '2015-08-03 07:45:59'),
(3, 26, 'test', '2015-08-06 17:46:18');

-- --------------------------------------------------------

--
-- Структура таблицы `pub_transport`
--

CREATE TABLE IF NOT EXISTS `pub_transport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_widget` int(11) DEFAULT NULL,
  `html_pub_transport` text,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `pub_transport`
--

INSERT INTO `pub_transport` (`id`, `id_widget`, `html_pub_transport`, `create_date`) VALUES
(3, 19, '&lt;iframe src=&quot;https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d90363.0727831804!2d34.10921340000002!3d44.946798000000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40eadddedf991cc5%3A0x9c29422fbc780b40!2z0KHQuNC80YTQtdGA0L7Qv9C-0LvRjA!5e0!3m2!1sru!2sru!4v1438816281051&quot; width=&quot;487&quot; height=&quot;274&quot; frameborder=&quot;0&quot; style=&quot;border:0&quot; allowfullscreen&gt;&lt;/iframe&gt;', '2015-08-04 13:02:58');

-- --------------------------------------------------------

--
-- Структура таблицы `rent_car`
--

CREATE TABLE IF NOT EXISTS `rent_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_widget` int(11) DEFAULT NULL,
  `html_rent_car` text,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `rent_car`
--

INSERT INTO `rent_car` (`id`, `id_widget`, `html_rent_car`, `create_date`) VALUES
(1, 19, '&lt;iframe src=&quot;https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44975.5323177505!2d33.359299449999995!3d45.207927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c01f8e9a222bad%3A0x67f29b22a55ab386!2z0JXQstC_0LDRgtC-0YDQuNGP!5e0!3m2!1sru!2sru!4v1438816415215&quot; width=&quot;487&quot; height=&quot;274&quot; frameborder=&quot;0&quot; style=&quot;border:0&quot; allowfullscreen&gt;&lt;/iframe&gt;', '2015-08-04 13:02:59'),
(2, 26, '&lt;i&gt;ttttttt&lt;/i&gt;', '2015-08-07 10:06:07');

-- --------------------------------------------------------

--
-- Структура таблицы `sms_history`
--

CREATE TABLE IF NOT EXISTS `sms_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `phone_contact` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `sms_history`
--

INSERT INTO `sms_history` (`id`, `id_user`, `site_url`, `phone_contact`, `type`, `status`, `date_created`) VALUES
(1, 2, 'test1', '+79788368085', 'taxi', '1', '2015-08-06 10:08:50'),
(2, 2, 'test1', '+79788368085', 'taxi', '1', '2015-08-06 10:16:29'),
(3, 2, 'test1', '+79788368082', 'taxi', '1', '2015-08-06 11:23:41'),
(4, 2, 'test1', '+79788368082', 'taxi', '1', '2015-08-06 12:10:20'),
(5, 2, 'test1', '+79788368085', 'taxi', '1', '2015-08-06 12:43:25'),
(6, 2, 'test1', '+79788368085', 'taxi', '1', '2015-08-06 12:48:14'),
(7, 2, 'test2', '+79788368085', 'rent_car', '1', '2015-08-06 13:11:15'),
(8, 2, 'test1', '+79788368085', 'taxi', '1', '2015-08-06 13:12:47'),
(9, 2, 'test713', '+79788368085', 'taxi', '1', '2015-08-07 10:06:30'),
(10, 2, 'test713', '+79788368085', 'rent_car', '1', '2015-08-07 10:06:41');

-- --------------------------------------------------------

--
-- Структура таблицы `taxi`
--

CREATE TABLE IF NOT EXISTS `taxi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_widget` int(11) DEFAULT NULL,
  `html_taxi` text,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `taxi`
--

INSERT INTO `taxi` (`id`, `id_widget`, `html_taxi`, `create_date`) VALUES
(2, 18, 'dasadasdasd', '2015-08-02 13:13:53'),
(3, 19, '&lt;iframe src=&quot;https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45530.49524764703!2d34.1601309!3d44.501715999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4094c9077c8d204b%3A0x7c5f808a64d487ae!2z0K_Qu9GC0LA!5e0!3m2!1sru!2sru!4v1438816363123&quot; width=&quot;487&quot; height=&quot;274&quot; frameborder=&quot;0&quot; style=&quot;border:0&quot; allowfullscreen&gt;&lt;/iframe&gt;', '2015-08-04 13:02:59'),
(4, 26, '&lt;strong&gt;echo&lt;/strong&gt;', '2015-08-07 09:52:18');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `pass`, `phone`, `date_created`) VALUES
(2, 'Александр', 'Козлов', 'const716@gmail.com', '96e79218965eb72c92a549dd5a330112', '+79788368085', '2014-11-10 10:25:40');

-- --------------------------------------------------------

--
-- Структура таблицы `widgets`
--

CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `code_widget` varchar(255) DEFAULT NULL,
  `is_installed` int(1) NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `img_marker` varchar(255) DEFAULT NULL,
  `img_map` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `widgets`
--

INSERT INTO `widgets` (`id`, `id_user`, `site_url`, `code_widget`, `is_installed`, `is_active`, `img_marker`, `img_map`, `date_created`) VALUES
(18, 2, 'test', '94803748292773508993934964654662', 0, 1, 'img_marker.png', 'img_map.png', '2015-08-02 13:13:53'),
(19, 2, 'test711', '67390130130615277426728508565211', 0, 1, 'img_marker.png', 'img_map.png', '2015-08-02 13:22:13'),
(20, 2, 'test5', '15271571216004447521262955674773', 0, 1, '8ff0ce6ded099dfaf5f5cf23af858944.jpg', '9a8f6fd747891d5c0d63d42b70db63ac.jpg', '2015-08-02 13:30:59'),
(26, 2, 'test713', '97792562961768505360178153033941', 0, 1, 'img_marker.png', 'img_map.png', '2015-08-06 15:48:44');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
