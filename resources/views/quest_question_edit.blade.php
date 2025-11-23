<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">@vite('resources/css/app.css')</head>
<body class="p-6 bg-[#F7FAFC]">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h3 class="mb-4">Edit question #{{ $question->id }}</h3>
    <form method="POST" action="{{ route('quests.questions.update', [$quiz->id, $question->id]) }}">
      @csrf @method('PUT')
      <label class="block mb-2">Question<textarea name="question_text" class="w-full p-2 border rounded" required>{{ old('question_text',$question->question_text) }}</textarea></label>
      <label class="block mb-2">Points<input name="points" type="number" class="w-32 p-2 border rounded" value="{{ old('points',$question->points) }}"></label>

      <div class="mb-4">
        @foreach($question->options as $i => $opt)
          <div class="flex items-center gap-2 mb-2">
            <input type="radio" name="correct" value="{{ $i }}" {{ $opt->is_correct ? 'checked' : '' }}>
            <input name="options[{{ $i }}][option_text]" class="flex-1 p-2 border rounded" value="{{ old('options.'.$i.'.option_text',$opt->option_text) }}" required>
          </div>
        @endforeach
        @for($j = $question->options->count(); $j < 4; $j++)
          <div class="flex items-center gap-2 mb-2">
            <input type="radio" name="correct" value="{{ $j }}">
            <input name="options[{{ $j }}][option_text]" class="flex-1 p-2 border rounded" value="{{ old('options.'.$j.'.option_text') }}">
          </div>
        @endfor
      </div>

      <div class="flex gap-2">
        <button class="px-4 py-2 bg-green-600 text-white rounded">Update</button>
        <a href="{{ route('quests.questions', $quiz->id) }}" class="px-4 py-2 bg-gray-200 rounded">Cancel</a>
      </div>
    </form>
  </div>
</body></html>