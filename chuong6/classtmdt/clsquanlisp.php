<?php
include_once '../../classtmdt/clstmdt.php';

class clsquanlisp extends clstmdt
{
    public function DanhSachSanPham()
    {
        return $this->xuatdulieu("SELECT * FROM sanpham ORDER BY idsp desc");
    }
    public function DanhSachCongTy_combox()
    {
        return $this->xuatdulieu("SELECT * FROM congty ORDER BY tencty asc");
    }

    public function UploadFile($name, $tmp_name, $target_dir)
    {
        $target_file = $target_dir . '/' . basename($name);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($_FILES['myfile']['size'] > 2097152) {
            echo "Kích thước tệp vượt quá 2MB.";
            return 0;
        }

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_type, $allowed_types)) {
            echo "Chỉ cho phép tải lên các tệp JPG, JPEG, PNG hoặc GIF.";
            return 0;
        }

        if (move_uploaded_file($tmp_name, $target_file)) {
            return 1;
        } else {
            echo "Đã xảy ra lỗi khi tải tệp lên.";
            return 0;
        }
    }
    public function XoaSanPham($idsp)
    {
        return $this->thucthisql("DELETE FROM sanpham WHERE idsp = '$idsp'");
    }
}
