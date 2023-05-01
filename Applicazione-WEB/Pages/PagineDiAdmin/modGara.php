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
    <div class="center-div">
    <?php
        session_start();
        if(isset($_POST['cap_sede'])){
            include "./../../Connect.php";
            if(isset($_POST['cap_sede']) && $_POST['data'] == ''){
                $query = "UPDATE gara SET gara.cap_sede ='" . $_POST['cap_sede'] . "' WHERE id_gara = '" . $_SESSION['id_gara'] . "'";
            }
            else{
                $query = "UPDATE gara set gara.cap_sede ='" . $_POST['cap_sede'] . "', gara.data_esecuzione ='" . $_POST['data'] . "'
                         WHERE gara.id_gara = '" . $_SESSION['id_gara'] . "'";
            }
            $cennection -> query($query);
            session_destroy();
            echo "  <script>
                        window.location.href = './../Admin.php'
                    </script>";       
                                 
        } else if(isset($_POST['id_gara'])){
            include '../../Connect.php';
            $query = "SELECT * FROM gara WHERE gara.id_gara = ' " . $_POST['id_gara'] . "'";
            $row = $cennection -> query($query) -> fetch_assoc();            
            $_SESSION['id_gara'] = $_POST['id_gara'];
            $_SESSION['Data'] = $row['data_esecuzione'];
            $_SESSION['cap_sede'] = $row['cap_sede'];
            $_SESSION['id_fase'] = $row['id_fase'];
    ?>
        <form action="./modGara.php" method="post">
            <label> Inserisci la nuova sede</label>
            <select class="form-select" aria-label="Default select example" name="cap_sede">
                <option value="<?php echo $_SESSION['cap_sede']; ?>"></option>
                <?php
                    include './../../Connect.php';
                    $query = "SELECT * FROM sede";
                    $result = $cennection -> query($query);   
                    if ($result -> num_rows > 0) {
                        while ($row = $result -> fetch_assoc()) {
                            echo "<option value='" . $row['cap_sede'] . "'>" . $row['nome'] . "</option>";
                        }
                    } 
                ?>
            </select>
            <label class="form-label">Scegli la data nella quale si svolgera' la gara</label><br>
            <input type="date" class="form-date" name="data"><br>
            <br>
            <center>
                <input type="submit" value="Invia" class="btn btn-purple color-white">
            </center>
        </from>
            
    <?php
        } else {
    ?>
    
    <form action="./modGara.php" method="post">
        <label class="form-label">Scegli la gara che vuoi modifcare</label>
        <select class="form-select" name="id_gara">
            <option value=''></option>
            <?php
                include '../../Connect.php';
                $query = "SELECT gara.id_gara, sede.nome, gara.data_esecuzione, fase.descrizione FROM gara
                        INNER JOIN fase ON gara.id_fase = fase.id_fase
                        INNER JOIN sede ON sede.cap_sede = gara.cap_sede
                        ORDER BY gara.id_fase;";
                $result = $cennection -> query($query);
                while($row = $result->fetch_assoc()){
                    echo "<option value=" . $row['id_gara'] . ">
                            Gara del " . $row['data_esecuzione'] . ", sede " . $row['nome'] . ", fase " . $row['descrizione'] . 
                            "</option>";
                }
            ?>
        </select>            
        <br>
        <center>
            <input type="submit" value="Invia" class="btn btn-purple color-white">
        </center>
    </form>

    <?php } ?>

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