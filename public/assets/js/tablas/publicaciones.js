document.addEventListener('DOMContentLoaded', function() {
    const filterOptions = document.querySelectorAll('.filter-option');
    const filterTitle = document.getElementById('filterTitle');
    const tablaPublicaciones = document.getElementById('tablaPublicaciones');

    filterOptions.forEach(option => {
        option.addEventListener('click', () => {
            const filter = option.getAttribute('data-filter');
            const filterText = option.textContent;

            filterTitle.textContent = `${filterText}`;
            filterTitle.classList.add('bg-primary', 'text-white', 'text-center', 'p-2', 'rounded');
            filterTitle.style.display = '';
            tablaPublicaciones.style.display = '';
            const rows = document.querySelectorAll('.publication-row');
            rows.forEach(row => {
                row.style.display = row.getAttribute('data-status') === filter ? '' : 'none';
            });
        });
    });
});