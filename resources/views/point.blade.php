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

    <section class="flex">

    <!-- SIDEBAR FIX DI KIRI -->
    <div class="bg-[#fff] w-[21rem] min-h-screen fixed left-0 top-[80px] flex flex-col items-center text-[#A7B7D1]">
        <a href="{{ route('dashboard') }}">
            <div class="flex flex-row items-center gap-2 mt-[1.12rem] cursor-pointer">
                <img src="/images/house-normal.png" class="w-[2rem] h-[2rem]">
                <h2 class="text-[20px] font-semibold">Dashboard</h2>
            </div>
        </a>

        <a href="{{ route('quest') }}">
            <div class="flex flex-row items-center gap-2 mt-[1.12rem]">
                <img src="/images/house-normal.png" class="w-[2rem] h-[2rem]">
                <h2 class="text-[20px] font-semibold">My Quest</h2>
            </div>
        </a>

        <a href="{{ route('point') }}">
            <div class="flex flex-row items-center gap-2 mt-[1.12rem]">
                <img src="/images/house-normal.png" class="w-[2rem] h-[2rem]">
                <h2 class="text-[20px] font-semibold">My Points</h2>
            </div>
        </a>

        <div class="flex flex-row items-center gap-2 mt-[1.12rem]">
            <img src="/images/house-normal.png" class="w-[2rem] h-[2rem]">
            <h2 class="text-[20px] font-semibold opacity-50">My Progress</h2>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div class=" w-full flex justify-center mt-[5rem]">

        <!-- WRAPPER TOTAL -->
        <div class="flex items-start">

            <!-- BUTTON KATEGORI -->
            <div class="flex flex-col items-start gap-[0.7rem] mt-[-0.86rem] ml-[14rem] pt-[0.8rem] text-[#ffff] font-bold">

                <div class="bg-[#4C47D6] w-[10rem] h-[3rem] rounded-l-[10px] flex justify-center items-center text-white cursor-pointer">
                    <p>Produktif</p>
                </div>

                <div class="bg-[#83C1FF] w-[10rem] h-[3rem] rounded-l-[10px] flex justify-center items-center text-white cursor-pointer">
                    <p>Umum</p>
                </div>

            </div>

            <!-- KOTAK PUTIH CARD (DIPERLEBAR) -->
            <div class="w-[50rem] h-[30rem] flex flex-wrap justify-center rounded-r-[20px] shadow-md p-10 bg-[#fff]">

                <div class="flex flex-row justify-center items-center gap-[2rem]">

                    <!-- TEMPLATE CARD (SEMUA SAMA) -->
                    <div class="border border-[#6BB4FF] w-[12rem] rounded-[15px] overflow-hidden shadow-sm backdrop-blur-md">
                        <div class="bg-[#E6F4FF] h-[100px] flex justify-center items-center">
                            <img src="/images/star-white.png" class="w-[75px]">
                        </div>
                        <div class="px-4 py-4 ml-[1rem] text-[#5A3AE6]">
                            <p class="text-[16px] font-bold">Poin <span class="text-[#7A55FF] ml-[2rem]">+5</span></p>
                            <p class="text-[14px] text-[#7A55FF]">Harga 20 eq</p>
                        </div>
                    </div>

                    <div class="border border-[#6BB4FF] w-[12rem] rounded-[15px] overflow-hidden shadow-sm backdrop-blur-md">
                        <div class="bg-[#E6F4FF] h-[100px] flex justify-center items-center">
                            <img src="/images/star-white.png" class="w-[75px]">
                        </div>
                        <div class="px-4 py-4 text-[#5A3AE6]">
                            <p class="text-[16px] font-bold">Poin <span class="text-[#7A55FF]">+8</span></p>
                            <p class="text-[14px] text-[#7A55FF]">Harga 32 eq</p>
                        </div>
                    </div>

                    <div class="border border-[#6BB4FF] w-[12rem] rounded-[15px] overflow-hidden shadow-sm backdrop-blur-md">
                        <div class="bg-[#E6F4FF] h-[100px] flex justify-center items-center">
                            <img src="/images/star-white.png" class="w-[75px]">
                        </div>
                        <div class="px-4 py-4 text-[#5A3AE6]">
                            <p class="text-[16px] font-bold">Poin <span class="text-[#7A55FF]">+5</span></p>
                            <p class="text-[14px] text-[#7A55FF]">Harga 20 eq</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row justify-center items-center gap-[2rem]">

                    <div class="border border-[#8AA4FF] w-[12rem] rounded-[15px] overflow-hidden shadow-sm backdrop-blur-md">
                        <div class="bg-[#DBE4FF] h-[100px] flex justify-center items-center">
                            <img src="/images/star-blue.png" class="w-[75px]">
                        </div>
                        <div class="px-4 py-4 text-[#5A3AE6]">
                            <p class="text-[16px] font-bold">Poin <span class="text-[#7A55FF]">+10</span></p>
                            <p class="text-[14px] text-[#7A55FF]">Harga 40 eq</p>
                        </div>
                    </div>

                    <div class="border border-[#8AA4FF] w-[12rem] rounded-[15px] overflow-hidden shadow-sm backdrop-blur-md">
                        <div class="bg-[#DBE4FF] h-[100px] flex justify-center items-center">
                            <img src="/images/star-blue.png" class="w-[75px]">
                        </div>
                        <div class="px-4 py-4 text-[#5A3AE6]">
                            <p class="text-[16px] font-bold">Poin <span class="text-[#7A55FF]">+15</span></p>
                            <p class="text-[14px] text-[#7A55FF]">Harga 60 eq</p>
                        </div>
                    </div>

                    <div class="border border-[#8AA4FF] w-[12rem] rounded-[15px] overflow-hidden shadow-sm backdrop-blur-md">
                        <div class="bg-[#DBE4FF] h-[100px] flex justify-center items-center">
                            <img src="/images/star-blue.png" class="w-[75px]">
                        </div>
                        <div class="px-4 py-4 text-[#5A3AE6]">
                            <p class="text-[16px] font-bold">Poin <span class="text-[#7A55FF]">+12</span></p>
                            <p class="text-[14px] text-[#7A55FF]">Harga 48 eq</p>
                        </div>
                    </div>

                </div>

            </div>

            <div class="flex justify-end items-end mt-[32rem] ml-[-8rem]">
            <button class="w-[8rem] h-[2.5rem] bg-[#4C47D6] text-[#ffff] rounded-[10px] text-[large] border-none ">Confirm</button>
            </div>
        </div>
    </div>
 </section>



</body>
</html>
