<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>داشبورد مدیریت</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

<div class="grid min-h-screen w-full overflow-hidden lg:grid-cols-[280px_1fr]">

    <!-- Navigation -->
    @include('admin.particles.nav')
    <!-- Main Content -->
    <div class="flex flex-col">
        <header class="flex h-14 items-center gap-4 bg-white shadow px-6">
            <h1 class="text-xl font-bold">داشبورد مدیریت</h1>
        </header>

        <main class="flex flex-col gap-6 p-6" style="direction: rtl">
            <section id="user-management" class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">مدیریت کاربران</h2>

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

                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="user-name" class="block text-sm font-medium">نام کاربر</label>
                        <input id="user-name" name="name" type="text"
                               class="block w-full mt-1 p-2 border rounded-md @error('name') border-red-500 @enderror"
                               placeholder="نام کاربر را وارد کنید" value="{{ old('name') }}">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="user-email" class="block text-sm font-medium">ایمیل</label>
                        <input id="user-email" name="email" type="email"
                               class="block w-full mt-1 p-2 border rounded-md @error('email') border-red-500 @enderror"
                               placeholder="ایمیل کاربر را وارد کنید" value="{{ old('email') }}">
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="user-password" class="block text-sm font-medium">رمز عبور</label>
                        <input id="user-password" name="password" type="password"
                               class="block w-full mt-1 p-2 border rounded-md @error('password') border-red-500 @enderror"
                               placeholder="رمز عبور را وارد کنید">
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="user-role" class="block text-sm font-medium">نقش</label>
                        <select id="user-role" name="role_id"
                                class="block w-full mt-1 p-2 border rounded-md @error('role') border-red-500 @enderror">
                            <option value="1" {{ old('role_id') == '1' ? 'selected' : '' }}>مدیر</option>
                            <option value="2" {{ old('role_id') == '2' ? 'selected' : '' }}>سرپرست</option>
                            <option value="3" {{ old('role_id') == '3' ? 'selected' : '' }}>کاربر</option>
                        </select>
                        @error('role_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        ثبت
                    </button>
                </form>
            </section>
        </main>
    </div>
</div>

</body>
</html>
