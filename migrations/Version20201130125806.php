<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130125806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabane ADD partner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cabane ADD CONSTRAINT FK_856CCFCB9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('CREATE INDEX IDX_856CCFCB9393F8FE ON cabane (partner_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabane DROP FOREIGN KEY FK_856CCFCB9393F8FE');
        $this->addSql('DROP INDEX IDX_856CCFCB9393F8FE ON cabane');
        $this->addSql('ALTER TABLE cabane DROP partner_id');
    }
}
