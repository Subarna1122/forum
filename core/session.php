<?php

namespace app\core;
class Session
{
    protected const FLASH_KEY = "flash_messages";
    public function __construct()
    {
        session_start();
        $flashMessage = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessage as $keys => &$flashMessage) {

            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessage;

    }
    public function setFlash($key, $message)
    {
        $_SESSION[SELF::FLASH_KEY][$key] = [
            'remove' => true,
            'value' => $message
        ];
    }
    public function getFlash($key)
    {
       return [self::FLASH_KEY][$key]['value'] ?? false;
    }
    public function __destruct()
    {
        $flashMessage = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessage as $keys => &$flashMessage) {

            if ($flashMessage['remove']) {
                unset($flashMessage[$keys]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessage;
    }
}