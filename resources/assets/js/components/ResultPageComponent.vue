<style xmlns:v="http://www.w3.org/1999/xhtml">
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
            <img src="example.com">
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
                }
            }
        }
    }
</script>
