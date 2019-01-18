var textContainer, textareaSize, input;
    var autoSize = function () {
        // also can use textContent or innerText
        textareaSize.innerHTML = input.value + '\n';
    };
    
document.addEventListener('DOMContentLoaded', function() {
    textContainer = document.querySelector('.textarea-container');
    textareaSize = textContainer.querySelector('.textarea-size');
    input = textContainer.querySelector('textarea');

    autoSize();
    input.addEventListener('input', autoSize);
});

// hide/show submit button
function enableButton() {
    var buttonSubmit = document.getElementById("contact-submit");
    var nameField = document.forms["name-contact-form"]["name"].value;
    var emailField = document.forms["name-contact-form"]["email"].value;
    var messageField = document.forms["name-contact-form"]["message"].value;

    if (nameField != "" && emailField != "" && messageField != ""){
        buttonSubmit.style.display = "block";
    } else{
        buttonSubmit.style.display = "none";
    }
}
