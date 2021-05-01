<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428181944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type INT NOT NULL, quantity INT DEFAULT NULL, carbohydrate NUMERIC(10, 2) NOT NULL, fat NUMERIC(10, 2) NOT NULL, protein NUMERIC(10, 2) NOT NULL, sugar NUMERIC(10, 2) NOT NULL, energy NUMERIC(10, 2) NOT NULL, created_by VARCHAR(255) DEFAULT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, user_meal_id INT DEFAULT NULL, type INT NOT NULL, date DATETIME DEFAULT NULL, INDEX IDX_9EF68E9C3B9B78DC (user_meal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_ingredient (meal_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_FCC3CEFA639666D6 (meal_id), INDEX IDX_FCC3CEFA933FE08C (ingredient_id), PRIMARY KEY(meal_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_recipe (meal_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_B5820C3E639666D6 (meal_id), INDEX IDX_B5820C3E59D8A214 (recipe_id), PRIMARY KEY(meal_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, filename VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_ingredient (recipe_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_22D1FE1359D8A214 (recipe_id), INDEX IDX_22D1FE13933FE08C (ingredient_id), PRIMARY KEY(recipe_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, plan_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, weight INT NOT NULL, height INT NOT NULL, age INT NOT NULL, gender INT NOT NULL, activity INT NOT NULL, brm INT NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649E899029B (plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C3B9B78DC FOREIGN KEY (user_meal_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFA639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFA933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_recipe ADD CONSTRAINT FK_B5820C3E639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_recipe ADD CONSTRAINT FK_B5820C3E59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E899029B FOREIGN KEY (plan_id) REFERENCES plan (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meal_ingredient DROP FOREIGN KEY FK_FCC3CEFA933FE08C');
        $this->addSql('ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE13933FE08C');
        $this->addSql('ALTER TABLE meal_ingredient DROP FOREIGN KEY FK_FCC3CEFA639666D6');
        $this->addSql('ALTER TABLE meal_recipe DROP FOREIGN KEY FK_B5820C3E639666D6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E899029B');
        $this->addSql('ALTER TABLE meal_recipe DROP FOREIGN KEY FK_B5820C3E59D8A214');
        $this->addSql('ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE1359D8A214');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C3B9B78DC');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE meal_ingredient');
        $this->addSql('DROP TABLE meal_recipe');
        $this->addSql('DROP TABLE plan');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_ingredient');
        $this->addSql('DROP TABLE user');
    }
}
