<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230228230618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("
          INSERT INTO symfonytest_db.country (name, code, tax)
          VALUES ('Germany', 'DE', 19);
        ");
        $this->addSql("
          INSERT INTO symfonytest_db.country (name, code, tax)
          VALUES ('Italy', 'IT', 22);
        ");
        $this->addSql("
          INSERT INTO symfonytest_db.country (name, code, tax)
          VALUES ('Greece', 'GR', 24);
          ");
        $this->addSql("
          INSERT INTO symfonytest_db.product (title, price)
          VALUES ('Headphones', 10000);
        ");
        $this->addSql("
          INSERT INTO symfonytest_db.product (title, price)
          VALUES ('Phone case', 2000);
        ");
        $this->addSql("
          INSERT INTO symfonytest_db.product (title, price)
          VALUES ('Computer', 99933);
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("
        DELETE
        FROM symfonytest_db.country
        WHERE code = 'DE';
        ");
        $this->addSql("
        DELETE
        FROM symfonytest_db.country
        WHERE code = 'IT';
        ");
        $this->addSql("
        DELETE
        FROM symfonytest_db.country
        WHERE code = 'GR';
        ");

        $this->addSql("
        DELETE
        FROM symfonytest_db.product
        WHERE title = 'Headphones';
        ");
        $this->addSql("
        DELETE
        FROM symfonytest_db.product
        WHERE title = 'Phone case';
        ");
        $this->addSql("
        DELETE
        FROM symfonytest_db.product
        WHERE title = 'Computer';
        ");
    }
}
