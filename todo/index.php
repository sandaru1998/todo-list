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
        <form action="add.php" method="post" autocomplete="off">
            <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error'){?>
                <input type="text" name="title" style="border-color: blue" placeholder="This field is required">
                <button type="submit">Add &nbsp; <span>&plus;</span></button>
            <?php }else{?>
            <input type="text" name="title" placeholder="What do you need to do?">
            <button type="submit">Add &nbsp; <span>&plus;</span></button>
            <?php }?>
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
                        class="check-box"
                       data-todo-id ="<?php echo $todo['id'];?>"
                        checked />
                <h2 class="checked"><?php echo $todo['title']?></h2>
            <?php }else  { ?>
                <input type="checkbox"
                       data-todo-id ="<?php echo $todo['id'];?>"
                       class="check-box" />
                <h2><?php echo $todo['title']?></h2>
            <?php }?>
            <br>
            <small>Created in:<?php echo $todo['date and time']?> </small>
        </div>
        <?php } ?>
    </div>
</div>

<script src="jquery-3.2.1.min.js"></script>

<script>
    $(document).ready(function (){
        $('.remove-to-do').click(function () {
            const id = $(this).attr('id');

            $.post("remove.php",
                {
                    id:id
                },
                (data) => {
                    if (data){
                        $(this).parent().hide(600);
                    }
                }
            );
        });

        $(".check-box").click(function (e) {
            const id = $(this).attr('data-todo-id');

            $.post("check.php",
                {
                    id: id
                },
                (data) => {
                    if (data != 'error'){
                        const h2 = $(this).next();
                        if (data === '1'){
                            h2.removeClass('checked');
                        }else {
                            h2.addClass('checked');
                        }
                    }
                }

            );

        })

    });
</script>
</body>
</html>