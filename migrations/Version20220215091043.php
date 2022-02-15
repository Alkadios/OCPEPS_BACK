<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220215091043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE af (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE af_retenu (id INT AUTO_INCREMENT NOT NULL, choix_annee_id INT DEFAULT NULL, af_id INT DEFAULT NULL, INDEX IDX_86018467DC1D090 (choix_annee_id), INDEX IDX_8601846E53D1D1D (af_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annee (id INT AUTO_INCREMENT NOT NULL, anne DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apsa (id INT AUTO_INCREMENT NOT NULL, ca_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_C8885CD122A76C4 (ca_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apsa_retenu (id INT AUTO_INCREMENT NOT NULL, apsa_id INT DEFAULT NULL, af_retenu_id INT DEFAULT NULL, INDEX IDX_6A0E128A1F6783B5 (apsa_id), INDEX IDX_6A0E128ADDFFCD4B (af_retenu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ca (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE choix_annee (id INT AUTO_INCREMENT NOT NULL, niveau_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, ca_id INT DEFAULT NULL, INDEX IDX_1610E608B3E9C81 (niveau_id), INDEX IDX_1610E608543EC5F0 (annee_id), INDEX IDX_1610E60822A76C4 (ca_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, cycle_id INT DEFAULT NULL, libelle_classe VARCHAR(255) NOT NULL, INDEX IDX_8F87BF965EC1162 (cycle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, professeur_id INT DEFAULT NULL, installation_sportive_id INT DEFAULT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, INDEX IDX_FDCA8C9CBAB22EE9 (professeur_id), INDEX IDX_FDCA8C9C93BABF94 (installation_sportive_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere (id INT AUTO_INCREMENT NOT NULL, apsa_retenu_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_7F6A805315AF06D8 (apsa_retenu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cycle (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, mail_parent1 VARCHAR(255) NOT NULL, mail_parent2 VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, sexe_eleve VARCHAR(255) NOT NULL, INDEX IDX_ECA105F7FB88E14F (utilisateur_id), INDEX IDX_ECA105F78F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, eleve_id INT DEFAULT NULL, indicateur_critere_id INT DEFAULT NULL, date_eval DATE NOT NULL, INDEX IDX_1323A575A6CC7B2 (eleve_id), INDEX IDX_1323A575F9E44187 (indicateur_critere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE indicateur (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE indicateur_critere (id INT AUTO_INCREMENT NOT NULL, critere_id INT DEFAULT NULL, indicateur_id INT DEFAULT NULL, INDEX IDX_160D11F49E5F45AB (critere_id), INDEX IDX_160D11F4DA3B8F3D (indicateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE installation_sportive (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_scolaire (id INT AUTO_INCREMENT NOT NULL, cycle_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_58816785EC1162 (cycle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, INDEX IDX_17A55299FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, roles_id INT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, telephone VARCHAR(10) NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), INDEX IDX_1D1C63B338C751C4 (roles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE af_retenu ADD CONSTRAINT FK_86018467DC1D090 FOREIGN KEY (choix_annee_id) REFERENCES choix_annee (id)');
        $this->addSql('ALTER TABLE af_retenu ADD CONSTRAINT FK_8601846E53D1D1D FOREIGN KEY (af_id) REFERENCES af (id)');
        $this->addSql('ALTER TABLE apsa ADD CONSTRAINT FK_C8885CD122A76C4 FOREIGN KEY (ca_id) REFERENCES ca (id)');
        $this->addSql('ALTER TABLE apsa_retenu ADD CONSTRAINT FK_6A0E128A1F6783B5 FOREIGN KEY (apsa_id) REFERENCES apsa (id)');
        $this->addSql('ALTER TABLE apsa_retenu ADD CONSTRAINT FK_6A0E128ADDFFCD4B FOREIGN KEY (af_retenu_id) REFERENCES af_retenu (id)');
        $this->addSql('ALTER TABLE choix_annee ADD CONSTRAINT FK_1610E608B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau_scolaire (id)');
        $this->addSql('ALTER TABLE choix_annee ADD CONSTRAINT FK_1610E608543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE choix_annee ADD CONSTRAINT FK_1610E60822A76C4 FOREIGN KEY (ca_id) REFERENCES ca (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF965EC1162 FOREIGN KEY (cycle_id) REFERENCES cycle (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C93BABF94 FOREIGN KEY (installation_sportive_id) REFERENCES installation_sportive (id)');
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A805315AF06D8 FOREIGN KEY (apsa_retenu_id) REFERENCES apsa_retenu (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575F9E44187 FOREIGN KEY (indicateur_critere_id) REFERENCES indicateur_critere (id)');
        $this->addSql('ALTER TABLE indicateur_critere ADD CONSTRAINT FK_160D11F49E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id)');
        $this->addSql('ALTER TABLE indicateur_critere ADD CONSTRAINT FK_160D11F4DA3B8F3D FOREIGN KEY (indicateur_id) REFERENCES indicateur (id)');
        $this->addSql('ALTER TABLE niveau_scolaire ADD CONSTRAINT FK_58816785EC1162 FOREIGN KEY (cycle_id) REFERENCES cycle (id)');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B338C751C4 FOREIGN KEY (roles_id) REFERENCES role (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE af_retenu DROP FOREIGN KEY FK_8601846E53D1D1D');
        $this->addSql('ALTER TABLE apsa_retenu DROP FOREIGN KEY FK_6A0E128ADDFFCD4B');
        $this->addSql('ALTER TABLE choix_annee DROP FOREIGN KEY FK_1610E608543EC5F0');
        $this->addSql('ALTER TABLE apsa_retenu DROP FOREIGN KEY FK_6A0E128A1F6783B5');
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A805315AF06D8');
        $this->addSql('ALTER TABLE apsa DROP FOREIGN KEY FK_C8885CD122A76C4');
        $this->addSql('ALTER TABLE choix_annee DROP FOREIGN KEY FK_1610E60822A76C4');
        $this->addSql('ALTER TABLE af_retenu DROP FOREIGN KEY FK_86018467DC1D090');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('ALTER TABLE indicateur_critere DROP FOREIGN KEY FK_160D11F49E5F45AB');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF965EC1162');
        $this->addSql('ALTER TABLE niveau_scolaire DROP FOREIGN KEY FK_58816785EC1162');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575A6CC7B2');
        $this->addSql('ALTER TABLE indicateur_critere DROP FOREIGN KEY FK_160D11F4DA3B8F3D');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575F9E44187');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C93BABF94');
        $this->addSql('ALTER TABLE choix_annee DROP FOREIGN KEY FK_1610E608B3E9C81');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CBAB22EE9');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B338C751C4');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7FB88E14F');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299FB88E14F');
        $this->addSql('DROP TABLE af');
        $this->addSql('DROP TABLE af_retenu');
        $this->addSql('DROP TABLE annee');
        $this->addSql('DROP TABLE apsa');
        $this->addSql('DROP TABLE apsa_retenu');
        $this->addSql('DROP TABLE ca');
        $this->addSql('DROP TABLE choix_annee');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE critere');
        $this->addSql('DROP TABLE cycle');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE indicateur');
        $this->addSql('DROP TABLE indicateur_critere');
        $this->addSql('DROP TABLE installation_sportive');
        $this->addSql('DROP TABLE niveau_scolaire');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE utilisateur');
    }
}
