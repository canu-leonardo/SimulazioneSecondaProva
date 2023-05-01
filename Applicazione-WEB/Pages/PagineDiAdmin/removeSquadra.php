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
        include'./../../navBar.php'; 
    ?>

    <?php
        if(isset($_POST['IdSquadra'])){
            include './../../Connect.php';

            $query_eliminaPartecipanti = "DELETE FROM atleta WHERE atleta.id_squadra = '" . $_POST['IdSquadra'] .  "'" ;
            $cennection -> query($query_eliminaPartecipanti);

            $query_eliminaPartecipa = "DELETE FROM partecipa WHERE partecipa.id_squadra = '" . $_POST['IdSquadra'] .  "'" ;
            $cennection -> query($query_eliminaPartecipa);

            $query_eliminaSquadra = "DELETE FROM squadra WHERE squadra.id_squadra = '" . $_POST['IdSquadra'] . "'";
            $cennection -> query($query_eliminaSquadra);

        }
    ?>

    <div class="center-div">
        <form action="./removeSquadra.php" method="post">
            <label class="form-label">Seleziona la squadra che vuoi rimuovere dal database</label>
            <select name="IdSquadra" class="form-select" onChange="this.form.submit()">
                <option value="" selected></option>
            <?php
                include '../../Connect.php';
                $query = "SELECT squadra.id_squadra, squadra.nome FROM squadra";
                $result = $cennection -> query($query);
                while ($row = $result->fetch_assoc()){
                    echo "<option value = '".$row['id_squadra']."'> ". $row['nome']."</option>";
                }
            ?>
            </select>
            <br> 
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