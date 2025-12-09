$(document).ready(function(){
    $('.deleteChangeBtn').click(function(e){
        e.preventDefault();

        var category_id = $(this).val();
        $('#deleteModal').modal('show');
    });
});

