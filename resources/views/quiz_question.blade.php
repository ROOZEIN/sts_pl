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

        <div class="flex justify-center items-center gap-[25rem] ">
            <div class="gap-[1rem] flex flex-col">
                <div class="bg-[#4C47D6] text-[#ffff] rounded-[0.5rem] w-[5rem] h-[3rem] justify-center items-center flex ">
                    <p class="text-[1rem] font-[600]">Soal 1</p>
                </div>
                <div class="bg-[#ffff] border-[#A7B7D1] rounded-[1rem] border-[2px] text-[#51547E] w-[50rem] h-[8rem] text-[1.2rem] font-[600] flex justify-center items-center">
                    <p>Berapa letak kuartil bawah (Q1) dari data berikut ini ?</p>
                </div>
                <div class="font-bold flex flex-col gap-[1rem] text-[4rem]">
                    <button class="bg-[#ffff] rounded-[0.9rem] border-[0.5px] border-[#4C47D6] w-[10rem] h-[3rem] text-[1.2rem]">5</button>
                    <button class="bg-[#ffff] rounded-[0.9rem] border-[0.5px] border-[#4C47D6] w-[10rem] h-[3rem] text-[1.2rem]">3</button>
                    <button class="bg-[#ffff] rounded-[0.9rem] border-[0.5px] border-[#4C47D6] w-[10rem] h-[3rem] text-[1.2rem]">7</button>
                    <button class="bg-[#ffff] rounded-[0.9rem] border-[0.5px] border-[#4C47D6] w-[10rem] h-[3rem] text-[1.2rem]">10</button>
                </div>
            </div>

            <div class="flex flex-col gap-[1rem]">
                <div class="bg-[#fff] border-[#4C47D6] rounded-[1rem] border-[2px] w-[10rem] h-[3rem] flex justify-center items-center gap-2 ">
                    <img src="" alt="">
                    <p class="text-[1.2rem] font-[600]">Soal 1</p>
                </div>
                    <div class="bg-[#fff] border-[#4C47D6] rounded-[1rem] border-[2px] w-[10rem] h-[3rem] flex justify-center items-center gap-2 ">
                    <img src="" alt="">
                    <p class="text-[1.2rem] font-[600]">Soal 2</p>
                </div>
                <div class="bg-[#fff] border-[#4C47D6] rounded-[1rem] border-[2px] w-[10rem] h-[3rem] flex justify-center items-center gap-2 ">
                    <img src="" alt="">
                    <p class="text-[1.2rem] font-[600]">Soal 3</p>
                </div>
                <div class="bg-[#fff] border-[#4C47D6] rounded-[1rem] border-[2px] w-[10rem] h-[3rem] flex justify-center items-center gap-2 ">
                    <img src="" alt="">
                    <p class="text-[1.2rem] font-[600]">Soal 4</p>
                </div>
 
            </div>
        </div>
    </section>

    <footer class="bg-[#ffffff] flex justify-center gap-[65rem] items-center mt-[1.5rem] h-[80px] font-[montserrat]">
            <div class="w-[3rem] h-[3rem] rounded-[2rem] bg-[#4C47D6] flex items-center justify-center">
                <img src="/images/back.png" alt="back" class="w-[1.7rem] h-[1.7rem]">
            </div>
            <div class="flex flex-row gap-[0.9rem]">
                <button class="w-[8rem] h-[2.5rem] text-[1.2rem] bg-[#ffff] border-[#4C47D6] rounded-[12px] font-[500]">Previous</button>
                <button class="w-[8rem] h-[2.5rem] text-[1.2rem] bg-[#ffff] border-[#4C47D6] rounded-[12px] font-[500]">Next</button>
            </div>

    </footer>
</body>
</html>