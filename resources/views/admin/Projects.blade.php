<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مدیریت تسک‌ها</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

<div class="grid min-h-screen w-full overflow-hidden lg:grid-cols-[280px_1fr]">

    <!-- Navigation -->
    @include('admin.particles.nav')

    <!-- Main Content -->
    <div class="flex flex-col">
        <header class="flex h-14 items-center gap-4 bg-white shadow px-6">
            <h1 class="text-xl font-bold">مدیریت تسک‌ها</h1>
        </header>

        <main class="flex flex-col gap-6 p-6" style="direction: rtl">
            <!-- مدیریت تسک‌ها -->
            <section id="task-management" class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">مدیریت تسک‌ها</h2>

                <!-- پیام موفقیت -->
                @if (session('success'))
                    <div class="bg-green-100 text-green-600 p-4 rounded-md mb-4">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <!-- پیام خطا -->
                @if (session('error'))
                    <div class="bg-red-100 text-red-600 p-4 rounded-md mb-4">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <!-- لیست تسک‌ها -->
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">شناسه</th>
                        <th class="px-4 py-2 border">عنوان</th>
                        <th class="px-4 py-2 border">توضیحات</th>
                        <th class="px-4 py-2 border">وضعیت</th>
                        <th class="px-4 py-2 border">سرپرست</th>
                        <th class="px-4 py-2 border">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td class="px-4 py-2 border">{{ $project->id }}</td>
                            <td class="px-4 py-2 border">{{ $project->title }}</td>
                            <td class="px-4 py-2 border">{{ $project->description }}</td>
                            <td class="px-4 py-2 border">
                                    <span class="px-2 py-1 rounded-md {{ $project->is_completed ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ $project->is_completed ? 'تکمیل شده' : 'در حال انجام' }}
                                    </span>
                            </td>
                            <td class="px-4 py-2 border"> {{ $project->user->name  }} </td>
                            <td class="px-4 py-2 border flex gap-2 content-center">
                                <a href="" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">مشاهده گذارش ها</a>
                                {{--                                --}}
                                <a href="{{ route('project.edit', $project->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">ویرایش</a>
                                {{--                                --}}
                                <form action="{{ route('project.destroy', $project->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این پروژه مطمئن هستید؟');">
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

                <!-- افزودن تسک جدید -->
                <div class="mt-6">
                    <a href="{{ route('tasks.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">افزودن تسک جدید</a>
                </div>
            </section>
        </main>
    </div>
</div>

</body>
</html>
