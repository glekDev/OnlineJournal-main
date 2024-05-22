<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Занятие</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Занятия группы по курсу</h2>
            </div>
        </div>
    </div>
</header>

<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                require_once "connectpdo.php";

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    echo "<form id='addClassForm' action='add_class.php' method='post' class='mb-4'>";
                    echo "<input type='hidden' name='group_id' value='" . $id . "'>";
                    echo "<div class='mb-3'><label for='lesson_date' class='form-label'>Дата занятия:</label><input type='date' class='form-control' id='lesson_date' name='lesson_date' required></div>";
                    echo "<div class='mb-3'><label for='lesson_topic' class='form-label'>Тема занятия:</label><input type='text' class='form-control' id='lesson_topic' name='lesson_topic' required></div>";
                    echo "<button type='submit' class='btn btn-primary'>Добавить занятие</button>";
                    echo "</form>";

                    // Получение данных о студентах
                    $studentsStmt = $pdo->prepare("SELECT students.id AS student_id, first_name, last_name FROM students WHERE group_id = :id");
                    $studentsStmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $studentsStmt->execute();
                    $students = $studentsStmt->fetchAll(PDO::FETCH_ASSOC);

                    // Получение данных о занятиях
                    $classesStmt = $pdo->prepare("SELECT Classes.id AS class_id, period, topic FROM Classes
                                                  JOIN Courses_Groups ON Courses_Groups.course_id = Classes.course_group_id
                                                  WHERE Courses_Groups.group_id = :id
                                                  ORDER BY period");
                    $classesStmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $classesStmt->execute();
                    $classes = $classesStmt->fetchAll(PDO::FETCH_ASSOC);

                    // Получение данных о посещаемости
                    $attendanceStmt = $pdo->prepare("SELECT * FROM Attendance WHERE student_id IN (SELECT id FROM students WHERE group_id = :id)");
                    $attendanceStmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $attendanceStmt->execute();
                    $attendance = $attendanceStmt->fetchAll(PDO::FETCH_ASSOC);

                    // Преобразование данных о посещаемости в удобный для использования формат
                    $attendanceData = [];
                    foreach ($attendance as $att) {
                        $attendanceData[$att['student_id']][$att['class_id']] = $att['yn'];
                    }

                    // Построение таблицы
                    echo "<h2 class='text-center mb-4'>Посещаемость</h2>";
                    echo "<table class='table table-bordered'>";
                    echo "<thead class='thead-dark'><tr><th>Студенты</th>";
                    foreach ($classes as $class) {
                        echo "<th>Занятие " . $class['class_id'] . "<br>" . $class['period'] . "<br>" . $class['topic'] . "</th>";
                    }
                    echo "</tr></thead>";
                    echo "<tbody>";
                    foreach ($students as $student) {
                        echo "<tr><td>" . $student['first_name'] . " " . $student['last_name'] . "</td>";
                        foreach ($classes as $class) {
                            $isPresent = isset($attendanceData[$student['student_id']][$class['class_id']]) ? $attendanceData[$student['student_id']][$class['class_id']] : 0;
                            echo "<td class='attendance-cell' data-student-id='" . $student['student_id'] . "' data-class-id='" . $class['class_id'] . "'>" . ($isPresent ? "<span class='text-success'>✔</span>" : "<span class='text-danger'>✘</span>") . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p class='text-danger'>Не указан идентификатор группы</p>";
                }
                ?>

                <?php
                // Код пагинации
                $itemsPerPage = 10; // Количество занятий на странице
                $page = isset($_GET['page']) ? $_GET['page'] : 1; // Текущая страница
                $offset = ($page - 1) * $itemsPerPage;

                // Запрос для получения данных занятий с пагинацией
                $paginationStmt = $pdo->prepare("SELECT Classes.id AS class_id, Classes.period, Classes.topic FROM Classes 
                                                 JOIN Courses_Groups ON Courses_Groups.course_id = Classes.course_group_id 
                                                 WHERE Courses_Groups.group_id = :id
                                                 LIMIT :offset, :itemsPerPage");
                $paginationStmt->bindParam(':id', $id, PDO::PARAM_INT);
                $paginationStmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $paginationStmt->bindParam(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
                $paginationStmt->execute();

                // Выполняем запрос для подсчета общего количества занятий
                $countStmt = $pdo->prepare("SELECT COUNT(*) AS total FROM Classes 
                JOIN Courses_Groups ON Courses_Groups.course_id = Classes.course_group_id 
                WHERE Courses_Groups.group_id = :id");
                $countStmt->bindParam(':id', $id, PDO::PARAM_INT);
                $countStmt->execute();
                $result = $countStmt->fetch(PDO::FETCH_ASSOC);

                // Добавляем пагинацию
                $totalItems = $result['total']; // Общее количество занятий
                $totalPages = ceil($totalItems / $itemsPerPage);
                $currentPage = $page;

                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1) : ?>
                            <li class="page-item"><a class="page-link" href="?id=<?php echo $id; ?>&page=<?php echo ($currentPage - 1); ?>">Previous</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++)
: ?>
<li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>"><a class="page-link" href="?id=<?php echo $id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php endfor; ?>

<?php if ($currentPage < $totalPages) : ?>
<li class="page-item"><a class="page-link" href="?id=<?php echo $id; ?>&page=<?php echo ($currentPage + 1); ?>">Next</a></li>
<?php endif; ?>
</ul>
</nav>

</div>
</div>
</div>
</section>

<footer class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <a href="courses.php?id=<?php echo $id; ?>" class="btn btn-lg btn-primary me-2">Вернуться</a>
                <a href="index.php" class="btn btn-lg btn-primary">На главную</a>
            </div>
        </div>
    </div>
</footer>

<script>
$(document).ready(function() {
    $('.attendance-cell').click(function() {
        var cell = $(this);
        var studentId = cell.data('student-id');
        var classId = cell.data('class-id');
        var isPresent = cell.html().includes('text-success') ? 0 : 1; // Переключаем состояние

        $.ajax({
            type: 'POST',
            url: 'submit_attendance_with_comments.php', // Обновленный путь к PHP-скрипту
            data: { student_id: studentId, class_id: classId, yn: isPresent },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    // Если запрос выполнен успешно, обновляем ячейку
                    cell.html(isPresent ? "<span class='text-success'>✔</span>" : "<span class='text-danger'>✘</span>");
                } else {
                    alert('Произошла ошибка при обновлении посещаемости: ' + data.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Произошла ошибка: ' + error);
            }
        });
    });
});
</script>

</body>
</html>
