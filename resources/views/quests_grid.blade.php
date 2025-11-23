<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">@vite('resources/css/app.css')</head>
<body class="bg-[#EAF0EF] min-h-screen p-8">
  <div class="max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 flex items-center justify-between">
      <span>Quests grid</span>
      <a href="{{ route('quests.create') }}" class="px-4 py-2 bg-[#4C47D6] text-white rounded">Make new quest</a>
    </h1>

    <div class="grid grid-cols-3 gap-6">
      @foreach($quizzes as $quiz)
        <div class="bg-white rounded-lg p-4 shadow">
          <h3 class="font-semibold">{{ $quiz->title }}</h3>
          <p class="text-sm text-gray-600 mt-1">{{ $quiz->description }}</p>
          <div class="mt-4 flex gap-2">
            <a href="{{ route('quests.questions', $quiz->id) }}" class="px-3 py-2 bg-[#4C47D6] text-white rounded">Manage</a>
            <span class="px-3 py-2 bg-gray-100 rounded text-sm">{{ $quiz->questions()->count() }} questions</span>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</body></html>