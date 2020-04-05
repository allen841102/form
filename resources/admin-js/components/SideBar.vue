<template>
    <el-aside width="240px" style="background-color: rgb(238, 241, 246)">
        <div class="logo"><a :href="homePage"><span>後台首頁圖片 </span></a></div>
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
                <a href="/admin/survey/1"><el-menu-item index="1-1"><div class="first-letter">飲</div><span class="survey-name">飲食習慣研究</span></el-menu-item></a>
                <a href="/admin/survey/2"><el-menu-item index="1-2"><div class="first-letter">大</div><span class="survey-name">大學生打工調查</span></el-menu-item></a>
            </el-submenu>
            <el-menu-item index="2">
                <template slot="title">
                    <a v-bind:href="creationLink"><i class="el-icon-document-add"></i>新增問券</a>
                </template>
            </el-menu-item>
        </el-menu>
    </el-aside>
</template>

<script>
    export default {
        props: {
            creationLink: {
                type: String,
                required: true
            },
            homePage: {
                type: String,
                required: true
            },
            username:  {
                type: String,
                required: true
            }
        },
    }
</script>

<style>
    .logo {
        text-align: center;
        padding: 10px 0 0 0;
        font-size: 1.2em;
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
