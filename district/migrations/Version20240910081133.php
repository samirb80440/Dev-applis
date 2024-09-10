<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910081133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93D8D003BB');
        $this->addSql('DROP INDEX IDX_2E067F93D8D003BB ON detail');
        $this->addSql('ALTER TABLE detail DROP detail_id');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207D73DB560');
        $this->addSql('DROP INDEX IDX_2038A207D73DB560 ON plat');
        $this->addSql('ALTER TABLE plat DROP plat_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail ADD detail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93D8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('CREATE INDEX IDX_2E067F93D8D003BB ON detail (detail_id)');
        $this->addSql('ALTER TABLE plat ADD plat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
        $this->addSql('CREATE INDEX IDX_2038A207D73DB560 ON plat (plat_id)');
    }
}
