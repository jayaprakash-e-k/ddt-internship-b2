<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>

    <h1>To Do List</h1>

    <form action="./task-operation.php" method="post" id="taskOperation">
        <input type="hidden" name="operation" id="operation" value="add">
        <textarea name="task" id="task"></textarea>
        <button>ADD</button>
    </form>

    <ul id="task-list">
        <li>
            <p id='task-3' $isCompleted onclick="changeStatus('3')">
                {$row['description']}
            </p>
            <button onclick="editTaskForm('3')">
                Edit
            </button>
            <a href='./task-operation.php?operation=delete&id=3'>
                delete
            </a>
        </li>
    </ul>

    <script>
        $(document).ready(function() {
            getTasks();
        });

        function editTaskForm(id) {
            var task = document.getElementById(`task-${id}`).innerText;

            // document.getElementById("task").innerText = task;
            $("#task").text(task);
            document.getElementById("operation").value = "edit";

            document.getElementById("taskOperation").innerHTML += `<input type='hidden' name='taskId' value='${id}'>`;
        }

        function changeStatus(id) {
            $.ajax({
                url: './task-operation.php',
                method: 'POST',
                data: {
                    taskId: id,
                    operation: 'updateStatus'
                },
                success: function(data) {
                    console.log(data);
                    getTasks();
                }
            });
        }

        function getTasks() {
            $.ajax({
                url: './task-operation.php',
                method: 'GET',
                data: {
                    operation: 'getAllTasks'
                },
                success: function(response) {
                    var data = JSON.parse(response);

                    if (data.status == "success") {

                        $("#task-list").html("");
                        data.data.forEach((element) => {
                            var isCompleted = element.is_completed == 1 ? "style='color: green';" : "";

                            var task = `<li>
                                            <p id='task-${element.id}' ${isCompleted} onclick="changeStatus(${element.id})">
                                                ${element.description}
                                            </p>
                                            <button onclick="editTaskForm(${element.id})">
                                                Edit
                                            </button>
                                            <a href='./task-operation.php?operation=delete&id=${element.id}'>
                                                delete
                                            </a>
                                        </li>`;

                            $("#task-list").append(task);
                        });

                    } else {
                        alert(data.message);
                    }
                }
            })
        }
    </script>
</body>

</html>