<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->execute('

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `autodial` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `src` varchar(80) DEFAULT NULL,
  `dst` varchar(80) DEFAULT NULL,
  `clid` varchar(80) DEFAULT NULL,
  `wait_que` int(11) NOT NULL DEFAULT \'0\',
  `duration` int(11) NOT NULL DEFAULT \'0\',
  `billsec` int(11) NOT NULL DEFAULT \'0\',
  `disposition` varchar(45) DEFAULT NULL,
  `operator` varchar(20) DEFAULT NULL,
  `record` varchar(256) DEFAULT NULL,
  `uniqueid` varchar(150) DEFAULT NULL,
  `cl_online` tinyint(2) NOT NULL DEFAULT \'0\',
  `cur_state` tinyint(2) NOT NULL DEFAULT \'0\',
  `num_att` tinyint(2) NOT NULL DEFAULT \'0\',
  `last_att` datetime NOT NULL DEFAULT \'0000-00-00 00:00:00\',
  `type` varchar(20) DEFAULT NULL,
  `call_date` datetime DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  `list` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `call` (`src`,`dst`,`call_date`),
  KEY `call_date` (`call_date`),
  KEY `src` (`src`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cdr` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `accountcode` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `src` varchar(80) CHARACTER SET latin1 NOT NULL DEFAULT \'\',
  `dst` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `did` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `dcontext` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `clid` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `channel` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `dstchannel` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `lastapp` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `lastdata` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `start` datetime NOT NULL DEFAULT \'0000-00-00 00:00:00\',
  `answer` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `billsec` int(11) DEFAULT NULL,
  `disposition` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `op_answer` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `operator` varchar(40) CHARACTER SET latin1 DEFAULT NULL,
  `ans_duration` int(11) DEFAULT NULL,
  `amaflags` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `userfield` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  `uniqueid` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `linkedid` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `peeraccount` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `press` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `direct` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `mark` varchar(10) CHARACTER SET latin1 DEFAULT \'\',
  PRIMARY KEY (`id`),
  KEY `start` (`start`),
  KEY `dst` (`dst`(20)),
  KEY `src` (`src`(20)),
  KEY `accountcode` (`accountcode`(7)),
  KEY `start_acc` (`accountcode`(7),`start`),
  KEY `dstchan` (`dstchannel`),
  KEY `uniqueid` (`uniqueid`),
  KEY `chann` (`channel`),
  KEY `end` (`end`),
  KEY `direct` (`direct`),
  KEY `did` (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=1756409 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `operator_mob` (
  `ext` varchar(8) NOT NULL DEFAULT \'\',
  `mob` varchar(20) NOT NULL DEFAULT \'\',
  PRIMARY KEY (`ext`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `queue_members` (
  `queue_name` varchar(80) CHARACTER SET latin1 NOT NULL,
  `interface` varchar(80) CHARACTER SET latin1 NOT NULL,
  `membername` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `state_interface` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `penalty` int(11) DEFAULT NULL,
  `paused` int(11) DEFAULT NULL,
  `uniqueid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`queue_name`,`interface`),
  UNIQUE KEY `uniqueid` (`uniqueid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT \'10\',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
');
    }

    public function down()
    {

    }
}
