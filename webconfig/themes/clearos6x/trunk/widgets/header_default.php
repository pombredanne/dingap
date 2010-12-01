<?php

///////////////////////////////////////////////////////////////////////////////
// 
// Copyright 2009, 2010 ClearFoundation
//
//////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// B O O T S T R A P
///////////////////////////////////////////////////////////////////////////////
	
$bootstrap = isset($_ENV['CLEAROS_BOOTSTRAP']) ? $_ENV['CLEAROS_BOOTSTRAP'] : '/usr/clearos/framework/shared';
require_once($bootstrap . '/bootstrap.php');

///////////////////////////////////////////////////////////////////////////////
// D E P E N D E N C I E S
///////////////////////////////////////////////////////////////////////////////

clearos_load_language('base/base');

require_once('menu.php');

///////////////////////////////////////////////////////////////////////////////
// H E A D E R
///////////////////////////////////////////////////////////////////////////////
// FIXME: what's required? - should these be session variables?
// what about flash session variables?
// $header['summary']
// $header['icon']
// $header['fatal_error']
// $header['login']
// $header['fullname']

// Required
//---------
//
// $this->session->flashdata('status')

echo "
<!-- Body -->
<body>


<!-- Page Container -->
<div id='clearos6x-layout-container'>


<!-- Header -->
<div id='clearos6x-layout-header'>
	<div id='clearos6x-header-background'></div>
	<div id='clearos6x-header-logo'></div>
	<div id='clearos6x-header-fullname'>" . lang('base_welcome') . "</div>
	<div id='clearos6x-header-organization'><a href='/app/base/logout'>" . lang('base_logout') . "</a></div>
</div>

<!-- Top Menu -->
<div id='clearos6x-layout-top-menu' class=''>
	<ul id='clearos6x-top-menu-list' class='sf-menu'>
		$topmenu
	</ul>		
</div>

<!-- Left Menu -->
<script type='text/javascript'> 
	$(document).ready(function() { 
		$('#clearos6x-top-menu-list').superfish({
			delay: 800,
			pathLevels: 0
		});
	});

	$(document).ready(function(){
		$('#clearos6x-left-menu').accordion({ autoHeight: false, active: $active_section_number });
	});
</script>


<div id='clearos6x-layout-left-menu'>
	<div id='clearos6x-left-menu-top'></div>
	<div id='clearos6x-left-menu'>
		$leftmenu
	</div>
</div>

<!-- Content -->
<div id='clearos6x-layout-content'>

";

if (isset($data['status_success']))
	infobox_highlight($data['status_success']);


if (isset($data['exceptions'])) {
	$message = "<p>" . "Oooops.  That's not good" . "</p>\n"; // FIXME: localize
	$message .= "<ul>";

	foreach ($data['exceptions'] as $error_message)
		$message .= "<li>$error_message</li>\n";

	$message .= "</ul>";

	// FIXME: hook to send report or link to support?
	infobox_exception($message);
}

if (isset($data['warnings'])) {
	$message = "<p>" . "Here's something you should know." . "</p>\n"; // FIXME: localize
	$message .= "<ul>";

	foreach ($data['warnings'] as $warning_message)
		$message .= "<li>$warning_message</li>\n";

	$message .= "</ul>";

	// FIXME: hook to send report or link to support?
	infobox_warning($message);
}

?>
