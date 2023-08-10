//TABLE
$("table").delegate('tbody tr.clickable-row', 'click', function (e) {
    //e.preventDefault();
    if (e.target.tagName === 'TD') {
        window.location = $(this).data("href");
    }
});
