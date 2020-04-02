<?php
    require_once "connect.php";
    session_start();
    if(isset($_POST['login-btn'])) {

        $username_ = mysqli_real_escape_string($connect,$_POST['username']);
        $password_ = mysqli_real_escape_string($connect, $_POST['password']);
        $username_ = stripslashes($username_);
        $password_ = stripslashes($password_);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $username = $rows['username'];
                $password = $rows['password'];
                $last_name = $rows['prenume'];
                $id = $rows['id'];
            }
            if (password_verify($password_, $password)){
                $rows = mysqli_num_rows($result);
                if($rows == 1){
                    $_SESSION['username'] = $username;
                    $_SESSION['last_name'] = $last_name;
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['id_user'] = $id;
                }
                header("location: index.php");
            }else{
                echo "Parola sau utilizator invalid!";
            }
        }
    }
    ?>

<html>
<head>
    <title>Pagina de conectare</title>
</head>
<body>
<form method="post">
    <p>Utilizator</p>
    <input type="text" name="username" placeholder="Utilizator">
    <p>Parola</p>
    <input type="password" name="password" placeholder="Parola">
    <button type="submit" name="login-btn">Conectare</button>
</form>
</body>
</html>
