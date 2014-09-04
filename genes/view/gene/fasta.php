<?php
namespace Nooku\Component\Genes;

use Nooku\Library;

class ViewGeneFasta extends Library\ViewAbstract
{
    public function render()
    {
        $row = $this->getModel()->getRow();

        $this->_content = empty($row->cdna_sequence) ? $row->wormbase_cdna_sequence : $row->cdna_sequence;

        if(empty($this->_content)) {
            $this->_content = '> ' . $row->name;
        }

        return parent::render();
    }
}
