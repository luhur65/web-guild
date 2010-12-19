$('.custom-file-input').on('change', function () {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

$(document).ready(function () {
    $('.alert-dismissible').ready(function () {
        $('.close').on('click', function () {
            document.location.href = '?mod=home';
        });
    });
});

$(function () {
    
    $('.like-button').on('click', function (e) {
        e.preventDefault();

        const post = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/Praktek/web-guild/attr/User/?mod=likePost&like=' + post,
            type: 'post',
            data: {
                post: post
            },
            success: function () {
                document.location.href = '?mod=home';
            }
        })
    });
});


$(function () {
    
    $('.nonaktifkanAkun').on('click', function (e) {
        e.preventDefault()

        const user = $(this).data('user');
        
        $.ajax({
            url: 'http://localhost/Praktek/web-guild/attr/User/?mod=disable&user=' + user,
            type: 'post',
            data: {
                user: user
            },
            success: function () {
                document.location.href = 'http://localhost/Praktek/web-guild/attr/auth_out.php';
            }
        })
    });
});

$(function () {
    $('.deleteAkun').on('click', function (e) {
        e.preventDefault();

        const user = $(this).data('user');
        
        $.ajax({
            url: 'http://localhost/Praktek/web-guild/attr/User/?mod=delete&user=' + user,
            type: 'post',
            data: {
                user: user
            },
            success: function (data) {
                document.location.href = 'http://localhost/Praktek/web-guild/attr/auth_out.php';
                // console.log(data)
            }
        })
    })
})