<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130175432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabane ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cabane ADD CONSTRAINT FK_856CCFCBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_856CCFCBA76ED395 ON cabane (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabane DROP FOREIGN KEY FK_856CCFCBA76ED395');
        $this->addSql('DROP INDEX IDX_856CCFCBA76ED395 ON cabane');
        $this->addSql('ALTER TABLE cabane DROP user_id');
    }
}
