# 🚀 Cross App (Laravel Project)

## 🧭 Spis treści

-   [Opis aplikacji (PL)](#-opis-aplikacji-pl)
-   [Środowisko developerskie (PL)](#️-środowisko-developerskie-pl)
-   [Przydatne komendy (PL)](#-przydatne-komendy-pl)
-   [Tech Stack](#-tech-stack)

---

## 📌 Opis aplikacji (PL)

_Tutaj w przyszłości dodasz opis działania aplikacji, jej funkcjonalności, architekturę, diagramy itp._

---

## ⚙️ Środowisko developerskie (PL)

### 🧱 Wymagania wstępne

-   Docker Desktop (Windows/Mac) lub Docker + Docker Compose (Linux)
-   Visual Studio Code + rozszerzenie **Dev Containers**
-   Klucz SSH dla GitHub (generowany **wewnątrz kontenera**)

---

### 🧩 Instalacja krok po kroku

1️⃣ **Sklonuj repozytorium**

```bash
git clone git@github.com:twoje-repo/cross.git
cd cross
```

2️⃣ **Uruchom kontenery**

```bash
docker compose up -d --build
```

3️⃣ **Wejdź do kontenera aplikacji**

```bash
docker exec -it cross_app bash
```

4️⃣ **Skonfiguruj GIT**

```bash
git config --global user.name "Twoje Imię"
git config --global user.email "twojemail@domena.com"
```

5️⃣ **Wygeneruj nowy klucz SSH i dodaj do GitHub**

```bash
ssh-keygen -t ed25519 -C "admin@cross.com"
cat ~/.ssh/id_ed25519.pub
```

6️⃣ **Skonfiguruj Laravel i bazę**

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate:fresh --seed
```

7️⃣ **Uruchom frontend (Vite)**

```bash
npm install
npm run dev
```

---

### 🔐 Logowanie / Dostępy

| Usługa                               | URL                                                                | Dane logowania             |
| ------------------------------------ | ------------------------------------------------------------------ | -------------------------- |
| **Aplikacja (Laravel)**              | [http://localhost:8181](http://localhost:8181)                     | admin@cross.com / password |
| **Panel administracyjny (Filament)** | [http://localhost:8181/admin](http://localhost:8181/admin)         | admin@cross.com / password |
| **Laravel Telescope**                | [http://localhost:8181/telescope](http://localhost:8181/telescope) | —                          |
| **Vite Dev Server**                  | [http://localhost:5173](http://localhost:5173)                     | —                          |
| **Mailpit (SMTP/UI)**                | [http://localhost:8025](http://localhost:8025)                     | SMTP: `localhost:1025`     |
| **RedisInsight**                     | [http://localhost:5540](http://localhost:5540)                     | —                          |
| **pgAdmin**                          | [http://localhost:5050](http://localhost:5050)                     | admin@cross.com / password |
| **Kibana**                           | [http://localhost:5601](http://localhost:5601)                     | —                          |
| **Elasticsearch**                    | [http://localhost:9200](http://localhost:9200)                     | —                          |

---

## 🧰 Przydatne komendy (PL)

### Wejście do kontenerów

```bash
# Aplikacja Laravel (PHP)
docker exec -it cross_app bash

# Baza danych PostgreSQL
docker exec -it cross_postgres bash

# Redis
docker exec -it cross_redis bash

# RedisInsight
docker exec -it cross_redisinsight bash

# Mailpit
docker exec -it cross_mailpit bash

# Elasticsearch
docker exec -it cross_elasticsearch bash

# Kibana
docker exec -it cross_kibana bash

# pgAdmin
docker exec -it cross_pgadmin bash
```

### Ogólne komendy Dockera

```bash
# Lista działających kontenerów
docker ps

# Ładna tabelka z nazwami, statusem i portami
docker ps --format "table {{.Names}}	{{.Status}}	{{.Ports}}"

# Restart wszystkich kontenerów
docker compose restart

# Zatrzymanie środowiska
docker compose down

# Zatrzymanie i usunięcie kontenerów oraz wolumenów
docker compose down -v

# Przebudowa środowiska od zera
docker compose up -d --build

# Sprawdzenie logów kontenera
docker logs -f cross_app

# Sprawdzenie zdrowia kontenerów
docker inspect --format='{{json .State.Health}}' cross_app | jq

# Usunięcie nieużywanych obrazów i wolumenów
docker system prune -af
```

### Komendy Laravel

```bash
php artisan optimize:clear
php artisan migrate:fresh --seed
php artisan tinker
php artisan queue:work
```

---

### 🔧 Debugowanie (Telescope / Debugbar)

W pliku `.env` możesz włączać lub wyłączać narzędzia debugujące:

```dotenv
TELESCOPE_ENABLED=false
DEBUGBAR_ENABLED=true
```

-   `TELESCOPE_ENABLED` — włącza/wyłącza Laravel Telescope
-   `DEBUGBAR_ENABLED` — włącza/wyłącza Laravel Debugbar

---

## 🧩 Tech Stack

| Technologia                     | Opis                                        |
| ------------------------------- | ------------------------------------------- |
| 🐳 **Docker + Docker Compose**  | Konteneryzacja całego środowiska            |
| ⚙️ **Laravel 12 (PHP 8.3)**     | Framework backendowy                        |
| 🧰 **Vite + Node 20**           | Bundler frontendowy z HMR                   |
| 🐘 **PostgreSQL 17**            | Relacyjna baza danych                       |
| 🟥 **Redis 7 + RedisInsight**   | Cache i kolejki                             |
| 🔍 **Elasticsearch 8 + Kibana** | Wyszukiwanie pełnotekstowe i analiza danych |
| 📬 **Mailpit**                  | Testowy serwer SMTP z UI                    |
| 📊 **pgAdmin**                  | UI do zarządzania PostgreSQL                |
| 🧑‍💻 **Filament Admin**           | Panel administracyjny dla Laravel           |
| 🧠 **Laravel Telescope**        | Debugowanie i profilowanie aplikacji        |
