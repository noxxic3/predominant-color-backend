# [Technical test] Image predominant color (Backend)

Backend part of a small full-stack project that allows uploading an image file, calculating its predominant color, 
and displaying the color closest to it from a given color palette, using the 
<a href="https://github.com/thephpleague/color-extractor" target="_blank">color-extractor</a> library in the backend.

## Project Set Up

* Install dependencies
```
composer install
```

* Create the `.env` file
```
cp .env.example .env
```

* Generate an app encryption key in the `.env` file
```
php artisan key:generate
```
