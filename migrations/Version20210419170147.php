<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210419170147 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient CHANGE carbohydrate carbohydrate NUMERIC(10, 2) NOT NULL, CHANGE fat fat NUMERIC(10, 2) NOT NULL, CHANGE protein protein NUMERIC(10, 2) NOT NULL, CHANGE sugar sugar NUMERIC(10, 2) NOT NULL, CHANGE energy energy NUMERIC(10, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE ingredient CHANGE carbohydrate carbohydrate NUMERIC(5, 2) NOT NULL, CHANGE fat fat NUMERIC(5, 2) NOT NULL, CHANGE protein protein NUMERIC(5, 2) NOT NULL, CHANGE sugar sugar NUMERIC(5, 2) NOT NULL, CHANGE energy energy NUMERIC(5, 2) NOT NULL');
    }
}
