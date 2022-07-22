import 'datatables.net';
import './styles/datatable.css';

$(document).ready(function () {
    $('#example').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
        },
        ajax: {
            url: '/api/customers',
            dataSrc: ''
        },
        columns: [
            {'data': 'juridicalName'},
            {'data': 'postalAddress.address'},
            {'data': 'postalAddress.postalCode'},
            {'data': 'postalAddress.city'},
            {'data': 'postalAddress.country'},
            {'data': 'phone'},
            {'data': 'email'},
            {'data': 'contacts[0].firstname'},
            {'data': 'contacts[0].tel'},
            {'data': 'contacts[0].email'}
        ]
    });
});