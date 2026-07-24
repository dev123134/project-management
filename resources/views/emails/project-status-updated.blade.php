<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Project Status Updated</title>
</head>

<body style="font-family:Arial;background:#f4f4f4;padding:30px;">

<div style="max-width:600px;margin:auto;background:white;border-radius:8px;overflow:hidden;">

<div style="background:#0d6efd;color:white;padding:20px;">
<h2>Project Status Updated</h2>
</div>

<div style="padding:25px;">

<p>Hello <strong>{{ $project->client->name }}</strong>,</p>

<p>Your project status has been updated.</p>

<table width="100%" cellpadding="8">

<tr>
<td><strong>Project</strong></td>
<td>{{ $project->title }}</td>
</tr>

<tr>
<td><strong>Current Status</strong></td>
<td>{{ $project->status }}</td>
</tr>

<tr>
<td><strong>Deadline</strong></td>
<td>{{ $project->deadline }}</td>
</tr>

</table>

<br>

<p>Please login to the Project Management System for more details.</p>

</div>

<div style="background:#eee;padding:15px;text-align:center;">
© {{ date('Y') }} Project Management System
</div>

</div>

</body>

</html>