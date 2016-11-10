<ul>
    @if (count($tasks) > 0)
        @foreach ($tasks as $task)
            <li>
                {{ $task->title }}
                {{ $task->status }}
            </li>
        @endforeach
    @else
        No tasks.
    @endif
</ul>
