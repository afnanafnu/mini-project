// resources/js/Admin/layout/app.js

import $ from 'jquery';
window.$ = window.jQuery = $;

// Import Bootstrap CSS (optional if in Blade via @vite)
import 'bootstrap/dist/css/bootstrap.min.css';

// Import Bootstrap JS (with Modal, Dropdown, etc.)
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap; // Make globally accessible

// Import Bootstrap Modal explicitly
import { Modal } from 'bootstrap';
window.Modal = Modal; // Optional: expose globally if needed

// Import SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

// Import jQuery validation
import 'jquery-validation';

// Import DataTables
import 'datatables.net';

// Import other admin scripts
import './sidebar.js';

console.log('Admin app.js loaded with Bootstrap bundle');
