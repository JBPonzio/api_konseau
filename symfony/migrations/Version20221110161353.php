<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221110161353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX idx_f993f0a284980833');
        $this->addSql('ALTER TABLE consommation RENAME COLUMN csm_foyer_id TO foyer_id');
        $this->addSql('ALTER TABLE consommation ADD CONSTRAINT FK_F993F0A22B919A58 FOREIGN KEY (foyer_id) REFERENCES foyer (foy_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F993F0A22B919A58 ON consommation (foyer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE consommation DROP CONSTRAINT FK_F993F0A22B919A58');
        $this->addSql('DROP INDEX IDX_F993F0A22B919A58');
        $this->addSql('ALTER TABLE consommation RENAME COLUMN foyer_id TO csm_foyer_id');
        $this->addSql('CREATE INDEX idx_f993f0a284980833 ON consommation (csm_foyer_id)');
    }
}
