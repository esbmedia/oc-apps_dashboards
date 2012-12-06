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

OCP\JSON::checkLoggedIn();
OCP\JSON::checkAppEnabled('dashboards');

$r = Array('r' => '');
foreach(OC_App::getAllApps() as $app){
	$dash_app_dir = OC::$DOCUMENTROOT.OC::$APPSWEBROOT.'/apps/'.$app.'/dashboards';
	if(is_dir($dash_app_dir) && file_exists($dash_app_dir.'/info.xml')){
    	$xml = new DOMDocument();
		$xml->load($dash_app_dir.'/info.xml');
		$dashboards = $xml->getElementsByTagName('dashboard');
		foreach($dashboards as $dashboard){
			$key = $dashboard->getElementsByTagName('appid');
		  	$appid = $key->item(0)->nodeValue;
			$key = $dashboard->getElementsByTagName('name');
		  	$name = $key->item(0)->nodeValue;
			$key = $dashboard->getElementsByTagName('file');
		  	$file = $key->item(0)->nodeValue;
			$key = $dashboard->getElementsByTagName('js');
		  	$js = $key->item(0)->nodeValue;
			
			$r['r'] .= '<div class="dashlist-elt"><input type="radio" name="dashlist_elt" data-appid="'.$appid.'" data-js="'.$js.'" data-file="'.$file.'" value="">'.$name.'</div>';
		}
	}
}
if(strlen($r['r']) == 0){
	$r['r'] = 'No dashboards found !';
}

OCP\JSON::encodedPrint($r);
