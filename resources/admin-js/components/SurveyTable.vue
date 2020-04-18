<template>
    <el-table
        :data="tableData"
        border
        style="width: 100%">
        <el-table-column
            prop="sequence"
            label="#"
            width="50">
        </el-table-column>
        <el-table-column
            prop="title"
            label="主題"
            width="150">
        </el-table-column>
        <el-table-column
            prop="created_at"
            label="建立時間"
            width="160">
        </el-table-column>
        <el-table-column
            prop="updated_at"
            label="更新時間"
            width="160">
        </el-table-column>
        <el-table-column
            prop="question_count"
            label="題數"
            width="120">
        </el-table-column>
        <el-table-column
            prop="status"
            label="狀態"
            width="120">
        </el-table-column>
        <el-table-column
            prop="response_count"
            label="回覆數量"
            width="120">
        </el-table-column>
        <el-table-column
            prop="response_time"
            label="最後回覆時間"
            width="160">
        </el-table-column>
        <el-table-column label="操作">
            <template slot-scope="scope">
                <a :href="scope.row.view_link">
                    <el-button type="primary" size="small">查看</el-button>
                </a>

                <a :href="scope.row.edit_link">
                <el-button
                    size="mini"
                    @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                </a>

                <el-button
                    size="mini"
                    type="danger"
                    @click="handleDelete(scope.$index, scope.row)">删除</el-button>
            </template>
        </el-table-column>
    </el-table>
</template>
<script>
    export default {
        props: {
            surveyList: {
                type: String,
                required: true,
            }
        },
        data() {
            return {
                tableData: JSON.parse(this.surveyList),
            }
        },
        methods: {
            handleClick(row) {
                console.log(row);
            },
            handleEdit(index, row) {
                console.log(index, row);
            },
            handleDelete(index, row) {
                console.log(index, row);
            }
        }
    }
</script>
