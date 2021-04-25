<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210425122653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, user_meal_id INT DEFAULT NULL, type INT NOT NULL, date DATETIME DEFAULT NULL, INDEX IDX_9EF68E9C3B9B78DC (user_meal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_ingredient (meal_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_FCC3CEFA639666D6 (meal_id), INDEX IDX_FCC3CEFA933FE08C (ingredient_id), PRIMARY KEY(meal_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_recipe (meal_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_B5820C3E639666D6 (meal_id), INDEX IDX_B5820C3E59D8A214 (recipe_id), PRIMARY KEY(meal_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C3B9B78DC FOREIGN KEY (user_meal_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFA639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFA933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_recipe ADD CONSTRAINT FK_B5820C3E639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_recipe ADD CONSTRAINT FK_B5820C3E59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meal_ingredient DROP FOREIGN KEY FK_FCC3CEFA639666D6');
        $this->addSql('ALTER TABLE meal_recipe DROP FOREIGN KEY FK_B5820C3E639666D6');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE meal_ingredient');
        $this->addSql('DROP TABLE meal_recipe');
    }
}
