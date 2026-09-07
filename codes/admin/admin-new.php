<?php
include("lib-admin/header.php");
?>
    <div class="container-xxl">
        <div class="row">
            <div class="col-auto">
                <?php
                include("lib-admin/sidebar.php");
                ?>
            </div>
            <div class="col-xl-10">
                <?php
                if (isset($_GET['tex'])) {
                    $tex = $_GET['tex'];
                    echo <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">$tex</div>
HTML;
                }
                if (isset($_GET['mas_er'])) {
                    echo <<<_END
            <div class="row justify-content-center">
                <div class="col-6 alert alert-danger ">{$_GET['mas_er']}</div>
            </div>
_END;

                }
                if (isset($_POST['add-admin'])) {
                    if ($_POST['password'] != $_POST['pass_repeat']) {
                        header('location: admin-new.php?mas_er=پسوردها مطابقت ندارند!');
                        exit();
                    }
                    if (strlen($_POST['password']) < 8) {
                        header('location: admin-new.php?mas_er=طول پسورد کافی نیست.');
                        exit();
                    }
                    if (trim($_POST['name']) != "" && trim($_POST['last_name']) != "" && trim($_POST['email']) != ""
                            && trim($_POST['phone']) != "" && trim($_POST['password']) != "" && trim($_POST['role']) != "") {
                        $name = $_POST['name'];
                        $last_name = $_POST['last_name'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $role = $_POST['role'];
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $sql = "INSERT INTO `users` (first_name , last_name , email , phone , pass , role) VALUES
                                 (:name , :last_name , :email , :phone , :password , :role) ";
                        $stmt = $db->prepare($sql);
                        $params = ['name' => $name, 'last_name' => $last_name, 'email' => $email, 'phone' => $phone, 'password' => $password, 'role' => $role];
                        if ($stmt->execute($params)) {
                            header("Location:admin-new.php?tex=با موفقيت ثبت شد ");
                            exit();
                        } else {
                            header("Location:admin-new.php?tex=متاسفانه ثبت نشد ");
                            exit();
                        }
                    } else {
                        echo '<div class="alert alert-danger  " >لطفا همه کادر ها پر شود.</div>';
                    }
                }
                ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">نام</span>
                        <input name="name" type="text" class="form-control border-0 rounded-0 none-shadow button-color"
                               placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">نام خانوادگی</span>
                        <input name="last_name" type="text" class="form-control border-0 rounded-0 none-shadow button-color"
                               placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">ایمیل</span>
                        <input name="email" type="email" class="form-control border-0 rounded-0 none-shadow button-color"
                               placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">شماره موبایل</span>
                        <input id="phone" onkeyup="validat_phone()" name="phone" type="text" class="form-control border-0 rounded-0 none-shadow button-color"
                               placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <select name="role" class=" none-shadow cursor-pointer form-select mt-3 border-0 rounded-0 button-color mb-2"
                            aria-label="Default select example">
                            <option value="post-admin">پست ادمین</option>
                            <option value="web-admin">وبلاگ ادمین</option>
                            <option value="support">پشتیبانی</option>
                            <option value="super-admin">سوپر ادمین</option>
                    </select>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">پسورد</span>
                        <input id="pass" onkeyup="validat();lenpas();" type="password"
                               class="rounded-0 place-white form-control button-color none-shadow"
                               name="password" minlength="8" placeholder="حداقل ۸ کاراکتر" required>
                    </div>

                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">تکرار پسورد </span>
                        <input id="pass-repeat" onkeyup="validat()" type="password"
                               class="rounded-0 form-control button-color none-shadow"
                               name="pass_repeat" minlength="8" required>
                    </div>

                    <div class="row justify-content-start ">
                        <div id="length-pass" class="col-auto mt-2"></div>
                        <div id="match-pass" class="col-auto mt-2"></div>
                        <div id="phone-char" class="col-auto mt-2"></div>
                    </div>
                    <button type="submit" name="add-admin" class="btn title-color mt-3">ایجاد</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        const pass = document.getElementById('pass')
        const pass_repeat = document.getElementById('pass-repeat')
        const match_pass = document.getElementById('match-pass')
        const length_pass = document.getElementById('length-pass')

        function validat() {
            if (pass.value.length > 0 && pass_repeat.value.length > 0) {
                if (pass.value === pass_repeat.value) {
                    match_pass.innerHTML = "✅ پسوردها مطابقت دارند"
                    match_pass.style.color = "green"
                } else {
                    match_pass.innerHTML = "❌ پسوردها مطابقت ندارند"
                    match_pass.style.color = "red"
                }
            } else {
                match_pass.innerHTML = ""
            }
        }

        function lenpas() {
            if (pass.value.length < 8) {
                length_pass.innerHTML = "❌حداقل ۸ کارکتر"
                length_pass.style.color = "red"
            } else if (pass.value.length >= 8) {
                length_pass.innerHTML = "✅ طول پسورد مناسب است"
                length_pass.style.color = "green"
            }
        }

        const phone = document.getElementById('phone')
        const phone_char = document.getElementById('phone-char')

        function validat_phone() {

            if (phone.value.length < 11) {
                phone_char.innerHTML = "❌حداقل 11 رقم"
                phone_char.style.color = "red"
            } else {
                phone_char.innerHTML = ""
            }
        }
    </script>
<?php
include("lib-admin/footer.php");
?>