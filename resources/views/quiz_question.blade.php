<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-[#EAF0EF] min-h-screen">
  <div class="max-w-7xl mx-auto px-8 py-10">
    <!-- Title + small account/points -->
    <div class="flex items-center justify-between mb-8">
      <h1 class="text-3xl font-bold underline decoration-[#4C47D6]/40">Quiz Letak Kuartil</h1>
      <div class="flex items-center gap-4">
        <div class="bg-white rounded-full px-3 py-2 border flex items-center gap-3">
          <div class="w-6 h-4 bg-[#4C47D6] rounded-sm"></div>
          <div class="text-sm text-[#4C47D6] font-semibold">452</div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
      <!-- Main area -->
      <main class="col-span-8">
        <div class="flex items-start gap-6">
          <!-- Soal badge -->
          <div class="flex-shrink-0">
            <div class="bg-[#5A4BD6] text-white rounded-xl px-4 py-3 text-lg font-semibold">Soal {{ $index }}</div>
          </div>

          <!-- Question card -->
          <div class="flex-1">
            <div class="bg-white rounded-[12px] border border-[#E6F0F1] p-6 shadow-sm">
              <div class="text-sm text-[#4C47D6] font-semibold mb-4">{{ $quiz->title }}</div>
              <div class="bg-[#F4FEFF] rounded-lg p-6 text-gray-800">
                {!! nl2br(e($question->question_text)) !!}
                @if(!empty($question->hint))
                  <p class="text-sm text-gray-600 mt-3">{{ $question->hint }}</p>
                @endif
              </div>
            </div>

            <!-- Options list (pills) -->
            <form method="POST" action="{{ route('quiz.answer', ['id'=>$quiz->id,'index'=>$index]) }}" class="mt-8">
              @csrf
              <div class="space-y-4 max-w-md">
                @foreach($question->options as $opt)
                  @php
                    $isSaved = ($saved == $opt->id);
                    $isCorrect = $opt->is_correct;
                    // pill colors match screenshot: correct = light green, wrong = light pink, neutral when not selected
                    $base = $isSaved
                      ? ($isCorrect ? 'bg-[#DFF8E9] border-[#9FE1A9]' : 'bg-[#FFD6D2] border-[#F1AFA8]')
                      : 'bg-[#FFFFFF]';
                  @endphp

                  <label class="flex items-center justify-between px-4 py-3 rounded-lg border {{ $base }} cursor-pointer shadow-sm">
                    <div class="flex items-center gap-4">
                      <input type="radio" name="option_id" value="{{ $opt->id }}" class="form-radio" {{ $isSaved ? 'checked' : '' }}>
                      <div class="text-lg font-medium">{{ $opt->option_text }}</div>
                    </div>

                    @if($isSaved)
                      <div class="text-sm {{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">{{ $isCorrect ? 'Jawaban benar' : 'Jawaban salah' }}</div>
                    @endif
                  </label>
                @endforeach
              </div>

              <!-- Navigation -->
              <div class="flex items-center justify-between mt-8">
                <div>
                  @if($index>1)
                    <button name="action" value="prev" class="px-4 py-2 bg-white border rounded text-gray-700">Sebelumnya</button>
                  @endif
                </div>
                <div class="flex items-center gap-3">
                  <a href="{{ route('quiz.show', $quiz->id) }}" class="text-sm text-gray-600">Overview</a>
                  @if($index < $total)
                    <button name="action" value="next" class="px-5 py-2 bg-[#4C47D6] text-white rounded">Selanjutnya</button>
                  @else
                    <button name="action" value="finish" class="px-5 py-2 bg-green-600 text-white rounded">Selesai</button>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </main>

      <!-- Sidebar -->
      <aside class="col-span-4">
        <div class="space-y-4">
          @foreach($questions as $i => $q)
            @php
              $num = $i + 1;
              $status = $statuses[$q->id] ?? 'unanswered';
            @endphp

            <a href="{{ route('quiz.question', ['id'=>$quiz->id,'index'=>$num]) }}" class="block">
              <div class="flex items-center justify-between px-4 py-3 rounded-lg border {{ $num==$index ? 'border-[#4C47D6] bg-white' : 'bg-white/80' }}">
                <div class="flex items-center gap-4">
                  <div class="w-10 h-10 flex items-center justify-center rounded-lg
                    {{ $status=='correct' ? 'bg-green-200 text-green-700' : ($status=='wrong' ? 'bg-red-200 text-red-700' : 'bg-[#E6F0F1] text-gray-700') }}">
                    @if($status=='correct') ✓ @elseif($status=='wrong') ✕ @else {{ $num }} @endif
                  </div>
                  <div class="{{ $num==$index ? 'font-semibold' : 'text-gray-700' }}">Soal {{ $num }}</div>
                </div>
                @if($num == $index)
                  <div class="w-3 h-3 rounded-full bg-[#6B7280]"></div>
                @endif
              </div>
            </a>
          @endforeach
        </div>
      </aside>
    </div>
  </div>
</body>
</html>