<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  @vite('resources/css/app.css')
</head>
<body class="bg-[#EAF0EF] min-h-screen">
  <div class="max-w-7xl mx-auto px-6 py-10">
    <div class="flex items-start justify-between mb-8">
      <h1 class="text-2xl font-bold">Quiz Letak Kuartil</h1>
      <div class="flex items-center gap-3">
        <div class="px-4 py-2 rounded-full bg-white border">452</div>
      </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
      <!-- left: main question (col 1-8) -->
      <div class="col-span-8">
        <div class="bg-white/60 rounded-lg p-6 mb-6">
          <div class="flex items-center mb-4">
            <div class="bg-[#5A4BD6] text-white px-4 py-2 rounded-xl mr-4">Soal {{ $index }}</div>
            <!-- show quiz title or short meta -->
            <div class="text-sm text-gray-700">{{ $quiz->title }}</div>
          </div>

          <!-- render the question text from DB (preserve line breaks) -->
          <div class="bg-white rounded-lg border p-6 text-gray-800 mb-6">
            <div class="mb-2">
              {!! nl2br(e($question->question_text)) !!}
            </div>
            @if(!empty($question->hint))
              <p class="text-sm text-gray-600 mt-2">{{ $question->hint }}</p>
            @endif
          </div>

          <form method="POST" action="{{ route('quiz.answer', ['id' => $quiz->id, 'index' => $index]) }}">
            @csrf

            <div class="space-y-3">
              @foreach($question->options as $opt)
                @php
                  $isSaved = ($saved == $opt->id);
                  $isCorrect = $opt->is_correct;
                @endphp

                <label class="flex items-center justify-between p-3 rounded-lg border
                  {{ $isSaved && $isCorrect ? 'bg-green-100 border-green-300' : '' }}
                  {{ $isSaved && !$isCorrect ? 'bg-red-100 border-red-300' : '' }}
                  {{ !$isSaved ? 'bg-[#FFDAD6]/10' : '' }}
                  cursor-pointer">
                  <div class="flex items-center gap-3">
                    <input type="radio" name="option_id" value="{{ $opt->id }}" class="form-radio" {{ $isSaved ? 'checked' : '' }}>
                    <span class="font-medium">{{ $opt->option_text }}</span>
                  </div>

                  @if($isSaved)
                    <span class="text-sm {{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">
                      {{ $isCorrect ? 'Jawaban benar' : 'Jawaban salah' }}
                    </span>
                  @endif
                </label>
              @endforeach
            </div>

            <div class="flex items-center justify-between mt-6">
              <div>
                @if($index > 1)
                  <button name="action" value="prev" type="submit" class="px-4 py-2 bg-gray-200 rounded">Sebelumnya</button>
                @endif
              </div>

              <div class="flex items-center gap-3">
                <a href="{{ route('quiz.show', $quiz->id) }}" class="text-sm text-gray-600">Overview</a>
                @if($index < $total)
                  <button name="action" value="next" type="submit" class="px-4 py-2 bg-[#4C47D6] text-white rounded">Selanjutnya</button>
                @else
                  <button name="action" value="finish" type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Selesai</button>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- right: sidebar question list (col 9-12) -->
      <div class="col-span-4">
        <div class="space-y-4">
          @foreach($questions as $i => $q)
            @php
              $qIndex = $i + 1;
              $status = $statuses[$q->id] ?? 'unanswered';
            @endphp

            <a href="{{ route('quiz.question', ['id' => $quiz->id, 'index' => $qIndex]) }}" class="block">
              <div class="flex items-center justify-between px-4 py-3 rounded-lg border
                {{ $qIndex == $index ? 'border-[#4C47D6] bg-white' : 'bg-white/60' }}">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 flex items-center justify-center rounded-full
                    {{ $status == 'correct' ? 'bg-green-400' : ($status == 'wrong' ? 'bg-red-300' : 'bg-gray-300') }}">
                    @if($status == 'correct')
                      ✓
                    @elseif($status == 'wrong')
                      ✕
                    @else
                      {{ $qIndex }}
                    @endif
                  </div>
                  <div class="{{ $qIndex == $index ? 'font-semibold' : 'text-gray-700' }}">Soal {{ $qIndex }}</div>
                </div>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</body>
</html>