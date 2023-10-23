<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Главная страница</title>
<style>
    .service-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        width: 300px;
        border: 1px solid #ccc;
        margin: 40px;

    }

    .service-row {
        display: flex;
        justify-content: center;

    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
        margin: 0;
        padding: 0;

    }

    header {
        background-color: orange;
        color: #fff;
        padding: 30px;
        text-align: center;
        margin: 10;
    }

    nav {
        background-color: #ccc;
        color: #333;
        padding: 10px;
        text-align: center;

    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    nav ul li {
    display: inline-block;
    margin-right: 10px;
    margin-bottom: 0; 
}

    nav ul li a {
        color: #fff;
        text-decoration: none;
    }

    .content {
        padding: 20px;
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
    .logo {
  position: absolute;
  top: 10px;
  left: 10px;
  width: 50px;
  height: 50px;
}

.register-link,
.login-link {
  float: right;
  margin-right: 10px;
}

</style>
</head>
<body>
<nav>
<ul>
<li><h1>StroyElite44</h1></li>
</ul>
</nav>
<center>
<nav>
<ul>
<li><a href="page1.php">Заказать услугу</a></li>
<li><a href="page2.php">Написать отзыв</a></li>
<li><a href="contacts.php">Контакты</a></li>
<li><a href="about.php">О нас</a></li>
<?php
session_start();
if ($_SESSION['username'] == 'root') {
    echo '<li><a href=page3.php>Админ панель</a></li>';
}
?>

<li class="register-link"><a href="logout.php">Выйти</a></p></li>
<li class="register-link"><a href="register.php">Регистрация</a></li>
<li class="login-link"><a href="login.php">Войти</a></li>

</ul>

</nav>
</center>

<center>
<?php
$hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'StroyElite44_DataBase';
    $conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
        die('Ошибка подключения к базе данных: ' . mysqli_connect_error());
    }
        $username = $_POST['username'];
     
?>
</center>
<a href="index.php" class="logo">
  <img src="images/house_icon_129523.ico" alt="Логотип" class="logo">
</a>
<footer>
&copy; StroyElite44.
</footer>
<div class="content">
  <h2>СтройЭлит - лучшее качество!</h2>
  <p>StroyElite44 - это профессиональная строительная компания, специализирующаяся на предоставлении широкого спектра услуг в сфере строительства и ремонта. Мы предлагаем своим клиентам высококачественные работы по строительству домов, квартир, офисных и коммерческих помещений.</p>
  <p>Наша команда состоит из опытных и квалифицированных специалистов, которые готовы выполнить любые строительные задачи с максимальной точностью и в срок. Мы используем только надежные и современные материалы, чтобы гарантировать долговечность и качество наших работ.</p>
  <p>Если вам требуется профессиональная помощь в строительстве или ремонте, обратитесь к нам. Мы гарантируем индивидуальный подход к каждому клиенту, а также конкурентные цены и высокий уровень сервиса.</p>
</div>
 <center>
  <img src="images/09509123.png" alt="Фото" width="750">
  </center>
</body>
</html>