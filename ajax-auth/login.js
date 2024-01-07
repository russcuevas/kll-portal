$(document).ready(function () {
    $(".loginForm").submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "functions-auth/login.php",
            data: formData,
            dataType: 'json',
            success: function (response) {
                console.log(response);

                if (response.status === "success") {
                    if (response.role === 'admin') {
                        window.location.href = 'admin/pages/dashboard.php';
                    } else if (response.role === 'student') {
                        window.location.href = 'students/pages/dashboard.php';
                    }
                } else if (response.status === 'warning') {
                    swal({
                        imageUrl: 'https://th.bing.com/th/id/OIP.jXYO7ep5G1UaBksB_udkVQHaGt?rs=1&pid=ImgDetMain',
                        title: response.message,
                    })
                } else {
                    swal({
                        imageUrl: 'https://th.bing.com/th/id/OIP.jXYO7ep5G1UaBksB_udkVQHaGt?rs=1&pid=ImgDetMain',
                        title: response.message,
                    });
                }
            },
        });
    });
});