function setSearchCriteria(criteria) {
    document.getElementById('dropdownMenuButton1').innerHTML = criteria;
    document.getElementById('searchCriteria').value = criteria;

    if (criteria == 'Price' || criteria == 'Quantity') {
        document.getElementById('searchByText').style.display = 'none';
        document.getElementById('searchByNumber').style.display = 'flex';
    } else {
        document.getElementById('searchByText').style.display = 'block';
        document.getElementById('searchByNumber').style.display = 'none';
    }
}