document.querySelector('.for-row__btn-clear').addEventListener('click',  () => {
    document.querySelector('.task__username-title').textContent = 'Пользователь:';
    document.querySelector('.task__compatible-container').innerHTML = '';
});