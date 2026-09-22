<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260922083413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tbl_image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE image_credits (image_id INT NOT NULL, credits_id INT NOT NULL, INDEX IDX_D40786A23DA5256D (image_id), INDEX IDX_D40786A223DEF1B2 (credits_id), PRIMARY KEY (image_id, credits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE image_credits ADD CONSTRAINT FK_D40786A23DA5256D FOREIGN KEY (image_id) REFERENCES tbl_image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_credits ADD CONSTRAINT FK_D40786A223DEF1B2 FOREIGN KEY (credits_id) REFERENCES credits (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_credits DROP FOREIGN KEY FK_D40786A23DA5256D');
        $this->addSql('ALTER TABLE image_credits DROP FOREIGN KEY FK_D40786A223DEF1B2');
        $this->addSql('DROP TABLE tbl_image');
        $this->addSql('DROP TABLE image_credits');
    }
}
