<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مدیریت پروژه</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

<div class="grid min-h-screen w-full overflow-hidden lg:grid-cols-[280px_1fr]">

    <!-- Navigation -->
    @include('admin.particles.nav')

    <!-- Main Content -->
    <div class="flex flex-col">
        <header class="flex h-14 items-center gap-4 bg-white shadow px-6">
            <h1 class="text-xl font-bold">مدیریت پروژه</h1>
        </header>

        <main class="flex flex-col gap-6 p-6" style="direction: rtl">
            <section id="project-info" class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">اطلاعات سرپرست</h2>
                <p><strong>نام سرپرست :</strong> {{ $supervisor->name }}</p>

            </section>

            <section id="task-management" class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">ساخت گروه</h2>

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

                <form action="{{ route('team.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="supervisor_id" value="{{ $supervisor->id  }}">

                    <div>
                        <label for="task-user" class="block text-sm font-medium">کارمند تخصیص ‌یافته</label>
                        <select id="task-user" name="user_id"
                                class="block w-full mt-1 p-2 border rounded-md @error('user_id') border-red-500 @enderror">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

{{--                    <input type="hidden" name="project_id" value="{{ $project->id  }}">--}}
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">افزودن</button>
                </form>
            </section>

            <section id="assigned-employees" class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">کارمندان تخصیص‌یافته</h2>

                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">نام کارمند</th>
                        <th class="border border-gray-300 px-4 py-2">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teamMembers as $index => $teamMember)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $teamMember->user ? $teamMember->user->name : 'کاربر نامشخص' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <form method="POST" action="{{ route('team.destroyfromteam', $teamMember->id) }}">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                         حذف کارمند از این تیم
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</div>

</body>
</html>
