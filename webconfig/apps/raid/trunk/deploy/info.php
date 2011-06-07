<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'raid';
$app['version'] = '5.9.9.1';
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

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['core_requires'] = array(
    'app-setup', 
    'app-base', 
    'app-mail_notification', 
    'app-date', 
    'mdadm',
    'mpt-status >= 1.2.0',
    'tw_cli >= 9.5.0',
    'util-linux',
    'vixie-cron',
    'udev'
);
$app['core_file_manifest'] = array( 
   'raid.conf' => array(
        'target' => '/etc/system/raid.conf',
        'mode' => '0644',
        'owner' => 'webconfig',
        'group' => 'webconfig',
        'config' => TRUE,
        'config_params' => 'noreplace',
    )
);
