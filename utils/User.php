<?php


class User
{
    private $id;
    private $fio;
    private $login;
    private $email;
    private $passwd;
    private $user_type;
    private $token;

    /**
     * user constructor.
     * @param int|null $id
     * @param string|null $fio
     * @param string|null $login
     * @param string|null $email
     * @param string|null $passwd
     * @param int|null $user_type
     * @param string|null $token
     */
    public function __construct(int $id = null, string $fio = null,
                                string $login = null, string $email = null,
                                string $passwd = null, int $user_type = null,
                                string $token = null)
    {
        $this->id = $id;
        $this->fio = $fio;
        $this->login = $login;
        $this->email = $email;
        $this->passwd = $passwd;
        $this->user_type = $user_type;
        $this->user_type = $user_type;
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFio()
    {
        return $this->fio;
    }

    /**
     * @param mixed $fio
     */
    public function setFio($fio): void
    {
        $this->fio = $fio;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * @param mixed $passwd
     */
    public function setPasswd($passwd): void
    {
        $this->passwd = $passwd;
    }

    /**
     * @return mixed
     */
    public function getUserType()
    {
        return $this->user_type;
    }

    /**
     * @param mixed $user_type
     */
    public function setUserType($user_type): void
    {
        $this->user_type = $user_type;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }


}