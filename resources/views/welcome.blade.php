<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
     <header class="px-8 bg-[#F4FEFF] flex justify-between shadow-(0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)) fixed top-0 left-0 w-full z-50">
                
            <!-- Left side  -->
                <div class="mx-[3rem]">
                    <img src="{{ asset('images/EduQuest.png') }}" alt="EduQuest" class="w-[10rem] h-[3rem]">
                </div>

                <!-- Right side  -->
                <div class="flex items-center mr-[3rem]">
                    <div class="flex gap-[1.2rem] ">
                         <a href="{{ route('login') }}" class="inline-block">
                            <button class="w-[87px] md:w-[67] h-[33px] md:h-[13px] bg-[#F4FEFF] border-[#4C47D6] rounded-[10px] text-[#4C47D6] hover:cursor-pointer hover:bg-[#4C47D6] hover:text-[#F4FEFF] hover:ease-in-out hover:duration-[0.2s]">Log In</button>
                        </a>
                        <a href="{{ route('register') }}" class="inline-block">
                            <button class="w-[87px] h-[33px] bg-[#4C47D6] rounded-[10px] border-[0] text-[#ffff] hover:cursor-pointer">Register</button>
                        </a>
                    </div>
                </div>
        </header>

    <section class="relative h-screen overflow-hidden text-[#ffff]">
        <!-- Background Image Blur -->
        <div class="absolute inset-0">
            <img src="https://i.pinimg.com/736x/e8/f4/70/e8f47021776d75ee1b672be3f2278cf9.jpg" 
                alt="Background" 
                class="w-screen md:w-screen lg:w-screen h-screen md:h-screen lg:h-screen object-cover blur-[6px]">
            <div class="absolute inset-0 bg-[#0c0c3b]/50"></div>
        </div>
        <!-- Overlay -->
        <div class="absolute inset-0 bg-[#0c0c3b]/50"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto flex items-center justify-center gap-[15rem] h-full px-12">
        
        <!-- Left: Text -->
        <div class="flex flex-col max-w-lg justify-center">
            <h1 class="text-4xl font-bold mb-6">EduQuest</h1>
            <p class="mb-6 leading-relaxed text-gray-100 w-[28rem] sm:w-[15rem] text-[20px] md:text-[14px]">
            Belajar adalah sebuah perjalanan penuh makna. <br><br>
            EduQuest kami rancang untuk menjadikan proses belajar lebih interaktif, menyenangkan, dan menantang. 
            Setiap materi dikemas seperti sebuah quest yang dapat diselesaikan, sehingga peserta didik termotivasi untuk terus maju. 
            Dengan sistem poin, tingkatan kesulitan, dan pencapaian harian, EduQuest membantu membangun konsistensi sekaligus meningkatkan pemahaman secara bertahap.
            </p>
            <div class="flex items-center gap-[1.2rem] ">
                <img src="{{ asset('images/ayo mulai.png') }}" alt="" class="w-[72px] h-[72px]">
                <p class="text-[32px]">Ayo Mulai</p>
            </div>
        </div>

        <!-- Right: Character -->
        <div class="flex flex-row items-end mb-[-8rem]">
            <img src="{{asset('images/image 1.png')}}" alt="Neo Mascot" class="w-[15rem] h-[22rem]">
           <div class=" flex flex-col bg-[#fff]/45 rounded-[2rem] border-[4px] border-white/20 text-black p-4 w-[240px] h-[195px]  justify-center items-start ml-[2px]">
                <p class="font-bold text-[30px] mb-[-2px] ml-[1.2rem]">Neo</p>
                <p class="font-medium w-[13rem] text-[16px] mt-[-2px] ml-[1.2rem] mb-[3rem]">Dia adalah anak yang suka sekali bermain tetapi cerdas. Dia adalah maskot EduQuest</p>
            </div>
        </div>
        </div>
    </section>

    <section class="bg-[#F4FEFF] h-screen flex flex-col justify-center lg:flex-row">
        <div class="flex flex-col justify-center items-center">
            <h1>What We Offer?</h1>
            <div class="flex lg:flex-row justify-center items-center gap-[3rem]"> <!-- keseluruhan cards-->
                <div class="flex flex-col overflow-hidden relative border-[4px] border-[#38358A] rounded-[10px]">
                    <img src="{{ asset('images/card1.jpeg') }}" alt="" class="w-[320px] h-[400px] object-cover ">
                    <div class="bg-[#38358A]/70 backdrop-blur-[5px] flex justify-center items-start text-start flex-col p-[0 40px] text-center mt-[-10rem] text-[#FFFF]">
                        <h3 class="mb-[-0.2rem] ml-[1.3rem]">FUN</h3>
                        <p class="w-[14rem] ml-[1.3rem]">EduQuest membuat belajar jadi lebih menyenangkan  ...</p>
                    </div>
                </div>
                <div class="flex flex-col overflow-hidden relative border-[4px] border-[#38358A] rounded-[10px]">
                    <img src="{{ asset('images/card2.jpeg') }}" alt="" class="w-[320px] h-[400px] object-cover">
                    <div class="bg-[#38358A]/70 backdrop-blur-[5px] flex justify-center items-start text-start flex-col p-[0 40px] text-center mt-[-10rem] text-[#FFFF]">
                        <h3 class="mb-[-0.2rem] ml-[1.3rem]">FUN</h3>
                        <p class="w-[14rem] ml-[1.3rem]">EduQuest membuat belajar jadi lebih menyenangkan  ...</p>
                    </div>
                </div>
                <div class="flex flex-col overflow-hidden relative border-[4px] border-[#38358A] rounded-[10px]">
                    <img src="{{ asset('images/card3.jpeg') }}" alt="" class="w-[320px] h-[400px] object-cover ">
                    <div class="bg-[#38358A]/70 backdrop-blur-[5px] flex justify-center items-start text-start flex-col p-[0 40px] text-center mt-[-10rem] text-[#FFFF]">
                        <h3 class="mb-[-0.2rem] ml-[1.3rem]">FUN</h3>
                        <p class="w-[14rem] ml-[1.3rem]">EduQuest membuat belajar jadi lebih menyenangkan  ...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative h-screen overflow-hidden text-[#fff]">
        <!-- Background Image Blur -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/landing page.jpg') }}" 
                alt="Background" 
                class="w-screen h-screen object-cover blur-[6px]">
            <div class="absolute inset-0 bg-[#0c0c3b]/50"></div>
        </div>
        <!-- Overlay -->
        <div class="absolute inset-0 bg-[#0c0c3b]/50"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto flex flex-row items-center justify-center h-full px-12 gap-[23rem]">
            
            <!-- Left: Image + Card -->
            <div class="flex flex-row items-center mb-[-5rem]">
                <div class="bg-white/40 rounded-[2rem] border-[4px] border-white/30 text-black p-4 w-[240px] h-[195px] flex flex-col        justify-center">
                    <img src="{{asset('images/image 2.png')}}" alt="Neo Mascot" class="w-[26rem] h-[35rem] mb-[-3rem] ml-[-2rem]">
                </div>
            </div>

            <!-- Right: Text -->
            <div class="flex flex-col justify-center max-w-xl text-right">
            <h1 class="text-4xl font-bold mb-6">About Us</h1>
            <p class="leading-relaxed text-gray-100 text-[20px] w-[29rem]">
                EduQuest adalah platform pembelajaran interaktif yang mengubah proses belajar menjadi pengalaman seru layaknya sebuah petualangan. 
                Dengan konsep quest, sistem poin, dan pencapaian harian, kami membantu setiap siswa belajar lebih konsisten, termotivasi, dan menyenangkan.
            </p>
            </div>
        </div>
    </section>

    <footer class="bg-[#fff] h-[12rem] flex flex-col text-[#51547E]">
        <div class="ml-[2rem]">
            <img src="{{ asset('images/EduQuest.png') }}" alt="EduQuest" class="w-[16rem] h-[5rem]">
            <div class="flex flex-row gap-[4rem]">
                <div class="">
                    <p class="">About Us</p>
                    <p class="mt-[-1rem]">Contact Us</p>
                    <p class="mt-[-1rem]">Support</p>
                    <p class="mt-[-1rem]">FAQ</p>
                    <p class="mt-[-1rem]">Services</p>
                    <p class="mt-[-1rem]">Community</p>
                </div>
                <div>
                    <p>Follow Us:</p>
                    <p class="mt-[-1rem]">Instagram</p>
                    <p class="mt-[-1rem]">Twitter</p>
                    <p class="mt-[-1rem]">Facebook</p>
                    <p class="mt-[-1rem]">Google</p>
                    <p class="mt-[-1rem]">LinkedIn</p>
                </div>
                <div>
                    <p>Blog</p>
                    <p class="mt-[-1rem]">Event</p>
                    <p class="mt-[-1rem]">Home</p>
                    <p class="mt-[-1rem]">Help Center</p>
                </div>
            </div>
            <div class="mb-[2rem]">
                <p>© 2025 EduQuest. All Rights Reserved.</p>
                <p class="mt-[-1rem]">Dikembangkan untuk mendukung pembelajaran siswa di era digital.</p>
            </div>
        </div>
    </footer>
</body>
</html>