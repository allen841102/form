<template>
    <div id="app">
<el-container style="height: auto; border: 1px solid #eee">
    <el-aside width="240px" style="background-color: rgb(238, 241, 246)">
        <el-dropdown trigger="click">
            <div class="user-info">
                <span>
                <img src="/images/portait.png" class="user-avatar">
                </span>
                <span class="username">{{ username }}</span>
                <i class="el-icon-caret-bottom" />
            </div>
            <el-dropdown-menu slot="dropdown">
                <el-dropdown-item>個人檔案</el-dropdown-item>
                <el-dropdown-item>收據管理</el-dropdown-item>
                <el-dropdown-item>優惠碼</el-dropdown-item>
                <el-dropdown-item disabled>測試功能</el-dropdown-item>
                <el-dropdown-item divided>登出</el-dropdown-item>
            </el-dropdown-menu>
        </el-dropdown>

        <el-menu :default-openeds="['1']">
            <el-submenu index="1">
                <template slot="title"><i class="el-icon-menu"></i>問券總覽</template>
                <el-menu-item index="1-1"><div class="first-letter">飲</div><span class="survey-name">飲食習慣研究</span></el-menu-item>
                <el-menu-item index="1-2"><div class="first-letter">大</div><span class="survey-name">大學生打工調查</span></el-menu-item>
            </el-submenu>
            <el-menu-item index="2">
                <template slot="title"><i class="el-icon-document-add"></i>新增問券</template>
            </el-menu-item>
        </el-menu>
    </el-aside>
    <el-container>
        <el-header style="text-align: left; font-size: 1.5em; background-color: #409EFF;">
           歡迎來到 Survey Project 後台管理介面
        </el-header>

        <el-main>
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
        </el-main>
    </el-container>
</el-container>
</div>
</template>

<style>
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        line-height: 60px;
    }

    .el-aside {
        color: #333;
    }
    .el-dropdown-link {
        cursor: pointer;
        color: #409EFF;
    }
    .el-icon-arrow-down {
        font-size: 12px;
    }
    .user-info {
        cursor: pointer;
        width: 200px;
        height: auto;
        padding: 10px;
    }
    .user-avatar {
        width: 40px;
        height: 40px;
        border: #eee 1px solid;
        border-radius: 100%;
        overflow: hidden;
    }
    .username{
        width: 140px;
        margin: 0 0 30px 20px;
        overflow: hidden;
        font-size: 1.5em;
        font-weight: bold;
        line-height: 1.5;
    }
    .first-letter{
        display: inline-block;
        vertical-align: middle;
        width: 24px;
        height: 24px;
        line-height: 24px;
        text-align: center;
        margin: 0 6px 0 0;
        background-color: #eee;
        border-radius: 24px;
    }
    .survey-name{
        width: 100%;
        display: inline-block;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

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
                username : 'Allen'
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
    };
</script>
