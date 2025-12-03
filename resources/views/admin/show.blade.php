<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header>
    <h1>Hello</h1>
    <h1>{{$challenge->title}}</h1>
</header>
<main>
    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Challenge Details</h2>
            <p><strong>ID:</strong> {{ $challenge->id }}</p>
            <p><strong>Title:</strong> {{ $challenge->title }}</p>
            <p><strong>Description:</strong> {{ $challenge->description }}</p>
            <p><strong>Difficulty:</strong> {{ $challenge->difficulty_id }}</p>
            <p><strong>User ID:</strong> {{ $challenge->user_id }}</p>
            <p><strong>Badge:</strong> {{ $challenge->badge_id }}</p>
            <p><strong>Published:</strong> {{ $challenge->published ? 'Published' : 'Unpublished' }}</p>
            <p><strong>Duration:</strong> {{ $challenge->duration }}</p>
            @if($challenge->steps->isNotEmpty())
            @foreach($challenge->steps as $step)
                <p>
                    <strong>#{{ $step->step_number }}</strong>
                    <div>{!! nl2br(e($step->step_description)) !!}</div>
                </p>
                @endforeach
                @else
                    <p>No steps available.</p>
                @endif
            <p><strong>Created at:</strong> {{ $challenge->created_at }}</p>
            <p><strong>Updated at:</strong> {{ $challenge->updated_at }}</p>
        </div>
    </div>
</main>
</body>
</html>
