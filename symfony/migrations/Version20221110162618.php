<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221110162618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE consommation_csm_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE foyer_foy_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE consommation (csm_id INT NOT NULL, foyer_id INT NOT NULL, csm_litres INT NOT NULL, csm_date DATE NOT NULL, PRIMARY KEY(csm_id))');
        $this->addSql('CREATE INDEX IDX_F993F0A22B919A58 ON consommation (foyer_id)');
        $this->addSql('CREATE TABLE foyer (foy_id INT NOT NULL, foy_nb_personnes INT NOT NULL, PRIMARY KEY(foy_id))');
        $this->addSql('ALTER TABLE consommation ADD CONSTRAINT FK_F993F0A22B919A58 FOREIGN KEY (foyer_id) REFERENCES foyer (foy_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE consommation_csm_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE foyer_foy_id_seq CASCADE');
        $this->addSql('ALTER TABLE consommation DROP CONSTRAINT FK_F993F0A22B919A58');
        $this->addSql('DROP TABLE consommation');
        $this->addSql('DROP TABLE foyer');
    }
}
