<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Header Layout</title>
</head>
<body class="bg-[#DCE9EB]">
    <header class="bg-[#ffffff] flex items-center justify-between shadow-md px-10 h-[80px]">
        <!-- Left spacer (buat bantu posisi tengah) -->
        <div class="flex justify-center ml-[2rem]">
            <img src="/images/EduQuest.png" alt="" class="w-[10rem] h-[3rem]">
        </div>

        <div class="w-[2%]"></div>

        <!-- Search bar di tengah -->
        <div class="flex justify-center w-[52%]">
            <input 
                type="search" 
                placeholder=" Search quest"
                class="bg-[#d1d1d1] text-gray-700 placeholder-gray-500 border-none rounded-md px-4 py-2 focus:outline-none w-[80rem] h-[2.5rem] rounded-[10px]"
            >
        </div>

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

    <section>
        <div>
            <div class="bg-[#fff] w-[21rem] h-[60rem] absolute mt-[-1.99rem] flex  flex-col items-center text-[#A7B7D1]">
                <a href="{{ route('dashboard') }}" class="no-underline text-[#A7B7D1]">
                    <div class="flex flex-row justify-center items-center">
                        <img src="/images/house-normal.png" alt="" class="w-[2rem] h-[2rem] mt-[1.12rem] hover:cursor-pointer;">
                        <h2>Dashboard</h2>
                    </div>
                </a>
                <a href="{{ route('quest') }}" class="no-underline text-[#A7B7D1]">
                    <div class="flex flex-row justify-center items-center">
                        <img src="/images/myquest.png" alt="" class="w-[2rem] h-[2rem] mt-[1.12rem]">
                        <h2>My Quest</h2>
                    </div>
                </a>
                
                <a href="{{ route('point') }}" class="no-underline text-[#A7B7D1]">
                    <div class="flex flex-row justify-center items-center">
                        <img src="/images/mypoint.png" alt="" class="w-[2rem] h-[2rem] mt-[1.12rem]">
                        <h2>My Points</h2>
                    </div>
                </a>
                <div class="flex flex-row justify-center items-center" >
                    <img src="/images/progress.png" alt="" class="w-[2rem] h-[2rem] mt-[1.12rem]">
                    <h2>My Progress</h2>
                </div>
            </div>
            <div class="flex justify-center gap-[1rem] rounded-[]">
                    <div class="flex flex-col bg-[#fff] w-[15rem] h-[30rem] rounded-[17px] justify-center items-center text-[#A7B7D1] space-y-1 ml-[15rem]">
                        <img src="" alt="" class="w-[4rem] h-[4rem]">
                        <h4 class="text-[#51547E] font-semibold mb-2">IPA</h4>
                        <p class="m-0 leading-tight">Poin:</p>
                        <p class="m-0 leading-tight">Total Soal:</p>
                        <p class="m-0 leading-tight">Level:</p>
                    </div>
                    <div class="flex flex-col bg-[#fff] w-[15rem] h-[30rem] rounded-[17px] justify-center items-center text-[#A7B7D1] space-y-1">
                        <img src="" alt="" class="w-[4rem] h-[4rem]">
                        <h4 class="text-[#51547E] font-semibold mb-2">IPA</h4>
                        <p class="m-0 leading-tight">Poin:</p>
                        <p class="m-0 leading-tight">Total Soal:</p>
                        <p class="m-0 leading-tight">Level:</p>
                    </div>
                    <div class="flex flex-col bg-[#fff] w-[15rem] h-[30rem] rounded-[17px] justify-center items-center text-[#A7B7D1] space-y-1">
                        <img src="" alt="" class="w-[4rem] h-[4rem]">
                        <h4 class="text-[#51547E] font-semibold mb-2">IPA</h4>
                        <p class="m-0 leading-tight">Poin:</p>
                        <p class="m-0 leading-tight">Total Soal:</p>
                        <p class="m-0 leading-tight">Level:</p>
                    </div>
                    <div class="flex flex-col bg-[#fff] w-[15rem] h-[30rem] rounded-[17px] justify-center items-center text-[#A7B7D1] space-y-1">
                        <img src="" alt="" class="w-[4rem] h-[4rem]">
                        <h4 class="text-[#51547E] font-semibold mb-2">IPA</h4>
                        <p class="m-0 leading-tight">Poin:</p>
                        <p class="m-0 leading-tight">Total Soal:</p>
                        <p class="m-0 leading-tight">Level:</p>
                    </div>
            </div>  
        </div>
    </section>
</body>
</html>
