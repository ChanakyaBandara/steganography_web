// $(document).ready(function () {
//     Spinner();
// });

$("form#addEncodingFileForm").on("submit", function (e) {
    console.log(e)
    e.preventDefault();
    var formData = new FormData(this);
    console.log(formData)
    Spinner();
    Spinner.show();
    $.ajax({
        url: "PHP/backend.php",
        type: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
    }).done(function (result) {
        Spinner.hide();
        console.log(result);
        console.log(result.encryptedFileName);
        document.getElementById("image_view").src = "PHP/resources/" + result.encryptedFileName;
    })
});

$("form#addDecodingFileForm").on("submit", function (e) {
    console.log(e)
    e.preventDefault();
    var formData = new FormData(this);
    console.log(formData)
    Spinner();
    Spinner.show();
    $.ajax({
        url: "PHP/backend.php",
        type: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
    }).done(function (result) {
        Spinner.hide();
        console.log(result);
    })
});