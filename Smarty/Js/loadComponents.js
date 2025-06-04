// gestione per caricare automaticamente il footer, header e hero nelle varie pagine e la gestione hamburger

function loadComponents() {
    // carica l'header
    fetch('/Smarty/html/header.html')
        .then(res => {
            if (!res.ok) throw new Error('Failed to load header');
            return res.text();
        })
        .then(data => {
            const headerPlaceholder = document.getElementById('header-placeholder');
            if (headerPlaceholder) {
                headerPlaceholder.innerHTML = data;
                
                const script = document.createElement('script');
                script.src = '/Smarty/Js/hamburger.js';
                script.defer = true;
                document.body.appendChild(script);
                
                window.headerLoaded = true;
                document.dispatchEvent(new Event('headerLoaded'));
            }
        })
        .catch(error => console.error('Error loading header:', error));

    // carica il footer
    fetch('/Smarty/html/footer.html')
        .then(res => {
            if (!res.ok) throw new Error('Failed to load footer');
            return res.text();
        })
        .then(data => {
            const footerPlaceholder = document.getElementById('footer-placeholder');
            if (footerPlaceholder) footerPlaceholder.innerHTML = data;
        })
        .catch(error => console.error('Error loading footer:', error));
}

// avvia il caricamento quando il DOM è pronto
document.addEventListener('DOMContentLoaded', loadComponents);