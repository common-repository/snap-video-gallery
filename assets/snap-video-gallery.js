var SnapVideoGallery = {};

SnapVideoGallery.createModal = function (el) {
    const modal = document.getElementById(el.dataset.snap_handle);
    const iframe = modal.querySelector('iframe');
    const showClass = 'snap-show-modal';

    const closeOnEscKeydown = function (e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    }

    const closeModal = function () {
        ensureVideoHasStopped();
        document.removeEventListener('keydown', closeOnEscKeydown);
        modal.classList.remove(showClass);
    };

    const openModal = function () {
        document.addEventListener('keydown', closeOnEscKeydown);
        modal.classList.add(showClass);
    };

    const ensureVideoHasStopped = function () {
        if (iframe) {
            iframe.src = iframe.src;
        }
    };

    el.querySelector('.snap-modal-trigger').addEventListener('click', openModal);

    modal.addEventListener('click', closeModal);
    modal.querySelector('.snap-modal-close').addEventListener('click', closeModal);
};

document.addEventListener("DOMContentLoaded", function () {
    const videos = document.querySelectorAll('.snap-video');

    for (let i = 0; i < videos.length; i++) {
        SnapVideoGallery.createModal(videos[i]);
    }
});