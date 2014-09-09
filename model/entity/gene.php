<?php
/**
 * Gene entity
 *
 * @author  Steven Rombauts <https://github.com/stevenrombauts>
 */
class ComGenesModelEntityGene extends KModelEntityAbstract
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'identity_key'    => 'identifier'
        ));

        parent::_initialize($config);
    }

    public function getPropertyProtein()
    {
        $lines = explode("\n", $this->sequence);

        if(isset($lines[0]) && substr($lines[0], 0, 1) == '>') {
            array_shift($lines);
        }

        if(!count($lines)) {
            return;
        }

        $sequence = implode('', $lines);
        $codons  = str_split($sequence, 3);

        // Check if we have a valid start codon
        if($codons[0] != 'ATG') {
            throw new InvalidArgumentException('DNA sequence does not start with the ATG codon!');
        }

        // Check if we have a valid stop codon
        if(!in_array(end($codons), array('TAG','TAA','TGA'))) {
            throw new InvalidArgumentException('DNA sequence does not end with a valid stop codon! (TAG, TAA or TGA)');
        }

        $model = $this->getObject('com://stevenrombauts/genes.model.aminoacids');

        $protein = '';

        reset($codons);
        foreach($codons as $codon) {
            $protein .= $model->codon($codon)->fetch();
        }

        if(substr($protein, -1) == '*') {
            $protein = substr($protein, 0, -1);
        }

        $protein_sequence = '>'.$this->title.'_protein'.PHP_EOL.$protein;

        return $protein_sequence;
    }
}