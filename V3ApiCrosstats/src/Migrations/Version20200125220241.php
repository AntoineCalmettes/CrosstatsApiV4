<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200125220241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE wod_type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO wod_type VALUES(1,"For time")');
        $this->addSql('INSERT INTO wod_type VALUES(2,"Emom")');
        $this->addSql('INSERT INTO wod_type VALUES(3,"Amrap")');
        $this->addSql('INSERT INTO wod_type VALUES(4,"Amrep")');
        $this->addSql('INSERT INTO wod_type VALUES(5,"Max wheight")');
        $this->addSql('INSERT INTO wod_type VALUES(6,"Max distance")');
        $this->addSql('INSERT INTO wod_type VALUES(7,"Intervals")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE wod_type');
    }
}
