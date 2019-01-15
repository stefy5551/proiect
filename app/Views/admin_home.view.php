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
</div>
<div align="center">
    <table>
        <h2>Users</h2>
        <div>
            <th>Id</th>
            <th>Username</th>
            <th>Name</th>
            <tr></tr>
        </div>
        {% for result in all_results %}
        <tbody >
                <th>{{result.id}}</th>
                <th>{{result.username}}</th>
                <th>{{result.name}}</th>

                <form action="/admin/delete_user" method="post">
                <th><button class="button-secondary" name="user_id" value="{{result.id}}" type="submit">remove user</button></th>
                </form>

                <form action="/admin/make_doctor" method="post">
                <th><button class="button-secondary" name="user_id" value="{{result.id}}" type="submit">make doctor</button></th>
                </form>

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