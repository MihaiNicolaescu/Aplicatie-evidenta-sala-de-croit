<?php
    require_once "connect.php";
    if(isset($_POST['send-register'])) {
        $username = $_POST['username'];
        $name = $_POST['nume'];
        $last_name = $_POST['prenume'];
        $password = $_POST['password'];
        $re_password = $_POST['re-password'];
        //sql prevention
        $password = mysqli_real_escape_string($connect, $password);
        $re_password = mysqli_real_escape_string($connect, $re_password);
        if (strcmp($password, $re_password) == 0):
            $password = password_hash($password, PASSWORD_DEFAULT);
            $password = stripcslashes($password);
            $username = stripcslashes($username);
            $name = stripcslashes($name);
            $last_name = stripcslashes($last_name);
            $query = "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($connect, $query);
            if (!mysqli_num_rows($result)):
                $query = "INSERT INTO users (username, nume, prenume, password) values ('$username', '$name', '$last_name', '$password')";
                if (mysqli_query($connect, $query)):
                    header("location: login.php");
                else:
                    echo "Error: " . $query . "<br>" . mysqli_error($connect);
                endif;
            else:
                echo "Numele de utilizator este folosit de alt utilizator, te rog alege alt nume de utilizator.";
            endif;
        else:?>
            <script type="text/javascript">
                alert("Parolele nu coincid!");
            </script>
        <?php
        endif;

    }
    if(isset($_POST['btn-login'])){
        header("location: login.php");
    }

?>

<html>
<head>
    <title>Pagina de inregistrare</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="container-register">
        <form method="post">
            <div class="register-box">
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Username</span>
                        </div>
                        <input class="form-control" type="text" name="username" placeholder="Username" value="">
                    </div>
                </div>
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nume</span>
                        </div>
                        <input class="form-control" type="text" name="nume" placeholder="Ex: Nicolaescu">
                    </div>
                </div>
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Prenume</span>
                        </div>
                        <input class="form-control" type="text" name="prenume" placeholder="Ex: Mihaita">
                    </div>
                </div>
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Parola</span>
                        </div>
                        <input class="form-control" type="password" name="password" placeholder="Parola">
                    </div>
                </div>
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Verificare parola</span>
                        </div>
                        <input class="form-control" type="password" name="re-password" placeholder="Parola introdusa mai sus">
                    </div>
                </div>
                <button class="btn btn-success" type="submit" name="send-register" id="register-btn">Inregistreaza-te!</button>
                <button class="btn btn-danger" type="submit" name="btn-login" id="btn-login">Anuleaza</button>
            </div>
        </form>
    </div>
</div>
</body>

</html>

