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
        <main class="flex flex-col gap-6 p-6">

            <section id="task-management" class="bg-white shadow p-6 rounded-lg" style="direction: rtl">
                <h2 class="text-lg font-bold mb-4">تعریف پروژه جدید</h2>

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

                <form action="{{ route('project.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="task-title" class="block text-sm font-medium">عنوان پروژه</label>
                        <input id="task-title" name="title" type="text"
                               class="block w-full mt-1 p-2 border rounded-md @error('title') border-red-500 @enderror"
                               placeholder="عنوان پروژه را وارد کنید"
                               value="{{ old('title') }}">
                        @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="task-desc" class="block text-sm font-medium">توضیحات</label>
                        <textarea id="task-desc" name="description" rows="4"
                                  class="block w-full mt-1 p-2 border rounded-md @error('description') border-red-500 @enderror"
                                  placeholder="توضیحات پروژه را وارد کنید">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="task-deadline" class="block text-sm font-medium">مهلت زمانی</label>
                        <input id="task-deadline" name="deadline" type="date"
                               class="block w-full mt-1 p-2 border rounded-md @error('deadline') border-red-500 @enderror"
                               value="{{ old('deadline') }}">
                        @error('deadline')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="task-priority" class="block text-sm font-medium">وضعیت</label>
                        <select id="task-priority" name="status"
                                class="block w-full mt-1 p-2 border rounded-md @error('status') border-red-500 @enderror">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>در انتظار</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>در حال انجام</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>تکمیل شده</option>
                        </select>
                        @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="task-user" class="block text-sm font-medium">سرپرست تخصیص ‌یافته</label>
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
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">ایجاد پروژه</button>
                </form>
            </section>

        </main>
    </div>
</div>

</body>
</html>
