<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Quiz: {{ $quiz->title }}</h1>
        <p class="mb-6 text-gray-600">{{ $quiz->description }}</p>

        @if(session('quiz_result'))
            <div class="mb-4 p-3 bg-green-100 rounded">
                Score: {{ session('quiz_result.score') }} / {{ session('quiz_result.max') }}
            </div>
        @endif

        <form action="{{ url('/quiz/'.$quiz->id.'/submit') }}" method="POST">
            @csrf
            <div class="space-y-6">
                @foreach($quiz->questions as $index => $question)
                    <div class="bg-white rounded-lg p-4 shadow">
                        <div class="font-semibold mb-2">Soal {{ $index + 1 }} ({{ $question->points ?? 1 }} pts)</div>
                        <div class="mb-3 text-gray-800">{{ $question->question_text }}</div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($question->options as $option)
                                <label class="flex items-center gap-3 p-2 rounded border cursor-pointer hover:bg-gray-50" for="opt-{{ $option->id }}">
                                    <input id="opt-{{ $option->id }}" type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" class="form-radio" />
                                    <span>{{ $option->option_text }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-[#4C47D6] text-white rounded">Submit Answers</button>
            </div>
        </form>
    </div>
</body>
</html>