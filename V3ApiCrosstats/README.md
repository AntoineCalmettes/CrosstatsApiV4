1. ce mettre a la racine du projet 
2. dans le bash
3. Composer install
4. Composer update 
5. Aller dans le .env
5.a rentrer a la ligne 29 les informations de sa bdd 
5.b changer db_user / db password db_name
Exemple : #DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
6. php bin/console doctrine:database:create
7.a php bin/console doctrine:migrations:migrate
7.b yes

composer req --dev make doctrine/doctrine-fixtures-bundle
8.php bin/console doctrine:fixtures:load

9 .Si c'est la premiere fois que tu clone le pojet : 
9.1 crée un dossier jwt dans config
 tape cette commande dans le bash : 
 9.2 openssl genrsa -out config/jwt/private.pem -aes256 4096
 9.2.1 passphrase: admin
9.3 openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
9.3.1 admin
symfony serve
