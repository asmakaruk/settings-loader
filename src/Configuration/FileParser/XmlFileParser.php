<?php
/**
 * Class XmlFileParser
 * @package Configuration\FileParser
 * @author Alexandr Makaruk <a.s.makaruk@gmail.com>
 */


namespace Configuration\FileParser;


use Configuration\Exception\ParseException;

class XmlFileParser extends AbstractFileParser
{
    /**
     * Parses an XML file as an array
     *
     * @param $path
     * @return array
     * @throws ParseException
     */

    public static function parse($path)
    {
        libxml_use_internal_errors(true);
        $data = simplexml_load_file($path, null, LIBXML_NOERROR);
        if ($data === false) {
            $errors      = libxml_get_errors();
            $latestError = array_pop($errors);
            throw new ParseException($latestError);
        }
        $data = json_decode(json_encode($data), true);
        return self::normalizeData($data);
    }
}