$(document).ready(function() {
    $(".filter-date").on("change", function() {
        $(this)
            .closest("form")
            .submit();
    });
    if(!( $('.span-notifications').text()==0))
    {
        $('.span-notifications').css('display','block');
    }

});
