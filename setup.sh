cp infra/web/vhost.conf.localhost infra/web/vhost.conf
cp certs/fullchain.pem.local  certs/fullchain.pem
cp certs/privkey.pem.local certs/privkey.pem
cp .env.example .env


docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed

