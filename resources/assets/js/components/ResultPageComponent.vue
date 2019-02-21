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
            <img src="example.com">
        </div>
        <div class="flex-row">
            <input type="url" :value="url">
            <button>copy</button>
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
            }
        }
    }
</script>
