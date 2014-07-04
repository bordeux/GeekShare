
GeekShare
=====================================


Authors: Krzysztof Bednarczyk, Radomir Janerka, Grzegorz Pyka, Rafał Gnutek


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

Aktorzy systemu biznesowego
---------------------------
System można podzielić na dwie odrębne aplikacje:
* Frontend (klient)
* Backend (server)

W aplikacji backendowej głównym celem jest przechowywanie danych. Pozwala na przetrzymywanie plików na serwerze, autoryzowany dostęp do nich, poprzez swój login i hasło , a takze zewnętrzny dostęp do pliku, poprzez klucz Token.

Natomiast w aplikacji frotnedowej głównym celem jest odpowiednia prezentacja tych danych u klienta, jak i tez zbudowanie prostego i odpowiedniego interfejsu dla użytkownika

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









































