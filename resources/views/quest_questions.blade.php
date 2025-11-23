<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">@vite('resources/css/app.css')</head>
<body class="bg-[#F7FAFC] min-h-screen p-6">
  <div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-xl font-bold">{{ $quiz->title }} — Manage Questions</h2>
      <a href="{{ route('quests.grid') }}" class="text-sm text-gray-600">Back to grid</a>
    </div>

    @if(session('success')) <div class="mb-4 p-2 bg-green-100 rounded">{{ session('success') }}</div> @endif

    <div class="grid grid-cols-2 gap-6">
      <div>
        <h3 class="font-semibold mb-3">Existing questions</h3>
        <div class="space-y-3">
          @foreach($quiz->questions as $q)
            <div class="p-3 bg-white rounded border flex justify-between items-start">
              <div>
                <div class="font-medium">Q{{ $q->id }}. {{ \Illuminate\Support\Str::limit($q->question_text, 80) }}</div>
                <div class="text-sm text-gray-500 mt-1">
                  @foreach($q->options as $opt)
                    <span class="inline-block mr-2 {{ $opt->is_correct ? 'text-green-600' : 'text-gray-600' }}">{{ $opt->option_text }}</span>
                  @endforeach
                </div>
              </div>
              <div class="flex gap-2">
                <a href="{{ route('quests.questions.edit', [$quiz->id, $q->id]) }}" class="px-2 py-1 bg-yellow-100 rounded">Edit</a>
                <form method="POST" action="{{ route('quests.questions.destroy', [$quiz->id, $q->id]) }}" onsubmit="return confirm('Delete?')">
                  @csrf @method('DELETE')
                  <button class="px-2 py-1 bg-red-100 rounded">Delete</button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div>
        <h3 class="font-semibold mb-3">Add new question</h3>
        <form method="POST" action="{{ route('quests.questions.store', $quiz->id) }}">
          @csrf
          <label class="block mb-2">Question
            <textarea name="question_text" class="w-full p-2 border rounded" required>{{ old('question_text') }}</textarea>
          </label>
          <label class="block mb-2">Points
            <input name="points" type="number" class="w-32 p-2 border rounded" value="{{ old('points',1) }}">
          </label>

          <div class="mb-2">
            <div class="text-sm mb-1">Options (mark correct)</div>
            @for($i=0;$i<4;$i++)
              <div class="flex items-center gap-2 mb-2">
                <input type="radio" name="correct" value="{{ $i }}" {{ old('correct') == $i ? 'checked' : ($i==0 ? 'checked' : '') }}>
                <input name="options[{{ $i }}][option_text]" class="flex-1 p-2 border rounded" value="{{ old('options.'.$i.'.option_text') }}" required>
              </div>
            @endfor
          </div>

          <button class="px-4 py-2 bg-[#4C47D6] text-white rounded">Save question</button>
        </form>
      </div>
    </div>
  </div>
</body></html>