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
    <a class="button button-secondary" href="doctors" type="submit">Doctors</a>
    <a class="button button-secondary" href="specializations" type="submit">Specializations</a>
    <a class="button button-secondary" href="program" type="submit">Doctor program</a>
    <a class="button button-secondary" href="appointments" type="submit">Appointments</a>
</div>
<div align="center">
    <table>
        <h2>{{title}}</h2>
        <div>
            <th>Specialization</th>
            <tr></tr>
        </div>
        {% for result in all_results %}
        <div>
            <th>{{result.specialization}}</th>
            <tr></tr>
        </div>
        {% endfor %}
    </table>
</div>

</body>
</html>