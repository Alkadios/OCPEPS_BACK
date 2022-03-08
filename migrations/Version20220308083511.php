<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308083511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apsa_champ_apprentissage (apsa_id INT NOT NULL, champ_apprentissage_id INT NOT NULL, INDEX IDX_7605776D1F6783B5 (apsa_id), INDEX IDX_7605776D58FC6EC8 (champ_apprentissage_id), PRIMARY KEY(apsa_id, champ_apprentissage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apsa_champ_apprentissage ADD CONSTRAINT FK_7605776D1F6783B5 FOREIGN KEY (apsa_id) REFERENCES apsa (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apsa_champ_apprentissage ADD CONSTRAINT FK_7605776D58FC6EC8 FOREIGN KEY (champ_apprentissage_id) REFERENCES champ_apprentissage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apsa DROP FOREIGN KEY FK_C8885CD158FC6EC8');
        $this->addSql('DROP INDEX IDX_C8885CD158FC6EC8 ON apsa');
        $this->addSql('ALTER TABLE apsa DROP champ_apprentissage_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE apsa_champ_apprentissage');
        $this->addSql('ALTER TABLE apsa ADD champ_apprentissage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apsa ADD CONSTRAINT FK_C8885CD158FC6EC8 FOREIGN KEY (champ_apprentissage_id) REFERENCES champ_apprentissage (id)');
        $this->addSql('CREATE INDEX IDX_C8885CD158FC6EC8 ON apsa (champ_apprentissage_id)');
    }
}
