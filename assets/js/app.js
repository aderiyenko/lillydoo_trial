require('../../node_modules/materialize-css/dist/js/materialize.js');
require('../../node_modules/materialize-css/dist/css/materialize.css');
require('../css/app.css');

const $ = require('jquery');

$(document).ready(function(){
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('select').formSelect();
});