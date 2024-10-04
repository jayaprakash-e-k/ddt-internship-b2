<?php
include "./config.php";

if (isset($_GET['operation']) && $_GET['operation'] == "getAllTasks") {

    $result = mysqli_query($conn, "SELECT * FROM tasks");

    $response = [];
    if (mysqli_num_rows($result) > 0) {
        $tasks = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row;
        }

        $response['status'] = "success";
        $response['data'] = $tasks;
    } else {
        $response['status'] = "error";
        $response['message'] = "No data found";
    }

    echo json_encode($response);
}

if (isset($_POST['operation']) && $_POST['operation'] == "add" && isset($_POST['task'])) {
    $task = $_POST['task'];

    $result = mysqli_query($conn, "INSERT INTO tasks (description) VALUES ('$task');");

    if ($result) {
        header("Location: ./?msg=Task Added Successfully");
        exit();
    } else {
        header("Location: ./?msg=Operation failed");
        exit();
    }
}

if (isset($_GET['operation']) && $_GET['operation'] == "delete" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM tasks WHERE id='$id'");

    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_query($conn, "DELETE FROM tasks WHERE id='$id'");

        if ($result) {
            header("Location: ./?msg=Task Deleted Successfully");
            exit();
        } else {
            header("Location: ./?msg=Operation failed");
            exit();
        }
    } else {
        header("Location: ./?msg=Task not found");
        exit();
    }
}

if (isset($_POST['operation']) && $_POST['operation'] == "edit" && isset($_POST['task']) && isset($_POST['taskId'])) {

    $task = $_POST['task'];
    $taskId = $_POST['taskId'];

    $result = mysqli_query($conn, "SELECT * FROM tasks WHERE id='$taskId'");

    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_query($conn, "UPDATE tasks SET description='$task' WHERE id='$taskId'");

        if ($result) {
            header("Location: ./?msg=Task Updated Successfully");
            exit();
        } else {
            header("Location: ./?msg=Operation failed");
            exit();
        }
    } else {
        header("Location: ./?msg=Task not found");
        exit();
    }
}

if (isset($_POST['operation']) && $_POST['operation'] == "updateStatus" && isset($_POST['taskId'])) {

    $taskId = $_POST['taskId'];

    $result = mysqli_query($conn, "SELECT * FROM tasks WHERE id='$taskId'");

    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_query($conn, "UPDATE tasks SET is_completed='1' WHERE id='$taskId'");

        if ($result) {
            echo "Task updated successfully";
            exit();
        } else {
            echo "Operation failed";
            exit();
        }
    } else {
        echo "Task not found";
        exit();
    }
}
