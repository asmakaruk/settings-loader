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
pre(\Configuration\Settings::load($iniFile));
echo "<br />";
echo "JSON: <br />";
$jsonFile = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'config.json';
pre(\Configuration\Settings::load($jsonFile));
echo "<br />";

echo "PHP: <br />";
$phpFile = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'config.php';
pre(\Configuration\Settings::load($phpFile));
echo "<br />";

echo "XML: <br />";
$xmlFile = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'config.xml';
pre(\Configuration\Settings::load($xmlFile));
echo "<br />";

echo "[INI, PHP]: <br />";
pre(\Configuration\Settings::load([$iniFile, $phpFile]));
echo "<br />";

echo "[FOLDER]: <br />";
$folder = __DIR__ . DIRECTORY_SEPARATOR . 'files' ;
pre(\Configuration\Settings::load($folder));
echo "<br />";

echo "GET: <br />";
pre(\Configuration\Settings::get('php'));
echo "<br />";
pre(\Configuration\Settings::get('ini.app.timezone'));
echo "<br />";
pre(\Configuration\Settings::get('ini.app.host', 'localhost'));