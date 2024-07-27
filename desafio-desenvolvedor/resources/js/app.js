import './bootstrap';

import mask from '@alpinejs/mask'
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.plugin(mask)
Alpine.start();
