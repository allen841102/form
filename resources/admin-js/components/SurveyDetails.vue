<template>
    <el-tabs @tab-click="handleClick"
             type="border-card"
             v-model="activeName">
        <el-tab-pane label="統計結果" name="chart">
            統計結果
            <el-divider></el-divider>
            <survey-chart :survey="survey"></survey-chart>
        </el-tab-pane>
        <el-tab-pane label="回覆明細" name="review">
            回覆明細
            <el-divider></el-divider>
            <survey-review></survey-review>
        </el-tab-pane>
        <el-tab-pane label="問卷分享" name="share"></el-tab-pane>
    </el-tabs>
</template>
<script>

    export default {
        props: {
            tab: {
                type: String,
                required: false
            },
            survey: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                activeName: this.tab || 'chart' ,
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
