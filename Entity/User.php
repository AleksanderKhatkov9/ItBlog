<?php

class User
{
    private $fio;
    private $login;
    private $password;
    private $email;

    /**
     * User constructor.
     * @param $fio
     * @param $login
     * @param $password
     * @param $email
     */
    public function __construct($fio, $login, $password, $email)
    {
        $this->fio = $fio;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFio()
    {
        return $this->fio;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
}