<script>
$('.media_choose').each(function () {
    $(this).click(function () {
        var content = window.parent.document.getElementById('images_template').innerHTML
            .replace('$images_media_id', this.getAttribute('data-media_id'))
            .replace('$images_media_attached_file', this.getAttribute('data-attached_file'))
            .replace('$images_media_attached_file_thumbnail', this.getAttribute('data-attached_file_thumbnail'));

        window.parent.document
            .getElementById(this.getAttribute('data-fancybox_to'))
            .innerHTML += content;
    });
});
</script>
