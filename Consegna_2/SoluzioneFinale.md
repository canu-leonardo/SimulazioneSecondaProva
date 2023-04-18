# Soluzione della prova

## Analisi della realtà di riferimento
### Esposizione del problema
In questa prova ci è stato chiesto di ideare, progettare e realizzare un sistema di gestione degli "atleti" che hanno partecipato alle Olimpiadi di Informatica che si sono tenute nell'anno 2008.<br>
Il nostro compito è quello di creare un database in grado di memorizzare le informazioni degli alunni, che possono partecipare come squadra oppure come singolo, le informazioni riguardo alle gare e le rispettive sedi nelle quali si svolgeranno le prove.<br>
Le Olimpiadi in questione prevedono una suddivisione in fasi: una scolastica, tenuta nelle scuole, una fase regionale, una finale nazionale e una internazionale che eleggerà il vincitore assoluto.

### Analisi e soluzione
Abbiamo dedotto, dal testo, che per giungere alla soluzione del problema sono necessarie ben sei entità principali: Gara, Fase, Sede, Squadra, Atleta, Istituto.<br>
Dopo un'attenta analisi siamo giunti alla conclusione che l'entità intorno alla quale gira tutto il database è quella della **Gara** dove vi possono partecipare gli **Atleti*, raggruppati in **Squadre** oppure come singoli. Ogni gara è caratterizzata dalla **Sede** che la ospita e dal "livello" della prova, riassunto nella **Fase**.<br>
Leggendo attentamente tutta la traccia, abbiano notato come sia necessario l'**Istituto** di provenienza delle squadre e degli studenti. Molto probabilmente, nel sistema informatico vero e proprio, inseriremo come vincolo che gli atleti di una squadra siano iscritti tutti allo stesso istituto.

### Descrizione delle entità e delle loro relazioni e attributi
- **Gara**: l'entità gara, di per sè, ha soltanto l'attributo identificativo, ma grazie alle relazioni con la *Sede* e con la *Fase* acquisisce le loro chiavi esterne. Ovviamente la gara è caratterizzata proprio dal luogo dove si svolge e dalla fase.<br>
- **Sede**: l'entità sede è l'entità che rappresenta il luogo nel quale si svolgerà la singola *gara*. Quest'entità è stata citata specificatamente nel testo e la sua unica relazione è, appunto, con la *gara* stessa. Gli attrubuti che la caratterizzano sono il nome del luogo e il CAP, che grazie a tutte e cinque le cifre la identifica univocamente.<br>
- **Fase**: l'entità della fase è molto importante, distingue il livello delle varie gare, pertanto si lega soltanto ad essa tramite una relazione 1 a N. Oltre ad avere un identificativo artificiale (che sarà : *0* per le gare scolastica; *1* per quelle regionale; *2* per quelle nazionale; *3* per quelle internazionale) e dalla descrizione, che sarà semplicemente il grado della fase (es: nazionale).<br>
- **Atleta**: l'atleta o studente è l'entità che rappresenta i partecipanti alle noste Olimpiadi. Oltre ad avere come attributo le classiche generalità (nome, cognome ed età) ha anche il Codice fiscale come chiave primaria e l'identificativo dell'istituto che lo ospita. Infine l'ultimo attributo è la squadra di appartenenza: un'atleta può scegliere se partecipare come singplo oppure in squadra. Pertanto noi abbiamo deciso che lasceremo la possibilià di scelta e nel caso uno studente partecipi come singolo l'attributo verrà messo con valore ``` null ```.<br>
- **Squadra**: la squadra è l'entità nella quale si raggruppano diversi atleti che vogliono partecitare alle Olimpiadi.
 La squadra dovrà scegliere un suo nome ma sarà comunque identificata da un ID, in oltre, dopo una più attenta analisi, abbiamo deciso di imporre come vincolo che tutta la squadra deve provenire dallo stesso istituto.<br> 
- **Istuituto**: L'istituto è un' entità che abbiamo deciso di mettere dopo esserci soffermati sulla normalizzazione delle nostre entità. Abbiamo notato, infatti, come essa sia presente nelle entità *Atleta* e *Squadra*, costringendoci a creare un'entità appposita, per evitere problemi di ridondanza e integrità. Così l'istituto è caratterizzato, come la sede, dal suo CAP. C'era la possibilità di riunire le entità Sede e Istituto, ma abbiamo deciso di inserire nel nostro sistema informativo la possibilità che una gara non si tenga all'interno di una scuola.<br> 
- **Partecipa_Squadra/Partecipa_Singolo**: queste due tabelle vengono fuori dalle relazioni N a N tra studente-gara e squadra-gara. Sono molto simili: hanno entrambi come le chiavi delle entità che mettono in relazione, con l'aggiunta della posizione in classifica.<br>   

## Schema concettuale della base di dati
![](../Resources/DiagrammaER_image.jpg)

## Schema logico della base di dati
- **Istituto**: Nome, *CAP_Istituto*(PK);
- **Sede**: Nome, *CAP_Sede*(PK);
- **Fase**: *ID_Fase*(PK), Descrizione;
- **Atleta**: Nome, Cognome, Eta, *CAP_Istituto*(FK), *CF*(PK), *ID_Squadra*(FK);
- **Squadra**: *ID_Squadra*(PK), Nome, *CAP_Istituto*(FK);
- **Gara**: *ID_Gara*(PK), data_esecuzione, *ID_Fase*(FK), *CAP_Sede*(FK);
- **Partecipa**: *ID_Squadra*(FK), *ID_Gara*(FK), Posizione, Punteggio;

## Definizione delle relazioni della base di dati in linguaggio SQL
```sql
DROP DATABASE IF EXISTS Olimpiadi_di_Informatica;
CREATE DATABASE Olimpiadi_di_Informatica;
USE Olimpiadi_di_Informatica;

CREATE TABLE istituto (
    nome varchar(20),
    cap_istituto varchar(20)  not null primary key
);

CREATE TABLE sede (
    nome varchar(20),
    cap_sede varchar(20)  not null primary key
);

CREATE TABLE fase (
    id_fase int not null primary key,
    descrizione varchar(20)
);

CREATE TABLE squadra (
    id_squadra int primary key,
    nome varchar(20),
    cap_istituto varchar(20),
    foreign key (cap_istituto) references istituto (cap_istituto)
);

CREATE TABLE atleta (
    nome varchar(20),
    cognome varchar(20),
    eta varchar(20),
    cap_istituto varchar(20),
    cf varchar(20) not null primary key,
    id_squadra int,
    foreign key (id_squadra) references squadra (id_squadra),
    foreign key (cap_istituto) references istituto (cap_istituto)
);

CREATE TABLE gara (
    id_gara int auto_increment primary key,
    id_fase int,
    cap_sede varchar(30),
    data_esecuzione Date,
    foreign key(cap_sede) references sede (cap_sede),
    foreign key(id_fase) references fase (id_fase)
);

CREATE TABLE partecipa(
    cf_atleta varchar(20),
    id_gara int,
    posizione int,
    puneggio int,
    foreign key(cf_atleta) references atleta (cf),
    foreign key(id_gara) references gara (id_gara)
)

```
## La seguenti interrogazioni espresse in linguaggio SQL
- stampare l’elenco degli atleti raggruppati per squadre per ogni singola fase:
```sql
SELECT
```
- dato il nome di un atleta stampare i risultati ottenuti nelle diverse gare alle quali ha partecipato:
```sql
SELECT
```
- stampare il calendario delle gare:
```sql
SELECT
```
- stampare una scheda informativa (cognome, nome, istituto scolastico di provenienza, nazionalità) del vincitore e della squadra vincitrice:
```sql
SELECT
```
- stampare la classifica per ciascuna gara (a parità di punteggio vengono privilegiati gli atleti più giovani):
```sql
SELECT
```
- aggiornare, per ciascuna fase (scolastica-regionale-nazionale-internazionale) gli eventuali punteggi record:
```sql
SELECT
```
- calcolare il punteggio medio ottenuto durante la prima selezione, per ciascun istituto scolastico:
```sql
SELECT
```
- stampare per ciascuna squadra il numero di “atleti” partecipanti e l’età media:
```sql
SELECT
```
## L’interfaccia utente che il candidato intende proporre per interagire con la base di dati e codificare in un linguaggio di programmazione a scelta un segmento significativo del progetto realizzato.
//da inserire

## Un sito Internet che presenti al pubblico le classifiche delle diverse gare.
//da inserire