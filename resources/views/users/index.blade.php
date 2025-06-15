<x-app-layout>
    <div class="container">
        <h1>User Management</h1>

        <a href="{{ route('users.create') }}" class="btn">Add New User</a>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name ?? 'N/A' }}</td>
                        <td class="actions">
                            <a href="{{ route('users.edit', $user) }}">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>

    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            color: #333;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.3s;
            margin-bottom: 20px;
        }

        .btn:hover {
            background: #2980b9;
        }

        .alert-success {
            background: #e1f7e1;
            color: #2ecc71;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-top: 10px;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        thead {
            background: #ecf0f1;
        }

        tr:nth-child(even) {
            background: #fafafa;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .actions a,
        .actions button {
            margin-right: 10px;
            color: #3498db;
            text-decoration: none;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            font: inherit;
        }

        .actions button {
            color: #e74c3c;
        }

        .actions a:hover,
        .actions button:hover {
            text-decoration: underline;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
</x-app-layout>
