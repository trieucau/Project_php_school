<?php include '../../partical/header.php' ?>

<div class="main">
    <?php include '../../partical/nav.php' ?>

    <div class="content">
        <?php
        if (isset($_REQUEST['idsp'])) {

            $idsp = $_REQUEST['idsp'];
        } else {
            $idsp = '';
        }

        $chitiet = $kh->XemChiTietSP($idsp);
        for ($j = 0; $j < count($chitiet); $j++) {
        ?>
            <h4 style="text-align: center;">XEM CHI TIẾT SẢN PHẨM</h4>
            <div class="noidung">
                <div class="divleft">
                    <img src="../../images/<?php echo $chitiet[0]['hinh']; ?>" alt="">
                </div>
                <div class="divright">
                    <form action="#" method="post">
                        <table class="tablechitiet">
                            <tr>
                                <td><strong><?php echo $chitiet[0]['tensp']; ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Công ty: </strong><?php echo $chitiet[0]['idcty']; ?></td>
                            </tr>
                            <tr>
                                <td><Strong>Mô tả: </Strong><?php echo $chitiet[0]['mota']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Gía: </strong><?php echo $chitiet[0]['gia']; ?>$</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Số lượng: </strong>
                                    <input name="txtsoluong" id="txtsoluong" type="number" value="1" size="2" style="width: 50px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="sbDathang" id="sbDathang" value="Đặt hàng">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <!-- sử lí form -->
                    <?php
                    if (isset($_POST['sbDathang'])) {
                        if ($_POST['sbDathang'] === 'Đặt hàng') {
                            $idkhachhang = $_SESSION['iduser'];
                            $idsanpham = $_REQUEST['idsp'];
                            $soluong = $_REQUEST['txtsoluong'];
                            $ngaydathang = date('Y-m-d H:i:s');

                            if ($idkhachhang != 0) {
                                $kq = $kh->thucthisql("INSERT INTO dathang(idkh, ngaydathang, trangthai) VALUES ('$idkhachhang', '$ngaydathang','0')");
                                if ($kq == 1) {
                                    $iddathang = $kh->laytheodieukien("SELECT iddh FROM dathang WHERE idkh='$idkhachhang' ORDER BY iddh desc limit 1 ", "iddh");
                                    $dongia = $kh->laytheodieukien("SELECT gia FROM sanpham WHERE idsp='$idsanpham' ORDER BY gia limit 1 ", "gia");
                                    $giamgia = $kh->laytheodieukien("SELECT giamgia FROM sanpham WHERE idsp='$idsanpham' ORDER BY giamgia limit 1 ", "giamgia");

                                    $kq1 = $kh->thucthisql("INSERT INTO dathang_chitiet(iddh,idsp, soluong, dongia,giamgia) VALUES ('$iddathang','$idsanpham', '$soluong','$dongia','$giamgia')");
                                    if ($kq1 == 1) {

                                        if (!isset($_SESSION['thongbao-giohang'])) {
                                            $_SESSION['thongbao-giohang'] = $soluong;
                                        } else {
                                            $_SESSION['thongbao-giohang'] += $soluong;
                                        }
                                        echo '<div class="success">Đặt hàng thành công.</div>';
                                    } else {
                                        echo '<div class="error">Đặt hàng thất bại.</div>';
                                    }
                                } else {
                                    echo '<div class="error">Lỗi đặt hàng.</div>';
                                }
                            }
                        }
                    } else {
                        echo '';
                    }
                    ?>
                </div>

            </div>
            <div style="  position: absolute; bottom: 0;  left: 50%; transform: translateX(-50%); padding: 10px 0; ">
                <a style="text-decoration: none; color: black;" href="../trangchu/index.php">Quay lại danh sách</a>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php include_once '../../partical/footer.php' ?>