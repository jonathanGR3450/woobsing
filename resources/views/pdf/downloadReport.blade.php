<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="">
        <table class="table table-bordered">
            <thead>
                <tr class="table-danger">
                    <th scope="col">Employee ID</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Department</th>
                    <th scope="col">Total access</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees ?? '' as $data)
                    <tr>
                        <td>{{ $data->present()->getId() }}</td>
                        <td>{{ $data->present()->getFirstName() }}</td>
                        <td>{{ $data->present()->getLastName() }}</td>
                        <td>{{ $data->present()->getDepartment() }}</td>
                        <td>{{ $data->present()->getAttempts() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
