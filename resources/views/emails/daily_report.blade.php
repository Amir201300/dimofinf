<!DOCTYPE html>
<html dir="ltr" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-6">
            <h2>day users</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">phone</th>
                    <th scope="col">email</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $row)
                <tr>
                    <th scope="row">{{$row->id}}</th>
                    <td>{{$row->username}}</td>
                    <td>{{$row->phne}}</td>
                    <td>{{$row->email}}</td>
                </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-6">
            <h2>day posts</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">contact phone</th>
                </tr>
                </thead>
                @foreach($posts as $row)
                    <tr>
                        <th scope="row">{{$row->id}}</th>
                        <td>{{$row->title}}</td>
                        <td>{{$row->phone}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</body>
</html>
