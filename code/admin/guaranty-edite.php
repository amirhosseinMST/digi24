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
            if (isset($_GET["id"])) {
                $edite = "SELECT * FROM guaranty WHERE id = '{$_GET["id"]}'";
                $edite_rusult = $db->query($edite);
                $guaranty_edite = $edite_rusult->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <?php
            if (isset($_POST['edite-guaranty'])) {
                if (trim($_POST['title']) != "") {
                    $title = $_POST['title'];

                        $sql = "UPDATE `guaranty` SET `title` = :title WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $params = ['title' => $title, 'id' => $_GET['id']];
                        if ($stmt->execute($params)) {
                            header("Location:guaranty-edite.php?tex=با موفقيت ویرایش شد &id=" . $guaranty_edite['id']);
                            exit();
                        } else {
                            header("Location:guaranty-edite.php?tex=متاسفانه ویرایش نشد &id=" . $guaranty_edite['id']);
                            exit();
                        }

                } else {
                    echo '<div class="alert alert-danger  " >لطفا همه کادر ها پر شود.</div>';
                }
            }
            ?>
            <form method="post" enctype="multipart/form-data">
                <div class="input-group  mb-3">
                    <span class="input-group-text title-color border-0 rounded-0" id="basic-addon1">عنوان</span>
                    <input value="<?php echo $guaranty_edite['title'] ?>" name="title" type="text"
                           class="form-control border-0 rounded-0 none-shadow button-color" placeholder=""
                           aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <button type="submit" name="edite-guaranty" class="btn title-color">ويرايش</button>
            </form>
        </div>
    </div>
</div>
<?php
include("lib-admin/footer.php");
?>

