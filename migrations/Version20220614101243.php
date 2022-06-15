<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614101243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE machine DROP FOREIGN KEY FK_1505DF84A53A8AA');
        $this->addSql('DROP INDEX IDX_1505DF84A53A8AA ON machine');
        $this->addSql('ALTER TABLE machine ADD provider_offer_id INT DEFAULT NULL, DROP provider_id');
        $this->addSql('ALTER TABLE machine ADD CONSTRAINT FK_1505DF841B841A07 FOREIGN KEY (provider_offer_id) REFERENCES provider_offer (id)');
        $this->addSql('CREATE INDEX IDX_1505DF841B841A07 ON machine (provider_offer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE machine DROP FOREIGN KEY FK_1505DF841B841A07');
        $this->addSql('DROP INDEX IDX_1505DF841B841A07 ON machine');
        $this->addSql('ALTER TABLE machine ADD provider_id INT NOT NULL, DROP provider_offer_id');
        $this->addSql('ALTER TABLE machine ADD CONSTRAINT FK_1505DF84A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('CREATE INDEX IDX_1505DF84A53A8AA ON machine (provider_id)');
    }
}
