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
            new Dropzone('#dropzone', {
                url: '/load',
            });
        }
    }
</script>
