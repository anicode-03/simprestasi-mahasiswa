<div id="avatar-modal"
    class="hidden fixed inset-0 z-[99] flex items-center justify-center bg-slate-900/40 backdrop-filter backdrop-blur-sm p-4"
    role="dialog" aria-modal="true" aria-labelledby="avatar-modal-title">
    <div class="modal-inner">
        <div class="p-8 border-b border-slate-200 flex justify-between items-center">
            <h3 id="avatar-modal-title" class="font-black text-slate-800 uppercase tracking-widest text-sm">Pilih
                Template Foto</h3>
            <button onclick="toggleAvatarModal()" class="text-slate-400 hover:text-slate-600 transition-colors"
                aria-label="Tutup modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-8 grid grid-cols-3 gap-4">
            <button onclick="selectAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Felix')"
                class="avatar-btn aspect-square rounded-3xl overflow-hidden bg-slate-50 border-2 border-slate-200 hover:border-blue-500 transition-all focus:outline-none"
                aria-label="Avatar Felix"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Felix"
                    class="w-full h-full p-2" alt="Avatar Felix"></button>
            <button onclick="selectAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Ani')"
                class="avatar-btn aspect-square rounded-3xl overflow-hidden bg-slate-50 border-2 border-slate-200 hover:border-blue-500 transition-all focus:outline-none"
                aria-label="Avatar Ani"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Ani"
                    class="w-full h-full p-2" alt="Avatar Ani"></button>
            <button onclick="selectAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Aneka')"
                class="avatar-btn aspect-square rounded-3xl overflow-hidden bg-slate-50 border-2 border-slate-200 hover:border-blue-500 transition-all focus:outline-none"
                aria-label="Avatar Aneka"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Aneka"
                    class="w-full h-full p-2" alt="Avatar Aneka"></button>
            <button onclick="selectAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Budi')"
                class="avatar-btn aspect-square rounded-3xl overflow-hidden bg-slate-50 border-2 border-slate-200 hover:border-blue-500 transition-all focus:outline-none"
                aria-label="Avatar Budi"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Budi"
                    class="w-full h-full p-2" alt="Avatar Budi"></button>
            <button onclick="selectAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Sari')"
                class="avatar-btn aspect-square rounded-3xl overflow-hidden bg-slate-50 border-2 border-slate-200 hover:border-blue-500 transition-all focus:outline-none"
                aria-label="Avatar Sari"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Sari"
                    class="w-full h-full p-2" alt="Avatar Sari"></button>
            <button onclick="selectAvatar('https://api.dicebear.com/7.x/avataaars/svg?seed=Doni')"
                class="avatar-btn aspect-square rounded-3xl overflow-hidden bg-slate-50 border-2 border-slate-200 hover:border-blue-500 transition-all focus:outline-none"
                aria-label="Avatar Doni"><img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Doni"
                    class="w-full h-full p-2" alt="Avatar Doni"></button>
        </div>
        <input type="hidden" name="selected_avatar_url" id="selected-avatar-input" value="">
    </div>
</div>