<style>
    .preview-gif {
        cursor: pointer;
        width: 239px;
        height: 200px;
        margin-bottom: 0.5rem;
    }

    .copy-form {
        display: inline-flex;
    }
</style>

<template>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="row">
            <h1>All done!</h1>
        </div>

        <div class="row">
            <img :src="preview" v-on:click="playGif"
                 :data-alt="url" class="img-rounded preview-gif">
        </div>

        <div class="flex-row copy-form">
            <input type="url" class="form-control js-copytextarea" :value="url">
            <button v-on:click="copyToBuffer" type="button" class="btn btn-default">copy</button>
        </div>

        <div class="row">or</div>

        <div class="row">
            <a :href="url" :download="filename">Download?</a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: this.$store.state.url,
                filename: this.$store.state.filename,
                preview: this.$store.state.preview,

                copyToBuffer() {
                    const copyTextarea = document.querySelector('.js-copytextarea');
                    copyTextarea.focus();
                    copyTextarea.select();
                    document.execCommand('copy');
                },

                playGif(event) {
                    const gifImage = new Image();
                    gifImage.src = event.target.getAttribute('data-alt');

                    const img = event.target;
                    const imgSrc = img.getAttribute('src');
                    const imgAlt = gifImage.getAttribute('src');

                    img.setAttribute('src', imgAlt);
                    img.setAttribute('data-alt', imgSrc);
                }
            }
        }
    }
</script>
