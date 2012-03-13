<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formrule');

class JFormRuleIntegerOnly extends JFormRule
{
    protected $regex = '\b\d+\b';
}
?>
