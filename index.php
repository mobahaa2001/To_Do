<?php

$todos = [];
if (file_exists('todo.json')) {
    $json = file_get_contents('todo.json');
    $todos = json_decode($json, true);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="newToDo.php" method="post">
        <input type="text" name="todo_name" placeholder="Enter Your ToDo">
        <button>New ToDo</button>
    </form>
    <br>

    <?php foreach ($todos as $todoName => $todo) : ?>
        <div style="margin-bottom:20px;">
            <form style="display: inline-block" action="change_status.php" method="post">
                <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
                <input type="checkbox" <?php $todo['completed'] ? 'checked' : '' ?>>
            </form>
            <?php echo $todoName; ?>
            <form style="display: inline-block" action="delete.php" method="post">
                <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
                <button>Delete</button>
            </form>
        </div>
    <?php endforeach; ?>

    <script>
        const checkboxes = document.querySelectorAll('input[type= checkbox][name=todo_name]');
        checkboxes.forEach(x => {
            x.onClick = function() {
                this.parentNode.submit();
            };
        })
    </script>
</body>

</html>
