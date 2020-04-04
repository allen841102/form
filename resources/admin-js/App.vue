<template>
    <div id="app">
<el-container style="height: auto; border: 1px solid #eee">
    <side-bar></side-bar>
    <el-container direction="vertical">
        <nav-header></nav-header>
        <el-main>
            <survey-table></survey-table>
        </el-main>
    </el-container>
</el-container>
</div>
</template>

<style>
</style>
<script>
    import SurveyTable from './components/SurveyTable';
    import SideBar from './components/SideBar';
    import NavHeader from './components/NavHeader';
    export default {
        data() {
            return {
            }
        },
        components: {
            SurveyTable,
            SideBar,
            NavHeader
        }
    }
</script>
