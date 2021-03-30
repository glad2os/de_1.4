<?php

include_once __DIR__ . "/Mysql.php";
include_once __DIR__ . "/../exceptions/AccessForbidden.php";

class signIn extends Mysql
{
    private $sql;

    /**
     * signIn constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        try {
            $this->sql = parent::__construct();
            if ($this->checkLoginAndPasswd($user->getLogin(), $user->getPasswd()) == 0) {
                throw new AccessForbidden();
            } else {
                $userId = $this->getUserId($user->getLogin(), $user->getPasswd());
                $token = $this->regToken($userId);
                setcookie("token", $token, time() + 3600, "/");
            }
        } catch (RuntimeException $exception) {
            throw new RuntimeException(json_encode(['error' => $exception->getMessage()]));
        }
    }

    function generateRandomString($length = 32): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-+=|';
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

    private function checkLoginAndPasswd($login, $passwd)
    {
        try {
            $stmt = $this->prepare("select count(id) from users where login = ? and passwd = ?");
            $stmt->bind_param("ss", $login, $passwd);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
            $stmt->close();
            return $result;
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    private function getUserId($login, $passwd): int
    {
        try {
            $stmt = $this->prepare("select id from users where login = ? and passwd = ?");
            $stmt->bind_param("ss", $login, $passwd);
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