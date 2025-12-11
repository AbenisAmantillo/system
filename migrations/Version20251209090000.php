<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Remove entity_type and entity_id columns from activity_log table
 */
final class Version20251209090000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove entity_type and entity_id columns from activity_log table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE activity_log DROP COLUMN entity_type');
        $this->addSql('ALTER TABLE activity_log DROP COLUMN entity_id');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE activity_log ADD entity_type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE activity_log ADD entity_id INT DEFAULT NULL');
    }
}

