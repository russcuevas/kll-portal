$(".deleteStudentsForm").submit(function (event) {
    event.preventDefault();

    var studentId = $(this).data("student-id") || $(this).find('[name="student_id"]').val();
    var profilePicture = $(this).data("profile-picture") || $(this).find('[name="profile_picture"]').val();

    $.ajax({
        url: "../functions/manage_students/delete_students.php",
        type: "GET",
        data: {
            student_id: studentId,
            profile_picture: profilePicture
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
                text: "Failed to delete student",
                confirmButtonColor: "red"
            });
        }
    });
});