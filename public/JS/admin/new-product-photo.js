document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('photo');
    const preview = document.getElementById('photo-preview');
    if (!input || !preview) return;

    input.addEventListener('change', (e) => {
        const file = e.target.files && e.target.files[0];
        if (!file) return;

        const url = URL.createObjectURL(file);
        preview.src = url;
    });
});