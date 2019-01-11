<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.css" />
</head>
<body><!-- Tab links -->

<div  align="right">
    <a class="button button-secondary" href="logout" role="button">Log out</a>
</div>
<div class="tab" align="center">
    <h1> Hello {{name}}</h1>
    <a class="button button-secondary" href="program" type="submit">My program</a>
    <a class="button button-secondary" href="appointments" type="submit">My appointments</a>
</div>
<div align="center">
    <form action="/doctor/cancel_appointment" method="post">
        <table>
            <h2>{{title}}</h2>
            <div>
                <th>Id</th>
                <th>Username</th>
                <th>Name</th>
                <th>Day</th>
                <th>Start hour</th>
                <tr></tr>
            </div>
            {% for result in all_results %}
            <div>
                <th>{{result.id}}</th>
                <th>{{result.username}}</th>
                <th>{{result.name}}</th>
                <th>{{result.day}}</th>
                <th>{{result.start_hour}}</th>
                <th><button class="button-secondary" name="program_id" value="{{result.id}}" type="submit">cancel appointment</button></th>
                <tr></tr>
            </div>
            {% endfor %}
        </table>
        <form/>
</div>

</body>
</html>