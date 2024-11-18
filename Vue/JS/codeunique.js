const inputs = document.querySelectorAll('.code-input input');

inputs.forEach((input, index) => {
    input.addEventListener('input', () => {
        if (input.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });
});
