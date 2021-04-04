<?php

include_once __DIR__ . "/../Mysql.php";

class getInfo extends Mysql
{
    private User $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * getInfo constructor.
     */
    public function __construct()
    {
        try {
            $this->sql = parent::__construct();
            $user = $this->getUserId();

            if ($user->getId() < 1 || is_null($user->getId())) throw new RuntimeException("User not found;");

            $this->setUser($this->getUserInfo($user->getId()));

        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    private function getUserId(): User
    {
        try {
            $stmt = $this->prepare("select user_id from token where token = ?");
            $stmt->bind_param("s", $_COOKIE['token']);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            if (is_null($result)) throw new RuntimeException('user not found');
            return new User($result['user_id']);
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    private function getUserInfo($id): User
    {
        try {
            $stmt = $this->prepare("select * from users inner JOIN token t on users.id = t.user_id where token = ? and user_id = ?;");
            $stmt->bind_param("si", $_COOKIE['token'], $id);
            $stmt->execute();
            if ($stmt->errno != 0) throw new RuntimeException($stmt->error, $stmt->errno);
            $result = $stmt->get_result()->fetch_assoc();

            $stmt->close();
            if (is_null($result)) throw new RuntimeException('user not found');

            return new User($result['id'], $result['fio'], $result['login'], $result['email'], $result['passwd'], $result['user_type'], $result['token']);
        } catch (RuntimeException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }
}
