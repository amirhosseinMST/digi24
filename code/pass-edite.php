<?php
include 'lib/header.php';
if (!isset($_SESSION['email'])) {
    header("location: index.php?error=ابتدا وارد شوید.");
    exit();
}
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


if (isset($_POST['pass-edite'])) {


    $last_pass = htmlspecialchars($_POST['last-pass']);
    $sql = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $_SESSION['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($last_pass, $user['pass'])) {
        header('location: pass-edite.php?mas_er=پسورد قبلی اشتباه است.');
        exit();
    }

    if ($_POST['pass'] != $_POST['pass_repeat']) {
        header('location: pass-edite.php?mas_er=پسوردها مطابقت ندارند!');
        exit();
    }
    if (strlen($_POST['pass']) < 8) {
        header('location: pass-edite.php?mas_er=طول پسورد کافی نیست.');
        exit();
    }

    $pass = htmlspecialchars(password_hash($_POST['pass'], PASSWORD_DEFAULT));


    $sql = "UPDATE users SET pass = :pass WHERE email = :email_check";

    $stmt = $db->prepare($sql);
    $params = [':pass' => $pass, ':email_check' => $_SESSION['email']];

    if ($stmt->execute($params)) {
        header('location: pass-edite.php?mas=با موفقیت ویرایش شد.');
        exit();
    } else {
        header('location: pass-edite.php?mas_er=متاسفانه ویرایش نشد.');
        exit();
    }
}
?>

<form method="post" class="container px-md-5 mt-3 flex-grow-1 " dir="rtl">
    <div class="row justify-content-center g-3 px-md-5">
        <div class="col-md-12">
            <label class="form-label">پسورد قبلی</label>
            <input type="password" class="form-control  none-shadow"
                   name="last-pass" minlength="8" maxlength="100" required>
        </div>

        <div class="col-md-12">
            <label class="form-label"> پسورد جدید </label>
            <input id="pass" onkeyup="validat();lenpas();" type="password"
                   class=" form-control  none-shadow"
                   name="pass" minlength="8" maxlength="100" placeholder="حداقل ۸ کاراکتر" required>
        </div>

        <div class="col-md-12">
            <label class="form-label">تکرار پسورد جدید</label>
            <input id="pass-repeat" onkeyup="validat()" type="password" class="form-control  none-shadow"
                   name="pass_repeat" minlength="8" maxlength="100" required>
        </div>

        <div class="row justify-content-start ">
            <div id="length-pass" class="col-auto mt-2"></div>
            <div id="match-pass" class="col-auto mt-2"></div>
        </div>
        <div class="col-12">
            <button name="pass-edite" type="submit" class="btn  w-100 main-color-bg text-white border-0">
                ویرایش
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
</script>
<?php
include 'lib/footer.php';
?>


