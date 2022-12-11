document.querySelector('.for-row__btn-clear').addEventListener('click',  () => {
    document.querySelector('.task__origin-user-name').textContent = '';
    document.querySelector('.task__compatible-container').innerHTML = '';
});