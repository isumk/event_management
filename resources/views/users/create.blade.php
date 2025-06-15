<x-app-layout>
    <div class="form-container">
        <h1>Add New User</h1>

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required />

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required />

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />

            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required />

            <label for="role_id">Role</label>
            <select name="role_id" id="role_id" required>
                <option value="">Select Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Create User</button>
        </form>
    </div>

    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
        }

        .form-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            color: #333;
        }

        h1 {
            font-size: 1.75em;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            margin-top: 15px;
        }

        input,
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 4px;
            box-sizing: border-box;
            font-size: 0.95em;
            transition: border 0.3s;
        }

        input:focus,
        select:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #2980b9;
        }

        .alert-error {
            background: #ffe6e6;
            color: #c0392b;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-error ul {
            margin-left: 20px;
        }
    </style>
</x-app-layout>
