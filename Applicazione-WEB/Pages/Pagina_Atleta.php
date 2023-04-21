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

    <nav class="navbar navbar-light bg-purple">
        <div class="container-fluid">
            <p class="navbar-brand color-white">
                <img src="/Resources/LOGO.svg" alt="" width="30" height="24" class="d-inline-block white-logo ">
                Olimpiadi di Informatica
            </p>
        </div>
    </nav>

    <form method="get">
        <select name="Fase" onChange="this.form.submit()">
            <option value="" selected> <b>Scegli una fase</b>  </option>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function AdminVerification() {
            const form = document.getElementById("AdminPassw");
            if(form.value == "Password"){
                window.location.href = "./Pages/Admin.php";
            }else{
                document.getElementById("AdmoinButton").classList.add("error");
            }
        }
    </script>
</body>
</html>