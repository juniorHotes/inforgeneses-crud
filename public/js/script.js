jQuery(function() {

    function onSubmit(btn) {

        $(btn.target.firstElementChild).addClass('show');

        $(btn.currentTarget.form).find('input.required').each((i, input) => {

            $(input).on('focus', () => {
                $(input).removeClass('is-invalid');
                $(`#${input.id}-feedback`).text('');
            });

            if(input.value === '') {
                $(input).addClass('is-invalid')
                $(`#${input.id}-feedback`).text('Este campo não pode estár em branco');

                btn.preventDefault();
                btn.stopPropagation();
                $(btn.target.firstElementChild).removeClass('show');
            }
        });
    }

    $('button[type="submit"]').each((i, buttons) => {
        $(buttons).on('click', (btn) => {
            onSubmit(btn);
        });
    });


    function deleteUser() {
        const confirmText = $('#form-delete-user #confirm-text').val();
        $('#form-delete-user input#delete_user').on('keyup', (e) => {
            
            if(e.target.value === confirmText) {
                $('#form-delete-user #btn-delete').removeAttr('disabled');
            } else {
                $('#form-delete-user #btn-delete').attr('disabled', true);
            }
        });
    }

    deleteUser();
});