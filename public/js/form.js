(function () {
    const form = document.getElementById('recipe-form');
    if (!form) return;

    const fileInput = document.getElementById('image');
    const dropzone = document.getElementById('upload-dropzone');
    const placeholder = document.getElementById('upload-placeholder');
    const preview = document.getElementById('upload-preview');
    const btnRemove = document.getElementById('btn-remove-image');

    if (!fileInput || !dropzone || !preview) return;

    /* ===== Preview saat pilih file ===== */
    function showPreview(file) {
        if (!file || !file.type.startsWith('image/')) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
            if (btnRemove) btnRemove.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    fileInput.addEventListener('change', function () {
        if (fileInput.files && fileInput.files[0]) {
            showPreview(fileInput.files[0]);
        }
    });

    /* ===== Tombol hapus gambar baru ===== */
    if (btnRemove) {
        btnRemove.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            fileInput.value = '';
            preview.src = '';
            preview.style.display = 'none';
            btnRemove.style.display = 'none';

            // Kalau di halaman edit dan ada gambar lama, tampilkan kembali
            const existing = preview.getAttribute('data-existing');
            if (existing) {
                preview.src = existing;
                preview.style.display = 'block';
            } else if (placeholder) {
                placeholder.style.display = 'flex';
            }
        });
    }

    /* ===== Drag & drop ===== */
    ['dragenter', 'dragover'].forEach(function (event) {
        dropzone.addEventListener(event, function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.add('dragover');
        });
    });

    ['dragleave', 'drop'].forEach(function (event) {
        dropzone.addEventListener(event, function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('dragover');
        });
    });

    dropzone.addEventListener('drop', function (e) {
        const files = e.dataTransfer.files;
        if (files && files[0]) {
            fileInput.files = files;
            showPreview(files[0]);
        }
    });

    /* ===== Character counter ===== */
    document.querySelectorAll('.char-count').forEach(function (counter) {
        const targetId = counter.getAttribute('data-for');
        const textarea = document.getElementById(targetId);
        if (!textarea) return;

        const update = function () {
            counter.textContent = textarea.value.length;
        };
        textarea.addEventListener('input', update);
        update();
    });

    /* ===== Konfirmasi kalau ada perubahan belum disimpan ===== */
    let isDirty = false;
    form.addEventListener('input', function () {
        isDirty = true;
    });
    form.addEventListener('submit', function () {
        isDirty = false;
    });
    window.addEventListener('beforeunload', function (e) {
        if (isDirty) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
})();