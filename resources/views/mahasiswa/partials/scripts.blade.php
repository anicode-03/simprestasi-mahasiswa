<script>
    /* ===== SECTION NAVIGATION ===== */
    function showSection(id) {
        const headers = {
            dashboard: {
                title: 'Selamat Datang, <span class="text-blue-700">{{ $user->name }}!</span>',
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
        if (headers[id]) {
            document.getElementById('header-title').innerHTML = headers[id].title;
            document.getElementById('header-subtitle').textContent = headers[id].sub;
        }
        document.querySelectorAll('.nav-link').forEach(link => {
            const active = link.getAttribute('onclick').includes(id);
            link.classList.toggle('active', active);
            link.classList.toggle('opacity-70', !active);
            link.classList.toggle('opacity-100', active);
            link.setAttribute('aria-current', active ? 'page' : 'false');
        });
        ['dashboard', 'pengajuan', 'pengaturan'].forEach(s => {
            const el = document.getElementById(s + '-section');
            if (!el) return;
            el.classList.add('hidden');
            el.classList.remove('flex', 'flex-col', 'flex-row', 'gap-10', 'section-transition');
        });
        const active = document.getElementById(id + '-section');
        if (active) {
            active.classList.remove('hidden');
            active.classList.add('flex', 'section-transition');
            if (id === 'dashboard') active.classList.add('flex-row', 'gap-10');
            else active.classList.add('flex-col');
        }
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
            formBtn.classList.add('bg-blue-600', 'text-white');
            formBtn.classList.remove('text-slate-500', 'bg-white', 'text-blue-700', 'shadow-sm');
            histBtn.classList.remove('bg-blue-600', 'text-white', 'bg-white', 'text-blue-700', 'shadow-sm');
            histBtn.classList.add('text-slate-500');
            formBtn.setAttribute('aria-selected', 'true');
            histBtn.setAttribute('aria-selected', 'false');
        } else {
            histTab.classList.remove('hidden');
            formTab.classList.add('hidden');
            histBtn.classList.add('bg-blue-600', 'text-white');
            histBtn.classList.remove('text-slate-500', 'bg-white', 'text-blue-700', 'shadow-sm');
            formBtn.classList.remove('bg-blue-600', 'text-white', 'bg-white', 'text-blue-700', 'shadow-sm');
            formBtn.classList.add('text-slate-500');
            histBtn.setAttribute('aria-selected', 'true');
            formBtn.setAttribute('aria-selected', 'false');
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
        const c = document.getElementById('toast-container');
        const t = document.createElement('div');
        t.className = `toast toast-${type}`;
        t.setAttribute('role', 'alert');
        t.innerHTML =
            `<div class="toast-icon"><i class="fas ${toastIcons[type]||'fa-info'}"></i></div>
        <div class="flex-1">${title?`<div style="font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;opacity:.6;margin-bottom:2px;">${title}</div>`:''}
        <div style="font-size:13px;font-weight:600;">${message}</div></div>
        <button onclick="dismissToast(this.closest('.toast'))" style="opacity:.4;font-size:12px;padding:2px 6px;" aria-label="Tutup">&times;</button>`;
        c.appendChild(t);
        setTimeout(() => dismissToast(t), 4500);
    }

    function dismissToast(t) {
        if (!t || t.classList.contains('removing')) return;
        t.classList.add('removing');
        t.addEventListener('animationend', () => t.remove(), { once: true });
    }

    /* ===== FIELD VALIDATION ===== */
    function setFieldState(input, valid, errorId, msg) {
        const errEl = document.getElementById(errorId);
        input.classList.toggle('input-error', !valid);
        input.classList.toggle('input-ok', valid);
        if (errEl) {
            if (msg) errEl.textContent = msg;
            errEl.classList.toggle('visible', !valid);
        }
    }

    function validatePengajuanForm() {
        let ok = true;
        const n = document.getElementById('nama_kompetisi');
        const p = document.getElementById('penyelenggara');
        const t = document.getElementById('tanggal');
        if (!n.value.trim()) { setFieldState(n, false, 'err-nama'); ok = false; }
        else setFieldState(n, true, 'err-nama');
        if (!p.value.trim()) { setFieldState(p, false, 'err-penyelenggara'); ok = false; }
        else setFieldState(p, true, 'err-penyelenggara');
        if (!t.value) { setFieldState(t, false, 'err-tanggal'); ok = false; }
        else setFieldState(t, true, 'err-tanggal');
        return ok;
    }

    function validateProfilForm() {
        let ok = true;
        const email = document.getElementById('email');
        const newPw = document.getElementById('new_password');
        const conf = document.getElementById('confirm_password');
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            setFieldState(email, false, 'err-email'); ok = false;
        } else setFieldState(email, true, 'err-email');
        if (newPw.value && newPw.value !== conf.value) {
            setFieldState(conf, false, 'err-confirm'); ok = false;
        } else setFieldState(conf, true, 'err-confirm');
        return ok;
    }

    /* Real-time validation */
    document.addEventListener('DOMContentLoaded', () => {
        [{id: 'nama_kompetisi', errId: 'err-nama', check: v => v.trim() !== ''},
         {id: 'penyelenggara', errId: 'err-penyelenggara', check: v => v.trim() !== ''},
         {id: 'tanggal', errId: 'err-tanggal', check: v => v !== ''}
        ].forEach(({id, errId, check}) => {
            const el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('blur', () => setFieldState(el, check(el.value), errId));
            el.addEventListener('input', () => {
                if (el.classList.contains('input-error')) setFieldState(el, check(el.value), errId);
            });
        });
        const emailEl = document.getElementById('email');
        if (emailEl) emailEl.addEventListener('blur', () => setFieldState(emailEl, /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailEl.value), 'err-email'));
        const conf = document.getElementById('confirm_password');
        const newPw = document.getElementById('new_password');
        if (conf && newPw) conf.addEventListener('input', () => {
            if (newPw.value && conf.value) setFieldState(conf, newPw.value === conf.value, 'err-confirm');
        });
        setupDragDrop('zone-cert', 'file-cert', 'label-cert');
        setupDragDrop('zone-photo', 'file-photo', 'label-photo');
    });

    /* ===== FORM SUBMITS ===== */
    document.getElementById('pengajuan-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (!validatePengajuanForm()) {
            showToast('error', 'Mohon lengkapi semua kolom yang wajib diisi.', 'Validasi');
            return;
        }
        const btn = document.getElementById('submit-btn');
        const sp = document.getElementById('submit-spinner');
        const ic = document.getElementById('submit-icon');
        const lb = document.getElementById('submit-label');
        btn.disabled = true;
        sp.style.display = 'block';
        ic.style.display = 'none';
        lb.textContent = 'Mengirim...';
        setTimeout(() => {
            btn.disabled = false;
            sp.style.display = 'none';
            ic.style.display = '';
            lb.textContent = 'Kirim Pengajuan Prestasi';
            showToast('success', 'Pengajuan berhasil dikirim dan sedang menunggu verifikasi.', 'Berhasil');
        }, 1800);
    });

    document.getElementById('profil-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (!validateProfilForm()) {
            showToast('error', 'Periksa kembali data yang dimasukkan.', 'Validasi');
            return;
        }
        const btn = document.getElementById('profil-submit-btn');
        const sp = document.getElementById('profil-spinner');
        const ic = document.getElementById('profil-icon');
        const lb = document.getElementById('profil-label');
        btn.disabled = true;
        sp.style.display = 'block';
        ic.style.display = 'none';
        lb.textContent = 'Menyimpan...';
        setTimeout(() => {
            btn.disabled = false;
            sp.style.display = 'none';
            ic.style.display = '';
            lb.textContent = 'Simpan Perubahan';
            showToast('success', 'Profil berhasil diperbarui.', 'Tersimpan');
        }, 1500);
    });

    /* ===== CONFIRM RESET ===== */
    function confirmReset() {
        const modal = document.getElementById('confirm-modal');
        modal.classList.add('open');
        const close = () => modal.classList.remove('open');
        document.getElementById('confirm-cancel').onclick = close;
        document.getElementById('confirm-ok').onclick = () => {
            document.getElementById('pengajuan-form').reset();
            document.getElementById('label-cert').innerHTML = defaultUploadHTML('fa-file-pdf', 'Upload Sertifikat', '(Format PDF - Multiple)', 'Pilih File', 'text-blue-500');
            document.getElementById('label-photo').innerHTML = defaultUploadHTML('fa-image', 'Upload Dokumentasi', '(Format Gambar - Multiple)', 'Pilih Foto', 'text-indigo-500');
            ['nama_kompetisi', 'penyelenggara', 'tanggal'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.classList.remove('input-error', 'input-ok');
            });
            document.querySelectorAll('.field-error').forEach(el => el.classList.remove('visible'));
            close();
            showToast('info', 'Formulir telah direset.', 'Reset');
        };
        modal.onclick = e => { if (e.target === modal) close(); };
    }

    function defaultUploadHTML(icon, title, sub, btn, iconColor) {
        return `<div class="w-16 h-16 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-4"><i class="fas ${icon} text-3xl ${iconColor}"></i></div>
        <p class="text-[10px] font-black uppercase text-slate-500 tracking-[0.2em] mb-1">${title}</p>
        <p class="text-[10px] text-slate-400 font-medium mb-4 italic">${sub}</p>
        <span class="inline-block px-8 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600">${btn}</span>`;
    }

    /* ===== FILE UPLOAD ===== */
    function updateFileName(input, targetId) {
        const target = document.getElementById(targetId);
        if (!input.files || !input.files.length) return;
        const display = input.files.length === 1 ? input.files[0].name : `${input.files.length} file terpilih`;
        target.innerHTML =
            `<i class="fas fa-check-circle text-4xl text-green-500 mb-3"></i>
        <p class="text-sm font-bold text-slate-700">${display}</p>
        <span class="mt-2 text-[10px] text-blue-500 font-bold uppercase tracking-tighter cursor-pointer">Ganti Semua</span>`;
        showToast('success', `${display} siap diunggah.`, 'File Dipilih');
    }

    function setupDragDrop(zoneId, inputId, labelId) {
        const zone = document.getElementById(zoneId);
        const input = document.getElementById(inputId);
        if (!zone || !input) return;
        ['dragenter', 'dragover'].forEach(evt => zone.addEventListener(evt, e => {
            e.preventDefault();
            zone.classList.add('dragover');
        }));
        ['dragleave', 'dragend', 'drop'].forEach(evt => zone.addEventListener(evt, e => {
            e.preventDefault();
            zone.classList.remove('dragover');
            if (evt === 'drop' && e.dataTransfer?.files?.length) {
                input.files = e.dataTransfer.files;
                updateFileName(input, labelId);
            }
        }));
    }

    /* ===== PASSWORD STRENGTH ===== */
    function updatePasswordStrength(val) {
        const bar = document.getElementById('pw-strength-bar');
        const label = document.getElementById('pw-strength-label');
        if (!bar || !label) return;
        if (!val) { bar.style.width = '0%'; label.textContent = ''; return; }
        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;
        const levels = [
            {pct: '25%', color: '#ef4444', text: 'Sangat lemah'},
            {pct: '50%', color: '#f59e0b', text: 'Lemah'},
            {pct: '75%', color: '#3b82f6', text: 'Cukup kuat'},
            {pct: '100%', color: '#22c55e', text: 'Sangat kuat'},
        ];
        const lvl = levels[Math.max(0, score - 1)];
        bar.style.width = lvl.pct;
        bar.style.background = lvl.color;
        label.textContent = lvl.text;
        label.style.color = lvl.color;
    }

    /* ===== AVATAR MODAL ===== */
    function toggleAvatarModal() {
        const modal = document.getElementById('avatar-modal');
        modal.classList.toggle('hidden');
    }

    function selectAvatar(url) {
        document.getElementById('current-avatar').src = url;
        document.getElementById('selected-avatar-input').value = url;
        document.querySelectorAll('.avatar-btn').forEach(b => b.classList.remove('avatar-btn-selected'));
        event.currentTarget.classList.add('avatar-btn-selected');
        toggleAvatarModal();
        showToast('success', 'Foto profil berhasil diubah. Simpan perubahan untuk menyimpan.', 'Avatar Diubah');
    }

    document.getElementById('avatar-modal').addEventListener('click', function(e) {
        if (e.target === this) toggleAvatarModal();
    });

    /* ===== LOGOUT ===== */
    function confirmLogout(e) {
        if (!confirm('Apakah Anda yakin ingin keluar dari sistem?')) {
            e?.preventDefault();
            return false;
        }
        return true;
    }

    /* ===== KEYBOARD NAV ===== */
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                link.click();
            }
        });
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            document.getElementById('confirm-modal').classList.remove('open');
            const am = document.getElementById('avatar-modal');
            if (!am.classList.contains('hidden')) toggleAvatarModal();
        }
    });
</script>