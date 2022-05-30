<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530130349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, server_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_7D3656A41844E6B7 (server_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, main TINYINT(1) NOT NULL, tel VARCHAR(255) DEFAULT NULL, INDEX IDX_4C62E6389395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, server_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD9395C3F3 (customer_id), UNIQUE INDEX UNIQ_D34A04AD1844E6B7 (server_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ram (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server (id INT AUTO_INCREMENT NOT NULL, ram_id INT NOT NULL, stockage_id INT NOT NULL, proc VARCHAR(255) NOT NULL, debit VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_5A6DD5F63366068 (ram_id), INDEX IDX_5A6DD5F6DAA83D7F (stockage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stockage (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A41844E6B7 FOREIGN KEY (server_id) REFERENCES server (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6389395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id)');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F63366068 FOREIGN KEY (ram_id) REFERENCES ram (id)');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F6DAA83D7F FOREIGN KEY (stockage_id) REFERENCES stockage (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6389395C3F3');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD9395C3F3');
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F63366068');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A41844E6B7');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD1844E6B7');
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F6DAA83D7F');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE ram');
        $this->addSql('DROP TABLE server');
        $this->addSql('DROP TABLE stockage');
    }
}
