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
        mounted() {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            let dropzone = new Dropzone('div#dropzone', {
                url: 'load',
                createImageThumbnails: false,
                dictDefaultMessage: 'Drop Gif Here',
                acceptedFiles: 'image/gif',
                maxFilesize: 64,
                maxFiles: 1,
                clickable: true,
                headers: {
                    'x-csrf-token': token
                },
                previewTemplate: `<div class="dz-preview dz-file-preview">
                                    <div class="dz-progress">
                                        <span class="dz-upload" data-dz-uploadprogress></span>
                                    </div>
                                    <div class="dz-error-message">
                                        <span data-dz-errormessage></span>
                                    </div>
                                 </div>`
            });

            dropzone.on('success', (file, response) => {
                this.$store.commit('setUrl', response.url);
                this.$store.commit('setFilename', response.filename);

                this.$router.push(response.redirectUrl);
            });
        }
    }
</script>
