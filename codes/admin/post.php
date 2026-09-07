<?php
include("lib-admin/header.php");
?>
<!--<main section start>-->
<?php
if(isset($_GET['mas'])){
    $msa = htmlspecialchars($_GET['mas']);
    echo <<<HTML
    <script>alert("$msa")</script>
HTML;
}
$sql_posts = "SELECT * FROM `posts` ORDER BY `id` DESC";
$posts = $db->query($sql_posts);
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == 'delete') {
        if ($entity == 'post') {
            $query = "DELETE FROM `posts` WHERE `id`='$id'";
        }
        $db->query($query);
        header("Location:post.php?mas=با موفیت حذف شد.");
        exit();
    }
}
?>
<div class="container-xxl">
    <div class="row">
        <div class="col-auto">
            <?php
            include("lib-admin/sidebar.php");
            ?>
        </div>
        <div class="col-xl-10">
            <div class="row">
                <div class="row justify-content-between mb-2">
                    <div class="col-6"><h3 class="d-inline-block">پست ها</h3></div>
                    <div class="col-6 text-start p-0 m-0"><a href="post-new.php" class="btn btn-primary">ايجاد پست
                            جديد</a>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table admin-table">


                        <thead>
                        <tr>
                            <th scope="col">عنوان</th>
                            <th scope="col">نويسنده</th>
                            <th scope="col">تنظيمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($posts as $post) {
                            echo <<<HTML
                        <tr>
                            <td>{$post['title']}</td>
                            <td>{$post['author']}</td>
                            <td>
                            <a href="post-edite.php?id={$post['id']}"  class="btn btn-outline-primary mb-2">ویرایش</a>
                            <a href="post.php?entity=post&action=delete&id={$post['id']}"  class="btn btn-outline-danger mb-2">حذف</a>
                            </td>
                        </tr>

HTML;

                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<main section end>-->
<?php
include("lib-admin/footer.php");
?>
