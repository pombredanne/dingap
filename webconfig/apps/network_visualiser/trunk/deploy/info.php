<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'network_visualiser';
$app['version'] = '5.9.9.5';
$app['release'] = '1';
$app['vendor'] = 'ClearFoundation';
$app['packager'] = 'ClearFoundation';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['summary'] = lang('network_visualiser_app_description');
$app['description'] = lang('network_visualiser_app_description');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('network_visualiser_app_name');
$app['category'] = lang('base_category_network');
$app['subcategory'] = lang('base_subcategory_bandwidth_and_qos');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['core_requires'] = array(
    'jnettop'
);

$app['core_file_manifest'] = array(
    'jnettop.conf' => array(
        'target' => '/etc/jnettop.conf',
        'mode' => '0755',
        'config' => TRUE,
        'config_params' => 'noreplace',
    ),
);
