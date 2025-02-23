document.addEventListener('DOMContentLoaded', function () {
    if (drc_vars.disable_right_click === '1') {
        document.addEventListener('contextmenu', function (event) {
            event.preventDefault();
        });
    }
    if (drc_vars.disable_text_selection === '1') {
        document.addEventListener('selectstart', function (event) {
            event.preventDefault();
        });
        document.addEventListener('copy', function (event) {
            event.preventDefault();
        });
    }
});
