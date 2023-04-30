<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olimpiadi di informatica</title>
    <link rel="shortcut icon" href="./Resources/LOGO.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./Style.css">
</head>

<body>

    <?php
        include "./navBar.php";
    ?>

    <div class="dropdown">
        <button class="btn bg-white button-white color-purple admin-button" data-bs-toggle="dropdown" aria-expanded="false" id="AdminButton">  Admin  </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <div class="dropdown-div">
                <div class="mb-3">
                    <center>
                        <label class="form-label">Inserisci la <b>Password</b> di admin</label>
                    </center>
                    <input type="password" class="form-control" id="AdminPassw">
                </div>
                <center>
                    <button class="btn btn-purple color-white" onclick="AdminVerification()" id="AdminButton"> Invio </button>
                </center>
            </div>
        </ul>
    </div>

    <div class="center-div">
        <center>
        <form action="./Pages/Pagina_Atleta.php" method="post">
            <div class="mb-3">
                    <label class="form-label">Inserisci il tuo <b>Codice Fiscale</b> per visualizzare le tue informazioni</label>
                <input type="text" class="form-control" name="CF" required>
            </div>
                <input type="submit" value="Invio" class="btn btn-purple color-white">
        </form>
        </center>
        
        <div class="visualizza-classifca bg-purple color-white">
            <center>
                Visualizza la <b>classifica</b> delle Gare <br>
                <a href="./Pages/Classifiche.php"><button class="btn bg-white button-white color-purple">Visualizza</button></a>
            </center>
        </div>
    </div>

    <?php
        include "./Footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function convertToHash(str) {
            let hashString = 0;
            for (let character of str) {
                let charCode = character.charCodeAt(0);
                hashString = hashString << 5 - hashString;
                hashString += charCode;
                hashString |= hashString;
            }
            return hashString;
        }
        // Questa funzione per l'hashing è stata torvata on-line, al seguente link
        // https://www.tutorialspoint.com/how-to-create-a-hash-from-a-string-in-javascript

        function AdminVerification() {
            const password = convertToHash("password");
            const form = document.getElementById("AdminPassw");
            if(convertToHash(form.value) == password){  window.location.href = "./Pages/Admin.php"; }
            else{  document.getElementById("AdminButton").classList.add("error");  }
        }
    </script>
</body>
</html>