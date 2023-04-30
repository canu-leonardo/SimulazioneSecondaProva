<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olimpiadi di informatica</title>
    <link rel="shortcut icon" href="../Resources/LOGO.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../Style.css">
</head>

<body>

    <?php
        include "./../navBar.php";
    ?>  
    
    <div class="center-div">
        <center>
            <div>
                <a href="./PagineDiAdmin/addAtleta.php" class="col-6"> <button class="btn-admin btn btn-success">  Aggiungi atleta singolo   </button> </a> <br>
                <a href="./PagineDiAdmin/addSquadra.php" class="col-6"> <button class="btn-admin btn btn-success">  Aggiungi Squadra  </button> </a> <br>
                <a href="./PagineDiAdmin/addgara.php" class="col-6"> <button class="btn-admin btn btn-success">  Aggiungi gara     </button> </a> <br>
            </div>
                <br>
            <div>
                <a href="./PagineDiAdmin/modSquadra.php" class="col-6"> <button class="btn-admin btn btn-warning">  Modifca Squadra   </button> </a> <br>
                <a href="./PagineDiAdmin/modGara.php" class="col-6"> <button class="btn-admin btn btn-warning">  Modifica Gara     </button> </a> <br>
            </div>
                <br>
            <div>
                <a href="./PagineDiAdmin/removeAtleta.php" class="col-6"> <button class="btn-admin btn btn-danger">  Rimuovi atleta    </button> </a> <br>
                <a href="./PagineDiAdmin/removeSquadra.php" class="col-6"> <button class="btn-admin btn btn-danger">  Rimuovi Squadra   </button> </a> <br>
            </div>
        </center>
        <center>
            <a href="../index.php"><button class="btn btn-purple color-white">Home</button></a>
        </center>
    </div>

    <?php
        include "../Footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>