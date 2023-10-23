
<!DOCTYPE html>
<html>
<center>

</center>
<head>
    <title>Оформление строительных услуг</title>
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
    position: fixed;
    top: 10px;
    left: 10px;
    width: 50px;
    height: 50px;
}
    </style>
</head>
<body>
    <header>
    <a href="index.php" class="logo">
  <img src="images/house_icon_129523.ico" alt="Логотип" class="logo">
</a>
    <h1>Оформление услуги</h1>
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
    <form method="POST" action="page1.php">
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
        $name = $_POST['name'];
        $phone_number = $_POST['phone_number'];
        $payment_system = $_POST['payment_system'];
        $delivery_date = $_POST['delivery_date'];
        if (!empty($name) && !empty($phone_number) && !empty($payment_system) && !empty($delivery_date)) {
            $query = "INSERT INTO ServiceCompany (name, phone_number, payment_system, delivery_date) VALUES ('$name', '$phone_number', '$payment_system', '$delivery_date')";
            if (mysqli_query($conn, $query)) {
                echo '<p>Услуга успешно оформлена!</p>';
                $query = "SELECT email FROM users WHERE username = '{$_SESSION['username']}'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$email = $row['email'];


$to = $email;
$subject = "Уведомление о заказе услуги";
$message = "Здравствуйте, ваша услуга успешно оформлена!";
$headers = "From: shaposhnikovv2004@mail.ru";

if (mail($to, $subject, $message, $headers)) {
    echo '<p>Уведомление успешно отправлено на вашу почту!</p>';
} else {
    echo '<p>Ошибка при отправке уведомления на почту.</p>';
}
            } else {
                echo '<p>Ошибка при оформлении услуги: ' . mysqli_error($conn) . '</p>';
            }
        } else {
            echo '<p>Пожалуйста, заполните все поля формы.</p>';
        }
    }
?>
        
<label for="service">Выберите услугу:</label>
<?php
$query = "SELECT * FROM Service";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div>';
        echo '<input type="radio" id="service' . $row['id'] . '" name="name" value="' . $row['name'] . '">';
        echo '<label for="service' . $row['id'] . '"><img src="rez/' . $row['photo'] . '" width="180" alt="' . $row['name'] . '"></label>';
        echo '</div>';
    }
}
?>
        <label for="phone_number">Номер телефона:</label>
        <input type="text" name="phone_number" id="phone_number" required><br>
        <label for="payment_system">Отправить уведомление о заказе на вашу почту?</label>
        <select name="payment_system" id="payment_system" required>
            <option value="Visa">Да</option>
            <option value="Visa">Нет</option>
        </select><br>
        <label for="delivery_date">Желаемая дата оформления строительных работ:</label>
        <input type="date" name="delivery_date" id="delivery_date" min="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" max="<?php echo date('Y-m-d', strtotime('+9999 days')); ?>" required><br>
        <input type="submit" value="Оформить услугу">
    </form>
    <script>
  const serviceRadios = document.querySelectorAll('input[name="service"]');
  const nameInput = document.getElementById('name');
  serviceRadios.forEach(radio => {
    radio.addEventListener('change', () => {
      nameInput.value = radio.value;
    });
  });
</script>
    <?php
    mysqli_close($conn);
    ?>
    </center>
        <footer>
        <p>&copy; StroyElite44</p>
    </footer>
</body>
</html>
