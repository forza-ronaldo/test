$(document).ready(function() {
    //show the box answer
    $(".btn-reply").on("click", function() {
        if (!$(this).hasClass("disabled")) {
            var url = $(this).data("url");
            var tr = `
                <tr>
                        <th scope="row">
                            <textarea class="form-control area-answer" name="text_answer"></textarea>
                        </th>
                        <td>
                            <button class="btn btn-sm btn-danger btn-delete-answer">
                                <i class="fa fa-trash">حذف</i>
                            </button>
                        </td>
                </tr>
            `;
            $("#table-answer").empty();
            $("#table-answer").append(tr);

            $(".table-questions")
                .find(".btn-reply")
                .each(function() {
                    $(this).addClass("disabled");
                });
            $("#form_reply").attr("action", url);
            $(".btn-send-reply").removeClass("disabled");
        }
    });
    //When you press the delete button, it deletes the line from the table
    $("#table-answer").on("click", ".btn-delete-answer", function() {
        $(this)
            .closest("tr")
            .detach();
        $(".btn-send-reply").addClass("disabled");
    });

    $(".btn-send-reply").on("click", function(e) {
        if ($(this).hasClass("disabled")) {
            e.preventDefault();
        }
    });

    $(document).on("click", ".btn-delete-answer", function() {
        $(".table-questions")
            .find(".btn-reply")
            .each(function() {
                $(this).removeClass("disabled");
            });
    });
});
