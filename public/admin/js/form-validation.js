$('.form-validation').submit(function () {
    let isValid = true;

    $('.form-validation .required-validation').each(function () {
        if (!$(this).val()) {
            $(this).addClass('is-invalid');
            $(this).next('.invalid-feedback').text('Preencha este campo');

            isValid = false;
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    const confirmValidationElement = $('.form-validation .confirm-validation');
    const compareValidationElement = $('.form-validation .confirm-compare-validation');

    if (confirmValidationElement && !$(confirmValidationElement).hasClass('is-invalid')) {
        if ($(confirmValidationElement).val() !== $(compareValidationElement).val()) {
            $(confirmValidationElement).addClass('is-invalid');
            $(compareValidationElement).addClass('is-invalid');
            $(confirmValidationElement).next('.invalid-feedback').text('Os valores não coincidem');
            $(compareValidationElement).next('.invalid-feedback').text('Os valores não coincidem');


            isValid = false;
        } else {
            $(confirmValidationElement).removeClass('is-invalid');
            $(compareValidationElement).removeClass('is-invalid');
        }
    }

    if (!isValid) return false;
});
