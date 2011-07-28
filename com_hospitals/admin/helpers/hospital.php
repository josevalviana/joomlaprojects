<?php
// no direct access
defined('_JEXEC') or die;

class HospitalHelper {
	/**
	 * 
	 * Gets a list of the actions that can be performed.
	 * 
	 * @param	int		The hospital ID.
	 * 
	 * @return	JObject
	 * @since	1.7
	 */
	public static function getActions($hospitalId = 0) {
		$user		= JFactory::getUser();
		$result 	= new JObject;
		
		if (empty($hospitalId)) {
			$assetName = 'com_hospitals';
		} else {
			$assetName = 'com_hospitals.hospital.'.(int) $hospitalId;
		}
		
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);
		
		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}
		
		return $result;
	}
}