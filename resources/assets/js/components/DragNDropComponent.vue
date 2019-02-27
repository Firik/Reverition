<style>
    .dropzone {
        border-radius: 2px;
        border: 2px dashed #212529;
        min-height: 15rem;
        font-size: 3rem;
        cursor: default;
        text-align: center;
    }

    #previewHtml img {
        display: none;
    }
</style>

<template>
    <div class="row">
        <div id="dropzone" class="dropzone d-flex justify-content-center align-items-center offset-1 col-10"></div>

        <div id="previewHtml">
            <div class="dz-preview dz-file-preview">
                <div class="dz-details">
                    <img class="js-previewImage" data-dz-thumbnail/>
                </div>
                <div class="dz-progress">
                    <span class="dz-upload" data-dz-uploadprogress></span>
                </div>
                <div class="dz-error-message">
                    <span data-dz-errormessage></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Dropzone from '../../../../vendor/enyo/dropzone/dist/dropzone';

    Dropzone.autoDiscover = false;

    function clearFlashMessages() {
        const flashWrapper = document.getElementsByClassName('flash__wrapper');
        const countBlocks = flashWrapper.length;

        for (let i = 0; i < countBlocks; i++) {
            while (flashWrapper[i].firstChild) {
                flashWrapper[i].removeChild(flashWrapper[i].firstChild);
            }
        }
    }

    export default {
        mounted() {
            const dropzone = new Dropzone('div#dropzone', {
                url: 'load',
                dictDefaultMessage: 'Drop Gif Here',
                acceptedFiles: 'image/gif',
                maxFilesize: 64,
                maxFiles: 1,
                clickable: true,
                thumbnailMethod: 'crop',
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                },
                previewTemplate: document.getElementById('previewHtml').innerHTML
            });

            dropzone.on('success', (file, response) => {
                this.$store.commit('setUrl', response.url);
                this.$store.commit('setFilename', response.filename);
                this.$store.commit('setPreview', document.body.querySelector('.js-previewImage').src);

                this.$router.push(response.redirectUrl);
            });

            dropzone.on('error', (file, response) => {
                dropzone.removeFile(file);
                this.flashError(response);
            });
        },
        beforeDestroy() {
            clearFlashMessages();
        }
    };
</script>
