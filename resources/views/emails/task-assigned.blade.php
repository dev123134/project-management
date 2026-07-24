<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Task Assigned</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background:#f4f4f4; padding:30px;">

    <div style="max-width:600px; margin:auto; background:#ffffff; border-radius:8px; overflow:hidden;">

        <div style="background:#0d6efd; color:white; padding:20px;">
            <h2 style="margin:0;">New Task Assigned</h2>
        </div>

        <div style="padding:25px;">

            <p>Hello <strong>{{ $task->assignee->name }}</strong>,</p>

            <p>A new task has been assigned to you.</p>

            <table cellpadding="8" cellspacing="0" width="100%" style="border-collapse:collapse;">

                <tr>
                    <td><strong>Project</strong></td>
                    <td>{{ $task->project->title }}</td>
                </tr>

                <tr>
                    <td><strong>Task</strong></td>
                    <td>{{ $task->title }}</td>
                </tr>

                <tr>
                    <td><strong>Description</strong></td>
                    <td>{{ $task->description }}</td>
                </tr>

                <tr>
                    <td><strong>Priority</strong></td>
                    <td>{{ $task->priority }}</td>
                </tr>

                <tr>
                    <td><strong>Due Date</strong></td>
                    <td>{{ $task->due_date }}</td>
                </tr>

                <tr>
                    <td><strong>Assigned By</strong></td>
                    <td>{{ $task->assigner->name }}</td>
                </tr>

            </table>

            <br>

            <p>
                Please login to the Project Management System and complete the task before the due date.
            </p>

            <br>

            <p>Thank You.</p>

        </div>

        <div style="background:#eeeeee; padding:15px; text-align:center; font-size:13px; color:#555;">
            © {{ date('Y') }} Project Management System
        </div>

    </div>

</body>
</html>