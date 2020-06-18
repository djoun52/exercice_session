<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617150012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modules (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, programme_id INT DEFAULT NULL, nom_module VARCHAR(255) NOT NULL, INDEX IDX_2EB743D7BCF5E72D (categorie_id), INDEX IDX_2EB743D762BB7AEE (programme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme (id INT AUTO_INCREMENT NOT NULL, nb_jour INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, programme_id INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, date_de_debut DATE NOT NULL, date_de_fin DATE NOT NULL, nb_place_theorique INT NOT NULL, INDEX IDX_D044D5D462BB7AEE (programme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, sex VARCHAR(50) NOT NULL, date_de_naissance DATE NOT NULL, ville VARCHAR(50) NOT NULL, telephone VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modules ADD CONSTRAINT FK_2EB743D7BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE modules ADD CONSTRAINT FK_2EB743D762BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D462BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modules DROP FOREIGN KEY FK_2EB743D7BCF5E72D');
        $this->addSql('ALTER TABLE modules DROP FOREIGN KEY FK_2EB743D762BB7AEE');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D462BB7AEE');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE modules');
        $this->addSql('DROP TABLE programme');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE user');
    }
}
