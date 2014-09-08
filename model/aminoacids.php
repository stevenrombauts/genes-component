<?php

// @link http://en.wikipedia.org/wiki/Stop_codon
// @link http://www.hgvs.org/mutnomen/codon.html
// @link http://www.techcuriosity.com/resources/bioinformatics/dna2protein.php
// @link http://www.bioon.com/book/biology/Beginning%20Perl%20for%20Bioinformatics/76.htm
class ComGenesModelAminoAcids extends KModelAbstract
{
    protected $_codons = array(
        'TCA' => 'S','TCC' => 'S','TCG' => 'S','TCT' => 'S','TTC' => 'F','TTT' => 'F','TTA' => 'L','TTG' => 'L','TAC' => 'Y',
        'TAT' => 'Y','TAA' => '*','TAG' => '*','TGC' => 'C','TGT' => 'C','TGA' => '*','TGG' => 'W','CTA' => 'L','CTC' => 'L',
        'CTG' => 'L','CTT' => 'L','CCA' => 'P','CCC' => 'P','CCG' => 'P','CCT' => 'P','CAC' => 'H','CAT' => 'H','CAA' => 'Q',
        'CAG' => 'Q','CGA' => 'R','CGC' => 'R','CGG' => 'R','CGT' => 'R','ATA' => 'I','ATC' => 'I','ATT' => 'I','ATG' => 'M',
        'ACA' => 'T','ACC' => 'T','ACG' => 'T','ACT' => 'T','AAC' => 'N','AAT' => 'N','AAA' => 'K','AAG' => 'K','AGC' => 'S',
        'AGT' => 'S','AGA' => 'R','AGG' => 'R','GTA' => 'V','GTC' => 'V','GTG' => 'V','GTT' => 'V','GCA' => 'A','GCC' => 'A',
        'GCG' => 'A','GCT' => 'A','GAC' => 'D','GAT' => 'D','GAA' => 'E','GAG' => 'E','GGA' => 'G','GGC' => 'G','GGG' => 'G',
        'GGT' => 'G'
    );

    public function __construct(KObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('codon', 'string');
    }

    protected function _actionFetch(KModelContext $context)
    {
        $codon = strtoupper($this->getState()->codon);

        if(empty($codon) || !isset($this->_codons[$codon])) {
            throw new \RuntimeException('Unknown codon '.$codon);
        }

        return $this->_codons[$codon];
    }
}
