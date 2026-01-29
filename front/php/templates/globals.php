<?php

// ######################################################################
// ## Global constants and TimeZone processing
// ######################################################################

$configFolderPath = rtrim(getenv('NETALERTX_CONFIG') ?: '/data/config', '/') . '/';
$logFolderPath = rtrim(getenv('NETALERTX_LOG') ?: '/tmp/log', '/') . '/';

$config_file = "app.conf";
$workflows_file = "workflows.json";

$log_file = "app_front.log";
$default_tz = "Europe/Berlin";


$fullConfPath = $configFolderPath.$config_file;
$fullWorkflowsPath = $configFolderPath.$workflows_file;

$config = parse_ini_file($fullConfPath);
if ($config) {
  $timeZone = $config['TIMEZONE'] ?? '';
} else {
  $timeZone = "";
}

if($timeZone == "")
{
  $timeZone = $default_tz;
}

// Validate the timezone
if (!in_array($timeZone, timezone_identifiers_list())) {
  error_log("Invalid timezone '$timeZone' in config. Falling back to default: '$default_tz' ");
  $timeZone = $default_tz;
}

date_default_timezone_set($timeZone);

$date = new DateTime("now", new DateTimeZone($timeZone) );
$timestamp = $date->format('Y-m-d_H-i-s');

// ######################################################################
// ## Global constants and TimeZone processing
// ######################################################################

