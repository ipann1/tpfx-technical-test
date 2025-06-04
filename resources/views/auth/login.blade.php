<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>

        @if(session('error'))
            <div class="mb-4 text-sm text-red-600">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="mb-4">
                <label for="login" class="block text-sm font-medium text-gray-700">Username or Email</label>
                <input type="text" name="login" id="login" required autofocus 
                class="mt-1 w-full p-2 border rounded-md border-gray-300 focus:outline-none focus:ring focus:ring-cyan-300">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                class="mt-1 w-full p-2 border rounded-md border-gray-300 focus:outline-none focus:ring focus:ring-cyan-300">
            </div>

            <button type="submit"
                    class="w-full my-5 bg-cyan-600 hover:bg-cyan-700 text-white font-semibold py-2 px-4 rounded shadow">
                Login
            </button>
        </form>
    </div>
</body>
</html>
