<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210914154229 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recipe_ingredient');
        $this->addSql('ALTER TABLE ingredient_quantity_in_recipe DROP FOREIGN KEY FK_C5B6D5B6F0EB6E04');
        $this->addSql('ALTER TABLE ingredient_quantity_in_recipe DROP FOREIGN KEY FK_C5B6D5B6F47D9B14');
        $this->addSql('DROP INDEX IDX_C5B6D5B6F47D9B14 ON ingredient_quantity_in_recipe');
        $this->addSql('DROP INDEX IDX_C5B6D5B6F0EB6E04 ON ingredient_quantity_in_recipe');
        $this->addSql('ALTER TABLE ingredient_quantity_in_recipe ADD recipe_id INT NOT NULL, ADD ingredient_id INT NOT NULL, DROP recipe_grams_id, DROP ingredient_grams_id');
        $this->addSql('ALTER TABLE ingredient_quantity_in_recipe ADD CONSTRAINT FK_C5B6D5B659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE ingredient_quantity_in_recipe ADD CONSTRAINT FK_C5B6D5B6933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('CREATE INDEX IDX_C5B6D5B659D8A214 ON ingredient_quantity_in_recipe (recipe_id)');
        $this->addSql('CREATE INDEX IDX_C5B6D5B6933FE08C ON ingredient_quantity_in_recipe (ingredient_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_ingredient (recipe_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_22D1FE1359D8A214 (recipe_id), INDEX IDX_22D1FE13933FE08C (ingredient_id), PRIMARY KEY(recipe_id, ingredient_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_quantity_in_recipe DROP FOREIGN KEY FK_C5B6D5B659D8A214');
        $this->addSql('ALTER TABLE ingredient_quantity_in_recipe DROP FOREIGN KEY FK_C5B6D5B6933FE08C');
        $this->addSql('DROP INDEX IDX_C5B6D5B659D8A214 ON ingredient_quantity_in_recipe');
        $this->addSql('DROP INDEX IDX_C5B6D5B6933FE08C ON ingredient_quantity_in_recipe');
        $this->addSql('ALTER TABLE ingredient_quantity_in_recipe ADD recipe_grams_id INT NOT NULL, ADD ingredient_grams_id INT NOT NULL, DROP recipe_id, DROP ingredient_id');
        $this->addSql('ALTER TABLE ingredient_quantity_in_recipe ADD CONSTRAINT FK_C5B6D5B6F0EB6E04 FOREIGN KEY (recipe_grams_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE ingredient_quantity_in_recipe ADD CONSTRAINT FK_C5B6D5B6F47D9B14 FOREIGN KEY (ingredient_grams_id) REFERENCES ingredient (id)');
        $this->addSql('CREATE INDEX IDX_C5B6D5B6F47D9B14 ON ingredient_quantity_in_recipe (ingredient_grams_id)');
        $this->addSql('CREATE INDEX IDX_C5B6D5B6F0EB6E04 ON ingredient_quantity_in_recipe (recipe_grams_id)');
    }
}
