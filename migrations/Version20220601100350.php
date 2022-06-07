<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601100350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application ADD port_id INT NOT NULL');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC176E92A9C FOREIGN KEY (port_id) REFERENCES port (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A45BDDC176E92A9C ON application (port_id)');
        $this->addSql('DROP INDEX UNIQ_5A6DD5F63E030ACD ON server');
        $this->addSql('ALTER TABLE server CHANGE proc proc VARCHAR(255) NOT NULL, CHANGE debit debit VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A6DD5F63E030ACD ON server (application_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC176E92A9C');
        $this->addSql('DROP INDEX UNIQ_A45BDDC176E92A9C ON application');
        $this->addSql('ALTER TABLE application DROP port_id');
        $this->addSql('DROP INDEX UNIQ_5A6DD5F63E030ACD ON server');
        $this->addSql('ALTER TABLE server CHANGE proc proc VARCHAR(255) DEFAULT NULL, CHANGE debit debit VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE INDEX UNIQ_5A6DD5F63E030ACD ON server (application_id)');
    }
}
