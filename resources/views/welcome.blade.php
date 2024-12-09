<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم لاگین</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            direction: rtl;
        }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

<div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
    <h2 class="text-2xl font-semibold text-center mb-6">ورود به حساب کاربری</h2>
    @if (session('success'))
        <div class="bg-green-100 text-green-600 p-4 rounded-md mb-4">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-600 p-4 rounded-md mb-4">
            <p>{{ session('error') }}</p>
        </div>
    @endif



    <form action="{{ url('login') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">ایمیل</label>
            <input type="email" id="email" name="email"
                   class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="ایمیل خود را وارد کنید" required value="{{ old('email') }}">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700">رمز عبور</label>
            <input type="password" id="password" name="password"
                   class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="رمز عبور خود را وارد کنید" required>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-300">
            ورود
        </button>
    </form>
</div>

</body>
</html>
