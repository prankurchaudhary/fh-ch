
document.addEventListener('click', function (e) {
    const loginLink = e.target.closest('[data-login]');
    if (!loginLink) return;

    // Store current page in sessionStorage
    sessionStorage.setItem(
        'after_login_redirect',
        window.location.pathname + window.location.search
    );
});

function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `
        <span class="icon">${type === 'success' ? '✅' : '❌'}</span>
        <span>${message}</span>
    `;

    container.appendChild(toast);

    // Trigger animation
    requestAnimationFrame(() => {
        toast.classList.add('show');
    });

    // Auto remove
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 2500);
}
