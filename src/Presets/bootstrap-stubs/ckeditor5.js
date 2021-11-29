import ClassicEditor from "@ckeditor/ckeditor5-build-classic/build/ckeditor";
// import CKFinder from "@ckeditor/ckeditor5-ckfinder/src/ckfinder";

ClassicEditor.create(document.querySelector("#description"), {
    ckfinder: {
        uploadUrl: "bigindia/backend/crm/public/laracms/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json",
    },
})
    .then((editor) => {
        // console.log(editor);
    })
    .catch((error) => {
        console.error("someting went wrong in your editor", error);
    });
