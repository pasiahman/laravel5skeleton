@push('scripts')
    <script>
    var galleryMediaer = new qq.FineUploader({
        element: document.getElementById('fine-uploader-gallery'),
        request: {
            customHeaders: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            endpoint: '{{ route('backendMediumStore') }}',
        },
        template: 'qq-template',
        // thumbnails: {
        //     placeholders: {
        //         waitingPath: '/source/placeholders/waiting-generic.png',
        //         notAvailablePath: '/source/placeholders/not_available-generic.png'
        //     }
        // },
        validation: {
            allowedExtensions: ['gif', 'jpeg', 'jpg', 'png'],
        },
    });
    </script>
@endpush
