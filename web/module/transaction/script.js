function openModal() {
    var modal = document.getElementById('modal');
    modal.style.display = 'flex';
}

function closeModal() {
    var modal = document.getElementById('modal');
    modal.style.display = 'none';
}

window.onclick = function (event) {
    var modal = document.getElementById('modal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};
