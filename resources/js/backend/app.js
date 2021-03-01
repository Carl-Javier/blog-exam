import 'alpinejs'

window.$ = window.jQuery = require('jquery');
window.Swal = require('sweetalert2');
window.Vue = require('vue');

// CoreUI
require('@coreui/coreui');

// Boilerplate
require('../plugins');

// Quill
//require('./quill_init.js');
//window.Quill = require('Quill');
window.Quill = require('quill');
// window.ImageResize = require('quill-image-resize');

Quill.register('modules/imageResize', ImageResize);
