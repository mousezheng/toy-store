<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014045919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_D5A67B831E36857 ON weixin_user_info');
        $this->addSql('ALTER TABLE weixin_user_info ADD open_id VARCHAR(32) NOT NULL COMMENT \'微信用户唯一表示\', ADD union_id VARCHAR(32) DEFAULT NULL COMMENT \'一个微信开放平台下的不同应用，UnionID是相同的\', DROP openid');
        $this->addSql('CREATE INDEX IDX_D5A67B83F89B8A9C ON weixin_user_info (open_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_D5A67B83F89B8A9C ON weixin_user_info');
        $this->addSql('ALTER TABLE weixin_user_info ADD openid VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP open_id, DROP union_id');
        $this->addSql('CREATE INDEX IDX_D5A67B831E36857 ON weixin_user_info (openid)');
    }
}
