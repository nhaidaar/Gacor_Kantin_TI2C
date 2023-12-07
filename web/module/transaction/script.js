function openDetail() {
    var modalDetail = document.getElementById('modal-seedetail');
    modalDetail.style.display = 'flex';
}

function closeDetail() {
    var modalDetail = document.getElementById('modal-seedetail');
    modalDetail.style.display = 'none';
}

window.onclick = function (event) {
    var modalDetail = document.getElementById('modal-seedetail');
    if (event.target == modalDetail) {
        modalDetail.style.display = 'none';
    }
};
