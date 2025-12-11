<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251210165512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE furniture DROP FOREIGN KEY `FK_665DDAB3B03A8386`');
        $this->addSql('DROP INDEX IDX_665DDAB3B03A8386 ON furniture');
        $this->addSql('ALTER TABLE furniture CHANGE created_by_id stock INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY `FK_8BF21CDEB03A8386`');
        $this->addSql('DROP INDEX IDX_8BF21CDEB03A8386 ON property');
        $this->addSql('ALTER TABLE property DROP created_by_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE furniture CHANGE stock created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE furniture ADD CONSTRAINT `FK_665DDAB3B03A8386` FOREIGN KEY (created_by_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_665DDAB3B03A8386 ON furniture (created_by_id)');
        $this->addSql('ALTER TABLE property ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT `FK_8BF21CDEB03A8386` FOREIGN KEY (created_by_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8BF21CDEB03A8386 ON property (created_by_id)');
    }
}
