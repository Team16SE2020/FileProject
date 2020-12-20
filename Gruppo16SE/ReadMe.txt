——————————————————READ ME——————————————————

Per utilizzare la web app sul proprio dispositivo:

1)Modificare i permessi utente secondo il proprio utente dal data base, aprendolo e sotto la voce “GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO “  modificare postgres con proprio nome utente.
N.B. il database scelto per lo sviluppo è postgres perciò si consiglia l’uso di tale per eseguire le operazioni inerenti al database.

2) Cambiare le credenziali di accesso al database all’interno del file “logindb.php” presente al seguente percorso file: Gruppo16SE\logUser\logindb.php.

3) Per effettuare un login ed usare tutte le funzionalità per cui la figura professionale è abilitata: 

- Per System administrator: usare credenziali di accesso per tale ruolo (per esempio Codice identificativo= 	10102311 , pin=12344). Cliccare sul pulsante a lui dedicato e inserire la password= 12344.

- Per Repository Manager: usare credenziali di accesso per tale ruolo (per esempio Codice identificativo= 	67457913 , pin=43098). Cliccare sul pulsante a lui dedicato e inserire la password= 12346. 

- Per Planner : usare credenziali di accesso per tale ruolo (per esempio Codice identificativo= 	2343112332132 , pin=23431). Cliccare sul pulsante a lui dedicato e inserire la password= 12345.

- Per Maintainer : usare credenziali di accesso per tale ruolo (per esempio Codice identificativo= 	10997700 , pin=66756). Cliccare sul pulsante a lui dedicato e inserire la password= 1492.
N.B.: Per poter visualizzare i compiti del maintainer devi loggarti con il maintainer a cui sono assegnati tali compiti.



Per condurre i test: 

1) Utilizzare phpStorm con phpUnit. Modificare il percorso file all’interno di “loginTest.php” e “ModuloSignTest” indicando il path completo dei file da testare (”login.php “ e “ModuloSign.php”).

N.B.: Prima di condurre i test con phpstorm è necessario configurare un esecutore e phpUnit scaricando il file phar dal sito ufficiale. E’ inoltre necessario impostare il file phpUnit.xml nelle impostazioni di phpstorm.

