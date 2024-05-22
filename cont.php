<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студенты выбранной группы</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-black">Студенты выбранной группы</h1>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="" method="post">
                    <label for="groupSelect" class="form-label">Выберите группу:</label>
                    <select name="groupSelect" id="groupSelect" class="form-select">
                        <!-- Опции для выбора группы будут добавлены из базы данных -->
                        <?php
                        // Подключение к базе данных
                        require_once "connectpdo.php";

                        // Получение списка групп из базы данных
                        $getGroupsQuery = "SELECT * FROM Groupss";
                        $stmt = $pdo->query($getGroupsQuery);

                        // Вывод опций для выбора группы
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$row['id']}'>{$row['serial_num']}</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Показать студентов</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="" method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Фамилия</th>
                                <th>Email</th>
                                <th>Дата рождения</th>
                                <th>ID группы</th>
                                <th>ID подгруппы</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Проверка, была ли отправлена форма
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Получение выбранной группы из формы
                                $selectedGroupId = $_POST['groupSelect'];

                                // Запрос к базе данных для получения студентов выбранной группы
                                $getStudentsQuery = "SELECT * FROM students WHERE group_id = ?";
                                $stmt = $pdo->prepare($getStudentsQuery);
                                $stmt->execute([$selectedGroupId]);

                                // Вывод данных о студентах выбранной группы
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td><input type='text' name='first_name[]' value='{$row['first_name']}' class='form-control bg-light'></td>";
                                    echo "<td><input type='text' name='last_name[]' value='{$row['last_name']}' class='form-control bg-light'></td>";
                                    echo "<td><input type='text' name='email[]' value='{$row['email']}' class='form-control bg-light col-9'></td>";
                                    echo "<td><input type='date' name='birth_date[]' value='{$row['birth_date']}' class='form-control bg-light'></td>";
                                    echo "<td><input type='text' name='group[]' value='{$row['group_id']}' class='form-control bg-light'></td>";
                                    echo "<td><input type='text' name='subgroup[]' value='{$row['subgroup_id']}' class='form-control bg-light'></td>";
                                    echo "<td><button type='submit' name='update[]' value='{$row['id']}' class='btn btn-success'>Обновить</button></td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                            <!-- Форма для добавления нового студента -->
                            <tr>
                                <td></td>
                                <td><input type='text' name='new_first_name' class='form-control bg-light'></td>
                                <td><input type='text' name='new_last_name' class='form-control bg-light'></td>
                                <td><input type='text' name='new_email' class='form-control bg-light col-9'></td>
                                <td><input type='date' name='new_birth_date' class='form-control bg-light'></td>
                                <td><input type='text' name='new_group' class='form-control bg-light'></td>
                                <td><input type='text' name='new_subgroup' class='form-control bg-light'></td>
                                <td><button type='submit' name='add_new' class='btn btn-primary'>Добавить</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <?php
                // Обработка обновления данных
                if (isset($_POST['update'])) {
                    $studentsCount = count($_POST['update']);

                    for ($i = 0; $i < $studentsCount; $i++) {
                        $studentId = $_POST['update'][$i];
                        $firstName = $_POST['first_name'][$i];
                        $lastName = $_POST['last_name'][$i];
                        $email = $_POST['email'][$i];
                        $birthDate = $_POST['birth_date'][$i];
                        $subgroup = $_POST['subgroup'][$i];

                        // Проверяем, существует ли другой студент с таким email, исключая текущего студента
                        $checkEmailQuery = "SELECT COUNT(*) AS count FROM students WHERE email = ? AND id != ?";
                        $stmt = $pdo->prepare($checkEmailQuery);
                        $stmt->execute([$email, $studentId]);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($result['count'] > 0) {
                            // Здесь можно выполнить дополнительные действия, например, сообщить пользователю о проблеме
                            echo "Пользователь с таким email уже существует. Пожалуйста, используйте другой email.";
                        } else {
                            // Обновляем данные студента, исключая обновление email
                            $updateQuery = "UPDATE students SET first_name = ?, last_name = ?, birth_date = ?, subgroup_id = ? WHERE id = ?";
                            $stmt = $pdo->prepare($updateQuery);
                            $stmt->execute([$firstName, $lastName, $birthDate, $subgroup, $studentId]);
                        }
                    }

                    // Перенаправление на эту же страницу для обновления данных
                    header("Location: {$_SERVER['PHP_SELF']}");
                    exit();
                }

                // Обработка добавления нового студента
                if (isset($_POST['add_new'])) {
                    $newFirstName = $_POST['new_first_name'];
                    $newLastName = $_POST['new_last_name'];
                    $newEmail = $_POST['new_email'];
                    $newBirthDate = $_POST['new_birth_date'];
                    $newGroup = $_POST['new_group']; // Получаем новый group_id из формы
                    $newSubgroup = $_POST['new_subgroup'];

                    // Запрос для вставки новой записи в базу данных
                    $addNewQuery = "INSERT INTO students (first_name, last_name, email, birth_date, group_id, subgroup_id) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($addNewQuery);
                    $stmt->execute([$newFirstName, $newLastName, $newEmail, $newBirthDate, $newGroup, $newSubgroup]);

                    // Перенаправление на эту же страницу для обновления данных
                    header("Location: {$_SERVER['PHP_SELF']}");
                    exit();
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