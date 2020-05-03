<template>
    <div>
        <div class="share-row">
            分享網址: <a class="share-url" :href="url">{{ url }}</a>
         </div>
        <div class="share-row">
        <span>QR Code: </span>
        <img :src="qrcode" class="share-qrcode">
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: 'http://survey.test/s/21',
                qrcode: 'data:image/png;base64,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'
            }
        }
    }
</script>
<style>
    .share-qrcode {
        height: 200px;
        width: 200px;
        vertical-align: text-top;
    }
    .share-url {
        color: #409EFF;
        font-size: 1rem;
    }
    .share-row {
        padding: 5px;
        margin: auto;
    }
</style>
