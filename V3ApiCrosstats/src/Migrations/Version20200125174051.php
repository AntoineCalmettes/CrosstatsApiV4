<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200125174051 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_box_id (id INT AUTO_INCREMENT NOT NULL, box_id_id INT DEFAULT NULL, user_id_id INT DEFAULT NULL, INDEX IDX_BD45600266E42BF (box_id_id), INDEX IDX_BD4560029D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE box (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, certifate TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_box_id ADD CONSTRAINT FK_BD45600266E42BF FOREIGN KEY (box_id_id) REFERENCES box (id)');
        $this->addSql('ALTER TABLE user_box_id ADD CONSTRAINT FK_BD4560029D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_box_id DROP FOREIGN KEY FK_BD45600266E42BF');
        $this->addSql('DROP TABLE user_box_id');
        $this->addSql('DROP TABLE box');
    }
}
