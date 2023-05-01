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
        if (isset($_POST['CF'])){
            include '../../Connect.php';
            $query_CreazioneSquadra = "INSERT INTO squadra (nome, cap_istituto)
                                        VALUES ('" . $_POST['nome'] . "-" . $_POST['cognome'] . "', '" . $_POST['Cap_Istituto'] . "')"; 
            $cennection -> query($query_CreazioneSquadra);

            $query_getID_Squadra = "SELECT squadra.id_squadra FROM squadra WHERE squadra.nome = '" . $_POST['nome'] . "-" . $_POST['cognome'] . "';";
            $row = $cennection -> query($query_getID_Squadra) -> fetch_assoc();
            $id_squadra = $row['id_squadra'];

            $query_creazioneAtleta = "insert into atleta
            values ('" . $_POST['nome'] . "', '" . $_POST['cognome'] . "',
             " . $_POST['eta'] . ", '" . $_POST['Cap_Istituto'] . "',
              '" . $_POST['CF'] . "', " . $id_squadra . ", '" . $_POST['nazione'] . "');";
            $cennection -> query($query_creazioneAtleta);

        }
    ?>

    <div class="center-div">
        <form action="./addAtleta.php" method="post">
        <?php 
            include "./atleta.php";
        ?>  
            <label class='form-label'>Scegli l'istituto di appartenenza</label>
            <select name="Cap_Istituto" class="form-select">
                <option value="" selected></option>
                <?php
                    include '../../Connect.php';
                    $query = "SELECT * FROM istituto";
                    $result = $cennection -> query($query);
                    while($row = $result->fetch_assoc()){
                        echo "<option value = '" . $row['cap_istituto'] . "'>" . $row['nome'] . "</option>";
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