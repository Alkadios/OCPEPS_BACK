<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220217092616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere ADD CONSTRAINT FK_7F6A805315AF06D8 FOREIGN KEY (apsa_retenu_id) REFERENCES apsaretenu (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575F9E44187 FOREIGN KEY (indicateur_critere_id) REFERENCES indicateurcritere (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1323A575A6CC7B2F9E4418765FC32AE ON evaluation (eleve_id, indicateur_critere_id, date_eval)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere DROP FOREIGN KEY FK_7F6A805315AF06D8');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575F9E44187');
        $this->addSql('DROP INDEX UNIQ_1323A575A6CC7B2F9E4418765FC32AE ON evaluation');
    }
}
