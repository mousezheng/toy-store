<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201012072841 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE weixin_user_info (id INT AUTO_INCREMENT NOT NULL, nick_name VARCHAR(128) DEFAULT NULL COMMENT \'用户昵称\', avatar_url VARCHAR(255) DEFAULT NULL COMMENT \'用户头像图片的 URL\', gender INT DEFAULT NULL COMMENT \'用户性别 0-未知，1-男，2-女\', country VARCHAR(64) DEFAULT NULL COMMENT \'国家\', province VARCHAR(64) DEFAULT NULL COMMENT \'省份\', city VARCHAR(64) DEFAULT NULL COMMENT \'城市\', language VARCHAR(16) DEFAULT NULL COMMENT \'显示 country，province，city 所用的语言，en-英文，zh_CN-简体中文，zh_TW-繁体中文\', openid VARCHAR(32) NOT NULL, add_time INT NOT NULL, INDEX IDX_D5A67B83616C45B5 (add_time), INDEX IDX_D5A67B831E36857 (openid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'微信用户信息\' ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE weixin_user_info');
    }
}
