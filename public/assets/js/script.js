$(document).ready(function () {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function () {

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(++current);
    });

    $(".previous").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
    }

    $(".submit").click(function () {
        return false;
    })

});

// send vote
$(document).ready(function() {
    $(".vote").click(function() {
        let calon = $(this).attr("data-calon");
        let url = $(this).attr("data-url");
        let _token = $('meta[name="csrf-token"]').attr("content");
        Swal.fire({
            title: 'Apakah Kamu Yakin ?',
            text: "Kamu akan memilih paslon ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vote Now'
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/vote",
                    type: "POST",
                    data: {
                        calon: calon,
                        _token: _token
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Terima Kasih !',
                                text: response.success,
                                icon: 'success',
                                confirmButtonText: 'Cetak Bukti'
                            }).then(function() {
                                // location.reload();
                                console.log('bukti tercetak');
                                window.location.href = "/vote/bukti";
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Mohon Maaf !",
                                text: response.error,
                                confirmButtonText: 'Tutup'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            confirmButtonText: 'Cancel'
                        });
                    }
                });
            }
        });
    });
});