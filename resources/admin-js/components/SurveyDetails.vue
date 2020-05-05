<template>
    <el-tabs @tab-click="handleClick"
             type="border-card"
             v-model="activeName">
        <el-tab-pane label="統計結果" name="chart">
            統計結果
            <el-divider></el-divider>
            <survey-chart :survey="survey" :chart="chart"></survey-chart>
        </el-tab-pane>
        <el-tab-pane label="回覆明細" name="review">
            回覆明細
            <el-divider></el-divider>
            <survey-review :survey="survey" :review="review"></survey-review>
        </el-tab-pane>
        <el-tab-pane label="問卷分享" name="share">
            問卷分享
            <el-divider></el-divider>
            <survey-share></survey-share>
        </el-tab-pane>
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
                type: Object,
                required: true
            }
        },
        data() {
            return {
                activeName: this.tab || 'chart' ,
                review: {},
                chart: []
            };
        },
        created() {
            this.getSurveyChart()
            this.getSurveyReview()
        },
        methods: {
            handleClick(tab, event) {
                console.log(tab, event);
                this.title = tab.label
            },
            getSurveyChart() {
                let self = this
                return axios.get('/admin/survey/' + this.survey.id + '/chart')
                    .then(function (response) {
                        self.chart = response.data
                    })
                    .catch(function (error, reason) {
                        if (error.response) {
                            alert(JSON.stringify(error.response))
                        } else {
                            alert(error)
                        }
                    })
            },
            getSurveyReview() {
                let self = this
                axios.get('/admin/survey/' + this.survey.id + '/review')
                    .then(function (response) {
                        self.review = response.data
                        //console.log(self.review)
                    })
                    .catch(function (error, reason) {
                        if (error.response) {
                            alert(JSON.stringify(error.response))
                        } else {
                            alert(error)
                        }
                    })
            }
        }
    };
</script>
