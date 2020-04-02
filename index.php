<?php
    require_once "connect.php";
    session_start();
    if($_SESSION['loggedIn'] == false):
        header("location: login.php");
    endif;
    if(isset($_POST['deconect-btn'])){
        $_SESSION['loggedIn'] = false;
        $_SESSION['last_name'] = "None";
        $_SESSION['username'] = "None";
        header("location: login.php");
    }
    if(isset($_POST['procesare-comanda'])){
        $order_name = $_POST['nume_comanda'];
        $size = "";
        if(empty($order_name) == false) {
            $size = $size . " " . $_POST['marime_1'] . " " . $_POST['marime_2'] . " " . $_POST['marime_3'] . " " . $_POST['marime_4'] . " " . $_POST['marime_5'] . " " . $_POST['marime_6'] . " " . $_POST['marime_7'] . " " . $_POST['marime_8'] . " " . $_POST['marime_9'] . " " . $_POST['marime_10'];
            $region = $_POST['regiune'];
            $user_id = $_SESSION['id_user'];
            $order_name = stripcslashes($order_name);
            $order_name = mysqli_real_escape_string($connect, $order_name);
            $query = "INSERT INTO comenzi (id_user, name, region, sizes, initial_sizes) values ('$user_id', '$order_name', '$region', '$size', '$size')";
            $result = mysqli_query($connect, $query);
            if (!$result) {
                echo mysqli_error($connect);
            } else {
                header("location: index.php");
            }
        }else{
            echo "nu e bine";
        }
    }
?>

<html>
<head>
<title>Index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<?php
if($_SESSION['loggedIn'] == true):
    $id_user = $_SESSION['id_user'];
    $query = "SELECT * FROM comenzi WHERE id_user = $id_user";
    $result = mysqli_query($connect, $query);
    if($result):
        $rows = mysqli_fetch_assoc($result);
    endif;

?>
<body>
<nav class="navbar">
    <p style="font-size: 25px; font-weight: bolder">Bine ai revenit, <?php echo $_SESSION['last_name'];?></p>
    <form method="post">
        <button class="btn btn-deconnect" style="background-color: aliceblue" type="submit" name="deconect-btn">Deconectare</button>
    </form>
</nav>
<div class="container-fluid" style="margin-top: 10px;">
    <div class="row">
        <div class="col-6">
            <!--AFISAREA COMENZIOR EXISTENTE -->
            <?php
            $id_user = $_SESSION['id_user'];
            $query = "SELECT * FROM comenzi WHERE id_user = $id_user";
            $result = mysqli_query($connect, $query);
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    echo $row['name'] . " ";
                }
            }
            ?>
        </div>
        <div class="col-4">
            <!--adaugarea unei comenzi noi -->
            <form method="post">
                <div class="input-group mb-5" style="display: block !important">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nume sau id comanda</span>
                        </div>
                        <input type="text" name="nume_comanda" class="form-control col-xs-3" style="width: 433px">
                    </div>
                    <div class="input-group mb-5">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Regiunea marimilor</span>
                        </div>
                        <select class="custom-select" id="regiune" name="regiune">
                            <option selected value="0">Standard</option>
                            <option value="1">U.S.A & Canada</option>
                            <option value="2">UK</option>
                            <option value="3">Europa</option>
                            <option value="4">Japonia</option>
                            <option value="5">Australia</option>
                        </select>
                        <div class="container" style="margin-top:10px">
                            <div class="row row-cols-4">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="marime_1">XXS</span>
                                        </div>
                                        <input onclick="this.select()" type="number" value="0" name="marime_1" class="form-control col-xs-3 marimi" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="marime_2">XS</span>
                                        </div>
                                        <input onclick="this.select()" type="number" name="marime_2" value="0" class="form-control col-xs-3 marimi" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="marime_3">S</span>
                                        </div>
                                        <input onclick="this.select()" type="number" name="marime_3" value="0" class="form-control col-xs-3 marimi" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="marime_4">M</span>
                                        </div>
                                        <input onclick="this.select()" type="number" name="marime_4" value="0" class="form-control col-xs-3 marimi" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="marime_5">L</span>
                                        </div>
                                        <input onclick="this.select()" type="number" name="marime_5" value="0" class="form-control col-xs-3 marimi" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="marime_6">XL</span>
                                        </div>
                                        <input onclick="this.select()" type="number" name="marime_6" value="0" class="form-control col-xs-3 marimi" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="marime_7">2XL</span>
                                        </div>
                                        <input onclick="this.select()" type="number" name="marime_7" value="0" class="form-control col-xs-3 marimi" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="marime_8">3XL</span>
                                        </div>
                                        <input onclick="this.select()" type="number" name="marime_8" value="0" class="form-control col-xs-3 marimi" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="marime_9">4XL</span>
                                        </div>
                                        <input onclick="this.select()" type="number" name="marime_9" value="0" class="form-control col-xs-3 marimi" style="width: 100px">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="marime_10">5XL</span>
                                        </div>
                                        <input onclick="this.select()" type="number" name="marime_10" value="0" class="form-control col-xs-3 marimi" style="width: 100px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="procesare-comanda" name="procesare-comanda">Adauga comanda</button>
                </div>
            </form>

        </div>
    </div>
</div>


<?php
endif;
?>
<script type="text/javascript">
    function notEmpty(){

        var e = document.getElementById("regiune");
        var selected_region = e.options[e.selectedIndex].value;
        if(selected_region == 0){
            document.getElementById('marime_1').innerText = "XXS";
            document.getElementById('marime_2').innerText = "XS";
            document.getElementById('marime_3').innerText = "S";
            document.getElementById('marime_4').innerText = "M";
            document.getElementById('marime_5').innerText = "L";
            document.getElementById('marime_6').innerText = "XL";
            document.getElementById('marime_7').innerText = "2XL";
            document.getElementById('marime_8').innerText = "3XL";
            document.getElementById('marime_9').innerText = "4XL";
            document.getElementById('marime_10').innerText = "5XL";
        }
        if(selected_region == 1){
            document.getElementById('marime_1').innerText = "2";
            document.getElementById('marime_2').innerText = "4";
            document.getElementById('marime_3').innerText = "6";
            document.getElementById('marime_4').innerText = "8";
            document.getElementById('marime_5').innerText = "10";
            document.getElementById('marime_6').innerText = "12";
            document.getElementById('marime_7').innerText = "14";
            document.getElementById('marime_8').innerText = "16";
            document.getElementById('marime_9').innerText = "18";
            document.getElementById('marime_10').innerText = "20";
        }
        if(selected_region == 2){
            document.getElementById('marime_1').innerText = "4";
            document.getElementById('marime_2').innerText = "6";
            document.getElementById('marime_3').innerText = "8";
            document.getElementById('marime_4').innerText = "10";
            document.getElementById('marime_5').innerText = "12";
            document.getElementById('marime_6').innerText = "14";
            document.getElementById('marime_7').innerText = "16";
            document.getElementById('marime_8').innerText = "18";
            document.getElementById('marime_9').innerText = "20";
            document.getElementById('marime_10').innerText = "22";
        }
        if(selected_region == 3){
            document.getElementById('marime_1').innerText = "32";
            document.getElementById('marime_2').innerText = "34";
            document.getElementById('marime_3').innerText = "36";
            document.getElementById('marime_4').innerText = "38";
            document.getElementById('marime_5').innerText = "40";
            document.getElementById('marime_6').innerText = "42";
            document.getElementById('marime_7').innerText = "44";
            document.getElementById('marime_8').innerText = "46";
            document.getElementById('marime_9').innerText = "48";
            document.getElementById('marime_10').innerText = "50";
        }
        if(selected_region == 4){
            document.getElementById('marime_1').innerText = "5";
            document.getElementById('marime_2').innerText = "7";
            document.getElementById('marime_3').innerText = "9";
            document.getElementById('marime_4').innerText = "11";
            document.getElementById('marime_5').innerText = "13";
            document.getElementById('marime_6').innerText = "15";
            document.getElementById('marime_7').innerText = "17";
            document.getElementById('marime_8').innerText = "19";
            document.getElementById('marime_9').innerText = "21";
            document.getElementById('marime_10').innerText = "23";
        }
        if(selected_region == 5){
            document.getElementById('marime_1').innerText = "6";
            document.getElementById('marime_2').innerText = "8";
            document.getElementById('marime_3').innerText = "10";
            document.getElementById('marime_4').innerText = "12";
            document.getElementById('marime_5').innerText = "14";
            document.getElementById('marime_6').innerText = "16";
            document.getElementById('marime_7').innerText = "18";
            document.getElementById('marime_8').innerText = "20";
            document.getElementById('marime_9').innerText = "22";
            document.getElementById('marime_10').innerText = "24";
        }

    }
    notEmpty()

    document.getElementById("regiune").onchange = notEmpty;
</script>
</body>
</html>
