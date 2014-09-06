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

### Fasta filter

You can use the [FASTA](https://en.wikipedia.org/wiki/FASTA_format) filter to validate and sanitize nucleotide sequences or peptide sequences. 
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
```