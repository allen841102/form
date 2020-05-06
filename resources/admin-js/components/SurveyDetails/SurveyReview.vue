<template>
    <div>
        <div class="page-area">
            <el-pagination
                    :current-page.sync="review.current_page"
                    :page-size="review.per_page"
                    :total="review.total"
                    @current-change="handleCurrentChange"
                    @size-change="handleSizeChange"
                    layout="total, prev, pager, next">
            </el-pagination>
        </div>
        <el-table
                :data="review.data"
                :header-cell-style="tableHeaderColor"
                border
                style="width: 100%">
            <el-table-column :key="value.key"
                             :label="(index + 1).toString() + '. ' + value.title"
                             :prop="value.key.toString()"
                             v-for="(value, index) in review.questions">
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
                    :current-page.sync="review.current_page"
                    :page-size="review.per_page"
                    :total="review.total"
                    @current-change="handleCurrentChange"
                    @size-change="handleSizeChange"
                    layout="total, prev, pager, next">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'survey',
            'review',
            'changePage',
        ],
        methods: {
            handleSizeChange(val) {
                //console.log(`${val} items per page`);
            },
            handleCurrentChange(val) {
                console.log(`current page: ${val}`);
                this.changePage(val);
            },
            tableHeaderColor({row, column, rowIndex, columnIndex}) {
                if (rowIndex === 0) {
                    return 'color: #409EFF; font-weight: 500; border-bottom-width: 2px;'
                }
            },
        },
        data() {
            return {}
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
