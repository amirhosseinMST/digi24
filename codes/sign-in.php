<?php
include 'lib/header.php';
?>
    <!-- ورود-->
<?php
if(isset($_POST['sign-in'])){
    if(trim($_POST['password']) != '' && $_POST['email'] != ''){
        $email = truncateText(htmlspecialchars($_POST['email']),100);
        $password = truncateText(htmlspecialchars($_POST['password']),100);
        $sql = "SELECT * FROM `users` WHERE `email` = :email";
        $stmt = $db->prepare($sql);
        $params = array(':email' => $email);
        $stmt->execute($params);
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $row['pass'])){
                $_SESSION['email'] = $row['email'];
                if($row['role'] == 'user'){
                    header('location: index.php?error=خوش آمدید');
                    exit();
                }
                else{
                    header("Location:admin/index.php");
                    exit();
                }
            }
            else{
                echo '
                <script>alert("رمز اشتباه است.")</script>';
            }
        }
        else{
            echo '
            <script>alert("ایمیل اشتباه است.")</script>';
        }
    }
    else{
        echo '
            <script>alert("لطفا تمامی کادر ها پر شود.")</script>';
    }
}
?>
    <!-- =========================================
         SIGN SECTION
    ========================================= -->
    <section class="sign flex-grow-1 " >
        <div class="container p-0">
            <div class="weblog-ribbon w-100"></div>
        </div>
        <div class="container  px-5 mt-2 ">
            <div class="row justify-content-center align-items-center " dir="rtl">
                <!-- کارت ورود -->
                <div class="col-md-4" >
                    <div class="card shadow">
                        <div class="card-body p-4 ">
                            <h3 class="text-center mb-4">ورود</h3>

                            <form method="post" autocomplete="off">
                                <!-- ایمیل -->
                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <input type="email" name="email" class="form-control none-shadow " placeholder="example@email.com" maxlength="100" required>
                                </div>

                                <!-- رمز عبور -->
                                <div class="mb-3">
                                    <label class="form-label">رمز عبور</label>
                                    <input type="password" name="password" class="form-control none-shadow " placeholder="••••••••" maxlength="100" required>
                                </div>

                                <!-- مرا به خاطر بسپار -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input none-shadow cart-check cursor-pointer" id="remember" >
                                    <label class="form-check-label" for="remember">مرا به خاطر بسپار</label>
                                </div>

                                <!-- دکمه ورود -->
                                <button type="submit" name="sign-in" class="btn main-color-bg text-white cart-delete w-100">ورود</button>
                            </form>

                            <hr class="my-4">

                            <!-- لینک ثبت نام -->
                            <p class="text-center  mb-0">
                                حساب ندارید؟ <a href="register.php" class="main-color">ثبت‌نام</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include 'lib/footer.php';
?>