<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  @vite('resources/css/app.css')
</head>
<body class="p-8 bg-gray-100">
  <div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Results: {{ $quiz->title }}</h2>

    <div class="bg-white p-6 rounded shadow">
      <p class="mb-4">Score: <strong>{{ $score }}</strong> / <strong>{{ $max }}</strong></p>
      <a href="{{ route('quiz.question', ['id' => $quiz->id, 'index' => 1]) }}" class="px-4 py-2 bg-[#4C47D6] text-white rounded">Review Answers</a>
    </div>
  </div>
</body>
</html>