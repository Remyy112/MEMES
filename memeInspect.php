<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Memy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $db = new mysqli("localhost", "root", "", "memes");
    ?>
    <div class="header">
        <a href="index.php"><span>menu</span></a>
    </div>
    <div style="margin-bottom: 60px;"></div>

    <div class="feed">
        <?php
        $sql = "SELECT m.id, m.title, m.file AS 'path', m.likes, m.created_at AS 'date', u1.user_name AS 'author', u2.user_name AS 'admin' FROM memes AS m JOIN users AS u1 ON m.user_id = u1.id JOIN users AS u2 ON m.admin_id = u2.id WHERE m.id=".$_POST["id"]."";
            if($results = $db->query($sql)){
                while($row = $results->fetch_assoc()){
                    echo "<div class='meme'>
                            <div class='memeData'>
                                <p>By ".$row["author"]."</p>
                                <p>".$row["title"]."</p>
                                <p>Likes: ".$row["likes"]."</p>
                                <p>".$row["date"]."</p>
                            </div>
                            <div class='memeImg'>
                                <img src='imgs/".$row["path"]."'>
                            </div>
                        </div>";
                }
            }
            else{
                echo "error: $db->error";
            }
        ?>

        <div class="commentSection">
            <?php
                $sql = "SELECT u.user_name AS `name`, c.content AS `text`, c.created_at AS `date`, c.modified_at, c.deleted_at FROM `comments` AS c JOIN users AS u ON c.user_id = u.id WHERE c.meme_id = ".$_POST["id"]."";
                if($results = $db->query($sql)){                    
                    while($row = $results->fetch_assoc()){
                        echo "<div class='comment'>
                                <div class='commentData'>
                                    <p>".$row['name']."</p>
                                    <p>".$row['date']."</p>
                                </div>
                                <div class='commentText'>".$row['text']."</div>
                            </div>";
                    }
                    if (mysqli_num_rows($results)==0){
                        echo "<div class='comment'><p>No comments</p></div>";
                    }
                }
                else{
                    echo "error: $db->error";
                }
                $db->close();
            ?>
        </div>
    </div>
</body>
</html>