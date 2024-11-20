<?php include '../../partical/header.php' ?>

<div class="main">
    <?php include '../../partical/nav.php' ?>

    <div class="content">
        <?php
        $idkhachhang = $_SESSION['iduser'];
        $arrgiohang = $kh->XemGioHang($idkhachhang);

        if (!empty($arrgiohang)) {
        ?>
            <table style="width: 800px;" border="1" align="center" cellpadding="5" cellspacing="0">
                <tr>
                    <td colspan="9" align="center" valign="middle">GIỎ HÀNG</td>
                </tr>
                <tr>
                    <td align="center" valign="middle">STT</td>
                    <td align="center" valign="middle">Mã đơn hàng</td>
                    <td align="center" valign="middle">Ngày đặt</td>
                    <td align="center" valign="middle">Sản phẩm</td>
                    <td align="center" valign="middle">Số lượng</td>
                    <td align="center" valign="middle">Đơn giá</td>
                    <td align="center" valign="middle">Giảm giá</td>
                    <td align="center" valign="middle">Trạng thái</td>
                    <td align="center" valign="middle">Thay đổi</td>
                </tr>
                <?php
                $stt = 1;
                $total = 0;
                foreach ($arrgiohang as $item) {
                    $madonhang = $item['iddh'];
                    $ngaydat = $item['ngaydathang'];
                    $idsanpham = $item['idsp'];
                    $tensanpham = $kh->laytheodieukien("SELECT tensp FROM sanpham WHERE idsp='$idsanpham' limit 1", 'tensp');
                    $soluong = $item['soluong'];
                    $dongia = $item['dongia'];
                    $giamgia = $item['giamgia'];
                    $trangthai = $item['trangthai'];
                    $tonggia = $soluong * $dongia - $soluong * $giamgia / 100;
                    $total += $tonggia;
                ?>
                    <tr>
                        <td align="center" valign="middle"><?php echo $stt++; ?></td>
                        <td align="center" valign="middle"><?php echo $madonhang; ?></td>
                        <td align="center" valign="middle"><?php echo $ngaydat; ?></td>
                        <td align="center" valign="middle"><?php echo $tensanpham; ?></td>
                        <td align="center" valign="middle"><?php echo $soluong; ?></td>
                        <td align="center" valign="middle"><?php echo number_format($dongia, 0, ',', '.'); ?> $</td>
                        <td align="center" valign="middle"><?php echo $giamgia; ?></td>
                        <td align="center" valign="middle">
                            <?php if ($trangthai == 0) {
                                echo 'Chờ duyệt';
                            } else {
                                echo 'Đợi nhận hàng';
                            } ?>
                        </td>
                        <td align="center" valign="middle">
                            <a href="../khachhang/thaydoidonhang.php?iddh=<?php echo $madonhang; ?>">Yes</a>
                        </td>

                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="9" align="center" valign="middle">
                        Tổng Cộng: <?php echo number_format($total, 0, ',', '.'); ?> $ <br><br>
                        <form action="" method="post"><input type="submit" name="sbxacnhandathang" id="sbxacnhandathang" value="Xác nhận đặt hàng"></form>
                    </td>
                </tr>
            </table>
        <?php
            if (isset($_POST['sbxacnhandathang'])) {
                if ($_POST['sbxacnhandathang'] == 'Xác nhận đặt hàng') {
                    if ($kh->thucthisql("UPDATE dathang set  trangthai='1' WHERE idkh='$idkhachhang' and trangthai='0'") == 1) {
                        $_SESSION['xacnhan-dathang'] = "<p style='text-align: center;' ><-----|  Đã duyệt đơn hàng thành công  |-----></p>";
                        $_SESSION['iduser'] = $idkhachhang;
                        header("Location: ../khachhang/capnhatdiachi.php");
                    } else {
                        "<p style='text-align: center;' >Đã duyệt đơn hàng thất bại.</p>";
                    }
                }
            } else {
                echo '';
            }
        } else {
            echo "<p style='text-align: center;' >Giỏ hàng của bạn hiện tại đang trống.</p>";
        }
        ?>

    </div>
</div>

<?php include '../../partical/footer.php' ?>