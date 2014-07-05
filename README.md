
GeekShare
=====================================


Authors: Krzysztof Bednarczyk, Radomir Janerka, Grzegorz Pyka, Rafał Gnutek

Szybkie linki:
* [Dokumentacja](http://bordeux.github.io/GeekShare/docs/)
* [Demo](http://geekshare.bordeux.net/)


Sreenshots 
-------

![](http://i.imgur.com/fJf9tPn.png)


![](http://i.imgur.com/Dl4h0t0.png)

![](http://i.imgur.com/qLkwY4X.png)

![](http://i.imgur.com/WyufVtX.png)

![](http://i.imgur.com/MjlrbWp.png)


Cel i zakres działania systemu
----------
Celem projektu  jest zbudowanie prostego systemu hostingu plików, opartego na najnowszych technologiach webowych, takich jak
* CSS3
* JavaScript ES5
* AngularJS

Jak i po stronie backendowej:
* PHP 5.5.12
* Symphony 2.5
* MySQL 5.5.34

Głównym wyzwaniem projektu była komunikacja pomiędzy aplikacją a przeglądarką, bez przeładowywania strony, co pozwala na nieprzerwane wysyłanie plików, przechodząc na inne podstrony.

System pozwala na dzielenie się plikami pomiędzi użytkownikami sieci web, bez konieczności nawiązywania transferu pomiędzy adresatem a odbiordzą.

Opis systemu biznesowego
----------
System jest głównie skierowany dla bardziej zaawansowanych użytkowników internetu, którzy posiadają podstawowe informacje na temat funkcjonowania internetu, wraz z podstawową obsługą serwera.

Pozwala na prywatne trzymanie swoich danych w "chmurze", przez co pozwala dostęp do swoich plików z każdej części globu, posiadającą internet. W stosunku do innych usług dostępnych w internecie (dropbox, gdrive, mega.co.nz, rapidshre), podgląd do plików ma tylko administrator serwera, który zainstalował system.


Podział pracy
---------------------
Zespół jest podzielony na 3 sekcje. Frontend, Backend i grafika:

* Grafika: Grzegorz Pyka
* Backend (PHP, MySQL):Radomir Janerka, Rafał Gnutek
* Frontend (JavaScript, AngularJS, CSS, HTML): Krzysztof Bednarczyk

Metodyka pracy, którą wybraliśmy to Programowanie Ekstremalne (eXtreme Programming)

Dlaczego ten system
--------------------------
Sytem jest skierowany dla osób które boją się o swoją prywatność. W stosunku do gotowych usług, takich jak GDrive, Dropbox, pliki są przechowywane na serwerze klienta. On tylko ma dostęp do plików, przez co w pełni ma kontrolę nad prywatnością.

Kolejną zaletą jest nowoczesny design, opierany na dotychczasowych trednach, jakim jest FlatDesign. 

Cały system w porównaniu do innych, oparty jest na braku przeładowywania stron. To umożliwia przesyłanie plików, bez przerywania połączenia.

Limit wielkości plików jest dostosowany do wielkości dysku twardego serwera klienta, w stosunku do innych usług.

I rzecz najważnejsza - system jest w pełni darmowy.



Aktorzy systemu biznesowego
---------------------------
System można podzielić na dwie odrębne aplikacje:
* Frontend (klient)
* Backend (server)

W aplikacji backendowej głównym celem jest przechowywanie danych. Pozwala na przetrzymywanie plików na serwerze, autoryzowany dostęp do nich, poprzez swój login i hasło , a takze zewnętrzny dostęp do pliku, poprzez klucz Token.

Natomiast w aplikacji frotnedowej głównym celem jest odpowiednia prezentacja tych danych u klienta, jak i tez zbudowanie prostego i odpowiedniego interfejsu dla użytkownika


Wymagania
------------------------
* Functional: System skierowany dla firm oraz zwykłych użytkowników, którzy potrzebują trzymać pliki w "chmurze". 
* Usability: System jest dostępny na każde platformy mobilne, które posiadają przeglądarke oraz dostęp do internetu. Pozwala na dostęp do swoich plików z każdego urządzenia. System jest prosty w obsłudze, prosty i przejrzysty interfejs pozwala na korzystanie przez starsze osoby, o nie profesjonalej obsłudze komputera.
Idealne rozwiązanie dla firm, które dbają o bezpieczeństwo swoich danych.
* Reliabity : System jest zależny od wielu innych podprogramów jak MySQL, PHP, Apache. Jeśli te systemy w pełni działają, system jest dostępny w każdej godzinie. 
* Performance : System używa frameworka Symphony, który w testach wykazuje małe zużycie pamięci. W testach benchamrkowych, wydajności systemu, wykazuje że idealnie nadaje się na portale pod dużym obciązeniem. Jako to że aplikacja jest napisana w większości w JavaScripcie, gdzie przeładowywanie strony jest zlikwidowane na korzyść Ajaxa, podwójnie zwiększa wydajność serwera
* Secruity : System jest bezpieczny, nie posiada znanych luk w oprogramowaniu. Jest oparty na walidacje danych. Pliki w nim zawarte są szyfrowane szyfrem AES, przez co ewentualny wyciek danych, nie pozwoli teoretycznie na odczyt plików użytkowników. System jest bezpieczniejszy od innych podobnych serwisów, bo pliki są trzymane u samego klienta.



Lista funkcji realizowanych przez projekt
----------------------------

Basckend:
* utrzymanie połączenia z bazą danych
* autoryzacja użytkowników
* pobieranie potrzebnych informacji z bazy  danych
* zapisywanie przesyłanych plików na serwerze
* kompresja i łaczenie plików frontendowych, by zoptymalizować czas wczytywania strony

Frontend:
* utrzymanie kontaktu z klientem
* odpowiednia prezentacja danych
* dostęp do plików
* proste nardzędzia do zarzadzania plikami
* autoryzacja




Opis zdarzeń aplikacji
-------------------
Uzytkownik:
* logowanie
* rejestracja
* resetowania hasła
* przeglądanie stron typu FAQ, Regulamin
* przeglądanie zawartości folderów
* tworzenie nowych folderów
* usuwanie folderów
* wysyłanie plików
* usuwanie plików
* udostępnianie plików
* zmiana hasła
* wylogowanie

Serwer:
* walidacja danych
* przesyłanie plików
* odbieranie plików i zapisywanie na dysku
* rejestracja zdarzeń
* zapisywanie danych do bazy danych


Struktura klas
-------------------
![Graf](http://bordeux.github.io/GeekShare/docs/graphs/classes.svg)



Struktura wygenerowanej klasy za pomoca Dotcrine
-------------------
![Baza](http://i.imgur.com/4L07ZTd.png)



Diagramy zdarzeń
-----------------------
![Logowanie](http://i.imgur.com/JLodULY.png)

![Rejstracja](http://i.imgur.com/fEcmGbd.png)

![Wysłanie pliku](http://i.imgur.com/r1iBIuM.png)

![Usunięcie pliku](http://i.imgur.com/EtRTzTB.png)

![Utworzenie folderu](http://i.imgur.com/rtYpbEg.png)

![Wyświetlenie strony](http://i.imgur.com/FosVw5r.png)



Diagram stanów
---------------
![Diagram stanów](http://i.imgur.com/xESc0eT.png)


Testy
--------------------

Testy [znajdują się pod tym linkiem](http://bordeux.github.io/GeekShare/testy/)

Instalacja
-------------------

1. Przerzuć pliki na serwer ftp
2. Ustaw chmod dla katalogu 0777 rekrusywnie
3. Ustaw dane do bazy danych w katalogu config/db.config.php
4. Za pomocą shella wejdz w katalog projektu
5. Uruchom komendę 
php app/console doctrine:schema:update --force
































