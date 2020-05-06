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
        props: {
            url: {
                type: String,
                required: true
            },
            qrcode: {
                type: String,
                required: true
            }
        },
        data() {
            return {}
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
