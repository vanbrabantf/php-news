<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180316153243 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_post ADD edition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01D74281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)');
        $this->addSql('CREATE INDEX IDX_BA5AE01D74281A5E ON blog_post (edition_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01D74281A5E');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP INDEX IDX_BA5AE01D74281A5E ON blog_post');
        $this->addSql('ALTER TABLE blog_post DROP edition_id');
    }
}
