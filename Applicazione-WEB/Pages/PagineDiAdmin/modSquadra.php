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
        if(isset($_SESSION['nome'])){
            include "./../../Connect.php";
            if(isset($_POST['NomeSquadra']) && !isset($_POST['cap'])){
                $query = "update squadra set nome = '" . $_POST['NomeSquadra'] ."' WHERE id_Squadra = '" . $_SESSION['id'] . "'";
            }
            else if(isset($_POST['cap']) && !isset($_POST['NomeSquadra'])){
                $query = "update squadra set cap_istituto ='" . $_POST['cap'] . "' WHERE id_Squadra = '" . $_SESSION['id'] . "'";
            }
            else if(isset($_POST['cap']) && isset($_POST['NomeSquadra'])){
                $query = "update squadra set nome = '" . $_POST['NomeSquadra'] ."', cap_istituto ='" . $_POST['cap'] . "' WHERE id_Squadra = '" . $_SESSION['id'] . "'";
            }
            
            $result = $cennection -> query($query);
            session_destroy();
            echo "  <script>
                        window.location.href = './../Admin.php'
                    </script>";       
                                 
        } else if(isset($_POST['Nome'])){
            include "./../../Connect.php";
            $_SESSION['nome'] = $_POST['Nome'];
            $query = "SELECT id_Squadra FROM Squadra WHERE Nome = '" . $_POST['Nome'] . "'";
            $cennection -> query($query);
            $result = $cennection -> query($query);
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id_Squadra'];
    ?>
        <form action="./modSquadra.php" method="post">
            <label> inserisca le modifche apposite della squadra </label>
            <label class="form-label">nome squadra</label>
            <input type="text" name="NomeSquadra" class="form-control" value="<?php echo $_POST['Nome']; ?>">
            <br>
            <select class="form-select" aria-label="Default select example" name="cap">
                <?php
                    include './../../Connect.php';
                    $query = "SELECT * FROM istituto";
                    $result = $cennection -> query($query);   
                    if ($result -> num_rows > 0) {
                        while ($row = $result -> fetch_assoc()) {
                            echo "<option value=" . $row['cap_istituto'] . ">" . $row['nome'] . "</option>";
                        }
                    } 
                ?>
            </select>
            <br>
            <center>
                <input type="submit" value="Invia" class="btn btn-purple color-white">
            </center>
        </from>
            
    <?php
        } else {
    ?>
    
    <form action="./modSquadra.php" method="post">
        <label class="form-label">Scegli la squadra che vuoi modifcare</label>
        <select class="form-select" name="Nome">
            <?php
                include './../../Connect.php';
                $query = "SELECT nome FROM squadra order by nome";
                $result = $cennection -> query($query);
                echo "<option value='' selected> <b>Scegli una Squadra</b> </option>";
                while($row = $result->fetch_assoc()){
                    echo '<option value=' . $row['nome'] . '>' . $row['nome'] . '</option>';
                };
            ?>
        </select>
            <br>
            <center>
                <input type="submit" value="Invia" class="btn btn-purple color-white">
            </center>
    </form>

    <?php }; ?>

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