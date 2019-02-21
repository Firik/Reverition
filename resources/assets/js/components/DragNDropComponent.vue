<style>
    .dropzone {
        border-radius: 2px;
        border: 2px dashed #9c9c9c;
        min-height: 15rem;
        font-size: 3rem;
        color: #c0c0c0;
        cursor: default;
        text-align: center;
    }
</style>

<template>
    <div class="row">
        <div id="dropzone" class="dropzone d-flex justify-content-center align-items-center offset-3 col-6 offset-3"></div>
    </div>
</template>

<script>
    import Dropzone from '../../../../vendor/enyo/dropzone/dist/dropzone';

    Dropzone.autoDiscover = false;

    export default {
        mounted() {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            const dropzone = new Dropzone('div#dropzone', {
                url: 'load',
                dictDefaultMessage: 'Drop Gif Here',
                acceptedFiles: 'image/gif',
                maxFilesize: 64,
                maxFiles: 1,
                clickable: true,
                thumbnailMethod: 'crop',
                headers: {
                    'x-csrf-token': token
                },
                previewTemplate: `<div class="dz-preview dz-file-preview">
                                    <div class="dz-details">
                                        <img class="js-previewImage" style="display: none" data-dz-thumbnail />
                                    </div>
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
                this.$store.commit('setPreview', document.body.querySelector('.js-previewImage').src);

                this.$router.push(response.redirectUrl);
            });
        }
    }
</script>
