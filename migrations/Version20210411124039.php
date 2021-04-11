<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210411124039 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient CHANGE carbohydrate carbohydrate NUMERIC(5, 2) NOT NULL, CHANGE fat fat NUMERIC(5, 2) NOT NULL, CHANGE protein protein NUMERIC(5, 2) NOT NULL, CHANGE sugar sugar NUMERIC(5, 2) NOT NULL, CHANGE energy energy NUMERIC(5, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient CHANGE carbohydrate carbohydrate INT NOT NULL, CHANGE fat fat INT NOT NULL, CHANGE protein protein INT NOT NULL, CHANGE sugar sugar INT NOT NULL, CHANGE energy energy INT NOT NULL');
    }
}
