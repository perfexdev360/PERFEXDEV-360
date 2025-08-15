import './bootstrap';

import Alpine from 'alpinejs';
import layout from './components/layout';

window.Alpine = Alpine;

Alpine.data('layout', layout);

Alpine.start();
