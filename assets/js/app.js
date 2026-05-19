if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/ProyectoColaciones-PHP/service-worker.js');
}

let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;

    const btn = document.getElementById('btnInstall');
    if (btn) {
        btn.style.display = 'block';

        btn.addEventListener('click', () => {
            deferredPrompt.prompt();
        });
    }
});