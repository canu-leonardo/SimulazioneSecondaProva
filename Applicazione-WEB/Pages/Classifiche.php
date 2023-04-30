<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olimpiadi di informatica</title>
    <link rel="shortcut icon" href="./Resources/LOGO.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../Style.css">
</head>

<body>

    <?php
        include "./../navBar.php";
    ?>


   
    
    <div class="center-div">
        <h2>Scegli una fase</h2>
        <form method="get">
            <select name="Fase" class="form-select" onChange="this.form.submit()">
                <option value="" selected> <b>Scegli una fase della quale visualizzare la claasifica</b>  </option>
                <?php
                    session_start();
                    if (isset($_GET['Fase'])){
                        $_SESSION['Fase'] = $_GET['Fase'];
                    }else{
                        $_SESSION['Fase'] = 1;
                    }
                    $connection = new mysqli("localhost","root","", "Olimpiadi_di_Informatica");
                    $richiesta = "select * from fase";
                    $result = $connection -> query($richiesta);
                    while($row = $result->fetch_assoc()){
                        echo "<option value='" . $row['id_fase'] . "'>" . $row['descrizione'] . "</option>";
                    }
                ?>
            </select>
        </form>

        <table class="table table-classifica">
            <thead>
                <tr>
                    <th scope="col">Posizione</th>
                    <th scope="col">Nome della Squadra</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($_SESSION['Fase'])){        
                        $richiesta = "SELECT partecipa.posizione, squadra.nome FROM squadra
                            INNER JOIN partecipa ON  partecipa.id_squadra = squadra.id_squadra
                            INNER JOIN gara ON gara.id_gara = partecipa.id_gara
                            INNER JOIN fase ON fase.id_fase = gara.id_fase
                            WHERE fase.id_fase = " . $_SESSION['Fase'] . "
                            ORDER BY partecipa.posizione;";
                        $result = $connection -> query($richiesta);
                        while($row = $result->fetch_assoc()){
                            echo "  <tr>
                                        <td scope='row'>" . $row['posizione'] . " </td>
                                        <td>" . $row['nome'] . "</td>
                                    </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
        </center>
        <center>
            <a href="../index.php"><button class="btn btn-purple color-white">Home</button></a>
        </center>
    </div>

    <br>  
    <?php
        include "../Footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>