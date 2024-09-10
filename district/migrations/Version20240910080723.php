<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910080723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634AA14E1C8');
        $this->addSql('DROP INDEX IDX_497DD634AA14E1C8 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP plats_id');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DBB1A0722');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D82EA2E54');
        $this->addSql('DROP INDEX IDX_6EEAA67D82EA2E54 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DBB1A0722 ON commande');
        $this->addSql('ALTER TABLE commande ADD utilisateur_id INT DEFAULT NULL, DROP details_id, DROP commande_id');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DFB88E14F ON commande (utilisateur_id)');
        $this->addSql('ALTER TABLE detail ADD commande_id INT DEFAULT NULL, ADD plat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F9382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
        $this->addSql('CREATE INDEX IDX_2E067F9382EA2E54 ON detail (commande_id)');
        $this->addSql('CREATE INDEX IDX_2E067F93D73DB560 ON detail (plat_id)');
        $this->addSql('ALTER TABLE plat ADD detail_id INT DEFAULT NULL, ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207D8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_2038A207D8D003BB ON plat (detail_id)');
        $this->addSql('CREATE INDEX IDX_2038A207BCF5E72D ON plat (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFB88E14F');
        $this->addSql('DROP INDEX IDX_6EEAA67DFB88E14F ON commande');
        $this->addSql('ALTER TABLE commande ADD commande_id INT DEFAULT NULL, CHANGE utilisateur_id details_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DBB1A0722 FOREIGN KEY (details_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D82EA2E54 ON commande (commande_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DBB1A0722 ON commande (details_id)');
        $this->addSql('ALTER TABLE categorie ADD plats_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634AA14E1C8 FOREIGN KEY (plats_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_497DD634AA14E1C8 ON categorie (plats_id)');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F9382EA2E54');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93D73DB560');
        $this->addSql('DROP INDEX IDX_2E067F9382EA2E54 ON detail');
        $this->addSql('DROP INDEX IDX_2E067F93D73DB560 ON detail');
        $this->addSql('ALTER TABLE detail DROP commande_id, DROP plat_id');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207D8D003BB');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207BCF5E72D');
        $this->addSql('DROP INDEX IDX_2038A207D8D003BB ON plat');
        $this->addSql('DROP INDEX IDX_2038A207BCF5E72D ON plat');
        $this->addSql('ALTER TABLE plat DROP detail_id, DROP categorie_id');
    }
}
