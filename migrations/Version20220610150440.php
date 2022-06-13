<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610150440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE provider_offer_ram (provider_offer_id INT NOT NULL, ram_id INT NOT NULL, INDEX IDX_127A5B051B841A07 (provider_offer_id), INDEX IDX_127A5B053366068 (ram_id), PRIMARY KEY(provider_offer_id, ram_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider_offer_stockage (provider_offer_id INT NOT NULL, stockage_id INT NOT NULL, INDEX IDX_EB1CCB581B841A07 (provider_offer_id), INDEX IDX_EB1CCB58DAA83D7F (stockage_id), PRIMARY KEY(provider_offer_id, stockage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_machine (sale_id INT NOT NULL, machine_id INT NOT NULL, INDEX IDX_601B1D164A7E4868 (sale_id), INDEX IDX_601B1D16F6B75B26 (machine_id), PRIMARY KEY(sale_id, machine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_application (sale_id INT NOT NULL, application_id INT NOT NULL, INDEX IDX_D5170CAC4A7E4868 (sale_id), INDEX IDX_D5170CAC3E030ACD (application_id), PRIMARY KEY(sale_id, application_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE provider_offer_ram ADD CONSTRAINT FK_127A5B051B841A07 FOREIGN KEY (provider_offer_id) REFERENCES provider_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_offer_ram ADD CONSTRAINT FK_127A5B053366068 FOREIGN KEY (ram_id) REFERENCES ram (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_offer_stockage ADD CONSTRAINT FK_EB1CCB581B841A07 FOREIGN KEY (provider_offer_id) REFERENCES provider_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_offer_stockage ADD CONSTRAINT FK_EB1CCB58DAA83D7F FOREIGN KEY (stockage_id) REFERENCES stockage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sale_machine ADD CONSTRAINT FK_601B1D164A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sale_machine ADD CONSTRAINT FK_601B1D16F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sale_application ADD CONSTRAINT FK_D5170CAC4A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sale_application ADD CONSTRAINT FK_D5170CAC3E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE provider_offer_ram');
        $this->addSql('DROP TABLE provider_offer_stockage');
        $this->addSql('DROP TABLE sale_machine');
        $this->addSql('DROP TABLE sale_application');
    }
}
