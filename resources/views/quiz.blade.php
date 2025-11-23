<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quiz Letak Kuartil</title>
  @vite('resources/css/app.css')
  <style>
    :root{
      --frame:#0b9bd6;
      --panel:#dbe6e7;
      --accent:#5a45ff;
      --muted:#cfe6e7;
      --wrong-bg:#ffd8d3;
      --wrong-text:#ef6d60;
      --right-bg:#dff7df;
      --right-text:#1f8b4f;
      --outline:#cfe6e7;
    }
  </style>
</head>
<body class="bg-[#e6f3f4] min-h-screen antialiased">

  <!-- outer cyan frame (full screen) -->
  <div class="min-h-screen border-4 border-[var(--frame)] bg-white">

    <!-- centered content -->
    <div class="max-w-7xl mx-auto">

      <!-- top header -->
      <header class="bg-white/60 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div class="h-10 flex items-center gap-2">
            <img src="/logo.png" alt="logo" class="h-6" onerror="this.style.display='none'"/>
            <span class="text-[var(--accent)] font-extrabold">EQUQUEST</span>
          </div>
        </div>

        <div class="flex items-center gap-4">
          <div class="flex items-center gap-3 px-3 py-2 rounded-full border border-[var(--outline)] bg-white">
            <div class="w-9 h-6 rounded text-xs flex items-center justify-center bg-gradient-to-tr from-indigo-600 to-purple-500 text-white">🏆</div>
            <div class="text-sm font-semibold text-[#4c47d6]">{{ $user_points ?? '452' }}</div>
          </div>

          <div class="flex items-center gap-3">
            <div class="hidden md:block text-right">
              <div class="text-sm font-medium">{{ Auth::user()->name ?? 'NeoHive' }}</div>
              <div class="text-xs text-gray-400">{{ Auth::user()->email ?? 'neo.hive@mail.com' }}</div>
            </div>
            <img src="{{ Auth::user()->profile_photo_url ?? 'https://i.pravatar.cc/40' }}" alt="avatar" class="w-10 h-10 rounded-full"/>
          </div>
        </div>
      </header>

      <!-- main quiz area -->
      <main class="bg-[var(--panel)] rounded-b p-8">
        <div class="grid grid-cols-12 gap-6">

          <!-- Left column -->
          <section class="col-span-12 lg:col-span-8 relative">
            <h1 class="text-2xl font-semibold mb-6">Quiz Letak Kuartil</h1>

            <div class="relative pl-6 lg:pl-8">
              <!-- question card -->
              <div class="bg-white rounded-lg p-6 border border-[var(--outline)] max-w-2xl relative">
                <!-- purple Soal tab overlapping -->
                <div class="absolute -left-8 top-6">
                  <div class="bg-[var(--accent)] text-white px-5 py-3 rounded-r-lg font-semibold shadow">Soal {{ $index ?? 1 }}</div>
                </div>

                <div class="ml-2">
                  <p class="text-sm text-gray-600">Data berikut disusun dari terkecil ke terbesar:</p>
                  <!-- question_text loaded from database -->
                  <p class="text-sm text-gray-700 my-3 leading-relaxed">{!! nl2br(e($question->question_text ?? '—')) !!}</p>

                  @if(!empty($question->hint))
                    <p class="text-xs text-gray-500">{{ $question->hint }}</p>
                  @endif
                </div>
              </div>

              <!-- options (vertical, look like picture) -->
              <form id="answerForm" method="POST" action="{{ route('quiz.answer', ['id' => $quiz->id ?? null, 'index' => $index ?? 1]) }}" class="mt-8" novalidate>
                @csrf
                <input type="hidden" name="action" id="actionInput" value="">
                <div class="flex flex-col gap-3">
                  @foreach($question->options ?? [] as $opt)
                    @php
                      $isSaved = isset($saved) && $saved == $opt->id;
                      $isCorrect = !empty($opt->is_correct);
                    @endphp

                    <label class="flex items-center gap-4 w-72 p-2 rounded-full cursor-pointer
                                {{ $isSaved && $isCorrect ? 'bg-[var(--right-bg)]' : '' }}
                                {{ $isSaved && !$isCorrect ? 'bg-[var(--wrong-bg)]' : '' }}
                                ">
                      <input type="radio" name="option_id" value="{{ $opt->id }}" class="hidden" {{ $isSaved ? 'checked' : '' }}>

                      <!-- number/style pill -->
                      <div class="min-w-[44px] h-9 flex items-center justify-center rounded-md font-bold text-lg
                                  {{ $isSaved && $isCorrect ? 'bg-white text-[var(--right-text)] border border-[#dff7df]' : '' }}
                                  {{ $isSaved && !$isCorrect ? 'bg-white text-[var(--wrong-text)] border border-[#ffd7d1]' : 'bg-white text-[var(--wrong-text)] border border-[#ffd7d1]' }}">
                        {{ trim($opt->option_text) }}
                      </div>

                      <div class="text-sm text-gray-700">{{ $opt->option_label ?? $opt->option_text }}</div>

                      <div class="ml-auto">
                        @if($isSaved)
                          <span class="text-xs px-3 py-1 rounded-full font-medium
                                {{ $isCorrect ? 'bg-[var(--right-bg)] text-[var(--right-text)] border border-[var(--right-bg)]' : 'bg-[var(--wrong-bg)] text-[var(--wrong-text)] border border-[var(--wrong-bg)]' }}">
                            {{ $isCorrect ? 'Jawaban benar' : 'Jawaban salah' }}
                          </span>
                        @endif
                      </div>
                    </label>
                  @endforeach
                </div>

                <!-- spacer -->
                <div class="h-6"></div>

                <!-- inline top controls (kept for accessibility) -->
                <div class="flex items-center justify-between mt-6">
                  <div>
                    @if(($index ?? 1) > 1)
                      <button name="action" value="prev" type="submit" class="px-4 py-2 bg-white border rounded-md text-sm">Previous</button>
                    @endif
                  </div>

                  <div class="flex items-center gap-3">
                    <a href="{{ route('quiz.show', $quiz->id ?? '#') }}" class="text-sm text-gray-600">Overview</a>

                    @if(($index ?? 1) < ($total ?? 1))
                      <button name="action" value="next" type="submit" class="px-5 py-2 bg-[var(--accent)] text-white rounded-md">Next</button>
                    @else
                      <button name="action" value="finish" type="submit" class="px-5 py-2 bg-green-600 text-white rounded-md">Submit</button>
                    @endif
                  </div>
                </div>
              </form>

            </div>
          </section>

          <!-- Right column (sidebar) -->
          <aside class="col-span-12 lg:col-span-4 flex justify-end">
            <div class="w-48 flex flex-col items-end mt-6 space-y-4">
              @foreach($questions as $i => $q)
                @php
                  $qIndex = $i + 1;
                  $status = $statuses[$q->id] ?? 'unanswered';
                  $isCurrent = ($qIndex == ($index ?? 1));
                @endphp

                <a href="{{ route('quiz.question', ['id' => $quiz->id ?? null, 'index' => $qIndex]) }}" class="w-full block">
                  <div class="flex items-center justify-between p-3 rounded-lg
                              {{ $isCurrent ? 'bg-white ring-2 ring-[var(--outline)] shadow-sm border border-[var(--accent)]' : 'bg-white/90' }}">
                    <div class="flex items-center gap-3">
                      <div class="w-9 h-9 flex items-center justify-center rounded-md text-sm font-semibold
                                  {{ $status == 'correct' ? 'bg-[var(--right-bg)] text-[var(--right-text)]' : ($status == 'wrong' ? 'bg-[var(--wrong-bg)] text-[var(--wrong-text)]' : 'bg-white text-gray-700 border border-[#e6eef0]') }}">
                        @if($status == 'correct') ✓ @elseif($status == 'wrong') ✕ @else {{ $qIndex }} @endif
                      </div>
                      <div class="{{ $isCurrent ? 'font-semibold text-gray-800' : 'text-gray-700' }}">Soal {{ $qIndex }}</div>
                    </div>
                  </div>
                </a>
              @endforeach
            </div>
          </aside>

          <!-- bottom control row -->
          <div class="col-span-12 mt-8">
            <div class="bg-white/95 border-t border-gray-100 px-6 py-4 flex items-center justify-between">
              <button aria-label="Back" onclick="history.back()" class="w-12 h-12 rounded-full flex items-center justify-center bg-gradient-to-br from-[var(--accent)] to-[#4939d9] text-white shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
              </button>

              <div class="flex items-center gap-3">
                <button id="bottomPrev" type="button" class="px-4 py-2 bg-white border rounded-md text-[var(--accent)]">Previous</button>
                <button id="bottomSubmit" type="button" class="px-4 py-2 bg-[var(--accent)] text-white rounded-md">Submit</button>
              </div>
            </div>
          </div>

        </div>
      </main>
    </div>
  </div>

  <script>
    (function(){
      const form = document.getElementById('answerForm');
      if(!form) return;
      const actionInput = document.getElementById('actionInput');

      document.getElementById('bottomPrev').addEventListener('click', () => {
        actionInput.value = 'prev';
        form.submit();
      });

      document.getElementById('bottomSubmit').addEventListener('click', () => {
        const isLast = {{ ($index ?? 1) >= ($total ?? 1) ? 'true' : 'false' }};
        actionInput.value = isLast ? 'finish' : 'next';
        form.submit();
      });
    })();
  </script>
</body>
</html>