<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240511160122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE airpon_client (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, box_id INT NOT NULL, modem_ont_id INT NOT NULL, port VARCHAR(255) NOT NULL, longueur VARCHAR(255) NOT NULL, date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', UNIQUE INDEX UNIQ_DC4DBD3E19EB6921 (client_id), INDEX IDX_DC4DBD3ED8177B3F (box_id), INDEX IDX_DC4DBD3EFC72DAE8 (modem_ont_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE box (id INT AUTO_INCREMENT NOT NULL, c_type_id INT NOT NULL, gps VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, date_installation DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_8A9483A57C11B48 (c_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cable_hub_box (id INT AUTO_INCREMENT NOT NULL, hub_id INT NOT NULL, box_id INT NOT NULL, longueur VARCHAR(255) NOT NULL, date_installation DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_32E90AF26C786081 (hub_id), UNIQUE INDEX UNIQ_32E90AF2D8177B3F (box_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cable_inter_box (id INT AUTO_INCREMENT NOT NULL, source1_id INT NOT NULL, source2_id INT NOT NULL, date_installation DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', UNIQUE INDEX UNIQ_2D0239D5EC4C4041 (source1_id), UNIQUE INDEX UNIQ_2D0239D5FEF9EFAF (source2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, cin VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, pernom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, gps VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ctype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direction (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, parent_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, INDEX IDX_3E4AD1B3C54C8C93 (type_id), INDEX IDX_3E4AD1B3727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hub (id INT AUTO_INCREMENT NOT NULL, gps VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, position_hub_olt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modem_ont (id INT AUTO_INCREMENT NOT NULL, num_serie VARCHAR(255) NOT NULL, caracteristiques VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE olt (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, type_id INT NOT NULL, loc VARCHAR(255) NOT NULL, gps VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, date_installation DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', vlan_management VARCHAR(255) NOT NULL, port_metro VARCHAR(255) NOT NULL, capacite_port_metro VARCHAR(255) NOT NULL, adresse_management VARCHAR(255) NOT NULL, INDEX IDX_22EAC481C18272 (projet_id), INDEX IDX_22EAC481C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position_olt (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, direction_id INT NOT NULL, nom VARCHAR(255) NOT NULL, date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_50159CA9AF73D997 (direction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reception_hub (id INT AUTO_INCREMENT NOT NULL, hub_id INT NOT NULL, date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_A6BC82D96C786081 (hub_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reception_olt (id INT AUTO_INCREMENT NOT NULL, olt_id INT NOT NULL, date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_CC27881569FFAD89 (olt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_direction (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_olt (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, direction_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, cin VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, post_travail VARCHAR(255) NOT NULL, adresse_personelle VARCHAR(255) NOT NULL, adresse_professionelle VARCHAR(255) NOT NULL, tel_fixe VARCHAR(255) NOT NULL, tel_portable VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649AF73D997 (direction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE airpon_client ADD CONSTRAINT FK_DC4DBD3E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE airpon_client ADD CONSTRAINT FK_DC4DBD3ED8177B3F FOREIGN KEY (box_id) REFERENCES box (id)');
        $this->addSql('ALTER TABLE airpon_client ADD CONSTRAINT FK_DC4DBD3EFC72DAE8 FOREIGN KEY (modem_ont_id) REFERENCES modem_ont (id)');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483A57C11B48 FOREIGN KEY (c_type_id) REFERENCES ctype (id)');
        $this->addSql('ALTER TABLE cable_hub_box ADD CONSTRAINT FK_32E90AF26C786081 FOREIGN KEY (hub_id) REFERENCES hub (id)');
        $this->addSql('ALTER TABLE cable_hub_box ADD CONSTRAINT FK_32E90AF2D8177B3F FOREIGN KEY (box_id) REFERENCES box (id)');
        $this->addSql('ALTER TABLE cable_inter_box ADD CONSTRAINT FK_2D0239D5EC4C4041 FOREIGN KEY (source1_id) REFERENCES box (id)');
        $this->addSql('ALTER TABLE cable_inter_box ADD CONSTRAINT FK_2D0239D5FEF9EFAF FOREIGN KEY (source2_id) REFERENCES box (id)');
        $this->addSql('ALTER TABLE direction ADD CONSTRAINT FK_3E4AD1B3C54C8C93 FOREIGN KEY (type_id) REFERENCES type_direction (id)');
        $this->addSql('ALTER TABLE direction ADD CONSTRAINT FK_3E4AD1B3727ACA70 FOREIGN KEY (parent_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE olt ADD CONSTRAINT FK_22EAC481C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE olt ADD CONSTRAINT FK_22EAC481C54C8C93 FOREIGN KEY (type_id) REFERENCES type_olt (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE reception_hub ADD CONSTRAINT FK_A6BC82D96C786081 FOREIGN KEY (hub_id) REFERENCES hub (id)');
        $this->addSql('ALTER TABLE reception_olt ADD CONSTRAINT FK_CC27881569FFAD89 FOREIGN KEY (olt_id) REFERENCES olt (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE airpon_client DROP FOREIGN KEY FK_DC4DBD3E19EB6921');
        $this->addSql('ALTER TABLE airpon_client DROP FOREIGN KEY FK_DC4DBD3ED8177B3F');
        $this->addSql('ALTER TABLE airpon_client DROP FOREIGN KEY FK_DC4DBD3EFC72DAE8');
        $this->addSql('ALTER TABLE box DROP FOREIGN KEY FK_8A9483A57C11B48');
        $this->addSql('ALTER TABLE cable_hub_box DROP FOREIGN KEY FK_32E90AF26C786081');
        $this->addSql('ALTER TABLE cable_hub_box DROP FOREIGN KEY FK_32E90AF2D8177B3F');
        $this->addSql('ALTER TABLE cable_inter_box DROP FOREIGN KEY FK_2D0239D5EC4C4041');
        $this->addSql('ALTER TABLE cable_inter_box DROP FOREIGN KEY FK_2D0239D5FEF9EFAF');
        $this->addSql('ALTER TABLE direction DROP FOREIGN KEY FK_3E4AD1B3C54C8C93');
        $this->addSql('ALTER TABLE direction DROP FOREIGN KEY FK_3E4AD1B3727ACA70');
        $this->addSql('ALTER TABLE olt DROP FOREIGN KEY FK_22EAC481C18272');
        $this->addSql('ALTER TABLE olt DROP FOREIGN KEY FK_22EAC481C54C8C93');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9AF73D997');
        $this->addSql('ALTER TABLE reception_hub DROP FOREIGN KEY FK_A6BC82D96C786081');
        $this->addSql('ALTER TABLE reception_olt DROP FOREIGN KEY FK_CC27881569FFAD89');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AF73D997');
        $this->addSql('DROP TABLE airpon_client');
        $this->addSql('DROP TABLE box');
        $this->addSql('DROP TABLE cable_hub_box');
        $this->addSql('DROP TABLE cable_inter_box');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE ctype');
        $this->addSql('DROP TABLE direction');
        $this->addSql('DROP TABLE hub');
        $this->addSql('DROP TABLE modem_ont');
        $this->addSql('DROP TABLE olt');
        $this->addSql('DROP TABLE position_olt');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE reception_hub');
        $this->addSql('DROP TABLE reception_olt');
        $this->addSql('DROP TABLE type_direction');
        $this->addSql('DROP TABLE type_olt');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
