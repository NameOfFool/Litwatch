-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 11 2022 г., 20:41
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `literwatch`
--

-- --------------------------------------------------------

--
-- Структура таблицы `komments`
--

CREATE TABLE `komments` (
  `Код_комментария` int NOT NULL,
  `Код_видео` int NOT NULL,
  `Код_автора` int NOT NULL,
  `Содержание` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `komments`
--

INSERT INTO `komments` (`Код_комментария`, `Код_видео`, `Код_автора`, `Содержание`) VALUES
(4, 3, 10, 'Comm of Fool');

-- --------------------------------------------------------

--
-- Структура таблицы `komments_mark`
--

CREATE TABLE `komments_mark` (
  `Код_комментария` int NOT NULL,
  `Код_оценщика` int NOT NULL,
  `Оценка` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `Код_Пользователя` int NOT NULL,
  `Имя_пользователя` varchar(50) NOT NULL,
  `Телефон` varchar(11) NOT NULL,
  `Почта` varchar(50) NOT NULL,
  `Пароль` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Статус_админки` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Код_Пользователя`, `Имя_пользователя`, `Телефон`, `Почта`, `Пароль`, `Статус_админки`) VALUES
(10, 'Fool', '89169354218', 'emailoffool@mail.com', '$2y$10$kjb83y6X.wLXebtmfdvyUu6yam91PNlZKmbtMzuzHShgWcRo5bqPm', b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `videos`
--

CREATE TABLE `videos` (
  `Код_видео` int NOT NULL,
  `Код_автора` int NOT NULL,
  `Название` varchar(20) NOT NULL,
  `Описание` text,
  `Дата_публикации` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `videos`
--

INSERT INTO `videos` (`Код_видео`, `Код_автора`, `Название`, `Описание`, `Дата_публикации`) VALUES
(3, 10, 'VideoOfFool', 'Description of Fool', '2022-04-11');

-- --------------------------------------------------------

--
-- Структура таблицы `video_mark`
--

CREATE TABLE `video_mark` (
  `Код_видео` int NOT NULL,
  `Код_оценщика` int NOT NULL,
  `Оценка` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `video_mark`
--

INSERT INTO `video_mark` (`Код_видео`, `Код_оценщика`, `Оценка`) VALUES
(3, 10, b'1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `komments`
--
ALTER TABLE `komments`
  ADD PRIMARY KEY (`Код_комментария`),
  ADD KEY `Код_автора` (`Код_автора`),
  ADD KEY `Код_видео` (`Код_видео`);

--
-- Индексы таблицы `komments_mark`
--
ALTER TABLE `komments_mark`
  ADD KEY `Код_комментария` (`Код_комментария`),
  ADD KEY `Код_оценщика` (`Код_оценщика`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Код_Пользователя`);

--
-- Индексы таблицы `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`Код_видео`),
  ADD KEY `Код_автора` (`Код_автора`);

--
-- Индексы таблицы `video_mark`
--
ALTER TABLE `video_mark`
  ADD KEY `Код_видео` (`Код_видео`),
  ADD KEY `Код_оценщика` (`Код_оценщика`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `komments`
--
ALTER TABLE `komments`
  MODIFY `Код_комментария` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Код_Пользователя` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `videos`
--
ALTER TABLE `videos`
  MODIFY `Код_видео` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `komments`
--
ALTER TABLE `komments`
  ADD CONSTRAINT `komments_ibfk_1` FOREIGN KEY (`Код_видео`) REFERENCES `videos` (`Код_видео`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komments_ibfk_2` FOREIGN KEY (`Код_автора`) REFERENCES `users` (`Код_Пользователя`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `komments_mark`
--
ALTER TABLE `komments_mark`
  ADD CONSTRAINT `komments_mark_ibfk_1` FOREIGN KEY (`Код_комментария`) REFERENCES `komments` (`Код_комментария`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komments_mark_ibfk_2` FOREIGN KEY (`Код_оценщика`) REFERENCES `users` (`Код_Пользователя`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`Код_автора`) REFERENCES `users` (`Код_Пользователя`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `video_mark`
--
ALTER TABLE `video_mark`
  ADD CONSTRAINT `video_mark_ibfk_1` FOREIGN KEY (`Код_видео`) REFERENCES `videos` (`Код_видео`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `video_mark_ibfk_2` FOREIGN KEY (`Код_оценщика`) REFERENCES `users` (`Код_Пользователя`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
