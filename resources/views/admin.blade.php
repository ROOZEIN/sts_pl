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
    <section class="flex gap-[10rem] font-[montserrat]">
        <div class="bg-[#fff] w-[21rem] h-[40.5rem] flex  flex-col justify-start items-center text-[#A7B7D1]">
            <a href="{{ route('dashboard') }}" class="no-underline text-[#A7B7D1]">
                <div class="flex flex-row justify-center items-center gap-[0.5rem]">
                    <img src="/images/house-normal.png" alt="" class="w-[2rem] h-[2rem] hover:cursor-pointer;">
                    <h2>Dashboard</h2>
                </div>
            </a>
            <a href="{{ route('quest') }}" class="no-underline text-[#A7B7D1]">
                <div class="flex flex-row justify-center items-center gap-[0.5rem]">
                    <img src="/images/myquest.png" alt="" class="w-[2rem] h-[2rem]">
                    <h2>Account</h2>
                </div>
            </a>
                
            <a href="{{ route('point') }}" class="no-underline text-[#A7B7D1]">
                <div class="flex flex-row justify-center items-center gap-[0.5rem]">
                    <img src="/images/mypoint.png" alt="" class="w-[2rem] h-[2rem]">
                    <h2>Quests</h2>
                </div>
            </a>
            <div class="flex flex-row justify-center items-center gap-[0.5rem]" >
                <img src="/images/progress.png" alt="" class="w-[2rem] h-[2rem]">
                <h2>Market</h2>
            </div>
        </div>

        <div>
            <div class="flex justify-center items-center">
                <input type="text" placeholder=" Search" class="bg-[#ffffff] text-[#A7B7D1] border-none px-4 py-2 focus:outline-none w-[60rem] h-[2.5rem] rounded-[7px] flex justify-center items-center mt-[2rem]">
            </div>

            <div class="flex flex-row justify-center items-center gap-[2rem]">
                <a href="{{ route('newquest') }}" class="no-underline">
                    <div class="bg-[#4C47D6] w-[14rem] h-[4rem] text-[#ffff] flex flex-row justify-center items-center gap-[1rem] rounded-[1rem] mt-[2rem] font-[600]">
                        <img src="/images/plusputih.png" alt="" class="w-[1.5rem] h-[1.5rem]">
                        <p>Make New Quest</p>
                    </div>
                </a>
                <div class="bg-[#51547E] w-[14rem] h-[4rem] text-[#ffff] flex flex-row justify-center items-center gap-[1rem] rounded-[1rem] mt-[2rem] font-[600]">
                    <img src="/images/template.png" alt="" class="w-[1.5rem] h-[1.5rem]">
                    <p>Use Template</p>
                </div>
                <div class="bg-[#38358A] w-[14rem] h-[4rem] text-[#ffff] flex flex-row justify-center items-center gap-[1rem] rounded-[1rem] mt-[2rem] font-[600]">
                    <img src="/images/manage.png" alt="" class="w-[1.5rem] h-[1.5rem]">
                    <p>Manage Quest</p>
                </div>
            </div>

            <div class="flex flex-row justify-center items-center gap-[29rem] mt-[2rem]">
                <h2>Quest You Made</h2>
                <div class="flex flex-row gap-[1rem] justify-center items-center">
                    <div class="bg-[#ffff] w-[13rem] h-[3rem] flex justify-center items-center font-[600] text-[#A7B7D1] rounded-[5px] ">
                        <p>Filter By Keyword</p>
                    </div>
                    <img src="/images/hamburger.png" alt="" class="w-[1.5rem] h-[1.5rem]">
                    <img src="/images/category.png" alt="" class="w-[1.5rem] h-[1.5rem]">
                </div>
            </div>

            <div>
                @foreach($quizzes as $quiz)
                <a href="{{ route('quest.edit', $quiz->id) }}" class="no-underline block">
                    <div class="bg-[#ffff] w-[60rem] h-[4rem] rounded-[0.6rem] flex flex-row justify-center items-center gap-[12rem] mt-[1rem] cursor-pointer quest-card"
                         data-id="{{ $quiz->id }}" data-title="{{ $quiz->title }}" data-subject="{{ $quiz->description ?? '' }}" data-difficulty="{{ $quiz->difficulty ?? 'Mudah' }}">
                        <div class="flex flex-row justify-center items-center">
                            <img src="/images/paper.png" alt="" class="w-[1.5rem] h-[1.5rem]">
                            <p class="ml-2">{{ $quiz->title }}</p>
                        </div>
                        <p>{{ $quiz->description ?? '—' }}</p>
                        <div class="bg-[#22CC3B] w-[4rem] h-[1.5rem] rounded-[2rem] flex justify-center items-center text-[#ffff] font-[500]">
                            <p class="text-[12px]">{{ $quiz->difficulty ?? 'Mudah' }}</p>
                        </div>
                        <img src="/images/titik.png" alt="" class="w-[1.5rem] h-[1.5rem]">
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- EDIT MODAL (append near end of file, before closing </body>) -->
<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center">
  <div class="absolute inset-0 bg-black opacity-40"></div>
  <div class="relative bg-white rounded-lg w-[36rem] p-6 shadow-lg z-60">
    <h3 class="text-lg font-semibold mb-4">Edit Quest</h3>

    <form id="editForm" method="POST" action="">
      @csrf
      <input type="hidden" name="_method" value="PUT" />
      <input type="hidden" name="id" id="editId" />

      <div class="mb-3">
        <label class="block text-sm text-gray-600 mb-1">Title</label>
        <input id="editTitle" name="title" type="text" class="w-full px-3 py-2 rounded-md border bg-white" />
      </div>

      <div class="mb-3">
        <label class="block text-sm text-gray-600 mb-1">Subject</label>
        <input id="editSubject" name="subject" type="text" class="w-full px-3 py-2 rounded-md border bg-white" />
      </div>

      <div class="mb-4">
        <label class="block text-sm text-gray-600 mb-1">Difficulty</label>
        <select id="editDifficulty" name="difficulty" class="w-full px-3 py-2 rounded-md border bg-white">
          <option value="Mudah">Mudah</option>
          <option value="Sedang">Sedang</option>
          <option value="Sulit">Sulit</option>
        </select>
      </div>

      <div class="flex justify-end gap-3">
        <button type="button" id="editCancel" class="px-4 py-2 rounded-md border">Cancel</button>
        <button type="submit" class="px-4 py-2 rounded-md bg-[#4C47D6] text-white">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
  // make card open modal and populate form
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const editId = document.getElementById('editId');
    const editTitle = document.getElementById('editTitle');
    const editSubject = document.getElementById('editSubject');
    const editDifficulty = document.getElementById('editDifficulty');
    const editCancel = document.getElementById('editCancel');

    function openModalFromCard(el) {
      const id = el.dataset.id;
      const title = el.dataset.title;
      const subject = el.dataset.subject;
      const difficulty = el.dataset.difficulty || 'Mudah';

      editId.value = id;
      editTitle.value = title;
      editSubject.value = subject;
      editDifficulty.value = difficulty;

      // set action to update endpoint - adjust route if your update URL differs
      editForm.action = `/quests/${id}`; // change to route('quests.update', id) if using named routes

      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    // open when clicking any .quest-card
    document.querySelectorAll('.quest-card').forEach(card => {
      card.addEventListener('click', () => openModalFromCard(card));
      card.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') openModalFromCard(card); });
    });

    editCancel.addEventListener('click', () => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    });

    // close modal on outside click
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }
    });
  });
</script>
</body>
</html>