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
    @include('Supervisior.particle.nav')

    <!-- Main Content -->
    <div class="flex flex-col">
        <header class="flex h-14 items-center gap-4 bg-white shadow px-6">
            <h1 class="text-xl font-bold">مدیریت پروژه</h1>
        </header>

        <main class="flex flex-col gap-6 p-6" style="direction: rtl">
            <!-- اطلاعات پروژه -->
            <section id="project-info" class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">اطلاعات پروژه</h2>
                <p><strong>عنوان:</strong> {{ $project->title }}</p>
                <p><strong>توضیحات:</strong> {{ $project->description }}</p>
                <p><strong>وضعیت:</strong> {{ $project->is_completed ? 'تکمیل شده' : 'در حال انجام' }}</p>
                <p><strong>ددلاین:</strong>{{ \Morilog\Jalali\Jalalian::fromDateTime($project->deadline)->format('Y/m/d') }}</p>
            </section>

            <!-- فرم ایجاد تسک -->
            <section id="task-management" class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">مدیریت تسک‌ها</h2>

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

                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="task-title" class="block text-sm font-medium">عنوان تسک</label>
                        <input id="task-title" name="title" type="text"
                               class="block w-full mt-1 p-2 border rounded-md @error('title') border-red-500 @enderror"
                               placeholder="عنوان تسک را وارد کنید"
                               value="{{ old('title') }}">
                        @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="task-desc" class="block text-sm font-medium">توضیحات</label>
                        <textarea id="task-desc" name="description" rows="4"
                                  class="block w-full mt-1 p-2 border rounded-md @error('description') border-red-500 @enderror"
                                  placeholder="توضیحات تسک را وارد کنید">{{ old('description') }}</textarea>
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
                        <label for="task-user" class="block text-sm font-medium">کارمند تخصیص ‌یافته</label>
                        <select id="task-user" name="user_id"
                                class="block w-full mt-1 p-2 border rounded-md @error('user_id') border-red-500 @enderror">

                            @foreach($users as $user)
                                <option value="{{ $user->user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="hidden" name="supervisor_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id  }}">
                    <input type="hidden" name="project_id" value="{{ $project->id  }}">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">ایجاد تسک</button>
                </form>
            </section>

            <section id="assigned-employees" class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">تسک‌ها</h2>
                @if($tasks->isEmpty())
                    <p class="text-gray-500">هیچ تسکی یافت نشد.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">#</th>
                                <th class="px-4 py-2 border">نام پروژه</th>
                                <th class="px-4 py-2 border">تاریخ تسک</th>
                                <th class="px-4 py-2 border">نام کاربر</th>
                                <th class="px-4 py-2 border">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($tasks as $index => $task)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border">{{ $task->project->title ?? 'نامشخص' }}</td>
                                    <td class="px-4 py-2 border">{{ \Morilog\Jalali\Jalalian::fromDateTime($task->date)->format('Y/m/d') }}</td>
                                    <td class="px-4 py-2 border">{{ $task->user->name ?? 'کاربر نامشخص' }}</td>
                                    <td class="px-4 py-2 border flex gap-2 content-center">
{{--                                        {{ route('task.show', $task->id) }}--}}
                                        <a href="" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">گزارشات</a>
{{--                                        --}}
                                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('آیا از حذف این تسک اطمینان دارید؟')">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">هیچ تسکی یافت نشد.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

        </main>
    </div>
</div>

</body>
</html>
