<?php

namespace phplogin\model\traits;
include $_SERVER['DOCUMENT_ROOT'] . '/smart/phplogin/Config.php';

use phplogin\Config;

trait Queryable
{
    /**
     * @param $table
     * @param $data
     * @return array|false|null
     */
    public static function createData($table, $data)
    {
        $columns = array_keys($data);
        $values = array_values($data);
        $colnames = implode("`, `", $columns);
        $colvals = implode("', '", $values);
        $conn = Config::connect();
        $sql = <<<SQL
 INSERT INTO {$table}(`$colnames`)
VALUES ('$colvals')
SQL;
        $conn->query($sql);
        $insertId = $conn->insert_id;
        $sql = <<<SQL
 select * from {$table}
 where id = $insertId
SQL;
        return $conn->query($sql)->fetch_assoc();
    }

    /**
     * @param $table
     * @param $data
     * @return void
     */
    public static function createMultiple($table, $data)
    {
        $conn = Config::connect();
        $columns = array_keys($data[0]);
        $colnames = implode("`, `", $columns);
        $colvals = "";
        foreach ($data as $datum) {
            $values = implode('","', array_values($datum));
            $colvals .= $colvals !== "" ? ',("' . $values . '")' : '("' . $values . '")';
        }
        $sql = <<<SQL
INSERT INTO {$table}(`$colnames`)   
VALUES $colvals
SQL;
        return $conn->query($sql);
    }

    public static function createMultiPlePivot($table, $data)
    {
        $conn = Config::connect();
        $columns = array_keys($data[0]);
        $colnames = implode("`, `", $columns);
        $colvals = "";
        foreach ($data as $datum) {
            $values = implode('","', array_values($datum));
            $colvals .= $colvals !== "" ? ',("' . $values . '")' : '("' . $values . '")';
        }
        $sql = <<<SQL
INSERT INTO {$table}(`$colnames`)   
VALUES $colvals
SQL;

        return $conn->query($sql);
    }

    public static function selectMultiple($table, $data)
    {
        $colvals = '';
        $columns = array_keys($data[0]);
        $colnames = implode("`, `", $columns);
        $conn = Config::connect();
        foreach ($data as $datum) {
            $values = implode('","', array_values($datum));
            $colvals .= $colvals != "" ? ' OR (' . $colnames . ') = (' . $values . ')' : '(' . $values . ')';

        }
        $sql = "SELECT * FROM {$table}  WHERE ({$colnames}) = {$colvals}";
        return $conn->query($sql);
    }

    public static function selectpivote($id)
    {
        $conn = Config::connect();
        $sql = "SELECT users.id, c.id as categoryId, users.name as user_name, q.content, c.name as category_name, answer, tu.point
FROM users
         join test_user tu on users.id = tu.user_id
         join category c on tu.category_id = c.id
         join questions q on c.id = q.category_id
         join answers a on q.id = a.questions_id where a.correct = 1 and user_id = $id";
        return $conn->query($sql);
    }

    public static function selectcategorypivote($id)
    {
        var_dump(1111111);
        $conn = Config::connect();
        $sql = "SELECT users.id, c.id as categoryId, users.name as user_name, q.content, c.name as category_name, answer, tu.point
FROM users
         join test_user tu on users.id = tu.user_id
         join category c on tu.category_id = c.id
         join questions q on c.id = q.category_id
         join answers a on q.id = a.questions_id where a.correct = 1 and c.id = $id";
        return $conn->query($sql);
    }

    public static function selectpivoteadmin()
    {
        $conn = Config::connect();
        $sql = "SELECt  u.name as user_name, c.name as category, test_user.point from test_user join users u on test_user.user_id = u.id join category c on c.id = test_user.category_id";
        return $conn->query($sql);
    }

    /**
     * @param $table
     * @param $data
     * @return bool|mysqli_result
     */
    public static function create($table, $data)
    {
        $columns = array_keys($data);
        $values = array_values($data);
        $colnames = implode("`, `", $columns);
        $colvals = implode("', '", $values);
        $conn = Config::connect();
        $sql = <<<SQL
 INSERT INTO {$table['table']}(`$colnames`)
VALUES ('$colvals')
SQL;
        $result = $conn->query($sql);
        return $result;
    }

    /**
     * @param $userId
     * @return array|false|null
     */
    public static function getRoles($userId)
    {
        $conn = Config::connect();
        $sql = "SELECT role_user.id as role_user_id,  users.id as user_id,
                users.email, users.password, role_user.role_id as role_id
                from users
                inner join role_user on role_user.user_id = users.id
                inner join role r on role_user.role_id = r.id  where role_user.user_id = $userId";
        $results = $conn->query($sql);
        $row = $results->fetch_assoc();

        return $row;
    }

    /**
     * @return bool|mysqli_result
     */
    public static function getAllUsers()
    {
        $conn = Config::connect();
        $sql = "SELECT * FROM users";
        $results = $conn->query($sql);
        $results->fetch_assoc();
        return $results;
    }

    /**
     * @param $table
     * @param $data
     * @return array|false|null
     */
    public static function getWhere($table, $data)
    {
        $conn = Config::connect();
        $where = '';
        $index = 0;
        foreach ($data as $column => $value) {
            if ($index < 1) {
                $where .= "WHERE `$column` = '{$value}'";
            } else {
                $where .= " OR `$column` = '{$value}'";
            }
            $index++;
        }
        $sql = "SELECT * FROM {$table['table']} $where";
        $result = $conn->query($sql)->fetch_assoc();
        return $result;
    }

    public static function gettests($table, $data)
    {
        $conn = Config::connect();
        $where = '';
        $index = 0;
        foreach ($data as $column => $value) {
            if ($index < 1) {
                $where .= "WHERE `$column` = '{$value}'";
            } else {
                $where .= "OR `$column` = '{$value}'";
            }
            $index++;
        }
        $sql = "SELECT * FROM {$table['table']} $where";
        $result = $conn->query($sql);
        return $result;
    }

    /**
     * @param $table
     * @param $data
     * @return bool|mysqli_result
     */
    public static function update($table, $data)
    {
        $conn = Config::connect();
        $set = '';
        $where = '';
        $index = 0;
        foreach ($data as $column => $value) {
            if ($index < 1) {
                $set .= "`$column` = '{$value}',";
            } elseif ($index < 2) {
                $set .= "`$column` = '{$value}'";
            } else {
                $where .= " `$column` = '{$value}'";
            }
            $index++;
        }
        $sql = "UPDATE {$table['table']} SET $set WHERE $where";
        $res = $conn->query($sql);
        return $res;
    }

    /**
     * @param $table
     * @param $data
     * @return bool|mysqli_result
     */
    public static function delete($table, $data)
    {

        $columns = array_keys($data);
        $values = array_values($data);
        $colnames = implode("`, `", $columns);
        $colvals = implode("', '", $values);
        $conn = Config::connect();
        $sql = "DELETE FROM {$table['table']}  WHERE `$colnames` = $colvals";
        $res = $conn->query($sql);
        return $res;
    }

    /**
     * @return bool|mysqli_result
     */
    public static function getAll($table)
    {
        $conn = Config::connect();
        $sql = "SELECT * FROM $table";
        $results = $conn->query($sql);
        $results->fetch_assoc();
        return $results;
    }
}
