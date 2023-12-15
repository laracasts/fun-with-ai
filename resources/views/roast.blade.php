<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AI Poems</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full grid place-items-center p-6">
    @if (session('file'))
        <div>
            <iframe src="https://giphy.com/embed/RdKjAkFTNZkWUGyRXF" width="480" height="256" frameBorder="0"
                    class="giphy-embed" allowFullScreen></iframe>

            <a href="{{ asset(session('file')) }}" download
               class="block w-full text-center rounded p-2 bg-gray-200 hover:bg-blue-500 hover:text-white mt-3">Download
                Audio</a>
        </div>
    @else
        <form action="/roast" method="POST" class="w-full lg:max-w-md lg:mx-auto">
            @csrf

            <div class="flex gap-2">
                <input type="text" name="topic" placeholder="What do you want us to roast?" required
                       class="border p-2 rounded flex-1" minlength="2" maxlength="50">

                <button type="submit" class="rounded p-2 bg-gray-200 hover:bg-blue-500 hover:text-white">Roast</button>
            </div>
        </form>
    @endif
</body>
</html>
