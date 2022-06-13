<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610134604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, machine_id INT DEFAULT NULL, application_id INT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, type INT NOT NULL, db_name VARCHAR(255) DEFAULT NULL, INDEX IDX_7D3656A4F6B75B26 (machine_id), INDEX IDX_7D3656A43E030ACD (application_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, machine_id INT DEFAULT NULL, product_id INT DEFAULT NULL, domain_name VARCHAR(255) NOT NULL, port VARCHAR(255) NOT NULL, INDEX IDX_A45BDDC1F6B75B26 (machine_id), INDEX IDX_A45BDDC14584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(255) DEFAULT NULL, is_main TINYINT(1) NOT NULL, INDEX IDX_4C62E6389395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE machine (id INT AUTO_INCREMENT NOT NULL, provider_id INT NOT NULL, ip VARCHAR(255) NOT NULL, INDEX IDX_1505DF84A53A8AA (provider_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, machine_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D34A04ADF6B75B26 (machine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider_offer (id INT AUTO_INCREMENT NOT NULL, provider_id INT NOT NULL, name VARCHAR(255) NOT NULL, proc VARCHAR(255) DEFAULT NULL, debit VARCHAR(255) DEFAULT NULL, is_server TINYINT(1) NOT NULL, INDEX IDX_7080324AA53A8AA (provider_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider_offer_ram (provider_offer_id INT NOT NULL, ram_id INT NOT NULL, INDEX IDX_127A5B051B841A07 (provider_offer_id), INDEX IDX_127A5B053366068 (ram_id), PRIMARY KEY(provider_offer_id, ram_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider_offer_stockage (provider_offer_id INT NOT NULL, stockage_id INT NOT NULL, INDEX IDX_EB1CCB581B841A07 (provider_offer_id), INDEX IDX_EB1CCB58DAA83D7F (stockage_id), PRIMARY KEY(provider_offer_id, stockage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ram (id INT AUTO_INCREMENT NOT NULL, capacity VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, INDEX IDX_E54BC0059395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_machine (sale_id INT NOT NULL, machine_id INT NOT NULL, INDEX IDX_601B1D164A7E4868 (sale_id), INDEX IDX_601B1D16F6B75B26 (machine_id), PRIMARY KEY(sale_id, machine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_application (sale_id INT NOT NULL, application_id INT NOT NULL, INDEX IDX_D5170CAC4A7E4868 (sale_id), INDEX IDX_D5170CAC3E030ACD (application_id), PRIMARY KEY(sale_id, application_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stockage (id INT AUTO_INCREMENT NOT NULL, capacity VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A43E030ACD FOREIGN KEY (application_id) REFERENCES application (id)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC14584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6389395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE machine ADD CONSTRAINT FK_1505DF84A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('ALTER TABLE provider_offer ADD CONSTRAINT FK_7080324AA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE provider_offer_ram ADD CONSTRAINT FK_127A5B051B841A07 FOREIGN KEY (provider_offer_id) REFERENCES provider_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_offer_ram ADD CONSTRAINT FK_127A5B053366068 FOREIGN KEY (ram_id) REFERENCES ram (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_offer_stockage ADD CONSTRAINT FK_EB1CCB581B841A07 FOREIGN KEY (provider_offer_id) REFERENCES provider_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_offer_stockage ADD CONSTRAINT FK_EB1CCB58DAA83D7F FOREIGN KEY (stockage_id) REFERENCES stockage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC0059395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE sale_machine ADD CONSTRAINT FK_601B1D164A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sale_machine ADD CONSTRAINT FK_601B1D16F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sale_application ADD CONSTRAINT FK_D5170CAC4A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sale_application ADD CONSTRAINT FK_D5170CAC3E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A43E030ACD');
        $this->addSql('ALTER TABLE sale_application DROP FOREIGN KEY FK_D5170CAC3E030ACD');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6389395C3F3');
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC0059395C3F3');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4F6B75B26');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1F6B75B26');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF6B75B26');
        $this->addSql('ALTER TABLE sale_machine DROP FOREIGN KEY FK_601B1D16F6B75B26');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC14584665A');
        $this->addSql('ALTER TABLE machine DROP FOREIGN KEY FK_1505DF84A53A8AA');
        $this->addSql('ALTER TABLE provider_offer DROP FOREIGN KEY FK_7080324AA53A8AA');
        $this->addSql('ALTER TABLE provider_offer_ram DROP FOREIGN KEY FK_127A5B051B841A07');
        $this->addSql('ALTER TABLE provider_offer_stockage DROP FOREIGN KEY FK_EB1CCB581B841A07');
        $this->addSql('ALTER TABLE provider_offer_ram DROP FOREIGN KEY FK_127A5B053366068');
        $this->addSql('ALTER TABLE sale_machine DROP FOREIGN KEY FK_601B1D164A7E4868');
        $this->addSql('ALTER TABLE sale_application DROP FOREIGN KEY FK_D5170CAC4A7E4868');
        $this->addSql('ALTER TABLE provider_offer_stockage DROP FOREIGN KEY FK_EB1CCB58DAA83D7F');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE machine');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP TABLE provider_offer');
        $this->addSql('DROP TABLE provider_offer_ram');
        $this->addSql('DROP TABLE provider_offer_stockage');
        $this->addSql('DROP TABLE ram');
        $this->addSql('DROP TABLE sale');
        $this->addSql('DROP TABLE sale_machine');
        $this->addSql('DROP TABLE sale_application');
        $this->addSql('DROP TABLE stockage');
    }
}
