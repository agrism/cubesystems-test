### Cube systems test

#### 1. Get up containers:
```bash
docker-compose up
```

#### 2. Get in webserver container:
```bash
docker exec -it {container-name} bash
```

#### 3. In container execute commands:
```bash
cp .env.example .env
composer install
php artisan key:generate
npm install
npm run build
```

#### 4. Service bindings you can find in:
```php
App\Providers\AppServiceProvider::boot()
```

#### 5. Demo:

https://www.cube-systems.kilograms.lv/
