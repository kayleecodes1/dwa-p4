<ul>
    @foreach ($tasks as $task)
        <li>
            {{ $task->title }}
            {{ $task->status }}
        </li>
    @endforeach
</ul>
