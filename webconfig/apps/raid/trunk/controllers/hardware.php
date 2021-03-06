<?php

/**
 * Raid controller.
 *
 * @category   Apps
 * @package    Raid
 * @subpackage Controllers
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2011 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/raid/
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// D E P E N D E N C I E S
///////////////////////////////////////////////////////////////////////////////

use \clearos\apps\raid\Raid as Raid;

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * Raid controller.
 *
 * @category   Apps
 * @package    Raid
 * @subpackage Controllers
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2011 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/raid/
 */

class Hardware extends ClearOS_Controller
{

    /**
     * Raid default controller
     *
     * @return view
     */

    function index($type)
    {
        // Load dependencies
        //------------------

        $this->load->library('raid/Raid_Lsi');
        $this->load->library('raid/Raid_3ware');
        $this->lang->load('raid');

        try {
            $bob[] = array ('status' => 'OK', 'level' => 1, 'size' => 10240000);
            $bob[] = array ('status' => 'FAIL', 'level' => 1, 'size' => 10240000);
            if ($type == Raid::TYPE_3WARE) {
                $data['raid_array'] = $bob;// TODO $this->raid_3ware->get_arrays();
                $data['raid_hardware'] = $this->raid_3ware;
            } else {
                $data['raid_array'] = $bob;// TODO $this->raid_lsi->get_arrays();
                $data['raid_hardware'] = $this->raid_3ware;
            }
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load view
        //----------

        $this->page->view_form('hardware', $data, lang('raid_hardware'));
    }
}
