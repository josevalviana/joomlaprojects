<?php
defined('_JEXEC') or die;

class HospitalsTableHospital extends JTable {
	function __construct(&$_db) {
		parent::__construct('#__hospitals', 'id', $_db);
		$this->created = JFactory::getDate()->toMySQL();
	}
	
	public function store($updateNulls = false) {
		$date = JFactory::getDate();
		$user = JFactory::getUser();
		
		if ($this->id) {
			$this->modified = $date->toMySQL();
			$this->modified_by = $user->get('id');
		} else {
			if (!intval($this->created)) {
				$this->created = $date->toMySQL();
			}
			if (empty($this->created_by)) {
				$this->created_by = $user->get('id');
			}
		}
		
		return parent::store($updateNulls);
	}
	
	/**
	 * Overloaded check function
	 * 
	 * @return boolean
	 * @see JTable::check
	 * @since 1.5
	 */
	function check() {
		if (JFilterInput::checkAttribute(array('href', $this->webpage))) {
			$this->setError(JText::_('COM_HOSPITALS_WARNING_PROVIDE_VALID_URL'));
			return false;
		}
		
		// check for http, https, ftp on webpage
		if ((strlen($this->webpage) > 0)
			&& (stripos($this->webpage, 'http://') === false)
			&& (stripos($this->webpage, 'https://') === false)
			&& (stripos($this->webpage, 'ftp://') === false)) {
			$this->webpage = 'http://'.$this->webpage;
		}
		
		/** check for valid name */
		if (trim($this->name) == '') {
			$this->setError(JText::_('COM_HOSPITALS_WARNING_PROVIDE_VALID_NAME'));
			return false;
		}
		
		/** check for existing name */
		$query = 'SELECT id FROM #__hospitals WHERE name = '.$this->_db->Quote($this->name).' AND catid = '.(int) $this->catid;
		$this->_db->setQuery($query);
		
		$xid = intval($this->_db->loadResult());
		if ($xid && $xid != intval($this->id)) {
			$this->setError(JText::_('COM_HOSPITALS_WARNING_SAME_NAME'));
			return false;
		}
		
		/** check for valid category */
		if (trim($this->catid) == '') {
			$this->setError(JText::_('COM_HOSPITALS_WARNING_CATEGORY'));
			return false;
		}
		
		return true;
	}
}