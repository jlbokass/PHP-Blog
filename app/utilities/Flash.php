<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 21/01/2019
 * Time: 17:57
 */

namespace App\Utilities;


class Flash
{
    /**
     * Success message type
     * @var string
     */
    const SUCCESS = 'success';

    /**
     * Information message type
     * @var string
     */
    const INFO = 'info';

    /**
     * Warning message type
     * @var string
     */
    const WARNING = 'warning';

    /**
     * Add a message
     *
     * @param string $message  The message content
     * @param string $type  The optional message type, defaults to SUCCESS
     *
     * @return void
     */
    //public static function addMessage($message)
    public static function addMessage($message, $type = 'success')
    {
        // Create array in the session if it doesn't already exist
        if (! isset($_SESSION['flash_notifications'])) {
            $_SESSION['flash_notifications'] = [];
        }

        // Append the message to the array
        //$_SESSION['flash_notifications'][] = $message;
        $_SESSION['flash_notifications'][] = [
            'body' => $message,
            'type' => $type
        ];
    }

    public static function getMessages()
    {
        if (isset($_SESSION['flash_notifications'])) {
            $message = $_SESSION['flash_notifications'];
            unset($_SESSION['flash_notifications']);

            return $message;
        }
    }
}