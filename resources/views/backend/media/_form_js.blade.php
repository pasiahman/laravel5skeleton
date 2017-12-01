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
        validation: {
            // allowedExtensions: ['gif', 'jpeg', 'jpg', 'png'],
        },
    });
    </script>
@endpush
