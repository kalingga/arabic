document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('ngarab_font_family_select');
    const preview = document.getElementById('ngarab-settings-preview');
    const fontStacks = {
        'lpmq': "'LPMQ', serif",
        'amiri': "'Amiri', serif",
        'amiri-quran': "'Amiri Quran', 'Amiri', serif",
        'lateef': "'Lateef', cursive",
        'noto-nastaliq': "'Noto Nastaliq Urdu', cursive",
        'scheherazade': "'Scheherazade New', serif"
    };

    function updatePreview() {
        if (!select || !preview) return;
        const font = select.value;
        const family = fontStacks[font] || fontStacks['lpmq'];
        preview.style.setProperty('font-family', family, 'important');
    }

    if (select) {
        select.addEventListener('change', updatePreview);
        updatePreview(); // Initial load
    }
});
