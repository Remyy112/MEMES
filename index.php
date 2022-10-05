<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Memy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $db = new mysqli("localhost", "root", "", "memes");
        $page = 1;
        $limit = 10;
        $offset = ($page * $limit) - $limit;

        $sql = 'SELECT m.id AS "id", m.title, m.file AS "path", m.likes, m.created_at AS "date", u1.user_name AS "author", u2.user_name AS "admin" FROM memes AS m JOIN users AS u1 ON m.user_id = u1.id JOIN users AS u2 ON m.admin_id = u2.id WHERE m.deleted_at IS NULL';
    ?>
    <div class="header">
        <a href="index.php"><span>menu</span></a>
    </div>
    <div style="margin-bottom: 60px;"></div>
    <div class="feed">
        <?php
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
                            <form action='memeInspect.php' method='POST'>
                                <input type='hidden' id='id' name='id' value=".$row['id'].">
                                <input type='submit' value='Comments'>
                            </form>
                        </div>
                    </div>";
            }
        }
        else{
            echo "error: $db->error";
        }
        $db->close();
        ?>
    </div>
    <form action="memeInspect.php" method="POST"></form>
    <div class="nav">
        <form method="post">
            <button><-</button>
            <span>1</span>
            <button>-></button>
        </form>
    </div>
</body>
</html>