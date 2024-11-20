<?php include '../../partical/header.php' ?>

<div class="main">
    <?php include '../../partical/nav.php' ?>

    <div class="content">
        <?php
        if (isset($_REQUEST['idcty'])) {
            $id_congty = $_REQUEST['idcty'];
        } else {
            $id_congty = '';
        }
        $arrsanpham = $kh->XemSanPham($id_congty);
        for ($j = 0; $j < count($arrsanpham); $j++) {
        ?>
            <a href="../sanpham/chitietsanpham.php?idsp=<?php echo $arrsanpham[$j]['idsp']; ?>">
                <div class="sanpham">
                    <div class="tensp"><?php echo $arrsanpham[$j]['tensp']; ?></div>
                    <div class="hinh"><img src="../../images/<?php echo $arrsanpham[$j]['hinh']; ?>" alt=""></div>
                    <div class="gia"><?php echo $arrsanpham[$j]['gia']; ?>$</div>
                </div>
            </a>
        <?php
        }
        ?>
    </div>
</div>

<?php include '../../partical/footer.php' ?>