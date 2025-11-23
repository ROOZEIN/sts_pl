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

        <div class="w-[2%]"></div>

        <!-- Right Section -->
        <div class="flex items-center gap-[2rem] w-[20%] justify-center pr-6">
            <!-- Bell icon -->
            <img src="/images/solar_bell-bold.png" alt="bell" class="w-[26px] h-[26px]">

            <!-- Profile -->
            <div class="flex  gap-[1rem]">
                <img src="/images/pfp.png" alt="Profile" class="w-[45px] h-[45px] rounded-full object-cover">
                <div class="flex flex-col">
                    <div class="flex flex-row leading-[1.1] gap-[1rem] mb-[-0.5rem]">
                        <p class="text-[15px] font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        <img src="/images/arrowdown.png" alt="" class="w-[1rem] h-[1rem] mt-[1rem]">
                    </div>
                    <p class="text-[12.5px] text-gray-600 m-[-0.3rem]">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
  </header>
  <section class="font-[montserrat]">
    <div class="flex flex-row justify-center items-center gap-[58rem]">
      <h1>Quiz Letak Quartil</h1>
        <div class="bg-[#ffff] border-solid border-[#4C47D6] rounded-[3rem] w-[10rem] h-[2rem] flex flex-row justify-center items-center gap-[2rem]">
          <img src="/images/duit.png" alt="duit" class="w-[2rem] h-[1rem]">
          <p>452</p>
          <img src="/images/plus.png" alt="plus" class="w-[1rem] h-[1rem]">
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