<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formrule');

class JFormRuleGcs extends JFormRule
{
	protected $regex = '^([3-9]|[0-1][0-5])$';
}

?>