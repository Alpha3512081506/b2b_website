<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201221152432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prodotto ADD categoria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prodotto ADD CONSTRAINT FK_8176041B3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('CREATE INDEX IDX_8176041B3397707A ON prodotto (categoria_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prodotto DROP FOREIGN KEY FK_8176041B3397707A');
        $this->addSql('DROP INDEX IDX_8176041B3397707A ON prodotto');
        $this->addSql('ALTER TABLE prodotto DROP categoria_id');
    }
}
