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

    <nav class="navbar navbar-light bg-purple">
        <div class="container-fluid">
            <p class="navbar-brand color-white">
                <img src="/Resources/LOGO.svg" alt="" width="30" height="24" class="d-inline-block white-logo ">
                Olimpiadi di Informatica
            </p>
        </div>
    </nav>
    <div class="center-div">
        <?php     
            include "../Connect.php";
            #############################################################################################
            ## query per ricavare l' id della squadra dell'atleta
            $query = "SELECT atleta.id_squadra FROM atleta WHERE atleta.cf = '" . $_POST['CF'] . "'";
            $result = $cennection -> query($query);
            $row = $result->fetch_assoc();
            $squadra = $row['id_squadra'];
            
            #############################################################################################
            ## query per ricavare il nome della squadra
            $query_NomeSquadra = "SELECT squadra.nome FROM squadra WHERE squadra.id_squadra = " . $squadra ;
            $result_NomeSquadra = $cennection -> query($query_NomeSquadra);
            $row_NomeSquadra = $result_NomeSquadra -> fetch_assoc(); 
            $nomeSquadra = $row_NomeSquadra['nome'];

            #############################################################################################
            ## query per ricavare i memri della squadra
            $query_partecipantiSquadra = "SELECT atleta.nome, atleta.cognome FROM atleta WHERE atleta.id_squadra = " . $squadra ;
            $result_partecipantiSquadra = $cennection -> query($query_partecipantiSquadra);

            #############################################################################################
            ## controllo per distinguere da giocantore singolo a squadra
            if ($result_partecipantiSquadra -> num_rows > 1){
                echo "<h2>Informazioni della squadra " . $nomeSquadra . "</h2>";
                echo "<h3>Partecipanti:</h3>";
                echo "<ul>";
                while ($row = $result_partecipantiSquadra -> fetch_assoc()){
                    echo "<li>" . $row['nome'] . " " . $row['cognome'] . "</li>";
                }
                echo "</ul>";
            }else{
                $query = "SELECT atleta.nome FROM atleta WHERE atleta.cf = '" . $_POST['CF'] . "'";
                $result_nomeAtleta = $cennection -> query($query); 
                $row = $result_nomeAtleta -> fetch_assoc(); 
                echo "<h2>Informazioni del partecipante " . $row['nome'] . "</h2>";
            }

            #############################################################################################
            ## query per ricavare i dati della partecipazione alle varie gare            
            $queryFase1 = "SELECT partecipa.posizione, partecipa.punteggio, gara.data_esecuzione, sede.nome FROM partecipa 
                            INNER JOIN gara ON gara.id_gara = partecipa.id_gara
                            INNER JOIN sede ON sede.cap_sede = gara.cap_sede
                            WHERE partecipa.id_squadra = " . $squadra . " AND gara.id_gara = 1";
            $queryFase2 = "SELECT partecipa.posizione, partecipa.punteggio, gara.data_esecuzione, sede.nome FROM partecipa 
                            INNER JOIN gara ON gara.id_gara = partecipa.id_gara
                            INNER JOIN sede ON sede.cap_sede = gara.cap_sede
                            WHERE partecipa.id_squadra = " . $squadra . " AND gara.id_gara = 2";
            $queryFase3 = "SELECT partecipa.posizione, partecipa.punteggio, gara.data_esecuzione, sede.nome FROM partecipa 
                            INNER JOIN gara ON gara.id_gara = partecipa.id_gara
                            INNER JOIN sede ON sede.cap_sede = gara.cap_sede
                            WHERE partecipa.id_squadra = " . $squadra . " AND gara.id_gara = 3";
            $queryFase4 = "SELECT partecipa.posizione, partecipa.punteggio, gara.data_esecuzione, sede.nome FROM partecipa 
                            INNER JOIN gara ON gara.id_gara = partecipa.id_gara
                            INNER JOIN sede ON sede.cap_sede = gara.cap_sede
                            WHERE partecipa.id_squadra = " . $squadra . " AND gara.id_gara = 4";

            #############################################################################################
            ## controlli per visualizzare i dati delle varie gare
            $result1 = $cennection -> query($queryFase1);
            echo "<h3>Punteggio nella fase scolastica</h3>";
            if ($result1 -> num_rows != 0){
                while($row = $result1 -> fetch_assoc()){
                    echo "Hai partecipato alla fase scolastica il giorno " . $row['data_esecuzione'] . " nella sede di " . $row['nome'] . " raggiungendo la " . $row['posizione'] . " posizione, con un punteggio di " . $row['punteggio'] . ". "; 
                }
            }else{    echo "la squadra non ha ancora partecipato alla fase oppure non è passata";    }  
            
            $result2 = $cennection -> query($queryFase2);
            echo "<h3>Punteggio nella fase regionale</h3>";
            if ($result2 -> num_rows != 0){
                while($row = $result1 -> fetch_assoc()){
                    echo "Hai partecipato alla fase regionale il giorno " . $row['data_esecuzione'] . " nella sede di " . $row['nome'] . " raggiungendo la " . $row['posizione'] . " posizione, con un punteggio di " . $row['punteggio'] . ". "; 
                }
            }else{    echo "la squadra non ha ancora partecipato alla fase oppure non è passata";    } 

            $result3 = $cennection -> query($queryFase3);
            echo "<h3>Punteggio nella fase nazionale</h3>";
            if ($result3 -> num_rows != 0){
                while($row = $result1 -> fetch_assoc()){
                    echo "Hai partecipato alla fase nazionale il giorno " . $row['data_esecuzione'] . " nella sede di " . $row['nome'] . " raggiungendo la " . $row['posizione'] . " posizione, con un punteggio di " . $row['punteggio'] . ". ";
                }
            }else{    echo "la squadra non ha ancora partecipato alla fase oppure non è passata";    } 

            $result4 = $cennection -> query($queryFase4);
            echo "<h3>Punteggio nella fase internazionale</h3>";
            if ($result4 -> num_rows != 0){
                while($row = $result1 -> fetch_assoc()){
                    echo "Hai partecipato alla fase internazionale il giorno " . $row['data_esecuzione'] . " nella sede di " . $row['nome'] . " raggiungendo la " . $row['posizione'] . " posizione, con un punteggio di " . $row['punteggio'] . ". ";
                }
            }else{    echo "la squadra non ha ancora partecipato alla fase oppure non è passata";    } 
        ?>
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
</body>
</html>