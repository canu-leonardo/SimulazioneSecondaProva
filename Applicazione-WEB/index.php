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

    <nav class="navbar navbar-light bg-purple">
        <div class="container-fluid">
            <p class="navbar-brand color-white">
                <img src="/Resources/LOGO.svg" alt="" width="30" height="24" class="d-inline-block white-logo ">
                Olimpiadi di Informatica
            </p>
        </div>
    </nav>

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
                    <button class="btn btn-purple color-white" onclick="AdminVerification()"> Invio </button>
                </center>
                </form>
            </div>
        </ul>
    </div>

    <div class="center-div">
        <form action="./Pages/Pagina_Atleta.php" method="post">
            <div class="mb-3">
                <center>
                    <label class="form-label">Inserisci il tuo <b>Codice Fiscale</b> per visualizzare le tue informazioni</label>
                </center>
                <input type="text" class="form-control" name="CF">
            </div>
            <center>
                <input type="submit" value="Invio" class="btn btn-purple color-white">
            </center>
        </form>

        <div class="visualizza-classifca bg-purple color-white">
            <center>
                Visualizza la <b>classifica</b> delle Gare <br>
                <a href=""><button class="btn bg-white button-white color-purple">Visualizza</button></a>
            </center>
        </div>

    </div>


    <div class="footer">
        <div class="bg-purple" style="height: 50px; margin-top: 30px;">
        </div>
        <div class="bg-dark footers-footer">
            <div class="row">
                <div class="col-4 footer-column">
                    <b>Team</b>
                    <hr class="orizotal-separator">
                    Canu Leonardo<br>
                    Samue Maranghi
                </div>
                <div class="col-4 footer-column">
                    <b>Sorce Code</b>
                    <hr class="orizotal-separator">
                    <a href="https://github.com/canu-leonardo/SimulazioneSecondaProva" class="link-white" target="_blank">Git hub</a>
                </div>
                <div class="col-4 footer-column">

                </div>
            </div>
        </div>
    </div>

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