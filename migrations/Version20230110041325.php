<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110041325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, livre_id INTEGER NOT NULL, adresse_livraison_id INTEGER NOT NULL, mobile_money_id INTEGER NOT NULL, date DATE NOT NULL, etat VARCHAR(255) NOT NULL, is_livre BOOLEAN NOT NULL, quantite INTEGER NOT NULL, montant_total DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_26A98456A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_26A9845637D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_26A98456BE2F0A35 FOREIGN KEY (adresse_livraison_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_26A98456721E9F72 FOREIGN KEY (mobile_money_id) REFERENCES mobile_money (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_26A98456A76ED395 ON achat (user_id)');
        $this->addSql('CREATE INDEX IDX_26A9845637D925CB ON achat (livre_id)');
        $this->addSql('CREATE INDEX IDX_26A98456BE2F0A35 ON achat (adresse_livraison_id)');
        $this->addSql('CREATE INDEX IDX_26A98456721E9F72 ON achat (mobile_money_id)');
        $this->addSql('CREATE TABLE adresse (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE auteur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, noms VARCHAR(255) NOT NULL, biographie CLOB NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE autre_livre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, image VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, categorie VARCHAR(16) NOT NULL)');
        $this->addSql('CREATE TABLE chapitre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, livre_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL, description CLOB NOT NULL, CONSTRAINT FK_8C62B02537D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8C62B02537D925CB ON chapitre (livre_id)');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, message CLOB NOT NULL)');
        $this->addSql('CREATE TABLE livre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, sous_titre VARCHAR(255) NOT NULL, date_parution DATE NOT NULL, nombre_copie_vendues INTEGER NOT NULL, nombre_copie_imprimees INTEGER NOT NULL, nombre_tasse_cafes INTEGER NOT NULL, nombre_lecteur_satisfaits INTEGER NOT NULL, image_principale VARCHAR(255) NOT NULL, image_secondaire VARCHAR(255) NOT NULL, apropos CLOB NOT NULL, prix NUMERIC(10, 2) NOT NULL, is_principal_recent BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE mobile_money (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE parametre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, facebook VARCHAR(255) NOT NULL, twitter VARCHAR(255) NOT NULL, instagramme VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, monnaie VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE privacy_page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contenu CLOB NOT NULL)');
        $this->addSql('CREATE TABLE shipment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, pourcentage DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2CB20DC43C3D9C3 ON shipment (ville)');
        $this->addSql('CREATE TABLE temoignage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, adresse_id INTEGER DEFAULT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, nom_complet VARCHAR(255) NOT NULL, CONSTRAINT FK_8D93D6494DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494DE7DC5C ON user (adresse_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE autre_livre');
        $this->addSql('DROP TABLE chapitre');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE mobile_money');
        $this->addSql('DROP TABLE parametre');
        $this->addSql('DROP TABLE privacy_page');
        $this->addSql('DROP TABLE shipment');
        $this->addSql('DROP TABLE temoignage');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
