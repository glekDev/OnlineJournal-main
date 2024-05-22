<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Посещаемость студента</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Личный кабинет студента</h2>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="post">
                    <div class="mb-3">
                        <label for="studentId" class="form-label">ID студента:</label>
                        <input type="text" class="form-control" id="studentId" name="studentId">
                    </div>
                    <button type="submit" class="btn btn-primary">Показать посещаемость</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                // Подключение к базе данных
                require_once "connectpdo.php";

                // Проверяем, была ли отправлена форма
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Получаем ID студента из формы
                    $studentId = $_POST['studentId'];

                    // Запрос к базе данных для получения данных о студенте и его посещаемости
                    $sqlStudent = "SELECT students.id, students.first_name, students.last_name, students.email, Groupss.serial_num AS group_name
                                   FROM students
                                   LEFT JOIN Groupss ON students.group_id = Groupss.id
                                   WHERE students.id = ?";
                    $stmtStudent = $pdo->prepare($sqlStudent);
                    $stmtStudent->execute([$studentId]);
                    $studentInfo = $stmtStudent->fetch(PDO::FETCH_ASSOC);

                    // Вывод информации о студенте
                    if ($studentInfo) {
                        echo "<h2>Информация о студенте:</h2>";
                        echo "<table class='table table-bordered'>";
                        echo "<tr><th>Группа</th><td>" . $studentInfo['group_name'] . "</td></tr>";
                        echo "<tr><th>Фамилия</th><td>" . $studentInfo['last_name'] . "</td></tr>";
                        echo "<tr><th>Имя</th><td>" . $studentInfo['first_name'] . "</td></tr>";
                        echo "<tr><th>Email</th><td>" . $studentInfo['email'] . "</td></tr>";
                        
                        echo "</table>";

                        // Запрос к базе данных для получения данных о посещаемости занятий для данного студента
                        $sqlAttendance = "SELECT Attendance.id, Attendance.comm, Attendance.yn, Classes.topic 
                                          FROM Attendance 
                                          LEFT JOIN Classes ON Attendance.class_id = Classes.id
                                          WHERE student_id = ?";
                        $stmtAttendance = $pdo->prepare($sqlAttendance);
                        $stmtAttendance->execute([$studentId]);
                        $attendanceInfo = $stmtAttendance->fetchAll();

                        // Вывод данных о посещаемости занятий для данного студента
                        if ($attendanceInfo) {
                            echo "<h2>Посещаемость студента:</h2>";
                            echo "<table class='table table-bordered'>";
                            echo "<thead><tr><th>ID</th><th>Тема занятия</th><th>Комментарий</th><th>Присутствие</th></tr></thead>";
                            echo "<tbody>";
                            foreach ($attendanceInfo as $row) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["topic"] . "</td>";
                                echo "<td>" . $row["comm"] . "</td>";
                                echo "<td class='" . ($row["yn"] == 1 ? "text-success" : "text-danger") . "'>" . ($row["yn"] == 1 ? "Присутствовал" : "Не присутствовал") . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                        } else {
                            echo "<p class='text-danger'>Для студента с ID $studentId нет данных о посещении занятий.</p>";
                        }
                    } else {
                        echo "<p class='text-danger'>Студент с ID $studentId не найден.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="index.php" class="btn btn-lg btn-primary me-2">Вернуться</a>
                <a href="index.php" class="btn btn-lg btn-primary">На главную</a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
