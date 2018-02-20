<style>
    .content {
        height: 100vh;
    }

    .drag-zone {
        border-radius: 2px;
        border: 2px dashed #9c9c9c;
        height: 50vh;
        width: 30vw;
        min-height: 2rem;
        min-width: 10rem;
    }

    .drag-n-drop-text {
        font-size: 3rem;
        color: #c0c0c0;
        cursor: default;
    }
</style>

<template>
    <div class="content d-flex justify-content-center align-items-center">
        <div id="drag-zone" class="drag-zone d-flex justify-content-center align-items-center">
            <span class="drag-n-drop-text">Drag-n-drop here</span>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>
