<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609101251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_A45BDDC176E92A9C ON application');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A45BDDC176E92A9C ON application (port_id)');
        $this->addSql('ALTER TABLE customer CHANGE name entreprise VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_A45BDDC176E92A9C ON application');
        $this->addSql('CREATE INDEX UNIQ_A45BDDC176E92A9C ON application (port_id)');
        $this->addSql('ALTER TABLE customer CHANGE entreprise name VARCHAR(255) NOT NULL');
    }
}
