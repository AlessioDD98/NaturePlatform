#Creazione Database
DROP DATABASE IF EXISTS NATURE;
CREATE DATABASE  NATURE;
USE NATURE;

drop table if exists Donazione;
drop table if exists Campagna;
drop table if exists Iscrizione;
drop table if exists Escursione;
drop table if exists ClassificazioneAnimale;
drop table if exists ClassificazioneVegetale;
drop table if exists PropostaAnimale;
drop table if exists PropostaVegetale;
drop table if exists Proposta;
drop table if exists Segnalazione;
drop table if exists Messaggio;
drop table if exists CorrezioneH;
drop table if exists CorrezioneSA;
drop table if exists CorrezioneSV;
drop table if exists Utente;
drop table if exists PresenzaVegetale;
drop table if exists PresenzaAnimale;
drop table if exists SpecieVegetale;
drop table if exists SpecieAnimale;
drop table if exists Habitat;

#Creazione tabelle con relativi vincoli di integrità referenziale e chiave primaria
CREATE TABLE Habitat(
  Nome varchar(200) PRIMARY KEY,
  Descrizione varchar(200) default "Nessuna Descrizione"
)engine=innodb;

CREATE TABLE SpecieAnimale(
  Classe varchar(100),
  NomeLatino varchar(200) not null,
  NomeItaliano varchar(100) not null,
  AnnoClassificazione int,
  LivelloVulnerabilità enum("Basso","Medio","Alto","Minimo","Critico") not null,
  Link varchar(200),
  Peso varchar(50),
  Altezza varchar(50),
  NumeroMedioProle int,
  NomeHabitat varchar(100) not null,
  primary key(NomeLatino)
)engine=innodb;
 
 
CREATE TABLE SpecieVegetale(
  Classe varchar(200) not null,
  NomeLatino varchar(200) not null,
  NomeItaliano varchar(100) not null,
  AnnoClassificazione int,
  LivelloVulnerabilità enum("Basso","Medio","Alto","Minimo","Critico") not null,
  Link varchar(200),
  Altezza varchar(50),
  Diametro varchar(50),
  NomeHabitat varchar(100) not null,
  Primary key(NomeLatino)
)engine=innodb;

  
CREATE TABLE PresenzaAnimale(
  NomeLatino varchar(100),
  NomeHabitat varchar(100),
  PRIMARY KEY (NomeLatino,NomeHabitat),
  FOREIGN key (NomeLatino) REFERENCES SpecieAnimale(NomeLatino) on delete cascade,
  FOREIGN KEY (NomeHabitat) REFERENCES Habitat(Nome) on delete cascade
)engine=innodb;
  
CREATE TABLE PresenzaVegetale(
  NomeLatino varchar(100),
  NomeHabitat varchar(100),
  PRIMARY KEY (NomeLatino,NomeHabitat),
  FOREIGN key (NomeLatino) REFERENCES SpecieVegetale(NomeLatino) on delete cascade,
  FOREIGN KEY (NomeHabitat) REFERENCES Habitat(Nome) on delete cascade
)engine=innodb;

CREATE TABLE Utente(
  Nickname varchar(200) primary key not null,
  Email varchar(200)not null,
  Professione varchar(100),
  DataRegistrazione date not null,
  ContatoreSegnalazioni int default 0,
  AnnoNascita int not null,
  Categoria enum("Semplice","Premium","Amministratore") not null,
  Foto mediumblob,
  Password varchar(200) not null,
  NumeroClassificazioniTotali int default 0,
  NumeroClassificazioniCorrette int default 0,
  NumeroClassificazioniNonCorrette int default 0,
  Affidabilita int default 0
)engine=innodb;

CREATE TABLE CorrezioneH(
  ID int auto_increment primary key,
  Nickname varchar(200) not null,
  NomeHabitat varchar(200) not null,
  Operazione enum("Inserimento","Cancellazione","Modifica"),
  FOREIGN KEY (Nickname) references Utente(Nickname) on delete cascade,
  FOREIGN KEY (NomeHabitat) references Habitat(Nome) on delete cascade
)engine=innodb;

CREATE TABLE CorrezioneSA(
  ID int auto_increment primary key,
  Nickname varchar(200) not null,
  NomeLatino varchar(100) not null,
  Operazione enum("Inserimento","Cancellazione","Modifica"),
  FOREIGN KEY (Nickname) references Utente(Nickname) on delete cascade,
  FOREIGN KEY (NomeLatino) references SpecieAnimale(NomeLatino) on delete cascade
)engine=innodb;

CREATE TABLE CorrezioneSV(
  ID int auto_increment primary key,
  Nickname varchar(200) not null,
  NomeLatino varchar(100) not null,
  Operazione enum("Inserimento","Cancellazione","Modifica"),
  FOREIGN KEY (Nickname) references Utente(Nickname) on delete cascade,
  FOREIGN KEY (NomeLatino) references SpecieVegetale(NomeLatino) on delete cascade
)engine=innodb;

CREATE TABLE Messaggio(
  ID int auto_increment primary key,
  NicknameMittente varchar(200) not null,
  NicknameDestinatario varchar(200) not null,
  Titolo varchar(100) not null,
  Testo varchar(200) not null,
  Timestamp timestamp not null,
  foreign key (NicknameMittente) references Utente(Nickname) on delete cascade,
  foreign key (NicknameDestinatario) references Utente(Nickname) on delete cascade
)engine=innodb;

CREATE TABLE Segnalazione(
  ID int auto_increment primary key,
  NomeHabitat varchar(200) not null,
  Nickname varchar(200) not null,
  Data date not null,
  Foto mediumblob not null,
  Latitudine float not null,
  Longitudine float not null,
  foreign key (NomeHabitat) references Habitat(Nome) on delete cascade,
  foreign key (Nickname) references Utente(Nickname) on delete cascade
)engine=innodb;

CREATE TABLE PropostaAnimale(
  IDSegnalazione int not null,
  Nickname varchar (200) not null,
  Classificazione varchar (100) not null,
  Data date not null,
  Commento varchar(200) default "Nessun Commento",
  primary key (IDSegnalazione, Nickname),
  foreign key (IDSegnalazione) references Segnalazione(ID) on delete cascade,
  foreign key (Classificazione) references SpecieAnimale(NomeLatino) on delete cascade,
  foreign key (Nickname) references Utente(Nickname) on delete cascade
)engine=innodb;

CREATE TABLE PropostaVegetale(
  IDSegnalazione int not null,
  Nickname varchar (200) not null,
  Classificazione varchar (100) not null,
  Data date not null,
  Commento varchar(200) default "Nessun Commento",
  primary key (IDSegnalazione, Nickname),
  foreign key (IDSegnalazione) references Segnalazione(ID) on delete cascade,
  foreign key (Classificazione) references SpecieVegetale(NomeLatino) on delete cascade,
  foreign key (Nickname) references Utente(Nickname) on delete cascade
)engine=innodb;

CREATE TABLE ClassificazioneAnimale(
  IDSegnalazione int,
  NomeLatino varchar(200),
  primary key (IDSegnalazione,NomeLatino),
  foreign key(IDSegnalazione) references Segnalazione(ID) on delete cascade,
  foreign key(NomeLatino) references SpecieAnimale(NomeLatino) on delete cascade
)engine=innodb;

CREATE TABLE ClassificazioneVegetale(
  IDSegnalazione int,
  NomeLatino varchar(200),
  primary key (IDSegnalazione,NomeLatino),
  foreign key(IDSegnalazione) references Segnalazione(ID) on delete cascade,
  foreign key(NomeLatino) references SpecieVegetale(NomeLatino) on delete cascade
)engine=innodb;

CREATE TABLE Escursione(
  ID int auto_increment primary key,
  NicknameCreatore varchar(200) not null,
  Titolo varchar(100) not null,
  OrarioPartenza time not null,
  OrarioRitorno time not null,
  NumeroMaxPartecipanti int not null,
  Descrizione varchar(200) default "Nessuna Descrizione",
  Data date not null,
  Tragitto varchar(200) not null,
  foreign key (NicknameCreatore) references Utente(Nickname) on delete cascade
)engine=INNODB;

CREATE TABLE Iscrizione(
  Nickname varchar(200) not null,
  IDEscursione int not null,
  primary key(Nickname,IDEscursione),
  foreign key (Nickname) references Utente(Nickname) on delete cascade,
  foreign key (IDEscursione) references Escursione(ID) on delete cascade
)engine=innodb;

CREATE TABLE Campagna(
  ID int auto_increment primary key,
  NicknameCreatore varchar(200) not null,
  Stato enum("Aperto","Chiuso") default "Aperto",
  DataInizio date not null,
  ImportoFinale int not null,
  Descrizione varchar(200) default "Nessuna Descrizione",
  foreign key (NicknameCreatore) references Utente(Nickname) on delete cascade
)engine=innodb;

CREATE TABLE Donazione(
  ID int auto_increment primary key,
  Nickname varchar(200) not null,
  IDCampagna int not null,
  Importo int not null,
  Note varchar (200) default"Nessuna Nota",
  foreign key (IDCampagna) references Campagna(ID) on delete cascade,
  foreign key (Nickname) references Utente(Nickname) on delete cascade
  )engine=innodb;

/*CREATE TABLE Donatore(
  Nickname varchar(200),
  IDDonazione int,
  primary key (IDDonazione, Nickname),
  foreign key (Nickname) references Utente(Nickname) on delete cascade,
  foreign key (IDDonazione) references Donazione(ID) on delete cascade
)engine=innodb;*/

#Caricamento dati nel DB
load data local  infile "flora.txt" into table SpecieVegetale FIELDS TERMINATED BY '	'  ignore 1 lines;
load data local infile "fauna.txt" into table SpecieAnimale FIELDS TERMINATED BY '	'  ignore 1 lines;
load data local infile "habitat.txt" into table Habitat FIELDS TERMINATED BY '	'  ignore 1 lines;
insert into PresenzaVegetale(NomeLatino,NomeHabitat) values ("Marsilea quadrifolia","Laguna");
insert into PresenzaVegetale(NomeLatino,NomeHabitat) values ("Marsilea quadrifolia","Lago");
insert into PresenzaVegetale(NomeLatino,NomeHabitat) values ("Galanthus nivalis","Foresta di conifere");
insert into PresenzaVegetale(NomeLatino,NomeHabitat) values ("Gentiana lutea","Foresta di conifere");
insert into PresenzaVegetale(NomeLatino,NomeHabitat) values ("Cyclamen repandum","Foresta mediterranea");
insert into PresenzaVegetale(NomeLatino,NomeHabitat) values ("Ophrys pallida","Foresta mediterranea");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Hystrix cristata","Foresta mediterranea");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Chionomys nivalis","Foresta di conifere");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Zootoca vivipara","Foresta mediterranea");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Vipera ammodytes","Foresta mediterranea");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Vipera ammodytes","Foresta di conifere");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Vipera aspis","Ambienti rocciosi");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Vipera berus","Foresta di conifere");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Vipera berus","Foresta mediterranea");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Vipera ursinii","Foresta mediterranea");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Vipera ursinii","Ambienti rocciosi");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Caretta caretta","Mare");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Chelonia mydas","Mare");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Corallium rubrum","Mare");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Centrostephanus longispinus","Mare");
insert into PresenzaAnimale(NomeLatino,NomeHabitat) values ("Centrostephanus longispinus","Laguna");

#Creazione trigger 1
drop trigger if exists PromozioneUtente;
DELIMITER |
create trigger  PromozioneUtente
after insert on Segnalazione
for each row
begin
  declare cont smallint;
  declare c cursor for select count(*) from Segnalazione where Segnalazione.Nickname=new.Nickname;
  open c;
  fetch c into cont;
  close c;
  if(cont>2) then
    update Utente set Categoria="Premium" where ((Utente.Nickname=new.Nickname) AND (Utente.Categoria="Semplice"));
  end if;
end|
DELIMITER ;

#Prova trigger 1
#insert into Utente (Nickname,Password,Email,Professione,DataRegistrazione,AnnoNascita,Categoria) values ("Alessio","Alessio","aaa","Aaa",1/01/2001,2000,"Semplice");
#insert into Segnalazione(Nickname) values("Alessio");
#insert into Segnalazione(Nickname) values("Alessio");
#insert into Segnalazione(Nickname) values("Alessio");

#Creazione trigger 2
drop trigger if exists ChiusuraCampagna;
DELIMITER |
create trigger  ChiusuraCampagna
after insert on Donazione
for each row
begin
  declare somma smallint;
  declare tot smallint;
  declare c cursor for select sum(Importo) from Donazione where IDCampagna=new.IDCampagna;
  declare c2 cursor for select ImportoFinale from Campagna where ID=new.IDCampagna;
  open c;
  fetch c into somma;
  close c;
  open c2;
  fetch c2 into tot;
  close c2;
  if(somma>=tot) then
    update Campagna set Stato="Chiuso" where (ID=new.IDCampagna) AND (Stato="Aperto");
  end if;
end|
DELIMITER ;

#Prova trigger 2
#insert into Campagna(ImportoFinale,Stato) values (10,"Aperto");
/*insert into Donazione(IDCampagna,Importo) values (1,5);
insert into Donazione(IDCampagna,Importo) values (1,5);*/

#trigger 3
#classificazione segnalazioni con piu di 5 proposte.
drop trigger if exists ClassificazioneAnimale;
DELIMITER |
create trigger ClassificazioneAnimale
after insert on PropostaAnimale
for each row 
begin
declare specie varchar(200);
if((select count(*) from PropostaAnimale where IDSegnalazione=New.IDSegnalazione)=5)
then
set specie=(select Classificazione
     from PropostaAnimale
     where IDSegnalazione=New.IDSegnalazione 
	 group by Classificazione having count(*)>= all (select count(*)
                                                from PropostaAnimale
                                                where IDSegnalazione=New.IDSegnalazione
                                                group by Classificazione));
insert into ClassificazioneAnimale(IDSegnalazione,NomeLatino) values(New.IDSegnalazione,specie);
end if;
end | 
DELIMITER ;

drop trigger if exists ClassificazioneVegetale;
DELIMITER |
create trigger ClassificazioneVegetale
after insert on PropostaVegetale
for each row 
begin
declare specie varchar(200);
if((select count(*) from PropostaVegetale where IDSegnalazione=New.IDSegnalazione)=5)
then
set specie=(select Classificazione
     from PropostaVegetale
     where IDSegnalazione=New.IDSegnalazione 
	 group by Classificazione having count(*)>= all (select count(*)
                                                from PropostaVegetale
                                                where IDSegnalazione=New.IDSegnalazione
                                                group by Classificazione));
insert into ClassificazioneVegetale(IDSegnalazione,NomeLatino) values(New.IDSegnalazione,specie);
end if;
end | 
DELIMITER ;

/*
#Creazione procedura Registrazione
#Gestire foto con upload
DROP PROCEDURE IF EXISTS Registrazione;
DELIMITER |
create procedure Registrazione(in Nickname varchar(200), in Password varchar(200), in Email varchar(200), in Professione varchar(200), in DataRegistrazione date, in AnnoNascita int)
begin
  start transaction; 
  insert into utente (Nickname,Password,Email,Professione,DataRegistrazione,AnnoNascita,Categoria) VALUES (Nickname,Password,Email,Professione,DataRegistrazione,AnnoNascita,"Semplice");
  commit work;
end|
DELIMITER ;*/

#Creazione procedura InviaMessaggi
DROP PROCEDURE IF EXISTS InviaMessaggio;
DELIMITER |
create procedure InviaMessaggio(in NicknameMittenteIN varchar(200), in NicknameDestinatarioIN varchar(200), in TitoloIN varchar(200), in TestoIN varchar(200))
begin
  start transaction;
  insert into Messaggio (NicknameMittente,NicknameDestinatario,Titolo,Testo) VALUES (NicknameMittenteIN,NicknameDestinatarioIN,TitoloIN,TestoIN);
  commit work;
end|
DELIMITER ;

/*
#Creazione procedura InserimentoSegnalazione
DROP PROCEDURE IF EXISTS InserimentoSegnalazione;
DELIMITER |
create procedure InserimentoSegnalazione(in NicknameIN varchar(200), in HabitatIN varchar(200),in DataIN date, in FotoIN varchar(200), in LatitudineIN int, in LongitudineIN int)
begin
  start transaction; 
  insert into Segnalazione (Nickname,NomeHabitat,Data,Foto,Latitudine,Longitudine) VALUES (NicknameIN,HabitatIN,DataIN,FotoIN,LatitudineIN,LongitudineIN);
  commit work;
end|
DELIMITER ;*/

#Creazione procedura InserimentoProposta
DROP PROCEDURE IF EXISTS InserimentoPropostaAnimale;
DELIMITER |
create procedure InserimentoPropostaAnimale(in IDSegnalazioneIN int, in NicknameIN varchar(200),in DataIN date, in CommentoIN varchar(200), in ClassificazioneIN varchar(100))
begin
  start transaction; 
  insert into PropostaAnimale (IDSegnalazione,Nickname,Classificazione,Data,Commento) VALUES (IDSegnalazioneIN,NicknameIN,ClassificazioneIN,DataIN,CommentoIN);
  commit work;
end|
DELIMITER ;

#Creazione procedura InserimentoProposta
DROP PROCEDURE IF EXISTS InserimentoPropostaVegetale;
DELIMITER |
create procedure InserimentoPropostaVegetale(in IDSegnalazioneIN int, in NicknameIN varchar(200),in DataIN date, in CommentoIN varchar(200), in ClassificazioneIN varchar(100))
begin
  start transaction; 
  insert into PropostaVegetale (IDSegnalazione,Nickname,Classificazione,Data,Commento) VALUES (IDSegnalazioneIN,NicknameIN,ClassificazioneIN,DataIN,CommentoIN);
  commit work;
end|
DELIMITER ;

#Creazione procedura CreaEscursione
DROP PROCEDURE IF EXISTS CreaEscursione;
DELIMITER |
create procedure CreaEscursione(in NicknameCreatoreIN varchar(200),in TitoloIN varchar(100),in OrarioPartenzaIN time,in OrarioRitornoIN time,in NumeroMaxPartecipantiIN int,in DescrizioneIN varchar(200),in DataIN date,in TragittoIN varchar(200))
begin
  start transaction; 
  insert into Escursione (NicknameCreatore,Titolo,OrarioPartenza,OrarioRitorno,NumeroMaxPartecipanti,Descrizione,Data,Tragitto) VALUES (NicknameCreatoreIN,TitoloIN,OrarioPartenzaIN,OrarioRitornoIN,NumeroMaxPartecipantiIN,DescrizioneIN,DataIN,TragittoIN);
  commit work;
end|
DELIMITER ;

#Creazione procedura InserisciSpecieAnimale
DROP PROCEDURE IF EXISTS InserisciSpecieAnimale;
DELIMITER |
create procedure InserisciSpecieAnimale(in ClasseIN varchar(200),in NomeLatinoIN varchar(200),in NomeItalianoIN varchar(100),in AnnoClassificazioneIN int,in LivelloVulnerabilitàIN varchar(50),in LinkIN varchar(200),in PesoIN varchar(20),in AltezzaIN varchar(50),in NumeroMedioProleIN int,in NomeHabitatIN varchar(100),in NicknameIN varchar(200))
begin
  declare c cursor for select nome from habitat where (nome=NomeHabitatIN);
  #Gestire caso in cui l'habitat non esiste
  start transaction; 
  insert into SpecieAnimale (Classe,NomeLatino,NomeItaliano,AnnoClassificazione,LivelloVulnerabilità,Link,Peso,Altezza,NumeroMedioProle,NomeHabitat) VALUES (ClasseIN,NomeLatinoIN,NomeItalianoIN,AnnoClassificazioneIN,LivelloVulnerabilitàIN,LinkIN,PesoIN,AltezzaIN,NumeroMedioProleIN,NomeHabitatIN);
  insert into PresenzaAnimale (NomeLatino,NomeHabitat) VALUES (NomeLatinoIN,NomeHabitatIN);
  insert into CorrezioneSA (Nickname,NomeLatino,Operazione) VALUES (NicknameIN,NomeLatinoIN,"Inserimento");
  commit work;
end|
DELIMITER ;

#Creazione procedura InserisciSpecieVegetale
DROP PROCEDURE IF EXISTS InserisciSpecieVegetale;
DELIMITER |
create procedure InserisciSpecieVegetale(in ClasseIN varchar(200),in NomeLatinoIN varchar(200),in NomeItalianoIN varchar(100),in AnnoClassificazioneIN int,in LivelloVulnerabilitàIN varchar(50),in LinkIN varchar(200),in AltezzaIN varchar(50),in DiametroIN varchar(20),in NomeHabitatIN varchar(100),in NicknameIN varchar(200))
begin
  declare c cursor for select nome from habitat where (nome=NomeHabitatIN);
  start transaction; 
  insert into SpecieVegetale (Classe,NomeLatino,NomeItaliano,AnnoClassificazione,LivelloVulnerabilità,Link,Altezza,Diametro,NomeHabitat) VALUES (ClasseIN,NomeLatinoIN,NomeItalianoIN,AnnoClassificazioneIN,LivelloVulnerabilitàIN,LinkIN,AltezzaIN,DiametroIN,NomeHabitatIN);
  insert into PresenzaVegetale (NomeLatino,NomeHabitat) VALUES (NomeLatinoIN,NomeHabitatIN);
  insert into CorrezioneSV (Nickname,NomeLatino,Operazione) VALUES (NicknameIN,NomeLatinoIN,"Inserimento");  
  commit work;
end|
DELIMITER ;

#Creazione procedura InserisciHabitat
DROP PROCEDURE IF EXISTS InserisciHabitat;
DELIMITER |
create procedure InserisciHabitat(in NomeIN varchar(200),in DescrizioneIN varchar(200),in NicknameIN varchar(200))
begin
  start transaction; 
  insert into Habitat (Nome,Descrizione) VALUES (NomeIN,DescrizioneIN);
  insert into CorrezioneH (Nickname,NomeHabitat,Operazione) VALUES (NicknameIN,NomeIN,"Inserimento");
  commit work;
end|
DELIMITER ;

#calcola per ogni utente l'affidabilità.
drop procedure if exists StatisticaAffidabilità;
DELIMITER |
create procedure StatisticaAffidabilità()
begin
declare npa int;
declare npv int;
declare i int default 0;
declare numutenti int;
declare numcA int;
declare numcV int;
declare nm varchar(200);
declare cur cursor for select Nickname from Utente where Categoria="Premium";
set numutenti=(select count(*) from Utente where Categoria="Premium");
open cur;
while(i<numutenti) do
fetch cur into nm;
set npa=(select count(*) from PropostaAnimale where Nickname=nm);
set npv=(select count(*) from PropostaVegetale where Nickname=nm);
update Utente
set NumeroClassificazioniTotali=npa+npv
where Nickname=nm; 
set numcA=(select count(*) from Utente,PropostaAnimale,ClassificazioneAnimale
where(PropostaAnimale.IDSegnalazione=ClassificazioneAnimale.IDSegnalazione) AND (PropostaAnimale.Classificazione=ClassificazioneAnimale.NomeLatino) AND (Utente.nickname=nm));
set numcV=(select count(*) from Utente,PropostaVegetale,ClassificazioneVegetale
where(PropostaVegetale.IDSegnalazione=ClassificazioneVegetale.IDSegnalazione) AND (PropostaVegetale.Classificazione=ClassificazioneVegetale.NomeLatino) AND (Utente.nickname=nm));
update Utente set NumeroClassificazioniCorrette=numcA+numcV where Nickname=nm;
if((npa+npv)!=0)
then
update Utente set Affidabilita=NumeroClassificazioniCorrette/NumeroClassificazioniTotali where Nickname=nm;
end if;
set i=i+1;
end while;
end |
DELIMITER ;

#Creazione procedura IscrizioneEscursione
DROP PROCEDURE IF EXISTS IscrizioneEscursione;
DELIMITER |
create procedure IscrizioneEscursione(in NicknameIN varchar(200),in IDEscursioneIN int)
begin
  declare numI  int;
  declare numMaxP  int;
  declare c cursor for SELECT count(*) FROM Iscrizione WHERE (IDEscursione=IDEscursioneIN);
  declare c2 cursor for SELECT NumeroMaxPartecipanti FROM Escursione WHERE (ID=IDEscursioneIN);
  #declare exit handler for not found
  open c;
  fetch c into numI;
  close c;
  open c2;
  fetch c2 into numMaxP;
  close c2;
  if(numI<numMaxP)then
    start transaction;
    insert into Iscrizione (Nickname,IDEscursione) VALUES (NicknameIN,IDEscursioneIN);
    commit work;
  end if;
end |
DELIMITER ;

#Creazione procedura CreaCampagna
DROP PROCEDURE IF EXISTS CreaCampagna;
DELIMITER |
create procedure CreaCampagna(in NicknameCreatoreIN varchar(200),in DataInizioIN date,in ImportoFinaleIN int,in DescrizioneIN varchar(200))
begin
start transaction; 
  insert into Campagna (NicknameCreatore,DataInizio,ImportoFinale,Descrizione) VALUES (NicknameCreatoreIN,DataInizioIN,ImportoFinaleIN,DescrizioneIN);
  commit work;
end|
DELIMITER ;