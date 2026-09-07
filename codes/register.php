<?php
include 'lib/header.php';
?>

<?php
if (isset($_GET['mas'])) {
    $mas = htmlspecialchars($_GET['mas']);
    echo <<<_END
                <script>alert("$mas")</script>
_END;

}
if (isset($_GET['mas_er'])) {
    $mas_er = htmlspecialchars($_GET['mas_er']);
    echo <<<_END
                <script>alert("$mas_er")</script>
_END;

}

if (isset($_POST['register'])) {


    if ($_POST['pass'] != $_POST['pass_repeat']) {
        header('location: register.php?mas_er=پسوردها مطابقت ندارند!');
        exit();
    }
    if (strlen($_POST['pass']) < 8) {
        header('location: register.php?mas_er=طول پسورد کافی نیست.');
        exit();
    }
    if (strlen($_POST['phone']) < 11) {
        header('location: register.php?mas_er=طول شماره تماس کافی نیست.');
        exit();
    }

    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $gender = htmlspecialchars($_POST['gender']);
    $birth_date = htmlspecialchars($_POST['birth_date']);
    $pass = htmlspecialchars(password_hash($_POST['pass'], PASSWORD_DEFAULT));
    $phone = htmlspecialchars($_POST['phone']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $province = htmlspecialchars($_POST['Province']);
    $city = htmlspecialchars($_POST['city']);
    $address = htmlspecialchars($_POST['address']);
    $postal_code = htmlspecialchars($_POST['postal_code']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);


    $sql_check = "SELECT * FROM `users` WHERE email = :email";
    $result_check = $db->prepare($sql_check);
    $params_check = array(':email' => $email);
    $result_check->execute($params_check);
    $sql_check2 = "SELECT * FROM `users` WHERE username = :username";
    $result_check2 = $db->prepare($sql_check2);
    $params_check2 = array(':username' => $username);
    $result_check2->execute($params_check2);
    $sql_check3 = "SELECT * FROM `users` WHERE phone = :phone";
    $result_check3 = $db->prepare($sql_check3);
    $params_check3 = array(':phone' => $phone);
    $result_check3->execute($params_check3);
    if ($result_check->rowCount() > 0) {
        header('location: register.php?mas_er=ایمیل تکراری است.');
        exit();

    } elseif ($result_check2->rowCount() > 0) {
        header('location: register.php?mas_er=نام کاربری تکراری است.');
        exit();

    } elseif ($result_check3->rowCount() > 0) {
        header('location: register.php?mas_er=شماره تلفن تکراری است.');
        exit();

    } else {
        $sql = "INSERT INTO users (
        first_name, last_name, gender, birth_date, username, 
        pass, phone, email, province, city, address, postal_code , mobile 
    ) VALUES (
        :first_name, :last_name, :gender, :birth_date, :username,
        :pass, :phone, :email, :province, :city, :address, :postal_code , :mobile
    )";
        $stmt = $db->prepare($sql);
        $params = [
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':gender' => $gender,
                ':birth_date' => $birth_date,
                ':username' => $username,
                ':pass' => $pass,
                ':phone' => $phone,
                ':email' => $email,
                ':province' => $province,
                ':city' => $city,
                ':address' => $address,
                ':postal_code' => $postal_code,
                ':mobile' => $mobile,

        ];
        if ($stmt->execute($params)) {
            header('location: register.php?mas=با موفقیت ثبت نام شدید.');
            exit();
        } else {
            header('location: register.php?mas_er=متاسفانه ثبت  نشد.');
            exit();
        }
    }

}

?>

    <form method="post" class="container w-100 px-md-5 mt-3 flex-grow-1 ">
        <div class="row px-md-5 justify-content-center g-3" dir="rtl">
            <!-- عنوان -->
            <div class="col-12">
                <button class="btn pe-none main-color-bg text-white w-100">فرم ثبت نام مشترکین</button>
            </div>

            <!-- نام -->
            <div class="col-md-6 col-12">
                <label class="form-label">نام</label>
                <input type="text" class="form-control none-shadow" name="first_name" maxlength="100" required>
            </div>

            <!-- نام خانوادگی -->
            <div class="col-md-6 col-12">
                <label class="form-label">نام خانوادگی</label>
                <input type="text" class="form-control none-shadow" name="last_name" maxlength="100" required>
            </div>

            <!-- جنسیت -->
            <div class="col-md-6 col-12">
                <label class="form-label">جنسیت</label>
                <select class="form-select none-shadow cursor-pointer" name="gender" required>
                    <option value="male" selected>مرد</option>
                    <option value="female">زن</option>
                </select>
            </div>

            <!-- تاریخ تولد -->
            <div class="col-md-6 col-12">
                <label class="form-label">تاریخ تولد</label>
                <input type="date" class="form-control none-shadow cursor-pointer" name="birth_date" required>
            </div>

            <!-- نام کاربری -->
            <div class="col-12">
                <label class="form-label">نام کاربری</label>
                <input type="text" class="form-control none-shadow" name="username" maxlength="100" required>
            </div>

            <!-- پسورد -->
            <div class="col-12">
                <label class="form-label">پسورد</label>
                <input id="pass" onkeyup="validat();lenpas();" type="password"
                       class="form-control none-shadow" name="pass" minlength="8" maxlength="100"
                       placeholder="حداقل ۸ کاراکتر" required>
            </div>

            <!-- تکرار پسورد -->
            <div class="col-12">
                <label class="form-label">تکرار پسورد</label>
                <input id="pass-repeat" onkeyup="validat()" type="password"
                       class="form-control none-shadow" name="pass_repeat" minlength="8"
                       maxlength="100" required>
            </div>

            <!-- پیام‌های اعتبارسنجی پسورد -->
            <div class="row justify-content-start">
                <div id="length-pass" class="col-auto mt-2"></div>
                <div id="match-pass" class="col-auto mt-2"></div>
            </div>

            <!-- ایمیل -->
            <div class="col-12">
                <label class="form-label">ایمیل</label>
                <input type="email" class="form-control none-shadow" name="email" maxlength="100" required>
            </div>

            <!-- شماره تماس -->
            <div class="col-md-6 col-12">
                <label class="form-label">شماره تماس</label>
                <input type="tel" id="phone" onkeyup="validat_phone()"
                       class="form-control none-shadow" name="phone" minlength="11"
                       maxlength="11" placeholder="09111111111" required>
            </div>

            <!-- تلفن ثابت -->
            <div class="col-md-6 col-12">
                <label class="form-label">تلفن ثابت</label>
                <input type="tel" class="form-control none-shadow" placeholder="بدون پیش شماره" name="mobile" maxlength="8" minlength="8" required>
            </div>

            <!-- پیام اعتبارسنجی شماره -->
            <div class="row justify-content-start">
                <div id="phone-char" class="col-auto mt-2"></div>
            </div>

            <!-- استان -->
            <div class="col-md-6 col-12">
                <label class="form-label">استان</label>
                <input type="text" class="form-control none-shadow" name="Province" maxlength="100" required>
            </div>

            <!-- شهر -->
            <div class="col-md-6 col-12">
                <label class="form-label">شهر</label>
                <input type="text" class="form-control none-shadow" name="city" maxlength="100" required>
            </div>

            <!-- آدرس -->
            <div class="col-12">
                <label class="form-label">آدرس</label>
                <textarea class="form-control none-shadow" name="address" rows="2" maxlength="300" required></textarea>
            </div>

            <!-- کد پستی -->
            <div class="col-12">
                <label class="form-label">کد پستی</label>
                <input type="text" class="form-control none-shadow" name="postal_code" maxlength="10" required>
            </div>

            <!-- دکمه ثبت نام -->
            <div class="col-12">
                <button name="register" type="submit" class="btn main-color-bg text-white w-100">
                    ثبت نام
                </button>
            </div>
        </div>
    </form>

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
include 'lib/footer.php';
?>