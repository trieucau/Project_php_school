<?php
include '../../classtmdt/clskhachhang.php';
$kh = new clskhachhang();
$arrcongty = $kh->XemDSCongTy();
?>
<nav class="navbar">
    <h2>Menu</h2>
    <a href="../trangchu/index.php">Trang chủ</a>

    <div class="dropdown">
        <a href="#congty" class="dropdown-btn">Công ty</a>
        <div class="dropdown-content">
            <?php
            for ($i = 0; $i < count($arrcongty); $i++) {
                echo '<a  href="../trangchu/index.php?idcty=' . $arrcongty[$i]['idcty'] . '">' . $arrcongty[$i]['tencty'] . '</a>';
            }
            ?>
        </div>
    </div>

    <a href="../giohang/index.php">Giỏ hàng
        <?php
        if (isset($_SESSION['thongbao-giohang']) && $_SESSION['thongbao-giohang'] > 0) {
            echo ' (+' . $_SESSION['thongbao-giohang'] . ')';
        }
        ?>
    </a>
    <a href="../sanpham/quanlisanpham.php">Quản lí sản phẩm</a>
</nav>