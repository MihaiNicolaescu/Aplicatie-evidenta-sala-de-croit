<?php
//la tabel de adaugat denumirea marimilor pe acelasi rand cu "numar bucati" sa arate mai estetic placut
//sizeof returneaza marimea + 1
//de adaugat marimile pe plus si pierderile in tabel
//de adaugat pierderi totale la informatii comanda
require_once "connect.php";
require_once "order.php";
require_once "span.php";
session_start();
$array = $_SESSION['orders'];
$id = $_GET['id'];
$region = $array[$id-1]->getRegion();
$actualSizes = $array[$id-1]->getRestSizes(); //array pentru a stoca restul de marimi ramase din comanda
$total = 0;
$WTS= null;
$sizes =null;
$completat = null;
$id__ = $array[$id-1]->getOrder();
$query = "SELECT * FROM comenzi WHERE id='$id__'";
$result = mysqli_query($connect, $query);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $WTS = $row['sizes'];
        $sizes = explode(" ", $row['initial_sizes']);
        $completat = $row['completed'];
    }
}else{
    echo mysqli_error($connect);
}
for ($i = 0; $i<sizeof($sizes); $i++)
    $total += (int)$sizes[$i];

$workedSizesTotal = 0;
$workedSizes = explode(" ", $WTS);
for($i = 0; $i < sizeof($workedSizes); $i++)
    $workedSizesTotal += (int)$workedSizes[$i];
$workedSizesTotal = $total - $workedSizesTotal;
if(isset($_POST['btn-home'])){
    header("location: index.php");
}
else if(isset($_POST['btn-deconnect'])){
    header("location: login.php");
    session_destroy();
}else if(isset($_POST['btn-span'])):
    $nr_sheets = $_POST['number_sheet'];
    $length = $_POST['length_span'];
    $loss = $_POST['loss'];
    $id_order = $array[$id-1]->getOrder();
    $spanSizes = NULL;
    $plusSizes = NULL;
    $sizeXspan = NULL;
    $plusSizes_ = NULL;
    for($i = 0; $i < sizeof($sizes); $i++):
        if($sizes[$i] > 0):

            $spanSizes[$i] = $_POST['marime_' . $i] * $nr_sheets;
            $sizeXspan = $sizeXspan. " " . $_POST['marime_' . $i];
        else:
            $spanSizes[$i] = 0;
            $sizeXspan = $sizeXspan. " 0" ;
        endif;
        $plusSizes[$i] = (int)$workedSizes[$i] - $spanSizes[$i];
        $plusSizes_ = $plusSizes_ . " " . $plusSizes[$i];
    endfor;
    $query = "INSERT INTO span (id_order, nr_sheet, length, piecesPerSize, loss, plus_piecesPerSize) values ('$id_order', '$nr_sheets', '$length', '$sizeXspan', '$loss', '$plusSizes_')";
    $result =  mysqli_query($connect, $query);
    $cut = "";
    $WTS_exploded = explode(" ", $WTS);
    for($i=1; $i < sizeof($sizes); $i++):
        if($sizes[$i] > 0):
            $tmp = 0;
            $sizeX = $_POST['marime_'.$i];
            $actual = (int)$WTS_exploded[$i];
            $tmp = $actual - ($sizeX * $nr_sheets);
            $tmp_size = explode(" ", $row['sizes']);
            if($tmp_size == $tmp):
                $cut = $cut . " " . $WTS_exploded[$i];
            else:
                $cut = $cut . " " . $tmp;
            endif;
        else:
            $cut = $cut . " 0";
        endif;
    endfor;
    $query = "UPDATE comenzi SET sizes='$cut' WHERE id=$id_order";
    mysqli_query($connect, $query);
    if($result):
        $url = "comanda.php?id=" . $id;
        header("location: " . $url);
    else:
        echo mysqli_error($connect);
    endif;

endif;

if(isset($_POST['btn-complete'])):
    if($completat == 0):
        $query = "UPDATE comenzi SET completed='1'";
    elseif($completat == 1):
        $query = "UPDATE comenzi SET completed='0'";
    endif;
    $result = mysqli_query($connect, $query);
    if($result):
        $url = "comanda.php?id=" . $id;
        header("location: " . $url);
    else:
        echo mysqli_error($result);
    endif;
endif;

function isComplete(){
    global $array, $id;
    $complete = $array[$id-1]->getComplete();
    if($complete)
        echo "Procesare: Completă";
    else
        echo "Procesare: Incompletă";
}

$sizesNamesStock = array(
        array("XXS" , "XS", "S", "M", "L", "XL", "2XL", "3XL", "4XL", "5XL"),
        array("2" , "4", "6", "8", "10", "12", "14", "16", "18", "20"),
        array("4" , "6", "8", "10", "12", "14", "16", "18", "20", "22"),
        array("32" , "34", "36", "38", "40", "42", "44", "46", "48", "50"),
        array("5" , "7", "9", "11", "13", "15", "17", "19", "21", "23"),
        array("6" , "8", "10", "12", "14", "16", "18", "20", "22", "24")
);
?>


<html>
<head>
    <title><?php echo "Comanda: " . $array[$id-1]->getName(); ?></title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<nav class="navbar">
    <p style="font-size: 25px; font-weight: bolder">Bine ai revenit, <?php echo $_SESSION['last_name']; ?></p>
    <form method="post">
        <button class="btn" style="background-color: aliceblue" type="submit" name="btn-home">Home</button>
        <button class="btn btn-deconnect" style="background-color: aliceblue" type="submit" name="btn-deconnect">
            Deconectare
        </button>
    </form>
</nav>
<div class="container-fluid container-span">
    <div class="row row-detalii-comanda">
        <div class="col container-order">
            <p>Denumire comanda: <?php echo $array[$id-1]->getName(); ?></p>
            <p>Total bucati: <?php echo $total?></p>
            <p>Bucati lucrate: <?php echo $workedSizesTotal?></p>
            <p><?php isComplete(); ?></p>
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Marime</th>
                        <th scope="col">Total</th>
                        <th scope="col">Croite</th>
                        <th scope="col">Ramase</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        $sizesNr = 0;
                        $WTS_exploded = explode(" ", $WTS);
                        for($j=0; $j<sizeof($sizes); $j++):
                            if($sizes[$j] > 0):
                                $sizesNr++;
                            ?>
                            <tr>
                                <th><?php echo $sizesNamesStock[$region][$j-1]; ?></th>
                                <td><?php echo $sizes[$j]; ?></td>
                                <td><?php echo $sizes[$j]-$WTS_exploded[$j]; ?></td>
                                <?php
                                    if($WTS_exploded[$j] >= 0):
                                ?>
                                <td><?php echo $WTS_exploded[$j]; ?></td>
                                <?php
                                else:
                                ?>
                                <td>Mărimi pe plus: <?php echo $WTS_exploded[$j]*(-1); ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php
                        endif;
                        endfor ?>
                </tbody>
            </table>
            <form method="post">
                <?php if(!$completat): ?>
                    <button class="btn btn-success" type="submit" name="btn-complete">Finalizare comanda</button>
                <?php
                else:?>
                    <button class="btn btn-warning" type="submit" name="btn-complete">Modificare comanda</button>
                <?php endif?>
            </form>
        </div>
        <div class="col-7">
            <!-- Afisare spanuri -->
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th rowspan="2">NR</th>
                    <th rowspan="2">Numar foi</th>
                    <th rowspan="2">Lungime</th>
                    <th colspan="<?php echo $sizesNr; ?>">Numar bucati/marime</th>
                    <th rowspan="2">Pierderi</th>
                </tr>
                <tr>
                    <?php
                    for($i=0; $i<sizeof($sizes); $i++):
                        if($sizes[$i] > 0):?>
                            <th><?php echo $sizesNamesStock[$region][$i-1]; ?></th>
                        <?php
                        endif;
                    endfor;
                    ?>
                </tr>
                </thead>
                <tbody>
                <?php
                $id_order = $array[$id-1]->getOrder();
                $query = "SELECT * FROM span WHERE id_order=$id_order ORDER BY id DESC";
                $result = mysqli_query($connect, $query);
                $spanuri = [];
                $index = 1;
                if($result){
                    $count = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        //$id, $id_order, $nr_sheets, $length, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10, $loss, $ps1, $ps2, $ps3, $ps4, $ps5, $ps6, $ps7, $ps8, $ps9, $ps10
                        $sizes_per_span = explode(" ", $row['piecesPerSize']);
                        $plus_sizes = explode(" ", $row['plus_piecesPerSize'] );
                        $spanuri[$count] = new span($row['id'], $row['id_order'], $row['nr_sheet'], $row['length'], $sizes_per_span[0], $sizes_per_span[1], $sizes_per_span[2], $sizes_per_span[3], $sizes_per_span[4], $sizes_per_span[5], $sizes_per_span[6], $sizes_per_span[7], $sizes_per_span[8], $sizes_per_span[9], $row['loss'], $plus_sizes[0], $plus_sizes[1], $plus_sizes[2], $plus_sizes[3], $plus_sizes[4], $plus_sizes[5], $plus_sizes[6], $plus_sizes[7], $plus_sizes[8], $plus_sizes[9]);
                        $count++;
                        ?>
                        <tr>
                            <th><?php echo $index; $index++; ?></th>
                            <td><?php echo $row['nr_sheet']; ?></td>
                            <td><?php echo $row['length']; ?></td>
                            <?php
                            for($i=0; $i<sizeof($sizes_per_span)-1; $i++):
                                if($sizes[$i] > 0):
                                    if($sizes_per_span[$i] != 0 || $sizes_per_span[$i] == 0):?>
                                <td><?php echo $sizes_per_span[$i+1]; ?></td>
                             <?php
                                    endif;
                                endif;
                            endfor;
                            ?>

                            <td><?php echo $row['loss']. " cm"; ?></td>
                        </tr>
                    <?php
                    }
                }else{
                    echo mysqli_error($connect);
                }
                ?>
                </tbody>
            </table>
        </div>
        <div style="padding-right: 50px" class="col">
            <!-- adaugare span la comanda -->
            <?php if(!$completat): ?>
            <form method="post">
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Numar foi</span>
                        </div>
                        <input value="0" type="number" name="number_sheet" class="form-control col-xs-3">
                    </div>
                </div>
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Lungime span</span>
                        </div>
                        <input value="0" type="number" step="any" name="length_span" class="form-control col-xs-3">
                    </div>
                </div>
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Pierderi:</span>
                        </div>
                        <input value="0" type="number" step="any" name="loss" class="form-control col-xs-3">
                    </div>
                </div>
                <div class="span-input">
                    <div class="row row-cols-4">
                        <?php
                        for($i = 0; $i < sizeof($sizes); $i++):
                            if($sizes[$i] > 0):
                                ?>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><?php echo $sizesNamesStock[$region][$i-1];?></span>
                                    </div>
                                    <input value="0" type="text" name="marime_<?php echo $i; ?>" class="form-control col-xs-3" style="width: 433px">
                                </div>
                            </div>
                            <?php
                            endif;
                        endfor;
                        ?>
                        <div class="col">
                                <button style="height: 37px; width: 140%" class="btn btn-secondary" type="submit" name="btn-span">Adauga șpan</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php else: ?>
            <form method="post">
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Numar foi</span>
                        </div>
                        <input value="0" type="number" name="number_sheet" class="form-control col-xs-3">
                    </div>
                </div>
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Lungime span</span>
                        </div>
                        <input value="0" type="number" step="any" name="length_span" class="form-control col-xs-3">
                    </div>
                </div>
                <div class="span-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Pierderi:</span>
                        </div>
                        <input value="0" type="number" step="any" name="loss" class="form-control col-xs-3">
                    </div>
                </div>
                <div class="span-input">
                    <div class="row row-cols-4">
                        <?php
                        for($i = 0; $i < sizeof($sizes); $i++):
                            if($sizes[$i] > 0):
                                ?>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><?php echo $sizesNamesStock[$region][$i-1];?></span>
                                        </div>
                                        <input value="0" type="text" name="marime_<?php echo $i; ?>" class="form-control col-xs-3" style="width: 433px">
                                    </div>
                                </div>
                            <?php
                            endif;
                        endfor;
                        ?>
                    </div>
                </div>
            </form>
        </div><?php endif; ?>
        </div>
        </div>
    </div>
</div>
</body>
</html>
