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
$sql_posts = "SELECT * FROM `posts`  ORDER BY `id` DESC LIMIT 10";;
$posts = $db->query($sql_posts);
$sql_comments = "SELECT * FROM `comments` WHERE `status`='0' ORDER BY `id` DESC LIMIT 10";
$comments = $db->query($sql_comments);
$sql_categories = "SELECT * FROM `categories` ORDER BY `id` DESC";
$categories = $db->query($sql_categories);
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == 'delete') {
        if ($entity == 'post') {
            $query = "DELETE FROM `posts` WHERE `id`='$id'";
        } elseif ($entity == 'comment') {
            $query = "DELETE FROM `comments` WHERE `id`='$id'";
        } else {
            $query = "DELETE FROM `categories` WHERE `id`='$id'";
        }
        $db->query($query);
        header("Location:index.php?mas=با موفقیت حذف شد.");
        exit();
    } else {
        $sql = "UPDATE `comments` SET `status`='1' WHERE `id`='$id'";
        $db->query($sql);
        header("Location:index.php?mas=با موفقیت تایید شد.");
        exit();
    }
}
?>
<div class="container-xxl">
    <div class="row">
        <div class="col-auto mb-3" >
            <?php
            include("lib-admin/sidebar.php");
            ?>
        </div>
        <div class=" col-xl-10">
            <div class="row">
                <div class="col-12">
                    <table class="table admin-table">
                        <h3>كامنت های اخير</h3>
                        <thead>
                        <tr>
                            <th scope="col">نام</th>
                            <th scope="col">كامنت</th>
                            <th scope="col">تنظيمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($comments as $comment) {
                            echo <<<HTML
                        <tr>
                            <td>{$comment['name']}</td>
                            <td>{$comment['comment']}</td>
                            <td>
                            <a href="index.php?entity=comment&action=approve&id={$comment['id']}"  class="btn btn-outline-primary mb-2">در انتظار تایید</a>
                            <a href="index.php?entity=comment&action=delete&id={$comment['id']}"  class="btn btn-outline-danger mb-2">حذف</a>
                            </td>
                        </tr>

HTML;

                        }
                        ?>

                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <table class="table admin-table">
                        <h3>پست های اخير</h3>
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
                            <a href="index.php?entity=post&action=delete&id={$post['id']}"  class="btn btn-outline-danger mb-2">حذف</a>
                            </td>
                        </tr>

HTML;

                        }
                        ?>

                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <table class="table admin-table">
                        <h3>دسته بندی ها</h3>
                        <thead>
                        <tr>
                            <th scope="col">عنوان</th>
                            <th scope="col">تنظيمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($categories as $category) {
                            echo <<<HTML
                        <tr>
                            <td>{$category['title']}</td>
                            <td>
                            <a href="category-edite.php?id={$category['id']}"  class="btn btn-outline-primary mb-2">ویرایش</a>
                            <a href="index.php?entity=category&action=delete&id={$category['id']}"  class="btn btn-outline-danger mb-2">حذف</a>
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
