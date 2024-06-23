$(document).ready(function () {
    $('#selectAllboxes').click(function(){
        if (this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            })
        } else{
            $('.checkBoxes').each(function(){
                this.checked = false;
            })
        }
    });

    $('#summernote').summernote({
        height: 200,
        focus: true
    });
});