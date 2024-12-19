<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204132819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add indexs in product for sku and price';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__producto AS SELECT id, name, sku, price, created_on FROM producto');
        $this->addSql('DROP TABLE producto');
        $this->addSql('CREATE TABLE producto (id CHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, sku VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, created_on DATETIME NOT NULL)');
        $this->addSql('INSERT INTO producto (id, name, sku, price, created_on) SELECT id, name, sku, price, created_on FROM __temp__producto');
        $this->addSql('DROP TABLE __temp__producto');
        $this->addSql('CREATE INDEX product_sku ON producto (sku)');
        $this->addSql('CREATE INDEX product_price ON producto (price)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__producto AS SELECT id, name, sku, price, created_on FROM producto');
        $this->addSql('DROP TABLE producto');
        $this->addSql('CREATE TABLE producto (id CHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, sku VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, created_on DATETIME NOT NULL)');
        $this->addSql('INSERT INTO producto (id, name, sku, price, created_on) SELECT id, name, sku, price, created_on FROM __temp__producto');
        $this->addSql('DROP TABLE __temp__producto');
    }
}
