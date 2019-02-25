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

    .player-block {
        position: relative;
    }

    .button {
        background: transparent;
        box-sizing: border-box;
        width: 0;
        height: 74px;

        border-color: transparent transparent transparent #383838;
        transition: 100ms all ease;
        cursor: pointer;
        opacity: 0.85;

        border-style: solid;
        border-width: 37px 0 37px 60px;

        position: absolute;
        top: 65px;
        left: 100px;
    }

    .button:hover {
        border-color: transparent transparent transparent #444444;
    }

    .button:focus {
        outline: 0;
    }
</style>

<template>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="row">
            <h1>All done!</h1>
        </div>

        <div v-on:click="toPlayOrNotToPlay" class="row player-block">
            <button class="button play-button"></button>
            <img :src="preview"
                 :data-alt="url" class="img-rounded preview-gif">
        </div>

        <div class="flex-row copy-form">
            <input type="url" class="form-control js-copytextarea" :value="url">
            <button v-on:click="copyToBuffer" type="button" class="btn btn-default">copy</button>
        </div>

        <span class="row">or</span>

        <div class="row">
            <a :href="url" :download="filename">Download?</a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            let playButtonDisplay = '';

            function togglePlayButton() {
                const playButton = document.querySelector('.play-button');
                const displayNone = 'none';
                if (playButton.style.display === displayNone) {
                    playButton.style.display = playButtonDisplay;
                } else {
                    playButtonDisplay = playButton.style.display;
                    playButton.style.display = displayNone;
                }
            }

            function toggleImages() {
                const gifImage = new Image();
                const img = document.querySelector('.preview-gif');
                gifImage.src = img.getAttribute('data-alt');

                const imgSrc = img.getAttribute('src');
                const imgAlt = gifImage.getAttribute('src');

                img.setAttribute('src', imgAlt);
                img.setAttribute('data-alt', imgSrc);
            }

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

                toPlayOrNotToPlay() {
                    togglePlayButton();
                    toggleImages();
                }
            }
        }
    }
</script>
