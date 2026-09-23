import Alpine from 'alpinejs';
import * as bootstrap from 'bootstrap';
import { createIcons, icons } from 'lucide';

window.Alpine = Alpine;
window.bootstrap = bootstrap;

// Initialize Lucide icons helper
window.renderLucideIcons = () => {
    createIcons({ icons });
};

document.addEventListener('DOMContentLoaded', () => {
    window.renderLucideIcons();
});

// Also re-render after dynamic content / Alpine mutations if any
document.addEventListener('alpine:initialized', () => {
    window.renderLucideIcons();
});

Alpine.start();
