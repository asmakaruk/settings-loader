<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 05.05.2015
 * Time: 23:08
 */

require __DIR__ .  '/../vendor/autoload.php';

function pre($a)
{
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}



echo "INI: <br />";
$iniFile = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'config.ini';
pre(\MarykSoft\Settings\Loader::load($iniFile));
echo "<br />";
echo "JSON: <br />";
$jsonFile = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'config.json';
pre(\MarykSoft\Settings\Loader::load($jsonFile));
echo "<br />";

echo "PHP: <br />";
$phpFile = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'config.php';
pre(\MarykSoft\Settings\Loader::load($phpFile));
echo "<br />";

echo "XML: <br />";
$xmlFile = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'config.xml';
pre(\MarykSoft\Settings\Loader::load($xmlFile));
echo "<br />";

echo "[INI, PHP]: <br />";
pre(\MarykSoft\Settings\Loader::load([$iniFile, $phpFile]));
echo "<br />";

echo "[FOLDER]: <br />";
$folder = __DIR__ . DIRECTORY_SEPARATOR . 'files' ;
pre(\MarykSoft\Settings\Loader::load($folder));
echo "<br />";

echo "GET: <br />";
pre(\MarykSoft\Settings\Loader::get('php'));
echo "<br />";
pre(\MarykSoft\Settings\Loader::get('ini.app.timezone'));
echo "<br />";
pre(\MarykSoft\Settings\Loader::get('ini.app.host', 'localhost'));