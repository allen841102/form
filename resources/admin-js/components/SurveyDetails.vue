<template>
    <el-tabs @tab-click="handleClick"
             type="border-card"
             v-model="activeName">
        <el-tab-pane label="統計結果" name="chart">
            統計結果 {{ totalReply }} 筆
            <el-divider></el-divider>
            <survey-chart :chart="chart"
                          :total-reply="totalReply"
                          :survey="survey"></survey-chart>
        </el-tab-pane>
        <el-tab-pane label="回覆明細" name="review">
            回覆明細 {{ totalReply }} 筆
            <el-divider></el-divider>
            <survey-review :change-page="getSurveyReview"
                           :review="review"
                           :survey="survey"></survey-review>
        </el-tab-pane>
        <el-tab-pane label="問卷分享" name="share">
            問卷分享
            <el-divider></el-divider>
            <survey-share :url="share.url"
                          :qrcode="'data:image/png;base64,'+share.qrcode"></survey-share>

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
                activeName: this.tab || 'chart',
                totalReply: '',
                chart: [],
                review: {},
                share: {url: '', qrcode: ''}
            };
        },
        created() {
            this.getSurveyChart()
            this.getSurveyReview(1)
            this.getSurveyShare()
        },
        methods: {
            handleClick(tab, event) {
                console.log(tab, event);
                this.title = tab.label
            },
            getSurveyChart() {
                let self = this
                const url = '/admin/survey/' + this.survey.id + '/chart'
                axios.get(url)
                    .then(function (response) {
                        self.chart = response.data.chart
                        self.totalReply = response.data.total
                    })
                    .catch(function (error, reason) {
                        if (error.response) {
                            alert(JSON.stringify(error.response))
                        } else {
                            alert(error)
                        }
                    })
            },
            getSurveyReview(page) {
                const self = this
                axios.get('/admin/survey/' + this.survey.id + '/review?page=' + page)
                    .then(function (response) {
                        self.review = response.data
                    })
                    .catch(function (error, reason) {
                        if (error.response) {
                            alert(JSON.stringify(error.response))
                        } else {
                            alert(error)
                        }
                    })
            },
            getSurveyShare() {
                const self = this
                axios.get('/admin/survey/' + this.survey.id + '/share')
                    .then(function (response) {
                        self.share = response.data
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
