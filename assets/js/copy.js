document.addEventListener('DOMContentLoaded', function() {
    const copyButtons = document.querySelectorAll('.arab-copy-btn');
    
    copyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const container = this.closest('.arab-container');
            const arabText = container.querySelector('.arab').innerText;
            
            const tempTextArea = document.createElement('textarea');
            tempTextArea.value = arabText;
            document.body.appendChild(tempTextArea);
            tempTextArea.select();
            document.execCommand('copy');
            document.body.removeChild(tempTextArea);
            
            const originalHTML = this.innerHTML;
            this.classList.add('arab-copy-success');
            this.innerText = 'Copied!';
            
            setTimeout(() => {
                this.classList.remove('arab-copy-success');
                this.innerHTML = originalHTML;
            }, 2000);
        });
    });
});
