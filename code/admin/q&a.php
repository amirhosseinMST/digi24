<?php
include("lib-admin/header.php");
?>
<!--<main section start>-->
<?php
$sql = "SELECT * FROM `q&a` ORDER BY id DESC";
$questions = $db->query($sql);
if(isset($_GET['mas'])){
    $mas = $_GET['mas'];
    echo <<<HTML
    <script>alert("$mas")</script>
HTML;
}
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];
    if ($action == 'delete') {
        if ($entity == 'question') {
            $query = "DELETE FROM `q&a` WHERE `id`='$id'";
            $comments = $db->query($query);
            header("Location: q&a.php?mas=با موفقیت حذف شد.");
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
                        <h3> سوال ها </h3>
                        <thead>
                        <tr>
                            <th scope="col">نام</th>
                            <th scope="col">نام محصول</th>
                            <th scope="col">سوال</th>
                            <th scope="col">جواب</th>
                            <th scope="col">تنظيمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($_POST['add-answer'])) {
                            if (trim($_POST['answer']) != "") {
                                $answer = trim($_POST['answer']);
                                $id_q = $_POST['id-q'];
                                $sql_u = "UPDATE `q&a` SET `answer` = '$answer' , `status` = 1  WHERE `id` = '$id_q'";
                                $db->query($sql_u);
                                header("Location: q&a.php?mas=با موفقیت ثبت شد.");
                                exit();
                            }
                        }
                        foreach ($questions

                        as $question) {
                            $sql_post = "SELECT * FROM `posts` WHERE `id` = '{$question['post_id']}'";
                            $posts = $db->query($sql_post);
                            $post = $posts->fetch();
                            $post_title = $post['title'];
                        ?>
                        <tr>

                            <td><?php echo $question['name'] ?></td>
                            <td><?php echo $post_title ?></td>
                            <td><?php echo $question['question'] ?></td>
                            <td>
                                <?php
                                if ($question['status'] == '0') {
                                    echo <<<HTML
                                    <form  method="POST">
                                        <textarea class="form-control  button-color none-shadow" name="answer" rows="2"></textarea>
                                        <button type="submit" name="add-answer" class="title-color my-2 btn">ارسال</button>
                                        <input type="hidden" name="id-q" value="{$question['id']}">
                                    </form>
HTML;

                                }elseif ($question['status'] == '1') {
                                    echo $question['answer']; ;
                                }
                                ?>
                            </td>
                            <td>
                                <a href="q&a.php?entity=question&action=delete&id=<?php echo $question['id'] ?>"
                                   class="btn btn-outline-danger mb-2">حذف</a>
                            </td>
                        </tr>
                        <?php }?>
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



