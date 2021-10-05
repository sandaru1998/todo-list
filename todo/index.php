<?php
require 'db_conn.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo list</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="main-section">
    <div class="add-section">
        <form action="" method="post" autocomplete="off">
            <input type="text" name="title" placeholder="This field is required">
            <button type="submit">Add &nbsp; <span>&plus;</span></button>
        </form>
    </div>
    <?php
        $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC ");
    ?>
    <div class="show-todo-section">
        <?php if ($todos->rowCount() <= 0){ ?>
        <div class="todo-item">
            <div class="empty">
                <img src="images/Ellipsis.gif" width="80px">
            </div>
        </div>
        <?php }?>

        <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) {?>
        <div class="todo-item">
            <span id="<?php echo $todo['id'];?>"
                        class="remove-to-do">x</span>
            <?php if ($todo['checked']) {?>
                <input type="checkbox"
                        class="checked"
                        checked />
                <h2 class="checked"><?php echo $todo['title']?></h2>
            <?php }else  { ?>
                <input type="checkbox"
                       class="checked" />
                <h2><?php echo $todo['title']?></h2>
            <?php }?>
            <br>
            <small>Created in:<?php echo $todo['date and time']?> </small>
        </div>
        <?php } ?>
    </div>
</div>

</body>
</html>