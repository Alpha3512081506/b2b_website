<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114133710 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE show_category (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE purchase CHANGE total total INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD ragione_sociale VARCHAR(255) NOT NULL, ADD partita_iva VARCHAR(255) NOT NULL, ADD via VARCHAR(255) NOT NULL, ADD citta VARCHAR(255) NOT NULL, ADD cap VARCHAR(255) NOT NULL, ADD referente VARCHAR(255) NOT NULL, ADD telefono VARCHAR(255) NOT NULL, ADD codice_univoco VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE show_category');
        $this->addSql('ALTER TABLE purchase CHANGE total total VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user DROP ragione_sociale, DROP partita_iva, DROP via, DROP citta, DROP cap, DROP referente, DROP telefono, DROP codice_univoco');
    }
}
