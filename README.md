# DTC245200087 - Website Portfolio Ca Nhan

## Gioi thieu
Website portfolio ca nhan voi trang admin quan ly noi dung, tich hop day du he thong giam sat theo yeu cau mon hoc.

- Sinh vien: DTC245200087
- Mon hoc: Trien khai va quan tri he thong phan mem
- De tai: De 13 - Website Portfolio / Gioi thieu Ca Nhan

## Cong nghe su dung
- PHP 8.1 + Apache
- MySQL 8.0 + phpMyAdmin
- Nginx (reverse proxy + HTTPS tu ky + security headers)
- Prometheus + Grafana + Loki + Promtail
- Docker + Docker Compose
- Git + GitHub

## Cau truc thu muc
- docker-compose.yml   - Cau hinh Docker Compose
- Dockerfile.webapp    - Dockerfile cho PHP webapp
- README.md            - Tai lieu du an
- src/                 - Ma nguon PHP
  - index.php          - Trang portfolio cong khai
  - admin.php          - Trang quan tri
  - db.php             - Ket noi MySQL
  - style.css          - Giao dien
- nginx/               - Cau hinh Nginx
  - default.conf       - Reverse proxy + HTTPS + security headers
  - certs/             - Chung chi SSL tu ky
- prometheus/          - Cau hinh Prometheus
- loki-promtail/       - Cau hinh Loki & Promtail

## Cach chay
docker compose up -d

## Truy cap
- Portfolio: https://localhost
- Admin: https://localhost/admin.php
- phpMyAdmin: http://localhost:8082
- Prometheus: http://localhost:9090
- Grafana: http://localhost:3000

## Tai khoan Database
- Root: root / rootpassword
- User: portfolio_user / userpassword
- Database: portfolio_db

## Yeu cau da hoan thanh
1. Quan ly ma nguon + cau hinh tren GitHub, co README
2. Trien khai web + MySQL + phpMyAdmin
3. Nginx reverse proxy + HTTPS tu ky + Security Headers
