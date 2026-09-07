<?php
include 'lib/header.php';
if (!isset($_SESSION['email'])) {
    header("location: index.php?error=ابتدا وارد شوید.");
    exit();
}
$email_sub = $_SESSION['email'];
$sql_edite = "SELECT * FROM `users` WHERE `email` = '$email_sub'";
$result_edite = $db->query($sql_edite);
$row_edite = $result_edite->fetch(PDO::FETCH_ASSOC);
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

if (isset($_POST['profile-edite'])) {

    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $gender = htmlspecialchars($_POST['gender']);
    $birth_date = htmlspecialchars($_POST['birth_date']);
    $phone = htmlspecialchars($_POST['phone']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $province = htmlspecialchars($_POST['Province']);
    $city = htmlspecialchars($_POST['city']);
    $address = htmlspecialchars($_POST['address']);
    $postal_code = htmlspecialchars($_POST['postal_code']);


    $sql = "UPDATE users SET 
            first_name = :first_name,
            last_name = :last_name,
            gender = :gender,
            birth_date = :birth_date,
            mobile = :mobile,
            province = :province,
            city = :city,
            address = :address,
            postal_code = :postal_code
        WHERE email = :email_check";

    $stmt = $db->prepare($sql);
    $params = [
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':gender' => $gender,
            ':birth_date' => $birth_date,
            ':mobile' => $mobile,
            ':province' => $province,
            ':city' => $city,
            ':address' => $address,
            ':postal_code' => $postal_code,
            ':email_check' => $email_sub
    ];

    if ($stmt->execute($params)) {
        header('location: profile-edite.php?mas=با موفقیت ویرایش شد.');
        exit();
    } else {
        header('location: profile-edite.php?mas_er=متاسفانه ویرایش نشد.');
        exit();
    }
}
?>

    <form method="post" class="container px-md-5 mt-3 flex-grow-1 " >
        <div class="row px-md-5 justify-content-center g-3" dir="rtl">
            <!-- عنوان -->
            <div class="col-12">
                <button class="btn pe-none main-color-bg text-white w-100">فرم ویرایش اطلاعات</button>
            </div>

            <!-- نام -->
            <div class="col-md-6 col-12">
                <label class="form-label">نام</label>
                <input type="text" value="<?php echo $row_edite['first_name'] ?>" class="form-control none-shadow" name="first_name" maxlength="100" required>
            </div>

            <!-- نام خانوادگی -->
            <div class="col-md-6 col-12">
                <label class="form-label">نام خانوادگی</label>
                <input type="text" value="<?php echo $row_edite['last_name'] ?>" class="form-control none-shadow" name="last_name" maxlength="100" required>
            </div>

            <!-- جنسیت -->
            <div class="col-md-6 col-12">
                <label class="form-label">جنسیت</label>
                <select class="form-select none-shadow cursor-pointer" name="gender" required>
                    <?php
                    if ($row_edite['gender'] == 'male') {
                        $male = 'selected';
                        $female = '';
                    } else {
                        $female = 'selected';
                        $male = '';
                    }
                    ?>
                    <option value="male" <?php echo $male ?>>مرد</option>
                    <option value="female" <?php echo $female ?>>زن</option>
                </select>
            </div>

            <!-- تاریخ تولد -->
            <div class="col-md-6 col-12">
                <label class="form-label">تاریخ تولد</label>
                <input type="date" value="<?php echo $row_edite['birth_date'] ?>" class="form-control none-shadow cursor-pointer" name="birth_date" required>
            </div>

            <!-- تلفن ثابت -->
            <div class="col-12">
                <label class="form-label">تلفن ثابت</label>
                <input type="tel" value="<?php echo $row_edite['mobile'] ?>" class="form-control none-shadow" name="mobile" maxlength="8" minlength="8" placeholder="بدون پیش شماره" required>
            </div>

            <!-- استان -->
            <div class="col-md-6 col-12">
                <label class="form-label">استان</label>
                <input type="text" value="<?php echo $row_edite['province'] ?>" class="form-control none-shadow" name="Province" maxlength="100" required>
            </div>

            <!-- شهر -->
            <div class="col-md-6 col-12">
                <label class="form-label">شهر</label>
                <input type="text" value="<?php echo $row_edite['city'] ?>" class="form-control none-shadow" name="city" maxlength="100" required>
            </div>

            <!-- آدرس -->
            <div class="col-12">
                <label class="form-label">آدرس</label>
                <textarea class="form-control none-shadow" name="address" rows="2" maxlength="300" required><?php echo $row_edite['address'] ?></textarea>
            </div>

            <!-- کد پستی -->
            <div class="col-12">
                <label class="form-label">کد پستی</label>
                <input type="text" value="<?php echo $row_edite['postal_code'] ?>" class="form-control none-shadow" name="postal_code" maxlength="10" required>
            </div>

            <!-- دکمه ویرایش -->
            <div class="col-12">
                <button name="profile-edite" type="submit" class="btn main-color-bg text-white w-100">
                    ویرایش
                </button>
            </div>
        </div>
    </form>

<?php
include 'lib/footer.php';
?>