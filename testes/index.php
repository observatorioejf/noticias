<?php
/**
 * Created by PhpStorm.
 * User: danilo.silva
 * Date: 04/08/2017
 * Time: 17:18
 */

require_once 'Request.php';

$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['SERVER_PROTOCOL'], $_SERVER['SERVER_NAME'], $_SERVER['PATH_TRANSLATED'], $_SERVER['QUERY_STRING'], $_SERVER['REDIRECT_STATUS'], $_SERVER['AUTH_TYPE'], $_SERVER['SCRIPT_FILENAME'], $_SERVER['REQUEST_TIME'], $_SERVER['REQUEST_TIME']);

var_dump($request);