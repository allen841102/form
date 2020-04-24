<template>
    <el-header height="130px">
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
        background-color: #c7f0f5;
        color: #606266;
        line-height: 50px;
        padding: 20px;
        text-align: center;
        font-size: 2em;
    }
</style>
