<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261119065750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE athlete_sport (athlete_id INT NOT NULL, sport_id INT NOT NULL, INDEX IDX_1C8EF67FFE6BCB8B (athlete_id), INDEX IDX_1C8EF67FAC78BCF8 (sport_id), PRIMARY KEY (athlete_id, sport_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE athlete_sport ADD CONSTRAINT FK_1C8EF67FFE6BCB8B FOREIGN KEY (athlete_id) REFERENCES athlete (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE athlete_sport ADD CONSTRAINT FK_1C8EF67FAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE athlete ADD profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_C03B8321275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C03B8321275ED078 ON athlete (profil_id)');
        $this->addSql('ALTER TABLE sport ADD famille_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sport ADD CONSTRAINT FK_1A85EFD297A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('CREATE INDEX IDX_1A85EFD297A77B84 ON sport (famille_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE athlete_sport DROP FOREIGN KEY FK_1C8EF67FFE6BCB8B');
        $this->addSql('ALTER TABLE athlete_sport DROP FOREIGN KEY FK_1C8EF67FAC78BCF8');
        $this->addSql('DROP TABLE athlete_sport');
        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_C03B8321275ED078');
        $this->addSql('DROP INDEX UNIQ_C03B8321275ED078 ON athlete');
        $this->addSql('ALTER TABLE athlete DROP profil_id');
        $this->addSql('ALTER TABLE sport DROP FOREIGN KEY FK_1A85EFD297A77B84');
        $this->addSql('DROP INDEX IDX_1A85EFD297A77B84 ON sport');
        $this->addSql('ALTER TABLE sport DROP famille_id');
    }
}
