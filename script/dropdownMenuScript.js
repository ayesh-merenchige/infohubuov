document.getElementById('dropdown').addEventListener('click', function() {
    var dropdownContent = document.getElementById('dropdown-content');
    dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
});

window.addEventListener('click', function(event) {
    var dropdown = document.getElementById('dropdown');
    if (event.target !== dropdown && !dropdown.contains(event.target)) {
        document.getElementById('dropdown-content').style.display = 'none';
    }
});
