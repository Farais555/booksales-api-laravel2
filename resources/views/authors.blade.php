<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Author</title>
</head>
<body>
    <h1>ini halaman author</h1>
    <p>Hello World</p>

    @foreach ($authors as $author)
        <ul>
            <li>{{ $author['nama']}}</li>
            <li>{{ $author['photo']}}</li>
            <li>{{ $author['bio']}}</li>
        </ul>
    @endforeach
</body>
</html>