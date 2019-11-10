var profileBack = document.getElementById('myImg');
var saveButton = document.getElementById('save');
if(saveButton) {
    saveButton.style.display = 'none';
    function imageThis(elem) {
        saveButton.href = saveButton.href + elem;
        console.log(saveButton)
        profileBack.src = elem;
        saveButton.style.display = 'inline-block';
    }
}
