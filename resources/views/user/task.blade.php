<div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div>
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
    @include('user.particle.nav')

    <!-- Main Content -->
    <div class="flex flex-col">
        <header class="flex h-14 items-center gap-4 bg-white shadow px-6">
            <h1 class="text-xl font-bold">مدیریت پروژه</h1>
        </header>

        <main class="flex flex-col gap-6 p-6" style="direction: rtl">
            <!-- اطلاعات پروژه -->
            <section id="project-info" class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">اطلاعات پروژه</h2>
                <p><strong>عنوان:</strong> {{ $task->title }}</p>
                <p><strong>توضیحات:</strong> {{ $task->description }}</p>
                <p><strong>وضعیت:</strong> {{ $task->is_completed ? 'تکمیل شده' : 'در حال انجام' }}</p>
                <p><strong>ددلاین:</strong>{{ \Morilog\Jalali\Jalalian::fromDateTime($task->deadline)->format('Y/m/d') }}</p>
            </section>

            <section id="task-management" class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">گذارش</h2>

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

                <form action="" method="POST" class="space-y-4">
                    @csrf


                    <div>
                        <label for="task-priority" class="block text-sm font-medium">تسک در چه مرحله ای قرار دارد؟</label>
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

                    <input type="hidden" name="supervisor_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id  }}">
                    <input type="hidden" name="project_id" value="{{ $task->id  }}">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">ثبت</button>
                </form>
            </section>
            <div id="timer-container" class="p-6 bg-white shadow rounded-lg">
                @if (session('success-time'))
                    <div class="bg-green-100 text-green-600 p-4 rounded-md mb-4">
                        <p>{{ session('success-time') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 text-red-600 p-4 rounded-md mb-4">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                <h2 class="text-lg font-bold mb-4">تایمر</h2>
                <p class="text-sm font-medium">زمان گذشته:</p>
                <p id="time-display" class="text-xl font-bold">00:00:00</p>
                <button id="start-button" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">شروع</button>
                <button id="stop-button" class="bg-red-500 text-white px-4 py-2 rounded-md mt-4 hidden">توقف</button>
                <button id="save-button" class="bg-green-500 text-white px-4 py-2 rounded-md mt-4 hidden">ثبت زمان</button>

                <form id="time-form" action="{{ route('emp.store.task.time') }}" method="POST" class="hidden">
                    @csrf
                    <input type="hidden" name="time" id="elapsed_time_minutes">
                    <input type="hidden" name="project_id" value="{{ $task->project->id }}">
                    <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id  }}">
                    <button type="submit" class="hidden"></button>
                </form>
            </div>


        </main>
    </div>
</div>
<script>
    let startTime;
    let elapsedTime = 0;
    let timerInterval;
    let isTimerRunning = false;

    // Function to update the timer
    function updateTimer() {
        elapsedTime = Date.now() - startTime;
        let hours = Math.floor(elapsedTime / 3600000);
        let minutes = Math.floor((elapsedTime % 3600000) / 60000);
        let seconds = Math.floor((elapsedTime % 60000) / 1000);

        // Format time as HH:MM:SS
        let formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        // Display the timer
        document.getElementById('time-display').textContent = formattedTime;

        // Save the elapsed time in localStorage
        localStorage.setItem('elapsedTime', elapsedTime.toString());
    }

    // Start the timer when the start button is clicked
    document.getElementById('start-button').addEventListener('click', function() {
        if (!isTimerRunning) {
            // Check if there's a stored time and continue from there
            let storedTime = localStorage.getItem('elapsedTime');
            startTime = storedTime ? Date.now() - parseInt(storedTime) : Date.now(); // Start from stored time or current time

            // Start the timer
            timerInterval = setInterval(updateTimer, 1000);
            isTimerRunning = true; // Timer is now running

            // Show stop button and hide start button
            document.getElementById('stop-button').classList.remove('hidden');
            this.classList.add('hidden');
        }
    });

    // Stop the timer when the stop button is clicked
    document.getElementById('stop-button').addEventListener('click', function() {
        clearInterval(timerInterval); // Stop the timer
        isTimerRunning = false; // Timer is now stopped

        // Save the elapsed time in localStorage
        localStorage.setItem('elapsedTime', elapsedTime.toString());

        // Show save button and hide stop button
        document.getElementById('save-button').classList.remove('hidden');
        this.classList.add('hidden');
    });

    // Save the time when the save button is clicked
    document.getElementById('save-button').addEventListener('click', function() {
        // Convert elapsed time to minutes
        let elapsedMinutes = Math.floor(elapsedTime / 60000);

        // Set the hidden input value
        document.getElementById('elapsed_time_minutes').value = elapsedMinutes;

        // Submit the form
        document.getElementById('time-form').submit();

        // Clear the elapsed time from localStorage after saving
        localStorage.removeItem('elapsedTime');
    });


    // Initial setup to handle button visibility
    window.addEventListener('DOMContentLoaded', function() {
        // If the timer was running previously, restore the timer
        let storedTime = localStorage.getItem('elapsedTime');
        if (storedTime && !isTimerRunning) {
            startTime = Date.now() - parseInt(storedTime);
            document.getElementById('stop-button').classList.remove('hidden');
            document.getElementById('start-button').classList.add('hidden');
            timerInterval = setInterval(updateTimer, 1000);
            isTimerRunning = true;
        } else {
            document.getElementById('start-button').classList.remove('hidden');
        }
    });
</script>

</body>
</html>
