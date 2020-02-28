$(document).ready(function() {
    $(".filter-date").on("change", function() {
        $(this)
            .closest("form")
            .submit();
    });
    if (!($(".span-notifications").text() == 0)) {
        $(".span-notifications").css("display", "block");
    }
    $(".con-span-noti-count").on("click", function() {
        $(".span-noti-count")
            .delay(2000)
            .fadeOut(500);
        $(this).width("42.797");
    });
});
