document.querySelector('.for-row__btn-clear').addEventListener('click',  () => {
    document.querySelector('.task__username-title').textContent = 'Пользователь:';
});

document.querySelectorAll('.for-row__input-text').forEach(function(input){
    input.addEventListener('click', function(){this.value = '';});
});