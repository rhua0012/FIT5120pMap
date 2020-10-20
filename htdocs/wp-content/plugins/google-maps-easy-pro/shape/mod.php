<?php
class  shapeGmp extends moduleGmp {
	public function init() {
		dispatcherGmp::addAction('afterConnectMapAssets', array($this, 'connectMapAssets'), 10, 2);
	}
	public function connectMapAssets($params, $forAdminArea = false) {
		if($forAdminArea) {
			frameGmp::_()->addScript('admin.shape.edit', $this->getModPath(). 'js/admin.shape.edit.js');
			frameGmp::_()->addStyle('admin.shape', $this->getModPath(). 'css/admin.shape.css');
		}
		frameGmp::_()->addScript('core.shape', $this->getModPath(). 'js/core.shape.js');
	}
	public function activate() {
		$this->install(); // Just try to do same things for now
	}
	public function install() {
		global $wpdb;
		if(!dbGmp::exist("@__shapes")) {
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta(dbGmp::prepareQuery("CREATE TABLE IF NOT EXISTS `@__shapes` (
			 	`id` int(11) NOT NULL AUTO_INCREMENT,
				`title` varchar(125) CHARACTER SET utf8 NOT NULL,
				`description` text CHARACTER SET utf8 NULL,
				`coords` text  CHARACTER SET utf8 NOT NULL,
				`type` varchar(30) CHARACTER SET utf8 NOT NULL,
				`map_id` int(11),
				`create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`animation` int(1),
				`params` text  CHARACTER SET utf8 NOT NULL,
				`sort_order` tinyint(1) NOT NULL DEFAULT '0',
				PRIMARY KEY (`id`)
		   	) DEFAULT CHARSET=utf8;"));
		}
		$createDataColumnType = dbGmp::get("SELECT DATA_TYPE
			FROM information_schema.COLUMNS
			WHERE TABLE_SCHEMA='". $wpdb->dbname ."'
				AND TABLE_NAME='@__shapes'
				AND COLUMN_NAME='create_date'");
		if($createDataColumnType[0]['DATA_TYPE'] == 'datetime')
			dbGmp::query("ALTER TABLE @__shapes MODIFY create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;");
	}
}