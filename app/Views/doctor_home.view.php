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
    <table>
        <h2>{{title}}</h2>
        <div>
            <th>Name</th>
            <th>Specialization</th>
            <tr></tr>
        </div>
        {% for result in all_results %}
        <tbody >
        <th>{{result.name}}</th>
        <th>{{result.specialization}}</th>
        <tr></tr>
        </tbody>
        {% endfor %}
    </table>
</div>
<div>
    <!--    error message from session -->
</div>

</body>
</html>