<?php

// Проверяем, были ли переданы данные POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $period = $_POST["lesson_date"];
    $course_group_id = $_POST["group_id"];
    $topic = $_POST["lesson_topic"];

    try {
        require_once "connectpdo.php";

        // Установка режима ошибок PDO в режим исключения
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO Classes (period, course_group_id, topic) VALUES (:period, :course_group_id, :topic)");

        $stmt->bindParam(':period', $period);
        $stmt->bindParam(':course_group_id', $course_group_id);
        $stmt->bindParam(':topic', $topic);

        $stmt->execute();

        // Получаем ID последней вставленной записи
        $classId = $pdo->lastInsertId();
        $newClassData = array(
            'id' => $classId,
            'period' => $period,
            'topic' => $topic
        );

        // Возвращаем данные о занятии в формате JSON
        echo json_encode($newClassData);

    } catch(PDOException $e) {
        echo "Ошибка при добавлении записи в таблицу Classes: " . $e->getMessage();
    }

    // Закрываем соединение с базой данных
    $pdo = null;
}


?>
