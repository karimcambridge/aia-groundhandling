<?php

	// File Names
	define("FILE_DASHBOARD", "dashboard.php");

	// Account Level Descriptions
	define('USER_LEVEL_NAME', array('Regular', 'Supervisor / Administrator'));

	// SQL Table Names
	define("TABLE_ACCOUNTS", "aia_accounts");
	define("TABLE_AIRCRAFTS", "aia_aircrafts");
	define("TABLE_AIRCRAFT_SERVICES", "aia_aircraft_services");
	define("TABLE_AIRCRAFT_TYPES", "aia_aircraft_types");
	define("TABLE_AIRWAYBILLS", "aia_airwaybills");
	define("TABLE_CARGO_INVENTORY", "aia_cargo_inventory");
	define("TABLE_CARGO_ITEM_TYPES", "aia_cargo_item_types");
	define("TABLE_CARGO_OUT", "aia_cargo_out");
	define("TABLE_CARRIERS", "aia_carriers");
	define("TABLE_CONSIGNEES", "aia_consignees");
	define("TABLE_EVENT_LOGS", "aia_event_logs");
	define("TABLE_FLIGHTS", "aia_flights");
	define("TABLE_MANIFESTS", "aia_manifests");
	define("TABLE_SERVICE_ITEMS", "aia_service_items");

	// Event Log Names

	define("EVENT_LOG_AUTH", 0);
	define("EVENT_LOG_DEAUTH", 1);
	define("EVENT_LOG_REPORT_CREATE_CSV", 2);
	define("EVENT_LOG_REPORT_CREATE_EXCEL", 3);
?>