<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-[#F1F6F7]">
  <div class="max-w-6xl mx-auto p-6">
    <!-- top bar -->
    <div class="flex items-center justify-between mb-6">
      <div class="flex items-center gap-4">
        <a href="{{ route('quests.grid') }}" class="text-sm text-gray-600">&larr; Back</a>
        <h1 class="text-lg font-semibold">Quest maker</h1>
      </div>

      <div class="flex items-center gap-4">
        <button id="publishBtn" class="px-4 py-2 bg-[#4C47D6] text-white rounded-md shadow-sm">Publish</button>
        <div class="w-10 h-10 rounded-full bg-white border overflow-hidden">
          <!-- small avatar placeholder -->
          <img src="{{ asset('images/avatar.png') }}" alt="" class="w-full h-full object-cover">
        </div>
      </div>
    </div>

    <!-- main card -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
      <form id="quest-form" method="POST" action="{{ route('quests.store') }}">
        @csrf

        <input type="hidden" name="publish" id="publishInput" value="0">

        <!-- title -->
        <div class="mb-6">
          <input name="title" id="title" value="{{ old('title','Untitled Quiz') }}"
                 class="w-full text-2xl font-semibold p-4 rounded-xl border bg-[#FBFBFD] focus:outline-none focus:ring-2 focus:ring-[#C9C6FF]"
                 placeholder="Untitled Quiz" />
          @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- content area -->
        <div class="h-64 rounded-xl bg-[#F7FCFB] border-dashed border-2 border-[#E3F2F1] flex items-center justify-center">
          <div class="text-center">
            <button type="button" onclick="location.href='{{ route('quests.questions', 0) }}'"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-[#DDEFF0] bg-white text-sm">
              <span class="font-semibold text-[#4C47D6]">+</span>
              <span class="text-gray-700">Start with</span>
            </button>

            <p class="text-sm text-gray-500 mt-3">Or add questions after creating the quest</p>
          </div>
        </div>

        <!-- quick actions -->
        <div class="mt-6 flex justify-between items-center">
          <div class="text-sm text-gray-500">You can edit questions later in Manage view</div>
          <div class="flex gap-2">
            <a href="{{ route('quests.grid') }}" class="px-4 py-2 bg-gray-100 rounded">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-[#6B7280] text-white rounded" onclick="document.getElementById('publishInput').value=0">Save draft</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    // publish button submits form with publish=1
    document.getElementById('publishBtn').addEventListener('click', function(){
      document.getElementById('publishInput').value = 1;
      document.getElementById('quest-form').submit();
    });
  </script>
</body>
</html>