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


php bin/console doctrine:fixtures:load
symfony serve
