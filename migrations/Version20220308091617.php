<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308091617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE champsapprentissageapsa (id INT AUTO_INCREMENT NOT NULL, apsa_id INT DEFAULT NULL, champ_apprentissage_id INT DEFAULT NULL, INDEX IDX_3A6F5A6E1F6783B5 (apsa_id), INDEX IDX_3A6F5A6E58FC6EC8 (champ_apprentissage_id), UNIQUE INDEX UNIQ_3A6F5A6E1F6783B558FC6EC8 (apsa_id, champ_apprentissage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE champsapprentissageapsa ADD CONSTRAINT FK_3A6F5A6E1F6783B5 FOREIGN KEY (apsa_id) REFERENCES apsa (id)');
        $this->addSql('ALTER TABLE champsapprentissageapsa ADD CONSTRAINT FK_3A6F5A6E58FC6EC8 FOREIGN KEY (champ_apprentissage_id) REFERENCES champ_apprentissage (id)');
        $this->addSql('DROP TABLE champs_apprentissage_apsa');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE champs_apprentissage_apsa (id INT AUTO_INCREMENT NOT NULL, apsa_id INT DEFAULT NULL, champ_apprentissage_id INT DEFAULT NULL, INDEX IDX_C48BFC6A1F6783B5 (apsa_id), INDEX IDX_C48BFC6A58FC6EC8 (champ_apprentissage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE champs_apprentissage_apsa ADD CONSTRAINT FK_C48BFC6A1F6783B5 FOREIGN KEY (apsa_id) REFERENCES apsa (id)');
        $this->addSql('ALTER TABLE champs_apprentissage_apsa ADD CONSTRAINT FK_C48BFC6A58FC6EC8 FOREIGN KEY (champ_apprentissage_id) REFERENCES champ_apprentissage (id)');
        $this->addSql('DROP TABLE champsapprentissageapsa');
    }
}
