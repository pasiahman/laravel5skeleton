$(document).ready(function () {
    tinyMCE.baseURL = document.querySelector('meta[name=app_url]').getAttribute('content')+'/bower/tinymce';
    tinymce.init({
        branding: false,
        codemirror: {
            config: { // CodeMirror config object
                mode: 'application/x-httpd-php',
                indentWithTabs: true,
                lineNumbers: true,
                // lineWrapping: false,
            },
            // fullscreen: true, // Default setting is false
            // height: 600, // Default value is 550
            indentOnInit: true, // Whether or not to indent code on init.
            jsFiles: [ // Additional JS files to load
                'mode/clike/clike.js',
                'mode/php/php.js'
            ],
            path: 'CodeMirror', // Path to CodeMirror distribution
            // saveCursorPosition: true, // Insert caret marker
            // width: 800 // Default value is 800
        },
        image_advtab: true,
        // menubar: false,
        // mobile: { theme: 'mobile' },
        plugins: 'advlist autoresize charmap code codemirror codesample fullscreen help hr image imagetools link lists media pagebreak textcolor visualblocks visualchars wordcount',
        selector: 'textarea.tinymce',
        skin_url: document.querySelector('meta[name=app_url]').getAttribute('content')+'/bower/tinymce/skins/lightgray',
        theme_url: document.querySelector('meta[name=app_url]').getAttribute('content')+'/bower/tinymce/themes/modern/theme.min.js',
        toolbar: [
            'formatselect bold italic bullist numlist | alignleft aligncenter alignright alignjustify link pagebreak',
            'strikethrough hr forecolor backcolor | removeformat charmap outdent indent | undo redo help codesample | code fullscreen'
        ]
    });
});
