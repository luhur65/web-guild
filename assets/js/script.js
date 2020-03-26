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
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Submenu Telah Aktif kembali!',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.value == true) {
                        // reload halaman
                        document.location.href = '';
                    }
                });

            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Submenu gagal diaktifkan kembali!',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.value == true) {
                        // reload halaman
                        document.location.href = '';
                    }
                });
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
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Submenu Telah Dinonaktifkan!',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.value == true) {
                        // reload halaman
                        document.location.href = '';
                    }
                });
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Submenu Gagal Dinonaktifkan!',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.value == true) {
                        // reload halaman
                        document.location.href = '';
                    }
                });
            }
        });
    });
});


// Comment Pop up
$(function () {

    $('.form-comment').hide();

    $('.comment-pop').on('click', function (e) {
        e.preventDefault();

        const form = $('.form-comment').show();

        form.html(`
        <div class="card mt-2">
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="comment">
                        <h5 class="text-dark">Comments Public</h5>
                    </label>
                    <textarea class="form-control" name="comment" id="comment" rows="2"
                        placeholder="type your comments ..."></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm col-lg-6" name="send">
                        <i class="fa fa-paper-plane fa-fw" aria-hidden="true"></i>
                        Kirim!
                    </button>
                </div>
            </form>
        </div>
    </div>`);

    });
});


$(function () {

    // blockir user oleh admin
    $('.blockir').on('click', function (e) {
        e.preventDefault();

        const user = $(this).data('user');

        $.ajax({
            url: 'http://localhost/Praktek/web-guild/attr/Admin/?mod=blockByAdmin&user=' + user,
            type: 'post',
            data: {
                user: user
            },
            success: function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Diblockir!',
                    text: 'User Berhasil DiBlockir!',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.value == true) {
                        // reload halaman
                        document.location.href = '';
                    }
                });
            }
        });
    });

    // aktifkan user oleh admin
    $('.aktifkan').on('click', function (e) {
        e.preventDefault();

        const user = $(this).data('user');

        $.ajax({
            url: 'http://localhost/Praktek/web-guild/attr/Admin/?mod=openAccess&user=' + user,
            type: 'post',
            data: {
                user: user
            },
            success: function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Diaktifkan!',
                    text: 'User Telah Aktif kembali!',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.value == true) {
                        // reload halaman
                        document.location.href = '';
                    }
                });
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops ...!',
                    text: 'Ada Kesalahan , Gagal!',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.value == true) {
                        // reload halaman
                        document.location.href = '';
                    }
                });
            }
        });
    });
});


// Admin - Management guild
// Block , Aktifkan & Delete
$(function () {

    // Blokir
    $('.blockirGuild').on('click', function (e) {
        e.preventDefault();

        const guild = $(this).data('guild');

        $.ajax({
            url: 'http://localhost/Praktek/web-guild/attr/Admin/?mod=blockGuild&data=' + guild,
            type: 'post',
            data: {
                guild: guild
            },
            success: function () {
                // Sweeatalert
                Swal.fire({
                    icon: 'success',
                    title: 'Diblokir!',
                    text: 'Guild Berhasil Diblockir',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value == true) {
                        document.location.href = '';
                    }

                });
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Guild Gagal Diblockir!',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value == true) {
                        document.location.href = '';
                    }
                });
            }
        })
    });


    // Aktifkan
    $('.aktifkanGuild').on('click', function (e) {
        e.preventDefault();

        const guild = $(this).data('guild');

        $.ajax({
            url: 'http://localhost/Praktek/web-guild/attr/Admin/?mod=activated&data=' + guild,
            type: 'post',
            data: {
                guild: guild
            },
            success: function () {
                // Sweeatalert
                Swal.fire({
                    icon: 'success',
                    title: 'Diaktifkan!',
                    text: 'Guild Berhasil Diaktifkan kembali!',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.value == true) {
                        document.location.href = '';
                    }

                });
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Guild Gagal Diaktifkan!',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value == true) {
                        document.location.href = '';
                    }
                });
            }
        })

    });


    // Delete 
    $('.hapusGuild').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href');

        Swal.fire({
            title: 'Admin Yakin ??',
            text: 'Data guild tidak bisa dikembalikan lagi',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        document.location.href = '?mod=viewGuild';
                    }
                })
            }
        })
    });

});


// keluar guild
$(function () {
    $('#outGuild').on('click', function (e) {
        e.preventDefault();

        const href = $(this).attr('href');

        Swal.fire({
            title: 'Anda Yakin ??',
            text: 'Semua data yg berkaitan dengan guild ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        document.location.href = '?mod=Home';
                    }
                })
            }
        })


    })
});


// Undang Teman
$(function () {

    // event ketika keyword ditulis
    $('.keyword').on('keyup', function () {

        const key = $('.keyword').val();

        $('.teman').load('http://localhost/Praktek/web-guild/attr/User/data/data_teman.php?data=' + key);

    });
});