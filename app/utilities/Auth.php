<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 20/01/2019
 * Time: 22:40
 */

namespace App\Utilities;

use App\Manager\RememberedLogin;
use App\Manager\UsersManager;

/**
 * Class Auth
 * @package App
 */
class Auth
{
    /**
     * @param $user
     * @param $remember_me
     */
    public static function login($user, $remember_me)
    {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user->id;

        if ($remember_me) {

            if ($user->rememberLogin()) {

                setcookie('remember_me', $user->remember_token, $user->expery_timestamp, '/');
            }
        }
    }

    /**
     *
     */
    public static function logout()
    {
        // Unset all of the session variables.
        $_SESSION = [];

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();

            setcookie(session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();

        static::forgotLogin();
    }

    /**
     *
     */
    public static function rememberRequestedPage()
    {
        $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    }


    /**
     * @return string
     */
    public static function getReturnToPage()
    {
        return $_SESSION['return_to'] ?? '/';
    }


    /**
     * @return mixed
     */
    public static function getUser()
    {
        if (isset($_SESSION['user_id'])) {

            return UsersManager::findById($_SESSION['user_id']);

        } else {

            return static::loginFromRememberCookie();
        }
    }

    public static function getAdmin()
    {
        //
    }

    public static function rememberPost()
    {
        //
    }

    /**
     * @return mixed
     */
    protected static function loginFromRememberCookie()
    {
        $cookie = $_COOKIE['remember_me'] ?? false;

        if ($cookie) {

            $remembered_login = RememberedLogin::findByToken($cookie);

            if ($remembered_login && ! $remembered_login->hasExpired()) {

                $user = $remembered_login->getUser();

                static::login($user, false);

                return $user;
            }
        }
    }


    protected static function forgotLogin()
    {
        $cookie = $_COOKIE['remember_me'] ?? false;

        if ($cookie) {

            $remembered_login = RememberedLogin::findByToken($cookie);

            if ($remembered_login) {

                $remembered_login->delete();
            }

            setcookie('remember_me', '', time() - 3600);
        }
    }


}