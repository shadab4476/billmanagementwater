<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border: 1px solid #ddd;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        th,
        td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
        }

        thead th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-transform: uppercase;
            color: #333;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-transform: capitalize;
        }

        .btn-edit {
            background-color: #4caf50;
        }

        .btn-edit:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-delete:hover {
            background-color: #e53935;
        }

        input[type="checkbox"] {
            cursor: pointer;
        }

        .status-active {
            color: green;
            font-weight: bold;
        }

        .status-inactive {
            color: orange;
            font-weight: bold;
        }

        .no-record {
            color: green;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <section>
        <h1>Healthy Drinking Water</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    @auth
                        @role(['superAdmin', 'admin'])
                            <th>Status</th>
                        @endrole
                    @endauth
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id ?? '-' }}</td>
                        <td>{{ $user->name ?? '-' }}</td>
                        <td>{{ $user->email ?? '-' }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span
                                    style="color: 
                                    {{ $role->name == 'admin' ? 'green' : ($role->name == 'user' ? 'red' : ($role->name == 'superAdmin' ? 'blue' : 'black')) }}">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </td>

                        @auth
                            @role(['superAdmin', 'admin'])
                                @foreach ($isActive as $activeUser)
                                    @if ($user->id == $activeUser->id)
                                        <td class="{{ $activeUser->status == 1 ? 'status-active' : 'status-inactive' }}">
                                            {{ $activeUser->status == 1 ? 'Active' : 'Inactive' }}
                                        </td>
                                    @endif
                                @endforeach
                            @endrole
                        @endauth

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="no-record">No record found..!!!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <p> <strong>Generated On: {{ Date('Y-m-d') }} </strong></p>

    </section>
</body>

</html>
