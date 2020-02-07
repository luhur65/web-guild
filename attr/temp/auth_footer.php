<!-- Bootstrap core JavaScript-->
<script src="<?= base_url;?>/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url;?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url;?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Date Picker By Argon-->
<script src="<?= base_url;?>/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- Popper -->
<script src="<?= base_url; ?>/assets/vendor/popper/popper.min.js"></script>

<!-- Headroom -->
<script src="<?= base_url; ?>/assets/vendor/headroom/headroom.min.js"></script>

<!-- Argon JS -->
<script src="<?= base_url; ?>/assets/js/argon.js?v=1.1.0"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url;?>/assets/js/sb-admin-2.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url;?>/assets/vendor/lightbox/js/lightbox-plus-jquery.min.js"></script>

<script>
		$('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
		});

    $(document).ready(function() {
            $('.alert-dismissible').ready(function() {
                $('.close').on('click', function() {
                    document.location.href = '?mod=home';
                });
            });
        });

</script>

</body>

</html>