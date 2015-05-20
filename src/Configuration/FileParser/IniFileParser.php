<?php
/**
 * Class IniFileParser
 * @package Configuration\FileParser
 * @author Alexandr Makaruk <a.s.makaruk@gmail.com>
 */


namespace Configuration\FileParser;


use Configuration\Exception;

class IniFileParser extends AbstractFileParser
{
    /**
     * Parses an INI file as an array
     *
     * @param $path
     * @return array
     * @throws Exception\ParseException
     */
    public static function parse($path)
    {
        $_data = @parse_ini_file($path, true);
        if ( ! $_data ) {
            throw new Exception\ParseException(error_get_last());
        }
        return self::normalizeData($_data);
    }
}