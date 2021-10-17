<div class="feed card mb-4 shadow">
    <?php
        $post_id = $_GET["post"] ?? "";
        //require('../mysql.php');

        if(isset($_GET['settings']))
        {
            $_SESSION['back-url'] = "./index.php?settings";
            include 'settings/settings.php';
        }       
        else if(isset($_GET['account']))
        {
            $_SESSION['back-url'] = "./index.php?account=" . $_GET['account'];
            include 'account/account.php';
        }
        else if($post_id != "")
        {
            $st = $mysql->prepare("SELECT * FROM posts WHERE POSTID = :id");
            $st->bindParam(":id", $_GET["post"]);
            $st->execute();
            $row = $st->fetch();

            $username = $row['PUSERNAME'];
            $post_text = $row['POSTTEXT'];
            $img_url = $row['IMGURL'];
            $time = $row['PTIME'];
            $date = $row['PDATE'];

            $st = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
            $st->bindParam(":user", $username);
            $st->execute();
            $row = $st->fetch();
            $name = $row['NAME'];
            $user_img = $row['USERIMG'];

            include "post-full-view.php";
        } else
        {
            $_SESSION['back-url'] = "./index.php";
            $_SESSION['current-page'] = "home";
            
            $st = $mysql->prepare("SELECT * FROM posts");
            $st->execute();
            $count = $st->rowCount();

            for($i = $count; $i > 0; $i--)
            {
                $row = $st->fetch();
                
                $post_id = $row["POSTID"];
                $username = $row['PUSERNAME'];
                $post_text = $row['POSTTEXT'];
                $img_url = $row['IMGURL'];
                $time = $row['PTIME'];
                $date = $row['PDATE'];

                $st2 = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
                $st2->bindParam(":user", $username);
                $st2->execute();
                $row2 = $st2->fetch();
                $name = $row2['NAME'];
                $user_img = $row2['USERIMG'];
                
                include "post.php"; 
            }
        }
    ?>
</div>