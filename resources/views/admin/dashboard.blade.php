<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<header>
    <h1>Admin</h1>
</header>
<main>
    <table class="mx-auto">
        <thead>
        <tr>
            <th>ID</th><th>Title</th><th>Description</th><th>Difficulty</th><th>User ID</th>
            <th>Badge</th><th>Published</th><th>Duration</th><th>Created at</th><th>Updated at</th><th>Show</th><th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($challenges as $challenge)
            <tr class="border-t">
                <td>{{ $challenge->id }}</td>
                <td>{{ $challenge->title }}</td>
                <td>{{ Str::limit($challenge->description, 20) }}</td>
                <td>{{ $challenge->difficulty_id }}</td>
                <td>{{ $challenge->user_id }}</td>
                <td>{{ $challenge->badge_id }}</td>
                <td>{{ $challenge->published ? 'Published' : 'Unpublished' }}</td>
                <td>{{ $challenge->duration }}</td>
                <td>{{ $challenge->created_at }}</td>
                <td>{{ $challenge->updated_at }}</td>
                <td>
                    <a href="{{ route('admin.show', $challenge) }}" class="bg-green-600 text-white px-3 py-1 rounded">Show</a>
                </td>
                <td>
                    <a href="{{ route('admin.edit', $challenge) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</main>
</body>
</html>
