## Installation
- git clone https://github.com/Luthfi98/api-article.git
- Buat Database di mysql dengan nama database articles
- cp .env.example .env
- setting database di file .env
	DB_DATABASE=article <br>
	DB_USERNAME=root(sesuai dengan settingan phpmyadmin di pc)<br>
	DB_PASSWORD=root(sesuai dengan settingan phpmyadmin di pc) <br>
- composer install
- php artisan migrate --seed
- php artisan serve
