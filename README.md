# cross

## Spis treści

1. [Aplikacja](#aplikacja)
2. [Środowisko developerskie](#środowisko-developerskie)
    1. [Stos technologiczny](#1-stos-technologiczny)
    2. [Wymagania](#2-wymagania)
    3. [Instalacja i uruchomienie — krok po kroku](#3-instalacja-i-uruchomienie--krok-po-kroku)
        - [3.1. Klonowanie repozytorium](#31-klonowanie-repozytorium)
        - [3.2. Uruchomienie środowiska](#32-uruchomienie-środowiska)
        - [3.3. Konfiguracja Git i klucze SSH](#33-konfiguracja-git-i-klucze-ssh)
        - [3.4. Instalacja zależności i konfiguracja aplikacji](#34-instalacja-zależności-i-konfiguracja-aplikacji)
        - [3.3.4. Rozwiązywanie problemów z błędem push w VS Code](#334-rozwiązywanie-problemów-z-błędem-push-w-vs-code)
    4. [Często używane komendy Laravel](#4-często-używane-komendy-laravel)
    5. [Przydatne komendy Docker](#5-przydatne-komendy-docker)
    6. [Baza danych i narzędzia](#6-baza-danych-i-narzędzia)
    7. [Dev Container w Visual Studio Code](#7-dev-container-w-visual-studio-code)
    8. [Rozwiązywanie problemów (FAQ)](#8-rozwiązywanie-problemów-faq)
    9. [Struktura katalogów](#9-struktura-katalogów)

---

# APLIKACJA

**cross** to aplikacja przeznaczona dla firm windykacyjnych, wspierająca kompleksowe zarządzanie wierzytelnościami.  
System umożliwia automatyzację procesów związanych z obsługą spraw, monitorowaniem płatności, komunikacją z dłużnikami oraz raportowaniem działań.  
Projekt rozwijany jest w oparciu o framework **Laravel**, zapewniając wysoką skalowalność i możliwość łatwej integracji z systemami zewnętrznymi.

---

# ŚRODOWISKO DEVELOPERSKIE

## 1. Stos technologiczny

| Kontener / Alias                   | Usługa / Cel                     | Port(y)            | Dostęp przez przeglądarkę                                          | Dane logowania / Uwagi                         |
| ---------------------------------- | -------------------------------- | ------------------ | ------------------------------------------------------------------ | ---------------------------------------------- |
| **cross_app**                      | Laravel (PHP-FPM + Nginx)        | 8181:80, 5173:5173 | [http://localhost:8181](http://localhost:8181) – aplikacja Laravel | login: `admin@cross.com`, hasło: `password`    |
| **cross_admin** _(alias logiczny)_ | Panel administracyjny (Filament) | —                  | [http://localhost:8181/admin](http://localhost:8181/admin)         | login: `admin@cross.com`, hasło: `password`    |
| **cross_postgres**                 | Baza danych PostgreSQL           | 5432:5432          | —                                                                  | login: `cross`, hasło: `password`, db: `cross` |
| **cross_redis**                    | Redis (cache, kolejki, sesje)    | 6379:6379          | —                                                                  | login: `cross`, hasło: `password`              |
| **cross_mailpit**                  | SMTP + podgląd e-maili           | 8025:8025          | [http://localhost:8025](http://localhost:8025)                     | Brak logowania                                 |
| **cross_pgadmin**                  | GUI do PostgreSQL                | 5050:5050          | [http://localhost:5050](http://localhost:5050)                     | email: `admin@cross.com`, hasło: `password`    |
| **cross_redisinsight**             | GUI do Redisa                    | 8081:8081          | [http://localhost:8081](http://localhost:8081)                     | Brak logowania                                 |
| **cross_elasticsearch**            | Elasticsearch                    | 9200:9200          | —                                                                  | login: `elastic`, hasło: `password`            |
| **cross_kibana**                   | GUI do Elasticsearch             | 5601:5601          | [http://localhost:5601](http://localhost:5601)                     | Brak logowania                                 |

---

## 2. Wymagania

-   Windows 10/11, macOS lub Linux.
-   Zainstalowany **Docker Desktop** lub Docker + Docker Compose.
-   **Visual Studio Code** (zalecane) z rozszerzeniem _Dev Containers_.
-   Konto GitHub.

---

## 3. Instalacja i uruchomienie — krok po kroku

Poniżej oznaczenia kontekstów wykonywania komend:

-   **[HOST]** – komendy uruchamiane w terminalu systemowym (poza kontenerami).
-   **[APP]** – komendy uruchamiane wewnątrz kontenera `cross_app`.  
    _(Można je wydawać bezpośrednio z terminala w Visual Studio Code po wejściu do Dev Containera.)_
-   **[POSTGRES]**, **[REDIS]**, **[KIBANA]**, **[PGADMIN]**, **[MAILPIT]**, **[REDISINSIGHT]** – komendy dla konkretnych kontenerów.

Wejście do kontenerów (skróty do najczęstszych):

```bash
# [HOST]
docker exec -it cross_app bash         # [APP] – aplikacja Laravel
docker exec -it cross_postgres bash    # [POSTGRES] – baza danych
docker exec -it cross_redis bash       # [REDIS] – cache/kolejki
docker exec -it cross_kibana bash      # [KIBANA] – GUI do Elasticsearch
docker exec -it cross_pgadmin bash     # [PGADMIN] – panel PostgreSQL
docker exec -it cross_mailpit bash     # [MAILPIT] – testowy SMTP
docker exec -it cross_redisinsight bash # [REDISINSIGHT] – GUI Redis
```

### 3.1. Klonowanie repozytorium

```bash
# [HOST]
git clone git@github.com:lprzybylskidev/cross.git
cd cross
```

### 3.2. Uruchomienie środowiska

```bash
# [HOST]
docker compose up -d --build
docker compose ps
```

### 3.3. Konfiguracja Git i klucze SSH

Na tym etapie zalecane jest wykonywanie komend **[APP]** z terminala w Visual Studio Code.  
Aby połączyć się z Dev Containerem:

1. Otwórz folder projektu `cross` w VS Code.
2. Jeśli pojawi się komunikat „Reopen in Container?” — wybierz **Reopen in Container**.
3. Jeśli komunikat się nie pojawi: naciśnij **F1**, wpisz „Dev Containers: Reopen in Container” i potwierdź Enterem.
4. Po połączeniu z Dev Containerem możesz wykonywać wszystkie komendy oznaczone jako **[APP]** z terminala w Visual Studio Code.

#### 3.3.1. Generowanie klucza SSH

```bash
# [APP]
ssh-keygen -t ed25519 -C "twoj_email@domena.com"
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_ed25519
echo ""
echo "=================== TO SKOPIUJ I WYŚLIJ ADMINISTRATOROWI ==================="
cat ~/.ssh/id_ed25519.pub
echo "==========================================================================="
echo ""
```

#### 3.3.2. Konfiguracja Git użytkownika

```bash
# [APP]
git config --global user.name "Imię Nazwisko"
git config --global user.email "twoj_email@domena.com"
```

#### 3.3.3. Ustawienie repozytorium zdalnego

```bash
# [APP]
git remote set-url origin git@github.com:lprzybylskidev/cross.git
```

#### 3.3.4. Rozwiązywanie problemów z błędem push w VS Code

Jeżeli podczas próby **push z poziomu VS Code** pojawia się komunikat:

> You don't have permission to push to lprzybylskidev/cross

lub w logu:

> Permission to lprzybylskidev/cross.git denied to lprzybylskidev93

oznacza to, że VS Code forwarduje **SSH-agenta z hosta**, a nie korzysta z klucza SSH wygenerowanego w kontenerze.

Rozwiązanie:

```bash
# [APP]
unset SSH_AUTH_SOCK
git config --global core.sshCommand "ssh -i ~/.ssh/id_ed25519 -o IdentitiesOnly=yes -o IdentityAgent=none"
ssh -T git@github.com
```

✅ Poprawny wynik:

```
Hi {your_name}! You've successfully authenticated, but GitHub does not provide shell access.
```

### 3.4. Instalacja zależności i konfiguracja aplikacji

```bash
# [APP]
composer install
cp .env.example .env
php artisan key:generate
npm ci || npm install
php artisan migrate --seed
npm run dev
```

---

## 4. Często używane komendy Laravel

```bash
# [APP]
php artisan config:clear        # Czyści cache konfiguracji
php artisan cache:clear         # Czyści cache aplikacji
php artisan route:clear         # Czyści cache tras
php artisan view:clear          # Czyści cache widoków
php artisan optimize:clear      # Czyści wszystkie cache Laravela
php artisan migrate             # Uruchamia migracje bazy danych
php artisan migrate:fresh       # Czyści i ponownie uruchamia migracje
php artisan db:seed             # Uruchamia seedy danych testowych
php artisan queue:work          # Uruchamia przetwarzanie kolejki
php artisan schedule:run        # Wykonuje zaplanowane zadania
php artisan storage:link        # Tworzy symlink do storage/public
php artisan route:list          # Wyświetla listę tras
php artisan tinker              # Otwiera interaktywną konsolę aplikacji
```

---

## 5. Przydatne komendy Docker

### 5.1. Informacje i logi

```bash
# [HOST]
docker ps
docker compose ps
docker logs cross_app
docker logs -f cross_app
docker compose logs -f
```

### 5.2. Uruchamianie i zatrzymywanie

```bash
# [HOST]
docker compose up -d
docker compose up -d --build
docker compose down
docker compose down -v
docker restart cross_app
```

### 5.3. Kopiowanie plików

```bash
# [HOST]
docker cp cross_app:/var/www/storage/logs/laravel.log ./laravel.log
docker cp ./localfile.txt cross_app:/var/www/localfile.txt
```

### 5.4. Czyszczenie i porządkowanie

```bash
# [HOST]
docker system prune
docker system prune -a
docker volume ls
docker volume rm <nazwa>
```

---

## 6. Baza danych i narzędzia

### 6.1. PostgreSQL

```bash
# [POSTGRES]
psql -U cross -d cross
```

```bash
# [HOST]
psql -h localhost -p 5432 -U cross -d cross
```

### 6.2. Redis

```bash
# [REDIS]
redis-cli ping
```

---

## 7. Dev Container w Visual Studio Code

Najważniejsze polecenia dostępne spod **F1** (paleta poleceń VS Code):

-   **Dev Containers: Reopen in Container** – ponowne otwarcie projektu w Dev Containerze.
-   **Dev Containers: Rebuild and Reopen in Container** – przebudowanie środowiska i ponowne otwarcie projektu w kontenerze.
-   **Dev Containers: Rebuild Container** – przebudowanie kontenera bez ponownego otwierania projektu.
-   **Dev Containers: Open Folder in Container...** – ręczne wybranie folderu, który ma być otwarty w kontenerze.
-   **Dev Containers: Reopen Folder Locally** – wyjście z Dev Containera i otwarcie projektu lokalnie.
-   **Dev Containers: Close Remote Connection** – zamknięcie aktywnego połączenia z kontenerem.
-   **Dev Containers: Show Container Log** – wyświetlenie logów uruchamiania kontenera (przydatne w diagnostyce).

---

## 8. Rozwiązywanie problemów (FAQ)

### Błąd: „Brak pliku vendor/autoload.php”

```bash
# [APP]
composer install
```

### Błąd: „APP_KEY is missing”

```bash
# [APP]
php artisan key:generate
```

### Błąd: „Connection refused” przy bazie danych

```bash
# [HOST]
docker compose ps
```

```bash
# [APP]
php artisan migrate
```

---

## 9. Struktura katalogów

```
cross/
 ├─ docker/                 # Konfiguracje kontenerów (Dockerfile, ustawienia)
 ├─ .devcontainer/          # Konfiguracja Dev Container dla VS Code
 ├─ docker-compose.yml      # Główny plik orkiestracji Docker Compose
 ├─ app/                    # Kod źródłowy aplikacji Laravel
 ├─ bootstrap/              # Pliki startowe frameworka
 ├─ config/                 # Konfiguracje aplikacji
 ├─ database/               # Migracje, seedy i fabryki danych
 ├─ public/                 # Katalog publiczny serwera (index.php, assets)
 ├─ resources/              # Widoki Blade, pliki JS/CSS, komponenty Vite
 ├─ routes/                 # Definicje tras HTTP
 ├─ storage/                # Logi, cache, pliki użytkowników
 ├─ tests/                  # Testy jednostkowe i integracyjne
 ├─ composer.json           # Zależności PHP
 ├─ package.json            # Zależności JS
 └─ README.md               # Dokumentacja projektu
```
