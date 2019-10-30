<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }
</style>

<body>
    <section class="section">
        <div class="container">
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>username</th>
                        <th>password</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$d->nis}}</td>
                        <td>{{$d->nama}}</td>
                        <td>{{$d->pivot->exam_account_num}}</td>
                        <td>{{$d->pivot->gerated_password}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </section>
</body>

</html>
