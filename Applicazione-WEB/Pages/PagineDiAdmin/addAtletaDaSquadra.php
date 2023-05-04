

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
        include '../../Connect.php'; 
        session_start();
        if(isset ($_POST['CF'])) {
            $_SESSION['numeroAtleti']--;
            $query = "insert into atleta
            values ('" . $_POST['nome'] . "', '" . $_POST['cognome']  . "',
                " . $_POST['eta'] . ", '" . $_SESSION['Istituto'] . "',
                '" . $_POST['CF'] ."', " . $_SESSION['ID_Squadra'] . ",
                '" . $_POST['nazione'] . "')";
            $result = $cennection -> query($query);
        }        
        
        if ($_SESSION['numeroAtleti'] < 1) {
            session_destroy();
            echo "  <script>
                        window.location.href = '../Admin.php'
                    </script>";
            
        }else{
            echo'<center> <h5 class="color-purple"> mancano ancora ' . $_SESSION['numeroAtleti']  . ' atleti da inserire  </h5></center>';
            echo "<form action='./addAtletaDaSquadra.php' method='post'>";
            include "./atleta.php";
            echo "<center>";
            echo "<br><input type='submit' class='btn btn-purple color-white' vlaue='conferma'>";
            echo "</center>";
            echo "</form>";
        }
    ?>  
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