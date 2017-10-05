<?php

namespace Core\Notify;


use Core\Session\SessionInterface;

class Flash
{

    private $session;

    private $messages = null;

    private $key = 'flash';

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function success(string $message) {
        $flash = $this->session->get($this->key, []);
        $flash['success'] = $message;
        $this->session->set($this->key, $flash);
    }

    public function error(string $message) {
        $flash = $this->session->get($this->key, []);
        $flash['error'] = $message;
        $this->session->set($this->key, $flash);
    }

    public function warning(string $message) {
        $flash = $this->session->get($this->key, []);
        $flash['warning'] = $message;
        $this->session->set($this->key, $flash);
    }

    public function info(string $message) {
        $flash = $this->session->get($this->key, []);
        $flash['info'] = $message;
        $this->session->set($this->key, $flash);
    }

    public function get(string $type): ?string {
        if(is_null($this->messages)){
            $this->messages = $this->session->get($this->key, []);
            $this->session->delete($this->key);
        }
        if (array_key_exists($type, $this->messages)){
            return $this->messages[$type];
        }
        return null;
    }


}