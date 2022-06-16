## Installation
- Clone Project
    ```
    git clone https://github.com/Luthfi98/api-article.git
    ```
- Buat Database di mysql dengan nama database article
- Masuk Ke folder api-article
    ```
    cd api-article
    ```
- Copy .env.example
    ```
    cp .env.example .env
    ```
- setting database di file .env <br>
	DB_DATABASE=article <br>
	DB_USERNAME=root(sesuai dengan settingan phpmyadmin di pc)<br>
	DB_PASSWORD=root(sesuai dengan settingan phpmyadmin di pc) <br>
- Download Vendor
    ```
    composer install
    ```
- Genereate App_KEY
    ```
    php artisan key:generate
    ```
- Create table posts dan insert data dummy
    ```
    php artisan migrate --seed
    ```
- Jalankan aplikasi
    ```
    php artisan serve
    ```


## Request
[Dokumentasi](https://documenter.getpostman.com/view/10945541/UzBiQUhp)

- Get All Data
    ```
    GET
    http://127.0.0.1:8000/api/article
    ```
- Get Data By ID
    ```
    GET
    http://127.0.0.1:8000/api/article/1
    ```
- Insert Data
    ```
    POST
    http://127.0.0.1:8000/api/article
    ```
- Update Data
    ```
    POST
    http://127.0.0.1:8000/api/article/1
    ```
- Delete Data
    ```
    DELETE
    http://127.0.0.1:8000/api/article/1
    ```
