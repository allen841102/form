<template>
    <div class="result-table">
        <el-row :key="index" v-for="(table, index) in chart">
            <el-col :span="16">
                <el-tag :class="Question.getClassName(table.type_id)" class="margin-bot" type="warning">
                    {{ Question.getTypeName(table.type_id)}}
                </el-tag>
                <span> {{ index+1 }}. {{ table.name }}</span>
                <el-table :data="table.details"
                          border
                          style="width: 100%"
                          v-if="table.type_id !== 3">
                    <el-table-column
                            label="答案選項"
                            prop="name"
                            width="auto">
                    </el-table-column>
                    <el-table-column
                            label="填答次數"
                            prop="count"
                            width="100">
                    </el-table-column>
                    <el-table-column
                            label="百分比"
                            prop="percentage"
                            width="100">
                    </el-table-column>
                </el-table>
                <div class="answer-area" v-if="table.type_id ==3">
                    <div>
                        <div :key="index"
                             v-for="(answer, index) in table.details">
                            {{ answer.name }} ( {{answer.count}} )
                        </div>
                    </div>
                </div>
            </el-col>
            <el-col :span="8">
                <span class="question-hint"> 填答人數 20 / 30 </span>
            </el-col>
        </el-row>

        <el-divider></el-divider>
    </div>
</template>
<script>
    import questionLib from '../../lib/question';

    export default {
        props: {
            survey: {
                type: Object,
                required: false
            },
            chart:{
                type: Array,
                required: true
            }
        },
        data() {
            return {
                Question: questionLib,
            }
        },
    }
</script>
<style>
    .result-table {
        margin-top: 10px;
    }

    .question-hint {
        font-size: 12px;
        color: lightslategray;
        display: table;
        margin-left: auto;
        margin-right: 0;
    }

    .answer-area {
        overflow-y: auto;
        border: 1px dotted #d2d2d2;
        padding: 10px;
        font-size: 0.8em;
        max-height: 200px
    }
</style>
