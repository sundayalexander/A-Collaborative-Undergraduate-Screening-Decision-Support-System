<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190328123231 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin_unit ADD approve INT NOT NULL');
        $this->addSql('ALTER TABLE exams_and_records ADD approve INT NOT NULL');
        $this->addSql('ALTER TABLE faculty ADD approve INT NOT NULL');
        $this->addSql('ALTER TABLE health_service ADD approve INT NOT NULL');
        $this->addSql('ALTER TABLE student_affairs ADD approve INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin_unit DROP approve');
        $this->addSql('ALTER TABLE exams_and_records DROP approve');
        $this->addSql('ALTER TABLE faculty DROP approve');
        $this->addSql('ALTER TABLE health_service DROP approve');
        $this->addSql('ALTER TABLE student_affairs DROP approve');
    }
}
