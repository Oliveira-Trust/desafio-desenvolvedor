# CHALLENGE

Docker tutorial

https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose-pt


Copy environment example file
```
cp .env.example .env
```

Run docker (-d flag for daemon)
```
docker-compose up -d
```

Create Databse User
```
docker-compose exec db bash
```

```
mysql -u root -p
```

```
GRANT ALL ON challenge.* TO 'challengeuser'@'%' IDENTIFIED BY 'CHALLENGE20201';
```

Running migrations and seeds
```
docker-compose exec app php artisan migrate --seed
```

The app will be hosted on http://localhost:8080
