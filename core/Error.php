<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 16/01/2019
 * Time: 00:39
 */

namespace Core;


/**
 * Class Error
 * @package App\Controller
 */
class Error
{
    /**
     * @param $level
     * @param $message
     * @param $file
     * @param $line
     * @throws \ErrorException
     */
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * @param $exception
     */
    public static function exceptionHandler($exception)
    {
        if (\App\Config::SHOW_ERRORS) {
            echo '<h1>Fatal error</h1>';
            echo '<p>Uncaught exception : ' . get_class($exception) . '</p>';
            echo '<p>Message: ' . $exception->getMessage() . '</p>';
            echo '<p>Stack trace: <pre> ' . $exception->getTraceAsString() . '</pre></p>';
            echo '<p>Thrown in ' . $exception->getFile() . ' on line ' . $exception->getLine() . '</p>';
        } else {
            $log = dirname(__DIR__) . '/log/' . date('d-m-Y') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

            error_log($message);
            echo '<h1>An error occured</h1>';

        }
    }
}