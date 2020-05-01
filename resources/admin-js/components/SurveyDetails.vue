<template>
    <el-tabs @tab-click="handleClick"
             type="border-card"
             v-model="activeName">
        <el-tab-pane label="統計結果" name="result">
            統計結果
            <el-divider></el-divider>
            <survey-chart></survey-chart>
        </el-tab-pane>
        <el-tab-pane label="回覆明細" name="reply"></el-tab-pane>
        <el-tab-pane label="問卷分享" name="sharing"></el-tab-pane>
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
                activeName: 'result',
            };
        },
        methods: {
            handleClick(tab, event) {
                console.log(tab, event);
                this.title = tab.label
            },
        }
    };
</script>
