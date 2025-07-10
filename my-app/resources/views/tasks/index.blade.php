<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <nav class="flex justify-between">
            <h1 class="text-2xl font-bold">Taskリスト</h1>
        </nav>
    </div>

    <form action="{{ route('tasks.store') }}" method="POST" class="container mx-auto p-4">
        @csrf
        <div class="mb-4">
            <input type="text" name="task_name" placeholder="新しいタスクを入力"
                     class="border border-gray-300 p-2 w-full" required>
            <input type="datetime-local" name="due_date" class="border border-gray-300 p-2 w-full mt-2" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2">追加</button>
        </div>
    </form>

    <ul>
        @foreach ($tasks as $task)
            <li>{{ $task->task_name }}</li>
        @endforeach
    </ul>
</body>
</html>