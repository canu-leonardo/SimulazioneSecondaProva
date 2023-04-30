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
    <!--NAVBAR-->
    <?php
        include "./../navBar.php";
    ?>


    <!--CONTENT-PAGE-->
    <div class="center-div">
        <div class="row percorso">
            <div id="Path1" class="col-3 PercorsoNonAttivo"></div>
            <div id="Path2" class="col-3 PercorsoNonAttivo"></div>
            <div id="Path3" class="col-3 PercorsoNonAttivo"></div>
            <div id="Path4" class="col-3 PercorsoNonAttivo"></div>
        </div>
        <?php     
            include "../Connect.php";
                
            #############################################################################################
            ## query per ricavare l' id della squadra dell'atleta
            $queryPerNomeSquadra = "SELECT atleta.id_squadra FROM atleta WHERE atleta.cf = '" . $_POST['CF'] . "'";
            $result = $cennection -> query($queryPerNomeSquadra);

            if  ($result -> num_rows > 0) {
                $row = $result -> fetch_assoc();
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
                echo "<center>";
                if ($result_partecipantiSquadra -> num_rows > 1){
                    echo "<h2 class='titolone'>Informazioni della squadra " . $nomeSquadra . "</h2>";
                    echo "<div class='dropdown'>
                        <button class='btn btn-purple color-white dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
                            Membri della squadra:
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
                    while ($row_provvisorio = $result_partecipantiSquadra -> fetch_assoc()){
                        echo "<li class='dropdown-item'>" . $row_provvisorio['nome'] . " " . $row_provvisorio['cognome'] . "</li>";
                    }
                    echo "</ul> </div>";
                }else{
                    $query = "SELECT atleta.nome FROM atleta WHERE atleta.cf = '" . $_POST['CF'] . "'";
                    $result_nomeAtleta = $cennection -> query($query); 
                    $row_provvisorio2 = $result_nomeAtleta -> fetch_assoc(); 
                    echo "<h2 class='titolone'>Informazioni di <b>" . $row_provvisorio2['nome'] . "</b></h2>";
                }
                echo "</center>";

                #############################################################################################
                ## query per ricavare i dati della partecipazione alle varie gare        
                $queryFase1 = "SELECT partecipa.posizione, partecipa.punteggio, gara.data_esecuzione, sede.nome FROM partecipa 
                    INNER JOIN gara ON gara.id_gara = partecipa.id_gara
                    INNER JOIN sede ON sede.cap_sede = gara.cap_sede
                    WHERE partecipa.id_squadra = " . $squadra . " AND gara.id_fase = 1";
                $queryFase2 = "SELECT partecipa.posizione, partecipa.punteggio, gara.data_esecuzione, sede.nome FROM partecipa 
                    INNER JOIN gara ON gara.id_gara = partecipa.id_gara
                    INNER JOIN sede ON sede.cap_sede = gara.cap_sede
                    WHERE partecipa.id_squadra = " . $squadra . " AND gara.id_fase = 2";
                $queryFase3 = "SELECT partecipa.posizione, partecipa.punteggio, gara.data_esecuzione, sede.nome FROM partecipa 
                    INNER JOIN gara ON gara.id_gara = partecipa.id_gara
                    INNER JOIN sede ON sede.cap_sede = gara.cap_sede
                    WHERE partecipa.id_squadra = " . $squadra . " AND gara.id_fase = 3";
                $queryFase4 = "SELECT partecipa.posizione, partecipa.punteggio, gara.data_esecuzione, sede.nome FROM partecipa 
                    INNER JOIN gara ON gara.id_gara = partecipa.id_gara
                    INNER JOIN sede ON sede.cap_sede = gara.cap_sede
                    WHERE partecipa.id_squadra = " . $squadra . " AND gara.id_fase = 4";
                #############################################################################################
                ## controlli per visualizzare i dati della prima fase
                echo "<div class='DivFase'>";
                $result1 = $cennection -> query($queryFase1);
                echo "<h3 class='titoliFasi'>Punteggio nella fase <b>Scolastica</b></h3>";
                if ($result1 -> num_rows != 0){
                    $row_provvisorio3 = $result1 -> fetch_assoc();
                    echo "<p>Fase <b>scolastica</b> superata il giorno <b>" . $row_provvisorio3['data_esecuzione'] . "</b> nella sede di <b>" . $row_provvisorio3['nome'] . "</b> con un punteggio di <b>" . $row_provvisorio3['punteggio'] . "</b>. La posizione raggiuna e': <b>" . $row_provvisorio3['posizione'] . "</b> .</p> ";                 
                #############################################################################################
                ## script per aggiornare il 'percorso' della fase 1
                    echo "
                        <script>
                            const sezione1 = document.getElementById('Path1');
                            sezione1.classList.remove('PercorsoNonAttivo');
                            sezione1.classList.add('PercorsoAttivo');
                        </script>
                    ";
                }else{    echo "<p>La squadra non ha ancora partecipato alla suddetta fase oppure non è passata </p>";    }  
                echo "</div>";
                #############################################################################################
                ## controlli per visualizzare i dati della seconda fase
                echo "<div class='DivFase'>";
                $result2 = $cennection -> query($queryFase2);
                echo "<h3 class='titoliFasi'>Punteggio nella fase <b>Regionale</b></h3>";
                if ($result2 -> num_rows != 0){
                    while($row_provvisorio4 = $result2 -> fetch_assoc()){
                        echo "<p>Fase <b>regionale</b> superata il giorno <b>" . $row_provvisorio4['data_esecuzione'] . "</b> nella sede di <b>" . $row_provvisorio4['nome'] . "</b> con un punteggio di <b>" . $row_provvisorio4['punteggio'] . "</b>. La posizione raggiuna e': <b>" . $row_provvisorio4['posizione'] . "</b> .</p> ";   
                    }
                #############################################################################################
                ## script per aggiornare il 'percorso' della fase 2
                    echo "
                        <script>
                            const sezione2 = document.getElementById('Path2');
                            sezione2.classList.remove('PercorsoNonAttivo');
                            sezione2.classList.add('PercorsoAttivo');
                        </script>
                    ";
                }else{    echo "<p>La squadra non ha ancora partecipato alla suddetta fase oppure non è passata </p>";    } 
                echo "</div>";
                #############################################################################################
                ## controlli per visualizzare i dati della terza fase
                echo "<div class='DivFase'>";
                $result3 = $cennection -> query($queryFase3);
                echo "<h3 class='titoliFasi'>Punteggio nella fase <b>Nazionale</b></h3>";
                if ($result3 -> num_rows != 0){
                    while($row_provvisorio5 = $result3 -> fetch_assoc()){
                        echo "<p>Fase <b>nazionale</b> superata il giorno <b>" . $row_provvisorio5['data_esecuzione'] . "</b> nella sede di <b>" . $row_provvisorio5['nome'] . "</b> con un punteggio di <b>" . $row_provvisorio5['punteggio'] . "</b>. La posizione raggiuna e': <b>" . $row_provvisorio5['posizione'] . "</b> .</p> ";   
                    }
                #############################################################################################
                ## script per aggiornare il 'percorso' della fase 3
                    echo "
                        <script>
                            const sezione3 = document.getElementById('Path3');
                            sezione3.classList.remove('PercorsoNonAttivo');
                            sezione3.classList.add('PercorsoAttivo');
                        </script>
                    ";
                }else{    echo "<p>La squadra non ha ancora partecipato alla suddetta fase oppure non è passata </p>";    } 
                echo "</div>";
                #############################################################################################
                ## controlli per visualizzare i dati della quarta fase
                echo "<div class='DivFase'>";
                $result4 = $cennection -> query($queryFase4);
                echo "<h3 class='titoliFasi'>Punteggio nella fase <b>Internazionale</b></h3>";
                if ($result4 -> num_rows != 0){
                    while($row_provvisorio6 = $result4 -> fetch_assoc()){
                        echo "<p>Fase <b>internazionale</b> superata il giorno <b>" . $row_provvisorio6['data_esecuzione'] . "</b> nella sede di <b>" . $row_provvisorio6['nome'] . "</b> con un punteggio di <b>" . $row_provvisorio6['punteggio'] . "</b>. La posizione raggiuna e': <b>" . $row_provvisorio6['posizione'] . "</b> .</p> ";   
                    }
                #############################################################################################
                ## script per aggiornare il 'percorso' della fase 4
                    echo "
                        <script>
                            const sezione4 = document.getElementById('Path4');
                            sezione4.classList.remove('PercorsoNonAttivo');
                            sezione4.classList.add('PercorsoAttivo');
                        </script>
                    ";
                }else{    echo "<p>La squadra non ha ancora partecipato alla suddetta fase oppure non è passata </p>";    } 
                echo "</div>";
                #############################################################################################
            }else{ echo "<center> <p>Perfavore inserisci un codice fiscale valido</p> </center>"; }            
        ?>
        <center>
            <a href="../index.php"><button class="btn btn-purple color-white">Home</button></a>
        </center>
    </div>    
    <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> 
    <!--FOOTER-->
    <?php
        include "../Footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>