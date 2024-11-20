<?php
include_once '../../classtmdt/clstmdt.php';
class clslogin extends clstmdt
{
    public function Mylogin($user, $pass)
    {
        $p = md5($pass);
        $link = $this->connect();
        $sql = "SELECT iduser , username, password, phanquyen  FROM taikhoan WHERE username = '$user' and password = '$p'";
        $result = $link->query($sql);
        $num = $result->num_rows;
        if ($num == 1) {
            $row = $result->fetch_assoc();
            $iduser = $row['iduser'];
            $username = $row['username'];
            $password = $row['password'];
            $phanquyen = $row['phanquyen'];

            session_start();
            $_SESSION['iduser'] = $iduser;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['phanquyen'] = $phanquyen;

            return 1;
        } else {
            return 0;
        }
    }
    public function comfirmlogin($iduser, $username, $password, $phanquyen)
    {
        $link = $this->connect();
        $sql = "SELECT iduser  FROM taikhoan WHERE iduser ='$iduser' and username = '$username' and password = '$password' and phanquyen ='$phanquyen' limit 1";

        $result = $link->query($sql);
        $num = $result->num_rows;
        if ($num != 1) {
            header("Location: ../login/index.php");
        }
    }
}
