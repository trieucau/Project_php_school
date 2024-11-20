<?php

include_once '../../classtmdt/clstmdt.php';
class clskhachhang extends clstmdt
{
    public function XemDSCongTy()
    {
        return $this->xuatdulieu("SELECT * FROM congty ORDER BY tencty asc");
    }

    public function XemSanPham($id_congty)

    {

        if ($id_congty != '') {
            return $this->xuatdulieu("SELECT * FROM sanpham WHERE idcty = '$id_congty' ORDER BY gia asc");
        } else {
            return $this->xuatdulieu("SELECT * FROM sanpham ORDER BY gia asc");
        }
    }

    public function XemChiTietSP($id_sanpham)
    {
        //$id_sanpham lay trenn thanh url duoc ma hóa bao bên ngoài id là dấu nháy đơn ' 
        return $this->xuatdulieu("SELECT * FROM sanpham WHERE idsp = $id_sanpham LIMIT 1");
    }

    public function XemGioHang($idkh)
    {
        return $this->xuatdulieu("SELECT dh.iddh , dh.idkh, dh.ngaydathang, dh.trangthai 
            ,ct.idsp, ct.soluong,ct.dongia, ct.giamgia FROM dathang dh, dathang_chitiet ct WHERE 
            dh.iddh = ct.iddh AND dh.trangthai = '0' AND dh.idkh = '$idkh' ");
    }
}
