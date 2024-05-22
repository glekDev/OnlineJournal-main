<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Посещаемость занятий по группе и курсу</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <label for="group">Выберите группу:</label>
        <select id="group" name="group_id">
            <?php
            // Подключение к базе данных для получения групп
            require 'connectpdo.php'; // Подключаем файл с подключением к БД
            
            $groups = $pdo->query("SELECT * FROM Groupss");
            while ($row = $groups->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>{$row['serial_num']}</option>";
            }
            ?>
        </select>
        <label for="course">Выберите курс:</label>
        <select id="course" name="course_id">
            <?php
            // Подключение к базе данных для получения курсов
            $courses = $pdo->query("SELECT * FROM Courses");
            while ($row = $courses->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>{$row['title']}</option>";
            }
            ?>
        </select>
        <input type="submit" value="Показать посещаемость">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $group_id = $_POST['group_id'];
        $course_id = $_POST['course_id'];

        // Получаем список студентов для выбранной группы
        $studentsQuery = $pdo->prepare("SELECT * FROM students WHERE group_id = :group_id");
        $studentsQuery->execute(['group_id' => $group_id]);
        $students = $studentsQuery->fetchAll(PDO::FETCH_ASSOC);

        // Запрос на получение занятий по выбранной группе и курсу
        $classesQuery = $pdo->prepare("
            SELECT c.id, c.topic 
            FROM Classes AS c
            WHERE c.course_group_id = :group_id AND c.period = :course_id
        ");
        $classesQuery->execute(['group_id' => $group_id, 'course_id' => $course_id]);
        $classes = $classesQuery->fetchAll(PDO::FETCH_ASSOC);

        // Отображение результатов
        echo "<h2>Посещаемость занятий по группе и курсу</h2>";
        echo "<table>";
        echo "<tr><th>Имя студента</th>";

        // Создание заголовков столбцов для каждого занятия
        foreach ($classes as $class) {
            echo "<th>{$class['topic']}</th>";
        }
        echo "</tr>";
        
        // Создание строки для каждого студента
        foreach ($students as $student) {
            echo "<tr><td>{$student['first_name']} {$student['last_name']}</td>";
            foreach ($classes as $class) {
                // Проверяем посещаемость студента на занятии
                $attendanceQuery = $pdo->prepare("
                    SELECT COUNT(*) as attendance 
                    FROM Attendance 
                    WHERE class_id = :class_id AND student_id = :student_id AND yn = 1
                ");
                $attendanceQuery->execute(['class_id' => $class['id'], 'student_id' => $student['id']]);
                $attendance = $attendanceQuery->fetch(PDO::FETCH_ASSOC);
                echo "<td>{$attendance['attendance']}</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>
</body>
</html>
