# FUNKCIONALNOSTI APLIKACIJE
Potrebno je razviti web aplikaciju koja omogućava firmama da efikasno upravljaju svojim zaposlenima, dokumentima i zadacima. Glavna svrha aplikacije je da pruži organizovano i centralizovano rešenje za sve aspekte upravljanja ljudskim resursima i dokumentacijom unutar firme.


# PREUZIMANJE I POKRETANJE
Ova aplikacija se sastoji od dva projekta - laravel projekat i react projekat 

Kako bi aplikacija mogla da radi potrebno je pokrenuti oba projekta 
## Pokretanje Laravel aplikacije

      cd laravelProjekat
      composer install
      cp .env.example .env
      php artisan key:generate
      php artisan migrate --seed
      php artisan serve 
## Pokretanje React aplikacije

      cd reactprojekat
      npm install
      npm start
