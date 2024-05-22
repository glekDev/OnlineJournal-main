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
) ENGINE=InnoDB AUTO_INCREMENT=307 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.Attendance: ~35 rows (приблизительно)
INSERT INTO `Attendance` (`id`, `class_id`, `student_id`, `comm`, `yn`) VALUES
	(264, 185, 7, '', 1),
	(265, 185, 11, '', 1),
	(266, 185, 12, '', 0),
	(267, 185, 15, '', 0),
	(268, 185, 17, '', 0),
	(271, 186, 7, NULL, 0),
	(272, 186, 11, NULL, 0),
	(273, 186, 12, NULL, 0),
	(274, 186, 15, NULL, 0),
	(275, 186, 17, NULL, 0),
	(278, 187, 7, NULL, 0),
	(279, 187, 11, NULL, 0),
	(280, 187, 12, NULL, 0),
	(281, 187, 15, NULL, 0),
	(282, 187, 17, NULL, 0),
	(285, 188, 7, NULL, 0),
	(286, 188, 11, NULL, 0),
	(287, 188, 12, NULL, 0),
	(288, 188, 15, NULL, 0),
	(289, 188, 17, NULL, 0),
	(292, 189, 7, NULL, 0),
	(293, 189, 11, NULL, 0),
	(294, 189, 12, NULL, 0),
	(295, 189, 15, NULL, 0),
	(296, 189, 17, NULL, 0),
	(297, 190, 7, NULL, 0),
	(298, 190, 11, NULL, 0),
	(299, 190, 12, NULL, 0),
	(300, 190, 15, NULL, 0),
	(301, 190, 17, NULL, 0),
	(302, 191, 7, NULL, 0),
	(303, 191, 11, NULL, 0),
	(304, 191, 12, NULL, 0),
	(305, 191, 15, NULL, 0),
	(306, 191, 17, NULL, 0);

-- Дамп структуры для таблица ChernikovD_bd.Classes
CREATE TABLE IF NOT EXISTS `Classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period` date NOT NULL,
  `course_group_id` int(11) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_group_id` (`course_group_id`),
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`course_group_id`) REFERENCES `Courses_Groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.Classes: ~7 rows (приблизительно)
INSERT INTO `Classes` (`id`, `period`, `course_group_id`, `topic`) VALUES
	(185, '2024-05-20', 3, '3НФ'),
	(186, '2024-05-22', 3, '123'),
	(187, '2024-05-22', 3, '123'),
	(188, '2024-05-22', 3, '123'),
	(189, '2024-05-21', 3, '123'),
	(190, '2024-05-21', 3, 'dfgfdg'),
	(191, '2024-05-22', 3, 'dfghdfg');

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
  `subgroup_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_group_id` (`group_id`),
  CONSTRAINT `fk_group_id` FOREIGN KEY (`group_id`) REFERENCES `Groupss` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Дамп данных таблицы ChernikovD_bd.students: ~14 rows (приблизительно)
INSERT INTO `students` (`id`, `first_name`, `last_name`, `email`, `birth_date`, `group_id`, `subgroup_id`) VALUES
	(4, 'Alice', 'Smith', 'alice.smith@example.com', '1992-08-20', 1, 1),
	(5, 'Bobika', 'Johnson', 'bob.johnson@example.com', '1991-03-10', 2, 1),
	(6, 'Emily', 'Taylor', 'emily.taylor@example.com', '1993-06-28', 1, 1),
	(7, 'Michael', 'Harris', 'michael.harris@example.com', '1991-10-15', 3, 1),
	(8, 'Sophia', 'Lee', 'sophia.lee@example.com', '1990-09-18', 1, 2),
	(9, 'Daniel', 'Walker', 'daniel.walker@example.com', '1992-12-05', 1, 2),
	(10, 'Mia', 'Wright', 'mia.wright@example.com', '1993-08-22', 2, 2),
	(11, 'Matthew', 'Evans', 'matthew.evans@example.com', '1991-05-07', 3, 2),
	(12, 'Charlotte', 'King', 'charlotte.king@example.com', '1994-03-14', 3, 2),
	(13, 'Ethan', 'Green', 'ethan.green@example.com', '1990-11-30', 1, 3),
	(14, 'Amelia', 'Baker', 'amelia.baker@example.com', '1993-07-26', 2, 3),
	(15, 'Aiden', 'Hill', 'aiden.hill@example.com', '1992-04-11', 3, 3),
	(16, 'Harper', 'Adams', 'harper.adams@example.com', '1991-01-26', 2, 3),
	(17, 'Oliver', 'Nelson', 'oliver.nelson@example.com', '1994-10-03', 3, 3);

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

-- Дамп структуры для триггер ChernikovD_bd.after_class_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER after_class_insert
AFTER INSERT ON Classes
FOR EACH ROW
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE student_id INT;
    DECLARE cur CURSOR FOR 
        SELECT s.id 
        FROM students s
        JOIN Groupss g ON s.group_id = g.id
        JOIN Courses_Groups cg ON g.id = cg.group_id
        WHERE cg.id = NEW.course_group_id;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO student_id;
        IF done THEN
            LEAVE read_loop;
        END IF;
        INSERT INTO Attendance (class_id, student_id, yn, comm) VALUES (NEW.id, student_id, 0, NULL);
    END LOOP;

    CLOSE cur;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
