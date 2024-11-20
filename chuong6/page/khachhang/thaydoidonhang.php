<?php include '../../partical/header.php' ?>

<div class="main">
    <?php include '../../partical/nav.php' ?>

    <div class="content">
        <?php
        $iddh = $_GET['iddh'];
        $idsp = $kh->laytheodieukien("SELECT idsp FROM dathang_chitiet WHERE iddh='$iddh' limit 1", 'idsp');
        // echo $idsp;
        ?>
        <form action="" method="post">
            <table style="width: 600px;" border="1" align="center" cellpadding="5" cellspacing="0">
                <tr>
                    <td colspan="2" align="center" valign="middle">CẬP NHẬT ĐƠN HÀNG</td>
                </tr>
                <tr>
                    <td style="width: 200px;" align="center" valign="middle">Tên sản phẩm</td>
                    <td style="width: 374px;" align="center" valign="middle">
                        <?php echo $kh->laytheodieukien("SELECT tensp FROM sanpham WHERE idsp='$idsp' limit 1", 'tensp'); ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle">Đơn giá</td>
                    <td align="center" valign="middle">
                        <?php echo $kh->laytheodieukien("SELECT gia FROM sanpham WHERE idsp='$idsp' limit 1", 'gia'); ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle">Số lượng</td>
                    <td align="center" valign="middle">
                        <label for="txtsoluong"></label>
                        <input type="number" name="txtsoluong" id="txtsoluong" style="width: 50px;"
                            value="<?php echo $kh->laytheodieukien("SELECT soluong FROM dathang_chitiet WHERE iddh='$iddh' limit 1", 'soluong'); ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center" valign="middle">
                        <input type="submit" name="sbcapnhat" id="sbcapnhat" value="Cập nhật">
                        <input type="submit" name="sbxoa" id="sbxoa" value="Xóa">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['sbxoa'])) {
            if ($_POST['sbxoa'] == 'Xóa') {
                if ($kh->thucthisql("DELETE  FROM dathang_chitiet WHERE iddh='$iddh' limit 1") == 1) {
                    echo "<p style='text-align: center;' >Xóa đơn hàng thành công.</p>";
                } else {
                    echo " <p style='text-align: center;' >Xóa đơn hàng thất bại.</p>";
                }
            }
        } else {
            echo '';
        }
        if (isset($_POST['txtsoluong']) && !isset($_POST['sbxoa'])) {
            $soluong = $_POST['txtsoluong'];
            if ($_POST['sbcapnhat'] == 'Cập nhật') {
                if ($kh->thucthisql("UPDATE dathang_chitiet SET soluong='$soluong' WHERE iddh='$iddh' limit 1") == 1) {
                    echo " <p style='text-align: center;' >Cập nhật đơn hàng thành công.</p>";
                } else {
                    echo "<p style='text-align: center;' > Cập nhật đơn hàng thất bại.</p>";
                }
            }
        } else {
            echo '';
        }
        ?>
    </div>
</div>

<?php include '../../partical/footer.php' ?>