<script>
    /* ===== SECTION NAVIGATION ===== */
    function showSection(id) {
        const headers = {
            dashboard: {
                title: 'Selamat Datang, <span class="text-blue-700">{{ auth()->user()->name }}</span>',
                sub: 'Pantau terus perkembangan prestasimu hari ini.'
            },
            pengajuan: {
                title: 'Pengajuan <span class="text-blue-700">Prestasi</span>',
                sub: 'Ajukan prestasi akademik atau non-akademik terbaru Anda.'
            },
            pengaturan: {
                title: 'Pengaturan <span class="text-blue-700">Profil</span>',
                sub: 'Kelola informasi diri dan keamanan akun sistem Anda.'
            },
        };

        const headerTitle = document.getElementById('header-title');
        const headerSub = document.getElementById('header-subtitle');

        if (headers[id] && headerTitle && headerSub) {
            headerTitle.innerHTML = headers[id].title;
            headerSub.textContent = headers[id].sub;
        }

        // Navigation links update
        document.querySelectorAll('.nav-link').forEach(link => {
            const isClickTarget = link.getAttribute('onclick')?.includes(id) ||
                link.dataset.section === id;

            link.classList.toggle('active', isClickTarget);
            link.classList.toggle('opacity-70', !isClickTarget);
            link.classList.toggle('opacity-100', isClickTarget);
            link.setAttribute('aria-current', isClickTarget ? 'page' : 'false');
        });

        // Sections visibility
        ['dashboard', 'pengajuan', 'pengaturan'].forEach(s => {
            const el = document.getElementById(s + '-section');
            if (!el) return;

            if (s === id) {
                el.classList.remove('hidden');
                el.classList.add('flex', 'section-transition');
                if (id === 'dashboard') {
                    el.classList.add('flex-row', 'gap-10');
                } else {
                    el.classList.add('flex-col');
                }
            } else {
                el.classList.add('hidden');
                el.classList.remove('flex', 'flex-col', 'flex-row', 'gap-10', 'section-transition');
            }
        });
    }

    /* ===== FORM TABS ===== */
    function switchFormTab(tab) {
        const formTab = document.getElementById('subtab-form');
        const histTab = document.getElementById('subtab-history');
        const formBtn = document.getElementById('tab-form-btn');
        const histBtn = document.getElementById('tab-history-btn');

        if (tab === 'form') {
            formTab.classList.remove('hidden');
            histTab.classList.add('hidden');

            // Kembalikan style tombol aktif ke biru
            formBtn.className =
                "tab-btn px-8 py-3 rounded-xl font-bold text-sm transition-all bg-blue-600 text-white flex items-center";
            histBtn.className =
                "tab-btn px-8 py-3 rounded-xl font-bold text-sm transition-all text-slate-500 hover:text-slate-700 flex items-center";
        } else {
            formTab.classList.add('hidden');
            histTab.classList.remove('hidden');

            // Pindahkan style biru ke tombol riwayat
            histBtn.className =
                "tab-btn px-8 py-3 rounded-xl font-bold text-sm transition-all bg-blue-600 text-white flex items-center";
            formBtn.className =
                "tab-btn px-8 py-3 rounded-xl font-bold text-sm transition-all text-slate-500 hover:text-slate-700 flex items-center";
        }
    }

    /* ===== TOAST ===== */
    const toastIcons = {
        success: 'fa-check',
        error: 'fa-times',
        info: 'fa-info',
        warning: 'fa-exclamation'
    };

    function showToast(type, message, title) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.setAttribute('role', 'alert');
        toast.innerHTML =
            `
            <div class="toast-icon"><i class="fas ${toastIcons[type] || 'fa-info'}"></i></div>
            <div class="flex-1">
                ${title ? `<div style="font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;opacity:.6;margin-bottom:2px;">${title}</div>` : ''}
                <div style="font-size:13px;font-weight:600;">${message}</div>
            </div>
            <button class="dismiss-btn" style="opacity:.4;font-size:12px;padding:2px 6px;" aria-label="Tutup">&times;</button>`;

        container.appendChild(toast);

        toast.querySelector('.dismiss-btn').onclick = () => dismissToast(toast);
        setTimeout(() => dismissToast(toast), 4500);
    }

    function dismissToast(toast) {
        if (!toast || toast.classList.contains('removing')) return;
        toast.classList.add('removing');
        toast.addEventListener('animationend', () => toast.remove(), {
            once: true
        });
    }

    /* ===== ANIMATIONS ===== */
    function applyPressAnimation(selector) {
        document.querySelectorAll(selector).forEach(btn => {
            btn.addEventListener('mousedown', () => {
                btn.style.transform = 'scale(0.97) translateY(1px)';
                btn.style.transition = 'transform 0.08s ease';
            });
            const reset = () => {
                btn.style.transform = '';
                btn.style.transition = 'transform 0.18s cubic-bezier(0.34,1.56,0.64,1)';
            };
            btn.addEventListener('mouseup', reset);
            btn.addEventListener('mouseleave', reset);
        });
    }

    function createRipple(e, el) {
        const existing = el.querySelector('.btn-ripple');
        if (existing) existing.remove();

        const rect = el.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height) * 2;
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        const ripple = document.createElement('span');
        ripple.className = 'btn-ripple';
        ripple.style.cssText = `
            position:absolute;width:${size}px;height:${size}px;
            left:${x}px;top:${y}px;border-radius:50%;
            background:rgba(255,255,255,0.3);pointer-events:none;
            transform:scale(0);animation:rippleAnim 0.6s ease-out forwards;
        `;

        if (window.getComputedStyle(el).position === 'static') el.style.position = 'relative';
        el.style.overflow = 'hidden';
        el.appendChild(ripple);
        ripple.addEventListener('animationend', () => ripple.remove());
    }

    /* ===== VALIDATION ===== */
    function setFieldState(input, valid, errorId, msg) {
        if (!input) return;
        const errEl = document.getElementById(errorId);
        input.classList.toggle('input-error', !valid);
        input.classList.toggle('input-ok', valid);
        if (errEl) {
            if (msg) errEl.textContent = msg;
            errEl.classList.toggle('visible', !valid);
        }
    }

    function updateDeskripsCounter(el) {
        const counter = document.getElementById('deskripsi-counter');
        if (!counter) return;
        counter.textContent = `${el.value.length} / 1000`;
    }

    /* ===== DOM READY ===== */
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Inisialisasi Ripple Style (Tetap seperti semula)
        if (!document.getElementById('ripple-style')) {
            const s = document.createElement('style');
            s.id = 'ripple-style';
            s.textContent = `@keyframes rippleAnim{to{transform:scale(1);opacity:0}}`;
            document.head.appendChild(s);
        }

        // 2. LOGIKA NAVIGASI SECTION (Prioritas Utama)
        @if (session('last_section'))
            // Jika baru saja submit, buka section terakhir (misal: pengajuan)
            showSection("{{ session('last_section') }}");
        @else
            // Jika akses biasa, buka dashboard
            showSection('dashboard');
        @endif

        // 3. LOGIKA NOTIFIKASI & TAB (Hanya jika sukses)
        @if (session('success'))
            showToast('success', '{{ session('success') }}', 'Berhasil');

            // Cek jika section aktif adalah pengajuan, maka otomatis buka tab riwayat
            @if (session('last_section') == 'pengajuan')
                switchFormTab('history');
            @endif
        @endif

        // Form Submit Listeners
        const pengajuanForm = document.getElementById('pengajuan-form');
        if (pengajuanForm) {
            pengajuanForm.addEventListener('submit', function(e) {
                let isValid = true;
                const req = {
                    nama: 'nama_kompetisi',
                    peny: 'penyelenggara',
                    tgl: 'tanggal'
                };

                Object.entries(req).forEach(([key, id]) => {
                    const el = document.getElementById(id);
                    if (!el?.value.trim()) {
                        setFieldState(el, false, 'err-' + (id.split('_')[0]));
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    showToast('error', 'Mohon lengkapi semua kolom wajib.', 'Validasi');
                } else {
                    const btn = document.getElementById('submit-btn');
                    if (btn) {
                        btn.disabled = true;
                        btn.querySelector('#submit-spinner')?.classList.remove('hidden');
                        btn.querySelector('#submit-icon')?.classList.add('hidden');
                        const label = btn.querySelector('#submit-label');
                        if (label) label.textContent = 'Mengirim...';
                    }
                }
            });
        }

        // Deskripsi Counter
        const deskripsi = document.getElementById('deskripsi');
        if (deskripsi) {
            deskripsi.addEventListener('input', function() {
                const counter = document.getElementById('deskripsi-counter');
                if (!counter) return;
                const len = this.value.length;
                const max = this.maxLength || 1000;
                counter.textContent = `${len} / ${max}`;
                counter.className = 'text-xs font-medium ' +
                    (len > max * 0.9 ? 'text-red-500' : (len > max * 0.7 ? 'text-amber-500' :
                        'text-slate-400'));
            });
        }

        // Setup UI Enhancements
        setupDragDrop('zone-cert', 'file-cert', 'label-cert');
        setupDragDrop('zone-photo', 'file-photo', 'label-photo');
        applyPressAnimation('button, a.btn, [role="button"]');

        document.querySelectorAll('#submit-btn, #profil-submit-btn, .tab-btn').forEach(el => {
            el.addEventListener('mousedown', e => createRipple(e, el));
        });

        // Auto buka tab riwayat jika ada session success (setelah form submit)
        @if (session('success'))
            switchFormTab('history');
            showToast('success', '{{ session('success') }}', 'Berhasil');
        @endif
    });

    /* ===== FILE UPLOAD ===== */
    function updateFileName(input, targetId) {
        const target = document.getElementById(targetId);
        if (!input.files?.length || !target) return;

        const count = input.files.length;
        const display = count === 1 ? input.files[0].name : `${count} file terpilih`;

        target.innerHTML =
            `
            <i class="fas fa-check-circle text-4xl text-green-500 mb-3"></i>
            <p class="text-sm font-bold text-slate-700">${display}</p>
            <span class="mt-2 text-[10px] text-blue-500 font-bold uppercase tracking-tighter cursor-pointer">Ganti Semua</span>`;

        showToast('success', `${display} siap diunggah.`, 'File Berhasil');
    }

    function setupDragDrop(zoneId, inputId, labelId) {
        const zone = document.getElementById(zoneId);
        const input = document.getElementById(inputId);
        if (!zone || !input) return;

        ['dragenter', 'dragover'].forEach(evt => {
            zone.addEventListener(evt, e => {
                e.preventDefault();
                zone.classList.add('border-blue-400', 'bg-blue-50');
            });
        });

        ['dragleave', 'dragend', 'drop'].forEach(evt => {
            zone.addEventListener(evt, e => {
                e.preventDefault();
                zone.classList.remove('border-blue-400', 'bg-blue-50');
                if (evt === 'drop' && e.dataTransfer?.files?.length) {
                    input.files = e.dataTransfer.files;
                    updateFileName(input, labelId);
                }
            });
        });
    }

    /* ===== AVATAR ===== */
    function selectAvatar(url, element) {
        // Update preview foto
        const img = document.getElementById('current-avatar');
        if (img) img.src = url;

        // Isi input hidden yang ADA DI DALAM FORM (bukan di modal)
        const input = document.getElementById('avatar-input-hidden');
        if (input) input.value = url;

        // Highlight avatar yang dipilih
        document.querySelectorAll('.avatar-btn').forEach(b =>
            b.classList.remove('avatar-btn-selected', 'ring-4', 'ring-blue-500')
        );
        if (element) element.classList.add('avatar-btn-selected', 'ring-4', 'ring-blue-500');

        toggleAvatarModal();
        showToast('info', 'Foto profil dipilih. Jangan lupa simpan perubahan.', 'Avatar');
    }

    function toggleAvatarModal() {
        const modal = document.getElementById('avatar-modal');
        if (modal) modal.classList.toggle('hidden');
    }

    // Modal Close on Backdrop
    window.onclick = function(event) {
        const modal = document.getElementById('avatar-modal');
        if (event.target === modal) toggleAvatarModal();
    };
</script>
