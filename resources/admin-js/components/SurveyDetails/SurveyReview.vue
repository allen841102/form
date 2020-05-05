<template>
    <div>
        <div class="page-area">
            <el-pagination
                    :current-page.sync="currentPage"
                    :page-size="pageSize"
                    :total="total"
                    @current-change="handleCurrentChange"
                    @size-change="handleSizeChange"
                    layout="total, prev, pager, next">
            </el-pagination>
        </div>
        <el-table
                :data="tableData"
                :header-cell-style="tableHeaderColor"
                border
                style="width: 100%">
            <!--            <el-table-column-->
            <!--                    type="selection"-->
            <!--                    width="55">-->
            <!--            </el-table-column>-->
            <el-table-column :key="value.key"
                             :label="value.title"
                             :prop="value.key"
                             v-for="value in questions">
                <template slot-scope="scope">
                    <span class="answer-text" v-for="text in scope.row[value.key]">{{ text }}</span>
                </template>
            </el-table-column>
            <el-table-column label="送出時間" prop="created_at">
            </el-table-column>
            <el-table-column label="IP 位置" prop="ip">
            </el-table-column>
            <el-table-column label="回答時間" prop="response_time">
            </el-table-column>
        </el-table>
        <div class="page-area">
            <el-pagination
                    :current-page.sync="currentPage"
                    :page-size="pageSize"
                    :total="total"
                    @current-change="handleCurrentChange"
                    @size-change="handleSizeChange"
                    layout="total, prev, pager, next">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            handleSizeChange(val) {
                console.log(`${val} items per page`);
            },
            handleCurrentChange(val) {
                console.log(`current page: ${val}`);
            },
            tableHeaderColor({row, column, rowIndex, columnIndex}) {
                if (rowIndex === 0) {
                    return 'color: #409EFF; font-weight: 500; border-bottom-width: 2px;'
                }
            },
            getSurveyReview() {
                self = this
                axios.get('/admin/survey/'+ self.survey.id +'/review')
                    .then(function (response) {
                        self.tableData = response.data.data
                        self.currentPage = response.data.current_page
                        self.pageSize = response.data.per_page
                        self.total = response.data.total
                    })
                    .catch(function (error, reason) {
                        if (error.response) {
                            alert(JSON.stringify(error.response))
                        } else {
                            alert(error)
                        }
                    })
            }
        },
        data() {
            return {
                tableData: {},
            }
        },
    }
</script>
<style>
    .answer-text {
        display: block;
    }

    .page-area {
        margin: 10px 0px 10px 0px;
    }
</style>
