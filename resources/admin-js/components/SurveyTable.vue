<template>
    <el-table
            :data="tableData"
            border
            style="width: 100%">
        <el-table-column
                label="#"
                width="50">
            <template slot-scope="scope">
                <p>{{ scope.$index + 1 }}</p>
            </template>
        </el-table-column>
        <el-table-column
                label="主題"
                prop="title"
                width="150">
        </el-table-column>
        <el-table-column
                label="建立時間"
                prop="created_at"
                width="160">
        </el-table-column>
        <el-table-column
                label="更新時間"
                prop="updated_at"
                width="160">
        </el-table-column>
        <el-table-column
                label="題數"
                prop="question_count"
                width="120">
        </el-table-column>
        <el-table-column
                label="狀態"
                prop="status"
                width="120">
        </el-table-column>
        <el-table-column
                label="回覆數量"
                prop="response_count"
                width="120">
        </el-table-column>
        <el-table-column
                label="最後回覆時間"
                prop="response_time"
                width="160">
        </el-table-column>
        <el-table-column label="操作">
            <template slot-scope="scope">
                <a :href="scope.row.view_link">
                    <el-button size="small" type="primary">查看</el-button>
                </a>

                <a :href="scope.row.edit_link">
                    <el-button
                            @click="onEdit(scope.$index, scope.row)"
                            size="mini">编辑
                    </el-button>
                </a>

                <el-button
                        @click="onDelete(scope.$index, scope.row)"
                        size="mini"
                        type="danger">删除
                </el-button>
            </template>
        </el-table-column>
    </el-table>
</template>
<script>
    import axios from 'axios';
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
            onClick(row) {
                console.log(row);
            },
            onEdit(index, row) {
                console.log(index, row);
            },
            onDelete(index, row) {
                console.log(index, row);
                let self = this
                self.$confirm('刪除此問券?', '警告', {
                    confirmButtonText: '刪除',
                    cancelButtonText: '取消',
                    type: 'danger'
                }).then(() => {
                    self.deleteSurvey(row.sequence, function () {
                        self.$message({
                            type: 'success',
                            message: '刪除成功'
                        })
                        self.tableData.splice(index, 1)
                    })
                })
            },
            deleteSurvey(id, callBack) {
                axios.delete('/admin/survey/'+id)
                    .then(function (response) {
                        callBack()
                    })
                    .catch(function(error, reason) {
                        if(error.response) {
                            alert(JSON.stringify(error.response))
                        } else {
                            alert(error)
                        }
                    })
            }
        }
    }
</script>
