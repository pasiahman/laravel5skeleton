$(document).ready(function () {
    var sortables = document.querySelectorAll('.sortable-list-group');
    Array.prototype.forEach.call(sortables, function(element, index) { Sortable.create(element); });
});
