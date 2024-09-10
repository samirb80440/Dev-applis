<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240909093433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, plats_id INT DEFAULT NULL, libelle VARCHAR(50) NOT NULL, image VARCHAR(50) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_497DD634AA14E1C8 (plats_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, details_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, date_commande DATE NOT NULL, total NUMERIC(6, 2) NOT NULL, etat INT NOT NULL, INDEX IDX_6EEAA67DBB1A0722 (details_id), INDEX IDX_6EEAA67D82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail (id INT AUTO_INCREMENT NOT NULL, detail_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_2E067F93D8D003BB (detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat (id INT AUTO_INCREMENT NOT NULL, plat_id INT DEFAULT NULL, libelle VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, prix NUMERIC(6, 2) NOT NULL, image VARCHAR(50) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_2038A207D73DB560 (plat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, telephone VARCHAR(20) NOT NULL, adress VARCHAR(50) NOT NULL, cp VARCHAR(20) NOT NULL, ville VARCHAR(50) NOT NULL, roles VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634AA14E1C8 FOREIGN KEY (plats_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DBB1A0722 FOREIGN KEY (details_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93D8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634AA14E1C8');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DBB1A0722');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D82EA2E54');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93D8D003BB');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207D73DB560');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE detail');
        $this->addSql('DROP TABLE plat');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
