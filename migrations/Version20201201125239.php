<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201125239 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabane DROP FOREIGN KEY FK_856CCFCB453D3D6F');
        $this->addSql('DROP INDEX IDX_856CCFCB453D3D6F ON cabane');
        $this->addSql('ALTER TABLE cabane DROP hote_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabane ADD hote_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cabane ADD CONSTRAINT FK_856CCFCB453D3D6F FOREIGN KEY (hote_id) REFERENCES hote (id)');
        $this->addSql('CREATE INDEX IDX_856CCFCB453D3D6F ON cabane (hote_id)');
    }
}
