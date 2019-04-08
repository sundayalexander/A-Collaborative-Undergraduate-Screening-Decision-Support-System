<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327151114 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, unit VARCHAR(50) NOT NULL, registered_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_unit (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, first_name VARCHAR(50) NOT NULL, middle_name VARCHAR(40) NOT NULL, last_name VARCHAR(40) NOT NULL, dob DATE NOT NULL, email VARCHAR(200) NOT NULL, phone_number VARCHAR(13) NOT NULL, r_address VARCHAR(255) NOT NULL, p_address VARCHAR(255) NOT NULL, putme_score INT NOT NULL, UNIQUE INDEX UNIQ_FCA28EB3E7927C74 (email), UNIQUE INDEX UNIQ_FCA28EB36B01BC5B (phone_number), UNIQUE INDEX UNIQ_FCA28EB3CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exam (id INT AUTO_INCREMENT NOT NULL, admin_unit_id INT NOT NULL, type VARCHAR(10) NOT NULL, result VARCHAR(255) NOT NULL, added_date DATETIME NOT NULL, INDEX IDX_38BBA6C63C81F284 (admin_unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exams_and_records (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, jamb_letter VARCHAR(200) NOT NULL, aaua_letter VARCHAR(200) NOT NULL, birth_certificate VARCHAR(200) NOT NULL, state_of_origin VARCHAR(200) NOT NULL, attestation_letter VARCHAR(200) NOT NULL, jamb_result VARCHAR(200) NOT NULL, added_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_B9EE19E6CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faculty (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, prospectus VARCHAR(255) NOT NULL, matric_gown VARCHAR(255) NOT NULL, due VARCHAR(255) NOT NULL, added_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_17966043CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE health_service (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, lab_test VARCHAR(255) NOT NULL, x_ray VARCHAR(255) NOT NULL, added_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_7C340795CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jamb (id INT AUTO_INCREMENT NOT NULL, admin_unit_id INT NOT NULL, jamb_number VARCHAR(20) NOT NULL, subject_1 VARCHAR(40) NOT NULL, subject_2 VARCHAR(40) NOT NULL, subject_3 VARCHAR(40) NOT NULL, subject_4 VARCHAR(40) NOT NULL, score_1 INT NOT NULL, score_2 INT NOT NULL, score_3 INT NOT NULL, score_4 INT NOT NULL, added_date DATETIME NOT NULL, INDEX IDX_4F257CF23C81F284 (admin_unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, matric_number VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, registered_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_B723AF3315701F1F (matric_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_affairs (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, handbook VARCHAR(255) NOT NULL, aaua_cd VARCHAR(255) NOT NULL, mobile_platform VARCHAR(255) NOT NULL, added_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_85DD1846CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_unit ADD CONSTRAINT FK_FCA28EB3CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C63C81F284 FOREIGN KEY (admin_unit_id) REFERENCES admin_unit (id)');
        $this->addSql('ALTER TABLE exams_and_records ADD CONSTRAINT FK_B9EE19E6CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE faculty ADD CONSTRAINT FK_17966043CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE health_service ADD CONSTRAINT FK_7C340795CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE jamb ADD CONSTRAINT FK_4F257CF23C81F284 FOREIGN KEY (admin_unit_id) REFERENCES admin_unit (id)');
        $this->addSql('ALTER TABLE student_affairs ADD CONSTRAINT FK_85DD1846CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C63C81F284');
        $this->addSql('ALTER TABLE jamb DROP FOREIGN KEY FK_4F257CF23C81F284');
        $this->addSql('ALTER TABLE admin_unit DROP FOREIGN KEY FK_FCA28EB3CB944F1A');
        $this->addSql('ALTER TABLE exams_and_records DROP FOREIGN KEY FK_B9EE19E6CB944F1A');
        $this->addSql('ALTER TABLE faculty DROP FOREIGN KEY FK_17966043CB944F1A');
        $this->addSql('ALTER TABLE health_service DROP FOREIGN KEY FK_7C340795CB944F1A');
        $this->addSql('ALTER TABLE student_affairs DROP FOREIGN KEY FK_85DD1846CB944F1A');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE admin_unit');
        $this->addSql('DROP TABLE exam');
        $this->addSql('DROP TABLE exams_and_records');
        $this->addSql('DROP TABLE faculty');
        $this->addSql('DROP TABLE health_service');
        $this->addSql('DROP TABLE jamb');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_affairs');
    }
}
