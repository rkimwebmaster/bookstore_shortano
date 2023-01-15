<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113225218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat ADD COLUMN trans_id VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__achat AS SELECT id, user_id, livre_id, adresse_livraison_id, mobile_money_id, date, etat, is_livre, quantite, montant_total FROM achat');
        $this->addSql('DROP TABLE achat');
        $this->addSql('CREATE TABLE achat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, livre_id INTEGER NOT NULL, adresse_livraison_id INTEGER NOT NULL, mobile_money_id INTEGER NOT NULL, date DATE NOT NULL, etat VARCHAR(255) NOT NULL, is_livre BOOLEAN NOT NULL, quantite INTEGER NOT NULL, montant_total DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_26A98456A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_26A9845637D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_26A98456BE2F0A35 FOREIGN KEY (adresse_livraison_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_26A98456721E9F72 FOREIGN KEY (mobile_money_id) REFERENCES mobile_money (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO achat (id, user_id, livre_id, adresse_livraison_id, mobile_money_id, date, etat, is_livre, quantite, montant_total) SELECT id, user_id, livre_id, adresse_livraison_id, mobile_money_id, date, etat, is_livre, quantite, montant_total FROM __temp__achat');
        $this->addSql('DROP TABLE __temp__achat');
        $this->addSql('CREATE INDEX IDX_26A98456A76ED395 ON achat (user_id)');
        $this->addSql('CREATE INDEX IDX_26A9845637D925CB ON achat (livre_id)');
        $this->addSql('CREATE INDEX IDX_26A98456BE2F0A35 ON achat (adresse_livraison_id)');
        $this->addSql('CREATE INDEX IDX_26A98456721E9F72 ON achat (mobile_money_id)');
    }
}
