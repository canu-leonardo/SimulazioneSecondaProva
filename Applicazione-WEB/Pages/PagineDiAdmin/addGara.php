<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olimpiadi di informatica</title>
    <link rel="shortcut icon" href="../../Resources/LOGO.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Style.css">
</head>

<body>

    <?php
        include "./../../navBar.php";
    ?>

    <?php
        include '../../Connect.php';
        if (isset($_POST['sede'])){
            $query = "INSERT INTO gara (id_fase, cap_sede, data_esecuzione)
                        VALUES (" . $_POST['fase'] .", '" . $_POST['sede'] . "', '" . $_POST['data'] . "');";
            $cennection -> query($query);
        }
    
    ?>

    <div class="center-div">
        <form action="./addGara.php" method="post">
            <label class="form-label">Scegli la sede della gara</label>
            <select name="sede" class="form-select">
                <option value=""></option>
                <?php
                    include '../../Connect.php';
                    $query = "SELECT * FROM sede";
                    $result = $cennection->query($query);
                    while($row = $result->fetch_assoc()){
                        echo "<option value=" . $row['cap_sede'] . ">" . $row['nome'] . "</option>";
                    }
                ?>
            </select>
            <label class="form-label">Scegli la data nella quale si svolgera' la gara</label><br>
            <input type="date" class="form-date" name="data"><br>
            <label class="form-label">Scegli la fase</label>
            <select name="fase" class="form-select">
                <option value=""></option>
            <?php
                include '../../Connect.php';
                $query = "SELECT * FROM fase";
                $result = $cennection->query($query);
                while($row = $result->fetch_assoc()){
                    echo "<option value=" . $row['id_fase'] . ">" . $row['descrizione'] . "</option>";
                }
            ?>
            </select> 
            <br>
            <center>
                <input type='submit' class='btn btn-purple color-white' vlaue='conferma'>;
            </center>  
        </form>
        <center>
            <br>  
            <a href="../Admin.php"><button class="btn btn-purple color-white">Back</button></a>   
        </center>
    </div>
    
    
    <?php
        include "./../../Footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>