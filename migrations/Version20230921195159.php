<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230921195159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `movies` (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, movie_name VARCHAR(255) DEFAULT NULL, release_date DATETIME NOT NULL, movie_image VARCHAR(255) DEFAULT NULL, movie_details VARCHAR(255) DEFAULT NULL, INDEX IDX_C61EED3012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `movies` ADD CONSTRAINT FK_C61EED3012469DE2 FOREIGN KEY (category_id) REFERENCES `category` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `movies` DROP FOREIGN KEY FK_C61EED3012469DE2');
        $this->addSql('DROP TABLE `movies`');
    }
}
