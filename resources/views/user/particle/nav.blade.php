<nav class="bg-white shadow-lg lg:block hidden">
    <ul class="space-y-4 p-6">
        <li>
            <a href="#" class="block p-4 rounded-lg hover:bg-gray-200">{{ \Illuminate\Support\Facades\Auth::user()->name  }}</a>
        </li>
        <li>
            <a href="{{ route('emp.dashboard') }}" class="block p-4 rounded-lg hover:bg-gray-200">تسک های من</a>
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
