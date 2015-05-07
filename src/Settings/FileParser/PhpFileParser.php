<?php
/**
 * Class PhpFileParser
 * @package MarykSoft\Settings\FileParser
 * @author Alexandr Makaruk <a.s.makaruk@gmail.com>
 */


namespace MarykSoft\Settings\FileParser;


use MarykSoft\Settings\Exception\ParseException,
    MarykSoft\Settings\Exception\UnsupportedFormatException,
    Exception;

class PhpFileParser extends AbstractFileParser
{

    /**
     * Loads a PHP file and gets its' contents as an array
     *
     * @param $path
     * @return array
     * @throws ParseException
     * @throws UnsupportedFormatException
     */
    public static function parse($path)
    {
        // Require the file, if it throws an exception, rethrow it
        try {
            $data = require $path;
        } catch (Exception $exception) {
            throw new ParseException(
                array(
                    'message'   => 'PHP file threw an exception',
                    'exception' => $exception,
                )
            );
        }

        // Check for array, if its anything else, throw an exception
        if ( ! $data || ! is_array($data) ) {
            throw new UnsupportedFormatException('PHP file does not return an array');
        }
        return self::normalizeData($data);
    }
}