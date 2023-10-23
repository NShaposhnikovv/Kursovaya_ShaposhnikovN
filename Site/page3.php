<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'StroyElite44_DataBase';

$connection = mysqli_connect($host, $username, $password, $database);
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM Service WHERE id = '$id'";
    mysqli_query($connection, $query);
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    
    if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
        $photo = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];
        
        move_uploaded_file($photo_tmp, "rez/$photo");
    } else {
        $photo = "";
    }
    
    $query = "INSERT INTO Service (name, photo) VALUES ('$name', '$photo')";
    mysqli_query($connection, $query);
}

if (!$connection) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

    $query = "SELECT name, delivery_date FROM ServiceCompany";
    $result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Просмотр услуг</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #777;
            color: #fff;
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .content {
            padding: 20px;
        }

        main {
            padding: 20px;
            text-align: center;
        }

        footer {
            background-color: #ccc;
            color: #333;
            padding: 10px;
            text-align: center;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
        form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 35px;
        }

        form label,
        form input,
        form select {
        margin-top: 10px;
        }
        
        input[type="submit"] {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 10px;
    }
    button[type="submit"]:hover {
        background-color: #555;
    }
     .logo {
  position: absolute;
  top: 10px;
  left: 10px;
  width: 50px;
  height: 50px;
}
    </style>
</head>
<body>
<a href="index.php" class="logo">
  <img src="images/house_icon_129523.ico" alt="Логотип" class="logo">
</a>
    <header>
        <h1>Админ панель</h1>
    </header>
    <center>
      <nav>
        <ul>
            <li><a href="index.php">Главная</a></li> 
             <li><a href="page1.php">Заказать услугу</a></li>         
           <li> <a href="page2.php">Написать отзыв</a></li>
           <li><a href="contacts.php">Контакты</a></li>
           <li><a href="about.php">О нас</a></li>
        </ul>
    </nav>
    </center>
    <center>
    <h2>Удаление услуги</h2>
    </center>
    <center>
    <?php
    $query = "SELECT * FROM Service";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div>';
            echo '<span>' . $row['name'] . '</span>';
            echo '<a href="page3.php?delete=' . $row['id'] . '">Удалить</a>';
            echo '</div>';
        }
    } else {
        echo 'Нет доступных услуг.';
    }
   
    ?>
    <h2>Добавление услуги</h2>
     </center>
    <form method="POST" action="page3.php" enctype="multipart/form-data">
    <label for="name">Название:</label>
    <input type="text" id="name" name="name" required>

    <label for="photo">Фото:</label>
    <input type="file" id="photo" name="photo" required>

    <button type="submit" name="add">Добавить</button>
</form>
</body>
</html>
<html>
    <section class="content">
    <center>
    <h2> Список заказанных услуг: </h2>
    
    <?php
    $query = "SELECT * FROM ServiceCompany";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <div>
            <h2><?php echo $row['name']; ?></h2>
            <p>Дата оказания услуги: <?php echo $row['delivery_date']; ?></p>
        </div>
         <?php } ?>
     </center>
</section>
    <footer>
        <p>&copy; StroyElite44.</p>
    </footer>
</body>
</html>
