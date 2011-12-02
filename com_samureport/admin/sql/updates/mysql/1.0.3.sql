ALTER TABLE `#__samureport_staff` ADD COLUMN `created` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `#__samureport_staff` ADD COLUMN created_by int(10) unsigned NOT NULL default '0';
ALTER TABLE `#__samureport_staff` ADD COLUMN `modified` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `#__samureport_staff` ADD COLUMN modified_by int(10) unsigned NOT NULL default '0';

ALTER TABLE `#__samureport_vehicles` ADD COLUMN `created` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `#__samureport_vehicles` ADD COLUMN created_by int(10) unsigned NOT NULL default '0';
ALTER TABLE `#__samureport_vehicles` ADD COLUMN `modified` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `#__samureport_vehicles` ADD COLUMN modified_by int(10) unsigned NOT NULL default '0';

ALTER TABLE `#__samureport_equipments` ADD COLUMN `created` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `#__samureport_equipments` ADD COLUMN created_by int(10) unsigned NOT NULL default '0';
ALTER TABLE `#__samureport_equipments` ADD COLUMN `modified` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `#__samureport_equipments` ADD COLUMN modified_by int(10) unsigned NOT NULL default '0';

ALTER TABLE `#__samureport_reasons` ADD COLUMN `created` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `#__samureport_reasons` ADD COLUMN created_by int(10) unsigned NOT NULL default '0';
ALTER TABLE `#__samureport_reasons` ADD COLUMN `modified` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `#__samureport_reasons` ADD COLUMN modified_by int(10) unsigned NOT NULL default '0';