<?php
    require_once "connect.php";
    if(isset($_POST['send-register'])){
        $username = $_POST['username'];
        $name = $_POST['nume'];
        $last_name = $_POST['prenume'];
        $password = $_POST['password'];
        $re_password = $_POST['re-password'];
        //sql prevention
        $password = mysqli_real_escape_string($connect ,$password);
        $re_password = mysqli_real_escape_string($connect, $re_password);
        if(strcmp($password, $re_password) == 0):
            $password = password_hash( $password, PASSWORD_DEFAULT );
            $password = stripcslashes($password);
            $username = stripcslashes($username);
            $name = stripcslashes($name);
            $last_name = stripcslashes($last_name);
            $query = "INSERT INTO users (username, nume, prenume, password) values ('$username', '$name', '$last_name', '$password')";
            if(mysqli_query($connect, $query)):
                echo "Contul a fost inregistrat cu succes!";
            else:
                echo "Error: " . $query . "<br>" . mysqli_error($connect);
            endif;
        else:?><script type="text/javascript">
            alert("Parolele nu coincid!");
        </script>
        <?php
        endif;

    }

?>

<html>
<head>
    <title>Pagina de inregistrare</title>
</head>
<body>
<form method="post">
    <div class="register-box">
        <p>Username</p>
        <input type="text" name="username" placeholder="Username" value="">
        <p>Nume</p>
        <input type="text" name="nume" placeholder="Ex: Nicolaescu">
        <p>Prenume</p>
        <input type="text" name="prenume" placeholder="Ex: Mihaita">
        <p>Parola</p>
        <input type="password" name="password" placeholder="Parola">
        <p>Verificare Parola</p>
        <input type="password" name="re-password" placeholder="Parola introdusa mai sus">
        <button type="submit" name="send-register" id="register-btn">Inregistreaza-te!</button>
    </div>
</form>
</body>

</html>

