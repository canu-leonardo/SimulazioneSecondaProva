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

    <nav class="navbar navbar-light bg-purple">
        <div class="container-fluid">
            <p class="navbar-brand color-white">
                <img src="/Resources/LOGO.svg" alt="" width="30" height="24" class="d-inline-block white-logo ">
                Olimpiadi di Informatica
            </p>
        </div>
    </nav>

    <?php
        if(isset($_POST['NomeSquadra'])){
            include '../../Connect.php';
            $query = "insert into squadra (nome, cap_istituto)
            values ('" . $_POST['NomeSquadra'] ."', '" . $_POST['cap'] ."')";
            $cennection -> query($query);
            session_start();
            $query = "SELECT squadra.id_squadra FROM squadra WHERE squadra.nome = '" . $_POST['NomeSquadra'] . "'";
            $result = $cennection -> query($query);

            $row = $result->fetch_assoc();
           

            $_SESSION['ID_Squadra'] = $row['id_squadra'];
            $_SESSION['numeroAtleti'] = $_POST['numero'];
            $_SESSION['Istituto'] = $_POST['cap'];

            echo "  <script>
                        window.location.href = './addAtletaDaSquadra.php'
                    </script>";
        }
    ?>

    <div class="center-div">
        <form action="./addSquadra.php" method="post">
            <label class="form-label">Inserire il Nome della squadra</label>
            <input type="text" name="NomeSquadra" class="form-control" required>
            <br>
            <label class="form-label">Inserire l'istituto di appartenenza </label>
            <select class="form-select" aria-label="Default select example" name="cap">
                <option selected><b>Seleziona un istituto</b></option>
                <?php
                    include '../../Connect.php';
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
            <label class="form-label">Inserire il <b>numero</b> di atleti della squadra</label>
            <input type="number" class="form-control" name="numero">
            <br>  
            <center>
                <input type="submit" class="btn btn-purple color-white" value="Invio">
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