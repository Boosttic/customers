import 'datatables.net';
import './styles/datatable.css';

console.log($)

$(document).ready(function () {
    $('#example').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
        },
    });
});