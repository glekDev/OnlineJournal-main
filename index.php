<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/fontello.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>Роли на сайте</title>
</head>
<body>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="text-center text-#333333">Онлайн журнал</h1>
          <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
                <img src="img/preview.png" alt="СГУ">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                  </li>
                </ul>
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <section>
    <button id="studentBtn" class="btn base-btn btn-lg">Студент</button>
    <button id="teacherBtn" class="btn base-btn btn-lg">Преподаватель</button>
    <button id="adminBtn" class="btn base-btn btn-lg">Администратор</button>
  </section>

  <section id="teacherSection" class="hidden">
    <h2 class="text-center">Список курсов</h2>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <label for="courseDataList" class="form-label">Найдите курс</label>
          <input class="form-control" list="courseDatalistOptions" id="courseDataList" placeholder="Type to search...">
          <datalist id="courseDatalistOptions">
            <?php
              require_once "connectpdo.php";
              $getCourses = "SELECT id, title FROM Courses GROUP BY title";
              $stmt = $pdo->prepare($getCourses);
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . htmlspecialchars($row['title']) . '">' . htmlspecialchars($row['title']) . '</option>';
              }
            ?>
          </datalist>
        </div>
      </div>
    </div>

    <h2 class="text-center">Список групп</h2>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <label for="groupDataList" class="form-label">Найдите группу</label>
          <input class="form-control" list="groupDatalistOptions" id="groupDataList" placeholder="Type to search...">
          <datalist id="groupDatalistOptions">
            <!-- Группы будут загружаться здесь -->
          </datalist>
        </div>
      </div>
    </div>

    <h2 class="text-center">Добавить занятие</h2>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form id="addClassForm">
            <div class="mb-3">
              <label for="classDate" class="form-label">Дата занятия</label>
              <input type="date" class="form-control" id="classDate" required>
            </div>
            <div class="mb-3">
              <label for="classTopic" class="form-label">Тема занятия</label>
              <input type="text" class="form-control" id="classTopic" required>
            </div>
            <button type="button" id="addClassButton" class="btn base-btn btn-lg">Добавить занятие</button>
          </form>
        </div>
      </div>
    </div>

    <h2 class="text-center">Занятия группы по курсу</h2>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="list-group" id="classesList">
            <!-- Список занятий будет загружаться здесь -->
          </div>
        </div>
      </div>
    </div>

    <h2 class="text-center">Табель посещаемости</h2>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form id="attendanceForm">
            <ul id="attendanceList">
              <!-- Табель посещаемости будет загружаться здесь -->
            </ul>
            <button id="confirmButton" class="btn base-btn btn-lg" type="button">Подтвердить</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer id="footer">
    <a href="index.php" class="btn base-btn btn-lg">Вернуться</a>
    <a href="index.php" class="btn base-btn btn-lg">На главную</a>
  </footer>

  <script>
    document.getElementById('teacherBtn').addEventListener('click', function() {
      document.getElementById('teacherSection').classList.remove('hidden');
    });

    document.getElementById("studentBtn").addEventListener("click", function() {
      alert("Функционал для студентов пока не реализован");
    });

    document.getElementById("adminBtn").addEventListener("click", function() {
      alert("Функционал для администраторов пока не реализован");
    });

    document.getElementById("courseDataList").addEventListener("change", function() {
      openGroups();
    });

    document.getElementById("groupDataList").addEventListener("change", function() {
      openClasses();
    });

    function openGroups() {
      const selectedCourse = document.getElementById("courseDataList").value;
      if (!selectedCourse) {
        alert("Курс не выбран");
      } else {
        fetch(`get_groups.php?course_title=${selectedCourse}`)
          .then(response => response.json())
          .then(groups => {
            const datalist = document.getElementById('groupDatalistOptions');
            datalist.innerHTML = '';
            groups.forEach(group => {
              const option = document.createElement('option');
              option.value = group.serial_num;
              datalist.appendChild(option);
            });
          })
          .catch(error => console.error('Error fetching groups:', error));
      }
    }

    function openClasses() {
      const selectedGroup = document.getElementById("groupDataList").value;
      const selectedCourse = document.getElementById("courseDataList").value;
      if (!selectedGroup || !selectedCourse) {
        alert("Курс или группа не выбраны");
      } else {
        fetch(`get_classes.php?course_title=${selectedCourse}&group_serial=${selectedGroup}`)
          .then(response => response.json())
          .then(classes => {
            const classesList = document.getElementById('classesList');
            classesList.innerHTML = '';
            classes.forEach(cls => {
              const item = document.createElement('a');
              item.href = '#';
              item.className = 'list-group-item list-group-item-action';
              item.textContent = `Занятие ${cls.id} - Дата: ${cls.period} - Тема: ${cls.topic}`;
              item.setAttribute('data-class-id', cls.id);
              classesList.appendChild(item);
            });
          })
          .catch(error => console.error('Error fetching classes:', error));
      }
    }

    document.getElementById('classesList').addEventListener('click', function(event) {
      if (event.target && event.target.matches('a.list-group-item')) {
        event.preventDefault();
        const classId = event.target.getAttribute('data-class-id');
        openAttendance(classId);
      }
    });

    function openAttendance(classId) {
      fetch(`get_attendance.php?class_id=${classId}`)
        .then(response => response.json())
        .then(attendance => {
          const attendanceList = document.getElementById('attendanceList');
          attendanceList.innerHTML = '';
          attendance.forEach(record => {
            const item = document.createElement('li');
            item.innerHTML = `
              id: ${record.student_id} - ${record.first_name} ${record.last_name}
              - Присутствие: <input type="checkbox" class="checkbox" ${record.yn == '1' ? 'checked' : ''} data-student-id="${record.student_id}" data-class-id="${classId}">
              <input type="text" class="txtbox" value="${record.comm || ''}" size="5">
            `;
            attendanceList.appendChild(item);
          });
        })
        .catch(error => console.error('Error fetching attendance:', error));
    }

    document.getElementById('confirmButton').addEventListener('click', function() {
      var attendanceData = [];
      document.querySelectorAll('input[type=checkbox]').forEach(function(checkbox) {
        var studentId = checkbox.getAttribute('data-student-id');
        var classId = checkbox.getAttribute('data-class-id');
        var attendanceStatus = checkbox.checked ? '1' : '0';
        var comment = checkbox.parentElement.querySelector('input[type=text]').value;
        attendanceData.push({
          student_id: studentId,
          yn: attendanceStatus,
          class_id: classId,
          comm: comment
        });
      });

      fetch('submit_attendance_with_comments.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ attendanceData: attendanceData })
      })
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          console.error('Error:', data.error);
          alert('Ошибка: ' + data.error);
        } else {
          console.log(data.success);
          alert('Attendance data successfully submitted');
        }
      })
      .catch(error => console.error('Error submitting attendance data:', error));
    });

    document.getElementById('addClassButton').addEventListener('click', function() {
      const selectedCourse = document.getElementById("courseDataList").value;
      const selectedGroup = document.getElementById("groupDataList").value;
      const classDate = document.getElementById('classDate').value;
      const classTopic = document.getElementById('classTopic').value;

      if (!selectedCourse || !selectedGroup || !classDate || !classTopic) {
        alert("Все поля должны быть заполнены");
        return;
      }

      fetch('add_class.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          course_title: selectedCourse,
          group_serial: selectedGroup,
          period: classDate,
          topic: classTopic
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          console.error('Error:', data.error);
          alert('Ошибка: ' + data.error);
        } else {
          console.log(data.success);
          alert('Занятие успешно добавлено');
          openClasses(); // обновить список занятий
        }
      })
      .catch(error => console.error('Error adding class:', error));
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
