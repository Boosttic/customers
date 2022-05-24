<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524081115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6389395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_4C62E6389395C3F3 ON contact (customer_id)');
        $this->addSql('ALTER TABLE product ADD customer_id INT DEFAULT NULL, ADD server_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD9395C3F3 ON product (customer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD1844E6B7 ON product (server_id)');
        $this->addSql('ALTER TABLE server ADD ram_id INT NOT NULL, ADD stockage_id INT NOT NULL');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F63366068 FOREIGN KEY (ram_id) REFERENCES ram (id)');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F6DAA83D7F FOREIGN KEY (stockage_id) REFERENCES stockage (id)');
        $this->addSql('CREATE INDEX IDX_5A6DD5F63366068 ON server (ram_id)');
        $this->addSql('CREATE INDEX IDX_5A6DD5F6DAA83D7F ON server (stockage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6389395C3F3');
        $this->addSql('DROP INDEX IDX_4C62E6389395C3F3 ON contact');
        $this->addSql('ALTER TABLE contact DROP customer_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD9395C3F3');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD1844E6B7');
        $this->addSql('DROP INDEX IDX_D34A04AD9395C3F3 ON product');
        $this->addSql('DROP INDEX UNIQ_D34A04AD1844E6B7 ON product');
        $this->addSql('ALTER TABLE product DROP customer_id, DROP server_id');
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F63366068');
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F6DAA83D7F');
        $this->addSql('DROP INDEX IDX_5A6DD5F63366068 ON server');
        $this->addSql('DROP INDEX IDX_5A6DD5F6DAA83D7F ON server');
        $this->addSql('ALTER TABLE server DROP ram_id, DROP stockage_id');
    }
}
