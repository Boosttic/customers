<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220722094037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE label (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, type INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD label_id INT DEFAULT NULL, DROP is_main');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63833B92F39 FOREIGN KEY (label_id) REFERENCES label (id)');
        $this->addSql('CREATE INDEX IDX_4C62E63833B92F39 ON contact (label_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63833B92F39');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP INDEX IDX_4C62E63833B92F39 ON contact');
        $this->addSql('ALTER TABLE contact ADD is_main TINYINT(1) NOT NULL, DROP label_id');
    }
}
