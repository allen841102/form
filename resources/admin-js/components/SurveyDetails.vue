<template>
    <el-tabs @tab-click="handleClick" v-model="activeName">
        <el-tab-pane label="統計結果" name="first"></el-tab-pane>
        <el-tab-pane label="回覆明細" name="second"></el-tab-pane>
        <el-tab-pane label="問卷分享" name="third"></el-tab-pane>
    </el-tabs>
</template>
<script>
    export default {
        props: {
            survey: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                activeName: 'first'
            };
        },
        methods: {
            handleClick(tab, event) {
                console.log(tab, event);
            }
        }
    };
</script>
