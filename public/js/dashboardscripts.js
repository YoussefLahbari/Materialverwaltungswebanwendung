// EXECL
let table = document.getElementById('showntable');
document.getElementById('exporterBtn').addEventListener('click', function() {
    var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});
    XLSX.writeFile(wb, 'table.xlsx');
    
});
var tbody = table.querySelector("tbody");

// Check if the tbody is empty
if (!tbody || tbody.children.length === 0) {
    // If tbody is empty, add a new row with your custom message
    thead = table.querySelector("thead");
    tr = thead.querySelector("tr");
    tr.innerHTML = '<td colspan="10" class="text-center mt-2"><h2 class="">Bienvenue Admin</h2><p class="lead">Commencer par saisir des Matériaux</p></td>';
}

selected = document.getElementById('selected');
selected.addEventListener('change', function(){
if(selected.value === 'Materiel'){
    document.getElementById('searchkey').placeholder = 'Type, Model, Etat, etc...';
}
else if(selected.value === 'Site'){
    document.getElementById('searchkey').placeholder = 'Post, Bureau, Tel etc...';
}
});

document.addEventListener('DOMContentLoaded', function() {
    // Repairs Button
    const showRepairButtons = document.querySelectorAll('.show-repairs-btn');

    showRepairButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const materielId = this.getAttribute('data-materiel-id');
            const detailsRow = document.getElementById('repair-details-' + materielId);
            if (detailsRow.style.display === 'none') {
                detailsRow.style.display = 'table-row';
            } else {
                detailsRow.style.display = 'none';
            }
        });
    });

    // Besoin Button
    const showBesoinButtons = document.querySelectorAll('.show-besoins-btn');

    showBesoinButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const siteId = this.getAttribute('data-site-id');
            const detailsRow = document.getElementById('besoin-details-' + siteId);
            if (detailsRow.style.display === 'none') {
                detailsRow.style.display = 'table-row';
            } else {
                detailsRow.style.display = 'none';
            }
        });
    });
});
    function showDescription(description) {
        alert(description);
    }
    function printTable(search) {
        // Apply styles to hide everything except the table and its contents
        let cardheader = document.querySelector('.card-header');
        let preheader = cardheader.innerHTML;
        var style = document.createElement('style');
        style.textContent = `
        @media print {
            body > *:not(#showntable):not(#showntable *),  
             {
                visibility: hidden !important;
            }
            .navbar, footer, .hide{
                display:none;
            }
            #showntable, #showntable * {
                visibility: visible !important;
            }
            .card-header {
                visibility: visible !important;
                text-align: center;
                font-size: 24px;
                font-weight: bold;
            }
            .card-header h3{
                width:fit-content;
                margin:auto;
            }
            #showntable{
                width:100% !important;
            }
            body, #showntable td, #showntable th{
                background:white !important;
            }
        }
        `;
        // define attr
        let filter = document.getElementById('selected').value
        
        if(filter===""){
            filter ='Materiaux'
        }
        document.head.appendChild(style);
        cardheader.innerHTML = "<h3 class='text-center'>Resultat pour " + filter +"</h3>";
        
        // Print the page
        window.print();
        cardheader.innerHTML = preheader;
        // Remove the dynamically added styles after printing
        style.remove();
    }
    
