<div class="offcanvas-xl offcanvas-end admin-navtab" tabindex="-1" id="adminSidebar" >

    <div class="offcanvas-header admin-navtab border-3 border-bottom border-white">
        <h5 class="offcanvas-title">پنل مدیریت</h5>
        <button type="button" class="btn-close me-1 bg-light none-shadow  rounded-circle small "
                data-bs-dismiss="offcanvas"
                style="transform: scale(.75);"
                data-bs-target="#adminSidebar"></button>
    </div>

    <div class="offcanvas-body p-0" >

        <ul class="nav flex-column admin-navtab p-2 m-0 rounded-1" >
            <?php
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM `users` WHERE `email` = :email";
            $stmt = $db->prepare($sql);
            $params = ['email' => $email];
            $stmt->execute($params);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['role'] == "main-admin" || $row['role'] == "super-admin" ) {
                echo ' 
            <li class="nav-item ">
                <a class="nav-link active" aria-current="page" href="../admin/index.php">
                    📊 داشبورد
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link active" aria-current="page" href="../admin/features.php">
                    🎨 ویژگی ها
                </a>
            </li>
            ';}
            ?>

            <?php
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM `users` WHERE `email` = :email";
            $stmt = $db->prepare($sql);
            $params = ['email' => $email];
            $stmt->execute($params);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['role'] == "main-admin" || $row['role'] == "super-admin" || $row['role'] == "post-admin") {
                echo ' 
                <li class="nav-item">
                    <a class="nav-link" href="../admin/post.php">
                        📰 پست ها
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/q&a.php">
                        ⁉️ پرسش و پاسخ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/slider.php">
                         🎠 اسلایدر ها
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/categories.php">
                        📁 دسته بندی ها
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/brand.php">
                        🖼️  برند ها
                    </a>
                </li>
                ';
            }
            ?>
            <?php
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM `users` WHERE `email` = :email";
            $stmt = $db->prepare($sql);
            $params = ['email' => $email];
            $stmt->execute($params);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['role'] == "main-admin" || $row['role'] == "super-admin" || $row['role'] == "web-admin") {
                echo ' 
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/weblog.php">
                                    📝 وبلاگ ها
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/comments.php">
                                    💬 کامنت ها
                                </a>
                            </li>
                                                        
            ';}
            ?>

            <?php
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM `users` WHERE `email` = :email";
            $stmt = $db->prepare($sql);
            $params = ['email' => $email];
            $stmt->execute($params);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['role'] == "main-admin" || $row['role'] == "super-admin" || $row['role'] == "support") {
                echo '    
                <li class="nav-item">
                    <a class="nav-link" href="../admin/sudscribers.php">
                        👥 مشترکین
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/orders.php">
                        🛒 سفارشات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/shipping.php">
                            🚚 روش های ارسال
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/guaranty.php">
                            📦 گارانتی ها
                    </a>
                </li>                
            ';
            }
            ?>

            <?php
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM `users` WHERE `email` = :email";
            $stmt = $db->prepare($sql);
            $params = ['email' => $email];
            $stmt->execute($params);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['role'] == "main-admin") {
                echo '    
                      <li class="nav-item">
                            <a class="nav-link" href="../admin/logo.php">
                                🖼 لوگو
                            </a>
                      </li>
                      <li class="nav-item">
                            <a class="nav-link" href="../admin/about.php">
                                ℹ️ درباره
                            </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="../admin/admins.php">
                            👤 مدیر ها
                        </a>
                      </li>
                ';
            }
            ?>

        </ul>
    </div>
</div>