# DTC245200087 - Website Portfolio Ca Nhan

## Gioi thieu

Website portfolio ca nhan voi trang admin quan ly noi dung, tich hop day du he thong giam sat theo yeu cau mon hoc.

- **Sinh vien:** Nguyen Thi Thuy Hien
- **MSSV:** DTC245200087
- **Mon hoc:** Trien khai va quan tri he thong phan mem
- **De tai:** De 13 - Website Portfolio / Gioi thieu Ca Nhan
- **Lop:** CNTT K23H
- **GVHD:** Le Khanh Duong

## Cong nghe su dung

- PHP 8.1 + Apache
- MySQL 8.0 + phpMyAdmin
- Nginx (reverse proxy + HTTPS tu ky + security headers)
- Prometheus + Grafana + Loki + Promtail
- Docker + Docker Compose
- Git + GitHub

## Cau truc thu muc

    DTC245200087_portfolio/
    |-- docker-compose.yml        # Cau hinh Docker Compose
    |-- Dockerfile.webapp         # Dockerfile cho PHP webapp
    |-- README.md                 # Tai lieu du an
    |-- src/                      # Ma nguon PHP
    |   |-- index.php             # Trang portfolio cong khai
    |   |-- admin.php             # Trang quan tri
    |   |-- cv.php                # Trang CV chi tiet
    |   |-- db.php                # Ket noi MySQL
    |   +-- style.css             # Giao dien
    |-- nginx/
    |   |-- default.conf          # Reverse proxy + HTTPS + security headers
    |   +-- certs/                # Chung chi SSL tu ky
    |-- prometheus/
    |   +-- prometheus.yml
    |-- loki-promtail/
    |   |-- loki-config.yml
    |   +-- promtail-config.yml
    +-- grafana/
        +-- provisioning/
            +-- datasources/

## Cau truc he thong

    Nguoi dung (Browser)
           | HTTPS (443)
           v
    +----------------------+
    |  portfolio_nginx     |  Reverse proxy + HTTPS + Security Headers
    +----------+-----------+
               | HTTP (8080) - frontend_net
               v
    +----------------------+
    |  portfolio_webapp    |  PHP 8.1 + Apache (user www-data, non-root)
    +----------+-----------+
               | MySQL (3306) - backend_net (internal)
               v
    +----------------------+
    |  portfolio_db        |  MySQL 8.0 - database: portfolio_db
    +----------+-----------+
               ^
               |
    +----------------------+
    |  portfolio_pma       |  phpMyAdmin (cong 8085)
    +----------------------+

**He thong giam sat (chay song song):**

- Prometheus (9090) - thu thap metrics
- Grafana (3000) - dashboard Portfolio Monitoring
- Loki (3100) + Promtail - log tap trung
- cAdvisor, Node Exporter, MySQL Exporter, Alertmanager

## Cach chay

Buoc 1 - Clone repo:

    git clone https://github.com/dtc245200087-star/DTC245200087_portfolio.git
    cd DTC245200087_portfolio

Buoc 2 - Khoi dong he thong:

    docker compose up -d

Buoc 3 - Bat them Loki + Promtail:

    docker start loki promtail

Buoc 4 - Kiem tra container:

    docker ps

## Truy cap

| Dich vu | URL | Tai khoan |
|---|---|---|
| Portfolio | https://localhost | - |
| Admin | https://localhost/admin.php | - |
| CV | https://localhost/cv.php | - |
| phpMyAdmin | http://localhost:8085 | portfolio_user / P0rtf0li0_User_2026 |
| Prometheus | http://localhost:9090 | - |
| Grafana | http://localhost:3000 | admin / admin |
| Loki API | http://localhost:3100 | - |

## Tai khoan Database

| Tai khoan | Mat khau | Quyen |
|---|---|---|
| root | R00t@Portf0li0_2026 | Full |
| portfolio_user | P0rtf0li0_User_2026 | User |

- Database: portfolio_db
- Bang: profile, projects, cv_details

## Yeu cau da hoan thanh

- [x] **YC1:** Quan ly ma nguon + cau hinh tren GitHub, co README
- [x] **YC2:** Trien khai web + MySQL + phpMyAdmin
- [x] **YC3:** Nginx reverse proxy + HTTPS tu ky + Security Headers
- [x] **YC4:** Prometheus + Grafana giam sat container, web server, database
- [x] **YC5:** Loki + Promtail, truy van LogQL (3 query)
- [x] **YC6:** Hardening (non-root, cap_drop, network isolation, mat khau manh)
- [x] **Bonus:** Tinh nang CV ca nhan

## Bien phap Hardening

| Bien phap | Cach trien khai |
|---|---|
| Non-root container | Webapp chay user www-data (UID 33) |
| Cap drop | cap_drop: ALL |
| No privilege escalation | security_opt: no-new-privileges:true |
| Network isolation | backend_net la internal: true |
| Mat khau manh | R00t@Portf0li0_2026, P0rtf0li0_User_2026 |
| Security Headers | X-Frame-Options, X-XSS-Protection, X-Content-Type-Options, Referrer-Policy |
| Read-only mounts | Nginx config + certs mount :ro |
| Tmpfs | /tmp, /var/cache/nginx, /var/run |

## Minh chung LogQL

Query 1 - Log webapp:

    {container="portfolio_webapp"}

Query 2 - Log nginx:

    {container="portfolio_nginx"}

Query 3 - Loc log co keyword:

    {container="portfolio_webapp"} |= "admin.php"

## Lien he

- **Email:** dtc245200087@ictu.edu.vn
- **GitHub:** https://github.com/dtc245200087-star
- **Repository:** https://github.com/dtc245200087-star/DTC245200087_portfolio
