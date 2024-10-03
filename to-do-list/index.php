<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
</head>

<body>

    <h1>To Do List</h1>

    <form action="./task-operation.php" method="post" id="taskOperation">
        <input type="hidden" name="operation" id="operation" value="add">
        <textarea name="task" id="task"></textarea>
        <button>ADD</button>
    </form>

    <ul>
        <?php
        include "./config.php";

        $result = mysqli_query($conn, "SELECT * FROM tasks");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>
                    <p id='task-{$row['id']}'>
                        {$row['description']}
                    </p>
                    <button onclick=\"editTaskForm('{$row['id']}')\">
                        Edit
                    </button>
                    <a href='./task-operation.php?operation=delete&id={$row['id']}'>
                        delete
                    </a>
                </li>";
            }
        } else {
            echo "<li>No Tasks Found</li>";
        }
        ?>
    </ul>

    <script>
        function editTaskForm(id) {
            var task = document.getElementById(`task-${id}`).innerText;

            document.getElementById("task").innerText = task;

            document.getElementById("operation").value = "edit";

            document.getElementById("taskOperation").innerHTML += `<input type='hidden' name='taskId' value='${id}'>`;
        }
    </script>
</body>

</html>