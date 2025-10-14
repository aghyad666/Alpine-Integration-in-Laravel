import './bootstrap';

// Import Alpine.js
import Alpine from 'alpinejs';
// Import custom data component that is registered as "dynamicSelect"
import dynamicSelect from './alpine/dynamicSelect';

// Expose Alpine globally (handy for debugging and plugins)
window.Alpine = Alpine;

// Register data components:
// Make the "dynamicSelect" component available to use in HTML via x-data="dynamicSelect(...)"
Alpine.data('dynamicSelect', dynamicSelect);
// Initialize Alpine — scans the DOM and activates x-data/x-* directives
Alpine.start();
