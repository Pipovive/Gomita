import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function slide(id, amount) {
    document.getElementById(id).scrollBy({ left: amount, behavior: 'smooth' });
}
