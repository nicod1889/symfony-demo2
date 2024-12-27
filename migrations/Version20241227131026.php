<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241227131026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conductor_programa (conductor_id INTEGER NOT NULL, programa_id INTEGER NOT NULL, PRIMARY KEY(conductor_id, programa_id), CONSTRAINT FK_FA046A3A49DECF0 FOREIGN KEY (conductor_id) REFERENCES conductor (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FA046A3FD8A7328 FOREIGN KEY (programa_id) REFERENCES programa (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_FA046A3A49DECF0 ON conductor_programa (conductor_id)');
        $this->addSql('CREATE INDEX IDX_FA046A3FD8A7328 ON conductor_programa (programa_id)');
        $this->addSql('CREATE TABLE probar (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(100) DEFAULT NULL)');
        $this->addSql('CREATE TABLE probar_programa (probar_id INTEGER NOT NULL, programa_id INTEGER NOT NULL, PRIMARY KEY(probar_id, programa_id), CONSTRAINT FK_9EBB0AC13C79F903 FOREIGN KEY (probar_id) REFERENCES probar (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9EBB0AC1FD8A7328 FOREIGN KEY (programa_id) REFERENCES programa (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9EBB0AC13C79F903 ON probar_programa (probar_id)');
        $this->addSql('CREATE INDEX IDX_9EBB0AC1FD8A7328 ON probar_programa (programa_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__columnista AS SELECT apodo, columna, id FROM columnista');
        $this->addSql('DROP TABLE columnista');
        $this->addSql('CREATE TABLE columnista (apodo VARCHAR(50) DEFAULT NULL, columna VARCHAR(50) DEFAULT NULL, id INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_9083851CBF396750 FOREIGN KEY (id) REFERENCES persona2 (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO columnista (apodo, columna, id) SELECT apodo, columna, id FROM __temp__columnista');
        $this->addSql('DROP TABLE __temp__columnista');
        $this->addSql('CREATE TEMPORARY TABLE __temp__conductor AS SELECT cumple, apodo, instagram, twitter, youtube, id FROM conductor');
        $this->addSql('DROP TABLE conductor');
        $this->addSql('CREATE TABLE conductor (cumple DATE DEFAULT NULL, apodo VARCHAR(50) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, id INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_D5F7F18ABF396750 FOREIGN KEY (id) REFERENCES persona2 (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO conductor (cumple, apodo, instagram, twitter, youtube, id) SELECT cumple, apodo, instagram, twitter, youtube, id FROM __temp__conductor');
        $this->addSql('DROP TABLE __temp__conductor');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invitado AS SELECT apodo, rubro, id FROM invitado');
        $this->addSql('DROP TABLE invitado');
        $this->addSql('CREATE TABLE invitado (apodo VARCHAR(50) DEFAULT NULL, rubro VARCHAR(255) DEFAULT NULL, id INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_4982EC17BF396750 FOREIGN KEY (id) REFERENCES persona2 (id) ON UPDATE NO ACTION ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invitado (apodo, rubro, id) SELECT apodo, rubro, id FROM __temp__invitado');
        $this->addSql('DROP TABLE __temp__invitado');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE conductor_programa');
        $this->addSql('DROP TABLE probar');
        $this->addSql('DROP TABLE probar_programa');
        $this->addSql('CREATE TEMPORARY TABLE __temp__columnista AS SELECT apodo, columna, id FROM columnista');
        $this->addSql('DROP TABLE columnista');
        $this->addSql('CREATE TABLE columnista (apodo VARCHAR(50) DEFAULT NULL, columna VARCHAR(50) DEFAULT NULL, id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, CONSTRAINT FK_9083851CBF396750 FOREIGN KEY (id) REFERENCES persona2 (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO columnista (apodo, columna, id) SELECT apodo, columna, id FROM __temp__columnista');
        $this->addSql('DROP TABLE __temp__columnista');
        $this->addSql('CREATE TEMPORARY TABLE __temp__conductor AS SELECT cumple, apodo, instagram, twitter, youtube, id FROM conductor');
        $this->addSql('DROP TABLE conductor');
        $this->addSql('CREATE TABLE conductor (cumple DATE DEFAULT NULL, apodo VARCHAR(50) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, CONSTRAINT FK_D5F7F18ABF396750 FOREIGN KEY (id) REFERENCES persona2 (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO conductor (cumple, apodo, instagram, twitter, youtube, id) SELECT cumple, apodo, instagram, twitter, youtube, id FROM __temp__conductor');
        $this->addSql('DROP TABLE __temp__conductor');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invitado AS SELECT apodo, rubro, id FROM invitado');
        $this->addSql('DROP TABLE invitado');
        $this->addSql('CREATE TABLE invitado (apodo VARCHAR(50) DEFAULT NULL, rubro VARCHAR(255) DEFAULT NULL, id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, CONSTRAINT FK_4982EC17BF396750 FOREIGN KEY (id) REFERENCES persona2 (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invitado (apodo, rubro, id) SELECT apodo, rubro, id FROM __temp__invitado');
        $this->addSql('DROP TABLE __temp__invitado');
    }
}
