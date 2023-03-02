function getPassword(e) {
    const text = e.target.value;

    const length = $('#length')[0];
    const lowercase = $('#lowercase')[0];
    const uppercase = $('#uppercase')[0];
    const number = $('#number')[0];
    const special = $('#special')[0];

    checkIfEightChar(text) ? length.classList.add('list-group-item-success') : length.classList.remove('list-group-item-success');
    checkIfOneLowercase(text) ? lowercase.classList.add('list-group-item-success') : lowercase.classList.remove('list-group-item-success');
    checkIfOneUppercase(text) ? uppercase.classList.add('list-group-item-success') : uppercase.classList.remove('list-group-item-success');
    checkIfOneDigit(text) ? number.classList.add('list-group-item-success') : number.classList.remove('list-group-item-success');
    checkIfOneSpecialChar(text) ? special.classList.add('list-group-item-success') : special.classList.remove('list-group-item-success');
}

function checkIfEightChar(text){
    return text.length >= 8;
}

function checkIfOneLowercase(text) {
    return /[a-z]/.test(text);
}

function checkIfOneUppercase(text) {
    return /[A-Z]/.test(text);
}

function checkIfOneDigit(text) {
    return /[0-9]/.test(text);
}

function checkIfOneSpecialChar(text) {
    return /[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(text);
}

jQuery(function() {
    $('#password')
    .on('focus', () => {
        $('ul#requirements').addClass('show');
    })
    .on('blur', () => {
        $('ul#requirements').removeClass('show');
    })
    .on('keyup', (e) => {
        getPassword(e);
    });
});
