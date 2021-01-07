<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201221130444 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nome_categoria VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, nome_cliente VARCHAR(255) NOT NULL, cognome_cliente VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, eta INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE imaggine (id INT AUTO_INCREMENT NOT NULL, caption LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordine_cliente (id INT AUTO_INCREMENT NOT NULL, nome_cliente VARCHAR(255) NOT NULL, data_di_acquisto DATETIME NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prodotto (id INT AUTO_INCREMENT NOT NULL, nome_stile VARCHAR(255) NOT NULL, marca VARCHAR(255) NOT NULL, modello_cpu VARCHAR(255) NOT NULL, dimensioni_ram VARCHAR(255) NOT NULL, colore VARCHAR(255) NOT NULL, dimensioni_schermo VARCHAR(255) NOT NULL, commento LONGTEXT NOT NULL, prezzo DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utenti (id INT AUTO_INCREMENT NOT NULL, nome_utente VARCHAR(255) NOT NULL, cognome_utente VARCHAR(255) NOT NULL, indirizzo_email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE imaggine');
        $this->addSql('DROP TABLE ordine_cliente');
        $this->addSql('DROP TABLE prodotto');
        $this->addSql('DROP TABLE utenti');
    }
}
