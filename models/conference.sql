-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 15 2020 г., 14:29
-- Версия сервера: 5.6.43-log
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `conference`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doc`
--

CREATE TABLE `doc` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_visible` tinyint(4) NOT NULL DEFAULT '1',
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `presentation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `doc`
--

INSERT INTO `doc` (`id`, `name`, `description`, `path`, `is_visible`, `extension`, `ordering`, `presentation_id`) VALUES
(1, 'Презентация', 'йцу', 'BUI-MPqfpj6F9CwKBuBzv9re8_PGOBz7.jpg', 1, 'jpg', NULL, NULL),
(2, 'qweqwe', 'qwe', '81_ZaxmXCVVUdUdw8Cjhqa20k_6mw3Td.jpg', 1, 'jpg', NULL, NULL),
(5, 'Аннотация', '', 'O_pbT08Rp8KLnLoWjMU4M2JshssKZ7hg.pdf', 1, 'pdf', NULL, 6),
(6, 'Презентация', '', 'pWgFKJhDG55hl_hosTO8wlIrQv4nAHCy.pdf', 1, 'pdf', NULL, 6),
(7, 'Презентация', '', 'UddzlettM5aWLw42vIKv-PeCkQXYzuMj.pdf', 1, 'pdf', NULL, 2),
(8, 'Аннотация', '', 'PKBOl69TTkL_r66fJWY5iWJL4P1FCOfh.pdf', 1, 'pdf', NULL, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `name`) VALUES
(1, 'fun1KCbA9ZMZczhEEG6a.jpg'),
(2, 'DKdfSZBufpBV3VdWOig9.jpg'),
(3, 'Fc8DKfobN_-hJoMiqKER.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `like`
--

CREATE TABLE `like` (
  `photo_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `like`
--

INSERT INTO `like` (`photo_id`, `person_id`) VALUES
(34, 8),
(35, 8),
(36, 8),
(34, 9),
(36, 9),
(34, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `mark`
--

CREATE TABLE `mark` (
  `id` int(11) NOT NULL,
  `rating_id` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jury_id` int(11) NOT NULL,
  `presentation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `mark`
--

INSERT INTO `mark` (`id`, `rating_id`, `description`, `jury_id`, `presentation_id`) VALUES
(1, 3, ' ', 10, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_2` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vocation` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_role_id` int(11) NOT NULL,
  `organization` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_visible` tinyint(4) DEFAULT '1',
  `info` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `person`
--

INSERT INTO `person` (`id`, `surname`, `name`, `name_2`, `vocation`, `person_role_id`, `organization`, `photo`, `is_visible`, `info`) VALUES
(3, 'Баринов', 'Александр', 'Александрович', 'Заместитель начальника службы', 2, 'АО \"Сибирь\"', '', 1, NULL),
(4, 'Бонькин', 'Алексей', 'Владимирович', 'Инженер-программист', 2, 'АО \"Прикамье\"', '', 1, NULL),
(5, 'Зорин', 'Константин', 'Михайлович', 'Инженер', 2, 'АО \"Прикамье\"', '', 1, NULL),
(6, 'Вальченко', 'Илья', 'Владимирович', 'Начальник сектора программирования', 2, 'АО \"Дальний Восток\"', '', 1, NULL),
(7, 'Константинов', 'Николай', 'Константинович', 'Инженер-электроник', 2, 'АО \"Дальний Восток\"', '', 1, NULL),
(8, 'Вараксин', 'Константин', 'Сергеевич', 'Инженер-химик', 2, 'АО \"Западная Сибирь\"', '', 1, NULL),
(9, 'Ган', 'Дарья', 'Дмитриевна', 'Ведущий специалист', 2, 'АО \"Насосы\"', 'DKdfSZBufpBV3VdWOig9.jpg', 1, ''),
(10, 'Морозов', 'Павел', 'Александрович', 'Вице-президент', 1, 'ПАО \"Москва\"', '', 1, 'С 2008 годя является вице-президентом компании.'),
(11, 'Шишкин', 'Сергей', 'Федорович', 'Начальник технического отдела', 3, 'АО \"Волга\"', '', 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `person_role`
--

CREATE TABLE `person_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_visible` tinyint(4) DEFAULT '1',
  `ordering` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `person_role`
--

INSERT INTO `person_role` (`id`, `name`, `is_visible`, `ordering`) VALUES
(1, 'Члены комиссии', 1, 1),
(2, 'Докладчики', 1, 2),
(3, 'Ведущий', 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `is_visible` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `photo`
--

INSERT INTO `photo` (`id`, `name`, `title`, `is_visible`) VALUES
(23, '7Od5lHVgPedkxF4KKPgnQIMGT93-4Qds', 'Природа', 1),
(24, '3K8urNkuvKRvxhD-AFGZfFlhDqRnLCKR', '-', 1),
(25, '47rdeEF3j06RfncPvKXFON-Svhbfnty9', '-', 1),
(26, '5H5pLgpyE5WO5cHLiZn0UNLKapqDJt7J', '-', 1),
(27, 'RZ62Ty1X9xof9PyVDofP1zpvMWKPl28q', '-', 1),
(28, 'n6o1wg7PLvZ95MSCySsFE1AqfggEVCfv', '-', 1),
(29, '_WGFp2_8g0E6HDWILsjN4YsmGHLsrRkX', '-', 1),
(30, 'WkV9LYTPuRfYB8IX7fHhdyHGFY-Tmzwz', '-', 1),
(31, 'q1f95qpLvxqI1DdEBe07eGo-oLBwBa2E', '-', 1),
(32, 'Aczka-yr5x4K6Rr6IAHbFCKimipAVmq_', '-', 1),
(33, 'v3gYLOeHasf9d5T-Q7poBgED2hQoGE6c', '-', 1),
(34, '7EC--GM6zq8KkfXE9-VxEioyNINKYqL7', '-', 1),
(35, 'BV3jBomWJoSwlamDMzAKHtAecx9zNNKM', '-', 1),
(36, 'L3j6NZCTat4zH8ynY3MMwrR03M5M8cVe', '-', 1),
(37, 'j2hdWHqpo8W5R0Jdpxrcyat1GTMZBJ9_', '-', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `presentation`
--

CREATE TABLE `presentation` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_visible` tinyint(4) DEFAULT '1',
  `section_id` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `is_current` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `presentation`
--

INSERT INTO `presentation` (`id`, `name`, `description`, `organization`, `is_visible`, `section_id`, `ordering`, `is_current`) VALUES
(2, 'Устройство для очистки стенок от загрязнений', 'В данной работе представлено решение по очистке стенок от загрязнений, позволяющее поддержать их эстетический вид на протяжении всего срока эксплуатации.', 'АО \"Сибирь\"', 1, 0, 0, 0),
(3, 'Разработка автоматизирванной системы выдачи ключей', 'В работе рассматривается вопрос о повышении безопасности труда работников предприятия на опасном производстве за счет внедрения и использования системы хранения и выдачи ключей.', 'АО \"Прикамье\"', 1, 0, 0, 0),
(4, 'Повышение эффективности работы системы с использованием информации с датчиков давления', 'При выполнение программы распространяется волна повышенного давления, сокращающая срок службы насосов. \r\nВ работе предлагается алгоритм, учитывающий давление в двух контрольных пунктах.', 'АО \"Дальний Восток\"', 1, 0, 0, 0),
(5, 'Разработка системы управления лабораторной информацией', 'Целью работы является повышение качества обеспечения производственных процессов результатами анализов путем автоматизации информационной составляющей.', 'АО \"Западная Сибирь\"', 1, 0, 0, 0),
(6, 'Внедрение современных систем отслеживания грузов', 'В данной работе используются современные системы отслеживания грузов, определяются экономическая эффективность и целесообразность их внедрения в процесс транспортировки.', 'АО \"Насосы\"', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `presentation_person`
--

CREATE TABLE `presentation_person` (
  `id` int(11) NOT NULL,
  `presentation_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `is_coauthor` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `presentation_person`
--

INSERT INTO `presentation_person` (`id`, `presentation_id`, `person_id`, `is_coauthor`) VALUES
(4, 2, 3, 0),
(5, 3, 4, 0),
(6, 3, 5, 0),
(7, 4, 6, 0),
(8, 4, 7, 1),
(9, 6, 9, 0),
(10, 5, 8, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`id`, `level`, `name`) VALUES
(1, 1, 'Днище'),
(2, 2, 'Так себе'),
(3, 3, 'Отлично'),
(4, 4, '');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(4, 'compere'),
(3, 'jury'),
(2, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `place` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_visible` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `schedule`
--

INSERT INTO `schedule` (`id`, `name`, `date`, `time`, `duration`, `place`, `is_visible`) VALUES
(1, 'Отладка презентаций', '2020-04-13', '09:00:00', 210, 'Конференц-зал', 1),
(2, 'Обед', '2020-04-13', '12:30:00', 60, 'Ресторан', 1),
(3, 'Завтрак', '2020-04-13', '07:30:00', 60, 'Ресторан', 1),
(4, 'Экскурсия по городу', '2020-04-13', '14:00:00', 240, 'Завод ГАЗ', 1),
(5, 'Ужин', '2020-04-13', '18:30:00', 60, 'Ресторан', 1),
(6, 'Завтрак', '2020-04-14', '07:30:00', 60, 'Ресторан', 1),
(7, 'Открытие конференции', '2020-04-14', '09:00:00', 20, 'Конференц-зал', 1),
(8, 'Заслушивание докладов', '2020-04-14', '09:20:00', 160, 'Конференц-зал', 1),
(9, 'Обед', '2020-04-14', '12:30:00', 60, 'Ресторан', 1),
(10, 'Заслушивание докладов', '2020-04-14', '14:00:00', 180, 'Конференц-зал', 1),
(11, 'Фотографирование', '2020-04-14', '17:10:00', 20, 'Конференц-зал', 1),
(12, 'Деловая игра', '2020-04-14', '18:30:00', 180, 'Ресторан Рождественский', 1),
(13, 'Завтрак', '2020-04-15', '07:30:00', 60, 'Ресторан', 1),
(14, 'Заслушивание докладов', '2020-04-15', '09:00:00', 180, 'Конференц-зал', 1),
(15, 'Обед', '2020-04-15', '12:30:00', 60, 'Ресторан', 1),
(16, 'Подведение итогов', '2020-04-15', '14:00:00', 60, 'Зал совещаний', 1),
(17, 'Объявление результатов. Закрытие конференции', '2020-04-15', '15:00:00', 60, 'Конференц-зал', 1),
(18, 'Ужин', '2020-04-15', '18:30:00', 60, 'Ресторан', 1),
(19, 'Убытие участников конференции', '2020-04-16', '09:00:00', 0, '-', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `schedule_presentation`
--

CREATE TABLE `schedule_presentation` (
  `schedule_id` int(11) NOT NULL,
  `presentation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `schedule_presentation`
--

INSERT INTO `schedule_presentation` (`schedule_id`, `presentation_id`) VALUES
(8, 2),
(8, 3),
(10, 4),
(10, 5),
(14, 5),
(14, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `is_visible` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `blocked` tinyint(4) NOT NULL DEFAULT '0',
  `person_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password_hash`, `role_id`, `blocked`, `person_id`) VALUES
(1, 'YaptevSA', '$2y$13$Gtuf3VSAlf19L4IaEV6bqe/IGf.YGJdVuzhl5G9uarw6rtnRazhDy', 1, 0, 0),
(7, 'BarinovAA', '$2y$13$OWuSc9tVgDiRti0aJhjJAeRgnSczi4PZ/c/UskWPwA3ZXNGaaP/pu', 2, 0, 3),
(8, 'BonkinAV', '$2y$13$HsQjvvmdFmZxiylrp/6edesbaqHeXbxi.aKh4q2nN8xn9cnB/cy2K', 2, 0, 4),
(9, 'ZorinKM', '$2y$13$Km7yyrLxyMidYOW8oXV6nOPcseacLv/al9CYYn7xSexjLRhpIFtFG', 2, 0, 5),
(10, 'ValchenkoIV', '$2y$13$Md3lKNYbeEWw3WCuheBs1OyGshMpa1e4yDlcFn7vfEXBFbwrlY9Bi', 2, 0, 6),
(11, 'KonstantinivNK', '$2y$13$vO5tgGvt0tksm3i8YfJGJesywNRQclIszGbF2SCYJvX/dsEgfUOJC', 2, 0, 7),
(12, 'VaraksinKS', '$2y$13$348lxeRxKYlS8lz3a9g26OSdCcyiaNqQJLMAy.DrprcFONCgkJuXm', 2, 0, 8),
(13, 'GanDD', '$2y$13$nyz9mEi.u3dOQTW4//hgJ.RJ40ZsiUw/KUa3/xszKGuM14bh7qbyK', 2, 0, 9),
(14, 'MorozovPA', '$2y$13$Swq3daGHsPjr24EGH/Ck.egrR6zAsVAvue3ERUJ.pz0UslnF/BRaW', 3, 0, 10);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prese_idx` (`presentation_id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`photo_id`,`person_id`),
  ADD KEY `person_like_key_idx` (`person_id`);

--
-- Индексы таблицы `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jury_id` (`jury_id`),
  ADD KEY `rating_id` (`rating_id`),
  ADD KEY `presentation_id` (`presentation_id`);

--
-- Индексы таблицы `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_role_id` (`person_role_id`);

--
-- Индексы таблицы `person_role`
--
ALTER TABLE `person_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `presentation_person`
--
ALTER TABLE `presentation_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presentation_id` (`presentation_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Индексы таблицы `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `schedule_presentation`
--
ALTER TABLE `schedule_presentation`
  ADD PRIMARY KEY (`schedule_id`,`presentation_id`),
  ADD KEY `schedule_presentation_ibfk_2_idx` (`schedule_id`),
  ADD KEY `presentation_id` (`presentation_id`);

--
-- Индексы таблицы `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `doc`
--
ALTER TABLE `doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `mark`
--
ALTER TABLE `mark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `person_role`
--
ALTER TABLE `person_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `presentation`
--
ALTER TABLE `presentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `presentation_person`
--
ALTER TABLE `presentation_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `doc`
--
ALTER TABLE `doc`
  ADD CONSTRAINT `prese` FOREIGN KEY (`presentation_id`) REFERENCES `presentation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `person_like_key` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `photo_like_key` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `mark`
--
ALTER TABLE `mark`
  ADD CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`jury_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`presentation_id`) REFERENCES `presentation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mark_ibfk_3` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`id`);

--
-- Ограничения внешнего ключа таблицы `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`person_role_id`) REFERENCES `person_role` (`id`);

--
-- Ограничения внешнего ключа таблицы `presentation_person`
--
ALTER TABLE `presentation_person`
  ADD CONSTRAINT `presentation_person_ibfk_1` FOREIGN KEY (`presentation_id`) REFERENCES `presentation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `presentation_person_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `schedule_presentation`
--
ALTER TABLE `schedule_presentation`
  ADD CONSTRAINT `schedule_presentation_ibfk_1` FOREIGN KEY (`presentation_id`) REFERENCES `presentation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_presentation_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
