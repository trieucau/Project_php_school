<?php include '../../partical/header.php' ?>

<div class="main">
    <?php include '../../partical/nav.php' ?>

    <div class="content">
        <?php
        include '../../classtmdt/clsquanlisp.php';
        $ql = new clsquanlisp();
        $danhsachsanpham = $ql->DanhSachSanPham();
        $danhsachcongty = $ql->DanhSachCongTy_combox();
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table style=" width: 100%;" border="1" align="center" cellpadding=2 cellspacing=0>
                <tr>
                    <td style="width: 30%;" valign="middle">Công ty cung cấp</td>
                    <td style="width: 70%;" valign="middle">
                        <select name="txtcongty" style="width: 150px;">
                            <option value="null">--chọn công ty--</option>
                            <?php for ($c = 0; $c < count($danhsachcongty); $c++) { ?>
                                <option value="<?php echo $danhsachcongty[$c]['idcty']  ?>"><?php echo $danhsachcongty[$c]['tencty']  ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="width: 30%;" valign="middle">Nhập tên sản phẩm</td>
                    <td style="width: 70%;" valign="middle">
                        <input type="text" name="txttensp">
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;" valign="middle">Nhập giá</td>
                    <td style="width: 70%;" valign="middle">
                        <input type="text" name="txtgia">
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;" valign="middle">Nhập giảm giá</td>
                    <td style="width: 70%;" valign="middle">
                        <input type="text" name="txtgiamgia">
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;" valign="middle">Mô tả</td>
                    <td style="width: 70%;" valign="middle">
                        <input type="text" name="txtmota">
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;" valign="middle">Hình đại diện</td>
                    <td style="width: 70%;" valign="middle">
                        <input type="file" name="myfile">
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%;" valign="middle" colspan="2">
                        <input type="submit" name='sbthemsp' id="sbthemsp" value="Thêm sản phẩm">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['sbthemsp'])) {
            if ($_POST['sbthemsp'] == 'Thêm sản phẩm') {
                $idcty = $_POST['txtcongty'];
                $ten = $_POST['txttensp'];
                $gia = $_POST['txtgia'];
                $giamgia = $_POST['txtgiamgia'];
                $mota = $_POST['txtmota'];
                $name = $_FILES['myfile']['name'];
                $tmp_name = $_FILES['myfile']['tmp_name'];
                $them = '';
                if ($idcty == 'null') {
                    echo 'Vui lòng chọn công ty cung cấp.';
                } elseif (!empty($name)) {
                    if ($ql->UploadFile($name, $tmp_name, '../../images') == 1) {
                        if ($ql->thucthisql("INSERT INTO sanpham(tensp, gia, mota, hinh, giamgia, idcty) 
                                        VALUES ('$ten', '$gia', '$mota', '$name', '$giamgia', '$idcty')") == 1) {
                            echo 'Thêm sản phẩm thành công.';
                        } else {
                            echo 'Thêm sản phẩm không thành công.';
                        }
                    } else {
                        echo 'Upload ảnh không thành công.';
                    }
                } else {
                    echo 'Vui lòng chọn hình ảnh.';
                }
            }
        }
        ?>


        <br><br>
        <table style="width: 100%;" border="1" align="center" cellpadding=2 cellspacing=0>
            <tr>
                <td style="width: 10%;" align="center" valign="middle">STT</td>
                <td style="width: 20%;" align="center" valign="middle">Tên sản phẩm</td>
                <td style="width: 10%;" align="center" valign="middle">Giá</td>
                <td style="width: 50%;" align="center" valign="middle">Mô tả</td>
                <td style="width: 10%;" align="center" valign="middle">Thay đổi</td>
            </tr>
            <?php for ($j = 0; $j < count($danhsachsanpham); $j++) { ?>

                <tr>
                    <td style="width: 10%;" align="center" valign="middle">
                        <p><?php echo  $j + 1; ?></p>
                    </td>
                    <td style="width: 20%;" align="center" valign="middle">
                        <p><?php echo  $danhsachsanpham[$j]['tensp'] ?></p>
                    </td>
                    <td style="width: 10%;" align="center" valign="middle">
                        <p><?php echo  $danhsachsanpham[$j]['gia'] ?></p>
                    </td>
                    <td style="width: 50%;" align="center" valign="middle">
                        <p><?php echo  $danhsachsanpham[$j]['mota'] ?></p>
                    </td>
                    <td style="width: 10%;" align="center" valign="middle">
                        <a href="?idsp=<?php echo $danhsachsanpham[$j]['idsp']; ?>&action=edit">Sửa</a>
                        <a href="?idsp=<?php echo $danhsachsanpham[$j]['idsp'];  ?>&action=del">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php
        if (isset($_GET['idsp']) && $_GET['action'] === 'del') {
            $idsp = intval($_GET['idsp']);
            $namehinh =  $ql->laytheodieukien("SELECT hinh FROM sanpham WHERE idsp = '$idsp'", "hinh");
            $hinh = '../../images/' . $namehinh;
            if ($idsp > 0) {
                if (unlink($hinh)) {
                    if ($ql->XoaSanPham($idsp) == 1) {
                        echo '<script>alert("Đã xóa thành công.");</script>';
                    } else {
                        echo '<script>alert("Lỗi khi xóa sản phẩm.");</script>';
                    }
                } else {
                    echo '<script>alert("Xóa hình không thành công.");</script>';
                }
            } else {
                echo '<script>alert("ID sản phẩm không hợp lệ.");</script>';
            }
        } else {
            echo '';
        }
        ?>
    </div>
</div>

<?php include_once '../../partical/footer.php' ?>