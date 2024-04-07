document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('hnp-template1-btn').addEventListener('click', function() {
        loadTemplate('hnp_template_1.php');
    });
    document.getElementById('hnp-template2-btn').addEventListener('click', function() {
        loadTemplate('hnp_template_2.php');
    });
});

function loadTemplate(templateUrl) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', hnpTemplateSwitcher.ajaxurl + '?action=load_template&template=' + templateUrl, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('hnp-template-container').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
