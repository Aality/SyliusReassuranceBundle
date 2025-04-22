<?php

declare(strict_types=1);

namespace Aality\SyliusReassuranceBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250422150909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE Configuration (id INT AUTO_INCREMENT NOT NULL, reassuranceTheme VARCHAR(255) NOT NULL, backgroundColor VARCHAR(20) DEFAULT NULL, titleColor VARCHAR(20) DEFAULT NULL, textColor VARCHAR(20) DEFAULT NULL, iconSize INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE Reassurance (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            DROP TABLE Configuration
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE Reassurance
        SQL);
    }
}
