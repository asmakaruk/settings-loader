<?php
/**
 * Class Loader
 * @package MarykSoft\Settings
 * @author Alexandr Makaruk <a.s.makaruk@gmail.com>
 */


namespace MarykSoft\Settings;

use MarykSoft\Settings\Exception\EmptyDirectoryException;
use MarykSoft\Settings\Exception\FileNotFoundException;
use MarykSoft\Settings\Exception\UnsupportedFormatException;

class Loader
{
    /** @var null|Loader */
    protected static $_instance             = null;

    /** @var array Storage */
    protected static $_data                 = [];

    /**
     * @var [] Supported file parsers
     */
    protected static $supportedFileParser   = [
        'ini'   => 'MarykSoft\Settings\FileParser\IniFileParser',
        'json'  => 'MarykSoft\Settings\FileParser\JsonFileParser',
        'php'   => 'MarykSoft\Settings\FileParser\PhpFileParser',
        'xml'   => 'MarykSoft\Settings\FileParser\XmlFileParser',
    ];

    public static function load($path)
    {
        if ( is_null(self::$_instance) ) {
            self::$_instance = new self();
        }
        $_paths     = self::$_instance->getValidPaths($path);
        $data       = [];
        foreach ( $_paths AS $_path ) {
            //Get file information
            $info       = pathinfo($_path);
            $extension  = isset($info['extension']) ? $info['extension'] : '';
            $parser     = self::$_instance->getFileParser($extension);
            // Try and load file
            $data       = array_replace_recursive($data, call_user_func([$parser, 'parse'], $_path));
        }

        return $data;
    }

    public function get($key, $default = null)
    {

    }


    protected function getFileParser($extension)
    {
        if ( ! in_array($extension, array_keys(self::$supportedFileParser)) ) {
            throw new UnsupportedFormatException("Unsupported configuration format: [$extension]");
        }
        return self::$supportedFileParser[$extension];
    }

    protected function getValidPaths($path)
    {
        if ( is_array($path) ) {
            $paths = [];
            foreach ( $path AS $unCheckedPath ) {
                try {
                    $paths = array_merge($paths, self::$_instance->getValidPaths($unCheckedPath));
                    continue;
                } catch ( FileNotFoundException $e ) {
                    throw $e;
                }
            }
            return $paths;
        }

        // If `$path` is a directory
        if ( is_dir($path) ) {
            $paths = glob($path . '/*.*');
            if (empty($paths)) {
                throw new EmptyDirectoryException("Configuration directory: [$path] is empty");
            }
            return $paths;
        }

        // If `$path` is not a file, throw an exception
        if ( is_file($path) ) {
            return [$path];
        }
        $_includePaths = explode(PATH_SEPARATOR, get_include_path());
        $paths = [];
        foreach ( $_includePaths AS $_path ) {
            $_file = $_path . DIRECTORY_SEPARATOR . $path;
            if ( is_file($_file) ) {
                $paths[] = $_file;
            }
        }


        if ( empty($paths) ) {
            throw new FileNotFoundException("Configuration file: [$path] cannot be found");
        }
        return $paths;
    }


    /**
     * Disable create new instance
     */
    private function __construct(){}

    /**
     * Disable cloning
     */
    private function __clone(){}
}