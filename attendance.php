<!DOCTYPE html> 
<html> 
<head> 
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Табель посещаемости</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#confirmButton').on('click', function (){
            var attendanceData = [];
            
            // Перебираем все элементы checkbox и собираем данные
            $('input[type=checkbox]').each(function(){
                var studentId = $(this).val();
                var attendanceStatus = this.checked ? '1' : '0';
                var classId = $(this).data('class-id');
                var comment = $(this).closest('li').find('input[type=text]').val();

                attendanceData.push({
                    student_id: studentId,
                    yn: attendanceStatus,
                    class_id: classId,
                    comment: comment
                });
            });

            // Отправляем данные на сервер
            $.ajax({
                url: 'submit_attendance_with_comments.php', // Обновленный путь к PHP-скрипту
                type: 'post',
                data: {attendanceData: JSON.stringify(attendanceData)},
                success: function(response) {
                    console.log('Данные успешно отправлены на сервер');
                },
                error: function(xhr, status, error) {
                    console.error('Произошла ошибка при отправке данных:', error);
                }
            });
        }); 
    });
    </script>
</head> 
<body>
    <div class="container">
        <h1>Табель посещаемости</h1> 
        <form id='attendanceForm' action='submit_attendance_with_comments' method='post'>
            <ul> 
            <?php 
                        require_once "connectpdo.php"; 

                        if(isset($_GET['class_id'])) { 
                            $class_id = $_GET['class_id']; 

                            $stmt = $pdo->prepare(" 
                                INSERT INTO Attendance (class_id, student_id) 
                                SELECT c.id AS class_id, s.id AS student_id 
                                FROM students s 
                                JOIN Groupss g ON s.group_id = g.id 
                                JOIN Courses_Groups cg ON g.id = cg.group_id 
                                JOIN Classes c ON cg.course_id = c.course_group_id 
                                WHERE c.id = :class_id 
                                AND NOT EXISTS ( 
                                    SELECT 1 
                                    FROM Attendance 
                                    WHERE class_id = c.id);"
                            ); 
                            $stmt->bindParam(':class_id', $class_id); 
                            $stmt->execute(); 

                            $stmt = $pdo->prepare("SELECT s.*, a.yn, comm
                            FROM students s
                            JOIN Groupss g ON s.group_id = g.id
                            JOIN Courses_Groups cg ON g.id = cg.group_id
                            JOIN Classes c ON cg.course_id = c.course_group_id
                            LEFT JOIN Attendance a ON s.id = a.student_id AND c.id = a.class_id
                            WHERE c.id = :class_id;");
                            $stmt->bindParam(':class_id', $class_id);
                            $stmt->execute();

                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            echo "<h2>Посещаемость для занятия ID: " . $class_id . "</h2>";
                            echo "<ul>";
                            foreach ($rows as $row) {   
                                $attendanceStatus = $row['yn'];
                                echo "<li>id: " . $row['id']
                                    . " - " . $row['first_name']
                                    . " " . $row['last_name']
                                    . " - Присутствие: "
                                    . "<input type='checkbox' class=checkbox name='att[]' id='att_" . $row['id'] 
                                    . "' value='" . $row['id'] . "' data-class-id='" . $class_id . "'";
                                
                                if ($attendanceStatus == "1") {
                                    echo " checked";
                                }

                                echo ">";

                                echo " <input type='text' class=txtbox value='" . $row['comm'] . "' size='5'></li>"; 

                            }
                            echo "</ul>";
                        } else { 
                            echo "<li>Не указан идентификатор занятия</li>"; 
                        } 
                    ?> 
            </ul>
            <button id="confirmButton" class="btn base-btn btn-lg" type="button">Подтвердить</button>
        </form>
        <a href="class.php" class="btn base-btn btn-lg">Вернуться</a>
        <a href="index.php" class="btn base-btn btn-lg">На главную</a>
    </div>
</body> 
</html>
