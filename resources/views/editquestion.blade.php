<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Edit Quest</title>
  <!-- Tailwind Play CDN for quick preview (replace with your compiled Tailwind in prod) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{--violet:#4C47D6;--green:#63E6C1;--sky:#7AB7F5;--soft:#DCE9EB}
    body{font-family: 'Montserrat', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; background: var(--soft);}    
    /* small visual tweaks to match mock */
    .card-shadow{box-shadow: 0 8px 20px rgba(25,30,40,0.06)}
    .inner-panel{border:1px solid rgba(0,0,0,0.06); border-radius:12px}
    .input-question{height:48px;border-radius:10px}
    .input-option{height:40px;border-radius:10px}
    .no-border{border:none!important;box-shadow:none!important}
    /* subtle icon circle */
    .icon-circle{width:36px;height:36px;border-radius:10px;background:#fff;display:flex;align-items:center;justify-content:center}
    /* small checkbox circle */
    .check-circle{width:26px;height:26px;border-radius:999px;background:#fff;display:flex;align-items:center;justify-content:center;border:1px solid rgba(127,107,255,0.12)}
    /* select-correct button visuals */
    .select-correct{cursor:pointer;z-index:10;min-width:24px;min-height:24px;border-radius:999px;border:1px solid rgba(127,107,255,0.12);display:flex;align-items:center;justify-content:center}
    .select-correct.selected{background:var(--violet);color:#fff;border-color:var(--violet)}
    /* Add-question CTA */
    .add-question-cta .circle{width:34px;height:34px;border-radius:999px;background:var(--violet);color:#fff;display:flex;align-items:center;justify-content:center;box-shadow:0 6px 12px rgba(76,71,214,0.12)}
  </style>
</head>
<body class="min-h-screen">
  <header class="bg-white flex items-center justify-between px-8 py-4 shadow-sm" style="height:76px">
    <div class="flex items-center gap-4">
      <div class="icon-circle shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9.75L12 4l9 5.75V20a1 1 0 0 1-1 1h-4v-6H8v6H4a1 1 0 0 1-1-1V9.75z"/></svg></div>

      <!-- header publish: will submit the form (keeps look) -->
      <button id="headerPublish" type="button" class="rounded-lg text-white bg-gradient-to-r from-[#63E6C1] via-[#7AB7F5] to-[#7F6BFF] flex items-center gap-2 px-4 py-2 font-semibold" style="border-radius:10px">
        <img src="/images/publish.png" alt="publish" class="w-5 h-5 object-contain"/>
        <span>Publish</span>
      </button>
    </div>

    <!-- right profile area -->
    <div class="flex items-center gap-4">
      <img src="{{ Auth::user()->profile_photo_url ?? '/images/pfp.png' }}" alt="profile" class="w-10 h-10 rounded-full object-cover"/>
      <div class="text-left">
        <div class="text-sm font-medium text-gray-800">{{ Auth::user()->name ?? 'User' }}</div>
        <div class="text-xs text-gray-500">{{ Auth::user()->email ?? '' }}</div>
      </div>
    </div>
  </header>

  <main class="flex justify-center mt-12 px-6">
    <form id="quizForm" action="{{ route('quest.update', $quest->id) }}" method="POST" class="bg-white w-full max-w-5xl rounded-2xl p-6 card-shadow">
      @csrf
      @method('PUT')
      <div class="mb-6">
        <input name="title" id="quizTitle" value="{{ $quest->title ?? '' }}" placeholder="Bahasa" class="text-xl font-semibold no-border focus:outline-none focus:ring-0 px-3 py-2 bg-transparent" />
      </div>

      <div class="w-full bg-[#E6F3F4] rounded-xl px-6 py-7 inner-panel">
        <div class="max-w-3xl mx-auto">

          <div id="questions" class="space-y-8 w-full"></div>

          <div class="mt-6 flex items-center justify-between">
            <button type="button" id="addQuestion" class="add-question-cta flex items-center gap-3 text-violet-700 font-semibold">
              <span class="circle">＋</span>
              <span>Add more question</span>
            </button>
          </div>

        </div>
      </div>
    </form>
  </main>

  <template id="tpl-question">
    <div class="question-item">
      <div class="w-full">
        <div class="mb-4">
          <input type="text" class="q-text w-full bg-white input-question px-4 py-2 text-sm no-border" placeholder="Question title (small)" />
        </div>

        <div class="bg-[#ECF6F7] rounded-lg p-5 border border-transparent">

          <div class="options space-y-3">
            <div class="flex items-center gap-3 option-row">
              <button type="button" class="select-correct w-6 h-6 flex items-center justify-center rounded-full bg-white text-[#7F6BFF]">✓</button>
              <input type="text" class="option-input bg-white input-option px-4 no-border w-[420px]" placeholder="Option 1" />
              <button type="button" class="remove-option text-sm text-gray-400 px-3">✕</button>
            </div>

            <div class="flex items-center gap-3 option-row">
              <button type="button" class="select-correct w-6 h-6 flex items-center justify-center rounded-full bg-white text-[#7F6BFF]">✓</button>
              <input type="text" class="option-input bg-white input-option px-4 no-border w-[420px]" placeholder="Option 2" />
              <button type="button" class="remove-option text-sm text-gray-400 px-3">✕</button>
            </div>
          </div>

          <div class="mt-4 flex items-center justify-between">
            <button type="button" class="add-option-btn add-option px-2 py-1 inline-flex items-center gap-2 text-[#7F6BFF] font-semibold">
              <span class="plus text-xl">＋</span>
              <span>Add option</span>
            </button>

            <div class="flex items-center gap-6 text-sm">
              <label class="flex items-center gap-2"><input type="checkbox" class="q-multi" /> Multiple Choices</label>
              <label class="flex items-center gap-2"><input type="checkbox" class="q-required" /> Required</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
    // server-side questions payload for client-side UI population
    window.serverQuestions = @json($questions ?? []);

    (function(){
      const questionsEl = document.getElementById('questions');
      const tpl = document.getElementById('tpl-question').content;
      const form = document.getElementById('quizForm');

      // Delegate clicks on select-correct to the container (works for dynamic rows)
      questionsEl.addEventListener('click', (ev) => {
        const btn = ev.target.closest('.select-correct');
        if (!btn) return;
        // prevent accidental form submit
        ev.preventDefault();
        console.log('select-correct clicked', btn);
        const qItem = btn.closest('.question-item');
        const multi = qItem.querySelector('.q-multi') && qItem.querySelector('.q-multi').checked;
        const opts = Array.from(qItem.querySelectorAll('.option-row'));
        if (multi) {
          btn.classList.toggle('selected');
          btn.setAttribute('aria-pressed', btn.classList.contains('selected') ? 'true' : 'false');
        } else {
          opts.forEach(r => { const b = r.querySelector('.select-correct'); if (b && b !== btn) b.classList.remove('selected'); });
          btn.classList.add('selected');
          btn.setAttribute('aria-pressed', 'true');
        }
        renumber();
      });

      // header publish button submits the form (will POST to newquest.store)
      const headerPublish = document.getElementById('headerPublish');
      headerPublish && headerPublish.addEventListener('click', () => {
        // make sure renumber runs (form submit listener already calls renumber)
        form.requestSubmit ? form.requestSubmit() : form.submit();
      });

      function addQuestion(data = null) {
        const node = tpl.cloneNode(true);
        const item = node.querySelector('.question-item');

          if(data) {
          const qtext = item.querySelector('.q-text'); if(qtext) qtext.value = data.text || data.title || '';
          const optsWrap = item.querySelector('.options');
          const existing = optsWrap.querySelectorAll('.option-row').length;
          const needed = (data.options && data.options.length) ? data.options.length : 0;
          // create extra option rows if server data has more options than the template
          for (let k = existing; k < needed; k++) {
            const row = document.createElement('div');
            row.className = 'flex items-center gap-3 option-row';
            row.innerHTML = `\n              <button type="button" class="select-correct w-6 h-6 flex items-center justify-center rounded-full bg-white text-[#7F6BFF]">✓</button>\n              <input type="text" class="option-input bg-white input-option px-4 no-border w-[420px]" placeholder="Option ${k+1}" />\n              <button type="button" class="remove-option text-sm text-gray-400 px-3">✕</button>\n            `;
            optsWrap.appendChild(row);
            row.querySelector('.remove-option').addEventListener('click', () => row.remove());
          }
          const opts = item.querySelectorAll('.option-input');
          opts.forEach((el, idx) => {
            const o = data.options && data.options[idx];
            if (o) {
              el.value = (o.text ?? o);
              const sel = el.parentNode.querySelector('.select-correct');
              if (o.is_correct && sel) sel.classList.add('selected');
            }
          });
          if(data.multi) item.querySelector('.q-multi').checked = true;
          if(data.required) item.querySelector('.q-required').checked = true;
        }

        item.querySelector('.add-option').addEventListener('click', () => {
          const optsWrap = item.querySelector('.options');
          const count = optsWrap.querySelectorAll('.option-row').length + 1;
          const row = document.createElement('div');
          row.className = 'flex items-center gap-3 option-row';
          row.innerHTML = `\n              <button type="button" class="select-correct w-6 h-6 flex items-center justify-center rounded-full bg-white text-[#7F6BFF]">✓</button>\n              <input type="text" class="option-input bg-white input-option px-4 no-border w-[420px]" placeholder="Option ${count}" />\n              <button type="button" class="remove-option text-sm text-gray-400 px-3">✕</button>\n            `;
          optsWrap.appendChild(row);
          row.querySelector('.remove-option').addEventListener('click', () => row.remove());
          // bind select-correct for the newly added row
          const sel = row.querySelector('.select-correct');
          if (sel) sel.addEventListener('click', () => {
            const qItem = row.closest('.question-item');
            const multi = qItem.querySelector('.q-multi') && qItem.querySelector('.q-multi').checked;
            const opts = Array.from(qItem.querySelectorAll('.option-row'));
            if (multi) {
              sel.classList.toggle('selected');
            } else {
              opts.forEach(r => { const b = r.querySelector('.select-correct'); if (b && b !== sel) b.classList.remove('selected'); });
              sel.classList.add('selected');
            }
            renumber();
          });
          renumber();
        });

        item.querySelectorAll('.remove-option').forEach(btn => btn.addEventListener('click', (e) => e.target.closest('.option-row').remove()));

        // bind select-correct buttons inside this question
        function bindSelectCorrect(row) {
          const btn = row.querySelector('.select-correct');
          if (!btn) return;
          btn.addEventListener('click', () => {
            const qItem = row.closest('.question-item');
            const multi = qItem.querySelector('.q-multi') && qItem.querySelector('.q-multi').checked;
            const opts = Array.from(qItem.querySelectorAll('.option-row'));
            if (multi) {
              // toggle this option
              btn.classList.toggle('selected');
            } else {
              // single choice: clear other selections
              opts.forEach(r => {
                const b = r.querySelector('.select-correct');
                if (b && b !== btn) b.classList.remove('selected');
              });
              btn.classList.add('selected');
            }
            // update hidden inputs (names are set in renumber)
            renumber();
          });
        }

        item.querySelectorAll('.option-row').forEach(r => bindSelectCorrect(r));

        questionsEl.appendChild(item);
        renumber();
      }

      function renumber() {
        document.querySelectorAll('#questions .question-item').forEach((qEl, qi) => {
          qEl.querySelectorAll('.q-text').forEach(el => el.setAttribute('name', `questions[${qi}][text]`));
          qEl.querySelectorAll('.q-multi').forEach(el => el.setAttribute('name', `questions[${qi}][multi]`));
          qEl.querySelectorAll('.q-required').forEach(el => el.setAttribute('name', `questions[${qi}][required]`));
          qEl.querySelectorAll('.option-input').forEach((optEl, oi) => {
            optEl.setAttribute('name', `questions[${qi}][options][${oi}]`);
            // ensure a hidden input exists to record correctness for this option
            let hidden = optEl.parentNode.querySelector('.is-correct-input');
            if (!hidden) {
              hidden = document.createElement('input');
              hidden.type = 'hidden';
              hidden.className = 'is-correct-input';
              optEl.parentNode.appendChild(hidden);
            }
            hidden.setAttribute('name', `questions[${qi}][correct][${oi}]`);
            // set value based on selection state
            const selBtn = optEl.parentNode.querySelector('.select-correct');
            hidden.value = (selBtn && selBtn.classList.contains('selected')) ? '1' : '0';
          });
        });
      }

      // if server provided questions, render them; otherwise add one blank question
      const serverQuestions = window.serverQuestions || [];
      if (serverQuestions.length) {
        serverQuestions.forEach(q => {
          // map DB shape to UI shape: title/text and options array of strings
          const data = {
            title: q.question_text || q.title || '',
            text: q.question_text || q.title || '',
            options: Array.isArray(q.options) ? q.options.map(o => ({ text: (o.option_text ?? o), is_correct: (o.is_correct ?? 0) })) : [],
            multi: q.is_multiple ?? false,
            required: q.is_required ?? false,
          };
          addQuestion(data);
        });
      } else {
        addQuestion();
      }

      document.getElementById('addQuestion').addEventListener('click', () => addQuestion());

      form.addEventListener('submit', (e) => {
        renumber();
      });

    })();
  </script>
</body>
</html>
