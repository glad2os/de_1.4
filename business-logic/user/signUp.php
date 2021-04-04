<?php

/*
 * MODEL
 */

include_once __DIR__ . "/../Mysql.php";

class signUp extends Mysql
{
    private $sql;

    /**
     * signUp constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        try {
            $this->sql = parent::__construct();
            if ($this->checkUserExist($user) == 1) {
                throw new RuntimeException("Пользователь уже зарегистрирован!");
            } else {
                $user->setId($this->regUser($user));
                $user->setToken($this->regToken($user->getId()));
                setcookie("token", $user->getToken(), time() + 3600, "/");
            }
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    function generateRandomString($length = 32): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-+=|/';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function regToken(int $id): string
    {
        $token = $this->generateRandomString();
        try {
            $stmt = $this->prepare("INSERT INTO token (user_id, token) VALUES (?,?)");
            $stmt->bind_param("is", $id, $token);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $stmt->close();
            return $token;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    function regUser(User $user): int
    {
        try {
            $fio = $user->getFio();
            $login = $user->getLogin();
            $email = $user->getEmail();
            $passwd = $user->getPasswd();

            $stmt = $this->prepare("insert into users (fio,login, email ,passwd ) value (?,?,?,?)");
            $stmt->bind_param("ssss", $fio, $login, $email, $passwd);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->insert_id;
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }

    }

    function checkUserExist(User $user)
    {
        try {
            $login = $user->getLogin();

            $stmt = $this->prepare("select count(id) from users where login = ?");
            $stmt->bind_param("s", $login);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }
}