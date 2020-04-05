<template>
    <el-header height="110px">
        {{ headerText}}
    </el-header>
</template>

<script>
    export default{
        props: {
           headerText: {
               type: String,
               required: true,
           }
        }
    }
</script>

<style>
    .el-header {
        background-color: #409EFF;
        color: #606266;
        line-height: 50px;
        padding: 20px;
        text-align: center;
        font-size: 2em;
    }
</style>
