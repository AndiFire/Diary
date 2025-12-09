document.addEventListener('DOMContentLoaded', function() {
    const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
    const modalHideButtons = document.querySelectorAll('[data-modal-hide]');
    const modals = document.querySelectorAll('[data-modal-target]');

    modalToggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetModalId = this.getAttribute('data-modal-toggle');
            const targetModal = document.getElementById(targetModalId);

            if (targetModal) {
                targetModal.classList.toggle('hidden');
                targetModal.classList.add('flex'); // Добавить класс flex
                centerModal(targetModal); // Вызвать функцию для центрирования модального окна
                // Сохранить состояние отображения модального окна в локальном хранилище
                localStorage.setItem('modalState', 'open');
                localStorage.setItem('lastOpenedModal', targetModalId);
            }
        });
    });

    modalHideButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetModalId = this.getAttribute('data-modal-hide');
            const targetModal = document.getElementById(targetModalId);

            if (targetModal) {
                targetModal.classList.add('hidden');
                // Удалить состояние отображения модального окна из локального хранилища
                localStorage.removeItem('modalState');
                localStorage.removeItem('lastOpenedModal');
            }
        });
    });

    function centerModal(modal) {
        const windowHeight = window.innerHeight;
        const modalHeight = modal.offsetHeight;

        const topMargin = (windowHeight - modalHeight) / 2;

        modal.style.marginTop = `${topMargin}px`;
    }

    // Проверка состояния модального окна при обновлении страницы
    const modalState = localStorage.getItem('modalState');
    if (modalState === 'open') {
        const lastOpenedModalId = localStorage.getItem('lastOpenedModal');
        const lastOpenedModal = document.getElementById(lastOpenedModalId);
        if (lastOpenedModal) {
            lastOpenedModal.classList.remove('hidden');
            lastOpenedModal.classList.add('flex'); // Добавить класс flex
            centerModal(lastOpenedModal); // Центрировать модальное окно
        }
    }
});
