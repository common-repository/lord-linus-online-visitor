<?php
global $wpdb;
$useronline_sql = "CREATE TABLE IF NOT EXISTS `useronline` (
  `timestamp` int(15) NOT NULL DEFAULT '0',
  `ip` varchar(40) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`timestamp`)
);";
$wpdb->query($useronline_sql); 
update_option('lord_total_visitor','0');
?>