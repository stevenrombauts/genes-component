Genes Component
===============

The Genes component is a reusable component for [Nooku Framework](http://www.nooku.org). This is an *example*!

By installing this component you can easily re-use the functionality its classes offer in your own components.

## Installing

You can install this extension using Composer. Add the following requirements to your `composer.json` file in your Joomla application's root directory:

```json
{
    "require": {        
        "stevenrombauts/genes-component": "dev-master"
    },
    "minimum-stability": "dev"
}
```

Run `composer install` to take care of downloading and installing the package.

## Examples

### Gene entity

Having your entities extend the `ComGenesModelEntityGene` class will automatically add support for translating the DNA sequence into a protein sequence. Or call it directly:

```php
$sequence = <<<EOL
> A sequence
ATGCAGACTGACGATTCTTGGAAACATAATGTGTCGTTTTATACA
AATTTGGACTACACCGATAAGGATACCAAAATCAGTGCAGTTTAA
EOL;

$data = array(
     'identifier' => 'C02H7.2',
     'title'      => 'npr-19',
     'sequence'   => $sequence
);

$entity = KOBjectManager::getInstance()->getObject('com://stevenrombauts/genes.model.entity.gene', array('data' => $data));

echo $entity->protein;
```

### Fasta filter

You can use the [FASTA](https://en.wikipedia.org/wiki/FASTA_format) filter to validate and sanitize strings representings nucleotide sequences or peptide sequences. 

Example:

```php
$filter = KObjectManager::getInstance()->getObject('com://stevenrombauts/genes.filter.fasta');

$sequence = <<<EOL
> LCBO - Prolactin precursor - Bovine
; a sample sequence in FASTA format
MDSKGSSQKGSRLLLLLVVSNLLLCQGVVSTPVCPN
EMFNEFDQVIPGAKETEPYPVWSGLPSLQTKDED
ARYSAFYNLLHCLRRDSSKIDTYLKLLNCRIIYNNNC*
EOL;

// This one should be valid:
echo ($filter->validate($sequence) === true ? "Valid sequence" : "Invalid sequence");

// Sanitizing will remove all characters that don't belong (line-breaks, comments, etc ..):
echo $filter->sanitize($sequence);
```