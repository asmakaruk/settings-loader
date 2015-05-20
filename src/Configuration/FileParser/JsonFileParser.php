<?php
/**
 * Class JsonFileParser
 * @package Configuration\FileParser
 * @author Alexandr Makaruk <a.s.makaruk@gmail.com>
 */


namespace Configuration\FileParser;

use Configuration\Exception\ParseException;

class JsonFileParser extends AbstractFileParser
{
    /**
     * Loads a JSON file as an array
     *
     * @param $path
     * @return array
     * @throws ParseException
     */
    public static function parse($path)
    {
        $data = json_decode(file_get_contents($path), true);
        if (function_exists('json_last_error_msg')) {
            $errorMessage = json_last_error_msg();
        } else {
            $errorMessage  = 'Syntax error';
        }
        if (json_last_error() !== JSON_ERROR_NONE) {
            $error = error_get_last();
            $error['message'] = $errorMessage;
            throw new ParseException($error);
        }
        return self::normalizeData($data);
    }
}