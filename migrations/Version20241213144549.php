<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241213144549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE persona (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, apellido VARCHAR(50) NOT NULL, dni INTEGER NOT NULL, edad INTEGER NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__producto AS SELECT id, name, sku, price, created_on, category_id FROM producto');
        $this->addSql('DROP TABLE producto');
        $this->addSql('CREATE TABLE producto (id VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, sku VARCHAR(50) NOT NULL, price INTEGER NOT NULL, created_on DATETIME NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_A7BB061512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO producto (id, name, sku, price, created_on, category_id) SELECT id, name, sku, price, created_on, category_id FROM __temp__producto');
        $this->addSql('DROP TABLE __temp__producto');
        $this->addSql('CREATE INDEX IDX_A7BB061512469DE2 ON producto (category_id)');
        $this->addSql('CREATE INDEX product_price ON producto (price)');
        $this->addSql('CREATE INDEX product_sku ON producto (sku)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE persona');
        $this->addSql('CREATE TEMPORARY TABLE __temp__producto AS SELECT id, name, sku, price, created_on, category_id FROM producto');
        $this->addSql('DROP TABLE producto');
        $this->addSql('CREATE TABLE producto (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, sku VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, created_on DATETIME NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_A7BB061512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO producto (id, name, sku, price, created_on, category_id) SELECT id, name, sku, price, created_on, category_id FROM __temp__producto');
        $this->addSql('DROP TABLE __temp__producto');
        $this->addSql('CREATE INDEX IDX_A7BB061512469DE2 ON producto (category_id)');
        $this->addSql('CREATE INDEX product_sku ON producto (sku)');
        $this->addSql('CREATE INDEX product_price ON producto (price)');
    }
}
