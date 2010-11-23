<?php

//////////////////////////////////////////////////////////////////////////////
//
// Copyright 2010 ClearFoundation
//
///////////////////////////////////////////////////////////////////////////////
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//
///////////////////////////////////////////////////////////////////////////////

/**
 * DHCP server configuration.
 *
 * @package Frontend
 * @author {@link http://www.clearfoundation.com ClearFoundation}
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @copyright Copyright 2010, ClearFoundation
 */

class Dhcp extends ClearOS_Controller
{
	/**
	 * DHCP server overview.
	 *
	 * @return string
	 */

	function index()
	{
		$this->full_index();
// FIXME: mobile
		//$this->mobile_index();
	}

	function full_index()
	{
		// Load libraries
		//---------------

		$this->load->library('dns/DnsMasq');

		// Load view data
		//---------------

		try {
			$data['authoritative'] = $this->dnsmasq->GetAuthoritativeState();
			$data['domain'] = $this->dnsmasq->GetDomainName();
			$data['subnets'] = $this->dnsmasq->GetSubnets();
			$data['ethlist'] = $this->dnsmasq->GetDhcpInterfaces();
			$data['leases'] = $this->dnsmasq->GetLeases();
		} catch (Exception $e) {
			// FIXME: fatal error handling
			$header['fatal_error'] = $e->GetMessage();
		}

		// Load views
		//-----------

		$header['title'] = lang('dhcp_dhcp');

		$this->load->view('theme/header', $header);
		$this->load->view('dhcp/general/summary', $data);
		$this->load->view('dhcp/subnets/summary', $data);
		$this->load->view('dhcp/leases/summary', $data);
		$this->load->view('theme/footer');
	}

	function mobile_index()
	{
		// Load libraries
		//---------------

		$this->lang->load('base');
		$this->lang->load('dhcp');

		// Load views
		//-----------

// FIXME: add icons and help blurb for control panel view
		$summary['links']['/app/dhcp/general'] = lang('base_general_settings');
		$summary['links']['/app/dhcp/subnets'] = lang('dhcp_subnets');
		$summary['links']['/app/dhcp/leases'] = lang('dhcp_leases');

		$header['title'] = lang('dhcp_dhcp');

		$this->load->view('theme/header', $header);
		$this->load->view('theme/summary', $summary);
		$this->load->view('theme/footer');
	}
}

?>
