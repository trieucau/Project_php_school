<?php include '../../partical/header.php' ?>

<div class="main">
    <?php include '../../partical/nav.php' ?>

    <div class="content">
        <?php
        if (!empty($_SESSION['iduser'])) {
            echo $_SESSION['xacnhan-dathang'];
        ?>
            <form action="" method="post">
                <table style="width: 800px;" border="1" align="center" cellpadding="5" cellspacing="0">
                    <tr>
                        <td colspan="9" align="center" valign="middle">ĐỊA CHỈ NHẬN HÀNG</td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle">
                            <label for="address-line1">Số Nhà/Đường:</label>
                            <input type="text" id="duong" name="duong" required>
                        </td>
                        <td align="center" valign="middle">
                            <label for="address-line2">Phường/Xã:</label>
                            <input type="text" id="phuong" name="phuong" required>
                        </td>
                        <td align="center" valign="middle">
                            <label for="district">Quận/Huyện:</label>
                            <input type="text" id="quan" name="quan" required>
                        </td>
                        <td align="center" valign="middle">
                            <label for="city">Thành Phố:</label>
                            <input type="text" id="city" name="city" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" align="center" valign="middle">
                            <br>
                            <input type="submit" name="sbcapnhat" id="sbcapnhat" value="Cập nhật địa chỉ">
                        </td>
                    </tr>
                </table>
            </form>
        <?php
            if (isset($_POST['sbcapnhat'])) {
                if ($_POST['sbcapnhat'] == "Cập nhật địa chỉ") {
                    $diachi = $_POST['duong'] . '/' . $_POST['phuong'] . '/' . $_POST['quan'] . '/' . $_POST['city'];
                    $idkh = $_SESSION['iduser'];
                    if ($kh->thucthisql("UPDATE khachhang set diachinhanhang='$diachi' where idkh = '$idkh' limit 1") == 1) {
                        echo "<p align='center'>Đặt hàng thành công.</p>";
                    } else {
                        echo "<p align='center'>Đặt hàng thất bại.</p>";
                    }
                }
            } else {
                echo '';
            }
        } else {
            echo "<p align='center'>Giỏ hàng của bạn hiện tại đang trống.</p>";
        }
        ?>
    </div>
</div>

<?php include_once '../../partical/footer.php' ?>