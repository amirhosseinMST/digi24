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
$sql = "SELECT * FROM comments ORDER BY id DESC";
$comments = $db->query($sql);
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == 'delete') {
        if ($entity == 'comment') {
            $query = "DELETE FROM `comments` WHERE `id`='$id'";
            $comments = $db->query($query);
            header("Location: comments.php?mas=با موفقیت حذف شد.");
            exit();
        }
    } elseif ($action == 'approve') {
        if ($entity == 'comment') {
            $query = "UPDATE `comments` SET `status` = '1' WHERE `id` = '$id'";
            $comments = $db->query($query);
            header("Location: comments.php?mas=با موفقیت تایید شد.");
            exit();
        }
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
                <div class="col-12">
                    <table class="table admin-table">
                        <h3> كامنت ها </h3>
                        <thead>
                        <tr>
                            <th scope="col">نام</th>
                            <th scope="col">كامنت</th>
                            <th scope="col">تنظيمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($comments

                        as $comment) {
                        ?>
                        <tr>
                            <td><?php echo $comment['name'] ?></td>
                            <td><?php echo $comment['comment'] ?></td>
                            <td>

                                <a href="comments.php?entity=comment&action=delete&id=<?php echo $comment['id'] ?>"
                                   class="btn btn-outline-danger mb-2">حذف</a>
                                <?php
                                if ($comment['status'] == '0') {
                                    echo <<<HTML
                            <a href="comments.php?entity=comment&action=approve&id={$comment['id']}"  class="btn btn-outline-primary mb-2">در انتظار تایید</a>
HTML;

                                } elseif ($comment['status'] == '1') {
                                    echo <<<HTML
                            <a  class="btn btn-secondary disabled  mb-2">تایید شده</a>
HTML;
                                }
                                }
                                ?>
                            </td>
                        </tr>


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


