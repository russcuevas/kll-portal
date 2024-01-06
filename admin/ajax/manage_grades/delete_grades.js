$(".deleteGradesForm").submit(function (event) {
    event.preventDefault();

    var gradeId = $(this).data("grade-id") || $(this).find('[name="grade_id"]').val();

    $.ajax({
        url: "../functions/manage_grades/delete_grades.php",
        type: "GET",
        data: {
            grade_id: gradeId
        },
        success: function (response) {
            console.log(response);
            if (response.status === "success") {
                swal({
                    type: "success",
                    title: "Success",
                    text: response.message,
                    confirmButtonColor: "brown"
                }, function () {
                    setTimeout(function () {
                        location.reload();
                    }, 100);
                });
            } else {
                console.log("Unexpected success:", response);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log("Error:", xhr, textStatus, errorThrown);
            swal({
                type: "error",
                title: "Error",
                text: "Failed to delete grades",
                confirmButtonColor: "red"
            });
        }
    });
});
