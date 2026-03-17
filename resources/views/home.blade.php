<!DOCTYPE html>
<html>
<head>
    <title>My Task Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .task {
            background: #f4f4f4;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .completed {
            text-decoration: line-through;
            color: green;
        }
        form {
            display: inline;
            margin-left: 10px;
        }
        button {
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        .delete {
            background: red;
            color: white;
        }
        .complete {
            background: blue;
            color: white;
        }
    </style>
</head>
<body>
   @include('layouts.navigation')

    <div class="container">
        <h1>Welcome to the Task Manager</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Task title" value="{{ old('title') }}" required>
            @error('title')
                <p style="color:red;font-size:12px;">{{ $message }}</p>
            @enderror
            
            <textarea name="description" placeholder="Task description">{{ old('description') }}</textarea>
            @error('description')
                <p style="color:red;font-size:12px;">{{ $message }}</p>
            @enderror
            
            <button type="submit">Add Task</button>
        </form>

        <h2>Your Tasks</h2>

        @if($tasks->count() > 0)
            @foreach($tasks as $task)
                <div class="task {{ $task->is_completed ? 'completed' : '' }}">
                    <strong>{{ $task->title }}</strong>
                    @if($task->description)
                        <p>{{ $task->description }}</p>
                    @endif
                    
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete">Delete</button>
                    </form>
                    
                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="complete">
                            {{ $task->is_completed ? 'Undo' : 'Complete' }}
                        </button>
                    </form>
                </div>
            @endforeach
        @else
            <p>No tasks yet. Add your first task!</p>
        @endif
    </div>
</body> 
</html>