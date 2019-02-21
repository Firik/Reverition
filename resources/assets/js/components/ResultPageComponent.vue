<style>
    .content {
        height: 100vh;
    }
</style>

<template>
    <div class="content d-flex flex-column justify-content-center align-items-center">
        <div class="flex-row">
            <h1>All done</h1>
        </div>
        <div class="flex-row">
            <img src="https://assets.hongkiat.com/uploads/on-click-animated-gif/gif-loaded.jpg" v-on:click="playGif"
                 :data-alt="url">
        </div>
        <div class="flex-row">
            <input type="url" class="js-copytextarea" :value="url">
            <button v-on:click="copyToBuffer">copy</button>
        </div>
        <div class="flex-row">or</div>
        <div class="flex-row">
            <a :href="url" :download="filename">Download</a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: this.$store.state.url,
                filename: this.$store.state.filename,

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
