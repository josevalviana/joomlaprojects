<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.database.table');

class CensoUTITableCensoUTI extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__censouti', 'id', $db);
	}
        
        public function store($updateNulls = false)
        {
            $date = JFactory::getDate();
            $user = JFactory::getUser();
            if ($this->id) {
                // Existing item
                $this->modified     = $date->toSql();
                $this->modified_by  = $user->get('id');
            } else {
                if (!intval($this->created)) {
                    $this->created = $date->toSql();
                }
                if (empty($this->created_by)) {
                    $this->created_by = $user->get('id');
                }
            }
            
            // Attempt to store the data.
            return parent::store($updateNulls);
        }
}