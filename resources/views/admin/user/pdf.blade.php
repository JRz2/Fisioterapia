<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <style>
        h1{
            text-align: center;
        }

        table{
            width: 100%;
            border: 1px solid #000;
        }
        td {
            page-break-inside: auto;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        th {
            color: #000000;
            background-color: #ADD8E6;
            border: 1px solid #000;
            page-break-inside: auto;
            border-collapse: collapse;
        }
        
        @page {
            margin-left: 2.54cm;
            margin-right: 2.54cm;
            margin-top: 2.00cm;
            margin-bottom: 2.00cm;
        }
        body{
            background-image: url("/vendor/adminlte/dist/img/logo.jpg");
        }

        .logo{
            margin-top: -50px;    
            margin-left: -50px;  
            width: 130px;
            height: 80px;
        }
    </style>
</head>
<body>
    <img src="vendor/adminlte/dist/img/logo.jpg" width="150" height="120" class="logo">
<h1> REGISTRO DE USUARIOS</h1>
    <table id="usuarios" class="table table-striped">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </thead>
        <tbody>
            @foreach ($user as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>  
                    <td>
                        @forelse ($user->roles as $rol)
                        <span class="badge badge-info">{{$rol->name}}</span>
                        @empty
                        <span class="badge badge-danger">No asignado</span>
                        @endforelse
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>