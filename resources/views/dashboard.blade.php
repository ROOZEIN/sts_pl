<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    <header class="bg-[#F4FEFF] flex items-center justify-center shadow-lg top-0 left-0 h-[100px]">
        <div>
            <input type="search" class="bg-[#d1d1d1] border-none rounded-[2px] w-[30rem] h-[1.9rem]">
        </div>
        <div>
            <img src="/images/solar_bell-bold.png" alt="" class="w-[3rem] h-[3rem]">
            <img src="/images/pfp.png" alt="" class="w-[50px] h-[50px]">
        </div>
        <div>
            <!-- <div class="flex flex-row">
                <p>{{ Auth::user()->name }}</p>
                <img src="" alt="">
            </div>
            <p>{{ Auth::user()->email }}</p>
        </div> -->
        <div class="flex flex-row items-center gap-2">
    <img src="avatar.png" alt="" class="w-10 h-10 rounded-full">
    <div class="flex flex-col leading-tight">
        <p class="font-medium">{{ Auth::user()->name }}</p>
        <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
    </div>
</div>
    </header>
</body>
</html>