<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'StroyElite44_DataBase';

    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die('Ошибка подключения к базе данных: ' . mysqli_connect_error());
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        if (!empty($title)) {
           

            $query = "INSERT INTO rewiews (title) VALUES ('$title')";

            if (mysqli_query($conn, $query)) {
                echo '<p>Отзыв успешно отправлен</p>';
            } else {
                echo '<p>Ошибка при оформлении отзыва: ' . mysqli_error($conn) . '</p>';
            }
        } else {
            echo '<p>Пожалуйста, заполните все поля формы.</p>';
        }
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Написать отзыв</title>
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
    <h1>Написать отзыв</h1>
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



    <form method="POST" action="page2.php">
        <label for="title">Напишите ваш отзыв:</label>
        <input type="text" name="title" id="name" required><br>

     
         
        </select><br>

       


        <input type="submit" value="Отправить отзыв">
    </form>

    <?php
    mysqli_close($conn);
    ?>
        <footer>
        <p>&copy; StroyElite44</p>
    </footer>
</body>
</html>
