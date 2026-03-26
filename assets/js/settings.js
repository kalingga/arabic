document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('ngarab_font_family_select');
    const sizeInput = document.querySelector('input[name="ngarab_font_size"]');
    const heightInput = document.querySelector('input[name="ngarab_line_height"]');
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
        if (!preview) return;
        
        // Update Font Family
        if (select) {
            const font = select.value;
            const family = fontStacks[font] || fontStacks['lpmq'];
            preview.style.fontFamily = family;
        }

        // Update Font Size
        if (sizeInput) {
            preview.style.fontSize = sizeInput.value + 'pt';
        }

        // Update Line Height
        if (heightInput) {
            preview.style.lineHeight = (heightInput.value / (sizeInput ? sizeInput.value * 1.33 : 32)) + ''; 
            // Simplified line-height calculation for preview
            preview.style.lineHeight = heightInput.value + 'px';
        }
    }

    if (select) select.addEventListener('change', updatePreview);
    if (sizeInput) sizeInput.addEventListener('input', updatePreview);
    if (heightInput) heightInput.addEventListener('input', updatePreview);
    
    updatePreview(); // Initial load
});
