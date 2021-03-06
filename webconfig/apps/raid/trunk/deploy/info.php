<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'raid';
$app['version'] = '6.1.0.beta2';
$app['release'] = '1';
$app['vendor'] = 'ClearFoundation';
$app['packager'] = 'ClearFoundation';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['summary'] = 'ClearOS Raid Manager';
$app['description'] = 'RAID....'; // FIXME

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('raid_raid');
$app['category'] = lang('base_category_system');
$app['subcategory'] = lang('base_subcategory_storage');
$app['menu_enabled'] = FALSE;

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['core_requires'] = array(
    'app-mail-notification', 
);

$app['core_requires'] = array(
    'app-date-core', 
    'app-mail-notification-core', 
    'app-tasks-core', 
    'mdadm',
    'tw_cli >= 9.5.3',
    'util-linux',
    'vixie-cron',
    'udev'
);

$app['core_file_manifest'] = array( 
   'raid.conf' => array(
        'target' => '/etc/clearos/raid.conf',
        'mode' => '0644',
        'owner' => 'root',
        'group' => 'root',
        'config' => TRUE,
        'config_params' => 'noreplace',
    )
);
