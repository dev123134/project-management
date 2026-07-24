<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Project Assigned</title>
</head>
<body>

<h2>Project Assigned</h2>

<table border="1" cellpadding="8" cellspacing="0">

<tr>
    <th>Project</th>
    <td>{{ $project->title }}</td>
</tr>

<tr>
    <th>Description</th>
    <td>{{ $project->description }}</td>
</tr>

<tr>
    <th>Start Date</th>
    <td>{{ $project->start_date }}</td>
</tr>

<tr>
    <th>Deadline</th>
    <td>{{ $project->deadline }}</td>
</tr>

<tr>
    <th>Budget</th>
    <td>{{ $project->budget }}</td>
</tr>

<tr>
    <th>Status</th>
    <td>{{ $project->status }}</td>
</tr>

</table>

<p>
Please login to Project Management System for more details.
</p>

</body>
</html>