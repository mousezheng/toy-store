<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201012065734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE login_log (id INT AUTO_INCREMENT NOT NULL, openid VARCHAR(32) NOT NULL COMMENT \'用户唯一标识\', session_key VARCHAR(255) NOT NULL COMMENT \'会话密钥\', unionid VARCHAR(32) DEFAULT NULL COMMENT \'用户在开放平台的唯一标识符，在满足 UnionID 下发条件的情况下会返回\', add_time INT NOT NULL, INDEX IDX_F16D9FFF616C45B5 (add_time), INDEX IDX_F16D9FFF1E36857 (openid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'登录成功日志记录\' ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE login_log');
    }
}
