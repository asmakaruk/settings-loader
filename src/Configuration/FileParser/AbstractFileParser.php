<?php
/**
 * Class AbstractFileParser
 * @package Configuration\FileParser
 * @author Alexandr Makaruk <a.s.makaruk@gmail.com>
 */


namespace Configuration\FileParser;


class AbstractFileParser
{
    protected static function normalizeData($data)
    {
        $_data = [];

        foreach ($data AS $_key => $_val ) {
            if ( is_array($_val) ) {
                $_val = self::normalizeData($_val);
            }
            $_path = explode('.', $_key);
            $_index = array_shift($_path);
            if ( ! empty ( $_path ) ) {
                $_val = self::normalizeData([implode('.', $_path)    => $_val]);
            }
            $_data = array_replace_recursive($_data, [$_index => $_val]);
        }

        return $_data;
    }
}