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

// tombol-like
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
                // merefresh halaman
                document.location.href = '';
            }
        })
    });
});

// disable akun
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

    // tombol aktifkan sub menu
    $('.tombolAktifkanSubMenu').on('click', function (e) {

        e.preventDefault();

        const subMenu = $(this).data('active');

        $.ajax({
            url: 'http://localhost/Praktek/web-guild/attr/Admin/activeSubmenu?active=' + subMenu,
            type: 'post',
            data: {
                subMenu: subMenu
            },
            success: function () {
                alert('Berhasil Mengaktifkan Submenu!');
                document.location.href = '?mod=settingSubMenu';
            }
        });
    });

    // tombol nonaktifkan submenu
    $('.tombolNonAktifkanSubMenu').on('click', function (e) {
        e.preventDefault()

        const subMenu = $(this).data('block');

        $.ajax({
            url: 'http://localhost/Praktek/web-guild/attr/Admin/blockedSubmenu?block=' + subMenu,
            type: 'post',
            data: {
                subMenu: subMenu
            },
            success: function () {
                alert('Berhasil Memblokir Submenu!');
                document.location.href = '?mod=settingSubMenu';
            }
        });
    });
});