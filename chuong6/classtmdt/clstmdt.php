<?php
class clstmdt
{
    public function connect()
    {
        $host = 'localhost';
        $username = 'root';
        $passwork = '';
        $database = 'tmdt_db';

        $con = new mysqli($host, $username, $passwork, $database);

        if ($con->connect_errno) {
            echo "ket noi that bai";
            exit();
        } else {
            $con->query("SET NAMES 'utf8'");

            return $con;
        }
    }

    public function xuatdulieu($sql)
    {
        $link = $this->connect();
        $result = $link->query($sql);
        $arr = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
        }

        $link->close();
        return $arr;
    }
    public function thucthisql($sql)
    {
        $link = $this->connect();
        if ($link->query($sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function laytheodieukien($sql, $dk)
    {
        $link = $this->connect();
        $result = $link->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (isset($row[$dk])) {
                $link->close();
                return $row[$dk];
            }
        }

        $link->close();
        return null;
    }
}
