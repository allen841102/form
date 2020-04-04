<template>
    <el-table
        :data="tableData"
        border
        style="width: 100%">
        <el-table-column
            prop="sequence"
            label="#"
            width="150">
        </el-table-column>
        <el-table-column
            prop="title"
            label="主題"
            width="150">
        </el-table-column>
        <el-table-column
            prop="created_at"
            label="建立時間"
            width="150">
        </el-table-column>
        <el-table-column
            prop="updated_at"
            label="更新時間"
            width="150">
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
            width="150">
        </el-table-column>
        <el-table-column label="操作">
            <template slot-scope="scope">
                <el-button @click="handleClick(scope.row)" type="text" size="small">查看</el-button>
                <el-button
                    size="mini"
                    @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
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
        data() {
            return {
                tableData: [
                    {
                        'sequence': 1,
                        'title': '飲食習慣研究',
                        'created_at': '2020-01-02 12:39:49',
                        'updated_at': '2020-04-03 18:00:22',
                        'question_count': 5,
                        'status': '開啟',
                        'response_count': 33,
                        'response_time': '2020-03-31 14:23:12',
                    },
                    {
                        'sequence': 2,
                        'title': '大學生打工調查',
                        'created_at': '2020-02-22 12:39:49',
                        'updated_at': '2020-03-01 18:00:22',
                        'question_count': 15,
                        'status': '關閉',
                        'response_count': 123,
                        'response_time': '2020-02-28 14:23:12',
                    }
                ],
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
