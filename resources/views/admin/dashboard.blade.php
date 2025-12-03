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
<h1>Admin</h1>
</header>
<main>
    <table class="mx-auto">
        <thead>
        <tr>
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">Title</th>
        <th class="px-4 py-2">Description</th>
        <th class="px-4 py-2">Difficulty</th>
        <th class="px-4 py-2">User ID</th>
        <th class="px-4 py-2">Badge</th>
        <th class="px-4 py-2">Published</th>
        <th class="px-4 py-2">Duration</th>
        <th class="px-4 py-2">Created at</th>
        <th class="px-4 py-2">Updated at</th>
        </tr>
        </thead>

        <tbody>
        @foreach($challenge as $challenges)
        <tr class="border-t">
            <td class="px-4 py-2">{{ $challenges->id }}</td>
            <td class="px-4 py-2">{{ $challenges->title }}</td>
            <td class="px-4 py-2">{{ Str::limit( $challenges->description, 20) }}</td>
            <td class="px-4 py-2">{{ $challenges->difficulty_id}}</td>
            <td class="px-4 py-2">{{ $challenges->user_id }}</td>
            <td class="px-4 py-2">{{ $challenges->badge_id }}</td>
            <td class="px-4 py-2">@if($challenges->published === 1)
                                      Published
                                    @else
                                        Unpublished
            @endif</td>
            <td class="px-4 py-2">{{ $challenges->duration }}</td>
            <td class="px-4 py-2">{{ $challenges->created_at }}</td>
            <td class="px-4 py-2">{{ $challenges->updated_at }}</td>
        </tr>

        @endforeach
    </table>
</main>
</body>
</html>
