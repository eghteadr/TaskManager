<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مدیریت کاربران</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

<div class="grid min-h-screen w-full overflow-hidden lg:grid-cols-[280px_1fr]">

    <!-- Navigation -->
    @include('admin.particles.nav')

    <!-- Main Content -->
    <div class="flex flex-col">
        <header class="flex h-14 items-center gap-4 bg-white shadow px-6">
            <h1 class="text-xl font-bold">مدیریت کاربران</h1>
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

                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">شناسه</th>
                        <th class="px-4 py-2 border">نام</th>
                        <th class="px-4 py-2 border">ایمیل</th>
                        <th class="px-4 py-2 border">نقش</th>
                        <th class="px-4 py-2 border">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-4 py-2 border">{{ $user->id }}</td>
                            <td class="px-4 py-2 border">{{ $user->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->email }}</td>
                            <td class="px-4 py-2 border">
                                @if ($user->role_id == 1)
                                    مدیر
                                @elseif ($user->role_id == 2)
                                    سرپرست
                                @elseif ($user->role_id == 3)
                                    کارمند
                                @else
                                    نقش ناشناخته
                                @endif
                            </td>
                            <td class="px-4 py-2 border flex gap-2 content-center">
{{--                                {{ route('users.edit', $user->id) }}--}}
                                <a href="" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">ویرایش</a>
{{--                                --}}
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این کاربر مطمئن هستید؟');">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">حذف</button>
                                </form>

                                @if ($user->role_id == 2)
                                    <a href="{{ route('team.create' , $user->id)  }}" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">ساخت گروه</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-500">هیچ کاربری یافت نشد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-6">
                    <a href="{{ route('users.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">افزودن کاربر جدید</a>
                </div>
            </section>
        </main>
    </div>
</div>

</body>
</html>
