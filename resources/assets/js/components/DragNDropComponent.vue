<style>
    .content {
        height: 100vh;
    }

    .dropzone {
        border-radius: 2px;
        border: 2px dashed #9c9c9c;
        height: 50vh;
        width: 40vw;
        min-height: 14rem;
        min-width: 15rem;
        font-size: 3rem;
        color: #c0c0c0;
        cursor: default;
        text-align: center;
    }

    .dz-preview {
        font-size: 2rem;
        color: #f36363;
    }
</style>

<template>
    <div class="content d-flex justify-content-center align-items-center">
        <div id="dropzone" class="dropzone d-flex justify-content-center align-items-center"></div>
    </div>
</template>

<script>
    import Dropzone from '../../../../vendor/enyo/dropzone/dist/dropzone';

    Dropzone.autoDiscover = false;

    export default {
        init: () => {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            let dropzone = new Dropzone('#dropzone', {
                url: 'gif/load',
                createImageThumbnails: false,
                dictDefaultMessage: 'Drop Gif Here',
                acceptedFiles: 'image/gif',
                maxFilesize: 64,
                clickable: true,
                headers: {
                    'x-csrf-token': token
                },
                previewTemplate: `<div class="dz-preview dz-file-preview">
                                  <div class="dz-details">
                                    <div class="dz-filename"><span data-dz-name></span></div>
                                    <div class="dz-size" data-dz-size></div>
                                    <div class="dz-thumbnail" data-dz-thumbnail></div>
                                  </div>
                                  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                  <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                </div>`
            });

            dropzone.on('drop', () => {
                let $info = document.querySelector('.dz-preview');
                if ($info) {
                    $info.remove();
                }
            });

            dropzone.on('error', file => {
                alert(file.getError());
            });

            dropzone.on('success', (file, response) => {
                // location.href = response;
            });
        }
    }
</script>
