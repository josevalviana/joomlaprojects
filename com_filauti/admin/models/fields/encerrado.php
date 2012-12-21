<?php

defined('JPATH_BASE') or die;

class JFormFieldEncerrado extends JFormField
{
    protected $type = 'Encerrado';
    
    protected function getInput()
    {
        $onclick = ' onclick="document.id(\''.$this->id.'\').value=\'1\';"';
        
        return '<input type="hidden" name="'.$this->name.'" id="'.$this->id.'" value="'.htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8').'" readonly="readonly" /> <a class="btn" '.$onclick.'><i class="icon-refresh"></i> '.JText::_('COM_FILAUTI_ENCERRAR').'</a>';
    }
}