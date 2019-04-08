<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327153650 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin_unit ADD jamb_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin_unit ADD CONSTRAINT FK_FCA28EB3188F807C FOREIGN KEY (jamb_id) REFERENCES jamb (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FCA28EB3188F807C ON admin_unit (jamb_id)');
        $this->addSql('ALTER TABLE jamb DROP FOREIGN KEY FK_4F257CF23C81F284');
        $this->addSql('DROP INDEX IDX_4F257CF23C81F284 ON jamb');
        $this->addSql('ALTER TABLE jamb DROP admin_unit_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin_unit DROP FOREIGN KEY FK_FCA28EB3188F807C');
        $this->addSql('DROP INDEX UNIQ_FCA28EB3188F807C ON admin_unit');
        $this->addSql('ALTER TABLE admin_unit DROP jamb_id');
        $this->addSql('ALTER TABLE jamb ADD admin_unit_id INT NOT NULL');
        $this->addSql('ALTER TABLE jamb ADD CONSTRAINT FK_4F257CF23C81F284 FOREIGN KEY (admin_unit_id) REFERENCES admin_unit (id)');
        $this->addSql('CREATE INDEX IDX_4F257CF23C81F284 ON jamb (admin_unit_id)');
    }
}
