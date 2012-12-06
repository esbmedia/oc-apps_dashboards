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

class OC_Dashboards {
	
	/**
	 * Get user dashboards
	 * @param $n Target div id
	 * @return Array
	 */
	public static function getUserDashboard($n){
		$query = OCP\DB::prepare('SELECT d_appid,d_file,d_js FROM *PREFIX*dashboards WHERE oc_uid = ? AND div_id = ?');
		$result = $query->execute(Array(OCP\User::getUser(), $n))->fetchRow();
		if($result){
			return $result;
		}
		return FALSE;
	}
	
	/**
	 * Set user dashboard
	 * @param $div The div id
	 * @param $file The dashboard file
	 */
	public static function setUserDashboard($div,$app,$file,$js){
		$exists = self::getUserDashboard($div);
		if($exists){
			$query = OCP\DB::prepare('UPDATE *PREFIX*dashboards SET d_appid = ?, d_file = ?, d_js = ? WHERE oc_uid = ? AND div_id = ?');
			$result = $query->execute(Array($app,$file,$js,OCP\User::getUser(),$div));
		}else{
			$query = OCP\DB::prepare('INSERT INTO *PREFIX*dashboards (oc_uid,div_id,d_appid,d_file,d_js) VALUES (?,?,?,?,?)');
			$result = $query->execute(Array(OCP\User::getUser(),$div,$app,$file,$js));
		}
	}
	
}
