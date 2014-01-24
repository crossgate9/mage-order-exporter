<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('ei_oe_task')};
CREATE TABLE {$this->getTable('ei_oe_task')} (
  `entity_id` int(11) unsigned NOT NULL auto_increment,
  `cmd` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `pid` varchar(6) NOT NULL default '',
  `log` text NOT NULL default '',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup(); 