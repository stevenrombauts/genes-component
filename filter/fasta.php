<?php
/**
 * Fasta Filter
 *
 * @link    https://en.wikipedia.org/wiki/FASTA_format
 * @author  Steven Rombauts <https://github.com/stevenrombauts>
 */
// @TODO add flag to sanitize using amino acid codes or nucleic acid codes
class ComGenesFilterFasta extends KFilterAbstract
{
    protected $_pattern = '/^([\>;].*\r?\n?)+([A-Z\-\r\n]+\*?)$/i';

    public function validate($data)
    {
        $value = trim($data);

        return (is_string($value) && (preg_match($this->_pattern, $value)) == 1);
    }

    public function sanitize($data)
    {
        $result = preg_match($this->_pattern, $data, $matches);

        if(!$result) {
            return '';
        }

        array_shift($matches);
        $heading = '';
        switch(count($matches))
        {
            case 2:
                $heading = $matches[0];
                $body    = $matches[1];
                break;
            case 1:
                $body    = $matches[0];
                break;
        }

        $heading = trim($heading);
        if(substr($heading, 0, 1) != '>' || $heading == '>' || empty($heading)) {
            $heading = '>SEQUENCE';
        }

        // If the end of the sequence is marked by an asterix, remove it.
        if(substr($body, -1) == '*') {
            $body = substr($body, 0, -1);
        }

        // Remove all invalid characters from the body
        $body = preg_replace('/[^A-Z-]/', '', $body);

        // Add line breaks in the protein sequence, max 80 chars per line
        $lines = str_split($body, 80);
        $body = implode("\n", $lines);

        return $heading . "\n" . $body;
    }
}