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
    <a class="button button-secondary" href="appointments" type="submit">My appointments</a>
</div>
<div align="center">
    <form action="/user/make_appointment" method="post">
        <table>
            <h2>{{title}}</h2>

            <div>
                <th>Program id</th>
                <th>Name </th>
                <th>Specialization</th>
                <th>Day</th>
                <th>Start hour</th>
                <tr></tr>
            </div>

            {% for result in all_results %}
            <div>
                <th>{{result.id}} </th>
                <th>{{result.name}} </th>
                <th>{{result.specialization}}</th>
                <th>{{result.day}}</th>
                <th>{{result.start_hour}}</th>
                <th><button class="button-secondary" name="program_id" value="{{result.id}}" type="submit">make appointment</button></th>
                <tr></tr>
            </div>
            {% endfor %}
        </table>
    </form>
</div>
<div>
    <!--    error message from session -->
</div>

</body>
</html>