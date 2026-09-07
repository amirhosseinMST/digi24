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
                $sql = "SELECT * FROM `about` ";
                $result = $db->query($sql);
                $about = $result->fetch();
                $image = $about['image'];
                $id = $about['id'];
                $body = $about['body'];
                if (isset($_POST['add-about'])) {
                    if (trim($_POST['body']) != "" && $_POST['hours_1'] != "" && $_POST['mobile'] != "" && $_POST['phone'] != "" && $_POST['address_1'] != "") {
                        $content = $_POST['body'];
                        $hours_1 = $_POST['hours_1'];
                        $hours_2 = $_POST['hours_2'];
                        $hours_3 = $_POST['hours_3'];
                        $mobile = $_POST['mobile'];
                        $phone = $_POST['phone'];
                        $address_1 = $_POST['address_1'];
                        $address_2 = $_POST['address_2'];
                        if (trim($_FILES['image']['name']) != "") {
                            $img_name =rand(1,1000).date('dmyhis').$_FILES['image']['name'];
                            $img_tmp = $_FILES['image']['tmp_name'];
                            move_uploaded_file($img_tmp, "../upload/about/$img_name");
                            $query = "UPDATE `about` SET `image` = :img , `body` = :body , `hour1` = :hour_1 , `hour2` = :hour_2 , 
                        `hour3` = :hour_3 , `mobile` = :mobile , phone = :phone , address_1 = :address_1 , address_2 = :address_2 WHERE `id` = '$id'";
                            $stmt = $db->prepare($query);
                            $params = [':img' => $img_name, ':body' => $content , ':hour_1' => $hours_1 ,
                                    ':hour_2' => $hours_2, ':hour_3' => $hours_3, ':mobile' => $mobile, ':phone' => $phone , ':address_1' => $address_1 , ':address_2' => $address_2 ] ;
                        } else {
                            $query = "UPDATE `about` SET  `body` = :body , `hour1` = :hour_1 , `hour2` = :hour_2 , 
                        `hour3` = :hour_3 , `mobile` = :mobile , phone = :phone , address_1 = :address_1 , address_2 = :address_2 WHERE `id` = '$id'";
                            $stmt = $db->prepare($query);
                            $params = [':body' => $content , ':hour_1' => $hours_1 ,
                                    ':hour_2' => $hours_2, ':hour_3' => $hours_3, ':mobile' => $mobile, ':phone' => $phone , ':address_1' => $address_1 , ':address_2' => $address_2 ] ;
                        }


                        if ($stmt->execute($params)) {
                            header("Location:about.php?tex=با موفقيت ثبت شد &id=" . $about['id']);
                            exit();
                        } else {
                            header("Location:about.php?tex=متاسفانه ثبت نشد &id=" . $about['id']);
                            exit();
                        }
                    } else {
                        echo '<div class="alert alert-danger  " >لطفا همه کادر ها پر شود.</div>';
                    }
                }
                ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <span class="input-group-text title-color border-0 rounded-0">توضيحات</span>
                        <textarea rows="4" id="body" name="body"
                                  class="  none-shadow form-control border-0 rounded-0 button-color"
                                  aria-label="With textarea"><?php echo $about['body'] ?></textarea>
                    </div>
                    <img class="img-fluid mb-2" src="../upload/about/<?php echo $about['image'] ?>" width="410">
                    <div class="mb-3">
                        <label for="formFile" class="form-label ">یک عکس انتخاب کنید.</label>
                        <input name="image" class="none-shadow form-control border-0 rounded-0 button-color" type="file"
                               id="formFile">
                    </div>
                    <label for="formFile" class="form-label ">ساعت های کاری </label>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">ساعت کاری اول</span>
                        <input name="hours_1" type="text" class="form-control place-white border-0 rounded-0 none-shadow button-color"
                               placeholder="الزمای" value="<?php echo $about['hour1'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">ساعت کاری دوم</span>
                        <input name="hours_2" type="text" class="form-control border-0 rounded-0 none-shadow button-color"
                               placeholder="" value="<?php echo $about['hour2'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">ساعت کاری سوم</span>
                        <input name="hours_3" type="text" class="form-control border-0 rounded-0 none-shadow button-color"
                               placeholder="" value="<?php echo $about['hour3'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <label for="formFile" class="form-label ">راه های ارتباطی</label>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">شماره تلفن</span>
                        <input name="phone" type="tel" class="form-control border-0 rounded-0 none-shadow button-color"
                               placeholder="" value="<?php echo $about['phone'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">شماره ثابت </span>
                        <input name="mobile" type="tel" class="form-control border-0 rounded-0 none-shadow button-color"
                               placeholder="" value="<?php echo $about['mobile'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <label for="formFile" class="form-label ">آدرس</label>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">آدرس اول</span>
                        <textarea rows="2" name="address_1" class="place-white form-control border-0 rounded-0 none-shadow button-color"
                                  placeholder="الزامی" aria-label="With textarea"><?php echo $about['address_1'] ?></textarea>
                    </div>
                    <div class="input-group  mb-3">
                        <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">آدرس دوم</span>
                        <textarea rows="2" name="address_2" class="form-control border-0 rounded-0 none-shadow button-color"
                                  placeholder="" aria-label="With textarea"><?php echo $about['address_2'] ?></textarea>
                    </div>

                    <button type="submit" name="add-about" class="btn title-color mb-2">ویرایش</button>
                </form>
            </div>
        </div>
    </div>
<?php
include("lib-admin/footer.php");
?>