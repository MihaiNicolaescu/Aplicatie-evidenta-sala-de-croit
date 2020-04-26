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
    if(isset($_POST['btn-register'])){
        header("location: register.php");
    }
    ?>

<html>
<head>
    <title>Pagina de conectare</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="container-register">
        <form method="post">
            <div class="span-input">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><span class="material-icons">account_circle</span></span>
                    </div>
                    <input type="text" name="username" placeholder="Utilizator">
                </div>
            </div>
            <div class="span-input">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><span class="material-icons">vpn_key</span>
                    </div>
                    <input type="password" name="password" placeholder="Parola">
                </div>
            </div>
            <button class="btn btn-secondary" type="submit" name="login-btn">Conectare</button>
            <button class="btn btn-secondary" type="submit" name="btn-register">Înregistrare</button>
        </form>
    </div>
</div>
</body>
</html>
