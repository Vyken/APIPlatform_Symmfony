<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230207222229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE platform_film (platform_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_64CD90EFFE6496F (platform_id), INDEX IDX_64CD90E567F5183 (film_id), PRIMARY KEY(platform_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE platform_film ADD CONSTRAINT FK_64CD90EFFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE platform_film ADD CONSTRAINT FK_64CD90E567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE platform DROP catalog');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE platform_film DROP FOREIGN KEY FK_64CD90EFFE6496F');
        $this->addSql('ALTER TABLE platform_film DROP FOREIGN KEY FK_64CD90E567F5183');
        $this->addSql('DROP TABLE platform_film');
        $this->addSql('ALTER TABLE platform ADD catalog LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }
}
