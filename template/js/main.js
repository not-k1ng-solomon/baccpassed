$('#myModal').on('shown.bs.modal', function () {
    //#myInput - id элемента, которому необходимо установить фокус
    $('#myInput').focus();
})


document.getElementById('fileMulti').addEventListener('change', handleFileSelectMulti, false);

