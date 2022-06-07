<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220531125526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact CHANGE firstname surname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE server CHANGE proc proc VARCHAR(255) NOT NULL, CHANGE debit debit VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact CHANGE surname firstname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE server CHANGE proc proc VARCHAR(255) DEFAULT NULL, CHANGE debit debit VARCHAR(255) DEFAULT NULL');
    }
}
