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
            <a class="navbar-brand" href="../img/preview.png">
              <img src="../img/preview.png" alt="СГУ">
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
  <header>

  <section>

    <button id="studentBtn" class="btn base-btn btn-lg">Студент</button>
    <button id="teacherBtn" class="btn base-btn btn-lg">Преподаватель</button>
    <button id="adminBtn" class="btn base-btn btn-lg">Администратор</button>

  </section>

  <footer id="footer">
    
            <!-- <div class="container" href="../img/8c520e29b81dafae1bc71b637af04281.gif">
              <img src="../img/8c520e29b81dafae1bc71b637af04281.gif">
            </div> -->

  </footer>

<script>
  document.getElementById("teacherBtn").addEventListener("click", function() {
window.location.href = "groups.php";});
</script>

<script src="js/nav.js"></script>

<script src="js/bootstrap.budle.min.js"></script>

</body>
</html>
