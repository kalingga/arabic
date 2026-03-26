document.addEventListener('DOMContentLoaded', function() {
    // WordPress core uses ClipboardJS, but some environments might use Clipboard
    const ClipboardHandler = window.ClipboardJS || window.Clipboard;
    
    if (typeof ClipboardHandler !== 'undefined') {
        const clipboard = new ClipboardHandler('.arab-copy-btn');

        clipboard.on('success', function(e) {
            const button = e.trigger;
            const originalHTML = button.innerHTML;
            const copiedText = (typeof ngarab_copy_vars !== 'undefined') ? ngarab_copy_vars.copied_text : 'Copied!';
            
            button.classList.add('arab-copy-success');
            button.innerText = copiedText;
            
            setTimeout(() => {
                button.classList.remove('arab-copy-success');
                button.innerHTML = originalHTML;
            }, 2000);

            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
        });
    } else {
        console.warn('(ng)Arab: ClipboardJS library not found.');
    }
});
