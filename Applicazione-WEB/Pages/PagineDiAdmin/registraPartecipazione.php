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
        if (isset($_POST['id_squadra'])){
            include '../../Connect.php';
            $query = "insert into partecipa
            values ( " . $_POST['id_squadra'] . ", " . $_POST['id_gara'] . ",
            " . $_POST['posizione'] . ", " . $_POST['punteggio'] . ")";
            $cennection -> query($query);

            $query = "SELECT fase.record, fase.id_fase FROM fase
                        INNER JOIN gara ON gara.id_fase = fase.id_fase
                        WHERE gara.id_gara = '"  . $_POST['id_gara'] . "';";
            $row = $cennection -> query($query) -> fetch_assoc();
            $ID_FASE = $row['id_fase'];

            if ($row['record'] < $_POST['punteggio']){
                $query = "UPDATE fase SET fase.record = '" . $_POST['punteggio'] . "'
                            WHERE fase.id_fase = '" . $ID_FASE . "';";
                $cennection -> query($query);
            }
        }
    ?>

    <div class="center-div">
        <form action="./registraPartecipazione.php" method="post"> 
            
            <label class="form-label">Scegli la squadra</label>
            <select class="form-select" name="id_squadra">
                <option value=""></option>
                <?php
                    include './../../Connect.php';
                    $query = "SELECT * FROM squadra order by nome";
                    $result = $cennection -> query($query);
                    echo "<option value='' selected> <b>Scegli una Squadra</b> </option>";
                    while($row = $result->fetch_assoc()){
                        echo '<option value=' . $row['id_squadra'] . '>' . $row['nome'] . '</option>';
                    };
                ?>
            </select>
            <label class="form-label">Scegli la gara alla quale ha partecipato</label>
            <select class="form-select" name="id_gara">
                <option value=""></option>
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
            <label class="form-label">Scegli il punteggio</label>
            <input type="number" name="punteggio" class="form-control">

            <label class="form-label">Inserisci la posizione</label>
            <input type="number" name="posizione" class="form-control">
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