-- --------------------------------------------------------
-- Хост:                         109.235.184.198
-- Версия сервера:               10.5.23-MariaDB-0+deb11u1 - Debian 11
-- Операционная система:         debian-linux-gnu
-- HeidiSQL Версия:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных ChernikovD_bd
CREATE DATABASE IF NOT EXISTS `ChernikovD_bd` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ChernikovD_bd`;

-- Дамп структуры для таблица ChernikovD_bd.Attendance
CREATE TABLE IF NOT EXISTS `Attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `comm` text DEFAULT NULL,
  `yn` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `Classes` (`id`),
  CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.Attendance: ~71 rows (приблизительно)
INSERT INTO `Attendance` (`id`, `class_id`, `student_id`, `comm`, `yn`) VALUES
	(97, 80, 7, NULL, 0),
	(98, 80, 11, NULL, 0),
	(99, 80, 15, NULL, 0),
	(100, 79, 7, '', 0),
	(101, 79, 11, '', 0),
	(102, 79, 15, '', 0),
	(103, 84, 7, '', 1),
	(104, 84, 11, '', 1),
	(105, 84, 12, '', 1),
	(106, 84, 15, '', 1),
	(107, 84, 17, '', 0),
	(110, 78, 7, '', 0),
	(111, 78, 11, '', 1),
	(112, 78, 12, '', 1),
	(113, 78, 15, '', 1),
	(114, 78, 17, 'ghj', 1),
	(117, 82, 7, NULL, 0),
	(118, 82, 11, NULL, 0),
	(119, 82, 12, NULL, 0),
	(120, 82, 15, NULL, 0),
	(121, 82, 17, NULL, 0),
	(124, 85, 5, '', 1),
	(125, 85, 10, '', 1),
	(126, 85, 14, 'пар', 0),
	(127, 85, 16, 'парап', 0),
	(131, 100, 5, NULL, 0),
	(132, 100, 10, NULL, 0),
	(133, 100, 14, NULL, 0),
	(134, 100, 16, NULL, 0),
	(138, 101, 5, '', 0),
	(139, 101, 10, '', 0),
	(140, 101, 14, '', 0),
	(141, 101, 16, '', 1),
	(145, 122, 5, '', 1),
	(146, 122, 10, '', 1),
	(147, 122, 14, '', 0),
	(148, 122, 16, '', 0),
	(152, 123, 5, '', 1),
	(153, 123, 10, '', 1),
	(154, 123, 14, '', 0),
	(155, 123, 16, '', 1),
	(159, 164, 7, NULL, 0),
	(160, 164, 11, NULL, 0),
	(161, 164, 12, NULL, 0),
	(162, 164, 15, NULL, 0),
	(163, 164, 17, NULL, 0),
	(166, 81, 7, NULL, 0),
	(167, 81, 11, NULL, 0),
	(168, 81, 12, NULL, 0),
	(169, 81, 15, NULL, 0),
	(170, 81, 17, NULL, 0),
	(173, 165, 7, '', 1),
	(174, 165, 11, '', 1),
	(175, 165, 12, '', 0),
	(176, 165, 15, '', 0),
	(177, 165, 17, '', 0),
	(180, 166, 7, NULL, 0),
	(181, 166, 11, NULL, 0),
	(182, 166, 12, NULL, 0),
	(183, 166, 15, NULL, 0),
	(184, 166, 17, NULL, 0),
	(187, 167, 7, NULL, 0),
	(188, 167, 11, NULL, 0),
	(189, 167, 12, NULL, 0),
	(190, 167, 15, NULL, 0),
	(191, 167, 17, NULL, 0),
	(194, 168, 7, NULL, 0),
	(195, 168, 11, NULL, 0),
	(196, 168, 12, NULL, 0),
	(197, 168, 15, NULL, 0),
	(198, 168, 17, NULL, 0);

-- Дамп структуры для таблица ChernikovD_bd.Classes
CREATE TABLE IF NOT EXISTS `Classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period` date NOT NULL,
  `course_group_id` int(11) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_group_id` (`course_group_id`),
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`course_group_id`) REFERENCES `Courses_Groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.Classes: ~39 rows (приблизительно)
INSERT INTO `Classes` (`id`, `period`, `course_group_id`, `topic`) VALUES
	(78, '2024-04-28', 3, 'Симплекс-метод'),
	(79, '2024-04-11', 3, 'sdfsdffsdsfdsfdsdfsdfsdffsdfsdfsdsdfsfdsfdfsdsdffsdsfdsfdfsdsfd'),
	(80, '2024-04-20', 3, '324234'),
	(81, '2024-04-20', 3, '324234'),
	(82, '2024-04-20', 3, '324234'),
	(83, '2024-04-20', 3, '324234'),
	(84, '2024-04-28', 3, 'nmvm,n'),
	(85, '2024-04-29', 2, 'ывупавы'),
	(100, '2024-04-30', 2, '124'),
	(101, '2024-04-29', 2, '124'),
	(102, '2024-04-30', 3, 'fsdfsd'),
	(103, '2024-04-30', 3, 'fsdfsd'),
	(104, '2024-04-30', 3, 'fsdfsd'),
	(105, '2024-04-30', 3, 'ssss'),
	(106, '2024-04-30', 3, 'ssss'),
	(107, '2024-04-30', 3, 'ssss'),
	(108, '2024-04-30', 3, 'ssss'),
	(109, '2024-04-29', 3, '123123123'),
	(110, '2024-04-29', 3, '123123123'),
	(111, '2024-04-29', 3, '123123123'),
	(112, '2024-04-29', 3, '123123123'),
	(113, '2024-04-29', 3, '123123123'),
	(114, '2024-04-29', 3, '123123123'),
	(115, '2024-04-29', 3, '123123123'),
	(116, '2024-04-29', 3, '123123123'),
	(117, '2024-04-29', 3, '123123123'),
	(118, '2024-04-29', 3, '123123123'),
	(119, '2024-04-29', 3, '123123123'),
	(122, '2024-04-04', 2, '213123'),
	(123, '2024-04-18', 2, '213213123'),
	(124, '2024-04-18', 3, 'gjdtyj'),
	(161, '2024-04-03', 3, 'Симплекс-метод'),
	(162, '2024-04-09', 3, 'Тайно Дернул'),
	(163, '2024-04-30', 3, 'asdfsad'),
	(164, '2024-05-01', 3, 'fgdh'),
	(165, '2024-05-02', 3, 'ваыпвап'),
	(166, '2024-05-06', 3, 'dgf'),
	(167, '2024-05-08', 3, 'dgfw'),
	(168, '2024-05-08', 3, 'dgfw');

-- Дамп структуры для таблица ChernikovD_bd.Courses
CREATE TABLE IF NOT EXISTS `Courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `about` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.Courses: ~15 rows (приблизительно)
INSERT INTO `Courses` (`id`, `title`, `about`) VALUES
	(1, 'Исследование операций и методы оптимизации', 'Макарова И.Л.'),
	(2, 'Технологии программирования', 'Попов Д.И.'),
	(3, 'Базы данных', 'Казаков В.Г.'),
	(4, 'Информационная безопасность', 'Симаворян С.Ж.'),
	(5, 'Операционные системы', 'Драч В.Е.'),
	(6, 'Проектирование информационных систем', 'Коваленко В.В.'),
	(10, 'Информационные системы и технологии', NULL),
	(11, 'Вычислительные системы, сети и телекоммуникации', NULL),
	(12, 'Дискретная математика', NULL),
	(13, 'Теория вероятностей и математическая статистика', NULL),
	(14, 'Безопасность жизнедеятельности', NULL),
	(15, 'Информатика', NULL),
	(16, 'Иностранный язык', NULL),
	(17, 'Экономическая теория', NULL),
	(18, 'Физика', NULL);

-- Дамп структуры для таблица ChernikovD_bd.Courses_Groups
CREATE TABLE IF NOT EXISTS `Courses_Groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `courses_groups_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`id`),
  CONSTRAINT `courses_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `Groupss` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.Courses_Groups: ~15 rows (приблизительно)
INSERT INTO `Courses_Groups` (`id`, `course_id`, `group_id`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 3, 3),
	(7, 4, 1),
	(8, 5, 2),
	(9, 6, 3),
	(19, 10, 3),
	(20, 11, 3),
	(21, 12, 3),
	(22, 13, 3),
	(23, 14, 3),
	(24, 15, 3),
	(25, 16, 3),
	(26, 17, 3),
	(27, 18, 3);

-- Дамп структуры для таблица ChernikovD_bd.Groupss
CREATE TABLE IF NOT EXISTS `Groupss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_num` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.Groupss: ~3 rows (приблизительно)
INSERT INTO `Groupss` (`id`, `serial_num`) VALUES
	(1, '22-ПИЭ-2'),
	(2, '22-ПИЭ-1'),
	(3, '22-ПИЦ');

-- Дамп структуры для таблица ChernikovD_bd.students
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_group_id` (`group_id`),
  CONSTRAINT `fk_group_id` FOREIGN KEY (`group_id`) REFERENCES `Groupss` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.students: ~15 rows (приблизительно)
INSERT INTO `students` (`id`, `first_name`, `last_name`, `email`, `birth_date`, `group_id`) VALUES
	(3, 'John', 'Doe', 'john.doe@example.com', '1990-05-15', 1),
	(4, 'Alice', 'Smith', 'alice.smith@example.com', '1992-08-20', 1),
	(5, 'Bob', 'Johnson', 'bob.johnson@example.com', '1991-03-10', 2),
	(6, 'Emily', 'Taylor', 'emily.taylor@example.com', '1993-06-28', 1),
	(7, 'Michael', 'Harris', 'michael.harris@example.com', '1991-10-15', 3),
	(8, 'Sophia', 'Lee', 'sophia.lee@example.com', '1990-09-18', 1),
	(9, 'Daniel', 'Walker', 'daniel.walker@example.com', '1992-12-05', 1),
	(10, 'Mia', 'Wright', 'mia.wright@example.com', '1993-08-22', 2),
	(11, 'Matthew', 'Evans', 'matthew.evans@example.com', '1991-05-07', 3),
	(12, 'Charlotte', 'King', 'charlotte.king@example.com', '1994-03-14', 3),
	(13, 'Ethan', 'Green', 'ethan.green@example.com', '1990-11-30', 1),
	(14, 'Amelia', 'Baker', 'amelia.baker@example.com', '1993-07-26', 2),
	(15, 'Aiden', 'Hill', 'aiden.hill@example.com', '1992-04-11', 3),
	(16, 'Harper', 'Adams', 'harper.adams@example.com', '1991-01-26', 2),
	(17, 'Oliver', 'Nelson', 'oliver.nelson@example.com', '1994-10-03', 3);

-- Дамп структуры для таблица ChernikovD_bd.Teachers
CREATE TABLE IF NOT EXISTS `Teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.Teachers: ~4 rows (приблизительно)
INSERT INTO `Teachers` (`id`, `first_name`, `last_name`, `email`) VALUES
	(1, 'Anna', 'Johnson', 'anna.johnson@example.com'),
	(2, 'David', 'Smith', 'david.smith@example.com'),
	(3, 'Emily', 'Brown', 'emily.brown@example.com'),
	(4, 'James', 'Jones', 'james.jones@example.com');

-- Дамп структуры для таблица ChernikovD_bd.Teachers_Courses
CREATE TABLE IF NOT EXISTS `Teachers_Courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `teacher_course_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `Teachers` (`id`),
  CONSTRAINT `teacher_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.Teachers_Courses: ~5 rows (приблизительно)
INSERT INTO `Teachers_Courses` (`id`, `teacher_id`, `course_id`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 3, 3),
	(4, 4, 1),
	(5, 1, 3);

-- Дамп структуры для таблица ChernikovD_bd.Users
CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Дамп данных таблицы ChernikovD_bd.Users: ~0 rows (приблизительно)

-- Дамп структуры для триггер ChernikovD_bd.classes_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER classes_after_insert
AFTER INSERT ON Classes
FOR EACH ROW
BEGIN
    INSERT INTO Attendance (class_id, student_id, comm, yn)
    SELECT NEW.id, students.id, NULL, 0
    FROM students
    JOIN Courses_Groups ON students.group_id = Courses_Groups.group_id
    WHERE Courses_Groups.course_id = NEW.course_group_id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
