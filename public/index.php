<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 04/01/2019
 * Time: 08:28
 */

require '../core/config.php';
require '../core/db.php';
require '../core/Model.php';

echo constant('PATH_REQUIRE');

echo '<br/>';

echo constant('PATH');

echo '<br/>';

$db = new \Core\Model();
$db->getConnection();