<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308091426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE champs_apprentissage_apsa (id INT AUTO_INCREMENT NOT NULL, apsa_id INT DEFAULT NULL, champ_apprentissage_id INT DEFAULT NULL, INDEX IDX_C48BFC6A1F6783B5 (apsa_id), INDEX IDX_C48BFC6A58FC6EC8 (champ_apprentissage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE champs_apprentissage_apsa ADD CONSTRAINT FK_C48BFC6A1F6783B5 FOREIGN KEY (apsa_id) REFERENCES apsa (id)');
        $this->addSql('ALTER TABLE champs_apprentissage_apsa ADD CONSTRAINT FK_C48BFC6A58FC6EC8 FOREIGN KEY (champ_apprentissage_id) REFERENCES champ_apprentissage (id)');
        $this->addSql('DROP TABLE apsa_retenu');
        $this->addSql('ALTER TABLE apsaretenu CHANGE champ_apprentissage_id af_retenu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apsaretenu ADD CONSTRAINT FK_447ABCA2DDFFCD4B FOREIGN KEY (af_retenu_id) REFERENCES afretenu (id)');
        $this->addSql('CREATE INDEX IDX_447ABCA2DDFFCD4B ON apsaretenu (af_retenu_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_447ABCA21F6783B5DDFFCD4B ON apsaretenu (apsa_id, af_retenu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apsa_retenu (id INT AUTO_INCREMENT NOT NULL, apsa_id INT DEFAULT NULL, af_retenu_id INT DEFAULT NULL, INDEX IDX_6A0E128A1F6783B5 (apsa_id), INDEX IDX_6A0E128ADDFFCD4B (af_retenu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE apsa_retenu ADD CONSTRAINT FK_6A0E128A1F6783B5 FOREIGN KEY (apsa_id) REFERENCES apsa (id)');
        $this->addSql('ALTER TABLE apsa_retenu ADD CONSTRAINT FK_6A0E128ADDFFCD4B FOREIGN KEY (af_retenu_id) REFERENCES afretenu (id)');
        $this->addSql('DROP TABLE champs_apprentissage_apsa');
        $this->addSql('ALTER TABLE apsaretenu DROP FOREIGN KEY FK_447ABCA2DDFFCD4B');
        $this->addSql('DROP INDEX IDX_447ABCA2DDFFCD4B ON apsaretenu');
        $this->addSql('DROP INDEX UNIQ_447ABCA21F6783B5DDFFCD4B ON apsaretenu');
        $this->addSql('ALTER TABLE apsaretenu CHANGE af_retenu_id champ_apprentissage_id INT DEFAULT NULL');
    }
}
