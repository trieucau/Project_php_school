<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #f1f1f1;
            padding: 2%;
            margin: auto 30%;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button,
        .btnlogin {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover,
        .btnlogin {
            opacity: 0.8;
        }



        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 5px 0 12px 0;
        }

        img.avatar {
            width: 20%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }


        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <br><br><br><br>
    <form action="" method="post">
        <div class="imgcontainer">
            <img src="../../images/avatardefault.webp" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname">

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw">

            <input type="submit" name="submit" class="btnlogin" value="Login ">Login</input>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="submit" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
        <?php
        include '../../classtmdt/clslogin.php';
        $lo = new clslogin();
        if (isset($_POST['submit'])) {
            if ($_POST['uname'] != '' && $_POST['psw'] != '') {
                if ($lo->Mylogin($_POST['uname'], $_POST['psw']) == 1) {
                    header("Location: ../trangchu/index.php");
                } else {
                    echo "Đăng nhập không thành công.";
                }
            } else {
                echo "Vui lòng điều đầy đủ thông tin.";
            }
        }
        ?>
</body>

</html>