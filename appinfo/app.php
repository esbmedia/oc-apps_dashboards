<?php

/**
* ownCloud - Dashboards plugin
*
* @author Xavier Beurois
* @copyright 2012 Xavier Beurois www.djazz-lab.net
* 
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
* License as published by the Free Software Foundation; either 
* version 3 of the License, or any later version.
* 
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU AFFERO GENERAL PUBLIC LICENSE for more details.
*  
* You should have received a copy of the GNU Lesser General Public 
* License along with this library.  If not, see <http://www.gnu.org/licenses/>.
* 
*/

OCP\App::checkAppEnabled('dashboards');

OC::$CLASSPATH['OC_Dashboards'] = 'apps/dashboards/lib/dashboards.class.php';

OC_App::register(Array(
	'order' => 10,
	'id' => 'dashboards',
	'name' => 'Dashboards'
));

$data_dir = OCP\Config::getSystemValue('datadirectory', '');
if(OCP\User::getUser() && strlen($data_dir) != 0){
	OCP\Util::addScript('dashboards', 'dashboards.min');
	OCP\Util::addStyle('dashboards', 'dashboards.min');
}
