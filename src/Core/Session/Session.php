<?php

namespace Core\Session;


class Session implements SessionInterface
{


    public function get(string $key, $default = null)
    {
        $this->initSession();
        if(array_key_exists($key, $_SESSION)){
            return $_SESSION[$key];
        }
        return $default;
    }

    public function set(string $key, $value): void
    {
        $this->initSession();
        $_SESSION[$key] = $value;
    }


    public function delete(string $key): void
    {
        $this->initSession();
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }


    private function initSession() :void {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }
}