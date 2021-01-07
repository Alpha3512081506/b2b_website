<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201222194448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE imaggine ADD produtto_id INT DEFAULT NULL, ADD link_imaggine VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE imaggine ADD CONSTRAINT FK_8F0CD29568965BAD FOREIGN KEY (produtto_id) REFERENCES prodotto (id)');
        $this->addSql('CREATE INDEX IDX_8F0CD29568965BAD ON imaggine (produtto_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE imaggine DROP FOREIGN KEY FK_8F0CD29568965BAD');
        $this->addSql('DROP INDEX IDX_8F0CD29568965BAD ON imaggine');
        $this->addSql('ALTER TABLE imaggine DROP produtto_id, DROP link_imaggine');
    }
}
