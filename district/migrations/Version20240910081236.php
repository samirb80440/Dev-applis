<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910081236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207D8D003BB');
        $this->addSql('DROP INDEX IDX_2038A207D8D003BB ON plat');
        $this->addSql('ALTER TABLE plat DROP detail_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plat ADD detail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207D8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('CREATE INDEX IDX_2038A207D8D003BB ON plat (detail_id)');
    }
}
