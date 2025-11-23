<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
</head>
<body class="bg-[#DCE9EB]">
  <header class="bg-[#ffffff] flex items-center justify-between shadow-md px-10 h-[80px]">
        <!-- Left spacer (buat bantu posisi tengah) -->
        <div class="flex justify-center ml-[2rem]">
            <img src="/images/EduQuest.png" alt="" class="w-[10rem] h-[3rem]">
        </div>

    <div class="bg-white p-6 rounded shadow">
      <p class="mb-4">Score: <strong>{{ $score }}</strong> / <strong>{{ $max }}</strong></p>
      <div class="flex gap-2">
        <a href="{{ route('quiz.question', ['id' => $quiz->id, 'index' => 1]) }}" class="px-4 py-2 bg-[#4C47D6] text-white rounded">Review Answers</a>
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded">Back to dashboard</a>
      </div>
    </div>

    <div class="flex justify-center items-center flex-col ">
      <div class="bg-[#4C47D6] flex justify-center items-center border-[#38358A] rounded-[1.2rem] w-[18rem] h-[4rem] border-[0.3rem] text-[#ffff]">
        <h2 >Quiz Completed</h2>
      </div>
      <div class="bg-[#ffff] rounded-[1.4rem] border-[0.4rem] border-[#83C1FF] w-[23rem] h-[21rem]">
        <div class="flex flex-row justify-center items-center gap-[10rem] text-[1.3rem] font-[600]">
          <p>Done In</p>
          <p>00:36:15</p>
        </div>

        <div class="flex flex-row justify-center items-center gap-[14.2rem] text-[1.3rem] font-[600] mt-[-1rem]">
          <p>Score</p>
          <p>100</p>
        </div>
        
        <div class="flex flex-col justify-center items-center text-[1.3rem] font-[600]">
          <p>Reward</p>
          <div class="flex flex-row justify-content items-center gap-[0.6rem] mt-[-2rem]">
            <img src="/images/duit.png" alt="duit" class="w-[3rem] h-[1.5rem]">
            <p>10</p>
          </div>
        </div>

        <div class="flex justify-center items-center mt-[1rem] ">
           <a href="{{ route('dashboard') }}"><button class="hover:cursor-pointer w-[8rem] h-[3rem] bg-[#4C47D6] border-none rounded-[0.7rem] text-[#ffff] font-[600] text-[1.2rem]">Return</button></a>
        </div>

      </div>
    </div>
  </section>
</body>
</html>