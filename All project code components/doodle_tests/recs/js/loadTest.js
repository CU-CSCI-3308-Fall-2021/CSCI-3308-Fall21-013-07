const inpFile = document.getElementById("inpFile");
const previewContainter = document.getElementById("imagePreview");
const previewImage = previewContainter.querySelector(".image-preview__image");
const previewDefaultText = previewContainter.querySelector(".image-preview__default-text");

inpFile.addEventListener("change", function() {
    const file = this.files[0];

    // console.log(file);

    if (file) {
        const reader = new FileReader();

        previewDefaultText.style.display = "none";
        previewImage.style.display = "block";

        reader.addEventListener("load", function () {
            previewImage.setAttribute("src", this.result);
        });

        reader.readAsDataURL(file);
    }
});