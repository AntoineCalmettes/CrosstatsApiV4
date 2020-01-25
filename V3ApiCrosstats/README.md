1. ce mettre a la racine du projet 
2. dans le bash
3. Installer composer : (MAC) https://duvien.com/blog/installing-composer-mac-osx
4. Composer install
5. Composer update 
6. Aller dans le .env
7.a rentrer a la ligne 29 les informations de sa bdd 
7.b changer db_user / db password db_name
Exemple : #DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
8. php bin/console doctrine:database:create
9.a php bin/console doctrine:migrations:migrate
9.b yes
10.php bin/console doctrine:fixtures:load
11 .Si c'est la premiere fois que tu clone le pojet : 
11.1 crée un dossier jwt dans config
 tape cette commande dans le bash : 
 11.2 openssl genrsa -out config/jwt/private.pem -aes256 4096
 11.2.1 passphrase: admin
11.3 openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
11.3.1 admin
symfony serve
