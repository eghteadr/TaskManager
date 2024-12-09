<nav class="bg-white shadow-lg lg:block hidden">
    <ul class="space-y-4 p-6">
        <li>
            <a href="#" class="block p-4 rounded-lg hover:bg-gray-200">داشبورد</a>
        </li>
        <li>
            <a href="{{ route('users.create')  }}" class="block p-4 rounded-lg hover:bg-gray-200">افزودن کاربران</a>
        </li>
        <li>
            <a href="{{ route('users.index')  }}" class="block p-4 rounded-lg hover:bg-gray-200">همه کاربران</a>
        </li>
        <li>
            <a href="{{ route('tasks.create')  }}" class="block p-4 rounded-lg hover:bg-gray-200">افزودن پروژه جدید</a>
        </li>
        <li>
            <a href="{{ route('project.index')  }}" class="block p-4 rounded-lg hover:bg-gray-200">مشاهده همه پروژه ها</a>
        </li>


        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">
                    خروج از حساب
                </button>
            </form>

        </li>
    </ul>
</nav>
