<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613142814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application CHANGE machine_id machine_id INT NOT NULL, CHANGE product_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE machine ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE machine ADD CONSTRAINT FK_1505DF844584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_1505DF844584665A ON machine (product_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF6B75B26');
        $this->addSql('DROP INDEX IDX_D34A04ADF6B75B26 ON product');
        $this->addSql('ALTER TABLE product DROP machine_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application CHANGE machine_id machine_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE machine DROP FOREIGN KEY FK_1505DF844584665A');
        $this->addSql('DROP INDEX IDX_1505DF844584665A ON machine');
        $this->addSql('ALTER TABLE machine DROP product_id');
        $this->addSql('ALTER TABLE product ADD machine_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADF6B75B26 ON product (machine_id)');
    }
}
